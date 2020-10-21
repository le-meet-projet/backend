<div class="sticky">
	<div class="horizontal-main hor-menu clearfix side-header">
			<div class="horizontal-mainwrapper container clearfix">
						<!--Nav-->
						<nav class="horizontalMenu clearfix">
							<ul class="horizontalMenu-list">
								<li aria-haspopup="true">
									<a href="{{ route('home.') }}" class="">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24" >
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M5 5h4v6H5zm10 8h4v6h-4zM5 17h4v2H5zM15 5h4v2h-4z" opacity=".3"/>
											<path d="M3 13h8V3H3v10zm2-8h4v6H5V5zm8 16h8V11h-8v10zm2-8h4v6h-4v-6zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/>
										</svg>{{ __('Dashboard') }} 
									</a>
								</li>
								<li aria-haspopup="true">
									<a href=" {{ route('home.orders.index') }} " class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M19 5H5v14h14V5zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" opacity=".3"/><path d="M3 5v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2zm2 0h14v14H5V5zm2 5h2v7H7zm4-3h2v10h-2zm4 6h2v4h-2z"/>
										</svg> {{ __('Booking Requests') }}
									</a>
							 
								</li>
			 
								<li aria-haspopup="true">
									<a href="{{ route('home.spaces.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M6.26 9L12 13.47 17.74 9 12 4.53z" opacity=".3"/>
											<path d="M19.37 12.8l-7.38 5.74-7.37-5.73L3 14.07l9 7 9-7zM12 2L3 9l1.63 1.27L12 16l7.36-5.73L21 9l-9-7zm0 11.47L6.26 9 12 4.53 17.74 9 12 13.47z"/>
										</svg> {{ __('Meeting Spaces') }}  
										<i class="fe fe-chevron-down horizontal-icon"></i>
									</a>
									 <ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('home.spaces.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('home.spaces.create') }}" class="slide-item">{{ __('New Space') }}</a>
										</li>
									</ul>
								</li>
								 
								</li>
				 
								<li aria-haspopup="true">
									<a href="{{ route('home.workshops.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 24 24" class="side-menu__icon" viewBox="0 0 24 24" >
											<g> <rect fill="none"/></g>
											<g>
												<g>
													<path d="M21,5c-1.11-0.35-2.33-0.5-3.5-0.5c-1.95,0-4.05,0.4-5.5,1.5c-1.45-1.1-3.55-1.5-5.5-1.5S2.45,4.9,1,6v14.65 c0,0.25,0.25,0.5,0.5,0.5c0.1,0,0.15-0.05,0.25-0.05C3.1,20.45,5.05,20,6.5,20c1.95,0,4.05,0.4,5.5,1.5c1.35-0.85,3.8-1.5,5.5-1.5 c1.65,0,3.35,0.3,4.75,1.05c0.1,0.05,0.15,0.05,0.25,0.05c0.25,0,0.5-0.25,0.5-0.5V6C22.4,5.55,21.75,5.25,21,5z M3,18.5V7 c1.1-0.35,2.3-0.5,3.5-0.5c1.34,0,3.13,0.41,4.5,0.99v11.5C9.63,18.41,7.84,18,6.5,18C5.3,18,4.1,18.15,3,18.5z M21,18.5 c-1.1-0.35-2.3-0.5-3.5-0.5c-1.34,0-3.13,0.41-4.5,0.99V7.49c1.37-0.59,3.16-0.99,4.5-0.99c1.2,0,2.4,0.15,3.5,0.5V18.5z"/>
													<path d="M11,7.49C9.63,6.91,7.84,6.5,6.5,6.5C5.3,6.5,4.1,6.65,3,7v11.5C4.1,18.15,5.3,18,6.5,18 c1.34,0,3.13,0.41,4.5,0.99V7.49z" opacity=".3"/>
												</g>
												<g>
													<path d="M17.5,10.5c0.88,0,1.73,0.09,2.5,0.26V9.24C19.21,9.09,18.36,9,17.5,9c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,10.69,16.18,10.5,17.5,10.5z"/>
													<path d="M17.5,13.16c0.88,0,1.73,0.09,2.5,0.26V11.9c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,13.36,16.18,13.16,17.5,13.16z"/>
													<path d="M17.5,15.83c0.88,0,1.73,0.09,2.5,0.26v-1.52c-0.79-0.15-1.64-0.24-2.5-0.24c-1.28,0-2.46,0.16-3.5,0.47v1.57 C14.99,16.02,16.18,15.83,17.5,15.83z"/>
												</g>
											</g>
										</svg>
										{{ __('Workshops') }} 
										<i class="fe fe-chevron-down horizontal-icon"></i>
									</a>
									<ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('home.workshops.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('home.workshops.create') }}" class="slide-item">{{ __('New Workshop') }}</a>
										</li>
									</ul>
								</li>

								<li aria-haspopup="true">
									<a href="{{ route('home.users.index') }}" class="sub-icon">
										<svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" viewBox="0 0 24 24">
											<path d="M0 0h24v24H0V0z" fill="none"/>
											<path d="M6 20h12V10H6v10zm6-7c1.1 0 2 .9 2 2s-.9 2-2 2-2-.9-2-2 .9-2 2-2z" opacity=".3"/>
											<path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6zm9 14H6V10h12v10zm-6-3c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2z"/>
										</svg> {{ __('Users') }} 
										<i class="fe fe-chevron-down horizontal-icon"></i></a>
	 								<ul class="sub-menu">
										<li aria-haspopup="true">
											<a href="{{ route('home.users.index') }}" class="slide-item">{{ __('All') }}</a>
										</li>
										<li aria-haspopup="true">
											<a href="{{ route('home.users.create') }}" class="slide-item">{{ __('New User') }}</a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
						<!--Nav-->
			</div>
	</div>
</div>
