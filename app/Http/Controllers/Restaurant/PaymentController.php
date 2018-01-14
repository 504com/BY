<?php

namespace App\Http\Controllers\Restaurant;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    public function index($id)
    {
        $restaurant = Restaurant::find($id)->payments;
        return response()->json($restaurant);
    }
}
