<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 09/03/17
 * Time: 00:44
 */

namespace App\Repositories;

use App\Models\Restaurant;
use App\Services\Booking;
use Illuminate\Database\Eloquent\Collection;

class RestaurantRepository
{
    /**
     * @param $id Restaurant id
     * @param \DateTime $date Booking date requested
     * @param $capacity
     * @return Collection
     */
    public function getAvailableTables($id, $date, $capacity)
    {
        $tables = Restaurant::find($id)
            ->tables()
            ->where('capacity', '>=', $capacity)
            ->orderBy('capacity')
            ->with('bookings')
            ->get();

        $bookingService = app()->make(Booking::class, compact('date'));

        /** @var Collection $tables */
        $tables = $tables->filter([$bookingService, 'tableIsAvailable'])->values();

        return $tables;
    }
}