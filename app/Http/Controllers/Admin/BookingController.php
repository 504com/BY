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
}
