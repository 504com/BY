<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 08/07/17
 * Time: 20:00
 */

namespace App\Services\Booking;

use App\Models\Restaurant;

class BookingOnWeekend implements BookingStrategy
{
    public function getRestaurantCapacity(Restaurant $restaurant, $startHour, $endHour)
    {
        $guests = $restaurant->bookings()
            ->where('start', '>=', $startHour)
            ->where('end', '<=', $endHour)
            ->sum('guests');

        $capacity = $restaurant->capacity;

        $bookings = $restaurant->bookings()
            ->where('start', '>=', $startHour)
            ->where('end', '<=', $endHour)
            ->get();

        foreach ($bookings as $booking) {
            $capacity += $this->increaseCapacity($booking->guests);
        }

        return $capacity - $guests;
    }

    public function increaseCapacity($guests)
    {
        return $guests >= 5 && ($guests & 1) ? 2 : 0;
    }
}