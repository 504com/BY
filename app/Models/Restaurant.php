<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Restaurant extends Authenticatable
{
	use Notifiable;

	protected $fillable = ['city', 'name', 'slug', 'email', 'password', 'phone'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function payments()
    {
        return $this->belongsToMany(PaymentMode::class, 'restaurants_payments_modes');
    }

    public function services()
    {
        return $this->belongsToMany(Service::class, 'restaurants_services');
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function scopeGetNearest($query, $lat, $lng, $distance)
    {
        return $query
            ->selectRaw("*, (6371 * acos( cos( radians($lat) ) * cos( radians( latitude ) )
* cos( radians( longitude ) - radians($lng) ) + sin( radians($lat) ) * sin(radians(latitude)) ) ) AS distance ")
            ->having('distance', '<', $distance);
    }

	public function bookings()
	{
		return $this->hasMany(Booking::class);
	}

	public function products()
	{
		return $this->hasManyThrough(Product::class, Category::class);
	}

	public function order()
	{
		return $this->hasMany(Order::class);
	}

	public function workhours()
    {
        return $this->hasMany(Workhour::class);
    }

}
