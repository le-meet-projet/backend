
 
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
													<h6>{{$orders->user->name}}</h6>
													<p>{{ $orders->user->address }}<br>
													{{ __('Tel No') }}: {{$orders->user->phone}}<br>
													{{ __('Email') }}: {{$orders->user->email}}</p>
												</div>
											</div>
											<div class="col-md">
												<label class="tx-gray-600">{{ __('Invoice Information') }}</label>
												<p class="invoice-info-row"><span>{{ __('Invoice No') }}</span> <span>{{$orders->id}}</span></p>
												<!-- <p class="invoice-info-row"><span>{{ __('Project ID') }}</span> <span>{{$orders->id}}</span></p> -->
												<p class="invoice-info-row"><span>{{ __('Issue Date') }}:</span> <span>{{$orders->created_at}}</span></p>
												<p class="invoice-info-row"><span>{{ __('Due Date') }}:</span><span>{{$orders->deleted_at}}</span></p>
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
														<td>{{$orders->type}}</td>
														<td class="tx-12">{{$orders->description}}</td>
														<td class="tx-center">{{$orders->created_at}}</td>
														<td class="tx-right">{{$orders->price}} $</td>
													</tr>
										 
													<tr>
														<td class="valign-middle" colspan="2" rowspan="4">
															<div class="invoice-notes">
																<label class="main-content-label tx-13">{{ __('Notes') }}</label>
																<p>{{ __('Le meet is a great tool to find your meeting space ....') }}</p>
															</div> 
														</td>
														<td class="tx-right">{{ __('Sub-Total') }}</td>
														<td class="tx-right" colspan="2">${{$sub_total}}</td>
													</tr>
													<tr>
														<td class="tx-right">{{ __('Tax ') }}({{$orders->coupon}}%)</td>
														<td class="tx-right" colspan="2">{{$discount}}</td>
													</tr>
													<tr>
														<td class="tx-right tx-uppercase tx-bold tx-inverse">{{ __('Total Due') }}</td>
														<td class="tx-right" colspan="2">
															<h4 class="tx-primary tx-bold">${{$duo_total}}</h4>
														</td>
													</tr>
												</tbody>
											</table>
										</div>
										<hr class="mg-b-40">
										

									</div>
									</div>
								</div>
							</div>
						</div><!-- COL-END -->
					</div>


					<script type="text/javascript">
                                      	 printd:{
                                                window.print()
                                                 }
                                      
                                      </script>