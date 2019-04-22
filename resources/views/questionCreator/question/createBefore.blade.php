@extends('layouts.app')
@section('content')
    <style>
        #target {
            /*height: fill-available;*/
            /*-ms-height: fill-available;*/

        }
        body{
            /*overflow-x: hidden;*/
            /*overflow-y: hidden;*/
        }
        .page-wrapper .question-type{
            display: inline-block;
            margin-left: 10%;
            padding: 13px;
            border: 1px #dee2e6 solid;
            border-radius: 50%;
            font-size: 24px;
        }
        .page-wrapper .active-question{
            background-color: #23b7e5;
        }
        .page-wrapper .finish-question{
            background-color: #1de9b6;
        }

    </style>
    @php
        $questionType=new \App\Models\Article();
    @endphp
    <div class="container" style="height: 800px;
   ">
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
                                        صفحة إضافة الأسئلة الاضافيه
                                    </h5>
                                </div>
                                <?php $m = 1;?>
                                <div class="card-block">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6"
                                                 style="border-left: solid 2px black;font-size:18px;line-height: 1.5;overflow: scroll; width: 200px; height:-webkit-fill-available;"
                                                 id="pinned">
                                                {{-- <div id="tinymcFont" style="max-width: 200px">  --}} {{--</div>--}}
                                                {{--<span id="articaasdasdl">{!! $artical->article !!}</span>--}}
                                                <span id="articaasdasdl">{!!$artical->stretchArticle!!}</span>
                                            </div>
                                            {{--  --}}
                                            {{--  --}}
                                            <div class="col-md-6" id="target"
                                                 style="overflow: scroll; width: 200px; height:-webkit-fill-available;">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <button class="btn btn-primary" id="add">إضافة عدد معين</button>
                                                        <input class="form-control" type="number" name="number"
                                                               style="display: none" id="inputNum2"
                                                               placeholder="ادخل الرقم">
                                                        <br>
                                                    </div>
                                                </div>
                                                <button id="btn" class=" btn btn-primary"> إضافة حقول للأسئلة</button>

                                                <form action="{{url('question/create/'.$artical->id)}}" method="post">
                                                    {{csrf_field()}}
                                                    <div class="row">
                                                        <input type="hidden" name="list_id"
                                                               value="{{$artical->list_id}}">
                                                        <input type="hidden" name="artical_id" value="{{$artical->id}}">
                                                        <input type="hidden" name="type" value="{{$questionType->getStretchArticleValue()}}">

                                                    </div>
                                                    @if(old('question')>0)
                                                        <?php $i = 0?>
                                                        @php
                                                            $ans1= old("ans1");
                                                         $ans2= old("ans2");
                                                         $ans3= old("ans3");
                                                         $ans4= old("ans4");
                                                       $trueans= old("true_answer");
                                                        @endphp
                                                        @foreach(old('question') as $questions)


                                                            <div class="col-md-12"><span id="indexNum">{{$m}}-</span>السؤال:<br>
                                                                <div class="form-group">
                                        <textarea class="mceEditor" type="text" name="question[{{$i}}]" rows="8"
                                                  cols="90">{{$questions}}</textarea>
                                                                    <input name="image" type="file" id="upload" hidden
                                                                           onchange="">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    الاختيار الأول:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans1[{{$i}}]"
                                                                               value="{{$ans1[$i]}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    الاختيار الثاني:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans2[{{$i}}]"
                                                                               value="{{$ans2[$i]}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    الاختيار الثالث:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans3[{{$i}}]"
                                                                               value="{{$ans3[$i]}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    الاختيار الرابع:<br>
                                                                    <div class="form-group">
                                                                        <input required type="text" name="ans4[{{$i}}]"
                                                                               value="{{$ans4[$i]}}">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">

                                                                <div class="col-md-6">
                                                                    الإجابة الصحيحة:<br>
                                                                    <div class="form-group">
                                                                        <select class="form-control"
                                                                                name="true_answer[{{$i}}]" required>
                                                                            <option value="">اختر الإجابة</option>
                                                                            <option value="ans1"
                                                                                    @if($trueans[$i]=='ans1') selected @endif>
                                                                                الاختيار
                                                                                الأول
                                                                            </option>
                                                                            <option value="ans2"
                                                                                    @if($trueans[$i]=='ans2') selected @endif>
                                                                                الاختيار
                                                                                الثاني
                                                                            </option>
                                                                            <option value="ans3"
                                                                                    @if($trueans[$i]=='ans3') selected @endif>
                                                                                الاختيار
                                                                                الثالث
                                                                            </option>
                                                                            <option value="ans4"
                                                                                    @if($trueans[$i]=='ans4') selected @endif>
                                                                                الاختيار
                                                                                الرابع
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php $i++?>
                                                        @endforeach
                                                    @else
                                                        <div class="col-md-12"><span id="indexNum">{{$m}}-</span>
                                                            السؤال:<br>
                                                            <div class="form-group">
                                    <textarea class="mceEditor" type="text" name="question[0]" rows="8"
                                              cols="90"></textarea>
                                                                <input name="image" type="file" id="upload" hidden
                                                                       onchange="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                الاختيار الأول:<br>
                                                                <div class="form-group">
                                                                    <input required type="text" name="ans1[0]">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                الاختيار الثاني:<br>
                                                                <div class="form-group">
                                                                    <input required type="text" name="ans2[0]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                الاختيار الثالث:<br>
                                                                <div class="form-group">
                                                                    <input required type="text" name="ans3[0]">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                الاختيار الرابع:<br>
                                                                <div class="form-group">
                                                                    <input required type="text" name="ans4[0]">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">

                                                            <div class="col-md-6">
                                                                الإجابة الصحيحة:<br>
                                                                <div class="form-group">
                                                                    <select class="form-control" name="true_answer[0]"
                                                                            required>
                                                                        <option value="">اختر الإجابة</option>
                                                                        <option value="ans1">الاختيار الأول</option>
                                                                        <option value="ans2">الاختيار الثاني</option>
                                                                        <option value="ans3">الاختيار الثالث</option>
                                                                        <option value="ans4">الاختيار الرابع</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    {{--<div class="row">--}}
                                                    {{--<div class="col-md-6">--}}
                                                    {{--<div class="form-group">--}}
                                                    {{----}}
                                                    {{--<label> اسم الموضوع :</label>--}}
                                                    {{--<input style="margin-bottom: 50px" type="text" class="form-control" name="list[0]"--}}
                                                    {{--placeholder="اسم الموضوع">--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    {{--</div>--}}
                                                    <div id="empty">
                                                    </div>
                                                    <input type="hidden" name="submitType" value="lastQuestion">
                                                    <button style="margin-bottom: 100px" class="btn btn-primary" type="submit"><span
                                                                class="fa fa-plus"></span>إضافة
                                                    </button>

                                                    <br>
                                                    <br>
                                                    <br>
                                                </form>

                                                <script>
                                                    var i = 1;
                                                    $('#add').click(function (e) {
                                                        e.preventDefault();
                                                        $('input[name=number]').toggle();
                                                    });
                                                    $("#btn").click(function (event) {
                                                        event.preventDefault();
                                                        if ($("#add").click()) {
                                                            $('input[name=number]').toggle();
                                                            for (count = 0; count < $('input[name=number]').val(); count++) {
                                                                $("#empty").append(
                                                                    '<div class = "form-group" id="btn[' + i + ']" >\n' +
                                                                    '<div class="row">\n' +
                                                                    '                <div class="col-md-12">\n' +
                                                                    '<span id="indexNum2">' + (i + 1) + '-</span>' +
                                                                    '                    السؤال:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <textarea class="mceEditor"  type="text"  rows="8" cols="90" name="question[' + i + ']"></textarea>\n' +
                                                                    '<input name="image" type="file" id="upload" hidden onchange="">' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '            </div>\n' +
                                                                    '            <div class="row">\n' +
                                                                    '                <div class="col-md-6">\n' +
                                                                    '                    الاختيار الأول:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <input required type="text" name="ans1[' + i + ']">\n' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '                <div class="col-md-6">\n' +
                                                                    '                    الاختيار الثاني:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <input required type="text" name="ans2[' + i + ']">\n' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '            </div>\n' +
                                                                    '            <div class="row">\n' +
                                                                    '                <div class="col-md-6">\n' +
                                                                    '                    الاختيار الثالث:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <input required type="text" name="ans3[' + i + ']">\n' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '                <div class="col-md-6">\n' +
                                                                    '                    الاختيار الرابع:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <input required type="text" name="ans4[' + i + ']">\n' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '            </div>\n' +
                                                                    '            <div class="row">\n' +
                                                                    '                <div class="col-md-6">\n' +
                                                                    '                    الإجابة الصحيحة:<br>\n' +
                                                                    '                    <div class="form-group">\n' +
                                                                    '                        <select class="form-control" name="true_answer[' + i + ']" required>\n' +
                                                                    '                            <option value="">اختر الإجابة</option>\n' +
                                                                    '                            <option value="ans1">الاختيار الأول</option>\n' +
                                                                    '                            <option value="ans2">الاختيار الثاني</option>\n' +
                                                                    '                            <option value="ans3">الاختيار الثالث</option>\n' +
                                                                    '                            <option value="ans4">الاختيار الرابع</option>\n' +
                                                                    '                        </select>\n' +
                                                                    '                    </div>\n' +
                                                                    '                </div>\n' +
                                                                    '            </div>' +
                                                                    '<button class="btn btn-danger " id=\"btn[' + i + ']\" onclick="remove()"><i class="fa fa-trash"></i> حذف</button>' +
                                                                    '</div>' +
                                                                    '</div>' +
                                                                    '</div>' +
                                                                    '</div>'
                                                                )
                                                                ;
                                                                i++;
                                                            }
                                                            editor();
                                                        }
                                                        for (count = 0; count < $("#inputNum").val(); count++) {
                                                            $("#empty").append('<div class = "form-group" id="btn[' + i + ']" >\n' +
                                                                '<div class="row">\n' +
                                                                '                <div class="col-md-8">\n' +
                                                                '                    السؤال:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <input required type="text"  name="question[' + i + ']">\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '            </div>\n' +
                                                                '            <div class="row">\n' +
                                                                '                <div class="col-md-6">\n' +
                                                                '                    الاختيار الأول:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <input required type="text" name="ans1[' + i + ']">\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '                <div class="col-md-6">\n' +
                                                                '                    الاختيار الثاني:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <input required type="text" name="ans2[' + i + ']">\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '            </div>\n' +
                                                                '            <div class="row">\n' +
                                                                '                <div class="col-md-6">\n' +
                                                                '                    الاختيار الثالث:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <input required type="text" name="ans3[' + i + ']">\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '                <div class="col-md-6">\n' +
                                                                '                    الاختيار الرابع:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <input required type="text" name="ans4[' + i + ']">\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '            </div>\n' +
                                                                '            <div class="row">\n' +
                                                                '                <div class="col-md-6">\n' +
                                                                '                    الإجابة الصحيحة:<br>\n' +
                                                                '                    <div class="form-group">\n' +
                                                                '                        <select class="form-control" name="true_answer[' + i + ']" required>\n' +
                                                                '                            <option value="">اختر الإجابة</option>\n' +
                                                                '                            <option value="ans1">الاختيار الأول</option>\n' +
                                                                '                            <option value="ans2">الاختيار الثاني</option>\n' +
                                                                '                            <option value="ans3">الاختيار الثالث</option>\n' +
                                                                '                            <option value="ans4">الاختيار الرابع</option>\n' +
                                                                '                        </select>\n' +
                                                                '                    </div>\n' +
                                                                '                </div>\n' +
                                                                '            </div>' +
                                                                '<button class="btn btn-danger " id=\"btn[' + i + ']\" onclick="remove()"><i class="fa fa-trash"></i> حذف</button>' +
                                                                '</div>' +
                                                                '</div>' +
                                                                '</div>' +
                                                                '</div>')
                                                            ;
                                                            i++;
                                                        }
                                                    });


                                                    $('#articaasdasdl').children("div:first").removeClass('col-md-6');
                                                    $('#articaasdasdl>div.col-md-6').children().last().remove();

                                                    function remove() {
                                                        var id = event.target.id;
                                                        var remove = document.getElementById(id);
                                                        remove.remove();
                                                    }


                                                </script>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
          $questionStretch=\App\Models\Question::where(['artical_id'=>$artical->id,'type'=>$questionType->getStretchArticleValue()])->get();
                @endphp
                @foreach($questionStretch as $question)
                    <table class="table table-condensed">
                        <thead>
                        <tr>
                            <th>{!! $question->question !!}
                                <a style="float:left" href="{{url('question/delete/'.$question->id)}}" class="btn btn-danger">مسح</a>
                                <a style="float:left" data-toggle="modal" data-target="#editModal{{$question->id}}"
                                   class="btn btn-info">تعديل</a>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{$question->ans1}}</td>
                        </tr>
                        <tr>
                            <td>{{$question->ans2}}</td>
                        </tr>
                        <tr>
                            <td>{{$question->ans3}}</td>
                        </tr>
                        <tr>
                            <td>{{$question->ans4}}</td>
                        </tr>
                        <tr>
                            <td>
                                الإجابة الصحيحة:
                                @php $true=$question->true_answer; @endphp
                                {{$question->$true}}</td>
                        </tr>
                        @php
                            $issue=\App\Models\Issues::where(['field_id'=>$question->id,'table'=>'question'])->get();    @endphp
                        @if($issue->count()>0)
                            <table class="table table-condensed">
                                <thead style="background-color: #0fa73e">
                                <tr>
                                    <th>العنوان</th>
                                    <th>الملاحظة</th>
                                    <th>الحالة</th>
                                    <th>عرض</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($issue as $issue)
                                    <tr>
                                        <td>{{$issue->title}}</td>
                                        <td>{{$issue->name}}</td>
                                        <td>@if($issue->step==\App\Helper\IssuesSteps::CloseByCreator)
                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::CloseByCreator)}}
                                            @elseif($issue->step==\App\Helper\IssuesSteps::Open)
                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}
                                            @else
                                                {{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}
                                            @endif
                                        </td>
                                        <td><a data-toggle="modal" data-target="#editIssue{{$issue->id}}"><i
                                                        class="fa fa-eye"></i></a></td>
                                    </tr>
                                    {{--model for edit Issuses--}}
                                    <div class="modal fade" id="editIssue{{$issue->id}}" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">عرض ملاحظة</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('issues/edit/'.$issue->id)}}" method="post">
                                                        @csrf
                                                        <label><h4>العنوان</h4></label>
                                                        <input disabled type="text" name="title" class="form-control"
                                                               value="{{$issue->title}}">
                                                        <br>
                                                        <label><h4>الملاحظة</h4></label>
                                                        <textarea disabled name="name" rows="6"
                                                                  cols="60"> {!!$issue->name!!}</textarea>
                                                        <input type="hidden" name="field_id" value="{{$question->id}}">
                                                        <input type="hidden" name="table" value="question">
                                                        <select class="form-control" name="step" required>
                                                            <option value="">الحالة</option>
                                                            <option value="{{\App\Helper\IssuesSteps::Open}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::Open)}}</option>
                                                            <option value="{{\App\Helper\IssuesSteps::DoneByEditor}}">{{\App\Helper\IssuesSteps::IssuesStep(\App\Helper\IssuesSteps::DoneByEditor)}}</option>
                                                        </select>
                                                        <br>
                                                        <br>
                                                        <button type="submit" class="btn btn-success"> تعديل</button>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{--end modal--}}
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        </tbody>
                    </table>
                    {{--model for edit question--}}
                    <div class="modal fade" id="editModal{{$question->id}}" tabindex="-1" role="dialog"
                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" style="max-width: 70% !important;" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">تعديل السؤال</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="{{url('question/edit')}}/{{$question->id}}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-8">
                                                السؤال:<br>
                                                <div class="form-group">
                                            <textarea class="mceEditor" type="text"
                                                      name="question"> {!! $question->question !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                الاختيار الأول:<br>
                                                <div class="form-group">
                                                    <input required type="text" name="ans1" value="{{$question->ans1}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                الاختيار الثاني:<br>
                                                <div class="form-group">
                                                    <input required type="text" name="ans2" value="{{$question->ans2}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                الاختيار الثالث:<br>
                                                <div class="form-group">
                                                    <input required type="text" name="ans3" value="{{$question->ans3}}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                الاختيار الرابع:<br>
                                                <div class="form-group">
                                                    <input required type="text" name="ans4" value="{{$question->ans4}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                الإجابة الصحيحة:<br>
                                                <div class="form-group">
                                                    <select class="form-control" name="true_answer" required>
                                                        <option value="">اختر الإجابة</option>
                                                        <option value="ans1" {{($question->true_answer=='ans1')?'selected':''}}>
                                                            الاختيار الأول
                                                        </option>
                                                        <option value="ans2" {{($question->true_answer=='ans2')?'selected':''}}>
                                                            الاختيار الثاني
                                                        </option>
                                                        <option value="ans3" {{($question->true_answer=='ans3')?'selected':''}}>
                                                            الاختيار الثالث
                                                        </option>
                                                        <option value="ans4" {{($question->true_answer=='ans4')?'selected':''}}>
                                                            الاختيار الرابع
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة
                                        </button>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--end modal--}}
                @endforeach
            </div>
        </div>
    </div>

@endsection