@extends('layouts.app')
@section('content')

    <style>
        form {
            display: block;
            width: 100%;
            background-color: #fff;
            background-clip: border-box;
            padding-top: 1rem;
            text-align: center;
        }
        table.list {
            background-color: #fff !important;
            border: 1px solid #eaeaea;
            margin-top: 1rem;
        }
        .submit{
            color: #fff;
            background-color: #04a9f5;
            padding: 10px 20px;
            border-radius: 0.25rem;
            font-size: 18px;
            margin: 1rem auto;
            border: 0;
            display: block;
            width: 10%;
        }
        input {
            width: 20%;
            height: 30px;
        }
        label {
            text-align: center;
            width: 5%;
            font-size: 17px;
        }
        #addRow,
        #deleteRow {
            color: #fff;
            background-color: #04a9f5;
            border-radius: 0.25rem;
            font-size: 17px;
            border: 0;
            width: 5%;
            height: 30px;
            margin-bottom: 0;
        }
        #empty div {
            margin-top: 0.5rem;
        }
    </style>
    <div class="container">
        <div class="container">
            @include('editor.FollowingTabsForCreateArticle')
            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">

                        <form method="post" action="{{url('editor/addVocabulary/'.$file_id.'/'.$level)}}">
                            @csrf
                            <label>الكلمة</label>
                            <input type="text" name="word[0][word]">
                            <label>المعنى</label>
                            <input type="text" name="word[0][mean]">

                            <button id="addRow"> اضافة</button>
                            <div id="empty"></div>
                            <button class="submit">حفظ</button>
                        </form>
                        <table class="table table-striped list">
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
                                                data-target="#myModal{{$word->id}}">تعديل
                                        </button>
                                        <div id="myModal{{$word->id}}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">

                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post"
                                                              action="{{url('editor/editVocabulary/'.$word->id)}}">
                                                            @csrf
                                                            <label> الكلمة </label>
                                                            <input type="text" name="word" value="{{$word->word}}">
                                                            <br>
                                                            <label>المعنى</label>
                                                            <input type="text" name="mean" value="{{$word->mean}}">
                                                            <br>
                                                            <button class="btn btn-success" id="addRow"> تعديل</button>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        @php
                            $articleObject=new \App\Models\Article();
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
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">خروج
                                                        </button>
                                                        <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::DoneByEditor)}}"
                                                           type="button" class="btn btn-success">تم
                                                            النتهاء</a>
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

    <script>
        var i = 1;

        $('#1').css('background', 'green');
        $('#2').css('background', 'green');
        $('#3').css('background', '#539af6');
        document.getElementById("addRow").addEventListener("click", function (event) {
            event.preventDefault();
            divId = "div" + i;
            $("#empty").append('<div id=' + divId + '> <label>الكلمة</label>\n' +
                '                            <input type="text" name="word[' + i + '][word]" >\n' +
                '                            <label>المعنى</label>\n' +
                '                            <input type="text" name="word[' + i + '][mean]"> <button id="deleteRow"  onclick="remove(' + i + ',event)">مسح </button>' +
                '</div>');
            i++;

        });

        function remove(i, event) {
            // document.getElementById("removeRowDiv").addEventListener("click", function (event) {
            event.preventDefault();
            //id = $(this).attr('id');
            //    alert(i);
            $("#div" + i).remove();

            //   });
        }
    </script>
@endsection