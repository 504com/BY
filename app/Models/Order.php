<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $dates = ['order_date'];
    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'orderlines')->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

	public function restaurant()
	{
		return $this->belongsTo(Restaurant::class);
	}
}
