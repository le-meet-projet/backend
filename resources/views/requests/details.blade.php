@extends('/layouts/app')

@section('content')

 <!-- main-content opened -->
			<div class="main-content horizontal-content">
				<!-- container opened -->
				<div class="container">
					<!-- breadcrumb -->
						<div class="breadcrumb-header justify-content-between">
						<div class="my-auto">
							<div class="d-flex my-xl-auto right-content">						
								<div class="pr-1 mb-3 mb-xl-0">
									<a href="{{ route('admin.orders.index') }}"><button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button></a>
								</div>	
								<div class="pr-1 mb-3 mb-xl-0">
								   <div class="d-flex">
									<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }} </h5><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Booking Request Details') }} </span>
								</div>
							</div>					 
						</div>
					</div>
 
					</div>
					<!-- breadcrumb -->
					<div class="row row-sm">
						<div class="col-md-12 col-xl-12">
							<div class=" main-content-body-invoice">
								<div class="card card-invoice">
									<div class="card-body">
										<div class="invoice-header">
											<h1 class="invoice-title">{{ __('Invoice') }}</h1>
											<div class="billed-from">
												<h6>{{ __('Le Meet Group') }}</h6>
												<p>{{ __('Jaddah,Arabia Saudic') }}<br>
												{{ __('Tel Number') }}: 324 445-4544<br>
												{{ __('Email') }}: lemeet@contact.com</p>
											</div><!-- billed-from -->
										</div><!-- invoice-header -->
										<div class="row mg-t-20">
											<div class="col-md">
												<label class="tx-gray-600">{{ __('Billed To') }}</label>
												<div class="billed-to">
													<h6>{{ __('Soulaimane') }}</h6>
													<p>{{ __('4033 Patterson Road, Staten Island, NY 10301') }}<br>
													{{ __('Tel No') }}: 324 445-4544<br>
													{{ __('Email') }}: Soulaimane@gmail.com</p>
												</div>
											</div>
											<div class="col-md">
												<label class="tx-gray-600">{{ __('Invoice Information') }}</label>
												<p class="invoice-info-row"><span>{{ __('Invoice No') }}</span> <span>GHT-673-00</span></p>
												<p class="invoice-info-row"><span>{{ __('Project ID') }}</span> <span>32334300</span></p>
												<p class="invoice-info-row"><span>{{ __('Issue Date') }}:</span> <span>November 21, 2019</span></p>
												<p class="invoice-info-row"><span>{{ __('Due Date') }}:</span> <span>November 30, 2019</span></p>
											</div>
										</div>
										<div class="table-responsive mg-t-40">
											<table class="table table-invoice border text-md-nowrap mb-0">
												<thead>
													<tr>
														<th class="wd-20p">{{ __('Type') }}</th>
														<th class="wd-40p">{{ __('Description') }}</th>
														<th class="tx-center">{{ __('Date') }}</th>
														<th class="tx-right"> {{ __('Price') }}</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>{{ __('Workshop about self confidence') }}</td>
														<td class="tx-12">{{ __('This workshop explores the positive impact of self confidence in your career and personal life. Through exercise, you will discover the sources of low self confidence and develop new skills to increase your self confidence in order to increase your effectiveness and comfort in various areas of your life.') }}</td>
														<td class="tx-center">{{ __('November 21, 2019') }}</td>
														<td class="tx-right">$300.00</td>
													</tr>
										 
													<tr>
														<td class="valign-middle" colspan="2" rowspan="4">
															<div class="invoice-notes">
																<label class="main-content-label tx-13">{{ __('Notes') }}</label>
																<p>{{ __('Le meet is a great tool to find your meeting space ....') }}</p>
															</div> 
														</td>
														<td class="tx-right">{{ __('Sub-Total') }}</td>
														<td class="tx-right" colspan="2">$5,750.00</td>
													</tr>
													<tr>
														<td class="tx-right">{{ __('Tax ') }}(5%)</td>
														<td class="tx-right" colspan="2">$287.50</td>
													</tr>
													<tr>
														<td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('Total Due') }}</td>
														<td class="tx-right" colspan="2">
															<h4 class="tx-primary tx-bold">$5,987.50</h4>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<hr class="mg-b-40">
										<a href="#" class="btn btn-danger float-right mt-3 ml-2">
											<i class=" "></i>{{ __('Delete Order') }}
										</a>
										<a href="#" class="btn btn-success float-right mt-3">
											<i class="mdi mdi-printer mr-1"></i>{{ __('Print') }}
										</a>
									</div>
								</div>
							</div>
						</div><!-- COL-END -->
					</div>
@endsection