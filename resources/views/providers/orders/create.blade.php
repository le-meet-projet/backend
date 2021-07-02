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
        @if(Session::has('success'))
            <p class="alert alert-success text-center">{{ Session::get('success') }}</p>
        @endif
        <div class="container">
            <!-- row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content border-left border-bottom border-right border-top-0 p-4">
                                <div class="tab-pane active" id="settings">
                                    <form action="{{ route('merchant.order.store')}}" role="form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="userId">User</label>
                                            <select name="user_id" class="form-control" id="userId">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="space">Space</label>
                                            <select name="space" class="form-control spaces-select" id="space">
                                                @foreach($spaces as $space)
                                                    <option value="{{$space->type}}-{{ $space->id }}">{{ $space->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group chair-count-container">
                                            <label for="chairCount">Chair count</label>
                                            <input type="text" name="chair_count" id="chairCount" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="date">Date</label>
                                            <input type="date" name="date" class="form-control" id="date">
                                        </div>

                                        <div class="form-group">
                                            <label for="timeFrom">From</label>
                                            <input type="time" name="time_from" class="form-control" id="timeFrom">
                                        </div>

                                        <div class="form-group">
                                            <label for="timeTo">To</label>
                                            <input type="time" name="time_to" class="form-control" id="timeTo">
                                        </div>

                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input type="text" name="price" id="price" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="coupon">Coupon</label>
                                            <input type="text" name="coupon" id="coupon" class="form-control">
                                        </div>
                                        <button
                                            class="btn btn-main pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Add order') }}</button>
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

    $('.spaces-select').change(function() {
        const selectedSpace = $(this).val().split('-')[0];
        if(selectedSpace == 'shared_table'){
            $('.chair-count-container').show();
        }else{
            $('#chairCount').val(null);
            $('.chair-count-container').hide();
        }
    })

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
    .chair-count-container{
        display: none;
    }
</style>
</html>
