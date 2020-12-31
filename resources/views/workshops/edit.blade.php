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
                                <a href="{{ route('admin.workshops.index') }}">
                                    <button type="button" class="btn btn-danger btn-icon mr-2"><i
                                            class="mdi mdi-arrow-left"></i></button>
                                </a>
                            </div>
                            <div class="pr-1 mb-3 mb-xl-0">
                                <div class="d-flex">
                                    <h5 class="content-title mb-0 my-auto">{{ __('Dashboard') }}</h5>
                                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Workshop') }}  </span>
                                    <span class="text-muted mt-1 tx-13 ml-2 mb-0">/ {{ __('Edit Workshop') }} </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- breadcrumb -->
                <!-- /row -->
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="main-content-label mg-b-5">
                                    {{ __('Edit Workshop') }}
                                </div>
                                <div class="pd-30 pd-sm-40 bg-gray-200">
                                    <form enctype="multipart/form-data" method="POST"
                                          action="{{route('admin.workshops.update' , ['id' => $content->id ])}}">
                                        @csrf
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Title') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" value="{{$content->name}}" placeholder=" "
                                                       type="text" name="name">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Date') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control fc-datepicker hasDatepicker"
                                                       placeholder="MM/DD/YYYY" type="date" id="dp1602760476938"
                                                       name="date" value="{{$content->date}}">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Time') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" placeholder=" " type="time" name="hour"
                                                       value="{{$content->time}}">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Address') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" placeholder=" " type="text" name="address"
                                                       value="{{$content->address}}">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('City') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="city" class="form-control" name="city" required>
                                                    <option value="{{ $content->city }}">{{ $content->city }}</option>
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
                                                <label class="form-label mg-b-0">{{ __('Capacity') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" placeholder=" " type="text" name="capacity"
                                                       value="{{$content->capacity}}">
                                            </div>
                                        </div>


                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Percent') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="percent" value="{{$content->percent}}"
                                                       placeholder="  " type="number" required="required">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Thumbnail') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <img src="/spaces/{{$content->thumbnail}}" class="   " width="70px">
                                                <input class="form-control" name="thumbnail" type="file"
                                                       value="{{ $content->thumbnail }}">
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Gallery') }}</label>
                                            </div>

                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                @if(json_decode($content->gallery, true) !== null)
                                                    @foreach(json_decode($content->gallery, true) as $image)
                                                        <img src="{{ asset('spaces/' . $image) }}" width="70px" alt="">
                                                    @endforeach
                                                @endif
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
                                                <label class="form-label mg-b-0">{{ __('نوع النشاط') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="activity_type" class="form-control" name="activity_type"
                                                        required>

                                                    <option value="musical">موسيقي</option>
                                                    <option value="Entertaining">ترفيهي</option>
                                                    <option value="kinetic">حركي</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __(' الفترة  ') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="period" class="form-control" name="period" required>

                                                    <option value="morning"> صباحي</option>
                                                    <option value="evening">مسائي</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('  نوع المشاركة  ') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select id="post_type" class="form-control" name="post_type" required>

                                                    <option value="Individually"> فردي</option>
                                                    <option value="collective">جماعي</option>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0">{{ __('Description') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <textarea class="form-control" name="description"
                                                          type="text">{{$content->description}}</textarea>
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
                                                    class="form-label mg-b-0">{{ __('Qr Code') }}</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <img src="{{ asset('qr_codes/' . $content->qrcode) }}" alt="">
                                            </div>
                                        </div>
                                        <button type="submit"
                                                class="btn btn-main-primary pd-x-30 mg-r-5 mg-t-5 btn-block">{{ __('Save Changes') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /row -->
            </div>
            <!-- Container closed -->
        </div>
        <!-- main-content closed -->
    </div>
    <!-- End Page -->
@endsection
