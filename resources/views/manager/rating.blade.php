<!DOCTYPE html>
<html dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>تقيماتْ</title>
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
                    
                  </form>
                    <div class="logo">
                    <a  href="{{ route('manager.index')}}"><img src="{{ asset('/assets/img/lemeet.PNG')}}" /></a>
                    </div>
                    <div class="form-group role-selector">
                        
                    </div>
                </div>
              </nav>
        </header>
        <div class="contant">
            <div class="facteur">
              <h2>التقييمات</h2>
              @if(count($reviews) > 0)
              @foreach($reviews as $v_review)
                <div class="col-lg-12 card">
                        <div class="image-review col-lg-3 col-sm-12">
                            <img src="{{ asset('/image/salle1.jpg') }}">
                            <div class="name-salle">
                                <strong>{{$v_review->name}}</strong>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <span class=""><i class="review bi bi-star"><a>{{$v_review->review}}</a></i>@if($v_review->review < 5)متوسط@elseif($v_review->review >= 5) رائع @endif</span>
                            <h5>{{$v_review->user->name}}</h5>
                            <h7>{{$v_review->created_at->format(' M /d / Y ')}}</h7>
                        </div>
                        <div class="vl"></div>
                        <div class="conten-review col-lg-4">
                            <p>{{$v_review->rating}}</p>
                        </div>
                    <div class="col-lg-2 reply">
                        
                    </div>
                </div>
                @endforeach
                @else
                
                <div class="container col-lg-4">
                            <p>لايوجد أي تقييمات </p>
                            <a href="{{ route('manager.index')}}" class="btn redirect">العودة الى الرئيسية</a>
                </div>
                @endif
            </div>
        </div>
        
    <nav class ="navbar navb  bg-light">
        <div class="container">
            <ul class="nav navbar-nav">
                <li><a href="{{ route('manager.profile')}}"><i class="fas fa-cog" ></i><br><strong>الملف الشخصي</strong>  </a> </li>
                <li><a href="{{ route('manager.wallet')}}"><i class="bi bi-wallet-fill" ></i><br><strong>المحفضة</strong>  </a> </li>
                <li><a href="{{ route('manager.index')}}"><i class="bi bi-house"></i><br><strong>الرئيسية</strong></a></li>
                <li><a href="{{ route('manager.rating')}}" class="active"><i class="bi bi-star"></i><br><strong>التقيمات</strong>   </a>
                </li>
            </ul>
        </div>
    </nav>
    </body>
</html>