<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use DB;
class OrdersController extends Controller
{
    public function index()
    {
      $orders=Order::paginate(2);
  
    
      
       return view('requests.index',compact('orders'));
    }
    public function show()
    {
       return view('requests.details');
    }


  
}
