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
                                        صفحة المستخدمين
                                    </h5>
                                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">اضافه مستخدم
                                        جديد<i
                                                class="fa fa-plus"></i></a>
                                    {{--model for add new user--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form method="POST" action="{{ route('register') }}">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">اضافه مستخدم
                                                            جديد</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="name"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="name" type="text"
                                                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                       name="name" value="{{ old('name') }}" required
                                                                       autofocus>
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="email"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكترونى') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="email" type="email"
                                                                       class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                       name="email" value="{{ old('email') }}" required>
                                                                @if ($errors->has('email'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="role"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('الصلاحية') }}</label>
                                                            <div class="col-md-6">
                                                                <select name="role" class="form-control">
                                                                    @foreach(\App\Helper\UsersTypes::ArrayOfPermission as $key=>$value)
                                                                        <option value="{{$key}}"> {{$value}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('password'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('كلمة السر') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="password" type="password"
                                                                       class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                       name="password" required>
                                                                @if ($errors->has('password'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="password-confirm"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('تاكيد كلمة السر ') }}</label>

                                                            <div class="col-md-6">
                                                                <input id="password-confirm" type="password"
                                                                       class="form-control"
                                                                       name="password_confirmation" required>
                                                            </div>
                                                        </div>


                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">تسجيل
                                                                </button>
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">غلق
                                                        </button>
                                                    </div>
                                            </form>
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
                                            <th>الايميل</th>
                                            <th>الصلاحيه</th>
                                            <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($users as $user)
                                            <tr id="example" onclick="test({{$user->id}})">
                                                <td> {{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{\App\Helper\UsersTypes::ArrayOfPermission[$user->role]}}</td>
                                                <td>
                                                    <a href="#" data-toggle="modal"
                                                       data-target="#editModal{{$user->id}}"
                                                       class="btn btn-icon btn-outline-info radbor"> <i
                                                                class="fa fa-edit"></i></a>
                                                    <a href="{{url('users/delete')}}/{{$user->id}}"
                                                       class="btn btn-icon btn-outline-danger radbor"><i
                                                                class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                            {{--model for edit user--}}
                                            <div class="modal fade" id="editModal{{$user->id}}" tabindex="-1"
                                                 role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form method="POST"
                                                              action="{{url('users')}}/{{$user->id}}">
                                                            {{ method_field('PUT') }}
                                                            {{csrf_field()}}
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                    المستخدم</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="form-group row">
                                                                    <label for="name"
                                                                           class="col-md-4 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                                                                    <div class="col-md-6">
                                                                        <input id="name" type="text"
                                                                               value="{{$user->name}}"
                                                                               class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                               name="name" value="{{ old('name') }}"
                                                                               required
                                                                               autofocus>
                                                                        @if ($errors->has('name'))
                                                                            <span class="invalid-feedback"
                                                                                  role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="email"
                                                                           class="col-md-4 col-form-label text-md-right">{{ __('البريد الالكترونى') }}</label>
                                                                    <div class="col-md-6">
                                                                        <input id="email" type="email"
                                                                               value="{{$user->email}}"
                                                                               class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                                                               name="email"
                                                                               value="{{ old('email') }}" required>
                                                                        @if ($errors->has('email'))
                                                                            <span class="invalid-feedback"
                                                                                  role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="role"
                                                                           class="col-md-4 col-form-label text-md-right">{{ __('الصلاحية') }}</label>
                                                                    <div class="col-md-6">
                                                                        <select name="role" class="form-control">
                                                                            @foreach(\App\Helper\UsersTypes::ArrayOfPermission as $key=>$value)
                                                                                <option value="{{$key}}"{{($key==$user->role)?'selected':''}}> {{$value}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('password'))
                                                                            <span class="invalid-feedback"
                                                                                  role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="password"
                                                                           class="col-md-4 col-form-label text-md-right">{{ __('كلمة السر') }}</label>
                                                                    <div class="col-md-6">
                                                                        <input id="password" type="password"
                                                                               class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                                                                               name="password">
                                                                        @if ($errors->has('password'))
                                                                            <span class="invalid-feedback"
                                                                                  role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="password-confirm"
                                                                           class="col-md-4 col-form-label text-md-right">{{ __('تاكيد كلمة السر ') }}</label>

                                                                    <div class="col-md-6">
                                                                        <input id="password-confirm" type="password"
                                                                               class="form-control"
                                                                               name="password_confirmation">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="modal-footer">
                                                                <div class="form-group row mb-0">
                                                                    <div class="col-md-6 offset-md-4">
                                                                        <button type="submit"
                                                                                class="btn btn-primary">تعديل
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">
                                                                    غلق
                                                                </button>
                                                            </div>

                                                    </div>
                                                    </form>

                                                </div>
                                            </div>
                                            {{--end modal--}}
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

        function test(id) {
            window.location.assign("{{url('archive/')}}/"+id);
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
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection

@endsection