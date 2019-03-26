@extends('layouts.app')
@section('content')
    <script type="text/javascript"
            src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-locationpicker/0.1.12/locationpicker.jquery.js"></script>
    <?php
    $lat = !empty(old('lat')) ? old('lat') : 30.04546710125749;
    $lng = !empty(old('lng')) ? old('lng') : 31.23487663269043;
    ?>
    <style>
        .showUser {
            position: absolute;
            border: none;
            margin-top: 21px !important;
            min-width: 290px;
        }
    </style>
    <div class="container">
        <div class="container">

            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ HTML5 Export button ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        صفحة المدارس
                                    </h5>
                                    <a href="{{url('view/schools')}}" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">كل المدراس
                                        <i
                                                class="fa fa-eye"></i></a>

                                </div>

                            </div>
                        </div>
                        {{--end modal--}}
                    </div>
                    <div class="card-block">
                        <form method="post" action="{{ url('edit/school/'.$user->id) }}" enctype="multipart/form-data">

                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">إضافة مدرسة
                                        جديد</h5>

                                </div>
                                <div class="modal-body">

                                    @csrf
                                    <div class="form-group row">
                                        <input type="hidden" value="{{ $school->lat }}" name="lat" id="lat">
                                        <input type="hidden" value="{{  $school->lng }}" name="lng" id="lng">
                                        <label for="name"
                                               class="col-md-2 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                                        <div class="col-md-6">
                                            <input id="name" type="text"
                                                   class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                   name="name" value="{{ $user->name }}"
                                                   autofocus>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email"
                                               class="col-md-2 col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label>
                                        <div class="col-md-6">
                                            <input id="email" type="email"
                                                   class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                   name="email" value="{{ $user->email }}"
                                            >

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password"
                                               class="col-md-2 col-form-label text-md-right">{{ __('كلمة السر') }}</label>
                                        <div class="col-md-6">
                                            <input id="password" type="password"
                                                   class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                   name="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('تأكيد كلمة السر ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password"
                                                   class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}"
                                                   value="{{ old('password_confirmation') }}"
                                                   name="password_confirmation">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('تاريخ البداية ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="date"
                                                   class="form-control{{ $errors->has('start_at') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->start_at }}"
                                                   name="start_at" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('تاريخ النهاية  ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="date"
                                                   class="form-control{{ $errors->has('end_at') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->end_at }}"
                                                   name="end_at">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('عدد المستخدمين  ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="number"
                                                   class="form-control{{ $errors->has('acc_num') ? ' is-invalid' : '' }}"
                                                   value="{{$school->num_acc }}"
                                                   min="0"
                                                   name="acc_num">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('عدد طلاب المدرسة ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="number"
                                                   class="form-control{{ $errors->has('student_num') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->student_num }}"
                                                   min="0"
                                                   name="student_num">
                                        </div>
                                    </div>

                                    <div class="form-group">

                                    </div>
                                    <div class="form-group row">
                                        <label for="address"
                                               class="col-md-2 col-form-label text-md-right">{{ __('العنوان ') }}</label>
                                        <div class="col-md-6">
                                            <input id="address" type="text"
                                                   class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}"
                                                   value="{{ old('address') }}" name="address"/>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-10">
                                            <div id="us1"
                                                 style="width: 100%; height: 400px;">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('شعار المدرسة') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="file"
                                                   class="form-control"
                                                   name="logo">
                                            <img style="width: 200px ;height: 200px"
                                                 src="{{url('public/schoolsLogos/'.$school->logo)}}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('الموقع الاكترونى ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="text"
                                                   class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->website }}"
                                                   name="website">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __('رقم المحمول ') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="number"
                                                   class="form-control{{ $errors->has('mobile') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->mobile }}"
                                                   min="0"
                                                   name="mobile">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password-confirm"
                                               class="col-md-2 col-form-label text-md-right">{{ __(' الفسبوك') }}</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="text"
                                                   class="form-control{{ $errors->has('facebook') ? ' is-invalid' : '' }}"
                                                   value="{{ $school->facebook }}"
                                                   name="facebook">
                                        </div>
                                    </div>


                                </div>
                                <div class="modal-footer">
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">تعديل
                                            </button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- [ HTML5 Export button ] end -->
        </div>
        <script>
            $('#us1').locationpicker({
                location: {
                    latitude: '{{ $lat }}',
                    longitude: '{{ $lng }}'
                },
                locationName: "",

                radius: 300,
                markerIcon: '{{ url('desgin/adminlte/dist/img/map-marker-2-xl.png')}}',
                inputBinding: {
                    locationNameInput: $('#address'),
                    latitudeInput: $('#lat'),
                    longitudeInput: $('#lng')
                    //radiusInput: $('#us2-radius'),
                    // locationNameInput: null,
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                }
            });
        </script>
        @endsection
        / {{-- this is important thing dont remove it ,it fix a huge issue in the project--}}