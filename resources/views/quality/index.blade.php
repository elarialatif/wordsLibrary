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
                                         مواضيع جديدة
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
                                            <th>عرض</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($list as $list)
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

                                                    {{--@php--}}
                                                    {{--$easyQuestions=App\Models\Question::where('artical_id',$articalEasy->id)->first();--}}
                                                    {{--$normalQuestions=App\Models\Question::where('artical_id',$articalNormal->id)->first();--}}
                                                    {{--$hardQuestions=App\Models\Question::where('artical_id',$articalHard->id)->first();--}}
                                                    {{--@endphp--}}

                                                    {{--@if(auth()->user()->role==\App\Helper\UsersTypes::QuestionCreator)--}}
                                                    {{--<a href="{{url('question/create/'.$articalEasy->id)}}" class="btn btn-info">السهل<i class="fa fa-plus"></i></a>--}}
                                                    {{--<a href="{{url('question/create/'.$articalNormal->id)}}" class="btn btn-info">المتوسط<i class="fa fa-plus"></i></a>--}}
                                                    {{--<a href="{{url('question/create/'.$articalHard->id)}}" class="btn btn-info">الصعب<i class="fa fa-plus"></i></a>--}}
                                                    {{--@endif--}}
                                                    {{--@if(auth()->user()->role==\App\Helper\UsersTypes::QuestionReviewer)--}}
                                                    <a href="{{url('quality/review/'.$articalEasy->id)}}" class="btn btn-info">السهل</a>
                                                    <a href="{{url('quality/review/'.$articalNormal->id)}}" class="btn btn-info">المتوسط</a>
                                                    <a href="{{url('quality/review/'.$articalHard->id)}}" class="btn btn-info">الصعب</a>
                                                    {{--@endif--}}
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
