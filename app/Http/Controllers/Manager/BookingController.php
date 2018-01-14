<?php

namespace App\Http\Controllers\Manager;

use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
	public function index()
    {
		$bookings = Booking::all();

		return view('pages.manager.bookings', [
			'bookings' => $bookings
		]);
    }

	public function show($id)
	{
		$booking = Booking::findOrFail($id);

		return view('pages.manager.showbooking', [
			'booking' => $booking
		]);
	}
}
