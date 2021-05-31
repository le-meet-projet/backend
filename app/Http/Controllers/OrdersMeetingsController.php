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
        $spaces = \DB::table('order_unit')->join('meetings','meetings.id','order_unit.type_id')->where('order_date','>=',$date)->groupby('meetings.name')->select('order_date as dates', 'capacity as capacitys','name', DB::raw('count(order_unit.type_id) as total_orders') , DB::raw(' ((capacity) - count(order_unit.type_id)) as rest'))->groupby('capacity','order_date','type_id')->get()->groupby('name')->toArray();

        // get week days
        $week =  [];
        for($i=0;$i<7;$i++){
           $name = today()->subDays($i)->locale('ar')->dayName;
           $day  = today()->subDays($i)->toDateString();
           $week[$day] = $name;
        }   

        global $result;
        $result = [];

        $new = collect($spaces)->map(function($space,$space_name) use($week){

            $available = collect($space)->values();


            global $result;
            $days = collect($space)->map(function($date) use($week) {

                if( ! isset($week[$date->dates])){
                    return  [
                        "dates" => $date->dates,
                        "capacitys" => 0,
                        "name" => NULL,
                        "total_orders" => NULL,
                        "rest" => NULL,
                    ];
                }
                return $date;
            })->toArray();
            return  $days;
        });


        $date = \Carbon\Carbon::today()->subDays(7);

        $values = \DB::table('order_unit')->join('meetings','meetings.id','order_unit.type_id')->where('order_date','>=',$date)->groupby('meetings.name')->select('order_date as dates', 'capacity as capacitys','name', DB::raw('count(order_unit.type_id) as total_orders') , DB::raw(' ((capacity) - count(order_unit.type_id)) as rest'))->groupby('capacity','order_date','type_id')->get()->groupby('name')->toArray();

        $this->result = $values;
        
    }

    public function getorderperhours(){
        $date = \Carbon\Carbon::now()->format('Y-m-d');
        $values = \DB::table('order_unit')->join('meetings','meetings.id','order_unit.type_id')->where('order_date','>=',$date)->distinct(['order_date'])->get()->groupby('type_id')->toArray();
        
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
        $orders2 = $this->result2 ;
        Carbon::setLocale("ar");
        $weekdays = Carbon::getDays();
        $test = Carbon::create(\Carbon\Carbon::today()->subDays(0)->format('d-m-Y'))->locale('ar')->dayName;
        
        //dd($test);
        return view('providers.days', compact('orders2','orders'));
    }

    public function invoice(){
        $orders = $this->result;
        return view('providers.invoice', compact('orders'));
    }

    public function whallet(){
        $total = DB::table('lemeet_orders')->where('user_id',Auth::user()->id)->select(DB::raw('sum(price) as price'), DB::raw("DATE_FORMAT(created_at,'%M %Y') as Months") )->groupby('Months')->get();
        $sum =  DB::table('lemeet_orders')->where('user_id',Auth::user()->id)->sum('price');
        return view('providers.mihfada', compact('total','sum'));
    }

    public function rating(){
        $reviews = Review::join('meetings','meetings.id_brand','reviews.brand_id')->where('reviews.user_id',Auth::user()->id)->get();
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


}