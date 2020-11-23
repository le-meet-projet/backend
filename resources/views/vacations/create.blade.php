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
									<a href="{{ route('admin.spaces.index') }}"><button type="button" class="btn btn-danger btn-icon mr-2"><i class="mdi mdi-arrow-left"></i></button></a>
								</div>	
								<div class="pr-1 mb-3 mb-xl-0">
								   <div class="d-flex">
									<h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5><span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('New Vacation  ') }}  </span>
								</div>
							</div>					 
						</div>
						</div>
 
					</div>
					<!-- breadcrumb -->		

					<!-- row -->
					<form method="POST" id="upload" action="{{route('admin.vacations.store')}}" enctype="multipart/form-data">
											@csrf
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										 {{ __('Add A New Vacation  ') }}
									</div>
									<p class="mg-b-20">{{ __('All fields are required') }}* </p>
									<div class="pd-30 pd-sm-40 bg-gray-200">
										 
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Name') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="name" placeholder="{{ __(' Name ') }} " type="text" required="">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Address') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="address" placeholder="{{ __('  Address ') }} " type="text" required="required">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('City') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="city" class="form-control" name="city" required>
														  <option value="Abha">{{ __('Abha') }}</option>
											               <option value="Ad-Dilam">{{ __('Ad-Dilam') }}</option>
											               <option value="Al-Abwa">{{ __('Al-Abwa') }}</option>
											               <option value="Al Artaweeiyah">{{ __('Al Artaweeiyah') }}</option>
											               <option value="Al Bukayriyah">{{ __('Al Bukayriyah') }}</option>
											               <option value="Badr">{{ __('Badr') }}</option>
											               <option value="Baljurashi">{{ __('Baljurashi') }}</option>
											               <option value="Bisha">{{ __('Bisha') }}</option>
											               <option value="Bareg">{{ __('Bareg') }}</option>
											               <option value="Buraydah">{{ __('Buraydah') }}</option>
											               <option value="Al Bahah">{{ __('Al Bahah') }}</option>
											               <option value="Dammam">{{ __('Dammam') }}</option>
											               <option value="Dhahran">{{ __('Dhahran') }}</option>
											               <option value="Dhurma">{{ __('Dhurma') }}</option>

											               <option value="Dahaban">{{ __('Dahaban') }}</option>
											               <option value="Diriyah">{{ __('Diriyah') }}</option>
											               <option value="Duba">{{ __('Duba') }}</option>
											               <option value="Dumat Al-Jandal">{{ __('Dumat Al-Jandal') }}</option>

											                              
											 </select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Date') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">

												<input class="form-control fc-datepicker hasDatepicker" name="date" placeholder="MM/DD/YYYY" type="date" id="">


											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Capacity') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="capacity" placeholder="{{ __('Space Capacity ') }} " type="number" required="required">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Price') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="price" placeholder="{{ __('Price ') }} " type="number" required="required">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Percent') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" name="percent" placeholder="{{ __('percent ') }} " type="number" required="required">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Thumbnail') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input class="form-control" id="thumbnail" name="thumbnail" placeholder="{{ __('thumbnail ') }} " type="file"  >
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Gallery') }}</label>
											</div>
	 	
											<div class="col-md-8 mg-t-5 mg-md-t-0">
 											<input required type="file" class="form-control" name="images[]" placeholder="address" multiple>

 										</div>


										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Brand') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
 													<select  id="id_brand" class="form-control" name="id_brand" required>
					                                 @foreach($brands as $brand)
					                                    
					                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
					                                   
					                                 @endforeach
					                                 </select>
											</div>
										</div>
										 
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('نوع النشاط') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="activity_type" class="form-control" name="activity_type" required>
														  <option value="musical">موسيقي</option>
											               <option value="Entertaining">ترفيهي  </option>
											                 <option value="kinetic">حركي  </option>              
											 </select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __(' الفترة  ') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="period" class="form-control" name="period" required>
														  <option value="morning"> صباحي</option>
											               <option value="evening">مسائي  </option>
											                           
											 </select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('  نوع المشاركة  ') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="post_type" class="form-control" name="post_type" required>
														  <option value="Individually"> فردي </option>
											               <option value="collective">جماعي  </option>
											                           
											 </select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('   نوع الحجز   ') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="reservation_type" class="form-control" name="reservation_type" required>
														  <option value="once">  مرة واحدة </option>
											               <option value="many">متعدد المرات  </option>
											                           
											 </select>
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('   نوع التكرار    ') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
											 <select  id="repetition_type" class="form-control" name="repetition_type" required>
														  <option value="daily"> يوميا </option>
											               <option value="weekly">   اسبوعيا  </option>
											                           
											 </select>
											</div>
										</div>
								        <div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Description') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<textarea class="form-control" name="description" placeholder=" " type="text" required="required"></textarea>  
											</div>
										</div>
								         
										 <div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('هل سيظهر في الاعلانات') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
 													 <label class="switch">
															<input name='ads' type="checkbox" value=" "  >
															<span class="slider round"></span>
												</label>
											</div>
										</div>
										
									 												
													 
									</div>
										<button type="submit" class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Create Vacation  ') }}</button>
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