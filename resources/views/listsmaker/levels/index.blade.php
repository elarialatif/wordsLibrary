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
                                        صفحة المراحل
                                    </h5>
                                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">إضافة صف جديد<i class="fa fa-plus"></i></a>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة صف جديد</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{url('grades')}}" method="post">
                                                <div class="modal-body">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    {{--<input type="hidden" name="user_id" value="{{auth()->id()}}">--}}
                                                                    <label> اسم الصف :</label>
                                                                    <input type="text" class="form-control" name="name">
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
<!--                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>-->
                                                    <button class="btn btn-primary" type="submit"> <span class="fa fa-plus"> إضافة </span>
                                                    </button>
                                                </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الإجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($grades as $grade)
                                            <tr>
                                                <td style="width: 50%">{{$grade->name}}</td>
                                                <td>
                                                    <a data-toggle="modal" data-target="#exampleModal{{$grade->id}}" href=""
                                                       class="btn btn-icon btn-outline-info radbor"> <i class="fa fa-edit"></i></a>
                                                    {{--Modal for Edit levels--}}
                                                    <div class="modal fade" id="exampleModal{{$grade->id}}" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل المرحلة</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form action="{{url('grades')}}/{{$grade->id}}" method="post">
                                                                    <div class="modal-body">
                                                                        {{ method_field('PUT') }}
                                                                        {{csrf_field()}}
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label> اسم المرحلة :</label>
                                                                                    <input type="text" class="form-control"
                                                                                           value="{{$grade->name}}" name="name">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                                data-dismiss="modal">غلق
                                                                        </button>
                                                                        <button type="submit" class="btn btn-primary">تعديل</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--End Modal--}}
                                                    <a href="{{url('grades/delete')}}/{{$grade->id}}"  class="btn btn-icon btn-outline-danger radbor"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')

    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection

@endsection