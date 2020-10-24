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
										<a href="{{ route('admin.users.index') }}">
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

						</div>
					<!-- breadcrumb -->		 
					<!-- /row -->
					<!-- row -->
					<form enctype="multipart/form-data" id="user_form" method='post' action="{{ route('admin.users.update',['id'=>$content->id]) }}">
						@csrf 
					<div class="row">
						<div class="col-lg-12 col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="main-content-label mg-b-5">
										{{ __(' Edit User') }}
									</div>
									 <p>{{ __('all information are in safe hands') }}</p>
									 <div class="pd-30 pd-sm-40 bg-gray-200">
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Name') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input required=""class="form-control" placeholder="{{ __('User Name') }} "  name="name" type="text" value="{{ $content->name }}">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Email') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input required="" class="form-control "name="email" placeholder=" {{ __('User Email') }}" type="mail" value="{{ $content->email }}">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Phone Number') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<input required=""class="form-control" name="phone" placeholder=" {{ __('User Phone Number') }}" type="number" value="{{ $content->phone }}">
											</div>
										</div>
										<div class="row row-xs align-items-center mg-b-20">
											<div class="col-md-4">
												<label class="form-label mg-b-0">{{ __('Role') }}</label>
											</div>
											<div class="col-md-8 mg-t-5 mg-md-t-0">
												<select name="role" id="input-role" class="form-control">
													<option value="{{ $content->role }}">{{ $content->role }} </option>
													@if($content->role == 'admin')
													<option value="user">{{ __('user') }}  </option>
													@elseif($content->role == 'user')
													<option value="admin">{{ __('admin') }}</option>
													@else
													<option value="user">{{ __('user') }}  </option>
													<option value="admin">{{ __('admin') }}</option>
													@endif
											   </select> 

											</div>
										</div>												 
									</div>
							 </div>
  							<div class="card-body">
								   <div class="main-content-label mg-b-5">
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

									</div>																							<div class="col-md-3">
                                <a onclick="password_generator()" class="btn btn-primary">{{ __('create strong password') }}</a>
                            </div> 
							</div>

							</div>
								<button class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Save Changes') }}</button>
									 
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