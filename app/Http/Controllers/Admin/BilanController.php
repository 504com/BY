<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class BilanController extends Controller
{
    public function index()
    {
    	return view('pages.admin.bilan');
    }

	public function chartYear()
	{
		$restaurant = Auth::user();

		//NB BOOKINGS / MONTH
		$bookPerMonth = DB::table('bookings')
						->select(DB::raw('count(*) as total'), DB::raw('MONTH(start) as month'))
						->where('start', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
						->where('restaurant_id', $restaurant->id)
						->groupBy(DB::raw('YEAR(start)'))
						->groupBy(DB::raw('MONTH(start)'))
						->get();

		//NB ORDERS / MONTH
		$ordersPerMonth = DB::table('orders')
						->select(DB::raw('count(*) as total'), DB::raw('MONTH(order_date) as month'))
						->where('order_date', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
						->where('restaurant_id', $restaurant->id)
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
