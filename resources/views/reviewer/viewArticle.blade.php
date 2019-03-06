@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="container">
            @include('layouts.FollowingTabsForReviewArticle')
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ HTML5 Export button ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        صفحة المراجعة
                                    </h5>
                                    <a style="float: left" class="btn btn-info"
                                       href="{{url('reviewer/mylists/'.$page)}}"><span
                                                class="fa fa-arrow-circle-left"> رجوع </span></a>
                                    @if($article->status!=\App\Helper\ArticleLevels::Review)


                                    @else
                                        <a href="" style="float: left;font-weight: bold;color: #0d71bb"
                                           class="btn btn-success">تمت
                                            المراجعة بنجاح</a>
                                    @endif

                                </div>
                                <div class="card-block">
                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                    </v>
                                    <h5>
                                        المقال
                                        <a href="" style="float:left" data-toggle="modal"
                                           data-target="#editartical{{$article->id}}"
                                           class="btn btn-icon btn-outline-info radbor"><i class="fas fa-edit"></i></a>
                                        <a href="" style="float:left" data-toggle="modal"
                                           data-target="#issueartical{{$article->id}}"
                                           class="btn btn-icon btn-outline-warning radbor"><i
                                                    class="fas fa-exclamation-triangle"></i></a>

                                        {{--model edit--}}
                                        <div class="modal fade bd-example-modal-lg" id="editartical{{$article->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المقال</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="POST" action="{{url('editor/save/article')}}">
                                                        @csrf
                                                        <div class="modal-body">

                                                            <div class="form-group">
                                                                <label for="article"
                                                                       class="col-form-label">المقال:</label>
                                                                <textarea class="mceEditor form-control" required
                                                                          name="article{{($flag==0)?$articleObject->getNormalArticleValue():$articleObject->getStretchArticleValue()}}">@if($flag==0) {!! $article->article !!} @else {!! $article->stretchArticle !!} @endif </textarea>
                                                                <input type="hidden" name="list_id"
                                                                       value="{{$article->list_id}}">
                                                                <input type="hidden" name="level"
                                                                       value="{{$article->level}}">
                                                            </div>


                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">
                                                                غلق
                                                            </button>
                                                            <button class="btn btn-primary" type="submit"><span
                                                                        class="fa fa-plus"></span> إضافة
                                                            </button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}
                                        {{--model issues--}}
                                        <div class="modal fade bd-example-modal-lg" id="issueartical{{$article->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">تعديل المقال</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="{{url('issues/create')}}" method="post">
                                                        <div class="modal-body">

                                                            @csrf
                                                            <label><h4>العنوان</h4></label>
                                                            <input type="text" name="title" class="form-control">
                                                            <input type="hidden" name="type" class="form-control">
                                                            <br>
                                                            <label><h4>ملاحظة</h4></label>
                                                            <textarea class="mceEditor" name="name"> </textarea>
                                                            <input type="hidden" name="field_id"
                                                                   value="{{$article->id}}">
                                                            <input type="hidden" name="table" value="article">
                                                            <input type="hidden" name="type"
                                                                   value="{{($flag==0)?$articleObject->getNormalArticleValue():$articleObject->getStretchArticleValue()}}">
                                                            <br>
                                                            <br>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">غلق
                                                            </button>
                                                            <button type="submit" class="btn btn-success"> حفظ
                                                            </button>

                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}
                                    </h5>
                                    <h6 style="font-size: 20px"></h6>
                                    <div id="tinymcFont">    @if($flag==0) {!! $article->article !!} @else {!! $article->stretchArticle !!} @endif </div>

                                    @php
                                        $type=$articleObject->getNormalArticleValue();
                                           if($flag!=0){
                                           $type=$articleObject->getStretchArticleValue();
                                           }
                                             $issues=\App\Models\Issues::where(['field_id'=>$article->id,'table'=>'article','type'=>$type])->whereIn('step',[App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open])->get();

                                    @endphp

                                    @if($issues->count()>0)
                                        <div class="table-responsive">
                                            <table id="key-act-button"
                                                   class="display table nowrap table-striped table-hover"
                                                   style="width:100%;">
                                                <thead>
                                                <tr>
                                                    <th>الكود</th>

                                                    <th>الاسم</th>
                                                    <th>عرض</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($issues as $issue)

                                                    <tr @if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                        style="background: #3ed93e" @endif>

                                                        <td>{{$issue->id}}</td>

                                                        <td>{{$issue->title}}</td>
                                                        <td>
                                                            <a data-toggle="modal"
                                                               data-target="#exampleModal{{$issue->id}}"
                                                               class="btn btn-primary"
                                                               style="color: white;float: left;font-weight: bold"> عرض<i
                                                                        class="fa fa-eye"></i></a>
                                                        </td>
                                                        {{--model for add new user--}}
                                                        <div class="modal fade" id="exampleModal{{$issue->id}}"
                                                             tabindex="-1"
                                                             role="dialog"
                                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Modal Heading</h4>
                                                                        <button type="button" class="close"
                                                                                data-dismiss="modal">
                                                                            &times;
                                                                        </button>
                                                                    </div>

                                                                    <!-- Modal body -->
                                                                    <div class="modal-body">
                                                                        {!! $issue->name !!}
                                                                    </div>
                                                                    <center style="color: green">
                                                                        <h3>
                                                                            {{\App\Helper\IssuesSteps::IssuesStep($issue->step)}}</h3>
                                                                    </center>
                                                                    <!-- Modal footer -->
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger"
                                                                                data-dismiss="modal">خروج
                                                                        </button>&nbsp;
                                                                        <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::CloseByCreator)}}"
                                                                           type="button" class="btn btn-success">غلق</a>
                                                                        <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::Open)}}"
                                                                           type="button" class="btn btn-danger">اعادة
                                                                            الى المحرر</a>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            @endif
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
<script>
    if ("{{$flag}}" == "0") {

        $('#1').css('background', '#539af6');
    }
    else {

        $('#2').css('background', '#539af6');
    }
</script>
@endsection