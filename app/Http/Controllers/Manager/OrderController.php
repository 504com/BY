<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function index()
    {
		$orders = Order::with('restaurant')->get();

    	return view('pages.manager.orders', [
			'orders' => $orders
		]);
    }

	public function show($id)
	{
		$order = Order::where('id', $id)->with('products')->first();

		return view('pages.manager.details', [
			'order' => $order
		]);
	}
}
