@extends('/layouts/app')

@section('content')
    <!-- main-content opened -->
    <div class="main-content horizontal-content">
        <!-- container opened -->
        @if (!$tables->isEmpty())
            <div class="container">
                <!-- breadcrumb -->
                <div class="breadcrumb-header justify-content-between">
                    <div class="my-auto">
                        <div class="d-flex my-xl-auto right-content">
                            <div class="pr-1 mb-3 mb-xl-0">
                                <a href="{{ route('admin.') }}">
                                    <button type="button" class="btn btn-danger btn-icon mr-2"><i
                                            class="mdi mdi-arrow-left"></i></button>
                                </a>
                            </div>
                            <div class="pr-1 mb-3 mb-xl-0">
                                <div class="d-flex">
                                    <h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5><span
                                        class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Tables') }}  </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex my-xl-auto right-content">
                        <div class="pr-1 mb-3 mb-xl-0">
                            <a href="{{ route('admin.tables.create') }}">
                                <button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-plus"></i>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
        @endif
            <!-- row opened -->
                <div class="col-xl-12">
                    <div class="card">
                        @if ($tables->isEmpty())
                            <div class="card-body">
                                <div class="empty_state text-center">
                                    <i class="fas fa-map-marker-alt empty_state_icon"></i>
                                    <h4>
                                        {{ __('Start adding new Table') }}
                                    </h4>
                                    <a href="{{ route('admin.tables.create') }}"
                                       class="btn bg-blue btn-labeled heading-btn"><b><i class="icon-plus"></i></b>
                                        {{ __('Create New Table') }}
                                    </a>
                                </div>
                            </div>
                        @endif @if (!$tables->isEmpty())
                            <div class="card-header pb-0">
                                <div class="d-flex justify-content-between">
                                    <h4 class="card-title mg-b-0">{{ __('Tables') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6"></div>
                                                <div class="col-sm-12 col-md-6">
                                                    <div id="example1_filter" class="dataTables_filter">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table text-md-nowrap dataTable no-footer"
                                                           id="example1" role="grid" aria-describedby="example1_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Thumbnail') }}</th>
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Qr Code') }}</th>
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Last name: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Name') }}</th>
                                                            <th class="wd-20p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Position: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Address') }}</th>
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Salary: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Capacity') }}</th>
                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Salary: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('Price') }}</th>

                                                            <th class="wd-10p border-bottom-0 sorting" tabindex="0"
                                                                aria-controls="example1" rowspan="1" colspan="1"
                                                                aria-label="Salary: activate to sort column ascending"
                                                                style="width: 175px;">{{ __('More') }}</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($tables as $table)
                                                            <tr>
                                                                <td>
                                                                    <img
                                                                        src="{{ asset('spaces/' . $table->thumbnail) }}"
                                                                        class="w-75" alt="">
                                                                </td>
                                                                <td>
                                                                    <img
                                                                        src="{{ asset('qr_codes/' . $table->qrcode) }}"
                                                                        alt="" class="w-75">
                                                                </td>
                                                                <td>{{$table->name}}</td>
                                                                <td>{{$table->address}}</td>
                                                                <td> {{$table->capacity}}</td>
                                                                <td> {{$table->price}}</td>
                                                                <td>
														<span class="ml-auto">
															<a href="{{ route('admin.spaces.edit',['id'=>$table->id]) }}"><i
                                                                    class="si si-pencil text-primary mr-2"
                                                                    data-toggle="tooltip" title="" data-placement="top"
                                                                    data-original-title="Edit"></i></a>
															<a href="javascript:void(0)" class="deletebtn"
                                                               data-toggle="modal" data-target="#deletemodalpop"> <i
                                                                    class="si si-trash text-danger mr-2  "
                                                                    data-toggle="tooltip" title="" data-placement="top"
                                                                    data-original-title="Delete"></i></a>
                                                            @if($table->qrcode !== null)
                                                                <a href="{{ asset('qr_codes/' . $table->qrcode) }}" download>
                                                                <i class="fas fa-file-download"
                                                                   data-toggle="tooltip" title="" data-placement="top"
                                                                   data-original-title="Download QrCode"></i>
                                                            @endif
                                                            </a>
                                                            <!-- Delete Modal -->
														<div class="modal fade" id="deletemodalpop" tabindex="-1"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
														  <div class="modal-dialog">
														    <div class="modal-content">
														      <div class="modal-header">
														        <h5 class="modal-title"
                                                                    id="exampleModalLabel">{{ __('Are you sure !') }}</h5>
														        <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
														          <span aria-hidden="true">&times;</span>
														        </button>
														      </div>
														      <form id="delete_modal_form" method="GET"
                                                                    action="{{route('admin.spaces.delete', $table->id)}}">
														      	@csrf

														      <div class="modal-footer">
														        <button type="button" class="btn btn-primary"
                                                                        data-dismiss="modal">{{ __('Close') }}</button>
														        <button type="submit"
                                                                        class="btn btn-danger ">{{ __('Yes Delete It') }}</button>
														      </div>
														      </form>
														    </div>
														  </div>
                                                            <!-- End Delete Modal -->

														</span>
                                                                </td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="pagination-cont">
                                                {{$tables->links()}}
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
