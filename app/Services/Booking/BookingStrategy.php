<?php

namespace App\Services\Booking;

use App\Models\Restaurant;

interface BookingStrategy
{
    public function getRestaurantCapacity(Restaurant $restaurant, $startHour, $endHour);
}