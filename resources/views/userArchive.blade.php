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
                                                        <th>الموضوع</th>
                                                        <th>الصف</th>
                                                        <th>سهل</th>
                                                        <th>متوسط</th>
                                                        <th>صعب</th>
                                                        <th>الحالة</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($list as $list)
                                                        @php
                                                                  $easy=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy);
                                                                  $normal=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal);
                                                                   $hard=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard);
                                                        @endphp
                                                        <tr>
                                                            <td>{{$list->id}}</td>
                                                            <td>{{$list->list}}</td>
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
                    "<div class=\"col-md-4\">" +
                    "<div class=\"form-group\">" +
                    "<select class=\"form-control\" name=\"grade_id\"  id=\"grade_id\" onchange='change()'>" +
                    "<option value=\"\">الصفوف</option>" +
                    "<option value=\"all\">الكل</option>" +
                    "@foreach($grades as $grade)" +
                    "<option value=\"{{$grade->id}}\">{{$grade->name}}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</div>" +
                    "</div>" +
                    "<div class=\"col-md-6\">" +
                    "<div class=\"form-group\">" +
                    "<select placeholder=\"المرحله\" onchange=\"myFunction()\" id=\"stepFilter\" class=\"form-control\" name=\"step_filter\" onchange='change()'> " +
                    "<option value=\"\">------</option>" +
                    "<option value=\"\">كل المراحل</option>" +
                    "@foreach(\App\Helper\Steps::ArrayOfSteps as $key=>$value)" +
                    "<option value=\"{{$value}}\">{{$value}}</option>" +
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
    <script>
        function myFunction() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("stepFilter");
            filter = input.value.toUpperCase();

            $('#key-act-button').attr('id', 'key-act-button3');
            table = $('#key-act-button3').DataTable();
            table.destroy();
            $('#key-act-button3').DataTable({
                dom: 'Bfrtip',
                paginate: false,
                buttons: [
                    'copyHtml5',
                    'excelHtml5',
                    'print'
                ]
            });
            // Declare variables
            $(" <div class=\"row\">" +
                "<div class=\"col-md-4\">" +
                "<div class=\"form-group\">" +
                "<select class=\"form-control\" name=\"grade_id\"  id=\"grade_id\" onchange='change()'>" +
                "<option value=\"\">الصفوف</option>" +
                "<option value=\"all\">الكل</option>" +
                "@foreach($grades as $grade)" +
                "<option value=\"{{$grade->id}}\">{{$grade->name}}</option>" +
                "@endforeach" +
                "</select>" +
                "</div>" +
                "</div>" +
                "<div class=\"col-md-6\">" +
                "<div class=\"form-group\">" +
                "<select placeholder=\"المرحله\" onchange=\"myFunction()\" id=\"stepFilter\" class=\"form-control\" name=\"step_filter\" onchange='change()'> " +
                "<option value=\"\">-------</option>" +
                "<option value=\"\">كل المراحل</option>" +
                "@foreach(\App\Helper\Steps::ArrayOfSteps as $key=>$value)" +
                "<option value=\"{{$value}}\">{{$value}}</option>" +
                "@endforeach" +
                "</select>" +
                "</div>" +
                "</div>" +
                "</div>").insertAfter(".dataTables_filter");
            var dataTable = $('#key-act-button3').dataTable();
            tr = dataTable.fnGetNodes();

            // Loop through all table rows, and hide those who don't match the search query
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[7];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }

            if (input.value.length == 0) {

                $('#key-act-button3').attr('id', 'key-act-button');
                table = $('#key-act-button').DataTable();
                table.destroy();
                $('#key-act-button').DataTable({
                    dom: 'Bfrtip',
                    paginate: true,
                    displayLength: 50,
                    buttons: [
                        'copyHtml5',
                        'excelHtml5',
                        'print'
                    ]
                });
                $(" <div class=\"row\">" +
                    "<div class=\"col-md-4\">" +
                    "<div class=\"form-group\">" +
                    "<select class=\"form-control\" name=\"grade_id\"  id=\"grade_id\" onchange='change()'>" +
                    "<option value=\"\">الصفوف</option>" +
                    "<option value=\"all\">الكل</option>" +
                    "@foreach($grades as $grade)" +
                    "<option value=\"{{$grade->id}}\">{{$grade->name}}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</div>" +
                    "</div>" +
                    "<div class=\"col-md-6\">" +
                    "<div class=\"form-group\">" +
                    "<select placeholder=\"المرحله\" onchange=\"myFunction()\" id=\"stepFilter\" class=\"form-control\" name=\"step_filter\" onchange='change()'> " +
                    "<option value=\"\">---------</option>" +
                    "<option value=\"\">كل المراحل</option>" +
                    "@foreach(\App\Helper\Steps::ArrayOfSteps as $key=>$value)" +
                    "<option value=\"{{$value}}\">{{$value}}</option>" +
                    "@endforeach" +
                    "</select>" +
                    "</div>" +
                    "</div>" +
                    "</div>").insertAfter(".dataTables_filter");
            }
        }
    </script>


@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">
@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>


@endsection

@endsection
