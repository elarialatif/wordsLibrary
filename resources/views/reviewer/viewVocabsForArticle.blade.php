@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="container">
            @include('layouts.FollowingTabsForReviewArticle')
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">

@php  $articleObject=new \App\Models\Article(); @endphp
                        <div style="display: block; width: 100%; text-align: left;" >

                        @if($article->status!=\App\Helper\ArticleLevels::Review)
                                <a  href="{{url('update/article/status/'.$article->id)}}"
                                   class="btn btn-danger">تمت المراجعة</a>

                        @else
                            <a href=""
                               class="btn btn-success">تمت
                                المراجعة بنجاح</a>
                        @endif
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>الكلمة</th>
                                <th>معناها</th>
                                <th>الإجراء</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($allVocabularyForTheListAndLevel as $word)
                                <tr>
                                    <td>{{$word->word}}</td>
                                    <td>{{$word->mean}}</td>
                                    <td>
                                        <a class="btn btn-danger" href="{{url('editor/deleteVocabulary/'.$word->id)}}">مسح </a>
                                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                                data-target="#editVocab{{$word->id}}">تعديل
                                        </button>
                                        <a href="" style="float:left" data-toggle="modal"
                                           data-target="#issueartical{{$article->id}}"
                                           class="btn btn-icon btn-outline-warning radbor"><i
                                                    class="fas fa-exclamation-triangle"></i></a>
                                        {{--model issues--}}
                                        <div class="modal fade bd-example-modal-lg" id="issueartical{{$article->id}}"
                                             tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                             aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">إضافة ملاحظة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>

                                                    <form action="{{url('issues/create')}}" method="post">
                                                        <div class="modal-body">

                                                            @csrf
                                                            <div class="row">
                                                                <label class="col-md-2"><h4>العنوان</h4></label>
                                                                <input type="text" name="title" class="form-control col-md-8"
                                                                >
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label class="col-md-2"><h4>الملاحظة</h4></label>
                                                                <textarea name="name" rows="6"  class="form-control col-md-8"
                                                                          cols="55"> </textarea>
                                                            </div>
                                                            <input type="hidden" name="field_id"
                                                                   value="{{$article->id}}">
                                                            <input type="hidden" name="table" value="article">
                                                            <input type="hidden" name="type"
                                                                   value="{{$articleObject->getVocabularyValue()}}">
                                                            <br>
                                                            <br>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success"> حفظ
                                                            </button>
                                                            <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">غلق
                                                            </button>

                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        {{--end modal--}}

                                        {{-- edit Vocab modal--}}
                                        <div id="editVocab{{$word->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                              action="{{url('editor/editVocabulary/'.$word->id)}}">
                                                            @csrf
                                                            <div class="row">
                                                                <label for="word" class="col-md-2"> الكلمة </label>
                                                                <input type="text" name="word" class="col-md-8 form-control"  value="{{$word->word}}">
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <label for="name" class="col-md-2">المعنى</label>

                                                                <textarea name="name" class="col-md-8 form-control" rows="6"
                                                                          cols="40"> {{$word->mean}}</textarea>
                                                            </div>
                                                            <br>
                                                            <button class="btn btn-success" id="addRow"> تعديل</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">غلق
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        {{-- End Edit Vocab modal --}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @php

                                //   $issues=  \App\Models\Issues::where(['table' => 'article', 'field_id' => $article->id,'step'=>\App\Helper\IssuesSteps::Open])->get();
                                            //   $issues=\App\Repository\IssuesRepository::getAllIssuesForArticle($article->id,'article',App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open);
                            $issues=\App\Models\Issues::where(['field_id'=>$article->id,'table'=>'article','type'=>$articleObject->getVocabularyValue()])->whereIn('step',[App\Helper\IssuesSteps::DoneByEditor,\App\Helper\IssuesSteps::Open])->get();
                        @endphp

                        @if($issues->count()>0)
                            <table id="key-act-button"
                                   class="display table nowrap table-striped table-hover"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>الكود</th>

                                    <th>الاسم</th>

                                </tr>
                                </thead>
                                <tbody>
                                @foreach($issues as $issue)

                                    <tr @if($issue->step==\App\Helper\IssuesSteps::CloseByCreator) style="background: #3ed93e" @endif>

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
                                                        <h4 class="modal-title">Modal Heading</h4>
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
                                                        <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::CloseByCreator)}}"
                                                           type="button" class="btn btn-success">غلق</a>
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

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--<script>--}}
        {{--$('#3').css('background', '#539af6');--}}
    {{--</script>--}}
@endsection