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
                        <a  href="{{ route('manager.index')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                    </div>
                </div>
              </nav>
        </header>
        <div class="contant">
            <div class="d-flex justify-content-between">
                <div class="d-flex">
                    <button class="btn btn-lg sold">الرصيد</button>
                    <button class="btn btn-lg total-sold"><span class="money"></span><span> ريال</span></button>
                </div>
            </div>
            @if(count($total) > 0 && count($earnings) > 0)
                <div class="row">
                    <div class="wallet col-6">
                    <h2>كشف الحساب</h2><br>
                    @foreach($total as $v_total)
                    <div class="col-lg-12 card">
                        <div class="col-lg-6 month">
                        @php
                            $date = explode(' ', $v_total->Months);
                        @endphp
                            <h3><strong><i class="bi bi-file-earmark-text"></i>{{ date('F', mktime(0, 0, 0, $date[0], 10)) }} {{ $date[1] }}</strong></h3>
                        </div>
                        <div class="col-lg-6 total">
                            <h3><span class="money">{{ $v_total->price}}</span> ريال<i class="bi bi-chevron-compact-left"></i></h3>
                        </div>
                    </div>
                    @endforeach
                    </div>
                    <div class="invoice col-6">
                    <h2>سجل الفاتورة</h2><br>
                    @foreach($earnings as $index => $year)
                        @foreach($year as $i => $month)
                            <div class="col-lg-12 card">
                                <div class="col-lg-6 month">
                                    <h3><strong><i class="bi bi-file-earmark-text"></i>{{ $index . ' ' . date('F', mktime(0, 0, 0, $i, 10)) }}</strong></h3>
                                </div>
                                <div class="col-lg-6 total">
                                    <h3><span class="money">{{ $month}}</span> ريال<i class="bi bi-chevron-compact-left"></i></h3>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                    </div>
                </div>
            @else
                <div class="container col-lg-4">
                    <p>لاتوجد أي فاتورة </p>
                    <a href="{{ route('manager.index')}}" class="btn redirect">العودة الى الرئيسية</a>
                </div>
            @endif
        </div>
        
    <nav class ="navbar navb  bg-light">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('manager.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                <li><a href="{{ route('manager.wallet')}}" class="active"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                <li><a href="{{ route('manager.index')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                <li><a href="{{ route('manager.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                </li>
            </ul>
        </div>
    </nav>
    
    <script src="{{ asset('js/lemeet.js') }}"></script>
    </body>
</html>