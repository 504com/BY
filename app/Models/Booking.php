<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $dates = ['start', 'end'];
    protected $guarded = [];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
