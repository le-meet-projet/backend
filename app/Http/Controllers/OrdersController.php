<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\User;
use App\Space;
use App\OrderDetail;
class OrdersController extends Controller
{

    public function index()
    {
       $users =User::All();
       $orders=Order::paginate(10);
       return view('requests.index',compact('orders'),['users' => $users]);
    }

    public function show($id)
    {
    	$orders=Order::find($id);
      
    	$users = User::find(3);
    	$sub_total=$orders->price*$orders->hour;
    	$discount=($sub_total*$orders->coupon)/100;
    	$duo_total=$orders->price-$orders->price*$orders->coupon/100;

       return view('requests.details',compact('orders','discount','sub_total','duo_total'), compact('users') );
    }
// public function show($id)
//     {   $f =User::find(3);
//         $orders = Order::find($id);
//               $sub_total=$orders->price*$orders->hour;
//       $discount=($sub_total*$orders->coupon)/100;
//         $produit =Space::All();
      
//         return view('requests.details', compact('f'), compact('sub_total'),compact('orders') )->with('produit', $produit);
//     }

    public function print($id){
          $orders=Order::find($id);
    	
    	$sub_total=$orders->price*$orders->hour;
    	$discount=($sub_total*$orders->coupon)/100;
    	$duo_total=$orders->price-$orders->price*$orders->coupon/100;

       return view('requests.printdetails',compact('orders','discount','sub_total','duo_total'));
    }


  
}
