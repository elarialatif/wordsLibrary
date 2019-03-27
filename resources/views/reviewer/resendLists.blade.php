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
                                                        <th> سهل</th>
                                                        <th> متوسط</th>
                                                        <th> صعب</th>
                                                        <th>الإجراء</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lists as $list)
                                                        @php
                                                            $grade=\App\Models\Grade::with('level')->where('id',$list->grade_id)->first();
                                            $easy=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy);
                                            $normal=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal);
                                            $hard=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard);
                                                        if($easy)
                                                        $issueseasy=\App\Repository\IssuesRepository::getAllIssuesForArticle($easy->id,'article',\App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open);
                                                        if($normal)
                                                        $issuesnormal=\App\Repository\IssuesRepository::getAllIssuesForArticle($normal->id,'article',\App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open);
                                                        if($hard)
                                                        $issueshard=\App\Repository\IssuesRepository::getAllIssuesForArticle($hard->id,'article',\App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open);
                                                        @endphp

                                                        {{--@if($list->step!=\App\Helper\Steps::reSendToReviewerFormEditor)--}}
                                                            {{--@continue--}}
                                                        {{--@endif--}}
                                                        <tr id="{{$list->id}}">

                                                            <td>{{$list->id}}</td>

                                                            <td>{{$list->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            <td><a href="{{url('reviewer/view/article/'.$list->id.'/'.\App\Helper\ArticleLevels::Easy.'/'.'resendingLists')}}"> <span
                                                                            @if(isset($issueseasy)) @if($issueseasy->count()>0&& $easy->status== App\Helper\ArticleLevels::notReview)  style="color: #ff2733"
                                                                            class="fa  fa-eye fa-2x"
                                                                            @endif @if($issueseasy->count()>0 && $easy->status== App\Helper\ArticleLevels::Review) style="color: #ff2733"
                                                                            class="fa  fa-window-close fa-2x"
                                                                            @endif  @if($issueseasy->count()==0 ) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif ></span> </a>
                                                            </td>
                                                            <td><a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Normal.'/'.'resendingLists')}}"> <span
                                                                            @if(isset($issuesnormal))  @if($issuesnormal->count()>0 && $normal->status== App\Helper\ArticleLevels::notReview)  style="color: #ff2733"
                                                                            class="fa  fa-eye fa-2x"
                                                                            @endif   @if($issuesnormal->count()==0 ) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @if($issuesnormal->count()>0 && $normal->status== App\Helper\ArticleLevels::Review) style="color: #ff2733"
                                                                            class="fa  fa-window-close fa-2x"
                                                                            @endif @endif ></span> </a>
                                                            </td>
                                                            <td><a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Hard.'/'.'resendingLists')}}"> <span
                                                                            @if(isset($issueshard)) @if($issueshard->count()>0 && $hard->status== App\Helper\ArticleLevels::notReview) style="color: #ff2733"
                                                                            class="fa  fa-eye fa-2x"
                                                                            @endif @if($issueshard->count()>0 && $hard->status== App\Helper\ArticleLevels::Review) style="color: #ff2733"
                                                                            class="fa  fa-window-close fa-2x"
                                                                            @endif @if($issueshard->count()==0) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif ></span> </a>
                                                            </td>
                                                            <td id="td{{$list->id}}" >
                                                                @if($issueseasy->count()>0||$issuesnormal->count()>0||$issueshard->count()>0)
                                                                    <a class="btn btn-danger" href="{{url('reviewer/reSendTo/editor/'.$list->id)}}">إعادة اراسال إلى
                                                                        المحرر</a>
                                                                @else
                                                                    <a class="btn btn-success" href="{{url('reviewer/sendto/create/question/'.$list->id)}}">إرسال
                                                                        </a>
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
                var td = "<a href='{{url('reviewer/sendto/create/question/')}}/" + list_id + "' class='btn btn-success' >  إرسال إلى معد الأسئلة</a> ";
            }

            else {
                var td = "<a href='{{url('reviewer/sendto/create/question/')}}/" + list_id + "' class='btn btn-danger' >  إعادة إرسال إلى المحرر</a> ";
            }
            $("#td" + list_id + "").empty();
            $("#td" + list_id + "").append(td);
        }


    </script>

@endsection

@endsection

