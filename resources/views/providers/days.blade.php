

<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
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
                    <a  href="{{ route('merchant.orders')}}"><img src="{{ asset('/public/assets/img/lemeet.PNG')}}" /></a>
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
                    <th class="th1 pad" colspan="7"><div class="dayshead"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(6)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(6)->format('d-m-Y'))->locale('ar')->dayName}}</div></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(5)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(5)->format('d-m-Y'))->locale('ar')->dayName}}</div></a></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(4)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(4)->format('d-m-Y'))->locale('ar')->dayName }}</div></a></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(3)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(3)->format('d-m-Y'))->locale('ar')->dayName}}</div></a></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(2)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(2)->format('d-m-Y'))->locale('ar')->dayName}}</div></a></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(1)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(1)->format('d-m-Y'))->locale('ar')->dayName}}</div></a></div>
                    <div class="dayshead"><a href="#"><div class="clickday">{{ \Carbon\Carbon::today()->subDays(0)->format('d-m-Y')}} {{ \Carbon\Carbon::create(\Carbon\Carbon::today()->subDays(0)->format('d-m-Y'))->locale('ar')->dayName}}</div></a></div></th>
                </thead>
                <tbody class="bod">
                    @foreach($orders as $v_order)
                        <tr>
                            @foreach($v_order as $days)
                                @if ($loop->first)                         
                                    <td class="hours">
                                        <img src="{{ asset('/public/image/salle1.jpg') }}" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                                        <div class="name-salle">
                                            {{ $days->name}}
                                        </div>
                                    </td>
                                @endif
                                <td class="days">
                                    <div class="booking">
                                        <div class="nbb-booking">
                                            <div class="border-booking">
                                                <div class="conf"><a></a>{{ $days->total_orders}}</div>
                                            </div>
                                            <h6 href=""><a  pd-popup-open="popupNew"> محجوز</a></h6>
                                        </div>
                                        <div class="seconddiv">
                                        </div>
                                    </div>
                                </td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
              </table>
              
               <div class="table" id="days" data-condition="subscribe" data-condition-value="1">
                   <div class="head" style="display: -webkit-inline-box;">
                       <div class="text-center l9a3at" style="width:10%;"><strong class="hov">القاعات</strong></div>
                       <div class="text-center lhojozat" style="width:90%;"><strong class="hov">الحجوزات</strong></div>
                   </div>
                   @foreach($orders2 as $key => $v_order) 
                   <div class="table">
                       <div class="col-lg-12" style="display: inline-flex;">
                        @foreach($v_order as $order)
                            @if($loop->first)
                            <div class="col-lg-2 col-xs-2 card-img">
                                <div class="">
                                    <td class="hours">
                                        <img src="{{ asset('/public/image/salle1.jpg') }}" style="width: 151px;">
                                        <div class="name-lka3a">
                                        قاعة المكان
                                         </div>
                                    </td>
                                </div>
                            </div>
                            @endif
                           <div class="col-lg-11 scrolling-wrapper MagicScroll" style="display: flex;" data-options="width: 640; items: 3; step: 2;">
                                <div class="col-xs-12 col-sm-12 table-td card">
                                    <td class="hours">
                                        <div class="booking">
                                            <div class="days-booking-1">
                                                <div class="nb-booking">
                                                    <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 201</a></h6>
                                                </div>
                                            </div>
                                            
                                            <div class="seconddiv">
                                                <span class="name-day"><span>ص</span>09:00 </span><br>
                                                <span class="date">03/01/2021</span>
                                            </div>
                                        </div>
                                    </td>
                                </div>
                           </div>
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
                    <li><a href="{{ route('merchant.whallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                    <li><a href="{{ route('merchant.orders')}}" class="active"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                    <li><a href="{{ route('merchant.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- Modal -->
        <div class="popup" pd-popup="popupNew">
            <div class="popup-inner">
                <h1>تفاصيل الحجز</h1>
                <h2>قاعة المكان</h2>
                <h4><span>من</span> 09:00ص <span>الى:</span> 10:00ص</h4>
                <h4>يوم الأحد - 03/01/2021</h4>
                <div class="form-group">
                    <button class="btn"><span>اضافة حجز</span></button>
                    <button class="btn"><span>مشغول</span></button>
                </div>
                <a class="popup-close" pd-popup-close="popupNew" href="#"> </a>
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
             .clickday:hover{
                 color: #000;
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
        var targeted_popup_class = jQuery(this).attr('pd-popup-close');
        $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);
 
        e.preventDefault();
    });
});
</script>
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
</script><script>
    $(function(){
    $('body').conditionalFields('init');
  });

  $(document).ready(function() {
    $('#click').click(function(e) {  
      alert(1);
    });
});
  </script>
    </body>
</html>