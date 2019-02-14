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
                                        صفحة  مواضيع معاده
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
                                                     $soundEasy=\App\Models\Sound::where('article_id',$articalEasy->id)->first();
                                                    $soundNormal=\App\Models\Sound::where('article_id',$articalNormal->id)->first();
                                                    $soundHard=\App\Models\Sound::where('article_id',$articalHard->id)->first();
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
                                                            $easyReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$easyQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var){$query->Where('field_id',$var);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->get();
                                                            if($soundEasy){
$easySound=\App\Repository\IssuesRepository::getAllIssuesForArticle($soundEasy->id,'sound',\App\Helper\IssuesSteps::Open,\App\Helper\IssuesSteps::DoneByEditor);}
                               $var2=$articalNormal->id;
                                                            $normalReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$normalQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var2){$query->Where('field_id',$var2);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->get();
                                                            if($soundNormal){
                               $normalSound=\App\Repository\IssuesRepository::getAllIssuesForArticle($soundNormal->id,'sound',\App\Helper\IssuesSteps::Open,\App\Helper\IssuesSteps::DoneByEditor);}
                               $var3=$articalHard->id;
                                                            $hardReviewer=App\Models\Issues::where('step','!=',\App\Helper\IssuesSteps::CloseByCreator)->whereIn('field_id',$hardQuestions)->where(['table'=>'question'])->orwhere(function ($query) use ($var3){$query->Where('field_id',$var3);$query->Where('table','article');$query->Where('step','!=',\App\Helper\IssuesSteps::CloseByCreator);})->get();
                                                            if($soundHard){
      $hardSound=\App\Repository\IssuesRepository::getAllIssuesForArticle($soundHard->id,'sound',\App\Helper\IssuesSteps::Open,\App\Helper\IssuesSteps::DoneByEditor);}
                                                    @endphp
                                                    @php
                                                        $easyStatus=App\Models\Article::where(['id'=>$articalEasy->id,'status'=>1])->first();
                                                        $normalStatus=App\Models\Article::where(['id'=>$articalNormal->id,'status'=>1])->first();
                                                        $hardStatus=App\Models\Article::where(['id'=>$articalHard->id,'status'=>1])->first();
                                                    @endphp
                                                    {{--@endif--}}
                                                    <td>
                                                        {{--for QuestionReviewer--}}
                                                        <a href="{{url('quality/review/'.$articalEasy->id.'/'.'resend')}}"
                                                           class="btn {{($easyReviewer->count()==0 ||$easySound->count()==0)?'btn-success':'btn-danger'}} ">السهل<i
                                                                    class="fa {{(empty($easyStatus))?'':'fa-check-circle'}}"></i></a>
                                                        <a href="{{url('quality/review/'.$articalNormal->id.'/'.'resend')}}"
                                                           class="btn {{($normalReviewer->count()==0 ||$normalSound->count()==0)?'btn-success':'btn-danger'}} ">المتوسط<i
                                                                    class="fa {{(empty($normalStatus))?'':'fa-check-circle'}}"></i></a>
                                                        <a href="{{url('quality/review/'.$articalHard->id.'/'.'resend')}}"
                                                           class="btn {{($hardReviewer->count()==0 ||$hardSound->count()==0)?'btn-success':'btn-danger'}} ">الصعب<i
                                                                    class="fa {{(empty($hardStatus))?'':'fa-check-circle'}}"></i></a>

                                                    </td>
                                                    <td>
                                                        @if($easyStatus && $normalStatus && $hardStatus)
                                                            <a href="{{url('quality/send/'.$list->id)}}" class="btn btn-success">اعاده ارسال</a>
                                                        @else
                                                            <p> راجع كل المقالات للارسال</p>
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
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection
