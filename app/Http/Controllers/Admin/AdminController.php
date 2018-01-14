<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Booking;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $restaurant = Auth::user();
		$bookings = $restaurant->bookings()->get();

		// Récupération du total de personnes à h+1
		$now = Carbon::today();
		$today = $now->format('Y-m-d 00:00:00');

		$tomorrow = $now->addDay();
		$startHour = Carbon::now()->format('Y-m-d H:00:00');
		$endHour = Carbon::now()->addHour(2)->format('Y-m-d H:00:00');

		// Total de personnes dont la réservation est comprise entre H et H+2, ex: si il est 12H20 récupère tout entre 12H00 et 14H00
		$guests = $restaurant->bookings()->where('start', '>=', $today)->where('start', '<', $tomorrow)->where('start', '>=', $startHour)->where('start', '<=', $endHour)->sum('guests');
		// Réservations de la journée
		$dayBookings = $restaurant->bookings()->where('start', '>', $today)->where('start', '<', $tomorrow)->get();

        return view('pages.admin.home', [
			'restaurant' => $restaurant,
			'bookings' => $bookings,
			'guests' => $guests,
			'dayBookings' => $dayBookings
		]);
    }

    public function notification()
    {
    	$restaurant = Auth::user();
    	$now = Carbon::today();
		$today = $now->format('Y-m-d 00:00:00');
		$dayBookings = $restaurant->bookings()->where('created_at', '>', $today)->get();

		return $dayBookings;
    }
}
