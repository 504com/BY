<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Services\Booking\BookingOnWeekend;
use App\Services\Booking\BookingStrategy;
use App\Models\Restaurant;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Repositories\BookingRepository;
use App\Repositories\OrderRepository;
use App\Repositories\RestaurantRepository;

class BookingController extends Controller
{
    private $restaurant;
    private $order;
    private $booking;

    public function __construct(RestaurantRepository $restaurant, OrderRepository $order, BookingRepository $booking)
    {
        $this->restaurant = $restaurant;
        $this->order = $order;
        $this->booking = $booking;
    }

    public function show($id)
    {
        $booking = Booking::findOrFail($id);

        return view('pages.admin.showbooking', [
            'booking' => $booking
        ]);
    }

	public function destroy(Request $request)
	{
		$booking = Booking::findOrFail($request->get('bookingId'));
		$booking->delete();

		return redirect()->route('admin.index')->with('message', 'La réservation a été supprimée');
	}

    public function edit(Request $request)
    {
        \Log::info($request->all());
        $restaurant = Restaurant::where('id', $request->restaurantId)->first();
        $startHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('date_submit') . ' ' . $request->get('time'), config('app.timezone'));
        $endHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('date_submit') . ' ' . $request->get('time'), config('app.timezone'))
            ->addHours($restaurant->booking_duration);

        $bookingStrategy = resolve(BookingStrategy::class, ['date' => $startHour]);
        $capacity = $bookingStrategy->getRestaurantCapacity($restaurant, $startHour, $endHour);

        $guests = 0;

        if ($bookingStrategy instanceof BookingOnWeekend) {
            $guests += $bookingStrategy->increaseCapacity($request->guests);
        }

        if ($request->guests > $capacity + $guests)
        {
            return response()->json(['message' => 'Aucune table disponible à cette heure là']);
        }
        $booking = $this->updateBooking($request->get('bookingId'), $request, $startHour, $endHour);
        return response()->json(['message' => 'Reservation mise à jour' , 'bookingId' => $booking->id]);

    }

    private function updateBooking($bookingId, $request, $startHour, $endHour)
    {
        $booking = Booking::find($bookingId);
        return DB::transaction(function () use ($booking, $request, $startHour, $endHour)
        {
            $order = $booking->order_id ? Order::find($booking->order_id) : null;
            return $this->booking->updateAdmin($booking, $request->all(), $startHour, $endHour, $order);
        });
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  string $slug
     * @param  Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['details'] = "";
        $request['id'] = $request->restaurantId;
        \Log::info($request->all());
      $validator = $this->validator($request->all());

       /* if ($validator->fails())
        {
            \Log::info('error');
            return back()->withInput()->withErrors($validator);
        }
       */
        $restaurant = Restaurant::where('id',  $request->restaurantId)->first();
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

      /*  if ($request->guests > $capacity + $guests)
        {
            $validator->errors()->add('date', 'Aucune table disponible à cette heure là');
            return back()->withInput()->withErrors($validator);
        }
      */
        $booking = $this->save($request, $startHour, $endHour);

        return response()->json(['message' => 'Reservation créée' , 'bookingId' => $booking->id]);
    }

    private function save($request, $startHour, $endHour)
    {
        return DB::transaction(function () use ($request, $startHour, $endHour)
        {
            return $this->booking->create($request->all(), Auth::user()->id, $startHour, $endHour, null);
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
                'phone' => ['required', 'regex:/[0-9]{10}/']
            ]);
    }
}
