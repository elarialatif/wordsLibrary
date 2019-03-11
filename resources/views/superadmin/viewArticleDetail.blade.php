@extends('layouts.app')
@section('content')
    <style>
        body {
            padding: 10px;

        }

        #exTab1 .tab-content {
            padding: 5px 15px;
        }

        /* remove border radius for the tab */

        #exTab1 .nav-pills > li > a {
            border-radius: 0;
        }

        /* change border radius for the tab , apply corners on top*/

        ul.nav-pills li.current {
            background: #428bca;
            position: relative;
        }

        ul.nav-pills li.current a {
            color: #fff;
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
                                        <span style="font-size: 22px;font-weight: bold"> {{$list->list}}</span>
                                        <span style="color: blue;font-size: 20px"> {{$list->grade->name}}</span>
                                        <span style="color: darkblue;font-size: 16px;font-weight: bold"> {{\App\Helper\ArticleLevels::getLevel($article->level)}}</span>

                                    </h5>
                                    <a class="btn btn-success" href="{{url('allFiles')}}"
                                       style="float: left "><span class="fa fa-arrow-circle-left"> رجوع </span></a>
                                </div>
                                <div class="container"></div>

                                <div id="exTab1" class="container">
                                    <ul class="nav nav-pills">
                                        <li class="active current">
                                            <a href="#1a" data-toggle="tab">المقال</a>
                                        </li>
                                        <li><a href="#2a" data-toggle="tab">الانشطة</a>
                                        </li>
                                        <li><a href="#3a" data-toggle="tab">المقال الموسع</a>
                                        </li>
                                        <li><a href="#4a" data-toggle="tab">الانشطة الموسعة</a>
                                        </li>
                                    </ul>
                                    <div class="row">
                                        <div class="col-md-8">
                                            <div class="tab-content clearfix">
                                                {{--NormalArtical--}}
                                                <div class="tab-pane active " id="1a">
                                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                                    </v>
                                                    <h6 style="font-size: 20px">المقال
                                                        @if($sound)
                                                            <audio controls style="float: left;">
                                                                <source src="{{url('/').'/'.$sound->path}}"
                                                                        type="audio/ogg">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        @endif
                                                    </h6>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <span>
                                         <div id="tinymcFont"> {!! $article->article !!} </div>
                                    </span>
                                                </div>
                                                {{--NormalQuestion--}}
                                                <div class="tab-pane" id="2a">
                                                    @if($questions->count()>0)
                                                        <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                        </v>
                                                        <h6 style="font-size: 20px">الاسئلة الاساسية</h6>
                                                        @foreach($questions as $question)
                                                            <div class="card-header" id="Issues">
                                                                <h6 style="font-size: 20px">السؤال رقم {{$question->id}}
                                                                </h6>
                                                                <div class="table-responsive"
                                                                     style="display: inline-block">
                                                                    <table
                                                                            class="display table nowrap table-striped table-hover"
                                                                            style="width:100%;float: right">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="50%">/</th>
                                                                            <th width="50%">القيمة</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                السؤال
                                                                            </td>
                                                                            <td>
                                                                                {!! $question->question !!}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الاولي
                                                                            </td>
                                                                            <td>{{$question->ans1}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الثانيه
                                                                            </td>
                                                                            <td>{{$question->ans2}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الثالثه
                                                                            </td>
                                                                            <td>{{$question->ans3}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الرابعه
                                                                            </td>
                                                                            <td>{{$question->ans4}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الصحيحة
                                                                                @php $true=$question->true_answer; @endphp
                                                                            </td>
                                                                            <td>{{$question->$true}}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                {{--StretchArtical--}}
                                                <div class="tab-pane" id="3a">
                                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                                    </v>
                                                    <h6 style="font-size: 20px">المقال الموسع
                                                        @if($soundStretch)
                                                            <audio controls style="float: left;">
                                                                <source src="{{url('/').'/'.$soundStretch->path}}"
                                                                        type="audio/ogg">
                                                                Your browser does not support the audio element.
                                                            </audio>
                                                        @endif
                                                    </h6>
                                                    <br/>
                                                    <br/>
                                                    <br/>
                                                    <span>
                                         <div id="tinymcFont"> {!! $article->stretchArticle !!} </div>
                                    </span>
                                                </div>
                                                {{--StretchQuestion--}}
                                                <div class="tab-pane" id="4a">
                                                    @if($questionStretch->count()>0)
                                                        <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                        </v>
                                                        <h6 style="font-size: 20px">الاسئلة الاضافية</h6>
                                                        @foreach($questionStretch as $question)
                                                            <div class="card-header" id="Issues">
                                                                <h6 style="font-size: 20px">السؤال رقم {{$question->id}}
                                                                </h6>
                                                                <div class="table-responsive"
                                                                     style="display: inline-block">
                                                                    <table
                                                                            class="display table nowrap table-striped table-hover"
                                                                            style="width:100%;float: right">
                                                                        <thead>
                                                                        <tr>
                                                                            <th width="50%">/</th>
                                                                            <th width="50%">القيمة</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                السؤال
                                                                            </td>
                                                                            <td>
                                                                                {!! $question->question !!}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الاولي
                                                                            </td>
                                                                            <td>{{$question->ans1}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الثانيه
                                                                            </td>
                                                                            <td>{{$question->ans2}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الثالثه
                                                                            </td>
                                                                            <td>{{$question->ans3}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الرابعه
                                                                            </td>
                                                                            <td>{{$question->ans4}}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                الاجابة الصحيحة
                                                                                @php $true=$question->true_answer; @endphp
                                                                            </td>
                                                                            <td>{{$question->$true}}</td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <v style="margin-top: 2rem;right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h3 style="font-size: 20px;margin-top: 2rem;">المرادفات</h3>
                                            <div class="table-responsive" style="display: inline-block">
                                                <table
                                                        class="display table nowrap table-striped table-hover"
                                                        style="width:100%;float: left">
                                                    <thead>
                                                    <tr>
                                                        <th width="50%">الكلمه</th>
                                                        <th width="50%">المعني</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($vocab as $word)
                                                        <tr>
                                                            <td>{{$word->word}}</td>
                                                            <td>{{$word->mean}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <v style="margin-top: 2rem;right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h3 style="font-size: 20px;margin-top: 2rem;">المراحل</h3>
                                            <div class="table-responsive" style="display: inline-block">
                                                <table
                                                        class="display table nowrap table-striped table-hover"
                                                        style="width:100%;float: left">

                                                    <tbody>

                                                    <tr>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::ANALYZING_FILE.'/'.$list->id)}}">
                                                                الى محلل المقالات </a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::INSERTING_ARTICLE.'/'.$list->id)}}">
                                                                الى المحرر </a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::REVIEW_ARTICLE.'/'.$list->id)}}">
                                                                الى مراجع المقالات</a></td>


                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Create_Question.'/'.$list->id)}}">
                                                                الى مدخل الاسئلة</a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Review_Question.'/'.$list->id)}}">الى
                                                                مراجع الاسئلة</a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Languestic.'/'.$list->id)}}">الى
                                                                المراجع اللغوى </a></td>


                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Sound.'/'.$list->id)}}">
                                                                الى الصوت</a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Quality.'/'.$list->id)}}">
                                                                الى الجودة</a></td>
                                                        <td>
                                                            <a href="{{url('adminChangeStepOfList/'.\App\Helper\Steps::Publish.'/'.$list->id)}}">
                                                                نشر</a></td>

                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                            <v style="margin-top: 2rem;right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h3 style="font-size: 20px;margin-top: 2rem;">الروابط الاثرائية</h3>
                                            <div class="table-responsive" style="display: inline-block">
                                                <table class="display table nowrap table-striped table-hover"
                                                       style="width:100%;float: left">
                                                    @foreach($links as $word)
                                                        <a href="{{$word->link}}">{{$word->name}}</a>
                                                    @endforeach
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table table-striped table-dark table-bordered  table-hover" id="Table">
                                <thead>

                                <th style="text-align: center"> الحدث</th>
                                <th style="text-align: center;width: 15%"> التاريخ</th>

                                </thead>
                                <tbody id="myTable">
                                @php $logtimes=\App\Http\Controllers\superAdmin\LogTimeController::getDetailsOfLogtimesRows(null,null,'content_lists',$article->list_id); @endphp
                                @for($i=0;  $i<count($logtimes);$i++)
                                    <tr>

                                        <td>

                                            {{$logtimes[$i]['user_name']}} &nbsp; {{$logtimes[$i]['type']}}&nbsp;
                                            {{ $logtimes[$i]['table']}}&nbsp;
                                            {{$logtimes[$i]['name']}}
                                        </td>
                                        <td>
                    <span class="badge badge-warning pull-left"
                          style="background-color: #59b0f2">  {{$logtimes[$i]['created_at']}} </span>
                                        </td>

                                    </tr>
                                @endfor

                                </tbody>
                            </table>

                            <!-- [ HTML5 Export button ] end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // ===== Tabs ====
            $(' ul.nav-pills li').click(function () {
                var tab_id = $(this).attr('data-tab');

                $(' ul.nav-pills li').removeClass('current');
                $(' ul.nav-pills .tab-content').removeClass('current');

                $(this).addClass('current');
                $("#" + tab_id).addClass('current');
            });
            // ===== #Tabs ====
        </script>
        @section('css')
            <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

        @endsection
        @section('js')
            <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
            <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection
