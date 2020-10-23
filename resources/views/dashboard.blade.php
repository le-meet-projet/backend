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
												<h4 class="tx-20 font-weight-bold mb-1 text-white">74</h4>
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
												<h4 class="tx-20 font-weight-bold mb-1 text-white">230</h4>
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
												<h4 class="tx-20 font-weight-bold mb-1 text-white">125</h4>
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
												<h4 class="tx-20 font-weight-bold mb-1 text-white">50</h4>
											</div>
										</div>
									</div>
								</div>
								<span id="compositeline4" class="pt-1"></span>
							</div>
						</div>
					</div>
					<!-- row closed -->
					<!-- row opened -->
					<div class="row row-sm row-deck">
						<div class="col-md-12 col-lg-4 col-xl-4">
							<div class="card card-dashboard-eight pb-2">
								<h6 class="card-title">{{ __('Your Top Meeting Spaces') }}</h6><span class="d-block mg-b-10 text-muted tx-12">{{ __('The most booking spaces  last week') }}</span>
								<div class="list-group">		 
									<div class="list-group-item">	 
										<p>{{ __('student space') }}</p><span> 10 </span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-8 col-xl-8">
							<div class="card card-table-two">
								<div class="d-flex justify-content-between">
							 	<h4 class="card-title mb-1">{{ __('Recent.Request') }}</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
					 
								<div class="table-responsive country-table">
									<table class="table table-striped table-bordered mb-0 text-sm-nowrap text-lg-nowrap text-xl-nowrap">
										<thead>
											<tr>
												<th class="wd-lg-25p">{{ __('Date') }}</th>
												<th class="wd-lg-25p tx-right">{{ __('Space') }}</th>
												<th class="wd-lg-25p tx-right">{{ __('User') }} </th>
												<th class="wd-lg-25p tx-right">{{ __('More') }}</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>05 Dec 2019</td>
												<td class="tx-right tx-medium tx-inverse">Nour Coffee</td>
												<td class="tx-right tx-medium tx-inverse">Soulaime</td>
												<td class="tx-right tx-medium tx-danger"><a href="{{ route('admin.orders.details') }}">Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
				   </div>
				   <!-- /row -->
		</div>
</div>
 
@endsection