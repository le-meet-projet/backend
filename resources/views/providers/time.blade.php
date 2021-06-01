<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@800&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                  <form class="d-flex">
                    <h2><i class="bi bi-person-fill"></i>حسابي</h2>
                  </form>
                    <div class="logo">
                    <img src="{{ asset('/public/assets/img/lemeet.png')}}" />
                    </div>
                    <div class="form-group">
                        <label class="form-switch">
                            <span class="lab1">ساعات</span>
                            <input type="checkbox">
                            <i></i>
                            <span class="lab2">ايام</span>
                          </label>
                    </div>
                </div>
              </nav>
        </header>
        
        <div class="contant">
            <table class="table">
                <thead>                    
                    <th class="th2" colspan="1"><strong>القاعات</strong></th>
                    <th class="th1" colspan="10"><strong>الحجوزات</strong></th>
                </thead>
                <!--<tbody class="bod">
                            @foreach($orders as $key => $v_order) 
                        <tr>                       
                            <td class="hours">
                                <img src="{{ asset('/image/salle1.jpg') }}" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                                <div class="name-salle">
                                    {{ $v_order['name']}}
                                </div>
                                
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> {{ $v_order['order_id']}}</a></h6>
                                        </div>
                                    </div>
                                    
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>{{ $v_order['days'][4]['time'] }} </span><br>
                                        <span class="date">{{ $v_order['days'][4]['date'] }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <div class="add-order">
                                                <spn class="plus">+</spn>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>10:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>11:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                        </div>
                                    </div>
                                    
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>12:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <div class="add-order">
                                                <spn class="plus">+</spn>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>01:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>02:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>03:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <div class="add-order">
                                                <spn class="plus">+</spn>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>03:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <div class="add-order">
                                                <spn class="plus">+</spn>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>03:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                            <td class="hours">
                                <div class="booking">
                                    <div class="days-booking-1">
                                        <div class="nb-booking">
                                            <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                        </div>
                                    </div>
                                    
                                    <div class="seconddiv">
                                        <span class="name-day"><span>ص</span>03:00 </span><br>
                                        <span class="date">03/01/2021</span>
                                    </div>
                                    
                                </div>
                            </td>
                        </tr>
                        @endforeach
                </tbody>-->
                <tbody class="bod">
                    <tr>                            
                        <td class="hours">
                            <img src="salle1.jpg" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                            <div class="name-salle">
                                قاعة المكان
                            </div>
                            
                        </td>
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
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>10:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>11:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>12:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>01:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>02:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>                            
                        <td class="hours">
                            <img src="salle1.jpg" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                            <div class="name-salle">
                                قاعة المكان
                            </div>
                            
                        </td>
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
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 410</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>10:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>11:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>12:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 335</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>01:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>02:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 220</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 600</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>                            
                        <td class="hours">
                            <img src="salle1.jpg" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                            <div class="name-salle">
                                قاعة المكان
                            </div>
                            
                        </td>
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
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>11:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>10:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>12:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>01:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>02:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>                            
                        <td class="hours">
                            <img src="salle1.jpg" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                            <div class="name-salle">
                                قاعة المكان
                            </div>
                            
                        </td>
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
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>10:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>11:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>12:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>01:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>02:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                    <tr>                            
                        <td class="hours">
                            <img src="salle1.jpg" style="width: 75%;margin-left: 10%;margin-right: 15%;height: 70%;position: absolute;">
                            <div class="name-salle">
                                قاعة المكان
                            </div>
                            
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>10:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
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
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 256</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>11:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 321</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>12:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>01:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 142</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>02:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <div class="add-order">
                                            <spn class="plus">+</spn>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                        <td class="hours">
                            <div class="booking">
                                <div class="days-booking-1">
                                    <div class="nb-booking">
                                        <h6 href=""><a  pd-popup-open="popupNew">رقم الحجز:<br> 353</a></h6>
                                    </div>
                                </div>
                                
                                <div class="seconddiv">
                                    <span class="name-day"><span>ص</span>03:00 </span><br>
                                    <span class="date">03/01/2021</span>
                                </div>
                                
                            </div>
                        </td>
                    </tr>
                 </tbody>
            </table>
        </div>
        <nav class ="navbar navb  bg-light">
            <div class="container">
                <ul class="nav navbar-nav">
                    <li><a href="{{ route('merchant.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                    <li><a href="{{ route('merchant.wallet')}}"><i class="bi bi-wallet-fill" class="active"></i><br><strong>المحفضة</strong>  </a> </li>
                    <li><a href="{{ route('merchant.orders')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
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
            </div>
        </div>
            <style>
                *{
                    font-family: 'Almarai', sans-serif;
                }
                header{
                    padding-right: 3%;
                    padding-left: 3%;
                }
                .logo h2{
                    text-align: center;
                }
                .login{
                    position: relative;
                }
                .login h2{
                    text-align: right;
                }
                table thead tr th:last-child {
                    padding: 0;
                    border: 0;
                    vertical-align: top;
                }
                table thead th:last-child strong {
                    display: block;
                    border: 1px solid;
                    height: 54px;
                    position: relative;
                    right: 9px;
                    line-height: 47px;
                    width: calc(100% - 19px) !important;
                }
                .th1{
                    text-align: center;
                }
                .th1 > strong:hover{
                    background-color: #336e7c;
                    color:#fff;
                    border-color: #336e7c;
                }
                .th2{
                    text-align: center;
                    border: solid 1px;
                }
                .th2:hover{
                    background-color: #336e7c;
                    color:#fff;
                    border-color: #336e7c;
                }
                .contant{
                    padding: 2%;
                }
                tbody, td, tfoot, th, thead, tr {
                    border-color: inherit;
                    border-style: none;
                    }
                td > div {
                    margin: 2px;
                    background-color: #336e7c;
                    }
                    .name-salle{
                        position: relative;
                    }
                    .hours{
                        width: 7%;
                        position: relative;
                    }
                    .nb-booking{
                        text-align: center;
                    }
                    .conf{
                        background-color: white;
                        color: #2a5d6a;
                        width:30%;
                    }
                    .paconf{
                        background-color: #2a5d6a;
                        color: white;
                        width:30%;
                    }
                    .nb-booking h6{
                        color: white;
                    }
                    .nb-booking a{
                        text-decoration: none;
                    }
                    .seconddiv{
                        background-color: #2a5d6a;
                        text-align: center;
                    }
                    .name-day{
                        color: #fff;
                        font-size: 1.2rem;
                        font-size: large;
                    }
                    .date{
                        color: white;
                    }
                    .name-salle { text-align: center;
                    color: #fff;
                    width: 83.5%;
                    margin-left: auto;
                    margin-right: 25px;
                    bottom: -93px;
                    }
                    .d-flex h2{
                        color: #336e7c;
                    }
                    .form-check-input:checked{
                        background-color: #336e7c;
                        border-color:#336e7c;
                    }
                    thead strong{
                        font-size: 1.5rem;
                    }
                    .border-booking{
                        display: flex;
                        margin-right: 28%;
                        padding-top: 6%;
                    }
                    div .form-group{
                        display: inline-flex;
                    }
                    label {
                        font-size: 1rem;
                        font-weight: bold;
                    }
                    .th2{
                        margin-right: 18%;
                        position: relative;
                        display: flow-root;
                        width: 76%;
                    }
                    .nav{
                        display: contents;
                    }
                    li{
                        text-align: center;
                    }
                    li a{
                        text-decoration: none;
                        color: lightgray;
                        text-align: none;
                    }
                    .popup {
                        width: 100%;
                        height: 100%;
                        display: none;
                        position: fixed;
                        top: 0px;
                        left: 0px;
                        background: rgba(0, 0, 0, 0.75);
                    }
                    .popup {
                        text-align: center;
                    }
                    .popup:before {
                        content: '';
                        display: inline-block;
                        height: 100%;
                        margin-right: -4px;
                        vertical-align: middle;
                    }
                    .popup-inner {
                        display: inline-block;
                        text-align: left;
                        vertical-align: middle;
                        position: relative;
                        max-width: 500px;
                        width: 90%;
                        padding: 15px;
                        box-shadow: 0px 2px 6px rgba(0, 0, 0, 1);
                        border-radius: 3px;
                        background: #fff;
                        text-align: center;
                    }

                    .popup-inner h1 {
                        font-family: 'Roboto Slab', serif;
                        font-weight: 700;
                    }

                    .popup-inner p {
                        font-size: 24px;
                        font-weight: 400;
                    }
                    .popup-close {
                        width: 34px;
                        height: 34px;
                        padding-top: 4px;
                         display: inline-block;
                        position: absolute;
                        top: 20px;
                        right: 20px;
                        -webkit-transform: translate(50%, -50%);
                        transform: translate(50%, -50%);
                        border-radius: 100%;
                        background: transparent;
                        border: solid 4px #808080;
                    }

                    .popup-close:after,
                    .popup-close:before {
                        content: "";
                        position: absolute;
                        top: 11px;
                        left: 5px;
                        height: 4px;
                        width: 16px;
                        border-radius: 30px;
                        background: #808080;
                        -webkit-transform: rotate(45deg);
                        transform: rotate(45deg);
                    }

                    .popup-close:after {
                        -webkit-transform: rotate(-45deg);
                        transform: rotate(-45deg);
                    }

                    .popup-close:hover {
                        -webkit-transform: translate(50%, -50%) rotate(180deg);
                        transform: translate(50%, -50%) rotate(180deg);
                        background: #f00;
                        text-decoration: none;
                        border-color: #f00;
                    }

                    .popup-close:hover:after,
                    .popup-close:hover:before {
                        background: #fff;
                    }
                    .popup-inner > h1{
                        color: #2a5d6a;
                        padding: 2%;
                    }
                    .popup-inner > h3{
                        text-align: initial;
                        padding: 2%;
                    }
                    .popup-inner > h4{
                        padding: 2%;
                    }up-inner > h3 span{
                        color: #2a5d6a;
                        padding: 2%;
                    }
                    .popup-inner > h4 span{
                        color:#2a5d6a;
                        padding: 2%;
                    }
                    hr{
                        background-color:#2a5d6a;
                    }
                    li a{
                        text-decoration: none;
                        color: lightgray;
                        text-align: none;
                        font-style: bold;
                    }
                    .active{
                        text-decoration: none;
                        color: #336e7c;
                        text-align: none;
                        font-style: bold;
                    }
                    .card:hover{
                        background:#336e7c;
                        color:#fff;
                    }
                    a:hover {
                        color: #336e7c;
                    }
                    li a{
                        text-decoration: none;
                        color: lightgray;
                        text-align: none;
                        font-style: bold;
                    }
                    .active{
                        text-decoration: none;
                        color: #336e7c;
                        text-align: none;
                        font-style: bold;
                    }
                    .card:hover{
                        background:#336e7c;
                        color:#fff;
                    }
                    a:hover {
                        color: #336e7c;
                    }
                    .seconddiv .name-day{
                        font-family: 'Almarai', sans-serif;
                    }
                    .nb-booking {
                        text-align: center;
                        padding-top: 15%;
                    }
                    .days-booking-1 {
                        height: 69px;
                    }
                    .add-order {
                        background-color: #fff;
                        height: 69px;
                        margin-top: -15%;
                    }
                    spn.plus {
                        font-size: 42px;
                        color: #336e7c;
                    }
                    .btn{
                        background: #2a5d6a;
                        color: #fff;
                        font-size: 17px;
                        margin: 5px;
                    }

            </style>
            
              <style>
                  .form-switch {
  display: inline-block;
  cursor: pointer;
  -webkit-tap-highlight-color: transparent;
}

.form-switch i {
  position: relative;
  display: inline-block;
  margin-right: .5rem;
  width: 46px;
  height: 26px;
  background-color: #e6e6e6;
  border-radius: 23px;
  vertical-align: text-bottom;
  transition: all 0.3s linear;
}

.form-switch i::before {
    content: "";
    position: absolute;
    left: 0;
    width: 42px;
    height: 22px;
    background-color: #055160;
    border-radius: 11px;
    transform: translate3d(2px, 2px, 0) scale3d(1, 1, 1);
    transition: all 0.25s linear;
}

.form-switch i::after {
  content: "";
  position: absolute;
  left: 0;
  width: 22px;
  height: 22px;
  background-color: #fff;
  border-radius: 11px;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.24);
  transform: translate3d(2px, 2px, 0);
  transition: all 0.2s ease-in-out;
}

.form-switch:active i::after {
  width: 28px;
  transform: translate3d(2px, 2px, 0);
}

.form-switch:active input:checked + i::after { transform: translate3d(16px, 2px, 0); }

.form-switch input { display: none; }

.form-switch input:checked + i  { background-color: #2a5d6a; color:#2a5d6a }
.form-switch input:checked + i  { color:#2a5d6a }
.form-switch input:checked + i + .lab2  { color: #2a5d6a;}
.form-switch input  .lab1 + i { color: #2a5d6a;}

.form-switch input:checked + i::before { transform: translate3d(18px, 2px, 0) scale3d(0, 0, 0); }

.form-switch input:checked + i::after { transform: translate3d(22px, 2px, 0); }
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
    </body>
</html>