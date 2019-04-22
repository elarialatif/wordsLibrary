@extends('layouts.app')
@section('content')

    @php
        $article= App\Models\Article::where(['list_id'=>$list->id,'level'=>$level])->first();
        $data= App\Models\ArticleFiles::where(['list_id'=>$list->id])->first();
        $catg= App\Models\ListCategory::with('catg')->where(['list_id'=>$list->id])->get();
         $articleObject = new App\Models\Article();

        $AllArticles= App\Models\Article::where(['list_id'=>$list->id])->get();
        if($article){
    $articleCateg=\App\Models\ListCategory::where('list_id',$article->id)->get()->pluck('cat_id')->toArray();
    }
    @endphp
    <div class="container">
        <div class="container">
            @include('editor.FollowingTabsForCreateArticle')
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ HTML5 Export button ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        <span style="font-weight: bold">{{$list->grade->name}}</span> ( <span
                                                style="color: blue">{{$list->list}} </span>) (<span
                                                style="color: blue">{{\App\Helper\ArticleLevels::getLevel($level)}} </span>)
                                    </h5>
                                    @php if($page==null){
                                    $page="refusedLists";
                                    }  @endphp
                                    <a href="{{url('editor').'/'.$page}}" style="float: left" class="btn btn-success">
                                        رجوع <span class="fa fa-arrow-left">  </span> </a>
                                    <div style="text-align: center">
                                        <span style="font-weight: bold"> المؤلف : </span> ( <span
                                                style="color: blue">{{$data->editor}} </span>)
                                        <span style="font-weight: bold"> المرجع : </span> ( <span
                                                style="color: blue">{{$data->reference}} </span>)
                                        <span style="font-weight: bold"> بيانات النشر : </span> ( <span
                                                style="color: blue">{{$data->publish_details}} </span>)
                                        <span style="font-weight: bold"> تم الرفع بواسطة : </span> ( <span
                                                style="color: blue">{{$data->user->name}} </span>)
                                        <span style="font-weight: bold"> التصنيفات :  </span>
                                        ( <span style="color: blue">
                                            @foreach($catg as $catg)
                                                <span>{{$catg->catg->name}}</span>
                                            @endforeach
                                        </span>)

                                    </div>
                                </div>
                                <div class="card-block">


                                    <div class="row">


                                        <div class="col-md-6"
                                             style="border-left: solid 2px black;font-size:18px;line-height: 1.5">
                                            <h6 style="font-size: 20px">
                                                <button class="btn btn-secondary" style="float: left;"
                                                        onclick="changefont('plus')"><i class="fa fa-plus-square"></i></button>
                                                <button class="btn btn-primary" style="float: left;"
                                                        onclick="changefont('minus')"><i class="fa fa-minus"></i></button>

                                            </h6>
                                            <div class="color-map ">
                                                <div class="complete">
                                                    <p class="badge badge-success">سهل</p>
                                                    <p class="badge badge-warning">متوسط</p>
                                                    <p class="badge badge-danger">صعب</p>
                                                </div>
                                            </div>
                                            <form action="{{url('editor/save/article')}}" method="post">
                                                <div id='font'>
                                                    @php
                                                        foreach ($orginalFile as $key => $value) {
                                                             $word = App\Models\Word::where(['word'=> $value,'grade_id'=>$list->grade_id,'file_id'=>$file_id])->first();


                                                             if ($word) {
                                                                 if($word->level==App\Helper\ArticleLevels::Easy )
                                                                     echo "<span style='color: #10cf3b;font-size:14px;'> $value  </span>" . ' ';
                                                                     if($word->level==App\Helper\ArticleLevels::Hard)
                                                                     echo "<span style='color: red;font-size:14px;' > $value  </span>" . ' ';


                                                             }
                                                             else {
                                                                 echo"<span style='font-size:14px;'> $value  </span>" . ' ';
                                                             }
                                                         };
                                                    @endphp
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            @if($type==$articleObject->getNormalArticleValue())
                                                <label> مقدمة السؤال القبلي </label>
                                                <textarea type="text" class="form-control" name="hint">@if($article) {{$article->pollHint}} @endif  </textarea>
                                                <label> السؤال القبلي والبعدي </label>
                                                <textarea type="text" class="form-control" name="poll">@if($article) {{$article->poll}} @endif  </textarea>
                                                <br>
                                            @endif

                                            @csrf
                                            <textarea class="mceEditor"
                                                      name="article{{$type}}">@if($article) @if($type==$articleObject->getNormalArticleValue()){!! $article->article !!} @else {!! $article->stretchArticle !!}@endif @endif </textarea>
                                            <input name="image" type="file" id="upload" hidden onchange="">
                                            <br>
                                            <br>
                                            <input type="hidden" name="list_id" value="{{$list->id}}">
                                            <input type="hidden" name="level" value="{{$level}}">
                                            <input type="hidden" name="type" value="{{$type}}">
                                            <button type="submit" class="btn btn-success btn-lg">حفظ</button>
                                            <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                    data-target="#myModal"> عرض المقال
                                            </button>

                                        </div>
                                    </div>
                                    <div id="myModal" style="width: 100%" class="modal fade bd-example-modal-lg"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">

                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">

                                                    <center><h4 class="modal-title">المقال</h4></center>

                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6"
                                                             style="border-left: solid 2px black;font-size:14px;line-height: 1.5">

                                                            @php
                                                                foreach ($orginalFile as $key => $value) {
                                                                     $word = App\Models\Word::where(['word'=> $value,'grade_id'=>$list->grade_id,'file_id'=>$file_id])->first();


                                                                     if ($word) {
                                                                         if($word->level==App\Helper\ArticleLevels::Easy )
                                                                             echo "<span style='color: #10cf3b;font-size:14px;'> $value  </span>" . ' ';
                                                                             if($word->level==App\Helper\ArticleLevels::Hard)
                                                                             echo "<span style='color: red;font-size:14px;' > $value  </span>" . ' ';


                                                                     }
                                                                     else {
                                                                         echo $value . ' ';
                                                                     }
                                                                 };
                                                            @endphp
                                                        </div>

                                                        <div class="col-md-6"
                                                             style="border-left: solid 2px black;font-size:18px;line-height: 1.5">
                                                            @if($article)
                                                                <div id="tinymcFont">    {!! $article->article !!} </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">

                                                    @if($AllArticles->count()==App\Helper\ArticleLevels::NumberOfLevels)
                                                        <a
                                                                class="btn btn-success"
                                                                href="{{url('editor/sendArticleOfListToReviewer/'.$article->list_id)}}">إرسال
                                                            إلى المراجعة</a>  @endif
                                                        &nbsp;&nbsp;&nbsp;
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">غلق
                                                        </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </form>
                                    <div class="table-responsive">

                                        @if($article)
                                            @php
                                                //   $issues=  \App\Models\Issues::where(['table' => 'article', 'field_id' => $article->id,'step'=>\App\Helper\IssuesSteps::Open])->get();
                                                            //   $issues=\App\Repository\IssuesRepository::getAllIssuesForArticle($article->id,'article',App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open);
                                            $issues=\App\Models\Issues::where(['field_id'=>$article->id,'table'=>'article','type'=>$type])->whereIn('step',[App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open])->get();
                                            @endphp

                                            @if($issues->count()>0)
                                                <table id="key-act-button"
                                                       class="display table nowrap table-striped table-hover"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>الكود</th>

                                                        <th>الاسم</th>
                                                        <th>عرض</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($issues as $issue)

                                                        <tr @if($issue->step==\App\Helper\IssuesSteps::DoneByEditor) style="background: #3ed93e" @endif>

                                                            <td>{{$issue->id}}</td>

                                                            <td>{{$issue->title}}</td>
                                                            <td>
                                                                <a data-toggle="modal"
                                                                   data-target="#exampleModal{{$issue->id}}"
                                                                   class="btn btn-primary"
                                                                   style="color: white;float: left;font-weight: bold">
                                                                    عرض<i
                                                                            class="fa fa-eye"></i></a>
                                                            </td>
                                                            {{--model for add new user--}}
                                                            <div class="modal fade" id="exampleModal{{$issue->id}}"
                                                                 tabindex="-1" role="dialog"
                                                                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog" role="document">
                                                                    <div class="modal-content">

                                                                        <!-- Modal Header -->
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">عرض الملاحظة</h4>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal">&times;
                                                                            </button>
                                                                        </div>

                                                                        <!-- Modal body -->
                                                                        <div class="modal-body">
                                                                            {!! $issue->name  !!}
                                                                        </div>
                                                                        <center style="color: green">
                                                                            <h3>{{\App\Helper\IssuesSteps::IssuesStep($issue->step)}}</h3>
                                                                        </center>

                                                                        <!-- Modal footer -->
                                                                        <div class="modal-footer">

                                                                            <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::DoneByEditor)}}"
                                                                               type="button" class="btn btn-success">تم
                                                                                الانتهاء</a>
                                                                            <button type="button" class="btn btn-danger"
                                                                                    data-dismiss="modal">خروج
                                                                            </button>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            @endif
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

@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
<script>
    {{--if ("{{$type}}" == "{{$articleObject->getNormalArticleValue()}}") {--}}
        {{--$('#0').css('background', '#green');--}}
        {{--$('#1').css('background', '#539af6');--}}

    {{--}--}}
    {{--else {--}}
        {{--$('#0').css('background', '#green');--}}
        {{--$('#1').css('background', 'green');--}}
        {{--$('#2').css('background', '#539af6');--}}
    {{--}--}}

</script>
<script>
    var i = 14;

    function changefont(font) {

        if (font === 'plus' && i < 50) {
            i += 2;
        }
        if (font === 'minus' && i > 14) {
            i -= 2;
        }
        $('#font span').css('font-size', i + 'px');

    }
</script>
@endsection