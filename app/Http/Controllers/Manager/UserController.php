<?php

namespace App\Http\Controllers\Manager;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
		$users = User::all();

    	return view('pages.manager.users', [
			'users' => $users
		]);
    }

}
