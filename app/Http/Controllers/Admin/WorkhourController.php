<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Workhour;
use App\Models\Day;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkhourController extends Controller
{
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
