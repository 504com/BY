<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ChangePasswordController extends Controller
{
    public function index()
    {
    	return view('pages.manager.changePassword');
    }

    public function update(Request $request)
    {
    	$admin = Auth::user();
    	/*dd($admin);*/

		$validator = Validator::make($request->all(), [
			'old-password' => 'required|string|old_password:' . $admin->password,
			'password' => 'required|confirmed|min:3',
			'password_confirmation' => 'required',
		]);

		if ($validator->fails())
		{
			return redirect( route('manager.changepassword.update'))->withErrors($validator->errors());
		}

		$admin->password = Hash::make($request->get('password'));
		$admin->save();

		return redirect()->route('manager.changepassword.update')->with('message', 'Modification effectuée');
    }
}
