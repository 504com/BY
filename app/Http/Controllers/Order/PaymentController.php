<?php

namespace App\Http\Controllers\Order;

use Anouar\Paypalpayment\Facades\PaypalPayment;
use App\Models\Booking;
use App\Models\PaymentMode;
use App\Models\Service;
use App\Models\User;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use PayPal\Api\Payment;
use App\Models\Payment as OrderPayment;
use PayPal\Exception\PayPalConnectionException;

class PaymentController extends Controller
{
    private $apiContext;
    private $clientId = 'AfNsdS5LXx00iuXaSGGS0OyVRBJM61qNDrprkQ544vIxjDV-h81lTDwdVOLQHDb4npLRDG2QnDdcVktP';
    private $clientSecret = 'EN5djhQe0bMXgk-AVLLi-Hzc5qtNllPQCVUCiV9h39kdvR69mHzvVM55oGf33-OQoJ6GgBG9KVIPnjA3';
    private $orderRepository;
    private $restaurantRespository;

    public function __construct(OrderRepository $orderRepository, RestaurantRepository $restaurantRepository)
    {
        $this->apiContext = PaypalPayment::ApiContext($this->clientId, $this->clientSecret);
        $this->orderRepository = $orderRepository;
        $this->restaurantRespository = $restaurantRepository;
        $this->middleware('auth');
    }

    public function store($orderId, Request $request)
    {
        $order = Order::findOrFail($orderId);
        $order->user->firstname = $request->get('firstname');
        $order->user->lastname = $request->get('lastname');

        if($request->has('address'))
        {
            $order->user->address = $request->get('address');
        }

        $order->user->save();

        if($request->get('chosenService') == Service::BOOKING)
        {
            return $this->storeBooking($order, $request);
        }

        if($request->get('payment_mode') == PaymentMode::CASH)
        {
            return $this->cashPayment($order);
        }
        else
        {
            return $this->paypalPayment($order, $request);
        }
    }

    public function success(Request $request)
    {
        $order = null;

        if($request->has('paymentId') && $request->has('PayerID'))
        {
            $paymentId = $request->get('paymentId');
            $payerId = $request->get('PayerID');

            $order = $this->paypalSuccess($paymentId, $payerId);
        }
        elseif($request->has('orderId'))
        {
            $order = Order::find($request->get('orderId'));
        }

        $subtotal = $this->orderRepository->getTotal($order->id)['total'];

        return view('pages.payment.success', [
            'order' => $order,
            'subtotal' => $subtotal,
            'shipping' => 0,
            'total' => $subtotal
        ]);
    }

    public function cancel()
    {
        return 'Opération annulée';
    }

    protected function paypalPayment(Order $order, Request $request)
    {
        $items = [];
        $total = 0;

        foreach($order->products as $product)
        {
            $item = Paypalpayment::item();
            $item->setName($product->name)
                ->setDescription($product->description)
                ->setCurrency('EUR')
                ->setQuantity($product->pivot->quantity)
                ->setPrice($product->price);

            $total += $product->price * $product->pivot->quantity;
            $items[] = $item;
        }

        $itemList = Paypalpayment::itemList();
        $itemList->setItems($items);

        $details = Paypalpayment::details();
        $details->setShipping(1)
            ->setSubtotal($total);

        $amount = Paypalpayment::amount();
        $amount->setCurrency("EUR")
            ->setTotal($total + 1)
            ->setDetails($details);

        $transaction = PaypalPayment::transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description")
            ->setInvoiceNumber($order->id);

        if($request->get('payment_mode') == PaymentMode::CREDIT_CARD)
        {
            $card = Paypalpayment::creditCard();
            $card->setType("visa")
                ->setNumber("4020024009444918")
                ->setExpireMonth("03")
                ->setExpireYear("2022")
                ->setCvv2("456")
                ->setFirstName("Joe")
                ->setLastName("Shopper");

            $fi = Paypalpayment::fundingInstrument();
            $fi->setCreditCard($card);

            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("credit_card")
                ->setFundingInstruments([$fi]);

            $payment = Paypalpayment::payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setTransactions(array($transaction));
        }
        else
        {
            $payer = Paypalpayment::payer();
            $payer->setPaymentMethod("paypal");

            $redirectUrls = Paypalpayment::redirectUrls();
            $redirectUrls->setReturnUrl(route('payment.success'))
                ->setCancelUrl(route('payment.cancel'));

            $payment = Paypalpayment::payment();
            $payment->setIntent("sale")
                ->setPayer($payer)
                ->setRedirectUrls($redirectUrls)
                ->setTransactions(array($transaction));
        }

        try
        {
            $payment->create($this->apiContext);
        }
        catch(\Exception $ex)
        {
            \Log::error($ex);
        }

        if($request->get('payment_mode') == PaymentMode::PAYPAL)
        {
            return redirect($payment->getApprovalLink());
        }
        else
        {
            $payment = new OrderPayment();
            $payment->order_id = $order->id;
            $payment->payment_mode_id = PaymentMode::CREDIT_CARD;
            $payment->amount = $this->orderRepository->getTotal($order->id)['total'];

            $payment->save();

            return redirect()->route('payment.success', ['orderId' => $order->id]);
        }
    }

    protected function paypalSuccess($paymentId, $payerId)
    {
        $payment = Paypalpayment::getById($paymentId, $this->apiContext);

        $execution = Paypalpayment::PaymentExecution();
        $execution->setPayerId($payerId);

        $order = null;

        try
        {
            $result = $payment->execute($execution, $this->apiContext);

            try
            {
                $payment = Payment::get($paymentId, $this->apiContext);
                $transaction = $payment->transactions[0];
                $order = Order::find($transaction->invoice_number);
                $payment = new OrderPayment();
                $payment->order_id = $order->id;
                $payment->payment_mode_id = PaymentMode::PAYPAL;
                $payment->amount = $transaction->amount->total;

                $payment->save();
            }catch(\Exception $ex)
            {
                \Log::error($ex);
            }
        }catch(\Exception $ex)
        {
            \Log::error($ex);
        }

        return $order;
    }

    protected function cashPayment(Order $order)
    {
        $payment = new OrderPayment();
        $payment->order_id = $order->id;
        $payment->payment_mode_id = PaymentMode::CASH;
        $payment->amount = $this->orderRepository->getTotal($order->id)['total'];

        $payment->save();

        return redirect()->route('payment.success', ['orderId' => $order->id]);
    }

    protected function storeBooking(Order $order, Request $request)
    {
        $dateFormatted = $request->get('date_submit') . ' ' . $request->get('time');
        $date = Carbon::createFromFormat('Y-m-d H:i', $dateFormatted);
        $capacity = $request->get('capacity');
        $tables = $this->restaurantRespository->getAvailableTables($order->restaurant_id, $date, $capacity);

        if($tables->count() > 0)
        {
            $table = $tables->shift();
            $booking = new Booking();
            $booking->table()->associate($table);
            $booking->order()->associate($order);
            $booking->start = $date->toDateTimeString();
            $booking->end = $date->addHour()->toDateTimeString();
            $booking->save();

            return redirect()->route('payment.success', ['orderId' => $order->id]);
        }
    }
}
