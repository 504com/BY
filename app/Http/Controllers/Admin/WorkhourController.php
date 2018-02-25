<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Workhour;
use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WorkhourController extends Controller
{
    public function index($id, $day, Request $request)
    {
        $restaurant = Restaurant::find($id);
        $bookingDay = Carbon::createFromFormat('Y-m-d', $request->get('date'));
        $workhours = $restaurant->workhours()->where('day_id', $day)->orderBy('start')->get();
        $bookingTime = $bookingDay->dayOfWeek >= 0 && $bookingDay->dayOfWeek < 5 ? 30 : $restaurant->booking_duration * 60;

        $hours = $this->getBookingHours($bookingDay, $workhours, $bookingTime);

        return view('partials.bookings.time', compact('hours'));
    }

    public function getBookingHours(Carbon $date, Collection $workhours, $bookingDuration)
    {
        return $workhours->map(function ($workhour) use ($bookingDuration, $date) {
            $start = Carbon::createFromFormat('H:i', $workhour->start);
            $end = Carbon::createFromFormat('H:i', $workhour->end);
            $bookingHours = 0;
            $hours = [];

            if ($end < $start) {
                $end->addDay();
            }

            while ($start < $end) {
                if ($start->diffInMinutes($end) > 30) {
                    $hours[] = Carbon::createFromFormat('d/m/Y H:i', $date->format('d/m/Y') . ' ' .$workhour->start)->addMinutes($bookingDuration * $bookingHours);
                    ++$bookingHours;
                }
                $start->addMinutes($bookingDuration);
            }

            $workhour->bookingHours = $hours;

            return $workhour;
        })->pluck('bookingHours')->collapse();
    }

    public function show()
    {
		$restaurant = Auth::user();
		$days = Day::all();
		$workhours = $restaurant->workhours()->orderBy("day_id")->orderBy("start")->get();

		return view('pages.admin.workhours', [
			'restaurant' => $restaurant,
			'workhours' => $workhours,
			'days' => $days
		]);
    }
	public function getForm()
	{
		return view('partials.forms.workhours');
	}

	public function create(Request $request)
	{
		$restaurant = Auth::user();

		// $this->validate($request, [
		// 	'day' => 'numeric',
		// 	'start' => 'date_format:H:i',
		// 	'end' => 'date'
		// ]);

		foreach ($request->get('day') as $index => $day) {
			Workhour::create([
			    'day_id' => $day,
			    'start' => $request->get('start')[$index],
			    'end' => $request->get('end')[$index],
			    'restaurant_id' => $restaurant->id
			]);
		}

		return redirect()->route('admin.workhours.show')->with('message', "L'horaire a été ajouté");
	}

	public function destroy($id)
	{
		$workhour = Workhour::findOrFail($id);

		$workhour->delete();

		return redirect()->route('admin.workhours.show')->with('message', "L'horaire a été supprimé");
	}
}
