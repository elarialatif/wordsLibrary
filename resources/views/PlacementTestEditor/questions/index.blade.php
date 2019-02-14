@extends('layouts.app')
@section('content')
    <style>
        .mce-menu {
            position: fixed !important
        }

    </style>
    <div class="container">
        <div class="container">

            <div class="main-body placement_modal">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ HTML5 Export button ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        {{$placementTest->exam_name}} >> {{$placementTest->grade->name}} >> صفحة الاسئلة
                                    </h5>
                                    <a href="{{url('PlacementTests/questions/create/'.$placement_id)}}"
                                       class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">اضافه اسئلة جديد<i
                                                class="fa fa-plus"></i></a>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table id="key-act-button"
                                               class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>الكود</th>
                                                <th>الاسم</th>
                                                <th>تاريخ الانشاء</th>
                                                <th>اخر تحديث</th>
                                                <th>الاجراءت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($testQuestions as $testQuestion)
                                                <?php

                                                $content = preg_replace("/<img[^>]+\>/i", "", $testQuestion->question);
                                                $content_remove_p = str_ireplace('<p>', "", $content);
                                                $content_remove_p2 = str_ireplace('</p>', '', $content_remove_p);
                                                $question_name = substr($content_remove_p2, 0, 100);

                                                ?>
                                                <tr>
                                                    <td>{{$testQuestion->id}}</td>
                                                    <td>{!! $question_name !!}</td>
                                                    <td>{{$testQuestion->created_at->format('Y:m:d') . " الساعه " . $testQuestion->created_at->format('H')}}</td>
                                                    <td>{{$testQuestion->updated_at->format('Y:m:d') . " الساعه " . $testQuestion->created_at->format('H')}}</td>
                                                    <td>
                                                        <a href="" data-toggle="modal"
                                                           data-target="#viewModal{{$testQuestion->id}}"
                                                           class="btn btn-icon btn-outline-info radbor"> <i
                                                                    class="fa fa-eye"></i></a>
                                                        <a href="" data-toggle="modal"
                                                           data-target="#editModal{{$testQuestion->id}}"
                                                           class="btn btn-icon btn-outline-secondary radbor"> <i
                                                                    class="fa fa-edit"></i></a>
                                                        <a href="{{url('PlacementTests/question/delete/'.$testQuestion->id)}}"
                                                           class="btn btn-icon btn-outline-danger radbor"><i
                                                                    class="fa fa-trash"></i></a>

                                                    </td>
                                                </tr>
                                                {{-- question view--}}
                                                <div class="modal fade " id="viewModal{{$testQuestion->id}}"
                                                     tabindex="-1"
                                                     role="dialog"
                                                     aria-hidden="true">
                                                    <div class="modal-dialog" style="max-width: 70% !important;"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                    السؤال</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">

                                                                <div class="row"
                                                                     style="font-size: 17px;font-weight: bold">
                                                                    <div class="col-md-8">
                                                                        السؤال:<br>
                                                                        <div class="form-group">

                                                                                <textarea type="text" class="mceEditor"
                                                                                          name="question"> {!! $testQuestion->question !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        الاختيار الاول:<br>
                                                                        <div class="form-group">
                                                                            <input readonly required type="text"
                                                                                   name="ans1"
                                                                                   value="{{$testQuestion->ans1}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        الاختيار الثاني:<br>
                                                                        <div class="form-group">
                                                                            <input readonly required type="text"
                                                                                   name="ans2"
                                                                                   value="{{$testQuestion->ans2}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        الاختيار الثالث:<br>
                                                                        <div class="form-group">
                                                                            <input readonly required type="text"
                                                                                   name="ans3"
                                                                                   value="{{$testQuestion->ans3}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        الاختيار الرابع:<br>
                                                                        <div class="form-group">
                                                                            <input readonly required type="text"
                                                                                   name="ans4"
                                                                                   value="{{$testQuestion->ans4}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        الاجابه الصحيحه:<br>
                                                                        <div class="form-group">
                                                                            <select disabled class="form-control"
                                                                                    name="true_answer" required>
                                                                                <option value="">اختر الاجابه
                                                                                </option>
                                                                                <option value="ans1" {{($testQuestion->true_answer=='ans1')?'selected':''}}>
                                                                                    الاختيار الاول
                                                                                </option>
                                                                                <option value="ans2" {{($testQuestion->true_answer=='ans2')?'selected':''}}>
                                                                                    الاختيار الثاني
                                                                                </option>
                                                                                <option value="ans3" {{($testQuestion->true_answer=='ans3')?'selected':''}}>
                                                                                    الاختيار الثالث
                                                                                </option>
                                                                                <option value="ans4" {{($testQuestion->true_answer=='ans4')?'selected':''}}>
                                                                                    الاختيار الرابع
                                                                                </option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">غلق
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- end question edit--}}
                                                {{-- question edit--}}
                                                <div class="modal fade" id="editModal{{$testQuestion->id}}"
                                                     role="dialog"
                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" style="max-width: 70% !important;"
                                                         role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                    السؤال</h5>
                                                                <button type="button" class="close"
                                                                        data-dismiss="modal"
                                                                        aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                      action="{{url('PlacementTests/questions/update')}}/{{$testQuestion->id}}">
                                                                    @csrf
                                                                    <div class="row">
                                                                        <div class="col-md-8">
                                                                            السؤال:<br>
                                                                            <div class="form-group">
                                                                                <textarea type="text" class="mceEditor"
                                                                                          name="question"> {!! $testQuestion->question!!}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            الاختيار الاول:<br>
                                                                            <div class="form-group">
                                                                                <input required type="text"
                                                                                       name="ans1"
                                                                                       value="{{$testQuestion->ans1}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            الاختيار الثاني:<br>
                                                                            <div class="form-group">
                                                                                <input required type="text"
                                                                                       name="ans2"
                                                                                       value="{{$testQuestion->ans2}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            الاختيار الثالث:<br>
                                                                            <div class="form-group">
                                                                                <input required type="text"
                                                                                       name="ans3"
                                                                                       value="{{$testQuestion->ans3}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            الاختيار الرابع:<br>
                                                                            <div class="form-group">
                                                                                <input required type="text"
                                                                                       name="ans4"
                                                                                       value="{{$testQuestion->ans4}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            الاجابه الصحيحه:<br>
                                                                            <div class="form-group">
                                                                                <select class="form-control"
                                                                                        name="true_answer" required>
                                                                                    <option value="">اختر الاجابه
                                                                                    </option>
                                                                                    <option value="ans1" {{($testQuestion->true_answer=='ans1')?'selected':''}}>
                                                                                        الاختيار الاول
                                                                                    </option>
                                                                                    <option value="ans2" {{($testQuestion->true_answer=='ans2')?'selected':''}}>
                                                                                        الاختيار الثاني
                                                                                    </option>
                                                                                    <option value="ans3" {{($testQuestion->true_answer=='ans3')?'selected':''}}>
                                                                                        الاختيار الثالث
                                                                                    </option>
                                                                                    <option value="ans4" {{($testQuestion->true_answer=='ans4')?'selected':''}}>
                                                                                        الاختيار الرابع
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <button class="btn btn-primary"
                                                                            type="submit"><span
                                                                                class="fa fa-plus"></span>إضافة
                                                                    </button>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">غلق
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                {{-- end question edit--}}
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