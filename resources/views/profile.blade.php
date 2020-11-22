
@extends('/layouts/app')

@section('content')
<div class="main-content horizontal-content">
<div class="container">

					  <!-- breadcrumb -->
					<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex my-xl-auto right-content">						
								<div class="pr-1 mb-3 mb-xl-0">
									<a href="{{ route('admin.') }}">
										<button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button>
									</a>
								</div>	
								<div class="pr-1 mb-3 mb-xl-0">
								   <div class="d-flex">
										<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5>
										<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Profile') }} </span>
								   </div>
							   </div>					 
						   </div>
						</div>

						 
					</div>
					<!-- breadcrumb -->

					<!-- row -->
					<div class="row row-sm">
						<div class="col-lg-4">
							<div class="card mg-b-20">
								<div class="card-body">
									<div class="pl-0">
										<div class="main-profile-overview">
											<div class="main-img-user profile-user">
												<img src="{{URL::to('/')}}/users/{{ Auth::user()->avatar }}">
												<div>
												<span class="fas fa-camera profile-edit" href=" "> <input type="file" id="browse" name="browse" style="display: none">   </span></div>
											</div>
											<div class="d-flex justify-content-between mg-b-20">
												<div>
													<h5 class="main-profile-name">{{ Auth::user()->name }}</h5>
													<p class="main-profile-name-text">{{ Auth::user()->role }}</p>
												</div>
											</div>
											 
										</div><!-- main-profile-overview -->
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8">
							 
							<div class="card">
								<div class="card-body">
									<div class="tabs-menu ">
										<!-- Tabs -->
										<ul class="nav nav-tabs profile navtab-custom panel-tabs">
											 
											 
											<li class="">
												<a href="#settings" data-toggle="tab" aria-expanded="false" class=" "> <span class="visible-xs"><i class="las la-cog tx-16 mr-1"></i></span> <span class="hidden-xs">SETTINGS</span> </a>
											</li>
										</ul>
									</div>
									<div class="tab-content border-left border-bottom border-right border-top-0 p-4">
										 
										 
									 
										<div class="tab-pane active" id="settings">
											<form role="form" method="post" action="{{ route('admin.profile.update',['id'=>Auth::user()->id]) }}">
												<div class="form-group">
													<label for="FullName">Full Name</label>
													<input type="text" value="{{ Auth::user()->name }}" id="FullName" class="form-control">
												</div>
												<div class="form-group">
													<label for="Email">Email</label>
													<input type="email" value="{{ Auth::user()->email }}" id="Email" class="form-control">
												</div>
												<div class="form-group">
													<label for="phone">Number Phone</label>
													<input type="text" value="{{ Auth::user()->phone }}" id="phone" class="form-control">
												</div>
												<div class="form-group">
													<label for="adress">Adress</label>
													<input type="text" placeholder="{{ Auth::user()->address }}" id="adress" class="form-control">
												</div>
												 
												 
												<button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Save Changes') }}</button>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- row closed -->
				</div></div>
				@endsection