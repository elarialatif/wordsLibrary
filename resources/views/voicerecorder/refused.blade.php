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
                                        مواضيع جديده
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
                                                <th> عرض المقال سهل</th>
                                                <th>عرض المقال متوسط</th>
                                                <th>عرض المقال صعب</th>
                                                <th>ارسال</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lists as $list)
                                                @php
                                                    $grade=\App\Models\Grade::with('level')->where('id',$list->grade_id)->first();
                                            $easy=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy);
                                            $normal=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal);
                                            $hard=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard);
                                            $easySound=\App\Repository\SoundsRepository::findWhere('article_id',$easy->id);
                                            $normalSound=\App\Repository\SoundsRepository::findWhere('article_id',$normal->id);
                                            $hardSound=\App\Repository\SoundsRepository::findWhere('article_id',$hard->id);

                                            $easyIssues=\App\Repository\IssuesRepository::getAllIssuesForArticle($easySound->id,'sound',\App\Helper\IssuesSteps::Open);
                                            $normalIssues=\App\Repository\IssuesRepository::getAllIssuesForArticle($normalSound->id,'sound',\App\Helper\IssuesSteps::Open);
                                            $hardIssues=\App\Repository\IssuesRepository::getAllIssuesForArticle($hardSound->id,'sound',\App\Helper\IssuesSteps::Open);
                                                @endphp

                                                <tr id="{{$list->id}}">

                                                    <td>{{$list->id}}</td>

                                                    <td>{{$list->list}}</td>

                                                    <td>{{$list->grade->name}}</td>
                                                    <td><a
                                                                @if($easyIssues->count()>0)   href="{{url('VoiceRecorder/upload/sound/'.$list->id.'/'.\App\Helper\ArticleLevels::Easy.'/'.'refused')}}" @endif>
                                                            <span @if($easyIssues->count()==0)  class="fa  fas fa-check-circle fa-2x"
                                                                  style="color: green"
                                                                  @else class="fa  fas fa-upload fa-2x" style="color: #ff2733" @endif></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a @if($normalIssues->count()>0) href="{{url('VoiceRecorder/upload/sound/'.$list->id.'/'.\app\Helper\ArticleLevels::Normal.'/'.'refused')}}" @endif> <span
                                                                    @if($normalIssues->count()==0)  class="fa  fas fa-check-circle fa-2x"
                                                                    style="color: green"
                                                                    @else class="fa  fas fa-upload fa-2x"
                                                                    style="color: #ff2733" @endif></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <a @if($hardIssues->count()>0) href="{{url('VoiceRecorder/upload/sound/'.$list->id.'/'.\app\Helper\ArticleLevels::Hard.'/'.'refused')}}" @endif> <span
                                                                    @if($hardIssues->count()==0)  class="fa  fas fa-check-circle fa-2x"
                                                                    style="color: green"
                                                                    @else class="fa  fas fa-upload fa-2x"  style="color: #ff2733" @endif></span>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @if($easyIssues->count()==0 && $normalIssues->count()==0 && $hardIssues->count()==0)
                                                            <a class="btn btn-success"
                                                               href="{{url('VoiceRecorder/sendTo/quality/'.$list->id.'/'.\App\Helper\Steps::ResendToQuality)}}">
                                                                ارسال</a>
                                                        @else
                                                            مغلق
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
