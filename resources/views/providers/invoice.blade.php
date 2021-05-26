<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>تقيماتْ</title>
        <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@800&display=swap" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav class="navbar navbar-light">
                <div class="container-fluid">
                        <h2>LE MEET</h2>
                </div>
              </nav>
        </header>
        <div class="contant">
            <button class="btn btn-lg sold">الرصيد</button><button class="btn btn-lg total-sold">23180.00 <span>ريال</span> </button><br>
            <div class="facteur">
              <h2>سجل الفاتورة</h2>
                <div class="col-lg-12 card">
                    <div class="col-lg-6 month">
                        <h3><strong><i class="bi bi-file-earmark-text"></i>يناير 2021</strong></h3>
                    </div>
                    <div class="col-lg-6 total">
                        <h3>2290.00 ريال<i class="bi bi-chevron-compact-left"></i></h3>
                    </div>
                </div>
                <div class="col-lg-12 card">
                    <div class="col-lg-6 month">
                        <h3><strong><i class="bi bi-file-earmark-text"></i>يناير 2021</strong></h3>
                    </div>
                    <div class="col-lg-6 total">
                        <h3>4640.00 ريال<i class="bi bi-chevron-compact-left"></i></h3>
                    </div>
                </div>
                <div class="col-lg-12 card">
                    <div class="col-lg-6 month">
                        <h3><strong><i class="bi bi-file-earmark-text"></i>يناير 2021</strong></h3>
                    </div>
                    <div class="col-lg-6 total">
                        <h3>4200.00 ريال<i class="bi bi-chevron-compact-left"></i></h3>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 card">
                <div class="col-lg-6 month">
                    <h3><strong><i class="bi bi-file-earmark-text"></i>يناير 2021</strong></h3>
                </div>
                <div class="col-lg-6 total">
                    <h3>2290.00 ريال<i class="bi bi-chevron-compact-left"></i></h3>
                </div>
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
            <style>
                *{
                    font-family: 'Almarai', sans-serif;
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
            </style>
    </body>
</html>