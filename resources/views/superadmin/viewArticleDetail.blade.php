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
                                        <span style="font-size: 22px;font-weight: bold"> {{$list->list}}</span>
                                        <span style="color: blue;font-size: 20px"> {{$list->grade->name}}</span>
                                        <span style="color: darkblue;font-size: 16px;font-weight: bold"> {{\App\Helper\ArticleLevels::getLevel($article->level)}}</span>

                                    </h5>
                                    <a class="btn btn-success" href="{{\Illuminate\Support\Facades\URL::previous()}}"
                                       style="float: left "><span
                                                class="fa fa-arrow-circle-left"> رجوع </span></a>
                                </div>
                                <div class="card-header">
                                    <v style="right: 0;background-color: #1aa62a;position: absolute;
                                    left: -25px;top: 3;width: 4px;height: 20px;">
                                    </v>
                                    <h6 style="font-size: 20px">المقال
                                        @if($sound)
                                            <audio controls style="float: left;">
                                                <source src="{{url('/').'/'.$sound->path}}" type="audio/ogg">
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
                                    @if($questions->count()>0)
                                        @foreach($questions as $question)
                                            <div class="card-header" id="Issues">
                                                <v style="right: 0;background-color: #1b4b72;position: absolute;
                                        left: -25px;top: 3;width: 4px;height: 20px;">
                                                </v>
                                                <h6 style="font-size: 20px">السؤال رقم {{$question->id}}
                                                </h6>

                                                <div class="table-responsive" style="display: inline-block">
                                                    <table
                                                            class="display table nowrap table-striped table-hover"
                                                            style="width:100%;float: right">
                                                        <thead>
                                                        <tr>
                                                            <th width="50%">/ </th>
                                                            <th width="50%">القيمة</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>
                                                                 السؤال
                                                            </td>
                                                            <td>
                                                                {{$question->question}}
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
@endsection