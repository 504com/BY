<?php

namespace App\Http\Controllers\Manager;

use App\Models\Order;
use App\Models\Booking;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function index()
    {
		$restaurants = Restaurant::count();
		$users = User::count();
		$bookings = Booking::count();
		$orders = Order::count();

		return view('pages.manager.home', [
			'restaurants' => $restaurants,
			'users' => $users,
			'bookings' => $bookings,
			'orders' => $orders
		]);
    }

	public function chartYear()
	{
		//NB BOOKINGS / MONTH
		  $bookPerMonth = DB::table('bookings')
		  ->select(DB::raw('count(*) as total'), DB::raw('MONTH(start) as month'))
		  ->where('start', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
		  ->groupBy(DB::raw('YEAR(start)'))
		  ->groupBy(DB::raw('MONTH(start)'))
		  ->get();

		//NB ORDERS / MONTH
		  $ordersPerMonth = DB::table('orders')
		  ->select(DB::raw('count(*) as total'), DB::raw('MONTH(order_date) as month'))
		  ->where('order_date', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
		  ->groupBy(DB::raw('YEAR(order_date)'))
		  ->groupBy(DB::raw('MONTH(order_date)'))
		  ->get();

		// STATS / YEAR
		$stats = [];
		for ($i=0; $i < 12; $i++) {
			$stats[$i+1]['bookings'] = 0;
			$stats[$i+1]['orders'] = 0;
		}
		// BOOKINGS & ORDERS / MONTH
		for ($i=0; $i < sizeof($bookPerMonth); $i++) {
			$stats[$bookPerMonth[$i]->month]['bookings'] = $bookPerMonth[$i]->total;
		}
		for ($i=0; $i < sizeof($ordersPerMonth); $i++) {
			$stats[$ordersPerMonth[$i]->month]['orders'] = $ordersPerMonth[$i]->total;
		}

		return $stats;
	}
}
