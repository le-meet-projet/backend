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
									<a href="{{ route('admin.') }}">
										<button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button>
									</a>
								</div>	
								<div class="pr-1 mb-3 mb-xl-0">
								   <div class="d-flex">
										<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5>
										<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Users') }} </span>
								   </div>
							   </div>					 
						   </div>
						</div>

						<div class="d-flex my-xl-auto right-content">						
 
							<div class="pr-1 mb-3 mb-xl-0">
							    <a href="{{ route('admin.users.create') }}">							    	
							      <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button>
							    </a>	
							</div>					 
						</div>
					</div>
					<!-- breadcrumb -->
					<!-- row opened -->
					 <div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">{{ __('USERS TABLE') }}</h4>
										<i class="mdi mdi-dots-horizontal text-gray"></i>
									</div>
									 
								<div class="card-body">
									<div class="table-responsive">
										<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
											<div class="row">
												<div class="col-sm-12 col-md-6">
													<div class="dataTables_length" id="example1_length">
														<label>
															<select name="example1_length" aria-controls="example1" class="custom-select custom-select-sm form-control form-control-sm">
																<option value="10">10</option>
																<option value="25">25</option>
																<option value="50">50</option>
																<option value="100">100</option>
															</select>
														</label>
													</div>
												</div>
												<div class="col-sm-12 col-md-6">
													<div id="example1_filter" class="dataTables_filter">
														<label>
															<input type="search" class="form-control form-control-sm" placeholder="Search..." aria-controls="example1">
														</label>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-sm-12">
													<table class="table text-md-nowrap dataTable no-footer" id="example1" role="grid" aria-describedby="example1_info">
											<thead>
												<tr role="row">
													<th class="wd-20p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 131px;">{{ __('Id') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Avatar') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Name') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Address') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Email') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Phone Number') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Role') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 134px;">{{ __('Status') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 105px;">{{ __('More') }}</th>
													
		
												</tr>
											</thead>
											<tbody>
						
												<tr>
													<td>1</td>
													<td><img src="../../assets/img/avatar.jpg">  </td>
													<td>Soulaimane</td>
													<td>Agadir</td>
													<td>Soulaimane@gmail.com  </td>
													<td>0652184565 </td>
													<td>Manager</td>
													<td>Active </td>
													<td>
														<span class="ml-auto">
															<a href="{{ route('admin.users.edit') }}">
																<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
															</a>
															<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
														</span> 
													</td>													
												</tr>
											</tbody>																			 
										</table>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 col-md-5">
										<div class="dataTables_info" id="example1_info" role="status" aria-live="polite">{{ __('Showing 3 to 10 of 50 entries') }}
										</div>
									</div>
									<div class="col-sm-12 col-md-7">
										<div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
											<ul class="pagination">
												<li class="paginate_button page-item previous disabled" id="example1_previous">
													<a href="#" aria-controls="example1" data-dt-idx="0" tabindex="0" class="page-link">{{ __('Previous') }}</a>
												</li>
												<li class="paginate_button page-item active"
												><a href="#" aria-controls="example1" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
												<li class="paginate_button page-item ">
													<a href="#" aria-controls="example1" data-dt-idx="2" tabindex="0" class="page-link">2</a>
												</li>
												<li class="paginate_button page-item ">
													<a href="#" aria-controls="example1" data-dt-idx="3" tabindex="0" class="page-link">3</a>
												</li>
												<li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="4" tabindex="0" class="page-link">4</a>
												</li>
												<li class="paginate_button page-item "><a href="#" aria-controls="example1" data-dt-idx="5" tabindex="0" class="page-link">5</a>
												</li>
												<li class="paginate_button page-item next" id="example1_next"><a href="#" aria-controls="example1" data-dt-idx="6" tabindex="0" class="page-link">{{ __('Next') }}</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
							</div>
						</div>
						</div>
					</div>
				 </div>
					
			</div>
			<!-- Container closed -->
	</div>
	<!-- main-content closed -->	 
@endsection