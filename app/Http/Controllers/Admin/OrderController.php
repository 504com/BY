<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Show list of orders
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function index()
	{
		$restaurant = Auth::user();
		$orders = $restaurant->order()->with('user')->get();

		return view('pages.admin.orders', [
			'restaurant' => $restaurant,
			'orders' => $orders,
		]);
	}

    /**
     * Show an details of an order
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
	public function show($id)
    {
        $restaurant = Auth::user();
        $order = Order::where('id', $id)->with('products')->first();

        return view('pages.admin.details', [
            'restaurant' => $restaurant,
            'order' => $order
        ]);
    }

	public function destroy($id)
	{
		$restaurant = Auth::user();
		$order = Order::findOrFail($id);
		$order->delete();

		return redirect()->route('admin.orders.index')->with('message', 'La commande a été supprimée');
	}
}
