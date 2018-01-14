<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workhour extends Model
{
    public $timestamps = false;

	protected $fillable = ['day_id', 'start', 'end', 'restaurant_id'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

}
