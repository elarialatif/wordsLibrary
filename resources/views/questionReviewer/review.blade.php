@extends('layouts.app')
@section('content')
    <div class="container">
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
                                            صفحة مراجعه الاسئله
                                        </h5>
                                    </div>
                                    <div class="card-block">
                                        {{--@php--}}
                                        {{--$status=\App\Models\Article::where(['id'=>$artical->id,'status'=>0])->first();--}}
                                        {{--dd($status);--}}
                                        {{--@endphp--}}
                                        @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                            <a href="{{url('questionReviewer/done/'.$artical->id)}}" class="btn btn-success"> تمت المراجعه
                                                <i class="fa fa-"></i></a>
                                        @else
                                            <p>تم مراجعه الاسئله</p>
                                        @endif
                                        <a href="{{url('questionReviewer/'.$page)}}" class="btn btn-dark" style="float:left">رجوع</a>
                                        <br>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6" style="border-left: solid 2px black;font-size:18px;line-height: 1.5">
                                                <span id="articaasdasdl" >{!! $artical->article !!}</span>

                                            </div>
                                            <div class="col-md-6" id="target" style="overflow: scroll; width: 200px; height: 500px;">
                                                <?php $m=1;?>
                                                @foreach($questions as $question)

                                                    <table class="table table-condensed">
                                                        <thead>
                                                        <tr>
                                                            <th><span>{{$m}}-</span>  {!! $question->question !!}
                                                                @if($artical->status!=\App\Helper\ArticleLevels::Review)
                                                                    <a style="float:left" data-toggle="modal" data-target="#editModal{{$question->id}}"
                                                                       class="btn btn-info">تعديل</a>
                                                                    <a style="float:left" data-toggle="modal" data-target="#addIssue{{$question->id}}"
                                                                       class="btn btn-info">ملاحظه</a>
                                                                @endif
                                                                {{--model for edit question--}}
                                                                <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog"
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
                                                                                                <input required type="text" name="ans1"
                                                                                                       value="{{$question->ans1}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            الاختيار الثاني:<br>
                                                                                            <div class="form-group">
                                                                                                <input required type="text" name="ans2"
                                                                                                       value="{{$question->ans2}}">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="col-md-6">
                                                                                            الاختيار الثالث:<br>
                                                                                            <div class="form-group">
                                                                                                <input required type="text" name="ans3"
                                                                                                       value="{{$question->ans3}}">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            الاختيار الرابع:<br>
                                                                                            <div class="form-group">
                                                                                                <input required type="text" name="ans4"
                                                                                                       value="{{$question->ans4}}">
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
                                                                                    <button class="btn btn-primary" type="submit"><span
                                                                                                class="fa fa-plus"></span>إضافة
                                                                                    </button>
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
                                                            <td>الاجابه الصحيحه: @php $true=$question->true_answer; @endphp

                                                                {{$question->$true}}</td>
                                                            @php
                                                                $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question'])->get();    @endphp
                                                            @if($issue->count()>0)
                                                                <table class="table table-condensed">
                                                                    <thead style="background-color: #0fa73e">
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
                                                                                    <a data-toggle="modal" data-target="#editIssue{{$issue->id}}"><i
                                                                                                class="fa fa-edit"></i></a>
                                                                                    <a href="{{url('issues/delete/'.$issue->id)}}"><i
                                                                                                class="fa fa-trash"></i></a>
                                                                                </td>@endif
                                                                        </tr>
                                                                        {{--model for edit Issuses--}}
                                                                        <div class="modal fade" id="editIssue{{$issue->id}}" tabindex="-1" role="dialog"
                                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                            <div class="modal-dialog" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل ملاحظه</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                                                aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <form action="{{url('issues/edit/'.$issue->id)}}" method="post">
                                                                                            @csrf
                                                                                            <label><h4>العنوان</h4></label>
                                                                                            <input type="text" name="title" class="form-control"
                                                                                                   value="{{$issue->title}}">
                                                                                            <br>
                                                                                            <label><h4>الملاحظه</h4></label>
                                                                                            <textarea name="name" rows="6"
                                                                                                      cols="60"> {!!$issue->name!!}</textarea>
                                                                                            <input type="hidden" name="field_id" value="{{$question->id}}">
                                                                                            <input type="hidden" name="table" value="question">
                                                                                            <select class="form-control" name="step" required>
                                                                                                <option value="">الحاله</option>
                                                                                                <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                                                                <option value="{{\App\Helper\IssuesSteps::CloseByCreator}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}</option>
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
                                                                        <?php $m++;?>
                                                                    @endforeach
                                                                    </tbody>
                                                                </table>
                                                        @endif
                                                        </tbody>
                                                    </table>
                                                    <br>
                                                    <br>
                                                    {{--model for add Issuses--}}
                                                    <div class="modal fade" id="addIssue{{$question->id}}" tabindex="-1" role="dialog"
                                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">اضافه ملاحظه</h5>
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
                                                @endforeach
                                            </div>
                                        </div>

                                                    <script>
                                                        $(document).ready(function(){
                                                            $('#articaasdasdl').children("div:first").removeClass('col-md-6');
                                                            $('#articaasdasdl>div.col-md-6').children().last().remove();
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


@endsection
