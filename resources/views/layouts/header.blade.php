<head>
		<meta charset="UTF-8">
		<meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="Description" content="Bootstrap Responsive Admin Web Dashboard HTML5 Template">
		<meta name="Author" content="Spruko Technologies Private Limited">
		<meta name="Keywords" content="admin,admin dashboard,admin dashboard template,admin panel template,admin template,admin theme,bootstrap 4 admin template,bootstrap 4 dashboard,bootstrap admin,bootstrap admin dashboard,bootstrap admin panel,bootstrap admin template,bootstrap admin theme,bootstrap dashboard,bootstrap form template,bootstrap panel,bootstrap ui kit,dashboard bootstrap 4,dashboard design,dashboard html,dashboard template,dashboard ui kit,envato templates,flat ui,html,html and css templates,html dashboard template,html5,jquery html,premium,premium quality,sidebar bootstrap 4,template admin bootstrap 4"/>
		<title> {{config('app.name','LeMeet')}} </title>
		<link rel="icon" href="/assets/img/brand/favicon.png" type="image/x-icon"/>
		<link href="/assets/css/icons.css" rel="stylesheet">
		<link href="/assets/plugins/mscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet"/>
		<link href="/assets/plugins/sidebar/sidebar.css" rel="stylesheet">
		<link href="/assets/plugins/morris.js/morris.css" rel="stylesheet">
		<link href="/assets/css/style.css" rel="stylesheet">
		<link href="/assets/css/style-dark.css" rel="stylesheet">
		<link href="/assets/css/skin-modes.css" rel="stylesheet" />
		<link href="/css/es.css" rel="stylesheet" />
		 
</head>

<body class="main-body ">
		<!-- Loader -->
		<div id="global-loader">
			<img src="/assets/img/loader.svg" class="loader-img" alt="Loader">
		</div>
		<!-- /Loader -->
		<!-- Page -->
		<div class="page">
			<!-- main-header opened -->
			<div class="main-header nav nav-item hor-header">
				<div class="container">
					<div class="main-header-left ">
						<a class="animated-arrow hor-toggle horizontal-navtoggle"><span></span></a><!-- sidebar-toggle-->
				 
						<div class="main-header-center  ml-4">
							 <h5>CONTROL PANEL</h5>
						</div>
					</div><!-- search -->
					<div class="main-header-right">
						<ul class="nav">
							<li class="">
								<div class="dropdown  nav-itemd-none d-md-flex">
									<a href="?lang=en" class="d-flex  nav-item nav-link pr-0 country-flag1" data-toggle="dropdown" aria-expanded="false">
										<span class="avatar country-Flag mr-0 align-self-center bg-transparent"><img src="/assets/img/flags/us_flag.jpg" alt="img"></span>
										<div class="my-auto">
											<strong class="mr-2 ml-2 my-auto">  {{ __('English') }} </strong>
										</div>
									</a>
									<div class="dropdown-menu dropdown-menu-left dropdown-menu-arrow" x-placement="bottom-end">
			 
 										<a href="?lang=ar" class="dropdown-item d-flex ">
											<span class="avatar  ml-3 align-self-center bg-transparent"><img src="/assets/img/flags/arabic_flag.png" alt="img"></span>
											<div class="d-flex">
												<span class="mt-2">  {{ __('Arabic') }} </span>
											</div>
										</a>
									</div>
								</div>
							</li>
						</ul>
						<div class="nav nav-item  navbar-nav-right ml-auto">
 
	 
							<div class="nav-item full-screen fullscreen-button">
								<a class="new nav-link full-screen-link" href="#"><svg xmlns="http://www.w3.org/2000/svg" class="header-icon-svgs" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-maximize"><path d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3"></path></svg></a>
							</div>
							<div class="dropdown main-profile-menu nav nav-item nav-link">
								<a class="profile-user d-flex" href=""><img alt="" src="{{ Auth::user()->avatar }}"></a>
								<div class="dropdown-menu">
									<div class="main-header-profile bg-primary p-3">
										<div class="d-flex wd-100p">
											<div class="main-img-user"><img alt="" src="{{ Auth::user()->avatar }}" class=""></div>
											<div class="ml-3 my-auto">
												<h6>{{ Auth::user()->name }}</h6>
											</div>
										</div>
									</div>
									<a class="dropdown-item" href=""><i class="bx bx-user-circle"></i>{{ __('Profile') }}</a>
									<a class="dropdown-item" href="/logout"><i class="bx bx-log-out"></i>{{ __(' Sign Out') }}</a>
								</div>
							</div>
							 
						</div>
					</div>
				</div>
			</div>
			<!-- /main-header -->