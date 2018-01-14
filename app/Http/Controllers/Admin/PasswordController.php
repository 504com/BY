<?php

namespace App\Http\Controllers\Admin;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function index()
    {
    	return view('pages.admin.password');
    }

	public function edit(Request $request)
	{
		$restaurant = Auth::user();

		$this->validate($request, [
			'old-password' => 'required|string|old_password:' . $restaurant->password,
			'password' => 'required|string|confirmed',
			'password_confirmation' => 'required|string'
		]);

/*		if (!Hash::check($request->get('old-password'), $restaurant->password)) {
			return redirect()->route('admin.password.index')->with('error', 'L\'ancien mot de passe ne correspond pas');
		}*/

		$restaurant->password = Hash::make($request->get('password'));
		$restaurant->save();

		return redirect()->route('admin.password.index')->with('success', 'Création OK');
	}
}
