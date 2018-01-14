<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TableController extends Controller
{
    // public function store(Request $request){
	// 	$restaurant = Auth::user();
	// 	$tables = $restaurant->tables()->with('bookings')->get();
	//
	// 	$this->validate($request, [
	// 		'table-number' => ['required', Rule::unique('tables', 'number')->where(function ($query) {
	// 			$query->where('restaurant_id', 1);
	// 		})],
	// 		'table-capacity' => 'required|min:1'
	// 	]);
	//
	// 	$table = Table::create([
	// 	    'number' => $request->get('table-number'),
	// 		'capacity' => $request->get('table-capacity'),
	// 	    'restaurant_id' => $restaurant->id
	// 	]);
	// 	return redirect()->route('admin.index')->with('message', 'La table a été ajoutée');
	// }
	//
	// public function destroy($id)
	// {
	// 	$restaurant = Auth::user();
	// 	$table = Table::findOrFail($id);
	//
	// 	if (!$table->bookings->isEmpty()) {
	// 		return redirect()->route('admin.index')->with('error', 'Il y a encore des réservation sur cette table');
	// 	}
	//
	// 	$table->delete();
	// 	return redirect()->route('admin.index')->with('message', 'La table a été supprimée');
	// }
	//
	// public function edit(Request $request)
	// {
	// 	$restaurant = Auth::user();
	//
	// 	$this->validate($request, [
	// 		'tableId' => 'required|string',
	// 		'tableCapacity' => 'required|string'
	// 	]);
	//
	// 	$table = Table::findOrFail($request->tableId);
	// 	$table->capacity = $request->tableCapacity;
	// 	$table->save();
	//
	// 	return redirect()->route('admin.index')->with('message', 'La table a été modifiée');
	// }
}
