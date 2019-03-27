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
            background-color: #1aa62a;
        }
        .page-wrapper .finish-question{
            background-color: #9c6f04;
        }
    </style>
    @php
    $questionType=new \App\Models\Article();
    @endphp
    <div class="container" style="height: 800px;overflow-x: hidden;
    overflow-y: hidden;">
        <div class="container">

            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div style="text-align: center">
                        <p class="question-type active-question">الأسئلة الأساسية</p>
                        <p class="question-type">الأسئلة الإضافية</p>
                    </div>
                    <div class="row">
                        <!-- [ HTML5 Export button ] start -->
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        صفحة إضافة الأسئلة الأساسية
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
                                                <span id="articaasdasdl">{!! $artical->article !!}</span>
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
                                                        <input type="hidden" name="type" value="{{$questionType->getNormalArticleValue()}}">

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
                                                    <button style="margin-bottom: 20px" class="btn btn-primary" type="submit"><span
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
            </div>
        </div>
    </div>

@endsection