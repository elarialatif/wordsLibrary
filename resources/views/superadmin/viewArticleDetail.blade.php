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
            font-size: 20px !important;
            padding: 0 1rem;
            font-weight: bold;
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
            min-height: 100px;

        }
        .modalDetails .modal-body h5 {
            font-size: 18px;
            margin-bottom: 0;
            line-height: 4rem;
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
        .table td, .table th {
            border-top: 1px solid #eaeaea;
            white-space: nowrap;
            padding: 0.5rem;
            vertical-align: middle;
        }
        .card {
            background: #f4f7fa;
            -webkit-box-shadow: none;
            box-shadow: none;
            margin-bottom: 0;
        }
        .card .card-header {
            background-color: #fff;
        }
        .col-xl-8 {
            padding-right: 0;
        }
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            color: #04a9f5;
        }
        audio {
            display: block;
            width: 100%;
            margin: 1rem 0;
        }
        .media-body {
            display: block;
            width: 100%;
        }
        .nav-link {
            display: block;
            padding: 10px 20px;
        }
        #tinymcFont p {
            display: block;
            width: 600px;
            max-width: 600px;
        }
        .card .row.content .col-md-7,
        .card .row.content .col-md-5 {
            margin-bottom: 0rem;
        }
        .card .row.content {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border-top: 2px solid transparent;
        }
        .card .row.content div:first-child {
            padding-right: 0;
        }
        .card .card-header {
            display: block;
            width: 100%;
        }
        .card .row.content .col-xl-7 div.img {
            /* border: 12px solid #eaeaea; */
            height: 290px;
            max-height: 290px;
            padding-left: 0;
            margin-bottom: 1rem;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
        }
        .card .row.content .col-xl-7 div.img img{
            width: 100%;
            height: 100%;
        }
        .left .row{
            margin-right: 1rem;
            background: #fff;
            margin-bottom: 1rem;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
        }
        .left h3 {
            border-right: 4px solid #04a9f5;
            margin-top: 1rem;
            font-size: 20px;
            font-weight: bold;
            color: #000;
            padding-right: 1rem;
        }
        .right h3 {
            font-size: 15px;
            font-weight: bold;
        }
        .right a.active h3 {
            color: #04a9f5;
        }
        .right a h3:hover {
            color: #04a9f5;
        }
        .left div.links {
            display: block;
            width: 100%;
            padding: 0rem 0.75rem;
        }
        .left div.links a {
            display: block;
            width: 100%;
            border-bottom: 1px solid #eaeaea;
            margin-bottom: 1rem;
            color: #000;
            padding-bottom: 1rem;
        }
        .left div.links a:first-child{
            padding-top: 1rem;
            border-top: 1px solid #eaeaea;
            margin-bottom: 0;
        }
        .left div.links a:last-child {
            border-bottom: none;
        }
        .left div.links a:hover {
            color: #04a9f5;
            text-decoration: underline;
        }
        .levels div,
        .team div {
            padding-top: 1rem;
            border-top: 1px solid #eaeaea;
            display: block;
            width: 100%;
            margin: auto;
            text-align: center;
            margin-bottom: 1rem;
            padding-right: 0.75rem;
        }
        .levels div a,
        .team div a {
            display: inline-block;
            width: 30%;
            color: #fff;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            padding: 1rem;
            margin-bottom: 1rem;
        }
        .levels div a.link1{
            background: #04a9f5;
        }
        .levels div a.link2,
        .team div a {
            background: #428bca;
        }
        .levels div a.link3{
            background: #59b0f2;
        }
        .levels div a.link1:hover{
            color: #04a9f5;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
        }
        .levels div a.link2:hover,
        .team div a:hover {
            color: #428bca !important;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
        }
        .levels div a.link3:hover{
            color: #59b0f2;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.5);
        }
        .table-striped {
            border: 1px solid #eaeaea;
            background: #fff;
            -webkit-box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.05);
        }
        .table-striped tbody tr:nth-of-type(2n+1) {
            background-color: rgba(4, 169, 245, 0.05);
        }
        .table-striped tr td:first-child,
        .table-striped thead th:first-child {
            border-left: 1px solid #eaeaea;
        }
        .table-striped thead th h3{
            margin-top: 1rem;
            font-size: 22px;
            font-weight: bold;
            color: #04a9f5;
            padding-right: 1rem;
        }
        .table-striped td {
            font-size: 18px;
        }
        table.display.table-striped {
            -webkit-box-shadow: none;
            box-shadow: none;
            border: 0;
        }
        table.display.table-striped  td{
            font-size: 15px;
        }
        .table-striped td span {
            color: #fff;
            text-align: center;
            padding: 1rem;
            background: #428bca;
            border-radius: 0;
        }
        .table-striped thead tr{
            border-top: 2px solid transparent;
        }
        table.display.table-striped thead tr {
            border-top: none;
        }
        table.display.table-striped tr td:first-child {
            border-left: 0;
        }
        table.display.table-striped tbody tr td:first-child {
            width: 30%;
            font-size: 17px;
            font-weight: bold;
        }
        table.display.table-striped tbody tr td {
            padding: 12px;
        }
        .card-header h4 img {
            text-align: center;
            width: 190px;
            max-width: 190px;
            height: 150px;
            max-height: 150px;
            margin-left: 0.5rem;
        }
        .card-header div:last-child {}
        .media-body h6 img {
            display: block;
            width: 100%;
            margin-top: 1rem;
            height: 300px;
        }
    </style>
    <!-- ####################################################### -->
    <div class="container">
        <!-- Row 1 -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="row">
                        <div class="card-header">
                            <h4>
                                <img src="{{url('public/'.$list->image)}}" alt="">
                                <span style="font-size: 22px;font-weight: bold"> {{$list->list}}</span>
                                <span style="color: #04a9f5;font-size: 20px; padding: 0 0.2rem;"> {{$list->grade->name}}</span>
                                <span style="color: darkblue;font-size: 16px;font-weight: bold"> {{\App\Helper\ArticleLevels::getLevel($article->level)}}</span>
                                <a class="btn btn-primary" @if(auth()->user()->role==\App\Helper\UsersTypes::SUPERADMIN || auth()->user()->role==\App\Helper\UsersTypes::ADMIN) href="{{url('allFiles')}}" @else href="{{url('userArchive')}}" @endif
                                   style="float: left "><span class="fa fa-arrow-circle-left">
                                    رجوع
                                </span>
                                </a>
                            </h4>
                        </div>
                    </div>
                    <div class="container"></div>
                    <div class="row content">
                        <!-- Tabs -->
                        <div class="col-xl-7 col-md-7 m-b-30 right">
                            <!-- Image Lesson -->
                            <div class="col-sm-12 img">
                                <img src="{{url('public/'.$list->featureImage)}}" alt="">
                            </div>
                            <!-- #Image Lesson -->
                            <ul class="nav nav-tabs" id="myTab1" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link  active show" id="user-tab" data-toggle="tab" href="#5a" role="tab" aria-selected="false">
                                        <h3>السؤال القبلي</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="user-tab" data-toggle="tab" href="#1a" role="tab" aria-selected="false">
                                        <h3>المقال</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="designer-tab" data-toggle="tab" href="#2a" role="tab" aria-selected="false">
                                        <h3>الأنشطة</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="user-tab" data-toggle="tab" href="#6a" role="tab" aria-selected="false">
                                        <h3>السؤال البعدي</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Developer-tab" data-toggle="tab" href="#3a" role="tab" aria-selected="true">
                                        <h3>المقال الموسع</h3>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="Developer-tab" data-toggle="tab" href="#4a" role="tab" aria-selected="true">
                                        <h3>الأنشطة الموسعة</h3>
                                    </a>
                                </li>
                            </ul>
                            <div class="tab-content User-Lists" id="myTabContent1">
                                <div class="tab-pane fade active show" id="5a" role="tabpanel">
                                    <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                        <div class="media-body">
                                            <h6 style="font-size: 20px">المقال
                                                @if($sound)
                                                    <audio controls>
                                                        <source src="{{url('/').'/'.$sound->path}}"
                                                                type="audio/ogg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                            </h6>
                                            <div id="tinymcFont">  {!! $article->article !!} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="1a" role="tabpanel">
                                    <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                        <div class="media-body">
                                            <h6 style="font-size: 20px">المقال
                                                @if($sound)
                                                    <audio controls>
                                                        <source src="{{url('/').'/'.$sound->path}}"
                                                                type="audio/ogg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                            </h6>
                                            <div id="tinymcFont">  {!! $article->article !!} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="2a" role="tabpanel">
                                    @if($questions->count()>0)
                                        <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                            <div class="media-body">
                                                <h6 class="m-0 d-inline" style="font-size: 18px">
                                                    الأسئلة الأساسية
                                                </h6>
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
                                                                        الإجابة الأولى
                                                                    </td>
                                                                    <td>{{$question->ans1}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثانية
                                                                    </td>
                                                                    <td>{{$question->ans2}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثالثة
                                                                    </td>
                                                                    <td>{{$question->ans3}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الرابعة
                                                                    </td>
                                                                    <td>{{$question->ans4}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الصحيحة
                                                                        @php $true=$question->true_answer; @endphp
                                                                    </td>
                                                                    <td>{{$question->$true}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="6a" role="tabpanel">
                                    @if($questions->count()>0)
                                        <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                            <div class="media-body">
                                                <h6 class="m-0 d-inline" style="font-size: 18px">
                                                    الأسئلة الأساسية
                                                </h6>
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
                                                                        الإجابة الأولى
                                                                    </td>
                                                                    <td>{{$question->ans1}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثانية
                                                                    </td>
                                                                    <td>{{$question->ans2}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثالثة
                                                                    </td>
                                                                    <td>{{$question->ans3}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الرابعة
                                                                    </td>
                                                                    <td>{{$question->ans4}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الصحيحة
                                                                        @php $true=$question->true_answer; @endphp
                                                                    </td>
                                                                    <td>{{$question->$true}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="tab-pane fade" id="3a" role="tabpanel">
                                    <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                        <div class="media-body">
                                            <h6  style="font-size: 20px">المقال الموسع
                                                @if($soundStretch)
                                                    <audio controls >
                                                        <source src="{{url('/').'/'.$soundStretch->path}}"
                                                                type="audio/ogg">
                                                        Your browser does not support the audio element.
                                                    </audio>
                                                @endif
                                            </h6>
                                            <div id="tinymcFont"> {!! $article->stretchArticle !!} </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="4a" role="tabpanel">
                                    @if($questionStretch->count()>0)
                                        <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                            <div class="media-body">
                                                <h6 class="m-0 d-inline" style="font-size: 18px">
                                                    الأسئلة الإضافية
                                                </h6>
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
                                                                        الإجابة الأولى
                                                                    </td>
                                                                    <td>{{$question->ans1}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثانية
                                                                    </td>
                                                                    <td>{{$question->ans2}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الثالثة
                                                                    </td>
                                                                    <td>{{$question->ans3}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الرابعة
                                                                    </td>
                                                                    <td>{{$question->ans4}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        الإجابة الصحيحة
                                                                        @php $true=$question->true_answer; @endphp
                                                                    </td>
                                                                    <td>{{$question->$true}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- #Tabs -->
                        <!-- /////////////////////////////////// -->
                        <!-- #Left Tabs -->
                        <div class="col-xl-5 col-md-5 m-b-30 left">
                            <div class="row">
                                <h3>المرادفات</h3>
                                <div class="table-responsive" style="display: inline-block">
                                    <table class="display table nowrap table-striped table-hover"
                                           style="width:100%;float: left">

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
                            </div>
                            <div class="row">
                                <h3>الروابط الإثرائية</h3>
                                <div class="links">
                                    @foreach($links as $word)
                                        <a href="{{$word->link}}">{{$word->name}}</a>
                                    @endforeach
                                </div>
                            </div>
                            @if(auth()->user()->role==\App\Helper\UsersTypes::SUPERADMIN || auth()->user()->role==\App\Helper\UsersTypes::ADMIN)
                            <div class="row levels">
                                <h3>المراحل</h3>
                                <div>
                                    <a class="link1" data-toggle="modal" data-target="#levelsModal1" href="">
                                        إلى محلل المقالات
                                    </a>
                                    <a class="link2" data-toggle="modal" data-target="#levelsModal2" href="">
                                        إلى المحرر
                                    </a>
                                    <a class="link3" data-toggle="modal" data-target="#levelsModal3" href="">
                                        إلى مراجع المقالات
                                    </a>
                                    <a class="link3" data-toggle="modal" data-target="#levelsModal4" href="">
                                        إلى مدخل الأسئلة
                                    </a>
                                    <a class="link1" data-toggle="modal" data-target="#levelsModal5" href="">إلى
                                        مراجع الأسئلة
                                    </a>
                                    <a class="link2" data-toggle="modal" data-target="#levelsModal6" href="">إلى
                                        المراجع اللغوى
                                    </a>
                                    <a class="link2" data-toggle="modal" data-target="#levelsModal7" href="">
                                        إلى الصوت
                                    </a>
                                    <a class="link3" data-toggle="modal" data-target="#levelsModal8" href="">
                                        إلى الجودة
                                    </a>
                                    <a class="link1" data-toggle="modal" data-target="#levelsModal9" href="">
                                        نشر
                                    </a>
                                </div>
                            </div>
                            <!-- Levels Modal -->
                            <div id="levelsModal1" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" >
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي محلل المقالات؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::ANALYZING_FILE.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal2" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي المحرر؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::INSERTING_ARTICLE.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal3" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي مراجع المقالات؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::REVIEW_ARTICLE.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal4" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي مدخل الأسئلة؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Create_Question.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal5" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي مراجع الأسئلة؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Review_Question.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal6" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي المراجع اللغوي؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Languestic.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal7" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي الصوت؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Sound.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal8" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد الذهاب الي الجودة؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Quality.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="levelsModal9" class="modalDetails modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">
                                                تأكيد الذهاب
                                            </h4>
                                            <button type="button" class="close" data-dismiss="modal">
                                                &times;
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h5>هل تريد النشر؟</h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" onclick="location.href='{{url('adminChangeStepOfList/'.\App\Helper\Steps::Publish.'/'.$list->id)}}'" type="button">
                                                موافق
                                            </button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                                غلق
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- #Levels Modal -->

                            <div class="row team">
                                <h3>فريق العمل</h3>
                                <div>
                                    <a class="btn btn-primary m-t-5" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="true" aria-controls="collapseExample">المعدين</a>
                                </div>
                                <!-- Collapse -->
                                <div class="collapse" id="collapseExample" style="border: 0;">
                                    <div class="card-body" style="border: 0; padding:0;">
                                        <div class="table-responsive" style="display: inline-block; border:0;">
                                            <table class="display table nowrap table-striped table-hover"
                                                   style="width:100%;float: left">
                                                <tbody>
                                                <tr>
                                                    <td>معد موضوعات:</td>
                                                    <td>{{$list->user->name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>محرر:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::EDITOR)->first())?$users->where('role',\App\Helper\UsersTypes::EDITOR)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>محلل موضوعات:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first())?$users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>مراجع:</td>
                                                    <td> {{($users->where('role',\App\Helper\UsersTypes::REVIEWER)->first())?$users->where('role',\App\Helper\UsersTypes::REVIEWER)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td> مدخل أسئلة:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>مراجع أسئلة:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>مراجع لغوى:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::Languestic)->first())?$users->where('role',\App\Helper\UsersTypes::Languestic)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>مدخل صوت:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::Sound)->first())?$users->where('role',\App\Helper\UsersTypes::Sound)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                <tr>
                                                    <td>جودة:</td>
                                                    <td>{{($users->where('role',\App\Helper\UsersTypes::quality)->first())?$users->where('role',\App\Helper\UsersTypes::quality)->first()->name:"لا يوجد"}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                {{-- #Collapse--}}
                            </div>
                                @endif
                        </div>
                        <!-- #Left Tabs -->
                        <!-- /////////////////////////////////// -->
                    </div>
                </div>
            </div>
        </div>
        <!-- #Row 1 -->
        <!-- ####################################################### -->
        <!-- Row 2 -->
        @if(auth()->user()->role==\App\Helper\UsersTypes::SUPERADMIN || auth()->user()->role==\App\Helper\UsersTypes::ADMIN)
        <div class="row">
            <table class="table table-striped" id="Table">
                <thead>
                <th>
                    <h3 style="text-align: center;">الحدث</h3>
                </th>
                <th style="width: 15%">
                    <h3>
                        التاريخ
                    </h3>
                </th>
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
                            <span class="badge badge-warning pull-left">  {{$logtimes[$i]['created_at']}} </span>
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>
        @endif
        <!-- #Row 2 -->
    </div>
    <!-- ####################################################### -->

@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection
