<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Order;
use App\Space;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       $users=User::count();
        $orders=Order::count();
        $workshops=Space::where('type','workshop')->count();
        $meeting=Space::where('type','meeting')->count();
        return view('dashboard',compact('users','orders','workshops','meeting'));
    }
}
