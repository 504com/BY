<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ResetPasswordController as Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
	protected $redirectTo = '/';

	protected function guard()
    {
        return Auth::guard('restaurant');
    }

	public function broker()
    {
        return Password::broker('restaurant');
    }

	public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.restaurants.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
