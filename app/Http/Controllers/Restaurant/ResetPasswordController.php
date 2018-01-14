<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ResetPasswordController as Controller;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
	protected $redirectTo = '/';

	protected function guard()
	{
		return Auth::guard();
	}

	public function broker()
	{
		return Password::broker('users');
	}

	public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.users.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
}
