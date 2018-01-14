<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $timestamps = false;

	protected $fillable = ['name', 'restaurant_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
