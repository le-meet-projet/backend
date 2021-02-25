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
                                <a href="{{ route('admin.spaces.index', ['type' => $type]) }}">
                                    <button type="button" class="btn btn-danger btn-icon mr-2">
                                        <i class="mdi mdi-arrow-left"></i></button>
                                </a>
                            </div>
                            <div class="pr-1 mb-3 mb-xl-0">
                                <div class="d-flex">
                                    <h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5><span
                                        class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('New Meeting Space') }}  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- breadcrumb -->
                <!-- row -->
                <form method="POST" id="upload" action="{{route('admin.spaces.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="main-content-label mg-b-5">
                                        {{ __('Add A New Meeting Space') }}
                                    </div>
                                    <p class="mg-b-20">{{ __('All fields are required') }}* </p>
                                    <div class="pd-30 pd-sm-40 bg-gray-200">
                                        <input type="hidden" name="type_space" value="{{ $type }}">
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Name') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="name"
                                                       placeholder="{{ __('Space Name ') }} " type="text" required="">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Address') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="address"
                                                       placeholder="{{ __('Space Address ') }} " type="text"
                                                       required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('City') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="city" class="form-control" name="city" required>
                                                    <option value="riad">الرياض</option>
                                                    <option value="jaddah">جدة</option>
                                                    <option value="damam">الدمام</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Capacity') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="capacity"
                                                       placeholder="{{ __('Space Capacity ') }} " type="number"
                                                       required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Price') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="price"
                                                       placeholder="{{ __('Price ') }} " type="number"
                                                       required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Percent') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="percent"
                                                       placeholder="{{ __('percent ') }} " type="number"
                                                       required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('IBAN') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="iban"
                                                       placeholder="{{ __('IBAN ') }} " type="text"
                                                       required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Thumbnail') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" id="thumbnail" name="thumbnail"
                                                       placeholder="{{ __('thumbnail ') }} " type="file">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Gallery') }}</label>
                                            </div>

                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input type="file" class="form-control" name="images[]"
                                                       placeholder="address" multiple>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Brand') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="id_brand" class="form-control" name="id_brand" required>
                                                    @foreach($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('الخصائص') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0 d-flex justify-content-between">
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="wifi" value="wifi">
                                                    <label class="form-check-label" for="wifi">ويفي</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="display" value="display_screen">
                                                    <label class="form-check-label" for="display">شاشة عرض</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="conditioner" value="conditioner">
                                                    <label class="form-check-label" for="conditioner">مكيف</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="blackboard" value="blackboard">
                                                    <label class="form-check-label" for="blackboard">سبورة</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="speaker" value="speaker">
                                                    <label class="form-check-label" for="speaker">مكبر صوت</label>
                                                </div>
                                                <div class="form-group form-check">
                                                    <input type="checkbox" class="form-check-input" name="properties[]" id="presentation_tools" value="presentation_tools">
                                                    <label class="form-check-label" for="presentation_tools">أدوات العروض</label>
                                                </div>                                                 
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Description') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <textarea class="form-control" name="description"
                                                          type="text"></textarea>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label
                                                    class="form-label mg-b-0">{{ __('هل سيظهر في الاعلانات') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <label class="switch">
                                                    <input name='ads' type="checkbox" value=" ">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label
                                                    class="form-label mg-b-0">{{ __('Location') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <div id='map_canvas' style="height: 500px;"></div>
                                                <div id="current"></div>
                                                <input type="hidden" name="latitude" id="latitude" value="24.716">
                                                <input type="hidden" name="longitude" id="longitude" value="46.683">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Create New Space') }}</button>
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
