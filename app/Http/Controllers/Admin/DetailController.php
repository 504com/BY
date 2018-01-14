<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DetailController extends Controller
{
	public function show()
	{
		$restaurant = Auth::user();
		$orders = Order::with('products')->get();

		return view('pages.admin.details', [
			'restaurant' => $restaurant,
			'orders' => $orders
		]);
	}
}
