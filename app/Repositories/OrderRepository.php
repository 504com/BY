<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

class OrderRepository
{
    /**
     * @param array $data
     * @param \DateTime $orderDate
     * @param $user Id of the customer
     * @param int $service Default: booking service (2)
     * @return Order
     */
    public function createOrder(array $data, \DateTime $orderDate, $user, $service = Service::BOOKING)
    {
        return Order::create([
            'customer_id' => $user,
            'service_id' => $service,
            'restaurant_id' => $data['id'],
            'order_date' => $orderDate,
            'details' => $data['details']
        ]);
    }

    /**
     * @param Order $order
     * @param array $products
     */
    public function createOrderLines(Order $order, array $products)
    {
        foreach ($products as $productId => $quantity) {
            $order->products()->attach($productId, ['quantity' => $quantity]);
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getTotal($id)
    {
        return Order::where('orders.id', $id)
            ->select(DB::raw("SUM(quantity * price) AS total"))
            ->join('orderlines', 'orders.id', '=', 'orderlines.order_id')
            ->join('products', 'products.id', '=', 'orderlines.product_id')
            ->first();
    }
}
