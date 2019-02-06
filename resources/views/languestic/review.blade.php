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
                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                        <a style="float: left" href="{{url('languestic/done/'.$artical->id)}}"
                                           class="btn btn-success">
                                            تمت المراجعه <i class="fas fa-question-circle"></i>
                                        </a>

                                    @else
                                        <p class="btn btn-info" style="float:left;font-weight: bold;">تمت المراجعه
                                            اللغويه <i class="fas fa-check-circle"></i></p>
                                    @endif
                                    <a href="{{url('languestic/'.$page)}}" class="btn btn-dark"
                                       style="float:left">رجوع<i class="fas fa-reply"></i></a>

                                </div>

                                <div class="card-header">
                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                    </v>
                                    <h6 style="font-size: 20px">المقال
                                    </h6>
                                    @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                        <a href="" style="float:left" data-toggle="modal"
                                           data-target="#articalModal{{$artical->id}}"
                                           class="btn btn-icon btn-outline-warning radbor"><i
                                                    class="fas fa-exclamation-triangle"></i></a>
                                        <a href="" style="float:left" data-toggle="modal"
                                           data-target="#editartical{{$artical->id}}"
                                           class="btn btn-icon btn-outline-info radbor"><i class="fas fa-edit"></i></a>
                                    @endif
                                    <div id="tinymcFont">    {!! $artical->article !!} </div>
                                    <div id="Issues">
                                        <div class="table-responsive">
                                            @php
                                                $issue=\App\Models\Issues::where(['field_id'=>$artical->id,'table'=>'article','user_id'=>auth()->id()                                           ])->get();@endphp
                                            @if($issue->count()>0)
                                                <table
                                                       class="display table nowrap table-striped table-hover"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>الكود</th>
                                                        <th>العنوان</th>
                                                        <th>الملاحظه</th>
                                                        <th>الحاله</th>
                                                        @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                            <th>الاجراء</th>@endif
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
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            تعديل ملاحظه</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
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
                                                                            <label><h4>الملاحظه</h4></label>
                                                                            <textarea name="name" rows="6"
                                                                                      cols="60"> {!!$issue->name!!}</textarea>
                                                                            {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                            {{--<input type="hidden" name="table" value="question">--}}
                                                                            <select class="form-control" name="step"
                                                                                    required>
                                                                                <option value="">الحاله</option>
                                                                                <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                            </select>
                                                                            <br>
                                                                            <br>
                                                                            <button type="submit"
                                                                                    class="btn btn-success"> تعديل
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
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header" id="Issues">
                                    <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                    </v>
                                    <h6 style="font-size: 20px">الاسئله
                                    </h6>
                                    @foreach($questions as $question)
                                        <div class="table-responsive" style="display: inline-block">
                                            <table
                                                    class="display table nowrap table-striped table-hover"
                                                    style="width:50%;float: right">
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
                                                        الاجابة الاولي
                                                    </td>
                                                    <td>{{$question->ans1}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        الاجابة الثانيه
                                                    </td>
                                                    <td>{{$question->ans2}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        الاجابة الثالثه
                                                    </td>
                                                    <td>{{$question->ans3}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        الاجابة الرابعه
                                                    </td>
                                                    <td>{{$question->ans4}}</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        الاجابة الصحيحة:
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
                                                        style="width:50%;float: left">
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
                                                            <td>الملاحظه</td>
                                                            <td>{{$issue->name}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>الحاله</td>
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
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            تعديل ملاحظه</h5>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal" aria-label="Close">
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
                                                                            <label><h4>الملاحظه</h4></label>
                                                                            <textarea name="name" rows="6"
                                                                                      cols="60"> {!!$issue->name!!}</textarea>
                                                                            {{--<input type="hidden" name="field_id" value="{{$question->id}}">--}}
                                                                            {{--<input type="hidden" name="table" value="question">--}}
                                                                            <select class="form-control" name="step"
                                                                                    required>
                                                                                <option value="">الحاله</option>
                                                                                <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
                                                                            </select>
                                                                            <br>
                                                                            <br>
                                                                            <button type="submit"
                                                                                    class="btn btn-success"> تعديل
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
                                                    </tbody>
                                                </table>
                                            @endif
                                        </div>
                                        {{--model for add Issuses for Questions--}}
                                        <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">اضافه ملاحظه للاسئله</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{url('issues/create')}}" method="post">
                                                            @csrf
                                                            <label><h4>العنوان</h4></label>
                                                            <input type="text" name="title" class="form-control">
                                                            <br>
                                                            <label><h4>الملاحظه</h4></label>
                                                            <textarea name="name" rows="6" cols="60"> </textarea>
                                                            <input type="hidden" name="field_id" value="{{$question->id}}">
                                                            <input type="hidden" name="table" value="question">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-success"> اضافه</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}
                                        {{--model for add Issuses for Article--}}
                                        <div class="modal fade" id="articalModal{{$artical->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">اضافه ملاحظه للمقال</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{url('issues/create')}}" method="post">
                                                            @csrf
                                                            <label><h4>العنوان</h4></label>
                                                            <input type="text" name="title" class="form-control">
                                                            <br>
                                                            <label><h4>الملاحظه</h4></label>
                                                            <textarea name="name" rows="6" cols="60"> </textarea>
                                                            <input type="hidden" name="field_id" value="{{$artical->id}}">
                                                            <input type="hidden" name="table" value="article">
                                                            <br>
                                                            <br>
                                                            <button type="submit" class="btn btn-success"> اضافه</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}
                                        {{--model for edit question--}}
                                        <div class="modal fade" id="editquestion{{$question->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 80%!important;" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل السؤال</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{url('question/edit')}}/{{$question->id}}">
                                                            @csrf
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    السؤال:<br>
                                                                    <div class="form-group">
                                                                        <textarea class="mceEditor" type="text" name="question"
                                                                        > {!! $question->question !!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    الاختيار الاول:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans1" value="{{$question->ans1}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    الاختيار الثاني:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans2" value="{{$question->ans2}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    الاختيار الثالث:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans3" value="{{$question->ans3}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    الاختيار الرابع:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans4" value="{{$question->ans4}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    الاجابه الصحيحه:<br>
                                                                    <div class="form-group">
                                                                        <select class="form-control" name="true_answer" required>
                                                                            <option value="">اختر الاجابه</option>
                                                                            <option value="ans1" {{($question->true_answer=='ans1')?'selected':''}}>
                                                                                الاختيار الاول
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
                                                            <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}
                                        {{--model for edit artical--}}
                                        <div class="modal fade" id="editartical{{$artical->id}}" tabindex="-1" role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" style="max-width: 80%!important;" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المقال</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="POST" action="{{url('editor/save/article')}}">
                                                            @csrf
                                                            <div class="form-group">
                                                                <label for="article" class="col-form-label">المقال:</label>
                                                                <textarea class="mceEditor form-control" required name="article">{!! $artical->article !!}</textarea>
                                                                <input type="hidden"  name="list_id" value="{{$artical->list_id}}">
                                                                <input type="hidden" name="level" value="{{$artical->level}}">
                                                            </div>

                                                            <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة</button>
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

                                </div>
                            </div>
                        </div>
                        <!-- [ HTML5 Export button ] end -->

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