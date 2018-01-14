<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Subscribe extends Controller
{
    public function __invoke(Request $request)
    {
        $this->validate($request, [
            'subscribe' => 'email|unique:customers,email'
        ]);

        $customer = new Customer();
        $customer->email = $request->get('subscribe');

        return response()->json(['success' => $customer->save()]);
    }
}
