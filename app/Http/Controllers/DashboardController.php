<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Space;

class DashboardController extends Controller
{
       public function home() {
            
        $users=User::count();
        $orders=Order::count();
        $workshops=Space::where('type','workshop')->count();
        $meeting=Space::where('type','meeting')->count();
        return view('dashboard',compact('users','orders','workshops','meeting'));
    }  



}
