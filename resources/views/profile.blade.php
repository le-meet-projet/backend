
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
												<img src="/users/{{Auth::user()->avatar }}"   >
												 
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
											@csrf 
												<div class="form-group">
													<label for="FullName">Change Profile Picture</label>
													<input  class="form-control" name="avatar" placeholder=" {{ __('Avatar') }}" type="file" value="">
												</div>
												<div class="form-group">
													<label for="FullName">Full Name</label>
													<input type="text" name="name" value="{{ Auth::user()->name }}" id="FullName" class="form-control">
												</div>
												 
												<div class="form-group">
													<label for="Email">Email</label>
													<input type="email" name="email" value="{{ Auth::user()->email }}" id="Email" class="form-control">
												</div>
												<div class="form-group">
													<label for="phone">Number Phone</label>
													<input type="text"name="phone" value="{{ Auth::user()->phone }}" id="phone" class="form-control">
												</div>
												<div class="form-group">
													<label for="adress">Adress</label>
													<input type="text" name="address"value="{{ Auth::user()->address }}" id="adress" class="form-control">
												</div>
												 <div class=" ">
								   <div class=" ">
										{{ __(' Edit Password') }}
									</div>
									 <div class="pd-30 pd-sm-40 bg-gray-200">
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Password') }}</label>
											</div>
											<div class="input-group">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="{{ __('Enter here the new password') }}"    />
	                                            <div class="input-group-btn">
	                                                <button type="button" onclick="tooglePassword()" class="btn btn-default"><i id="eye" class="icon-eye"></i></button>
	                                            </div>
                                       		 </div>

										</div>																					
										<div class=" ">
                               		 <a onclick="password_generator()" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('create strong password') }}</a>
                           				 </div> 
							</div> </div>
												 
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