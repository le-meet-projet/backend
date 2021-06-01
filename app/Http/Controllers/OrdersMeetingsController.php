<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderLeMeet;
use App\User;
use App\Space;
use App\OrderDetail;
use PDF;
use DB;
use App\SpaceDetails;
use App\OrderUnit;
use App\Workshop;
use Carbon\Carbon;
use App\Review;
use Auth;
use Illuminate\Support\Facades\Hash;

class OrdersMeetingsController extends Controller{

    public $OrderLeMeet;

    public $result = [];
    public $result2 = [];
    public $orders; 
    public $capacity; 


    public function __construct(){
        $this->gettype();
        $this->getorderperhours();
    }

    public function login(){
        return view('providers.auth.login');
    }

    public function doLogin(Request $request){
        

    if (\Auth::guard()->attempt(['role'=>'brand', 'email' => $request->email, 'password' => $request->password])) {
        return redirect()->route('merchant.orders');
    }
    return redirect()->route('merchantlogin');


    }

    public function profile(){
        return view('providers.users.profile');
    }

    public function gettype(){
        
        $bytype = \DB::table('lemeet_orders')->distinct('type')->pluck('type');

        $date = \Carbon\Carbon::today()->subDays(7);
        
        $values = \DB::table('order_unit')
            ->join('meetings','meetings.id','order_unit.type_id')
            ->where('order_unit.type', 'meeting')
            ->where('order_date','>=',$date)
            ->groupby('meetings.name')
            ->select(
                'order_date as dates',
                'capacity as capacitys','name',
                DB::raw('count(order_unit.type_id) as total_orders'),
                DB::raw('((capacity) - count(order_unit.type_id)) as rest')
            )
            ->groupby('capacity','order_date','type_id')
            ->get()->groupby('name')->toArray();

        $this->result = $values;
        
    }

    public function getorderperhours(){
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $values = \DB::table('order_unit')
            ->join('meetings','meetings.id','order_unit.type_id')
            ->where('order_unit.type', 'meeting')
            ->where('order_unit.type', 'meeting')
            ->where('order_date','>=',$date)
            ->distinct(['order_date'])
            ->get()->groupby('type_id')->toArray();
        
        $this->result2 = $values;
    }

    public function getDays(){
        /*for($i = 0 ; $i<=6 ; $i++){
           $result[] =  [
                        "dayname" => "الأحد",
                        "capacity" => $this->capacity(),
                        "orders" => $this->orders(),
                        "date" => "07/07/2021",
                        "time" => "10:30",
                        "rest" => $this->rest(),
                        "persent" => $this->percent(),
            ];
        }*/
           $result[] = \DB::table('order_unit')->get()->pluck('order_date')->unique('order_date')->toArray();
        //dd($result);
        return $result;
    }


    public function percent(){
        return ( $this->orders * ($this->capacity / 100) ) * 100  . '%' ;
    }

    public function rest(){
        return $this->capacity - $this->orders;
    }

    public function capacity(){
        $capacity = 10;
        $this->capacity = $capacity;
        return $capacity; 
    }

    public function orders(){
        $orders = 8;
        $this->orders = $orders;
        return $orders;
    }

    public function get(){
        $orders = $this->result2;
       // dd($orders);
        return view('providers.time', compact('orders'));
    }

    public function send(){
        $orders = $this->result;
        foreach($orders as $meeting => $order){
            $owned = \App\Meeting::where('name', $meeting)->where('id_brand', \Auth::user()->id)->get();
            if(!count($owned)){
                unset($orders[$meeting]);
            };
        }
        $orders2 = $this->result2;
        foreach($orders2 as $meeting => $order){
            foreach($order as $index => $ord){
                $owned = \App\Meeting::where('name', $ord->name)->where('id_brand', \Auth::user()->id)->get();
                if(!count($owned)){
                    unset($orders2[$meeting]);
                };
            }
        }
        
        return view('providers.days', compact('orders2','orders'));
    }

    public function invoice(){
        $orders = $this->result;
        return view('providers.invoice', compact('orders'));
    }

    public function whallet(){
        $total = OrderLeMeet::where(
            function($q){
                $q->whereHas('meeting', function($q){
                    $q->whereHas('brand', function ($q) {
                        $q->where('name', \Auth::user()->name);
                    });
                })->where('type', 'meeting')
                ->orWhere('type', 'office');
            }
        )->orWhere(
            function($q){
                $q->whereHas('shared_table', function($q){
                    $q->whereHas('brand', function ($q) {
                        $q->where('name', \Auth::user()->name);
                    });
                })->where('type', 'shared_table');
            }
        )
        ->select(DB::raw('sum(price) as price'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as Months") )
        ->groupby('Months')->get();

        foreach($total as $t){
            strpos($t->Months, Carbon::now()->format('F')) !== false && $currentMonthIncome = $t->price;
        }

        return view('providers.mihfada', compact('total', 'currentMonthIncome'));
    }

    public function rating(){
        $reviews = Review::with('user')->where('reviews.brand_id',Auth::user()->id)->get();
        return view('providers.rating', compact('reviews'));
    }

    public function profileEdit(Request $request){
        $id = \Auth::user()->id;
        $data = array();
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = \public_path('/users');
            $image->move($destinationPath, $name);
            $data['avatar'] = $name;
        }
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['password'] = $request->address;
        $data['password'] = Hash::make($request->password);

        User::where('id',$id)->update($data);

        return back();

    }

    public function brandOrders()
    {
        $tables = OrderUnit::whereHas('table', function($q){
            $q->whereHas('brand', function ($q) {
                $q->where('name', \Auth::user()->name);
            });
        })->where('type', 'shared_table')->get();

        $meetings = OrderUnit::whereHas('meeting', function($q){
            $q->whereHas('brand', function ($q) {
                $q->where('name', \Auth::user()->name);
            });
        })->where('type', 'meeting')
        ->orWhere('type', 'office')->get();

        $tablesTotalIncome = 0;
        $meetingsTotalIncome = 0;
        foreach($tables as $table){
            $tablesTotalIncome += $table->table->price;
        }
        foreach($meetings as $meeting){
            $meetingsTotalIncome += $meeting->meeting->price;
        }
        
        $orders = $meetings->merge($tables);
        $totalIncome = $tablesTotalIncome + $meetingsTotalIncome;
        
        return view('providers.orders', compact('orders', 'totalIncome'));
    }


}