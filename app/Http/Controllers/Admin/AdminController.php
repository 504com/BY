<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {

        $now = Carbon::today();
        $today = $now->format('Y-m-d 00:00:00');

        $restaurant = Auth::user();
		$bookings = $restaurant->bookings()->where('start', '>=', $today)->get();

        // Récupération du total de personnes à h+1
		$tomorrow = $now->addDay();
		$startHour = Carbon::now()->format('Y-m-d H:00:00');
		$endHour = Carbon::now()->addHour(2)->format('Y-m-d H:00:00');

		// Total de personnes dont la réservation est comprise entre H et H+2, ex: si il est 12H20 récupère tout entre 12H00 et 14H00
		$guests = $restaurant->bookings()->where('start', '>=', $today)->where('start', '<', $tomorrow)->where('start', '>=', $startHour)->where('start', '<=', $endHour)->sum('guests');
		// Réservations de la journée
		$dayBookings = $restaurant->bookings()->where('start', '>', $today)->where('start', '<', $tomorrow)->get();

        foreach ($bookings as $booking) {
            $user = User::Where('id', $booking->organizer)->first();
            if($user != null){$booking->organizer = $user->lastname;}
        }

        foreach ($dayBookings as $dayBooking) {
            $user = User::Where('id', $dayBooking->organizer)->first();
            if($user != null){$dayBooking->organizer = $user->lastname;}
        }


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
