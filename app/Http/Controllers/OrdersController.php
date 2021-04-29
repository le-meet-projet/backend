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
class OrdersController extends Controller
{

    public function index()
    {
       $users =User::All();
       $orders = \App\OrderLeMeet::with('shared_table','meeting')->paginate(15);
       //dd($orders);
       
       return view('requests.index',compact('orders'),['users' => $users]);
    }

    public function show($id)
    {
    	$orders=OrderLeMeet::find($id);
      //dd($orders);
      
    	$users = User::find(3);
    	$sub_total=$orders->price*$orders->hour;
    	$discount=($sub_total*$orders->coupon)/100;
    	$duo_total=$orders->price-$orders->price*$orders->coupon/100;

       return view('requests.details',compact('orders','discount','sub_total','duo_total'), compact('users') );
    }
 
// public function createPDF() {
//       // retreive all records from db
//       $orders  = Order::all();

//       // share data to view
//       view()->share('orders',$orders );
//       $pdf = PDF::loadView('requests.details', $orders );

//       // download PDF file with download method
//       return $pdf->download('pdf_file.pdf');
//     }
      function get_customer_data($id)
    {
     $orders = DB::table('orders')
         ->limit(10)
         ->get()->where('id','=',$id);
     return $orders;
    }
     
    function get_customer_data_users($id)
    {
     $users = DB::table('users')
         ->limit(10)
         ->get()->where('id','=',$id);
     return $users;
    }

    function createPDF($id)
    {
     $pdf = \App::make('dompdf.wrapper');
     $pdf->loadHTML($this->convert_customer_data_to_html($id));
     return $pdf->stream();
    }

    function convert_customer_data_to_html($id)
    {
     $users = $this->get_customer_data_users($id);
    $order=Order::find($id);
     $orders = $this->get_customer_data($id);
   $sub_total=$order->price*$order->hour;
      $discount=($sub_total*$order->coupon)/100;
      
      $output  = '
        
          <div class="row row-sm">
            <div class="col-md-12 col-xl-12">
              <div class=" main-content-body-invoice">
                <div class="card card-invoice">
                  <div class="card-body">
                    <div class="invoice-header">
                      <h1 class="invoice-title"> Invoice </h1>
                      <div class="billed-from">
                        <h6>  Le Meet Group </h6>
                        <p> Jaddah,Arabia Saudic <br>
                        Tel Number : 324 445-4544<br>
                        Email : lemeet@contact.com</p>
                      </div><!-- billed-from -->
                    </div><!-- invoice-header -->
                    <div class="row mg-t-20">
                      <div class="col-md">
                        <label class="tx-gray-600"> Billed To </label>
                        <div class="billed-to">
                          <h6> </h6>
                          <p> <br>
                          Tel No :  <br>
                           Email :  </p>
                        </div>
                      </div>
                      <div class="col-md">
                        <label class="tx-gray-600"> Invoice Information </label>
                        <p class="invoice-info-row"><span> Invoice No </span> <span> </span></p>
                         
                        <p class="invoice-info-row"><span> Issue Date :</span> <span> </span></p>
                        <p class="invoice-info-row"><span> Due Date :</span><span> </span></p>
                      </div>
                    </div>
                    <div class="table-responsive mg-t-40">
                      <table class="table table-invoice border text-md-nowrap mb-0">
                        <thead>
                          <tr>
                            <th class="wd-20p">  Type  </th>
                            <th class="wd-40p"> Description </th>
                            <th class="tx-center"> Date </th>
                            <th class="tx-right">  Price </th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td> </td>
                            <td class="tx-12"> </td>
                            <td class="tx-center"> </td>
                            <td class="tx-right"> </td>
                          </tr>
                     
                          <tr>
                            <td class="valign-middle" colspan="2" rowspan="4">
                              <div class="invoice-notes">
                                <label class="main-content-label tx-13"> Notes </label>
                                <p> Le meet is a great tool to find your meeting space .... </p>
                              </div> 
                            </td>
                            <td class="tx-right"> Sub-Total </td>
                            <td class="tx-right" colspan="2">{{$discount}} </td>
                          </tr>
                          <tr>
                            <td class="tx-right"> Tax  ( %)</td>
                            <td class="tx-right" colspan="2">'. $discount.'  DH </td>
                          </tr>
                          <tr>
                            <td class="tx-right tx-uppercase tx-bold tx-inverse"> Total Due </td>
                            <td class="tx-right" colspan="2">
                              <h4 class="tx-primary tx-bold"> </h4>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
      ';
  
     
     return $output;
    }
 


  
}
