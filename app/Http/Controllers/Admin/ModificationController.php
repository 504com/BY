<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Validator;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ModificationController extends Controller
{
	public function show()
	{
		$restaurant = Auth::user();
    	$hour = number_format($restaurant->booking_duration, 2);
    	$explode = explode('.', $hour);
    	$booking_duration_hour = $explode[0];
    	$booking_duration_minute = $explode[1];

		return view('pages.admin.modifications', [
			'restaurant' => $restaurant,
			'booking_duration_hour' => $booking_duration_hour,
			'booking_duration_minute' => $booking_duration_minute
		]);
	}

	public function edit(Request $request)
	{
		$restaurant = Auth::user();

		$validator = Validator::make($request->all(), [
			'description' => 'string',
			'flash' => 'string',
			'picture' => 'image|mimes:png,jpg,jpeg',
			'address' => 'string',
			'city' => 'string',
			'zipcode' => 'numeric',
			'capacity' => 'numeric',
			'booking_duration_hour' => 'numeric|min:0',
			'booking_duration_minute' => 'numeric|min:0|max:30'
		]);

		if ($validator->fails())
		{
			return redirect( route('admin.modifications.show'))->withErrors($validator->errors());
		}

		if (!empty($request->picture))
		{
			$imageName = 'restaurant-'.$restaurant->id.'.'.$request->picture->getClientOriginalExtension();
			$request->picture->move(public_path('img/restaurants'), $imageName);
			$restaurant->picture = $imageName;
		}

		// ADDRESS to lat/lng COORD
		$address = $request->address.' '.$request->city;
		$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&sensor=false";

		$client = new \GuzzleHttp\Client();
		$res = $client->get($url);
		$coord = json_decode($res->getBody());

		if (empty($coord->results)) {
		    return redirect()->route('admin.modifications.show')->with('error', "L'adresse n'existe pas");
        }

		$Lat = $coord->results[0]->geometry->location->lat;
		$Lng = $coord->results[0]->geometry->location->lng;
		$booking_duration = $request->booking_duration_hour + ($request->booking_duration_minute / 60);

		$restaurant->description = $request->get('description');
		$restaurant->latitude = $Lat;
		$restaurant->longitude = $Lng;
		$restaurant->flash = $request->get('flash');
		$restaurant->address = $request->get('address');
		$restaurant->city = $request->get('city');
		$restaurant->zipcode = $request->get('zipcode');
		$restaurant->capacity = $request->get('capacity');
		$restaurant->booking_duration = $booking_duration;
		$restaurant->save();

		return redirect()->route('admin.infos.show');
	}
}
