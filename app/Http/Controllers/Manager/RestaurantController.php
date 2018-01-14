<?php

namespace App\Http\Controllers\Manager;

use App\Models\Day;
use App\Models\FrontContent;
use App\Models\Restaurant;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use \Snowfire\Beautymail\Beautymail;

class RestaurantController extends Controller
{
	public function index()
	{
		$restaurants = Restaurant::all();
		$frontContents = FrontContent::first();

		return view('pages.manager.restaurants', [
			'restaurants' => $restaurants,
			'frontContents' => $frontContents
		]);
	}

    public function show($id)
    {
    	$restaurant = Restaurant::findOrFail($id);
 		$card = $restaurant->categories()->with('products')->get();
		$workhours = $restaurant->workhours()->orderBy("day_id")->orderBy("start")->get();
		$days = Day::all();
    	
    	return view('pages.manager.showrestaurant', [
    		'restaurant' => $restaurant,
    		'card' => $card,
    		'days' => $days,
    		'workhours' => $workhours
		]);
    }

    public function create(Request $request)
    {
		$this->validate($request, [
			'name' => 'required|min:1|string',
			'email' => 'required|email',
			'phone' => 'required|string|max:10'
		]);

		$nameExist = Restaurant::where('name', $request->get('name'))->count();
		if ($nameExist) {
			return redirect()->route('manager.index')->with('error', 'Un restaurant porte déjà ce nom');
		}

		$mailExist = Restaurant::where('email', $request->get('email'))->count();
		if ($mailExist) {
			return redirect()->route('manager.index')->with('error', 'Ce mail est déjà attribué à un restaurant');
		}

		$slug = str_slug($request->get('name'), '-');

		$mdp = str_random(13);

		$beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);

		$beautymail->send('emails.createRestaurant', ['mdp' => $mdp], function($message) use ($mdp, $request)
		{
			$message
				->from(config('mail.from.address'))
				->to($request->get('email'))
				->subject("BY - Confirmation d'inscription");
		});

		$restaurant = Restaurant::create([
			'name' => $request->get('name'),
			'slug' => $slug,
			'email' => $request->get('email'),
			'password' => Hash::make($mdp),
			'phone' => $request->get('phone')
		]);

		return redirect()->route('manager.restaurants.index')->with('success', 'Restaurant ajouté');
    }

	public function chartYear($id)
	{
		//NB BOOKINGS / MONTH
		$bookPerMonth = DB::table('bookings')
						->select(DB::raw('count(*) as total'), DB::raw('MONTH(start) as month'))
						->where('start', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
						->where('restaurant_id', $id)
						->groupBy(DB::raw('YEAR(start)'))
						->groupBy(DB::raw('MONTH(start)'))
						->get();

		//NB ORDERS / MONTH
		$ordersPerMonth = DB::table('orders')
						->select(DB::raw('count(*) as total'), DB::raw('MONTH(order_date) as month'))
						->where('order_date', '>', DB::raw('DATE_SUB(now(), INTERVAL 6 MONTH)'))
						->where('restaurant_id', $id)
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
