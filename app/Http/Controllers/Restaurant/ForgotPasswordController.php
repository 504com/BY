<?php

namespace App\Http\Controllers\Restaurant;

use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\ForgotPasswordController as Controller;

class ForgotPasswordController extends Controller
{
	public function __construct()
    {
        $this->middleware('guest');
    }

	public function showLinkRequestForm()
	{
		return view('auth.passwords.users.email');
	}

	public function broker()
    {
        return Password::broker('users');
    }

}
