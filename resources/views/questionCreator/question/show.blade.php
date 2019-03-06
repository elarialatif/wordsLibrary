@extends('layouts.app')
@section('content')
    <br>
    <br>
    <div class="container">
        <a href="{{url('question/create/'.$questions[0]->artical_id)}}" class="btn btn-primary"> اضافه اسئله جديده <i
                    class="fa fa-plus"></i></a>
        <a style="float: left" href="{{url('question/'.$page)}}" class="btn btn-dark"> رجوع </a>
        <br>
        <br>
        <div>
            <h3>الاسئلة الاساسية</h3>
        <div id="tinymcFont">    {!! $artical->article !!} </div>
        @foreach($questions as $question)
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th>{!! $question->question !!}
                        <a style="float:left" href="{{url('question/delete/'.$question->id)}}" class="btn btn-danger">مسح</a>
                        <a style="float:left" data-toggle="modal" data-target="#editModal{{$question->id}}"
                           class="btn btn-info">تعديل</a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>{{$question->ans1}}</td>
                </tr>
                <tr>
                    <td>{{$question->ans2}}</td>
                </tr>
                <tr>
                    <td>{{$question->ans3}}</td>
                </tr>
                <tr>
                    <td>{{$question->ans4}}</td>
                </tr>
                <tr>
                    <td>
                        الاجابة الصحيحة:
                        @php $true=$question->true_answer; @endphp
                        {{$question->$true}}</td>
                </tr>
                @php
                    $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question'])->get();    @endphp
                @if($issue->count()>0)
                    <table class="table table-condensed">
                        <thead style="background-color: #0fa73e">
                        <tr>
                            <th>العنوان</th>
                            <th>الملاحظه</th>
                            <th>الحاله</th>
                            <th>عرض</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($issue as $issue)
                            <tr>
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
                                <td><a data-toggle="modal" data-target="#editIssue{{$issue->id}}"><i
                                                class="fa fa-eye"></i></a></td>
                            </tr>
                            {{--model for edit Issuses--}}
                            <div class="modal fade" id="editIssue{{$issue->id}}" tabindex="-1" role="dialog"
                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">عرض ملاحظه</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{url('issues/edit/'.$issue->id)}}" method="post">
                                                @csrf
                                                <label><h4>العنوان</h4></label>
                                                <input disabled type="text" name="title" class="form-control"
                                                       value="{{$issue->title}}">
                                                <br>
                                                <label><h4>الملاحظه</h4></label>
                                                <textarea disabled name="name" rows="6"
                                                          cols="60"> {!!$issue->name!!}</textarea>
                                                <input type="hidden" name="field_id" value="{{$question->id}}">
                                                <input type="hidden" name="table" value="question">
                                                <select class="form-control" name="step" required>
                                                    <option value="">الحاله</option>
                                                    <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                    <option value="{{\App\Helper\IssuesSteps::DoneByEditor}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}</option>
                                                </select>
                                                <br>
                                                <br>
                                                <button type="submit" class="btn btn-success"> تعديل</button>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق
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
                </tbody>
            </table>
            {{--model for edit question--}}
            <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="max-width: 70% !important;" role="document">
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
                                    <div class="col-md-8">
                                        السؤال:<br>
                                        <div class="form-group">
                                            <textarea class="mceEditor" type="text"
                                                      name="question"> {!! $question->question !!}</textarea>
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
                                <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة
                                </button>
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
        <hr>
        <div>
            <h3>الاسئلة الاضافية</h3>
            <div id="tinymcFont">    المقال الموسع </div>
            @foreach($questionStretch as $question)
                <table class="table table-condensed">
                    <thead>
                    <tr>
                        <th>{!! $question->question !!}
                            <a style="float:left" href="{{url('question/delete/'.$question->id)}}" class="btn btn-danger">مسح</a>
                            <a style="float:left" data-toggle="modal" data-target="#editModal{{$question->id}}"
                               class="btn btn-info">تعديل</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$question->ans1}}</td>
                    </tr>
                    <tr>
                        <td>{{$question->ans2}}</td>
                    </tr>
                    <tr>
                        <td>{{$question->ans3}}</td>
                    </tr>
                    <tr>
                        <td>{{$question->ans4}}</td>
                    </tr>
                    <tr>
                        <td>
                            الاجابة الصحيحة:
                            @php $true=$question->true_answer; @endphp
                            {{$question->$true}}</td>
                    </tr>
                    @php
                        $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question'])->get();    @endphp
                    @if($issue->count()>0)
                        <table class="table table-condensed">
                            <thead style="background-color: #0fa73e">
                            <tr>
                                <th>العنوان</th>
                                <th>الملاحظه</th>
                                <th>الحاله</th>
                                <th>عرض</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($issue as $issue)
                                <tr>
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
                                    <td><a data-toggle="modal" data-target="#editIssue{{$issue->id}}"><i
                                                    class="fa fa-eye"></i></a></td>
                                </tr>
                                {{--model for edit Issuses--}}
                                <div class="modal fade" id="editIssue{{$issue->id}}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">عرض ملاحظه</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{url('issues/edit/'.$issue->id)}}" method="post">
                                                    @csrf
                                                    <label><h4>العنوان</h4></label>
                                                    <input disabled type="text" name="title" class="form-control"
                                                           value="{{$issue->title}}">
                                                    <br>
                                                    <label><h4>الملاحظه</h4></label>
                                                    <textarea disabled name="name" rows="6"
                                                              cols="60"> {!!$issue->name!!}</textarea>
                                                    <input type="hidden" name="field_id" value="{{$question->id}}">
                                                    <input type="hidden" name="table" value="question">
                                                    <select class="form-control" name="step" required>
                                                        <option value="">الحاله</option>
                                                        <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                        <option value="{{\App\Helper\IssuesSteps::DoneByEditor}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}</option>
                                                    </select>
                                                    <br>
                                                    <br>
                                                    <button type="submit" class="btn btn-success"> تعديل</button>
                                                </form>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق
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
                    </tbody>
                </table>
                {{--model for edit question--}}
                <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog"
                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 70% !important;" role="document">
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
                                        <div class="col-md-8">
                                            السؤال:<br>
                                            <div class="form-group">
                                            <textarea class="mceEditor" type="text"
                                                      name="question"> {!! $question->question !!}</textarea>
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
                                    <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة
                                    </button>
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
        <br>
        <br>
        <br>
@endsection
