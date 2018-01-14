<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    public function show()
    {
    	$restaurant = Auth::user();
    	$booking_duration = date('H\hi', mktime(0, $restaurant->booking_duration * 60));

		return view('pages.admin.infos', [
			'restaurant' => $restaurant,
			'booking_duration' => $booking_duration	
		]);
    }
}
