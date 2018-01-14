<?php

namespace App\Http\Controllers\Order;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public $_apiContext;

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        return view('pages.order.checkout');
    }

    public function store($id, Request $request)
    {
        $order = new Order();
        $date = $request->get('date');
        $order->order_date = Carbon::createFromDate($date['year'], $date['month'], $date['date'], config('app.timezone'))->setTime($date['hours'], $date['minutes']);
        $order->service_id = $request->get('service');

        DB::transaction(function() use($order, $request, $id)
        {
            $order->customer_id = Auth::user()->id;
            $order->restaurant_id = $id;
            $order->save();

            foreach($request->get('products') as $product)
            {
                $order->products()->attach($product['id'], ['quantity' => $product['quantity']]);
            }

        });

        return response()->json(['orderID' => $order->id]);
    }
}
