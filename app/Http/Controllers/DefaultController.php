<?php

namespace App\Http\Controllers;

use App\Models\FrontContent;
use App\Models\Booking;
use App\Models\Product;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class DefaultController extends Controller
{
    public function index()
    {
		$nbRestaurants = Restaurant::count();
		$nbProducts = Product::count();
		$nbGuests = Booking::all()->sum('guests');
        $restaurants = Restaurant::all()->random(3);
		$contents = FrontContent::first();
		$ranked = Restaurant::whereIn('id', [$contents->rank_1, $contents->rank_2, $contents->rank_3])->inRandomOrder()->get();
		$recent = Restaurant::whereIn('id', [$contents->new_1, $contents->new_2, $contents->new_3])->inRandomOrder()->get();

        return view('pages.home', [
			'nbRestaurants' => $nbRestaurants,
			'nbProducts' => $nbProducts,
			'nbGuests' => $nbGuests,
			'restaurants' => $restaurants,
			'contents' => $contents,
			'ranked' => $ranked,
			'recent' => $recent
		]);
    }
}
