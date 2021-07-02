

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


        <style>
            .l9a3at,
            .lhojozat{
                font-size: 24px;
            }

            th.th2,
            .l9a3at {
                background: white !important;  
                background: white !important;
                color: #336e7c !important;
            }

            th.th1,
            .lhojozat {
                background: white !important;
                color: #336e7c !important;
            }

            table thead th:last-child strong {
                background: white !important;
                color: #336e7c !important;
            }
        </style>


    </head>
    <body>
        <header>
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                  <form class="d-flex">
                    <h2><i class="bi bi-person-fill"></i>حسابي</h2>
                  </form>
                    <div class="logo">
                    <a  href="{{ route('manager.index')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
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
                                        <img src="{{$days->thumbnail ?? no_image() }}" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                                        <div class="name-salle">
                                            {{ $days->name}}
                                        </div>
                                    </td>
                                @endif
                                <td class="days">
                                    @if($days->total_orders)
                                        <a  href="{{ route('manager.orders-hours', ['id' => $days->id, 'date' => $days->dates]) }}"
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
                    <li><a href="{{ route('manager.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong></a></li>
                    <li><a href="{{ route('manager.wallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong></a></li>
                    <li><a href="{{ route('manager.index')}}" class="active"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                    <li><a href="{{ route('manager.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong></a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Modal -->
        <div class="popup" pd-popup="popupNew">
            <div class="popup-inner">
            
            </div>
        </div>
        <style>
            .navb{
                position: fixed !important;
                bottom: 0 !important;
                width: 100% !important;
            }
            .name-salle{
                margin-right: 25px !important;
            }
            .head{
                width: 100%;
            }
            a{
                text-decoration: none;
            }
            .table-td{
                width: 10%;
            }
            .booking {
                background: #336e7c;
            }
            .bod .booking{
                background: #FFF;
                border: 2px #336e7c solid;
            }
            .bod .booking.positive{
                background: #336e7c;
            }
            .bod .booking h6{
                color: #336e7c;
            }
            .bod .booking.positive h6{
                color: #FFF;
            }
            .name-lka3a{
                text-align: center;
                background: #2a5d6a;
                color: #fff;
            }
            .scrolling-wrapper {
                overflow-x: scroll;
                overflow-y: hidden;
                white-space: nowrap;
                .card {
                    display: inline-block;
                }
            }
             .scrolling-wrapper {
                 -webkit-overflow-scrolling: touch;
             }
             .lhojozat > strong {
                 display: block;
                 border: 1px solid;
                 position: relative;
                 right: 9px;
                 line-height: 47px;
                 width: calc(100% - 19px) !important;
             }
             .l9a3at  strong {
                 display: block;
                 border: 1px solid;
                 position: relative;
                 right: 9px;
                 line-height: 47px;
                 width: calc(96% - 19px) !important;
             }
             .card-img{
                  max-width: 10%;
             }
             @media only screen and (max-width: 1024px) {
                 .card-img {
                      max-width: 20%;
                 }
                 .l9a3at{
                     width: 20% !important;
                 }
                 .lhojozat{
                     width: 80% !important;
                 }
                 img{
                     width: 164px !important;
                 }
                 .lhojozat > strong {
                     width: calc(115% - 19px) !important;
                     height: 60px;
                 }
                 .table-td{
                     width: 20% !important;
                 }
             }
             header {
                 padding-right: 69px !important;
                 padding-left: 0 !important;
                 width: 100%;
             }
             .hov:hover{
                 background-color: #336e7c;
                 color:#fff;
                 border-color: #336e7c;
             }
             strong.hov {
                 font-size: 1.5rem !important;
             }
             .form-switch input + i + .lab2 {
                 color: #2a5d6a !important;
             }
             .lab1 + .form-switch input:checked + i {
                 color: #2a5d6a !important;
             }
              .booking{
                  height: 90px;
              }
              .pad{
                  padding-top:10px !important;
              }
              .clickday{
                  background: #336e7c;
                  width: 92%;
                  margin-right: 5%;
                  color: #fff;
              }

              div#details {
                    cursor: pointer;
            }

               </style>
            
            
              
            <!-- Trigger the modal with a button -->
<script>
    $(function() {
    //----- OPEN
    $('[pd-popup-open]').on('click', function(e)  {
        var targeted_popup_class = jQuery(this).attr('pd-popup-open');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
 
        e.preventDefault();
    });
 
    //----- CLOSE
    $('[pd-popup-close]').on('click', function(e)  {
        console.log("Closed");
        var targeted_popup_class = jQuery(this).attr('pd-popup-close');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);
 
        e.preventDefault();
    });
});

(function($){

$.fn.conditionalFields = function (action) {
    var $base = $(this);
    function toggle_field($field, trigger_value, val) {
        if ($.inArray(trigger_value, val) !== -1) {
            if ($field.css('display') === 'none')
                $field.slideDown(1);
        }
        else {
            if ($field.css('display') !== 'none') {
                $field.slideUp(1);
            }
        }
    }
    function update_fields() {
        var $fields = $base.find('[data-condition][data-condition-value]');
        var $field, condition, condition_values, $trigger, trigger_value;
        $.each($fields, function () {
            $field = $(this);
            condition = $field.attr('data-condition');
            condition_values = $field.attr('data-condition-value').toString().split(';');
            $trigger = $('[name="' + condition + '"]');
            if($trigger.is('[type="radio"]')){
                $trigger = $('[name="' + condition + '"]:checked');
            }
            if ($trigger.length) {
                if($trigger.length === 1){
                    trigger_value = $trigger.val().toString();
                    if($trigger.is('[type="checkbox"]')){
                        trigger_value = $trigger.prop( "checked" ) ? '1' : '0';
                    }
                    toggle_field($field, trigger_value, condition_values);
                }
                else {
                    var or = '0';
                    var and = '1';
                    $.each($trigger, function (id, trigger_instance) {
                        trigger_value = $(trigger_instance).val().toString();
                        if($trigger.is('[type="checkbox"]')){
                            trigger_value = $trigger.prop( "checked" ) ? '1' : '0';
                        }
                        if ($.inArray(trigger_value, condition_values) !== -1) {
                            or = '1';
                        }
                        else {
                            and = '0';
                        }
                    });
                    if($field.hasClass('condition-logical-or')){
                        trigger_value = or;
                    }
                    else {
                        trigger_value = and;
                    }
                    toggle_field($field, trigger_value, ['1']);
                }
            }
            else {
                if ($field.css('display') !== 'none'){
                    $field.slideUp(500);
                }
            }
        });
    }
    function init_events(){
        $base.on('change', '.condition-trigger', function () {
            update_fields();
        });
        $base.on('click', '.condition-trigger-delayed', function () {
            var delay = $(this).attr('data-delay');
            setTimeout(function () {
                update_fields();
            }, delay);
        });
    }
    if(action === 'init'){
        init_events();
        update_fields();
    }
    if(action === 'update'){
        update_fields();
    }
}

}(jQuery));
</script>
<script>
    $(function(){
        $('body').conditionalFields('init');

        $(document).ready(function() {
        $('div#details').click(function(e) {
            const token = $('meta[name="csrf-token"]').attr('content');
            const date = $(this).attr('data-date');
            const from = $(this).attr('data-from');
            const name = $(this).attr('data-name');

            var formData = new FormData();
            formData.append('_token', token);
            formData.append('date', date);
            formData.append('from', from);
            formData.append('name', name);

            $.ajax({
                url: '/manager/order-details',
                type: 'POST',
                processData: false, // important
                contentType: false, // important
                data: formData,
                cache: false,
                dataType: "HTML",
                success: function (response) {
                    $('body .popup .popup-inner').html(response);
                },
                error: function (response) {
                    console.log('error');
                    console.log(response);
                }
            });
        });
    });
    });
</script>
    </body>
</html>