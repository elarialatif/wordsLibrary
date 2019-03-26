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
                                        صفحة اختبارات تحديد المستوى
                                    </h5>
                                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">إضافة اختبار جديد<i
                                                class="fa fa-plus"></i></a>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" style="width: 70% !important;" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة اختبار
                                                        جديد</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="container">
                                                    <form method="post" action="{{url('PlacementTests/save')}}">
                                                        {{csrf_field()}}
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">الاسم</label>
                                                            <input type="text" class="form-control"
                                                                   id="exampleInputEmail1"
                                                                   aria-describedby="emailHelp" placeholder="exam_name"
                                                                   required
                                                                   name="exam_name" minlength="4">

                                                        </div>


                                                        <div class="form-group">
                                                            <label for="exampleSelect1">الصف</label>
                                                            <select class="form-control" id="exampleSelect1"
                                                                    name="grade_id"
                                                                    required>
                                                                <option value="">--------------</option>
                                                                @foreach($grades as $grade)
                                                                    <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>

                                                        <div class="row form-group">
                                                            <div class="col-md-4">
                                                                {{ Form::label('article', 'توجيهات الامتحان للطالب', array('class' => 'col-form-label')) }}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-md-12">
                                                                {{ Form::textarea('instructions', '', array('class' => 'form-control editor')) }}
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleSelect1">الحالة</label>
                                                            <select class="form-control" id="exampleSelect1"
                                                                    name="status" required>
                                                                <option value="">--------------</option>

                                                                <option value="1">
                                                                    مفعل
                                                                </option>
                                                                <option value="0">
                                                                    غير مفعل
                                                                </option>


                                                            </select>
                                                        </div>


                                                        <button type="submit" class="btn btn-success"><i
                                                                    class="fa fa-plus"></i> إضافة
                                                        </button>

                                                    </form>
                                                </div>

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
                                                <th>الصف</th>
                                                <th>الحالة</th>
                                                <th>عدد الأسئلة</th>
                                                <th>تاريخ الإنشاء</th>
                                                <th>آخر تحديث</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($tests as $test)
                                                @php
                                                    $placement_test_questions = \App\Models\PlacementTestQuestion::where('exam_id', $test->id)->get()->count();
                                                @endphp
                                                <tr>
                                                    <td>{!! $test->exam_name !!}</td>
                                                    <td>{{$test->grade->name}}</td>
                                                    <td>{{($test->status==0)? 'غير مفعل':'مفعل'}}</td>
                                                    <td>{{$placement_test_questions}}</td>
                                                    <td>{{$test->created_at->format('Y:m:d') . " الساعه " . $test->created_at->format('H')}}</td>
                                                    <td>{{$test->updated_at->format('Y:m:d') . " الساعه " . $test->created_at->format('H')}}</td>
                                                    <td>
                                                        <a href="{{url('PlacementTests/questions/index/'.$test->id)}}" class="btn btn-icon btn-outline-success radbor"><i class="fa fa-plus-square"></i></a>
                                                        <a href="" data-toggle="modal" data-target="#editModal{{$test->id}}" class="btn btn-icon btn-outline-info radbor"> <i class="fa fa-edit"></i></a>
                                                        <a href="{{url('PlacementTests/delete/'.$test->id)}}" class="btn btn-icon btn-outline-danger radbor"><i class="fa fa-trash"></i></a>

                                                    </td>
                                                    {{--model for edit user--}}
                                                    <div class="modal fade" id="editModal{{$test->id}}" tabindex="-1"
                                                         role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" action="{{url('PlacementTests/update')}}/{{$test->id}}">
                                                                    @csrf
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل الاختبار</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="exampleInputEmail1">الاسم</label>
                                                                            <input type="text" class="form-control" id="exampleInputEmail1" value="{{$test->exam_name}}" aria-describedby="emailHelp" placeholder="exam_name" required name="exam_name" minlength="4">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleSelect1">الصف</label>
                                                                            <select class="form-control" id="exampleSelect1" name="grade_id" required>
                                                                                <option value="">--------------</option>
                                                                                @foreach($grades as $grade)
                                                                                    <option value="{{$grade->id}}"{{($grade->id==$test->grade_id)?'selected':''}} >{{$grade->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-md-4">
                                                                                {{ Form::label('article', 'توجيهات الامتحان للطالب', array('class' => 'col-form-label')) }}
                                                                            </div>
                                                                        </div>
                                                                        <div class="row form-group">
                                                                            <div class="col-md-12">
                                                                                {!! Form::textarea('instructions', $test->instructions, array('class' => 'form-control editor')) !!}
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="exampleSelect1">الحالة</label>
                                                                            <select class="form-control" id="exampleSelect1" name="status" required>
                                                                                <option value="">--------------</option>
                                                                                <option value="1"{{($test->status==1)?'selected':''}}>مفعل</option>
                                                                                <option value="0"{{($test->status==0)?'selected':''}}>غير مفعل</option>
                                                                            </select>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> تعديل
                                                                        </button>
                                                                    </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                    {{--end modal--}}
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