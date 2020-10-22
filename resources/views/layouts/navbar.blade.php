<div class="sticky">
	<div class="horizontal-main hor-menu clearfix side-header">
			<div class="horizontal-mainwrapper container clearfix">
						<!--Nav-->
						<nav class="horizontalMenu clearfix">
							<ul class="horizontalMenu-list">
								<li aria-haspopup="true">
									<a href="{{ route('admin.') }}" class="">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
											<path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
										</svg>{{ __('Dashboard') }} 
									</a>
								</li>
								<li aria-haspopup="true">
									<a href=" {{ route('admin.orders.index') }} " class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											<i class="fas fa-shopping-basket"></i>
										</svg> {{ __('Booking Requests') }}
									</a>
							 
								</li>
			 
								<li aria-haspopup="true">
									<a href="{{ route('admin.spaces.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											<i class="fas fa-map-marker-alt"></i>
										</svg> {{ __('Meeting Spaces') }}  
										<i class="fe fe-chevron-down horizontal-icon"></i>
									</a>
									 <ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('admin.spaces.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('admin.spaces.create') }}" class="slide-item">{{ __('New Space') }}</a>
										</li>
									</ul>
								</li>
								 
								</li>
				 
								<li aria-haspopup="true">
									<a href="{{ route('admin.workshops.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24" >
											<i class="fas fa-chalkboard"></i>
										</svg>
										{{ __('Workshops') }} 
										<i class="fe fe-chevron-down horizontal-icon"></i>
									</a>
									<ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('admin.workshops.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('admin.workshops.create') }}" class="slide-item">{{ __('New Workshop') }}</a>
										</li>
									</ul>
								</li>

								<li aria-haspopup="true">
									<a href="{{ route('admin.users.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											  <i class="far fa-user"></i>
										</svg> {{ __('Users') }} 
										<i class="fe fe-chevron-down horizontal-icon"></i></a>
	 								<ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('admin.users.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('admin.users.create') }}" class="slide-item">{{ __('New User') }}</a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
						<!--Nav-->
			</div>
	</div>
</div>
