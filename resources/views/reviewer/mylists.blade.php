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
                                        مواضيعي
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
                                                        <th> عرض المقال سهل</th>
                                                        <th>عرض المقال متوسط</th>
                                                        <th>عرض المقال صعب</th>
                                                        <th>الاجراء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lists as $list)
                                                        @php
                                                            $grade=\App\Models\Grade::where('id',$list->grade_id)->first();
                                            $easy=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy);
                                            $normal=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal);
                                            $hard=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard);


                                                        if($easy)
                                                        $issueseasy=\App\Repository\IssuesRepository::getAllIssuesForArticle($easy->id,'article');
                                                        if($normal)
                                                        $issuesnormal=\App\Repository\IssuesRepository::getAllIssuesForArticle($normal->id,'article');
                                                        if($hard)
                                                        $issueshard=\App\Repository\IssuesRepository::getAllIssuesForArticle($hard->id,'article');


                                                        @endphp

                                                        @if($list->step!=\App\Helper\Steps::REVIEW_ARTICLE)
                                                            @continue
                                                        @endif
                                                        <tr id="{{$list->id}}">

                                                            <td>{{$list->id}}</td>

                                                            <td>{{$list->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            <td>
                                                                <a href="{{url('reviewer/view/article/'.$list->id.'/'.\App\Helper\ArticleLevels::Easy)}}"> <span
                                                                            @if(isset($issueseasy)) @if($issueseasy->count()>0 && $easy->status==App\Helper\ArticleLevels::Review) class="fa  fa-window-close fa-2x"
                                                                            style="color: #ff2733" @endif
                                                                            @if($issueseasy->count()>0 && $easy->status==App\Helper\ArticleLevels::notReview) class="fa  fa-eye fa-2x"
                                                                            style="color: #ff2733" @endif
                                                                            @if($issueseasy->count()==0 && $easy->status==App\Helper\ArticleLevels::Review)  class="fas fa-check-circle fa-2x"
                                                                            style="color: green"
                                                                            @endif @endif @if($issueseasy->count()==0 && $easy->status==App\Helper\ArticleLevels::notReview)  class="fa  fa-eye fa-2x" @endif></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Normal)}}"> <span
                                                                            @if(isset($issuesnormal))  @if($issuesnormal->count()>0 && $normal->status==App\Helper\ArticleLevels::Review) class="fa  fa-window-close fa-2x"
                                                                            style="color: #ff2733" @endif
                                                                            @if($issuesnormal->count()>0  && $normal->status==App\Helper\ArticleLevels::notReview)  class="fa  fa-eye fa-2x"
                                                                            style="color: #ff2733" @endif
                                                                            @if($issuesnormal->count()==0 && $normal->status==App\Helper\ArticleLevels::Review)  class="fas fa-check-circle fa-2x"
                                                                            style="color: green"
                                                                            @endif @endif @if($issuesnormal->count()==0 && $normal->status==App\Helper\ArticleLevels::notReview) class="fa  fa-eye fa-2x" @endif></span>
                                                                </a>
                                                            </td>
                                                            <td>
                                                                <a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Hard)}}"> <span
                                                                            @if(isset($issueshard)) @if($issueshard->count()>0 && $hard->status==App\Helper\ArticleLevels::Review) class="fa  fa-window-close fa-2x"
                                                                            style="color: #ff2733"
                                                                            @endif @if($issueshard->count()>0 && $hard->status==App\Helper\ArticleLevels::notReview) class="fa  fa-eye fa-2x"
                                                                            style="color: #ff2733"
                                                                            @endif @if($issueshard->count()==0 && $hard->status==App\Helper\ArticleLevels::Review) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif @if($issueshard->count()==0 && $hard->status==App\Helper\ArticleLevels::notReview)  class="fa  fa-eye fa-2x" @endif ></span>
                                                                </a>
                                                            </td>
                                                            <td id="td{{$list->id}}">
                                                                @if($easy->status==App\Helper\ArticleLevels::Review&&$normal->status==App\Helper\ArticleLevels::Review&&$hard->status==App\Helper\ArticleLevels::Review)
                                                                    @if($issueshard->count()>0 || $issuesnormal->count()>0 || $issueseasy->count()>0 )
                                                                        <a class="btn btn-danger"
                                                                           href="{{url('reviewer/reSendTo/editor/'.$list->id)}}">اعادة
                                                                            اراسال
                                                                            الى المحرر</a>
                                                                    @else <a class="btn btn-success"
                                                                             href="{{url('reviewer/sendto/create/question/'.$list->id)}}">ارسال
                                                                        الى معد الاسئلة</a>  @endif  @else<span
                                                                        class="fa fa-ban fa-2x"
                                                                        style="color: #ff2733;font-size: 18px"> قم بمراجعة المقالات </span> @endif
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
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>
    <script>

        function myfunction(list_id) {

            var arr = new Array();

            $("input:checkbox[name=check" + list_id + "]:checked").each(function () {
                    arr.push($(this).val());
                }
            )
            console.log(arr);

            if (arr.length == 3) {
                var td = "<a href='{{url('reviewer/sendto/create/question/')}}/" + list_id + "' class='btn btn-success' >  ارسال الى معد الاسئلة</a> ";
            }

            else {
                var td = "<a href='{{url('reviewer/sendto/create/question/')}}/" + list_id + "' class='btn btn-danger' >  اعادة ارسال الى المحرر</a> ";
            }
            $("#td" + list_id + "").empty();
            $("#td" + list_id + "").append(td);
        }


    </script>

@endsection

@endsection
