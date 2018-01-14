<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Booking;
use App\Models\Restaurant;
use App\Models\Table;
use App\Models\Day;
use App\Models\Workhour;
use App\Models\FrontContent;
use App\Repositories\RestaurantRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use League\Geotools\Geohash\Geohash;
use Toin0u\Geotools\Facade\Geotools;

class RestaurantController extends Controller
{
    private $repository;

    public function __construct(RestaurantRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index($geohash)
    {
        /* @var Geohash $decoded */
        $decoded = Geotools::geohash()->decode($geohash);

        $latitude = $decoded->getCoordinate()->getLatitude();
        $longitude = $decoded->getCoordinate()->getLongitude();

		$distance = FrontContent::first()->radius;

        $restaurants = Restaurant::getNearest($latitude, $longitude, $distance)->get();

        return view('pages.restaurants.index', ['restaurants' => $restaurants]);
    }

    public function find($slug)
    {
        $restaurant = Restaurant::where('slug', $slug)->first();
		$workhours = $restaurant->workhours()->orderBy("day_id")->orderBy("start")->get();
		$days = Day::all();

        return view('pages.restaurants.show', [
			'restaurant' => $restaurant,
			'workhours' => $workhours,
			'days' => $days
		]);
    }

    public function checkAvailabilities($id, Request $request)
    {
        $date = Carbon::create(
            $request->get('year'),
            $request->get('month'),
            $request->get('date'),
            $request->get('hours'),
            $request->get('minutes'),
            0,
            config('app.timezone')
        );

        $capacity = $request->get('capacity');
        return $this->repository->getAvailableTables($id, $date, $capacity);
    }
}
