@extends('/layouts/app')

@section('content')
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
									<a href="{{ route('admin.brand.index') }}">
										<button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button>
									</a>
								</div>	
								<div class="pr-1 mb-3 mb-xl-0">
								   <div class="d-flex">
									<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5>
									<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Add Brand') }} </span>
								</div>
							</div>					 
						</div>
					</div>
	 
					</div>
					<!-- breadcrumb -->		 
					<!-- row -->
				<form method="POST" action="{{ route('admin.brand.store') }}" enctype="multipart/form-data">
					@csrf
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										 {{ __('Add A New Brand') }}
									</div>
									<p class="mg-b-20">{{ __('All fields are required*') }} </p>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Brand name  ') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="name" placeholder="{{ __('Brand name') }} " type="text" required="required fields">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Address') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="address" placeholder="{{ __('Address') }} " type="text" required="">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Thumbnail') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="thumbnail" placeholder="{{ __('Thumbnail') }}" type="file">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Gallery') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="gallery[]" placeholder="{{ __('Gallery') }}" type="file" multiple>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Description') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<textarea class="form-control" name="description" placeholder=" " type="text" required=""></textarea>  
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Files') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="files[]" placeholder="{{ __('Files') }}" type="file" multiple>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('IBAN') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="iban" placeholder="{{ __('IBAN') }} " type="text" required="">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Bank') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="bank" placeholder="{{ __('Bank') }} " type="text" required="">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Type') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<select name="type" class="form-control">
													<option value="" hidden>Not selected</option>
													@foreach (\App\Brand::$types as $type)
														<option value="{{ $type }}">{{ ucfirst($type) }}</option>
													@endforeach
												</select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Email') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="email" placeholder="{{ __('Email') }} " type="email" required="">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Password') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="password" placeholder="{{ __('Password') }} " type="password" required="">
											</div>
										</div>
									</div>
									<button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Create New Brand') }}</button>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /row -->
				</form>
				 
				</div>
				<!-- Container closed -->
			</div>
			<!-- main-content closed -->
		</div>
		<!-- End Page -->	
</div>	 
 
@endsection