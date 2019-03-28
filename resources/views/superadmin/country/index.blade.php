@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container main-container">
            <div class="col-md-12">
                <!--paneeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeel-->
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <h3 class="text-center"><span class="fa fa-flag"></span>&nbsp;&nbsp;البلاد</h3>
                    </div>
                    <div class="panel-body">
                        <br>
                        @if(session("message"))
                            <div class="alert alert-info">{{session("message")}}</div>
                        @endif
                        <a class="btn btn-info" data-toggle="modal" data-target="#exampleModal"><i
                                    class="fa fa-flag"></i> إضافة بلدأخري</a>
                        <br>
                        <br>
                        <div class="row">
                            <table class="table table-striped table-bordered">
                                <thead style="background: #d8d8d8;color: #555655;">
                                <tr>
                                    <td>الرقم</td>
                                    <td>البلد</td>
                                    <td>القيمه</td>
                                    <td>الإجراء</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countrys as $country)
                                    <tr>
                                        <td>{{$country->id}}</td>
                                        <td>{{$country->name}}</td>
                                        <td>{{$country->value}}</td>
                                        <!-- we will also add show, edit, and delete buttons -->
                                        <td>
                                            <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                                            <a class="btn btn-success " data-toggle="modal" data-target="#editModal{{$country->id}}"><i
                                                        class="fa fa-edit"></i> تعديل</a>
                                            <a class="btn btn-danger"
                                               data-href="{{url('country/delete')}}/{{$country->id}}"
                                               data-toggle="modal" data-target="#confirm-delete"><i
                                                        class="fa fa-trash"></i> حذف</a>
                                        </td>
                                    </tr>
                                    {{--model for edit country--}}
                                    <div class="modal fade" id="editModal{{$country->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل البلد</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{url('country')}}/{{$country->id}}">
                                                        {{ method_field('PUT') }}
                                                        {{csrf_field()}}
                                                        <div class="form-group row">
                                                            <label for="name"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="name" type="text" value="{{$country->name}}"
                                                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                       name="name" value="{{ old('name') }}" required autofocus>
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="value"
                                                                   class="col-md-4 col-form-label text-md-right">{{ __('القيمه ') }}</label>
                                                            <div class="col-md-6">
                                                                <input id="value" type="text" value="{{$country->value}}"
                                                                       class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                                                       name="value" value="{{ old('value') }}" required>
                                                                @if ($errors->has('value'))
                                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="form-group row mb-0">
                                                            <div class="col-md-6 offset-md-4">
                                                                <button type="submit" class="btn btn-primary">تعديل</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--end modal--}}
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <br>
                        <br>
                    </div>

                </div>
            </div>
            <!--paneeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeel-->
        </div>
    </div>

    {{--model for add new country--}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">إضافة بلد جديد</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{url('country')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('الاسم ') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
                                       value="{{ old('name') }}" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="value"
                                   class="col-md-4 col-form-label text-md-right">{{ __('القيمه') }}</label>
                            <div class="col-md-6">
                                <input id="value" type="text"
                                       class="form-control{{ $errors->has('value') ? ' is-invalid' : '' }}"
                                       name="value" value="{{ old('value') }}" required>
                                @if ($errors->has('value'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('value') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">إضافة</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                </div>
            </div>
        </div>
    </div>
    {{--end modal--}}
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">تأكيد المسح</h4>
                </div>

                <div class="modal-body">
                    <p>هل تريد المسح؟ </p>
                    <p class="debug-url"></p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <a class="btn btn-danger btn-ok">مسح</a>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#confirm-delete').on('show.bs.modal', function(e) {
            $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
        });
    </script>
@endsection

