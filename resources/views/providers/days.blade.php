<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
        <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@800&display=swap" rel="stylesheet">
        <link href="{{ asset('/css/lemeet.css')}}" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                  <form class="d-flex">
                    <h2><i class="bi bi-person-fill"></i>حسابي</h2>
                  </form>
                    <div class="logo">
                    <a  href="{{ route('merchant.orders')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                    </div>
                    <div class="form-group role-selector">
                        <label class="form-switch">
                            <span class="lab1">ساعات</span>
                            <input name="subscribe" type="checkbox" class="custom-control-input condition-trigger" id="customSwitch1">
                            <i></i>
                            <span class="lab2">ايام</span>
                          </label>
                    </div>
                </div>
              </nav>
        </header>
        
        <div class="contant">
            <table class="table" id="time"  data-condition="subscribe" data-condition-value="0">
                <thead>
                    <th class="th2" colspan="1"><strong>القاعات</strong></th>
                    <th class="th1" colspan="10"><strong>الحجوزات</strong></th>
                </thead>
                <thead>
                    <th class="text-center" colspan="1"></th>
                    <th class="th1 pad" colspan="8">
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(0)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(0)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(1)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(1)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(2)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(2)->format('d-m-Y'))->locale('ar')->dayName }}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(3)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(3)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(4)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(4)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(5)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(5)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(6)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(6)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                        <div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->addDays(7)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->addDays(7)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                    </th>
                </thead>
                <tbody class="bod">
                    @foreach($orders as $v_order)
                        <tr>
                            @foreach($v_order as $days)
                                @if ($loop->first)                         
                                    <td class="hours">
                                        <img src="{{$days->thumbnail ?? no_image()}}" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                                        <div class="name-salle">
                                            {{ $days->name}}
                                        </div>
                                    </td>
                                @endif
                                <td class="days">
                                    @if($days->total_orders)
                                        <a  href="{{ route('merchant.orders-hours', ['id' => $days->id, 'date' => $days->dates]) }}"
                                            style="color: #FFF;"
                                        >
                                            <div class="booking positive">
                                                <div class="nbb-booking">
                                                    <div class="border-booking">
                                                        <div class="conf">{{ $days->total_orders}}</div>
                                                    </div>
                                                    <h6>
                                                        محجوز
                                                    </h6>
                                                </div>
                                            </div>
                                        </a>
                                    @else
                                        <div class="booking">
                                            <div class="nbb-booking">
                                                <div class="border-booking">
                                                    <div class="conf">{{ $days->total_orders}}</div>
                                                </div>
                                                <h6>غير محجوز</h6>
                                            </div>
                                        </div>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
              </table>
              
               <div class="table" id="days" data-condition="subscribe" data-condition-value="1">
                   <div class="head" style="display: -webkit-inline-box;">
                       <div class="text-center l9a3at" style="width:10%;"><strong>القاعات</strong></div>
                       <div class="text-center lhojozat" style="width:90%;"><strong>الحجوزات</strong></div>
                   </div>
                   @foreach($orders2 as $key => $v_order) 
                   <div class="table">
                       <div class="col-lg-12" style="display: inline-flex;">
                        @foreach($v_order as $order)
                            @if($loop->first)
                            <div class="col-lg-2 col-xs-2 card-img">
                                <div class="">
                                    <td class="hours">
                                        <img src="{{ $order['thumbnail'] }}" style="width: 100%; height: 102px;">
                                        <div class="name-lka3a">
                                        {{ $order['name'] }}
                                        </div>
                                    </td>
                                </div>
                            </div>
                            @endif
                            
                            @if($order['id'] == 'not found')
                                <div class="" style="display: flex; width: 10%">
                                    <div class="col-xs-12 col-sm-12 card">
                                        <td class="hours">
                                            <div class="booking" style="background-color: #FFF;">
                                                <div class="days-booking-1">
                                                    <div class="nb-booking">
                                                    <h6 style="color: #336e7c;">غير محجوز</h6>
                                                    </div>
                                                </div>
                                                
                                                <div class="seconddiv">
                                                    <span class="name-day">{{ explode(' ', $order['order_from'])[1] }} </span><br>
                                                    <span class="date">{{ explode(' ', $order['order_from'])[0] }} </span>
                                                </div>
                                            </div>
                                        </td>
                                    </div>
                                </div>
                            @else
                                <div class="" style="display: flex; width: 10%">
                                    <div class="col-xs-12 col-sm-12 card">
                                        <td class="hours">
                                            <div class="booking" id="details" data-date="{{ $order['order_date'] }}" data-from="{{ explode(' ', $order['order_from'])[1] }}" data-name="{{ $order['name'] }}" pd-popup-open="popupNew">
                                                <div class="days-booking-1">
                                                    <div class="nb-booking">
                                                        <h6><a>رقم الحجز:<br> {{ $order['order_id'] }}</a></h6>
                                                    </div>
                                                </div>
                                                
                                                <div class="seconddiv">
                                                    <span class="name-day">{{ explode(' ', $order['order_from'])[1] }} </span><br>
                                                    <span class="date">{{ $order['order_date'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                       </div>
                   </div>
                   @endforeach
               </div>
        </div>
        <nav class ="navbar navb  bg-light">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('merchant.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                    <li><a href="{{ route('merchant.wallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                    <li><a href="{{ route('merchant.orders')}}" class="active"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                    <li><a href="{{ route('merchant.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Modal -->
        <div class="popup" pd-popup="popupNew">
            <div class="popup-inner">
            
            </div>
        </div>
            
        <script src="{{ asset('js/lemeet.js') }}"></script>
    </body>
</html>