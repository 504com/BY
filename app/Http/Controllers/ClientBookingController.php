<?php

namespace App\Http\Controllers;

use App\Models\FrontContent;
use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Auth;

class ClientBookingController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $bookings = Booking::where('organizer', Auth::user()->lastname)->get();
        return view('pages.customer.home', [
            'bookings' => $bookings
		]);
    }
}