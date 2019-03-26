
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
                                        موضوعات معادة
                                    </h5>
                                </div>

                                <div class="card-block">
                                    <div class="card-header">
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table id="key-act-button"
                                                       class="display table nowrap table-striped table-hover"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>الكود</th>
                                                        <th>الموضوع</th>

                                                        <th>الصف</th>
                                                        <th>إدخال الأسئلة</th>
                                                        <th>إرسال</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($list as $list)
                                                        {{--@php  $list=\App\Models\ContentList::with('level','country','grade')->where('id',$list->id)->first();--}}
                                                        {{--@dd($list);--}}
                                                        {{--$grade=\App\Models\Grade::with('level')->where('id',$list->grade->id)->first(); @endphp--}}
                                                        <tr>
                                                            <td>{{$list->id}}</td>
                                                            <td>{{$list->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            @php
                                                                $articalEasy=App\Models\Article::where(['list_id'=>$list->id,'level'=>\App\Helper\ArticleLevels::Easy])->first();
                                                                $articalNormal=App\Models\Article::where(['list_id'=>$list->id,'level'=>\App\Helper\ArticleLevels::Normal])->first();
                                                                $articalHard=App\Models\Article::where(['list_id'=>$list->id,'level'=>\App\Helper\ArticleLevels::Hard])->first();
                                                            @endphp
                                                            @php
                                                                $easyQuestions=App\Models\Question::where('artical_id',$articalEasy->id)->get()->pluck('id')->toArray();
                                                                $normalQuestions=App\Models\Question::where('artical_id',$articalNormal->id)->get()->pluck('id')->toArray();
                                                                $hardQuestions=App\Models\Question::where('artical_id',$articalHard->id)->get()->pluck('id')->toArray();
                                                            @endphp
                                                            @if(count($easyQuestions)>0 && count($normalQuestions)>0 && count($hardQuestions)>0)
                                                                @php
                                                                    $easyReviewer=App\Models\Issues::whereIn('field_id',$easyQuestions)->where(['table'=>'question',['step','!=',\App\Helper\IssuesSteps::CloseByCreator]])->get();
                                                                    $normalReviewer=App\Models\Issues::whereIn('field_id',$normalQuestions)->where(['table'=>'question',['step','!=',\App\Helper\IssuesSteps::CloseByCreator]])->get();
                                                                    $hardReviewer=App\Models\Issues::whereIn('field_id',$hardQuestions)->where(['table'=>'question',['step','!=',\App\Helper\IssuesSteps::CloseByCreator]])->get();
                                                                @endphp
                                                                @php
                                                                    $easyIssues=App\Models\Issues::whereIn('field_id',$easyQuestions)->where(['table'=>'question',['step','==',\App\Helper\IssuesSteps::Open]])->get();
                                                                    $normalIssues=App\Models\Issues::whereIn('field_id',$normalQuestions)->where(['table'=>'question',['step','==',\App\Helper\IssuesSteps::Open]])->get();
                                                                    $hardIssues=App\Models\Issues::whereIn('field_id',$hardQuestions)->where(['table'=>'question',['step','==',\App\Helper\IssuesSteps::Open]])->get();
                                                                @endphp
                                                                @php
                                                                    $easyStatus=App\Models\Article::where(['id'=>$articalEasy->id,'status'=>\App\Helper\ArticleLevels::Review])->first();
                                                                    $normalStatus=App\Models\Article::where(['id'=>$articalNormal->id,'status'=>\App\Helper\ArticleLevels::Review])->first();
                                                                    $hardStatus=App\Models\Article::where(['id'=>$articalHard->id,'status'=>\App\Helper\ArticleLevels::Review])->first();
                                                                @endphp
                                                            @endif
                                                            <td>
                                                                {{--for QuestionReviewer--}}
                                                                @if(auth()->user()->role==\App\Helper\UsersTypes::QuestionReviewer)
                                                                    <a href="{{url('questionReviewer/review/'.$articalEasy->id.'/'.'resend')}}"
                                                                       class="btn {{($easyReviewer->count()==0)?'btn-success':'btn-danger'}} ">السهل<i
                                                                                class="fa {{(empty($easyStatus))?'':'fa-check-circle'}}"></i></a>
                                                                    <a href="{{url('questionReviewer/review/'.$articalNormal->id.'/'.'resend')}}"
                                                                       class="btn {{($normalReviewer->count()==0)?'btn-success':'btn-danger'}} ">المتوسط<i
                                                                                class="fa {{(empty($normalStatus))?'':'fa-check-circle'}}"></i></a>
                                                                    <a href="{{url('questionReviewer/review/'.$articalHard->id.'/'.'resend')}}"
                                                                       class="btn {{($hardReviewer->count()==0)?'btn-success':'btn-danger'}} ">الصعب<i
                                                                                class="fa {{(empty($hardStatus))?'':'fa-check-circle'}}"></i></a>
                                                                @endif
                                                                {{--//////for QuestionCreator//////////--}}
                                                                @if(auth()->user()->role==\App\Helper\UsersTypes::QuestionCreator)
                                                                    @if(count($easyQuestions)==0)
                                                                        <a href="{{url('question/create/'.$articalEasy->id)}}" class="btn btn-info">السهل<i
                                                                                    class="fa fa-plus"></i></a>
                                                                    @else
                                                                        <a href="{{url('question/show/'.$articalEasy->id.'/'.'resend')}}"
                                                                           class="btn {{($easyIssues->count()==0)?'btn-success':'btn-danger'}}">السهل<i
                                                                                    class="{{($easyIssues->count()==0)?'fa fa-check-circle':''}}"></i></a>
                                                                    @endif
                                                                    @if(count($normalQuestions)==0)
                                                                        <a href="{{url('question/create/'.$articalNormal->id)}}" class="btn btn-info">المتوسط<i
                                                                                    class="fa fa-plus"></i></a>
                                                                    @else
                                                                        <a href="{{url('question/show/'.$articalNormal->id.'/'.'resend')}}"
                                                                           class="btn {{($normalIssues->count()==0)?'btn-success':'btn-danger'}}">المتوسط<i
                                                                                    class="{{($normalIssues->count()==0)?'fa fa-check-circle':''}}"></i></a>
                                                                    @endif
                                                                    @if(count($hardQuestions)==0)
                                                                        <a href="{{url('question/create/'.$articalHard->id)}}" class="btn btn-info">الصعب<i
                                                                                    class="fa fa-plus"></i></a>
                                                                    @else
                                                                        <a href="{{url('question/show/'.$articalHard->id.'/'.'resend')}}"
                                                                           class="btn {{($hardIssues->count()==0)?'btn-success':'btn-danger'}}">الصعب<i
                                                                                    class="{{($hardIssues->count()==0)?'fa fa-check-circle':''}}"></i></a>
                                                                    @endif
                                                                @endif
                                                            </td>
                                                            <td>
                                                                {{--QuestionCreator--}}
                                                                @if(auth()->user()->role==\App\Helper\UsersTypes::QuestionCreator)
                                                                    @if(count($easyQuestions)>0 && count($normalQuestions)>0 && count($hardQuestions)>0)
                                                                        <a href="{{url('question/sendToReviwer/'.$list->id)}}"
                                                                           class="btn btn-success">{{(!empty($task))?'إعادة إرسال الي المراجعة':'إرسال الي المراجعة'}}</a>
                                                                    @else
                                                                        <p>ادخل كل الأسئلة للإرسال</p>
                                                                    @endif
                                                                @endif
                                                                {{--QuestionReviewer--}}
                                                                @if(auth()->user()->role==\App\Helper\UsersTypes::QuestionReviewer)
                                                                    @if($easyStatus && $normalStatus && $hardStatus)
                                                                        <a href="{{url('questionReviewer/send/'.$list->id)}}" class="btn btn-success">إعادة إرسال</a>
                                                                    @else
                                                                        <p>راجع كل الأسئلة للإرسال</p>
                                                                    @endif
                                                                @endif
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

