@include('layouts.header') 
@include('layouts.navbar')
 <!-- main-content opened -->
<div class="container">
			<div class="main-content horizontal-content">
				<!-- container opened -->
				<div class="container">
					<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between">
							<div class="my-auto">
								<div class="d-flex my-xl-auto right-content">						
									<div class="pr-1 mb-3 mb-xl-0">
										<a href="{{ route('home.users.index') }}">
											<button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button>
										</a>
									</div>	
									<div class="pr-1 mb-3 mb-xl-0">
									   <div class="d-flex">
										<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5>
										<span class="text-muted mt-1 tx-13 ml-2 mb-0">/  {{ __('Users') }} </span>
										<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Edit User') }} </span>
									</div>
								</div>					 
							</div>
							</div>
							<div class="d-flex my-xl-auto right-content">						
								<div class="pr-1 mb-3 mb-xl-0">
									<a href="{{ route('home.users.edit') }}">
										<button type="button" class="btn btn-warning  btn-icon mr-2"><i class="mdi mdi-refresh"></i></button>
									</a>
								</div>					 
							</div>
						</div>
					<!-- breadcrumb -->		 
					<!-- /row -->
					<!-- row -->
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										{{ __(' Edit User') }}
									</div>
									<div class="pd-30 pd-sm-40 bg-gray-200">
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Name') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" placeholder="  " type="text">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Avatar') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="custom-file-input" id=" " type="file"> <label class="custom-file-label" for="customFile">{{ __('Choose file') }}</label>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Address') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" placeholder=" " type="text">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Email') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" placeholder=" " type="mail">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Password') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input type="password" class="form-control" id="inputPassword3" placeholder="">
											</div>
										</div>										
										
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Phone Number') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" placeholder=" " type="text">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Role') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<select class="form-control select2-no-search select2-hidden-accessible" data-select2-id="13" tabindex="-1" aria-hidden="true">
												<option label="Choose one" data-select2-id="15">
												</option>
												<option value="Female" data-select2-id="31">
													{{ __('Manager') }}
												</option>
												<option value="Male" data-select2-id="32">
													{{ __('Client') }}
												</option>
											</select> 
											</div>
										</div>	
										
								        <div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Status') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<select class="form-control select2-no-search select2-hidden-accessible" data-select2-id="13" tabindex="-1" aria-hidden="true">
												<option label="Choose one" data-select2-id="15">
												</option>
												<option value="Female" data-select2-id="31">
													{{ __('Actived') }}
												</option>
												<option value="Male" data-select2-id="32">
													{{ __('Blocked') }}
												</option>
											</select> 
											</div>
										</div> 
										<button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5">{{ __('Edit') }}</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->				 
				</div>
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->
		</div>
		<!-- End Page -->	
</div>	 

@include('layouts.footer')