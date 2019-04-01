@extends('layouts.app')
@section('content')
    <style>
        .mce-menu {
            position: fixed !important
        }
        .mce-tooltip {
                           position: fixed !important
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
                                        صفحة المراجعة المقال ال{{\App\Helper\ArticleLevels::getLevel($artical->level)}}
                                    </h5>
                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                        <a style="float: left" href="{{url('languestic/done/'.$artical->id)}}"
                                           class="btn btn-success">
                                            تمت المراجعة <i class="fas fa-question-circle"></i>
                                        </a>

                                    @else
                                        <p class="btn btn-info" style="float:left;font-weight: bold;">تمت المراجعة
                                            اللغويه <i class="fas fa-check-circle"></i></p>
                                    @endif
                                    <a href="{{url('languestic/'.$page)}}" class="btn btn-dark"
                                       style="float:left">رجوع<i class="fas fa-reply"></i></a>

                                </div>

                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h6 style="font-size: 20px">المقال الأساسي
                                            </h6>
                                            <a href="" data-toggle="modal"
                                               data-target="#normalArticalModal{{$artical->id}}"
                                               class="btn btn-icon btn-outline-warning radbor"><i
                                                        class="fas fa-exclamation-triangle"></i></a>
                                            <a href="" data-toggle="modal"
                                               data-target="#editNormalArtical{{$artical->id}}"
                                               class="btn btn-icon btn-outline-info radbor"><i class="fas fa-edit"></i></a>
                                            {{--model for edit artical--}}
                                            <div class="modal fade" id="editNormalArtical{{$artical->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 80%!important;"
                                                     role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                المقال الأساسي</h5>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                  action="{{url('editor/save/article')}}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="articleNormal" class="col-form-label">المقال:</label>
                                                                    <textarea class="mceEditor form-control"
                                                                              required
                                                                              name="articleNormal">{!! $artical->article !!}</textarea>
                                                                    <input type="hidden" name="list_id"
                                                                           value="{{$artical->list_id}}">
                                                                    <input type="hidden" name="level"
                                                                           value="{{$artical->level}}">
                                                                </div>

                                                                <button class="btn btn-primary" type="submit">
                                                                    <span class="fa fa-plus"></span>إضافة
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
                                            {{--end modal--}}
                                            <div id="tinymcFont"><span
                                                        id="articaasdasdl">   {!! $artical->article !!} </span></div>
                                            <div id="Issues">
                                                <div class="table-responsive">
                                                    @php
                                                        $issue=\App\Models\Issues::where(['field_id'=>$artical->id,'table'=>'article','type'=>'Normal','user_id'=>auth()->id()                                           ])->get();@endphp
                                                    @if($issue->count()>0)
                                                        <table
                                                                class="display table nowrap table-striped table-hover"
                                                                style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>الكود</th>
                                                                <th>العنوان</th>
                                                                <th>الملاحظة</th>
                                                                <th>الحالة</th>
                                                                @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                    <th>الإجراء</th>@endif
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($issue as $issue)
                                                                <tr>
                                                                    <td>{{$issue->id}}</td>
                                                                    <td>{{$issue->title}}</td>
                                                                    <td>{{$issue->name}}</td>
                                                                    <td>@if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                                                        @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                                                        @else
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                                                        @endif
                                                                    </td>
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <td>
                                                                            <a data-toggle="modal"
                                                                               data-target="#editIssue{{$issue->id}}"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            <a href="{{url('issues/delete/'.$issue->id)}}"><i
                                                                                        class="fa fa-trash"></i></a>
                                                                        </td>@endif
                                                                </tr>
                                                                {{--model for edit Issuses--}}
                                                                <div class="modal fade" id="editIssue{{$issue->id}}"
                                                                     tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    تعديل ملاحظة</h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{url('issues/edit/'.$issue->id)}}"
                                                                                      method="post">
                                                                                    @csrf
                                                                                    <label><h4>العنوان</h4></label>
                                                                                    <input type="text" name="title"
                                                                                           class="form-control"
                                                                                           value="{{$issue->title}}">
                                                                                    <br>
                                                                                    <label><h4>الملاحظة</h4></label>
                                                                                    <textarea name="name" rows="6"
                                                                                              cols="55"> {!!$issue->name!!}</textarea>
                                                                                    {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                                    {{--<input type="hidden" name="table" value="question">--}}
                                                                                    <select class="form-control"
                                                                                            name="step"
                                                                                            required>
                                                                                        <option value="">الحالة</option>
                                                                                        <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                        <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                                    </select>
                                                                                    <br>
                                                                                    <br>
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">
                                                                                        تعديل
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">غلق
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{--end modal--}}
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="card-header" id="Issues">
                                                <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                </v>
                                                <h6 style="font-size: 20px">الأسئلة الأساسية
                                                </h6>
                                                @foreach($questions as $question)
                                                    <div class="table-responsive" style="display: inline-block">
                                                        <table
                                                                class="display table nowrap table-striped table-hover"
                                                                style="width:100%;float: right">
                                                            <thead>
                                                            <tr>
                                                                <th width="50%">/</th>
                                                                <th width="50%">القيمة</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    السؤال
                                                                </td>
                                                                <td>
                                                                    {!! $question->question !!}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الأولى
                                                                </td>
                                                                <td>{{$question->ans1}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الثانية
                                                                </td>
                                                                <td>{{$question->ans2}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الثالثة
                                                                </td>
                                                                <td>{{$question->ans3}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الرابعة
                                                                </td>
                                                                <td>{{$question->ans4}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الصحيحة:
                                                                    @php $true=$question->true_answer; @endphp
                                                                    {{$question->$true}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="text-align: center">
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <a href="" data-toggle="modal"
                                                                           data-target="#editModal{{$question->id}}"
                                                                           class="btn btn-icon btn-outline-warning radbor"><i
                                                                                    class="fas fa-exclamation-triangle"></i></a>
                                                                        <a href="" data-toggle="modal"
                                                                           data-target="#editquestion{{$question->id}}"
                                                                           class="btn btn-icon btn-outline-info radbor"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        @php
                                                            $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question','user_id'=>auth()->id()])->get();    @endphp
                                                        @if($issue->count()>0)
                                                            <table
                                                                    class="display table nowrap table-striped table-hover"
                                                                    style="width:100%;float: left">
                                                                <thead>
                                                                <tr>
                                                                    <th width="50%">/</th>
                                                                    <th width="50%">القيمة</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($issue as $issue)
                                                                    <tr>
                                                                        <td>الكود</td>
                                                                        <td>{{$issue->id}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>العنوان</td>
                                                                        <td>{{$issue->title}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>الملاحظة</td>
                                                                        <td>{{$issue->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>الحالة</td>
                                                                        <td>
                                                                            @if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                                                            @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                                                            @else
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <tr style="text-align: center">
                                                                            <td colspan="2">
                                                                                <a href="" data-toggle="modal"
                                                                                   data-target="#editIssue{{$issue->id}}"
                                                                                   class="btn btn-icon btn-outline-info radbor"><i
                                                                                            class="fas fa-edit"></i></a>
                                                                                <a href="{{url('issues/delete/'.$issue->id)}}"
                                                                                   class="btn btn-icon btn-outline-danger radbor"><i
                                                                                            class="fa fa-trash"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    {{--model for edit Issuses--}}
                                                                    <div class="modal fade" id="editIssue{{$issue->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        تعديل ملاحظة</h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="{{url('issues/edit/'.$issue->id)}}"
                                                                                          method="post">
                                                                                        @csrf
                                                                                        <label><h4>العنوان</h4></label>
                                                                                        <input type="text" name="title"
                                                                                               class="form-control"
                                                                                               value="{{$issue->title}}">
                                                                                        <br>
                                                                                        <label><h4>الملاحظة</h4></label>
                                                                                        <textarea name="name" rows="6"
                                                                                                  cols="55"> {!!$issue->name!!}</textarea>
                                                                                        {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                                        {{--<input type="hidden" name="table" value="question">--}}
                                                                                        <select class="form-control"
                                                                                                name="step"
                                                                                                required>
                                                                                            <option value="">الحالة
                                                                                            </option>
                                                                                            <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                            <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                                        </select>
                                                                                        <br>
                                                                                        <br>
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">
                                                                                            تعديل
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">غلق
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{--end modal--}}
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>
                                                    {{--model for add Issuses for Questions--}}
                                                    <div class="modal fade" id="editModal{{$question->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة
                                                                        ملاحظة للأسئلة الأساسية</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{url('issues/create')}}"
                                                                          method="post">
                                                                        @csrf
                                                                        <label><h4>العنوان</h4></label>
                                                                        <input type="text" name="title"
                                                                               class="form-control">
                                                                        <br>
                                                                        <label><h4>الملاحظة</h4></label>
                                                                        <textarea name="name" rows="6"
                                                                                  cols="55"> </textarea>
                                                                        <input type="hidden" name="field_id"
                                                                               value="{{$question->id}}">
                                                                        <input type="hidden" name="table"
                                                                               value="question">
                                                                        <br>
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success">
                                                                            إضافة
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
                                                    {{--end modal--}}
                                                    {{--model for add Issuses for Article--}}
                                                    <div class="modal fade" id="normalArticalModal{{$artical->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة
                                                                        ملاحظة للمقال الأساسي</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{url('issues/create')}}"
                                                                          method="post">
                                                                        @csrf
                                                                        <label><h4>العنوان</h4></label>
                                                                        <input type="text" name="title"
                                                                               class="form-control">
                                                                        <br>
                                                                        <label><h4>الملاحظة</h4></label>
                                                                        <textarea name="name" rows="6"
                                                                                  cols="55"> </textarea>
                                                                        <input type="hidden" name="field_id"
                                                                               value="{{$artical->id}}">
                                                                        <input type="hidden" name="table"
                                                                               value="article">
                                                                        <input type="hidden" name="type" value="Normal">
                                                                        <br>
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success">
                                                                            إضافة
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
                                                    {{--end modal--}}
                                                    {{--model for edit question--}}
                                                    <div class="modal fade" id="editquestion{{$question->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" style="max-width: 80%!important;"
                                                             role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                        السؤال</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                          action="{{url('question/edit')}}/{{$question->id}}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                السؤال:<br>
                                                                                <div class="form-group">
                                                                        <textarea class="mceEditor" type="text"
                                                                                  name="question"
                                                                        > {!! $question->question !!}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الاختيار الأول:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans1"
                                                                                           value="{{$question->ans1}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                الاختيار الثاني:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans2"
                                                                                           value="{{$question->ans2}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الاختيار الثالث:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans3"
                                                                                           value="{{$question->ans3}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                الاختيار الرابع:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans4"
                                                                                           value="{{$question->ans4}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الإجابة الصحيحة:<br>
                                                                                <div class="form-group">
                                                                                    <select class="form-control"
                                                                                            name="true_answer" required>
                                                                                        <option value="">اختر الإجابة
                                                                                        </option>
                                                                                        <option value="ans1" {{($question->true_answer=='ans1')?'selected':''}}>
                                                                                            الاختيار الأول
                                                                                        </option>
                                                                                        <option value="ans2" {{($question->true_answer=='ans2')?'selected':''}}>
                                                                                            الاختيار الثاني
                                                                                        </option>
                                                                                        <option value="ans3" {{($question->true_answer=='ans3')?'selected':''}}>
                                                                                            الاختيار الثالث
                                                                                        </option>
                                                                                        <option value="ans4" {{($question->true_answer=='ans4')?'selected':''}}>
                                                                                            الاختيار الرابع
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary" type="submit">
                                                                            <span class="fa fa-plus"></span>إضافة
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
                                                    {{--end modal--}}
                                                @endforeach
                                            </div>
                                        </div>
                                        {{--left side for Stretch--}}
                                        <div class="col-md-6">
                                            <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h6 style="font-size: 20px">المقال الإضافي
                                            </h6>

                                            <a href="" data-toggle="modal"
                                               data-target="#stretchArticalModal{{$artical->id}}"
                                               class="btn btn-icon btn-outline-warning radbor"><i
                                                        class="fas fa-exclamation-triangle"></i></a>
                                            <a href="" data-toggle="modal"
                                               data-target="#editStretchArtical{{$artical->id}}"
                                               class="btn btn-icon btn-outline-info radbor"><i class="fas fa-edit"></i></a>
                                            {{--model for edit artical--}}
                                            <div class="modal fade" id="editStretchArtical{{$artical->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" style="max-width: 80%!important;"
                                                     role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                المقال الإضافي</h5>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form method="POST"
                                                                  action="{{url('editor/save/article')}}">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <label for="article" class="col-form-label">المقال الإضافي:</label>
                                                                    <textarea class="mceEditor form-control"
                                                                             required name="articleStretch">{!!$artical->stretchArticle !!}</textarea>
                                                                    <input type="hidden" name="list_id"
                                                                           value="{{$artical->list_id}}">
                                                                    <input type="hidden" name="level"
                                                                           value="{{$artical->level}}">
                                                                </div>

                                                                <button class="btn btn-primary" type="submit">
                                                                    <span class="fa fa-plus"></span>إضافة
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
                                            {{--end modal--}}
                                            {{--model for add Issuses for Article--}}
                                            <div class="modal fade" id="stretchArticalModal{{$artical->id}}"
                                                 tabindex="-1" role="dialog"
                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">إضافة
                                                                ملاحظة للمقال الإضافي</h5>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{url('issues/create')}}"
                                                                  method="post">
                                                                @csrf
                                                                <label><h4>العنوان</h4></label>
                                                                <input type="text" name="title"
                                                                       class="form-control">
                                                                <br>
                                                                <label><h4>الملاحظة</h4></label>
                                                                <textarea name="name" rows="6"
                                                                          cols="55"> </textarea>
                                                                <input type="hidden" name="field_id"
                                                                       value="{{$artical->id}}">
                                                                <input type="hidden" name="table"
                                                                       value="article">
                                                                <input type="hidden" name="type" value="Stretch">
                                                                <br>
                                                                <br>
                                                                <button type="submit" class="btn btn-success">
                                                                    إضافة
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
                                            {{--end modal--}}
                                            <div id="tinymcFont"><span
                                                        id="articaasdasdl2">{!!$artical->stretchArticle !!}</span></div>
                                            <div id="Issues">
                                                <div class="table-responsive">
                                                    @php
                                                        $issue=\App\Models\Issues::where(['field_id'=>$artical->id,'table'=>'article','type'=>'Stretch','user_id'=>auth()->id()                                           ])->get();@endphp
                                                    @if($issue->count()>0)
                                                        <table
                                                                class="display table nowrap table-striped table-hover"
                                                                style="width:100%">
                                                            <thead>
                                                            <tr>
                                                                <th>الكود</th>
                                                                <th>العنوان</th>
                                                                <th>الملاحظة</th>
                                                                <th>الحالة</th>
                                                                @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                    <th>الإجراء</th>@endif
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($issue as $issue)
                                                                <tr>
                                                                    <td>{{$issue->id}}</td>
                                                                    <td>{{$issue->title}}</td>
                                                                    <td>{{$issue->name}}</td>
                                                                    <td>@if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                                                        @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                                                        @else
                                                                            {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                                                        @endif
                                                                    </td>
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <td>
                                                                            <a data-toggle="modal"
                                                                               data-target="#editIssue{{$issue->id}}"><i
                                                                                        class="fa fa-edit"></i></a>
                                                                            <a href="{{url('issues/delete/'.$issue->id)}}"><i
                                                                                        class="fa fa-trash"></i></a>
                                                                        </td>@endif
                                                                </tr>
                                                                {{--model for edit Issuses--}}
                                                                <div class="modal fade" id="editIssue{{$issue->id}}"
                                                                             tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLabel"
                                                                             aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="exampleModalLabel">
                                                                                    تعديل ملاحظة</h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{url('issues/edit/'.$issue->id)}}"
                                                                                      method="post">
                                                                                    @csrf
                                                                                    <label><h4>العنوان</h4></label>
                                                                                    <input type="text" name="title"
                                                                                           class="form-control"
                                                                                           value="{{$issue->title}}">
                                                                                    <br>
                                                                                    <label><h4>الملاحظة</h4></label>
                                                                                    <textarea name="name" rows="6"
                                                                                              cols="55"> {!!$issue->name!!}</textarea>
                                                                                    <input type="hidden" name="field_id" value="{{$question->id}}">
                                                                                    <input type="hidden" name="table" value="question">
                                                                                    <select class="form-control"
                                                                                            name="step"
                                                                                            required>
                                                                                        <option value="">الحالة</option>
                                                                                        <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                        <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                                    </select>
                                                                                    <br>
                                                                                    <br>
                                                                                    <button type="submit"
                                                                                            class="btn btn-success">
                                                                                        تعديل
                                                                                    </button>
                                                                                </form>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">غلق
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                {{--end modal--}}
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="card-header" id="Issues">
                                                <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                </v>
                                                <h6 style="font-size: 20px">الأسئلة الإضافية
                                                </h6>
                                                @foreach($questionStretch as $question)
                                                    <div class="table-responsive" style="display: inline-block">
                                                        <table
                                                                class="display table nowrap table-striped table-hover"
                                                                style="width:100%;float: right">
                                                            <thead>
                                                            <tr>
                                                                <th width="50%">/</th>
                                                                <th width="50%">القيمة</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            <tr>
                                                                <td>
                                                                    السؤال
                                                                </td>
                                                                <td>
                                                                    {!! $question->question !!}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الأولى
                                                                </td>
                                                                <td>{{$question->ans1}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الثانية
                                                                </td>
                                                                <td>{{$question->ans2}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الثالثة
                                                                </td>
                                                                <td>{{$question->ans3}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الرابعة
                                                                </td>
                                                                <td>{{$question->ans4}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    الإجابة الصحيحة:
                                                                    @php $true=$question->true_answer; @endphp
                                                                    {{$question->$true}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2" style="text-align: center">
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <a href="" data-toggle="modal"
                                                                           data-target="#addQuestionIssue{{$question->id}}"
                                                                           class="btn btn-icon btn-outline-warning radbor"><i
                                                                                    class="fas fa-exclamation-triangle"></i></a>
                                                                        <a href="" data-toggle="modal"
                                                                           data-target="#editquestion{{$question->id}}"
                                                                           class="btn btn-icon btn-outline-info radbor"><i
                                                                                    class="fas fa-edit"></i></a>
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            </tbody>
                                                        </table>
                                                        @php
                                                            $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question','user_id'=>auth()->id()])->get();    @endphp
                                                        @if($issue->count()>0)
                                                            <table
                                                                    class="display table nowrap table-striped table-hover"
                                                                    style="width:100%;float: left">
                                                                <thead>
                                                                <tr>
                                                                    <th width="50%">/</th>
                                                                    <th width="50%">القيمة</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($issue as $issue)
                                                                    <tr>
                                                                        <td>الكود</td>
                                                                        <td>{{$issue->id}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>العنوان</td>
                                                                        <td>{{$issue->title}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>الملاحظة</td>
                                                                        <td>{{$issue->name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>الحالة</td>
                                                                        <td>
                                                                            @if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                                                            @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                                                            @else
                                                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                                                            @endif
                                                                        </td>
                                                                    </tr>
                                                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                        <tr style="text-align: center">
                                                                            <td colspan="2">
                                                                                <a href="" data-toggle="modal"
                                                                                   data-target="#editIssue{{$issue->id}}"
                                                                                   class="btn btn-icon btn-outline-info radbor"><i
                                                                                            class="fas fa-edit"></i></a>
                                                                                <a href="{{url('issues/delete/'.$issue->id)}}"
                                                                                   class="btn btn-icon btn-outline-danger radbor"><i
                                                                                            class="fa fa-trash"></i></a>
                                                                            </td>
                                                                        </tr>
                                                                    @endif
                                                                    {{--model for edit Issuses--}}
                                                                    <div class="modal fade" id="editIssue{{$issue->id}}"
                                                                         tabindex="-1" role="dialog"
                                                                         aria-labelledby="exampleModalLabel"
                                                                         aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        تعديل ملاحظة</h5>
                                                                                    <button type="button" class="close"
                                                                                            data-dismiss="modal"
                                                                                            aria-label="Close">
                                                                                        <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form action="{{url('issues/edit/'.$issue->id)}}"
                                                                                          method="post">
                                                                                        @csrf
                                                                                        <label><h4>العنوان</h4></label>
                                                                                        <input type="text" name="title"
                                                                                               class="form-control"
                                                                                               value="{{$issue->title}}">
                                                                                        <br>
                                                                                        <label><h4>الملاحظة</h4></label>
                                                                                        <textarea name="name" rows="6"
                                                                                                  cols="55"> {!!$issue->name!!}</textarea>
                                                                                        {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                                        {{--<input type="hidden" name="table" value="question">--}}
                                                                                        <select class="form-control"
                                                                                                name="step"
                                                                                                required>
                                                                                            <option value="">الحالة
                                                                                            </option>
                                                                                            <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                            <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                                        </select>
                                                                                        <br>
                                                                                        <br>
                                                                                        <button type="submit"
                                                                                                class="btn btn-success">
                                                                                            تعديل
                                                                                        </button>
                                                                                    </form>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                            class="btn btn-secondary"
                                                                                            data-dismiss="modal">غلق
                                                                                    </button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    {{--end modal--}}
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                    </div>
                                                    {{--model for add Issuses for Questions--}}
                                                    <div class="modal fade" id="addQuestionIssue{{$question->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة
                                                                        ملاحظة للأسئلة الإضافية</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="{{url('issues/create')}}"
                                                                          method="post">
                                                                        @csrf
                                                                        <label><h4>العنوان</h4></label>
                                                                        <input type="text" name="title"
                                                                               class="form-control">
                                                                        <br>
                                                                        <label><h4>الملاحظة</h4></label>
                                                                        <textarea name="name" rows="6"
                                                                                  cols="55"> </textarea>
                                                                        <input type="hidden" name="field_id"
                                                                               value="{{$question->id}}">
                                                                        <input type="hidden" name="table"
                                                                               value="question">
                                                                        <br>
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success">
                                                                            إضافة
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
                                                    {{--end modal--}}

                                                    {{--model for edit question--}}
                                                    <div class="modal fade" id="editquestion{{$question->id}}"
                                                         tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" style="max-width: 80%!important;"
                                                             role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">تعديل
                                                                        السؤال</h5>
                                                                    <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form method="POST"
                                                                          action="{{url('question/edit')}}/{{$question->id}}">
                                                                        @csrf
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                السؤال:<br>
                                                                                <div class="form-group">
                                                                        <textarea class="mceEditor" type="text"
                                                                                  name="question"
                                                                        > {!! $question->question !!}</textarea>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الاختيار الأول:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans1"
                                                                                           value="{{$question->ans1}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                الاختيار الثاني:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans2"
                                                                                           value="{{$question->ans2}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الاختيار الثالث:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans3"
                                                                                           value="{{$question->ans3}}">
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                الاختيار الرابع:<br>
                                                                                <div class="form-group">
                                                                                    <input required type="text"
                                                                                           name="ans4"
                                                                                           value="{{$question->ans4}}">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-md-6">
                                                                                الإجابة الصحيحة:<br>
                                                                                <div class="form-group">
                                                                                    <select class="form-control"
                                                                                            name="true_answer" required>
                                                                                        <option value="">اختر الإجابة
                                                                                        </option>
                                                                                        <option value="ans1" {{($question->true_answer=='ans1')?'selected':''}}>
                                                                                            الاختيار الأول
                                                                                        </option>
                                                                                        <option value="ans2" {{($question->true_answer=='ans2')?'selected':''}}>
                                                                                            الاختيار الثاني
                                                                                        </option>
                                                                                        <option value="ans3" {{($question->true_answer=='ans3')?'selected':''}}>
                                                                                            الاختيار الثالث
                                                                                        </option>
                                                                                        <option value="ans4" {{($question->true_answer=='ans4')?'selected':''}}>
                                                                                            الاختيار الرابع
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <button class="btn btn-primary" type="submit">
                                                                            <span class="fa fa-plus"></span>إضافة
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
                                                    {{--end modal--}}
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                    {{--for vocab--}}
                                    <div class="card-header" id="Issues">
                                        <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                        </v>
                                        <h6 style="font-size: 20px">المرادفات</h6>
                                        <div class="table-responsive" style="display: inline-block">
                                            <table
                                                    class="display table nowrap table-striped table-hover"
                                                    style="width:100%;float: left">
                                                <thead>
                                                <tr>
                                                    <th width="50%">الكلمة</th>
                                                    <th width="50%">المعنى</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($vocab as $word)
                                                    <tr>
                                                        <td>{{$word->word}}</td>
                                                        <td>{{$word->mean}}</td>
                                                        <td colspan="2" style="text-align: center">
                                                            @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                <a href="" data-toggle="modal"
                                                                   data-target="#addVocabIssue{{$artical->id}}"
                                                                   class="btn btn-icon btn-outline-warning radbor"><i
                                                                            class="fas fa-exclamation-triangle"></i></a>
                                                                {{--model for add Issuses for vocab--}}
                                                                <div class="modal fade" id="addVocabIssue{{$artical->id}}"
                                                                     tabindex="-1" role="dialog"
                                                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLabel">إضافة
                                                                                    ملاحظة للمرادفات</h5>
                                                                                <button type="button" class="close"
                                                                                        data-dismiss="modal" aria-label="Close">
                                                                                    <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form action="{{url('issues/create')}}"
                                                                                      method="post">
                                                                                    @csrf
                                                                                    <div class="row">
                                                                                    <label class="col-md-2"><h4>العنوان</h4></label>
                                                                                    <input type="text" name="title" class="form-control col-md-8"
                                                                                           >
                                                                                    </div>
                                                                                    <br>
                                                                                    <div class="row">
                                                                                    <label class="col-md-2"><h4>الملاحظة</h4></label>
                                                                                    <textarea name="name" rows="6"  class="form-control col-md-8"
                                                                                              cols="55"> </textarea>
                                                                                    </div>
                                                                                    <input type="hidden" name="field_id"
                                                                                           value="{{$artical->id}}">
                                                                                    <input type="hidden" name="table"
                                                                                           value="article">
                                                                                    <input type="hidden" name="type"
                                                                                           value="Vocab">
                                                                                    <br>
                                                                                    <br>

                                                                                    <button type="submit" class="btn btn-success">
                                                                                        إضافة
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
                                                                {{--end modal--}}
                                                            @endif
                                                        </td>
                                                        <td><a href="" data-toggle="modal"
                                                               data-target="#editVocab{{$word->id}}"
                                                               class="btn btn-icon btn-outline-info radbor"><i
                                                                        class="fas fa-edit"></i></a></td>
                                                        {{--model for edit vocab--}}
                                                        <div class="modal fade" id="editVocab{{$word->id}}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المرادفات</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form method="post"
                                                                              action="{{url('editor/editVocabulary/'.$word->id)}}">
                                                                            @csrf
                                                                            <div class="row">
                                                                                <label for="word" class="col-md-2"> الكلمة </label>
                                                                                <input type="text" name="word" class="col-md-8 form-control"  value="{{$word->word}}">
                                                                            </div>
                                                                            <br>
                                                                            <div class="row">
                                                                                <label for="name" class="col-md-2">المعنى</label>

                                                                                <textarea name="name" class="col-md-8 form-control" rows="6"
                                                                                          cols="40"> {{$word->mean}}</textarea>
                                                                            </div>
                                                                            <br>
                                                                            <button class="btn btn-success" id="addRow"> تعديل</button>
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
                                                        {{--end modal--}}
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @php
                                                $issue=\App\Models\Issues::where(['field_id'=>$artical->id,'type'=>'Vocab','table'=>'article','user_id'=>auth()->id()])->get();    @endphp
                                            @if($issue->count()>0)
                                                <table
                                                        class="display table nowrap table-striped table-hover"
                                                        style="width:100%;float: left">
                                                    <thead>
                                                    <tr>
                                                        <th width="50%">/</th>
                                                        <th width="50%">القيمة</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($issue as $issue)
                                                        <tr>
                                                            <td>الكود</td>
                                                            <td>{{$issue->id}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>العنوان</td>
                                                            <td>{{$issue->title}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>الملاحظة</td>
                                                            <td>{{$issue->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>الحالة</td>
                                                            <td>
                                                                @if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                                    {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                                                @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                                    {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                                                @else
                                                                    {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                            <tr style="text-align: center">
                                                                <td colspan="2">
                                                                    <a href="" data-toggle="modal"
                                                                       data-target="#editIssue{{$issue->id}}"
                                                                       class="btn btn-icon btn-outline-info radbor"><i
                                                                                class="fas fa-edit"></i></a>
                                                                    <a href="{{url('issues/delete/'.$issue->id)}}"
                                                                       class="btn btn-icon btn-outline-danger radbor"><i
                                                                                class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>
                                                        @endif
                                                        {{--model for edit Issuses--}}
                                                        <div class="modal fade" id="editIssue{{$issue->id}}"
                                                             tabindex="-1" role="dialog"
                                                             aria-labelledby="exampleModalLabel"
                                                             aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title"
                                                                            id="exampleModalLabel">
                                                                            تعديل ملاحظة</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal"
                                                                                aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="{{url('issues/edit/'.$issue->id)}}"
                                                                              method="post">
                                                                            @csrf
                                                                            <label><h4>العنوان</h4></label>
                                                                            <input type="text" name="title"
                                                                                   class="form-control"
                                                                                   value="{{$issue->title}}">
                                                                            <br>
                                                                            <label><h4>الملاحظة</h4></label>
                                                                            <textarea name="name" rows="6"
                                                                                      cols="55"> {!!$issue->name!!}</textarea>
                                                                            {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                            {{--<input type="hidden" name="table" value="question">--}}
                                                                            <select class="form-control"
                                                                                    name="step"
                                                                                    required>
                                                                                <option value="">الحالة
                                                                                </option>
                                                                                <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                            </select>
                                                                            <br>
                                                                            <br>
                                                                            <button type="submit"
                                                                                    class="btn btn-success">
                                                                                تعديل
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-dismiss="modal">غلق
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{--end modal--}}
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('#articaasdasdl2').children("div:first").removeClass('col-md-6');
                $('#articaasdasdl2>div.col-md-6').children().last().remove();
                $('#articaasdasdl').children("div:first").removeClass('col-md-6');
                $('#articaasdasdl>div.col-md-6').children().last().remove();
            });
        </script>
        <!-- [ HTML5 Export button ] end -->
    </div>
@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection

@endsection