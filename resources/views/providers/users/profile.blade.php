<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords"
          content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
    <title> {{config('app.name','LeMeet')}} </title>
    <link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
    <link href="{{ asset('/assets/css/icons.css') }}" rel="stylesheet">
    <link href="/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
    <link href="/assets/plugins/sidebar/sidebar.css" rel="stylesheet">
    <link href="/assets/plugins/morris.js/morris.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">
    <link href="/assets/css/style-dark.css" rel="stylesheet">
    <link href="/assets/css/skin-modes.css" rel="stylesheet"/>
    <link href="/css/es.css" rel="stylesheet"/>
    <link href="/css/toggle_css.css" rel="stylesheet"/>
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
                <a  href="{{ route('merchant.orders')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                </div>
                <div class="form-group role-selector">
                    
                </div>
            </div>
          </nav>
    </header>
    <div class="main-content horizontal-content">
        <div class="container">
            <!-- row -->
            <div class="row row-sm">
                <div class="col-lg-4">
                    <div class="card mg-b-20">
                        <div class="card-body">
                            <div class="pl-0">
                                <div class="main-profile-overview text-center">
                                    <div class="main-img-user profile-user">
                                        <img src="{{  Auth::user()->avatar !== null ? asset(Auth::user()->avatar) : asset('users/1606144165.jpg')  }}" alt="">
                                    </div>
                                    <div class="d-flex justify-content-between mg-b-20" style="margin-right: 42%;">
                                        <div>
                                            <h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
                                            <p class="main-profile-name-text">{{ Auth::user()->role }}</p>
                                        </div>
                                    </div>
                                </div><!-- main-profile-overview -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('logout') }}" class="btn btn-main pd-x-30 mg-r-5 mg-t-5 btn-block">تسجيل الخروج</a>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                <div class="tab-pane active" id="settings">
                                    <form enctype="{{ route('merchant.profileEdit')}}" role="form" method="post"
                                          action="">
                                        @csrf
                                        <div class="form-group">
                                            <label for="FullName">Change Profile Picture</label>
                                            <input class="form-control" name="avatar" placeholder=" {{ __('Avatar') }}"
                                                   type="file" value="{{ Auth::user()->avatar }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="FullName">Full Name</label>
                                            <input type="text" name="name" value="{{ Auth::user()->name }}"
                                                   id="FullName" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="Email">Email</label>
                                            <input type="email" name="email" value="{{ Auth::user()->email }}"
                                                   id="Email" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="phone">Number Phone</label>
                                            <input type="text" name="phone" value="{{ Auth::user()->phone }}" id="phone"
                                                   class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="adress">Adress</label>
                                            <input type="text" name="address" value="{{ Auth::user()->address }}"
                                                   id="adress" class="form-control">
                                        </div>
                                        <div class=" ">
                                            <div class=" ">
                                                {{ __(' Edit Password') }}
                                            </div>
                                            <div class="pd-30 pd-sm-40 bg-gray-200">
                                            <input id="password-field" type="password" class="form-control" name="password" value="{{ Auth::user()->password }}"><span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                            </div>
                                        </div>
                                        <button
                                            class="btn btn-main pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Save Changes') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row closed -->
        </div>
    </div>
    <nav class ="navbar navb  bg-light">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('merchant.profile')}}" class="active"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                <li><a href="{{ route('merchant.wallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                <li><a href="{{ route('merchant.orders')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                <li><a href="{{ route('merchant.rating')}}"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                </li>
            </ul>
        </div>
    </nav>
</body>
<script>
    $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
        });
</script>
<style>
    .field-icon {
  float: right;
  margin-left: -25px;
  margin-top: -25px;
  position: relative;
  z-index: 2;
}
    .navb{
        position: fixed !important;
        bottom: 0 !important;
        width: 100% !important;
    }
    .nav{
        display: contents;
    }
    li{
        text-align: center;
    }
    li a{
        text-decoration: none;
        color: #b7b5b5;
        text-align: none;
    }
    content.horizontal-content {
        padding-top: 0 !important;
         margin-top: 44px;
    }
    .btn-main {
        color: #fff;
        background-color: #336e7c;
        border-color: #336e7c;
    }
    .btn-main:hover {
        color: #fff;
        background-color: #336e7c;
        border-color: #336e7c;
    }
    .main-content.horizontal-content {
        padding-top: 0 !important;
        margin-top: 50px;
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
    .form-control {
    text-align: left;
    }
</style>
</html>
