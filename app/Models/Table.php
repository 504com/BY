<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    public $timestamps = false;

    protected $fillable = ['number', 'capacity', 'restaurant_id'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function scopeAvailable($query, $date)
    {
        return $query->where('start', '<', $date)->get();
    }
}
