@extends('/layouts/app')

@section('content')

 <!-- main-content opened -->
			<div class="main-content horizontal-content">
				@if (!$coupons->isEmpty())
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
										<span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Coupons') }} </span>
								   </div>
							   </div>					 
						   </div>
						</div>

						<div class="d-flex my-xl-auto right-content">						
 
							<div class="pr-1 mb-3 mb-xl-0">
							    <a href="{{ route('admin.coupons.create') }}">							    	
							      <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i></button>
							    </a>	
							</div>					 
						</div>
					</div>
					<!-- breadcrumb -->
					@endif
					<!-- row opened -->
					 <div class="col-xl-12"> 
							<div class="card">
								@if ($coupons->isEmpty())

								 <div class="card-body">
								 	 <div class="empty_state text-center">

									            <i class="fas fa-percent empty_state_icon"></i>
									            <h4> {{ __('start adding new coupons') }}
									</h4>
									            <a href="{{ route('admin.coupons.create') }}" class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-plus"></i></b>
									{{ __('create new coupon') }}
									</a>
									 </div>
								</div>
      
        						@endif @if (!$coupons->isEmpty())
								<div class="card-header pb-0">
									<div class="d-flex justify-content-between">
										<h4 class="card-title mg-b-0">{{ __('COUPONS TABLE') }}</h4>
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
													<th class="wd-20p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Position: activate to sort column ascending" style="width: 171px;">{{ __('Coupon Code') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 154px;">{{ __('Date') }}</th>
													<th class="wd-15p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Last name: activate to sort column ascending" style="width: 174px;">{{ __('Statue') }}</th>
													<th class="wd-10p border-bottom-0 sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Salary: activate to sort column ascending" style="width: 135px;">{{ __('More') }}</th>
													
		
												</tr>
											</thead>
											<tbody>
						                        @foreach($coupons as $coupon)
												<tr>
													
													<td>{{$coupon->code}}</td>
													<td>{{ $coupon->created_at->diffForHumans()}} </td>
													<td>  {{ $coupon->statue}}		</td>		
													 
													<td>
														<span class="ml-auto">
															<a href="{{ route('admin.coupons.edit',['id' => $coupon->id]) }}" class="text-primary-600">
																<i class="si si-pencil text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
															</a>

														 

															<a href="javascript:void(0)"  class="deletebtn" data-toggle="modal" data-target="#deletemodalpop"> <i class="si si-trash text-danger mr-2  "   data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i></a>
														<!-- Delete Modal -->
														<div class="modal fade" id="deletemodalpop" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
														  <div class="modal-dialog">
														    <div class="modal-content">
														      <div class="modal-header">
														        <h5 class="modal-title" id="exampleModalLabel">{{ __('Are you sure !') }}</h5>
														        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
														          <span aria-hidden="true">&times;</span>
														        </button>
														      </div>
														      <form id="delete_modal_form" method="GET" action="{{route('admin.coupons.delete', $coupon->id)}}">
														      	@csrf
									  
														      <div class="modal-footer">
														        <button type="button" class="btn btn-primary" data-dismiss="modal">{{ __('Close') }}</button>
														        <button type="submit" class="btn btn-danger ">{{ __('Yes Delete It') }}</button>
														      </div>
														      </form>
														    </div>
														  </div>
														</div>
														<!-- End Delete Modal -->
														</span> 
													</td>													
												</tr>
												@endforeach
											</tbody>																			 
										</table>
										@endif
										
										<div class="pagination-cont">
											{{$coupons->links()}}
										</div>
										
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
 
<script>
  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0; 
        var user_id = $(this).data('id'); 
         
        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })
</script> 
@endsection