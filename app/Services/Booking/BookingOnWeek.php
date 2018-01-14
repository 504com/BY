<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 08/07/17
 * Time: 19:58
 */

namespace App\Services\Booking;

use App\Models\Day;
use App\Models\Restaurant;
use App\Models\Workhour;
use Carbon\Carbon;

class BookingOnWeek implements BookingStrategy
{
    public function getRestaurantCapacity(Restaurant $restaurant, $startHour, $endHour)
    {
        $capacity = $restaurant->capacity;
        $day = $startHour->dayOfWeek == 0 ? Day::SUNDAY : $startHour->dayOfWeek;

        $workhour = Workhour::where('restaurant_id', $restaurant->id)
            ->where('day_id', $day)
            ->where('start', '<=', $startHour)
            ->where('end', '>', $startHour)
            ->orWhere('end', '<', '03:00:00')
            ->orderBy('start')
            ->first();

        $startTime = explode(':', $workhour->start);
        $endTime = explode(':', $workhour->end);

        $start = Carbon::now()
            ->setDate($startHour->year, $startHour->month, $startHour->day)
            ->setTime($startTime[0], $startTime[1]);

        $end = Carbon::now()
            ->setDate($startHour->year, $startHour->month, $startHour->day)
            ->setTime($endTime[0], $endTime[1])
            ->addMinutes($restaurant->booking_duration * 60);

        if ($end < $start)
            $end->addDay();

        $guests = $restaurant->bookings()
            ->where('start', '>=', $start)
            ->where('end', '<=', $end)
            ->sum('guests');

        return $capacity - $guests;
    }
}