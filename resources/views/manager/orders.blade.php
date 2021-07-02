<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>الطلبات</title>
        <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
    <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet">
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
                    
                  </form>
                    <div class="logo">
                    <a href="{{ route('merchant.orders')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                    </div>
                    <div class="form-group role-selector">
                        
                    </div>
                </div>
              </nav>
        </header>
        <div class="contant">
            <div class="facteur">
              <div class="d-flex justify-content-between">
                <p>الطلبات</p>
                <p>مجموع الطلبات: {{$totalIncome}} ريال</p>
              </div>
              @if(count($orders) > 0)
                @foreach($orders as $order)
                    <div class="col-lg-12 card">
                            <div class="image-review col-lg-3 col-sm-12">
                                @php
                                    $thumbnail = $order->meeting ? '/spaces'.$order->meeting->thumbnail : '/tables'.$order->table->thumbnail;
                                @endphp
                                <img src="{{ $thumbnail == '/spaces' || $thumbnail == '/tables' ? no_image() : asset($thumbnail) }}">
                                <div class="name-salle">
                                    <strong>{{$order->meeting ? $order->meeting->name : $order->table->name}}</strong>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <h5>{{ $order->meeting ? $order->meeting->name : $order->table->name }}</h5>
                            </div>
                            <div class="vl"></div>
                            <div class="conten-review col-lg-4 mr-4">
                                <h7>{{ $order->ar_day}}</h7>
                                <h7>{{ $order->order_date}}</h7></br>
                                <h7>من: {{ explode(' ', $order->order_from)[1] }}</h7></br>
                                <h7>إلى: {{ explode(' ', $order->order_to)[1] }}</h7></br>
                                <h7>الثمن: {{ $order->meeting ? $order->meeting->price : $order->table->price }} ريال</h7>
                            </div>
                        <div class="col-lg-2 reply">
                            
                        </div>
                    </div>
                    @endforeach
                @else
                
                <div class="container col-lg-4">
                    <p>لايوجد أي تقييمات </p>
                    <a href="{{ route('merchant.orders')}}" class="btn redirect">العودة الى الرئيسية</a>
                </div>
                @endif
            </div>
        </div>
        
    <nav class ="navbar navb  bg-light">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('merchant.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                <li><a href="{{ route('merchant.wallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                <li><a href="{{ route('merchant.orders')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                <li><a href="{{ route('merchant.rating')}}" class="active"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                </li>
            </ul>
        </div>
    </nav>
            <style>
                *{
                    font-family: 'Almarai', sans-serif;
                }
                .vl {
                    border-left: 3px solid #336e7c;
                    height: 103px;
                    margin-top: 1%;
                }
                .btn{
                    line-height: 40px;
                }
                p {
                    margin-top: 0;
                    margin-bottom: 1rem;
                    text-align: center;
                    font-size: 33.3px;
                    margin-top: 25px;
                }
                .navb{
                    position: fixed !important;
                    bottom: 0 !important;
                    width: 100% !important;
                }
                .container-fluid h2{
                    margin-left: auto;
                    margin-right: auto;
                }
                div .form-group{
                        display: inline-flex;
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
                .contant{
                    padding-left: 2%;
                    padding-right: 2%;
                }
                .th1{
                    text-align: center;
                    border: solid 1px;
                }
                .th2{
                    text-align: center;
                    border: solid 1px;
                }
                .card{
                    border-color: #336e7c;
                    margin-bottom: 2%;
                }
                .sold{
                    background: #336e7c;
                    color: #fff;
                }
                .total-sold{
                    background: #fff;
                    color: #000;
                    border-color: #336e7c;
                    margin-right: 1%;
                }
                .total{
                    position: relative;
                    text-align: left;
                }
                .card{
                    color: #336e7c;
                    display: -webkit-inline-box;
                    border-radius: 0rem;
                }
                .facteur{
                    margin-top:2%
                }
                .month i{
                    margin-left: 5%;
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
                .name-salle{
                    background-color: #336e7c;
                    text-align: center;
                    color: #fff;
                    width: 36%;
                    margin-left: auto;
                }
                hr{
                    border: none;
                    border-left: 1px solid hsla(200, 10%, 50%,100);
                    height: 100vh;
                    width: 1px;       
                }
                .review{
                    color: #fff;
                    background-color: #336e7c;
                    padding-left: 2%;
                    padding-right: 2%;
                    margin: 2%;
                }
                .facteur h5{
                    color: #000;
                }
                .conten-review{
                    padding-right: 20px;
                }
                .conten-review h3{
                    color: #000;
                    padding: 5%;
                }
                .reply{
                    padding: 2%;
                    width: 29%;
                }
                .reply h3{
                    text-align: left;
                }
                .card img{
                    width: 36%;
                    position: relative;
                    max-width:100%;
                    display:block;
                    height:auto;
                }
                .review a{
                    margin-right: 2%;
                }
                li{
                    text-align: center;
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
                    h5{
                        color:#fff;
                    }
                a:hover {
                    color: #336e7c;
                }
                .image-review{
                    margin-left: -14%;
                }
                .container > p{
                    color: #336e7c;
                    padding-top: 20%;
                    padding-bottom: 5%;
                    font-size: 55px;;
                }
                .redirect{
                    margin-right: 35%;
                    background: #336e7c;
                    color: #fff;
                    border-color: #336e7c;
                }
                .redirect:hover{
                    background-color: #fff;
                    color:#000;
                    border-color: #336e7c;
                }
    li a{
        text-decoration: none;
        color: #b7b5b5;
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
        color: #b7b5b5;
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
    .bg-light {
    background-color: #E6E6E6!important;
}
            </style>
    </body>
</html>