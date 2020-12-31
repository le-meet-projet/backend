<!-- Loader -->
<div id="global-loader">
    <img src="/assets/img/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /Loader -->
<!-- Page -->
<div class="page" style="min-height: 0">
    <!-- main-header opened -->
    <div class="main-header nav nav-item hor-header">
        <div class="container">
            <div class="main-header-left ">
                <a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
                <div class="main-header-center  ml-4">
                    <h5>LEMEET</h5>
                </div>
            </div><!-- search -->
            <div class="main-header-right">
                <ul class="nav">
                    <li class="">
                        <div class="dropdown  nav-itemd-none d-md-flex">
                            <a href="?lang=en" class="d-flex  nav-item nav-link pr-0 country-flag1"
                               data-toggle="dropdown" aria-expanded="false">
                                <span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img
                                        src="/assets/img/flags/us_flag.jpg" alt="img"></span>
                                <div class="my-auto">
                                    <strong class="mr-2 ml-2 my-auto">  {{ __('English') }} </strong>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">

                                <a href="?lang=ar" class="dropdown-item d-flex ">
                                    <span class="avatar  ml-3 align-self-center bg-transparent"><img
                                            src="/assets/img/flags/arabic_flag.png" alt="img"></span>
                                    <div class="d-flex">
                                        <span class="mt-2">  {{ __('Arabic') }} </span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
                <div class="nav nav-item  navbar-nav-right ml-auto">
                    <div class="dropdown main-profile-menu nav nav-item nav-link">
                        <a class="profile-user d-flex" href="">
                            <img src="{{ Auth::user()->avatar !== null ? asset(Auth::user()->avatar) : asset('users/1606144165.jpg') }}" alt="">
                        </a>
                        <div class="dropdown-menu">
                            <div class="main-header-profile bg-primary p-3">
                                <div class="d-flex wd-100p">
                                    <div class="main-img-user">
                                        <img alt="" src="{{ Auth::user()->avatar !== null ? asset(Auth::user()->avatar) : asset('users/1606144165.jpg') }}" class="">
                                    </div>
                                    <div class="ml-3 my-auto">
                                        <h6>{{ Auth::user()->name }}</h6>
                                    </div>
                                </div>
                            </div>
                            <a class="dropdown-item" href="{{ route('admin.profile.index') }}"><i
                                    class="bx bx-user-circle"></i>{{ __('Profile') }}</a>
                            <a class="dropdown-item" href="/logout"><i class="bx bx-log-out"></i>{{ __(' Sign Out') }}
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /main-header -->
</div>
