<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\OrderDetail;
class OrdersController extends Controller
{

    public function index()
    {
      $orders=Order::paginate(2);
       return view('requests.index',compact('orders'));
    }

    public function show($id)
    {
    	$orders=Order::find($id);
       return view('requests.details',compact('orders'));
    }


  
}
