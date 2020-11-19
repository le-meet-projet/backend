<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\JsonResponse;

class OrdersApiController extends Controller
{
    public function index()
    {
        $orders = Order::paginate(10);
        return new JsonResponse([
            'orders' => $orders
        ]);
    }

    public function show($id)
    {
    	$orders=Order::find($id);
    	
    	$sub_total=$orders->price*$orders->hour;
    	$discount=($sub_total*$orders->coupon)/100;
    	$duo_total=$orders->price-$orders->price*$orders->coupon/100;

        return new JsonResponse([
            'orders' => $orders,
            'discount' => $discount,
            'sub_total' => $sub_total,
            'duo_total' => $duo_total
        ]);
    }
}
