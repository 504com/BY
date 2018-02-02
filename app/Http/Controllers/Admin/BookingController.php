<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Booking;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{

	public function destroy($id)
	{
		$restaurant = Auth::user();
		$booking = Booking::findOrFail($id);

		if ($booking->order_id != null) {
			return redirect()->route('admin.index')->with('error', 'Il y a une commande pour cette réservation');
		}

		$booking->delete();
		return redirect()->route('admin.index')->with('message', 'La réservation a été supprimée');
	}

    public function edit(Request $request)
    {
        \Log::info($request->id);
        if ($request->isMethod('get')){
            \Log::info('get method called');
        }
        return response()->json(['message' => 'This is post method']);
    }

	public function show($id)
	{
		$booking = Booking::findOrFail($id);

		return view('pages.admin.showbooking', [
			'booking' => $booking
		]);
	}
}
