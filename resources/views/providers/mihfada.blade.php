<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>كشف الحساب</title>
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
                <div class="container-fluid justify-content-center">
                    <div class="logo">
                        <a  href="{{ route('merchant.orders')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                    </div>
                </div>
              </nav>
        </header>
        <div class="contant">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <button class="btn btn-lg sold">الرصيد</button>
                    <button class="btn btn-lg total-sold">{{ $currentMonthIncome }} <span>ريال</span> </button>
                </div>
            </div>
            <div class="row">
                <div class="facteur col-6">
                <h2>كشف الحساب</h2><br>
                @if(count($total) > 0)
                    @foreach($total as $v_total)
                    <div class="col-lg-12 card">
                        <div class="col-lg-6 month">
                        @php
                            $date = explode(' ', $v_total->Months);
                        @endphp
                            <h3><strong><i class="bi bi-file-earmark-text"></i>{{ date('F', mktime(0, 0, 0, $date[0], 10)) }} {{ $date[1] }}</strong></h3>
                        </div>
                        <div class="col-lg-6 total">
                            <h3>{{ $v_total->price}} ريال<i class="bi bi-chevron-compact-left"></i></h3>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="container col-lg-4">
                        <p>الحساب فارغ </p>
                        <a href="{{ route('merchant.orders')}}" class="btn redirect">العودة الى الرئيسية</a>
                    </div>
                    @endif
                </div>
                <div class="facteur col-6">
                <h2>سجل الفاتورة</h2><br>
                @if(count($earnings) > 0)
                    @foreach($earnings as $index => $year)
                        @foreach($year as $i => $month)
                            <div class="col-lg-12 card">
                                <div class="col-lg-6 month">
                                    <h3><strong><i class="bi bi-file-earmark-text"></i>{{ $index . ' ' . date('F', mktime(0, 0, 0, $i, 10)) }}</strong></h3>
                                </div>
                                <div class="col-lg-6 total">
                                    <h3>{{ $month}} ريال<i class="bi bi-chevron-compact-left"></i></h3>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    @else
                    <div class="container col-lg-4">
                        <p>لاتوجد أي فاتورة </p>
                        <a href="{{ route('merchant.orders')}}" class="btn redirect">العودة الى الرئيسية</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        
    <nav class ="navbar navb  bg-light">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('merchant.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                <li><a href="{{ route('merchant.wallet')}}" class="active"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                <li><a href="{{ route('merchant.orders')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                <li><a href="{{ route('merchant.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                </li>
            </ul>
        </div>
    </nav>
            <style>
                *{
                    font-family: 'Almarai', sans-serif;
                }
                .btn{
                    width: 200px;
                    height: 62px;
                    line-height: 40px;
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
                .sold{
                    background: #336e7c;
                    color: #fff;
                }
                .sold:hover{
                    background-color: #fff;
                    color:#000;
                    border-color: #336e7c;
                }
                .total-sold{
                    background: #fff;
                    color: #000;
                    border-color: #336e7c;
                    margin-right: 1%;
                }
                .total-sold:hover{
                    background: #336e7c;
                    color: #fff;
                    margin-right: 1%;
                }
                .total{
                    position: relative;
                    text-align: left;
                }
                .card{
                    color: #336e7c;
                    display: -webkit-inline-box;
                    padding: 2%;
                    margin-bottom: 2%;
                    border-color: #336e7c;
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
                .container > p{
                    color: #336e7c;
                    padding-top: 10%;
                    padding-bottom: 5%;
                    font-size: 55px;
                    text-align: center;
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
                   
            </style>
    </body>
</html>