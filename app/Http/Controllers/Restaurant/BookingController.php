<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Service;
use App\Models\Workhour;
use App\Repositories\BookingRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;
use App\Services\Booking\BookingOnWeekend;
use App\Services\Booking\BookingStrategy;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use \Snowfire\Beautymail\Beautymail;

class BookingController extends Controller
{
    private $restaurant;
    private $order;
    private $booking;

    public function __construct(RestaurantRepository $restaurant, OrderRepository $order, BookingRepository $booking)
    {
        $this->middleware('auth');
        $this->restaurant = $restaurant;
        $this->order = $order;
        $this->booking = $booking;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        return view('pages.booking.create', ['restaurant' => $restaurant]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  string $slug
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($slug, Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails())
		{
            return back()->withInput()->withErrors($validator);
        }

		$restaurant = Restaurant::where('slug', $slug)->first();
		$startHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('date_submit') . ' ' . $request->get('time'), config('app.timezone'));
		$endHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('date_submit') . ' ' . $request->get('time'), config('app.timezone'))
            ->addHours($restaurant->booking_duration);

		/** @var BookingStrategy $bookingStrategy */
		$bookingStrategy = resolve(BookingStrategy::class, ['date' => $startHour]);
        $capacity = $bookingStrategy->getRestaurantCapacity($restaurant, $startHour, $endHour);

        $guests = 0;

        if ($bookingStrategy instanceof BookingOnWeekend) {
            $guests += $bookingStrategy->increaseCapacity($request->guests);
        }

		if ($request->guests > $capacity + $guests)
		{
			$validator->errors()->add('date', 'Aucune table disponible à cette heure là');
			return back()->withInput()->withErrors($validator);
		}

        $booking = $this->save($request, $startHour, $endHour);

		$this->sendEmail($restaurant, $booking);

        return redirect()->route('restaurants.bookings.show', ['restaurant' => $slug, 'booking' => $booking->id])->with('success', 'La réservation a bien été validée');
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slug
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug, $id)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
        $booking = Booking::find($id);

        return view('pages.booking.show', [
            'restaurant' => $restaurant,
            'booking' => $booking
        ]);
    }

    private function sendEmail($restaurant, $booking)
    {
        $beautymail = app()->make(Beautymail::class);

        $beautymail->send('emails.booking', ['restaurant' => $restaurant,'booking' => $booking], function($message) use ($booking)
        {
            $message
                ->from(config('mail.from.address'))
                ->to(Auth::user()->email, $booking->organizer)
                ->subject('Confirmation de réservation');
        });
    }

    private function save($request, $startHour, $endHour)
    {
        return DB::transaction(function () use ($request, $startHour, $endHour)
        {
            $order = null;

            if ($request->has('with_order')) {
                $order = $this->order->createOrder($request->all(), $startHour, Auth::user()->id);
                $products = array_combine($request->get('products'), $request->get('quantities'));
                $this->order->createOrderLines($order, $products);
            }

            return $this->booking->create($request->all(), $startHour, $endHour, $order);
        });
    }

    private function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required',
            'guests' => 'required|integer|min:1',
            'date' => 'required',
            'date_submit' => 'date|date_format:Y-m-d',
            'time' => ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
            'phone' => ['required', 'regex:/[0-9]{10}/'],
            'details' => 'string'
        ]);
    }
}
