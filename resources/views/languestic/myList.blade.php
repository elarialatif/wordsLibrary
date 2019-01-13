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
                                        صفحة مواضيعى

                                    </h5>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table id="key-act-button"
                                               class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>الكود</th>
                                                <th>الموضوع</th>
                                                <th>الصف</th>
                                                <th>ادخال الاسئله</th>
                                                <th>ارسال</th>
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
                                                    <td>
                                                        @php
                                                            $easyQuestions=App\Models\Question::where('artical_id',$articalEasy->id)->get()->pluck('id')->toArray();
                                                            $normalQuestions=App\Models\Question::where('artical_id',$articalNormal->id)->get()->pluck('id')->toArray();
                                                            $hardQuestions=App\Models\Question::where('artical_id',$articalHard->id)->get()->pluck('id')->toArray();
                                                        @endphp
                                                        {{--@if($easyQuestions && $normalQuestions && $hardQuestions)--}}
                                                        @php

                                                            $var=$articalEasy->id;
                                                            $easyReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$easyQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var){
                                $query->Where('field_id',$var);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->first();

                                                            $var2=$articalNormal->id;
                                                            $normalReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$normalQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var2){
                                $query->Where('field_id',$var2);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->first();
                                                            $var3= $articalHard->id;
                                                            $hardReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$hardQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var3) {
                                $query->Where('field_id',$var3);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->first();
                                                        @endphp
                                                        @php
                                                            $easyStatus=App\Models\Article::where(['id'=>$articalEasy->id,'status'=>1])->first();
                                                            $normalStatus=App\Models\Article::where(['id'=>$articalNormal->id,'status'=>1])->first();
                                                            $hardStatus=App\Models\Article::where(['id'=>$articalHard->id,'status'=>1])->first();
                                                        @endphp
                                                        {{--@endif--}}
                                                        {{--for QuestionReviewer--}}
                                                        @if(empty($easyStatus))
                                                            <a href="{{url('languestic/review/'.$articalEasy->id)}}"
                                                               class="btn {{(empty($easyReviewer))?'btn-info':'btn-danger'}} ">السهل<i
                                                                        class="fa {{(empty($easyReviewer))?'':'fa-eye'}}"></i></a>
                                                        @else
                                                            <a href="{{url('languestic/review/'.$articalEasy->id)}}"
                                                               class="btn {{(empty($easyReviewer))?'btn-success':'btn-danger'}} ">السهل<i
                                                                        class="fa {{(empty($easyReviewer))?'fa-check-circle':'fa-check-circle'}}"></i></a>
                                                        @endif
                                                        @if(empty($normalStatus))
                                                            <a href="{{url('languestic/review/'.$articalNormal->id)}}"
                                                               class="btn {{(empty($normalReviewer))?'btn-info':'btn-danger'}} ">المتوسط<i
                                                                        class="fa {{(empty($normalReviewer))?'':'fa-eye'}}"></i></a>
                                                        @else
                                                            <a href="{{url('languestic/review/'.$articalNormal->id)}}"
                                                               class="btn {{(empty($normalReviewer))?'btn-success':'btn-danger'}} ">المتوسط<i
                                                                        class="fa {{(empty($normalReviewer))?'fa-check-circle':'fa-check-circle'}}"></i></a>
                                                        @endif
                                                        @if(empty($hardStatus))
                                                            <a href="{{url('languestic/review/'.$articalHard->id)}}"
                                                               class="btn {{(empty($hardReviewer))?'btn-info':'btn-danger'}} ">الصعب<i
                                                                        class="fa {{(empty($hardReviewer))?'':'fa-eye'}}"></i></a>
                                                        @else
                                                            <a href="{{url('languestic/review/'.$articalHard->id)}}"
                                                               class="btn {{(empty($hardReviewer))?'btn-success':'btn-danger'}} ">الصعب<i
                                                                        class="fa {{(empty($hardReviewer))?'fa-check-circle':'fa-check-circle'}}"></i></a>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if($easyStatus && $normalStatus && $hardStatus)
                                                            <a href="{{url('languestic/send/'.$list->id)}}" class="btn btn-success">ارسال</a>
                                                        @else
                                                            <p>راجع كل المقالات للارسال</p>
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
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection
