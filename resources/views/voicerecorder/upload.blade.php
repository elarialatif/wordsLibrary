@extends('layouts.app')
@section('content')
    @php
        $sound = \App\Models\Sound::where('article_id', $article->id)->first();
    @endphp
    <style>
        #font p{
            font-family: "Open Sans", sans-serif !important;
            font-size: 18px;

        }
    </style>
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
                                        رفع الملف الصوتي
                                    </h5>
                                    <a style="float: left" class="btn btn-success"
                                       href="{{url('VoiceRecorder/'.$page)}}"><span class="fa fa-arrow-circle-left"> رجوع </span></a>
                                    <a data-toggle="modal"
                                       data-target="#uploadModal"
                                       class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">
                                        رفع الملف</a>
                                    <div class="modal fade" id="uploadModal"
                                         tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel"
                                         aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">رفع الملف الصوتي</h4>
                                                    <button type="button" class="close"
                                                            data-dismiss="modal">&times;
                                                    </button>
                                                </div>
                                                <form method="post"
                                                      action="{{url('VoiceRecorder/sound/save/'.$article->id)}}"
                                                      enctype="multipart/form-data">

                                                    <!-- Modal body -->
                                                    <div class="modal-body">
                                                        @csrf
                                                        <label for="uploadfile" class="btn btn-success">
                                                            <div id="empty">
                                                                اختر الملف
                                                            </div>
                                                        </label>
                                                        <input id="uploadfile" type="file" name="sound" accept=".mp3" style="display: none">
                                                    </div>

                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger"
                                                                data-dismiss="modal">خروج
                                                        </button>
                                                        <button type="submit" class="btn btn-info">
                                                            <i style="margin-right: 1px;" class="fa  fas fa-upload"></i>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-header">
                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                    </v>
                                    <h6 style="font-size: 20px">
                                        <button class="btn btn-secondary" style="float: left;"
                                                onclick="changefont('plus')"><i class="fa fa-plus-square"></i></button>
                                        <button class="btn btn-primary" style="float: left;"
                                                onclick="changefont('minus')"><i class="fa fa-minus"></i></button>
                                        @if($sound)
                                            <audio controls style="float: right">
                                                <source src="{{url('/').'/'.$sound->path}}" type="audio/ogg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        @endif
                                    </h6>


                                    <br>
                                    <br>
                                    <br>
                                    <h3>المقال</h3>
                                    <div id="font">
                                            {!! $article->article !!}
                                    </div>

                                    @if($sound)
                                        @php
                                            $issues=\App\Repository\IssuesRepository::getAllIssuesForArticle($sound->id,'sound',\App\Helper\IssuesSteps::Open,\App\Helper\IssuesSteps::DoneByEditor);
                                        @endphp

                                        @if($issues->count()>0)
                                            <div class="card-header" id="Issues">
                                                <br/>
                                                <br/>
                                                <br/>
                                                <br/>
                                                <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                </v>
                                                <h6 style="font-size: 20px">المشاكل الصوتية
                                                </h6>

                                                <div class="table-responsive" style="display: inline-block">
                                                    <table
                                                            class="display table nowrap table-striped table-hover"
                                                            style="width:100%;float: right">
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
                                                                     aria-labelledby="exampleModalLabel"
                                                                     aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <!-- Modal Header -->
                                                                            <div class="modal-header">
                                                                                <h4 class="modal-title">Modal
                                                                                    Heading</h4>
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
                                                                                <button type="button"
                                                                                        class="btn btn-danger"
                                                                                        data-dismiss="modal">خروج
                                                                                </button>&nbsp;
                                                                                <a href="{{url('issues/chang/step/'.$issue->id.'/'.\App\Helper\IssuesSteps::DoneByEditor)}}"
                                                                                   type="button"
                                                                                   class="btn btn-success">غلق</a>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endif
                                    @endif
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
                $('input[type="file"]').change(function (e) {
                    var fileName = e.target.files[0].name;
                    $('#empty').empty();
                    $('#empty').html("اسم الملف  :" + '<span style=\"display: inherit;\">'+ fileName +'</span>');
                    $('#empty').css("color", "#fff");

                });
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
                    $('#font p').css('font-size', i + 'px');

                }
            </script>
@endsection
@endsection