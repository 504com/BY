<?php
/**
 * Created by PhpStorm.
 * User: cedric
 * Date: 09/03/17
 * Time: 02:11
 */

namespace App\Services;

use App\Models\Table;

class Booking
{
    private $date;

    public function __construct(\DateTime $date)
    {
        $this->date = $date;
    }

    /**
     * @param Table $table
     * @return bool
     */
    public function tableIsAvailable($table)
    {
        foreach($table->bookings as $booking)
        {
            if(!$this->date->between($booking->start->subHour(), $booking->end))
            {
                return true;
            }
        }

        return $table->bookings->isEmpty();
    }
}