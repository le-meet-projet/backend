<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
       return view('requests.index');
    }
    public function show()
    {
       return view('requests.details');
    }
}
