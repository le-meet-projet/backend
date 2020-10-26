@extends('/layouts/app')

@section('content')
<div class="main-content horizontal-content">
	   <!-- container opened -->
		<div class="container">
					<!-- breadcrumb -->
					<div class="breadcrumb-header justify-content  ">
						<div class="right-content">
							<div>
							  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1  ">{{ __('welcome to the control panel ! ') }}</h2>
							  <p class="mg-b-0">{{ __('Here you can manage every aspect of your application.') }}</p>
							</div>
						</div>
					 
					</div>
					<!-- /breadcrumb -->
					<!-- row -->
					<div class="row row-sm">
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-primary-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h3 class="mb-3 tx-12 text-white">{{ __('TOTAL REQUEST') }}</h3>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white"> </h4>
											</div>
	
										</div>
									</div>
								</div>
								 <span id="compositeline" class="pt-1"></span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-danger-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h3 class="mb-3 tx-12 text-white">{{ __('TOTAL WORKSHOPS') }}</h3>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white"> </h4>
											</div>
										</div>
									</div>
								</div>
								<span id="compositeline2" class="pt-1"></span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-success-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">{{ __('TOTAL MEETING SPACES') }}</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white"> </h4>
											</div>
										</div>
									</div>
								</div>
								<span id="compositeline3" class="pt-1"></span>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6 col-md-6 col-xm-12">
							<div class="card overflow-hidden sales-card bg-warning-gradient">
								<div class="pl-3 pt-3 pr-3 pb-2 pt-0">
									<div class="">
										<h6 class="mb-3 tx-12 text-white">{{ __('TOTAL USERS') }}</h6>
									</div>
									<div class="pb-0 mt-0">
										<div class="d-flex">
											<div class="">
												<h4 class="tx-20 font-weight-bold mb-1 text-white"> </h4>
											</div>
										</div>
									</div>
								</div>
								<span id="compositeline4" class="pt-1"></span>
							</div>
						</div>
					</div>
					<!-- row closed -->
				 
		</div>
</div>
 
@endsection