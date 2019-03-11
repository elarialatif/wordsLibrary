@extends('layouts.app')
@section('content')
    <style>
        .modalDetails .modal-content {
            display: inline-block;
            vertical-align: middle;
            position: relative;
            max-width: 700px;
            width: 90%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 1);
            border-radius: 3px;
            background: #fff;
            text-align: center;
            top: 2rem;
            border: 0;
        }

        .modalDetails .modal-title {
            font-size: 18px !important;
        }

        .modalDetails.modal {
            background: rgba(0, 0, 0, 0.75);
        }

        .modalDetails .modal-body {
            position: inherit;
            display: block;
            margin: auto;
            text-align: center;
            padding: 1rem;
        }

        .modalDetails .modal-body .details {
            display: block;
            padding: 0.5rem 0;
            border: 1px solid #04a9f5;
            margin: auto;
            margin-bottom: 1rem;
            width: 60%;
            border-radius: 10px;
            background-color: #04a9f5;
            opacity: 0.8;
        }

        .modalDetails .modal-body .details span:first-child {
            font-size: 1rem;
            margin-left: 1rem;
            font-weight: 600;
        }

        .modalDetails .modal-body .details span:last-child {
            font-size: 1rem;
            color: #fff;
        }
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
                                            <h3 style="font-size: 20px;margin-top: 2rem;">الروابط الاثرائية</h3>
                                            <div class="table-responsive" style="display: inline-block">
                                                <table class="display table nowrap table-striped table-hover"
                                                       style="width:100%;float: left">
                                                    @foreach($links as $word)
                                                        <a href="{{$word->link}}">{{$word->name}}</a>
                                                    @endforeach
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
                                            {{--ListUsers--}}
                                            <v style="margin-top: 2rem;right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                            </v>
                                            <h3 style="font-size: 20px;margin-top: 2rem;">المعدين</h3>
                                            <a class="btn btn-info" data-toggle="modal" data-target="#myModal">المعدين</a>
                                            <!-- Modal -->
                                            <div id="myModal"
                                                 class="modalDetails modal fade"
                                                 role="dialog">
                                                <div class="modal-dialog">

                                                    <!-- Modal content-->
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">قائمة
                                                                المعدين
                                                            </h4>
                                                            <button type="button" class="close"
                                                                    data-dismiss="modal">&times;
                                                            </button>

                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="details">
                                                                <span>معد مواضيع:</span>
                                                                <span>{{$list->user->name}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>محرر:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::EDITOR)->first())?$users->where('role',\App\Helper\UsersTypes::EDITOR)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>محلل مواضيع:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first())?$users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>مراجع:</span>
                                                                <span> {{($users->where('role',\App\Helper\UsersTypes::REVIEWER)->first())?$users->where('role',\App\Helper\UsersTypes::REVIEWER)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span> مدخل اسئلة:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>مراجع اسئلة:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first()->name:"لا يوجد"}}</hspan6>
                                                            </div>
                                                            <div class="details">
                                                                <span>مراجع لغوى:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::Languestic)->first())?$users->where('role',\App\Helper\UsersTypes::Languestic)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>مدخل صوت:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::Sound)->first())?$users->where('role',\App\Helper\UsersTypes::Sound)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                            <div class="details">
                                                                <span>جودة:</span>
                                                                <span>{{($users->where('role',\App\Helper\UsersTypes::quality)->first())?$users->where('role',\App\Helper\UsersTypes::quality)->first()->name:"لا يوجد"}}</span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button"
                                                                    class="btn btn-default"
                                                                    data-dismiss="modal">غلق
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            {{-- end of modal--}}
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
