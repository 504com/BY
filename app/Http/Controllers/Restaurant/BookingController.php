<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Booking;
use App\Models\Order;
use App\Models\User;
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
        return view('pages.booking.create', ['restaurant' => $restaurant,  'userLastname' => Auth::user()->lastname]);
    }

    /**
     * Show the form for editing a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($bookingId)
    {
        $booking = Booking::find($bookingId);
        $restaurant = Restaurant::where('id', $booking->restaurant_id)->first();
        $workhour = Workhour::where('restaurant_id', $restaurant->id)->get();

        return view('pages.booking.edit', ['restaurant' => $restaurant , 'booking' => $booking, 'workhours' => $workhour, 'userLastname' => Auth::user()->lastname]);
    }

    /**
     *  * Update an existing resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update($slug, $bookingId, Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $restaurant = Restaurant::where('slug', $slug)->first();
        $startHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('bookingDate') . ' ' . $request->get('time'), config('app.timezone'));
        $endHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('bookingDate') . ' ' . $request->get('time'), config('app.timezone'))
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
        $booking = $this->updateBooking($bookingId, $request, $startHour, $endHour);

        /** updating user name**/
        $user = User::find(Auth::user()->id);
        $user->update([
            'lastname' => $request->get('name'),
        ]);

        $this->sendEmail($restaurant, $booking, 'Modification de réservation', 'emails.booking');

        return redirect()->route('restaurants.bookings.show', ['restaurant' => $slug, 'booking' => $booking->id])->with('success', 'La réservation a bien été modifiée');
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

        /** updating user name**/
        $user = User::find(Auth::user()->id);
        $user->update([
            'lastname' => $request->get('name'),
        ]);

		$this->sendEmail($restaurant, $booking, 'Confirmation de réservation', 'emails.booking');

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

    /**w
     * Delete  an existing resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $restaurant = Restaurant::where('id', $booking->restaurant_id)->first();
        $booking->delete();

        $this->sendEmail($restaurant, $booking, 'Annulation de réservation','emails.cancelbooking');

        $bookings = Booking::where('organizer', Auth::user()->id)->get();
        return view('pages.customer.home', [
            'bookings' => $bookings, 'showSuccesDeleteMsg' => 'Réservation supprimée'
        ]);
    }

    private function sendEmail($restaurant, $booking, $msg, $template)
    {
        $beautymail = app()->make(Beautymail::class);
        $userLastname = (Auth::user()->lastname != null) ? Auth::user()->lastname : User::Where('id', $booking->organizer)->first()->lastname;
        $beautymail->send($template, ['restaurant' => $restaurant,'booking' => $booking, 'userLastname' => $userLastname], function($message) use ($booking, $msg)
        {

            $message
                ->from(config('mail.from.address'))
                ->to(Auth::user()->email, $booking->organizer)
                ->subject($msg);
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
            return $this->booking->create($request->all(), Auth::user()->id, $startHour, $endHour, $order);
        });
    }

    private function updateBooking($bookingId, $request, $startHour, $endHour)
    {
        $booking = Booking::find($bookingId);
        return DB::transaction(function () use ($booking, $request, $startHour, $endHour)
        {
            $order = $booking->order_id ? Order::find($booking->order_id) : null;
            if ($request->has('with_order')) {
                $order = $this->order->updateOrder($order, $request->all(), $startHour, Auth::user()->id);
                $products = array_combine($request->get('products'), $request->get('quantities'));
                $this->order->updateOrderLines($order, $products);
            }
            return $this->booking->update($booking, $request->all(), $startHour, $endHour, $order);
        });
    }



    private function validator(array $data)
    {
        if($data['name'] == null){
            return Validator::make($data, [
                'name' => 'required',
                'guests' => 'required|integer|min:1',
                'date' => 'required',
                'date_submit' => 'date|date_format:Y-m-d',
                'time' => ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
                'phone' => ['required', 'regex:/[0-9]{10}/'],
                'details' => 'string'
            ]);
        }else{
            return Validator::make($data, [
                'guests' => 'required|integer|min:1',
                'date' => 'required',
                'date_submit' => 'date|date_format:Y-m-d',
                'time' => ['required', 'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'],
                'phone' => ['required', 'regex:/[0-9]{10}/'],
                'details' => 'string'
            ]);
        }

    }
}
