<?php

namespace App\Repositories;

use App\Models\Booking;
use App\Models\Order;
use App\Models\Table;

class BookingRepository
{
    /**
     * @param array $data
     * @param \DateTime $startHour
     * @param $endHour
     * @param Table $table
     * @param Order|null $order
     * @return Booking
     */
    public function create(array $data, \DateTime $startHour, $endHour, $order)
    {
        $orderId = $order ? $order->id : null;

        $booking = Booking::create([
            'organizer' => $data['name'],
            'guests' => $data['guests'],
            'phone' => $data['phone'],
            'start' => $startHour,
            'end' => $endHour,
			'details' => $data['details'],
            'restaurant_id' => $data['id'],
            'order_id' => $orderId,
        ]);

        return $booking;
    }
}
