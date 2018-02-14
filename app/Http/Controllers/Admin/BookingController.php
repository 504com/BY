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

	public function destroy($id)
	{
		$restaurant = Auth::user();
		$booking = Booking::findOrFail($id);

		if ($booking->order_id != null) {
			return redirect()->route('admin.index')->with('error', 'Il y a une commande pour cette réservation');
		}

		$booking->delete();
		return redirect()->route('admin.index')->with('message', 'La réservation a été supprimée');
	}

    public function edit(Request $request)
    {
        \Log::info($request->id);
        \Log::info($request->all());

        /*
                $restaurant = null; //Restaurant::where('slug', $slug)->first();
                $startHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('bookingDate') . ' ' . $request->get('time'), config('app.timezone'));
                $endHour = Carbon::createFromFormat('Y-m-d H:i', $request->get('bookingDate') . ' ' . $request->get('time'), config('app.timezone'))
                    ->addHours($restaurant->booking_duration);

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
                $booking = $this->updateBooking(null, $request, $startHour, $endHour);
               */
    }

	public function show($id)
	{
		$booking = Booking::findOrFail($id);

		return view('pages.admin.showbooking', [
			'booking' => $booking
		]);
	}

    private function updateBooking($bookingId, $request, $startHour, $endHour)
    {
        $booking = Booking::find($bookingId);
        return DB::transaction(function () use ($booking, $request, $startHour, $endHour)
        {
            $order = $booking->order_id ? Order::find($booking->order_id) : null;
            return $this->booking->update($booking, $request->all(), $startHour, $endHour, $order);
        });
    }
}
