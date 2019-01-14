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
                                        كل المواضيع
                                    </h5>

                                </div>

                                <div class="card-block">
                                    <div class="card-header">
                                        <div class="form-group">
                                            <div class="table-responsive">
                                                <table id="key-act-button"
                                                       class="display table nowrap table-striped table-hover"
                                                       style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>الكود</th>
                                                        {{--<th>الملف</th>--}}
                                                        <th>الموضوع</th>

                                                        <th>الصف</th>
                                                        <th>سهل</th>
                                                        <th>متوسط</th>
                                                        <th>صعب</th>
                                                        <th>عرض</th>
                                                        <th>الحالة</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($allFiles as $file)

                                                        @php
                                                            $AssignTsaks=\App\Models\AssignTask::where('list_id',$file->list_id)->get()->pluck('user_id')->toArray();
                                                            $users=\App\User::whereIn('id',$AssignTsaks)->get();
                                                               $list=\App\Models\ContentList::with('level','grade','user')->where('id',$file->list_id)->first();
                                                                 $grade=\App\Models\Grade::with('level')->where('id',$list->grade->id)->first();
                                                                  $easy=App\Repository\ArticalRepository::getArticleByLevel($file->list_id,\App\Helper\ArticleLevels::Easy);
                                                                  $normal=App\Repository\ArticalRepository::getArticleByLevel($file->list_id,\App\Helper\ArticleLevels::Normal);
                                                                   $hard=App\Repository\ArticalRepository::getArticleByLevel($file->list_id,\App\Helper\ArticleLevels::Hard);
                                                        @endphp
                                                        <tr data-toggle="modal"
                                                            data-target="#myModal{{$file->list_id}}">
                                                            <!-- Modal -->
                                                            <div id="myModal{{$file->list_id}}" class="modal fade"
                                                                 role="dialog">
                                                                <div class="modal-dialog">

                                                                    <!-- Modal content-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal">&times;
                                                                            </button>
                                                                            <h4 class="modal-title">قائمة
                                                                                المستخدمين</h4>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <h4>
                                                                                معد مواضيع: {{$list->user->name}}
                                                                                <br>
                                                                                محرر: {{($users->where('role',\App\Helper\UsersTypes::EDITOR)->first())?$users->where('role',\App\Helper\UsersTypes::EDITOR)->first()->name:"لا يوجد"}}

                                                                                <br>
                                                                                محلل
                                                                                مواضيع: {{($users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first())?$users->where('role',\App\Helper\UsersTypes::LISTANALYZER)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                مراجع:{{($users->where('role',\App\Helper\UsersTypes::REVIEWER)->first())?$users->where('role',\App\Helper\UsersTypes::REVIEWER)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                مدخل
                                                                                اسئلة:{{($users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionCreator)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                مراجع
                                                                                اسئلة:{{($users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first())?$users->where('role',\App\Helper\UsersTypes::QuestionReviewer)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                مراجع
                                                                                لغوى:{{($users->where('role',\App\Helper\UsersTypes::Languestic)->first())?$users->where('role',\App\Helper\UsersTypes::Languestic)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                مدخل
                                                                                صوت:{{($users->where('role',\App\Helper\UsersTypes::Sound)->first())?$users->where('role',\App\Helper\UsersTypes::Sound)->first()->name:"لا يوجد"}}
                                                                                <br>
                                                                                جودة:{{($users->where('role',\App\Helper\UsersTypes::quality)->first())?$users->where('role',\App\Helper\UsersTypes::quality)->first()->name:"لا يوجد"}}
                                                                            </h4>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button"
                                                                                    class="btn btn-default"
                                                                                    data-dismiss="modal">Close
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                            <td>{{$list->id}}</td>
                                                            {{--<td>{{$file->articleName}}</td>--}}
                                                            <td>{{$file->lists->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            <td> @if($easy)<a
                                                                        href="{{url('viewArticle/'.$easy->id)}}"> @endif
                                                                    <span class=" fa fa-eye"></span></a></td>
                                                            <td>@if($normal)<a
                                                                        href="{{url('viewArticle/'.$normal->id)}}">@endif
                                                                    <span class=" fa fa-eye"></span></a></td>
                                                            <td>@if($hard)<a
                                                                        href="{{url('viewArticle/'.$hard->id)}}">@endif
                                                                    <span class=" fa fa-eye"></span></a></td>
                                                            <td><a href="{{url('analysisUploadFiles/'.$file->id)}}">
                                                                    <span class=" fa fa-eye"
                                                                          style="color: green"></span></a></td>
                                                            <td>{{\App\Helper\Steps::ArrayOfSteps[$list->step]}}
                                                                @if($list->step!=\App\Helper\Steps::UPLOADING_FILE)
                                                                    <h7 class="progress-bar progress-bar-success"
                                                                        role="progressbar" aria-valuenow="40"
                                                                        aria-valuemin="0" aria-valuemax="50"
                                                                        style="width:{{round(($list->step/count(\App\Helper\Steps::ArrayOfSteps))*100)}}%;background-color:#1e7e34"> {{round((($list->step)/\App\Helper\Steps::numberOFSteps)*100)}}
                                                                        %
                                                                    </h7>
                                                                @else
                                                                    <h3 style="color: #ff2733"> 0% </h3>
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>

                                            </div>
                                        </div>
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
    <script>


        $('#level').change(function () {
            var levelID = $(this).val();
            if (levelID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('getGradeList')}}/" + levelID,
                    success: function (res) {
                        if (res) {
                            $("#grade").empty();
                            $("#grade").append('<option >اختر الصف</option>');
                            $.each(res, function (key, value) {
                                $("#grade").append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        } else {
                            $("#grade").empty();
                        }
                    }
                });
            }
        });
    </script>
    <script>

        $(document).ready(function () {
            setTimeout(function () {
                $(" <div class=\"row\">" +
                    "<div class=\"col-md-6\">" +
                    "<div class=\"form-group\">" +
                    "<select class=\"form-control\" name=\"grade_id\"  id=\"grade_id\" onchange='change()'>" +
                    "<option value=\"\">----</option>" +
                    "<option value=\"all\">الكل</option>" +
                    "@foreach($grades as $grade)" +
                    "<option value=\"{{$grade->id}}\">{{$grade->name}}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</div>" +
                    "</div>" +
                    "</div>").insertAfter(".dataTables_filter");
            }, 1000);
        });

        function change() {
            var test = $('#grade_id').find(":selected").val();
            window.location = '{{url('filterFiles')}}/' + test;
        }

    </script>


@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">
@endsection
@section('js')
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>


@endsection

@endsection
