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
									<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Meeting Spaces') }}  </span>
								</div>
							</div>					 
						</div>
						</div>
						<div class="d-flex my-xl-auto right-content">						
							<div class="pr-1 mb-3 mb-xl-0">
							    <a href="{{ route('admin.spaces.create') }}"><button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button></a>	
							</div>					 
						</div>
					</div>
					<!-- breadcrumb -->
					<!-- row opened -->
					 <div class="col-xl-12">
							<div class="card">
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">{{ __('MEETING SPACES TABLE') }}</h4>
										<i class="mdi mdi-dots-horizontal text-gray"></i>
									</div>									 
								<div class="card-body">
									<div class="table-responsive">
										<div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
											<div class="row">
												<div class="col-sm-12 col-md-6"></div>
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
													<th class="wd-10p border-bottom-0 sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="First name: activate to sort column descending" style="width: 64px;">{{ __('Id') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 75px;">{{ __('Image') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 25px;">{{ __('Name') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 25px;">{{ __('Price') }}</th>
													<th class="wd-20p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 75px;">{{ __('Address') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Start date: activate to sort column ascending" style="width: 35px;">{{ __('Description') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width:35px;">{{ __('Map') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 105px;">{{ __('Capacity') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 75px;">{{ __('More') }}</th>	
		
												</tr>
											</thead>
											<tbody>
												@foreach($meetings as $meeting)
												<tr>
													<td>{{$meeting->id}}</td>
													<td>{{$meeting->gallery}}</td>
													<td>{{$meeting->name}}</td>
													<td> {{$meeting->price}}</td>
													<td>{{$meeting->address}}</td>
													<td> {{$meeting->description}}</td>
													<td>{{$meeting->map}}</td>
													<td> {{$meeting->capacity}}</td>
													<td>
														<span class="ml-auto">
															<a href="{{ route('admin.spaces.edit') }}"><i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i></a>
															<i class="si si-trash text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
														</span> 
													</td>

												</tr>
												@endforeach
											</tbody>																		 
										</table>
									</div>
								</div>
								<div class="row">
									 
									{{$meetings->links()}}
								 
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