<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Services\Booking\BookingStrategy;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Workhour;

class WorkhourController extends Controller
{
    public function show($id)
    {
        return Workhour::where('restaurant_id', $id)->get();
    }

    public function index($id, $day, Request $request)
    {
        $restaurant = Restaurant::find($id);
        $bookingDay = Carbon::createFromFormat('Y-m-d', $request->get('date'));
        $workhours = $restaurant->workhours()->where('day_id', $day)->orderBy('start')->get();
        $bookingTime = $bookingDay->dayOfWeek >= 0 && $bookingDay->dayOfWeek < 5 ? 30 : $restaurant->booking_duration * 60;

        $hours = $this->getBookingHours($bookingDay, $workhours, $bookingTime);

        return view('partials.bookings.time', compact('hours'));
    }

    public function getBookingHours(Carbon $date, Collection $workhours, $bookingDuration)
    {
        return $workhours->map(function ($workhour) use ($bookingDuration, $date) {
            $start = Carbon::createFromFormat('H:i', $workhour->start);
            $end = Carbon::createFromFormat('H:i', $workhour->end);
            $bookingHours = 0;
            $hours = [];

            if ($end < $start) {
                $end->addDay();
            }

            while ($start < $end) {
                if ($start->diffInMinutes($end) > 30) {
                    $hours[] = Carbon::createFromFormat('d/m/Y H:i', $date->format('d/m/Y') . ' ' .$workhour->start)->addMinutes($bookingDuration * $bookingHours);
                    ++$bookingHours;
                }
                $start->addMinutes($bookingDuration);
            }

            $workhour->bookingHours = $hours;

            return $workhour;
        })->pluck('bookingHours')->collapse();
    }
}
