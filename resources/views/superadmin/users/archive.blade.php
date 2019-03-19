@extends('layouts.app')
@section('content')
@section ('css')
    <link href="{{ asset('public/css/layouts/profile.css') }}" rel="stylesheet">
    {{--<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">--}}
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">
@endsection
{{-- ============================================================================ --}}
<div class="container emp-profile">
    {{-- ================================================================================= --}}
    <div class="row">
        <div class="content">
            <div class="profile-img">
                <img id="output" src="{{asset('public/images/user/'.$user->img.'.jpg')}}" alt=""/>
                <div class="details">
                    <h3>{{$user->name}} </h3>
                    <h4>{{$user->email}}</h4>
                    <h4>{{\App\Helper\UsersTypes::ArrayOfPermission[$user->role]}}</h4>
                </div>
            </div>
        </div>
    </div>
    <!--table ============================================================================ -->
    <!-- [ sample-page ] start -->
    <div class="card" style="position: inherit;">
        <div class="card-header">
            <h5>كل المواضيع</h5>
        </div>
        <div class="card-block">
            <div class="table-responsive">

                <table id="key-act-button" class="display table nowrap table-striped table-hover">
                    <thead>
                    <tr>
                        <th>الكود</th>
                        <th>الموضوع</th>
                        <th>الصف</th>
                        <th>التاريخ</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($tasks as $list)
                      @if($list->lists==null)
                          @continue
                          @endif
                        <tr>
                            <td>{{$list->lists->id}}</td>
                            <td>{{$list->lists->list}}</td>
                            <td>{{$list->lists->grade->name}}</td>
                            <td>{{$list->created_at->toDateString() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
                "<input type=\"date\" class=\"form-control\" name=\"date\"  id=\"date\">" +
                "</div>" +
                "</div>" +
                "<div class=\"col-md-4\">" +
                "<div class=\"form-group\">" +
                "<select class=\"form-control\" name=\"grade_id\"  id=\"grade_id\">" +
                "<option value=\"\">----</option>" +
                "<option value=\"all\">الكل</option>" +
                "" +
                <?php foreach (\App\Repository\GradesRepository::all() as $grade){ ?>
                    "<option value=\"<?php echo $grade->id;?>\"><?php echo $grade->name?></option>" +
                "" +
                <?php } ?>
                    "</select>" +
                "</div>" +
                "</div>" +
                "<div class=\"col-md-2\">" +
                "<div class=\"form-group\">" +
                "<input type=\"submit\" class=\"btn btn-primary\" id=\"search\" value=\"بحث\" onclick='change()'>" +
                "</div>" +
                "</div>" +
                "</div>").insertAfter(".dataTables_filter");
        }, 1000);
    });

    function change() {
        var test = $('#grade_id').find(":selected").val();
        if (test == '') {
            test = 'null';
        }
        var test2 = $('#date').val();
        if (test2 == '') {
            test2 = 'null';
        }
        window.location = '{{url('profileFilter')}}/' + test + '/' + test2;
    }
</script>
{{--end of table ====================================================================================== --}}
<!-- =======================================================================-->
{{-- =========================================== --}}
@section('js')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>
@endsection
@endsection