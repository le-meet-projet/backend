<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderLeMeet;
use App\User;
use App\Space;
use App\Meeting;
use App\Table;
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

    public function gettype()
    {
        $bytype = \DB::table('lemeet_orders')->distinct('type')->pluck('type');
        
        $meetings = \DB::table('order_unit')
            ->join('meetings','meetings.id','order_unit.type_id')
            ->where(function($q){
                $q->where('order_unit.type', 'meeting')
                ->orWhere('order_unit.type', 'office');
            })
            ->groupby('meetings.name')
            ->select(
                'order_date as dates',
                'capacity as capacitys','name',
                DB::raw('count(order_unit.type_id) as total_orders'),
                DB::raw('((capacity) - count(order_unit.type_id)) as rest')
            )
            ->groupby('capacity','order_date','type_id')
            ->get()->groupby('name');

        $tables = \DB::table('order_unit')
            ->join('tables','tables.id','order_unit.type_id')
            ->where('order_unit.type', 'shared_table')
            ->groupby('tables.name')
            ->select(
                'order_date as dates',
                'capacity as capacitys','name',
                DB::raw('count(order_unit.type_id) as total_orders'),
                DB::raw('((capacity) - count(order_unit.type_id)) as rest')
            )
            ->groupby('capacity','order_date','type_id')
            ->get()->groupby('name');
            
        $this->result = $meetings->merge($tables)->toArray();
        
    }

    public function getorderperhours(){
        $meetings = OrderUnit::join('meetings','meetings.id','order_unit.type_id')
            ->where(function($q){
                $q->where('order_unit.type', 'meeting')
                ->orWhere('order_unit.type', 'office');
            })
            ->get();

        $tables = OrderUnit::join('tables','tables.id','order_unit.type_id')
            ->where('order_unit.type', 'shared_table')
            ->get();
        
        $spaces = [];
        foreach($tables->groupby('type_id')->toArray() as $id => $table){
            $spaces[$id] = $table;
        }
        foreach($meetings->groupby('type_id')->toArray() as $id => $meeting){
            $spaces[$id] = $meeting;
        }
        $this->result2 = $spaces;
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
        return view('providers.time', compact('orders'));
    }

    public function send(){
        $orders = $this->result;
        foreach($orders as $meeting => $order){
            if(Table::where('name', $meeting)->count()){
                $orders[$meeting]['type'] = 'table';
            }else{
                $orders[$meeting]['type'] = 'meeting';
            }
        };

        foreach($orders as $meeting => $order){
            if($order['type'] == 'table'){
                $ownedMeeting = Table::where('name', $meeting)->where('id_brand', \Auth::user()->brand->id)->get();
            }else{
                $ownedMeeting = Meeting::where('name', $meeting)->where('id_brand', \Auth::user()->brand->id)->get();
            }
            if(!count($ownedMeeting)){
                unset($orders[$meeting]);
            };
        };
        foreach($orders as $brand => $order){
            unset($order['type']);
            $orders[$brand] = $order;
        }

        $ownedMeetings = Meeting::where('id_brand', \Auth::user()->brand->id)->get();
        $ownedTables = Table::where('id_brand', \Auth::user()->brand->id)->get();
        $ownedSpaces = $ownedMeetings->merge($ownedTables);
        $existSpaces = [];
        foreach($ownedSpaces as $space){
            $existSpaces[$space->id] = $space->name;
        }
        
        foreach($existSpaces as $existSpace){
            if(!in_array($existSpace, array_keys($orders))){
                $orders[$existSpace] = [];
            };
        }

        $nextWeekDays = [];
        for($i = 7; $i >= 0; $i--){
            array_push($nextWeekDays, \Carbon\Carbon::today()->addDays($i)->format('Y-m-d'));
        }

        foreach($orders as $brand => $order){
            foreach($order as $index => $or){
                if(!in_array($or->dates, $nextWeekDays)){
                    unset($order[$index]);
                };
                $orders[$brand] = $order;
            }
        }
        
        foreach($orders as $brand => $order){
            $exist[$brand] = [];
            $notExists[$brand] = [];
            foreach($order as $or){
                array_push($exist[$brand], $or->dates);
            }
            $notExists[$brand] = array_diff($nextWeekDays, $exist[$brand]);
        }

        

        foreach($orders as $brand => $order){
            foreach($notExists[$brand] as $notExist){
                array_push($order, (object)[
                    'dates' => $notExist,
                    'total_orders' => 0,
                    'name' => $brand
                ]);
            }
            $orders[$brand] = $order;
        }

        foreach($orders as $brand => $order){
            if($brand == 'type') continue;
            foreach($order as $i => $or){
                usort($order, function($element1, $element2) {
                    $date1 = strtotime($element1->dates);
                    $date2 = strtotime($element2->dates);
                    return $date1 - $date2;
                } );
            }
            $orders[$brand] = $order;
        }

        $orders2 = $this->result2;
        foreach($orders2 as $meeting => $order){
            foreach($order as $or){
                if($or['type'] == 'shared_table'){
                    $ownedMeeting = Table::where('name', $or['name'])->where('id_brand', \Auth::user()->brand->id)->get();
                }else{
                    $ownedMeeting = Meeting::where('name', $or['name'])->where('id_brand', \Auth::user()->brand->id)->get();
                }
                if(!count($ownedMeeting)){
                    unset($orders2[$meeting]);
                };
            }
        };
        foreach($existSpaces as $id => $existSpace){
            if(!in_array($id, array_keys($orders2))){
                $orders2[$id] = [];
                array_push($orders2[$id], [
                    'id' => $id,
                    'name' => $existSpace,
                    'order_date' => null
                ]);
            };
        }

        $spaces = [];
        foreach($orders2 as $meeting => $order){
            foreach($order as $index => $or){
                $today = Carbon::today()->toDateString();
                if($or['order_date'] != $today){
                    $spaces[$or['id']] = $or['name'];
                    unset($order[$index]);
                }
                $orders2[$meeting] = $order;
            }
        };
        
        $dayHours = [];
        for($i = 18; $i >= 9; $i--){
            if($i < 10) $i = '0'.$i;
            array_push($dayHours, \Carbon\Carbon::today()->format('Y-m-d') . ' ' . $i . ':00:00');
        }

        foreach($orders2 as $index => $order){
            foreach($order as $i => $or){
                if($or['type'] == 'shared_table'){
                    $owned = Table::where('id', $or['id'])->where('id_brand', \Auth::user()->brand->id)->get();
                }else{
                    $owned = Meeting::where('id', $or['id'])->where('id_brand', \Auth::user()->brand->id)->get();
                }
                if(!count($owned)){
                    unset($order[$i]);
                };
            }
            $orders2[$index] = $order;
        }
        
        foreach($orders2 as $index => $order){
            $existHours[$index] = [];
            $notExistsHours[$index] = [];
            foreach($order as $or){
                array_push($existHours[$index], $or['order_from']);
            }
            $notExistsHours[$index] = array_diff($dayHours, $existHours[$index]);
        }

        foreach($orders2 as $index => $order){
            foreach($notExistsHours[$index] as $notExist){  
                array_push($order, [
                    'id' => 'not found',
                    'name' => $order[0]['name'] ?? $spaces[$index],
                    'dates' => $notExist,
                    'order_from' => $notExist
                ]);
            }
            $orders2[$index] = $order;
        }

        foreach($orders2 as $index => $order){
            foreach($order as $i => $or){
                usort($order, function($element1, $element2) {
                    $date1 = strtotime($element1['order_from']);
                    $date2 = strtotime($element2['order_from']);
                    return $date1 - $date2;
                } );
            }
            $orders2[$index] = $order;
        }
        
        return view('providers.days', compact('orders2','orders'));
    }

    public function orderDetails(Request $request)
    {
        $unitOrders = OrderUnit::where(
            function($q) use ($request){
                $q->where(
                    function($q) use ($request){
                        $q->whereHas('meeting', function($q) use ($request){
                            $q->whereHas('brand', function ($q) use ($request){
                                $q->where('name', \Auth::user()->name);
                            })->where('name', $request->name);
                        })->where(function($q){
                            $q->where('type', 'meeting')
                            ->orWhere('type', 'office');
                        });
                    }
                )->orWhere(
                    function($q) use ($request){
                        $q->whereHas('table', function($q) use ($request){
                            $q->whereHas('brand', function ($q){
                                $q->where('name', \Auth::user()->name);
                            })->where('name', $request->name);
                        })->where('type', 'shared_table');
                    }
                );
            }
        )->where('order_date', $request->date)->get();

        return view('providers.order-details', compact('unitOrders'));
    }

    public function invoice(){
        $orders = OrderLeMeet::where(
            function($q){
                $q->whereHas('meeting', function($q){
                    $q->whereHas('brand', function ($q) {
                        $q->where('name', \Auth::user()->name);
                    });
                })->where(function($q){
                    $q->where('type', 'meeting')
                    ->orWhere('type', 'office');
                });
            }
        )->orWhere(
            function($q){
                $q->whereHas('shared_table', function($q){
                    $q->whereHas('brand', function ($q) {
                        $q->where('name', \Auth::user()->name);
                    });
                })->where('type', 'shared_table');
            }
        )->get();
        
        $meetings = [];
        $tables = [];
        foreach($orders as $order){
            if(in_array($order->type, ['meeting', 'office'])){
                array_push($meetings, $order->meeting);
            }else{
                array_push($tables, $order->shared_table);
            };
        }
        
        $orders = collect($meetings)->merge($tables);

        $result = [];
        foreach($orders as $order){
            if(!is_null($order)){
                !isset($result[$order->created_at->year][$order->created_at->month]) && $result[$order->created_at->year][$order->created_at->month] = [];
                array_push($result[$order->created_at->year][$order->created_at->month], $order->toArray());
            }
        }
        
        $earnings = [];
        foreach($result as $index => $month){
            ksort($month);
            foreach($month as $i => $orders){
                $total = 0;
                foreach($orders as $order){
                    $total += ($order['percent'] * $order['price']) / 100;
                }
                $earnings[$index][$i] = $total;
            }
        }

        $currentMonthIncome = 0;
        foreach($earnings as $index => $year){
            foreach($year as $i => $month){
                str_contains(Carbon::now()->format('m'), $i) && strpos($index, Carbon::now()->format('Y')) !== false && $currentMonthIncome = $month;
            }
        }

        return view('providers.invoice', compact('earnings', 'currentMonthIncome'));
    }

    public function wallet(){
        $total = OrderLeMeet::where(
            function($q){
                $q->whereHas('meeting', function($q){
                    $q->whereHas('brand', function ($q) {
                        $q->where('name', \Auth::user()->name);
                    });
                })->where(function($q){
                    $q->where('type', 'meeting')
                    ->orWhere('type', 'office');
                });
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
        ->select(DB::raw('sum(price) as price'), DB::raw("DATE_FORMAT(created_at,'%m %Y') as Months") )
        ->groupby('Months')->orderBy('Months')->get();

        foreach($total as $t){
            strpos($t->Months, Carbon::now()->format('m')) !== false && strpos($t->Months, Carbon::now()->format('Y')) !== false && $currentMonthIncome = $t->price;
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
        })->where(function($q){
            $q->where('order_unit.type', 'meeting')
            ->orWhere('order_unit.type', 'office');
        })->get();

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