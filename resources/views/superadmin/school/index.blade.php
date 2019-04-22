@extends('layouts.app')
@section('content')

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
                                    <a href="{{url('add/school')}}" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">إضافة مدرسة
                                        جديد<i
                                                class="fa fa-plus"></i></a>
                                    <button   style="color: white;float: left;font-weight: bold" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">  إضافة مدرسة وهمية
                                        جديد</button>

                                    <!-- Modal for add virtual School -->
                                    <div id="myModal" class="modal fade" role="dialog">
                                        <div class="modal-dialog">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title">اضافة مدرسة وهمية</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ url('add/school') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <input  type="hidden" name="type" value="{{\App\Helper\UsersTypes::virtualSchool}}">
                                                    <div class="form-group row">
                                                    <label for="name"
                                                           class="col-md-2 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="name" type="text"
                                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                               name="name" value="{{ old('name') }}"
                                                               autofocus>

                                                    </div>
                                                    </div>

                                                <div class="form-group row">
                                                    <label for="email"
                                                           class="col-md-2 col-form-label text-md-right">{{ __('البريد الإلكتروني') }}</label>
                                                    <div class="col-md-6">
                                                        <input id="email" type="email"
                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                               name="email" value="{{ old('email') }}"
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
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">تسجيل
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <div class="modal-footer">
                                                    {{--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>--}}
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <!-- end  Modal for add virtual School -->
                                    {{--model for add new user--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="max-width: 50% !important;
">
                                            <center>
                                                       </center>
                                        </div>

                                    </div>
                                </div>
                                {{--end modal--}}
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الإيميل</th>
                                            <th>النوع</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($schools as $school)
                                            <tr>
                                                <td id="example"><a
                                                            href="#"> {{$school->name}}</a></td>
                                                <td>{{$school->email}}</td>
                                                <td>{{\App\Helper\UsersTypes::PermissionForShool[$school->type]}}</td>

                                                <td>
                                                    <a href="{{url('edit/school/'.$school->id)}}"
                                                       class="btn btn-icon btn-outline-info radbor"> <i
                                                                class="fa fa-edit"></i></a>
                                                    <a href="#"
                                                       class="btn btn-icon btn-outline-danger radbor"><i
                                                                class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- [ HTML5 Export button ] end -->

                </div>
            </div>
        </div>
    </div>
    </div>
    <script>

        function archive(id) {
            window.location.assign("{{url('archive/')}}/" + id);
            //  window.location = {{url('archive/')}}+'/' + id;
            //   alert(id);
        }

        // $('#example').click(function () {
        //     var href = $(this).attr("href");
        //     if (href) {
        //
        //     }
        // });


    </script>


@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection

@endsection