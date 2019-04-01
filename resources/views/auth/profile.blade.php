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
                <a href="" class="profile-edit-btn" pd-popup-open="popupNew"> تعديل الملف الشخصي</a>
            </div>
        </div>
    </div>
    <!--table ============================================================================ -->
    <!-- [ sample-page ] start -->
    @if(auth()->user()->role != \App\Helper\UsersTypes::SUPERADMIN || auth()->user()->role != \App\Helper\UsersTypes::ADMIN)
        <div class="card" style="position: inherit;">
            <div class="card-header">
                <h5>كل الموضوعات</h5>
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
                                @if(auth()->user()->role==\App\Helper\UsersTypes::LISTMAKER)
                                    <tr>
                                    <td>{{$list->id}}</td>
                                    <td>{{$list->list}}</td>
                                    <td>{{$list->grade->name}}</td>
                                    <td>{{$list->created_at->toDateString() }}</td>
                                    @else
                                            @if ($list->lists==null)
                                                @continue
                                            @endif
                                        <tr>
                                <td>{{$list->lists->id}}</td>
                                <td>{{$list->lists->list}}</td>
                                <td>{{$list->lists->grade->name}}</td>
                                <td>{{$list->created_at->toDateString() }}</td>
                                    @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
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
{{-- modal --}}
<div class="popup" pd-popup="popupNew">
    <div class="popup-inner">
        {{-- header --}}
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">تعديل الملف الشخصي</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" pd-popup-close="popupNew">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        {{-- end of header --}}
        {{-- modal body --}}
        <div class="row edit" style="margin-right: auto !important;margin-left: auto !important;">
            <div class="container">
                <div class="profile-img">
                    <img id="avatar" class="av" src="{{asset('public/images/user/'.$user->img.'.jpg')}}" alt=""/>
                    {{--  --}}
                    <div class="row" id="foo">
                        <div id="btnclicked1" style="display:none;"><img id="av1"
                                                                         src="{{asset('public/images/user/1.jpg')}}"
                                                                         alt="Image" class="img-responsive"></div>
                        <div id="btnclicked2" style="display:none;"><img id="av2"
                                                                         src="{{asset('public/images/user/2.jpg')}}"
                                                                         alt="Image" class="img-responsive"></div>
                        <div id="btnclicked3" style="display:none;"><img id="av3"
                                                                         src="{{asset('public/images/user/3.jpg')}}"
                                                                         alt="Image" class="img-responsive"></div>
                        <div id="btnclicked4" style="display:none;"><img id="av4"
                                                                         src="{{asset('public/images/user/4.jpg')}}"
                                                                         alt="Image" class="img-responsive"></div>
                        <div id="btnclicked5" style="display:none;"><img id="av5"
                                                                         src="{{asset('public/images/user/5.jpg')}}"
                                                                         alt="Image" class="img-responsive"></div>
                    </div>

                    {{--  --}}
                    <div class="">
                        <button id="updateImage" class="btn btn-primary" type="button">تعديل الصورة</button>
                    </div>
                </div>
                <!-- edit form column -->
                <div class=" personal-info">
                    <form action="{{url('profile')}}/{{$user->id}}" method="post" class="form-horizontal" role="form">
                        {{ method_field('POST') }}
                        {{csrf_field()}}
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label style="display: flex" for="exampleInputFirstName"> الاسم</label>
                                <input id="img" name="img" type="hidden">
                                <input type="text" class="form-control" name="name" value="{{$user->name}}"
                                       id="exampleInputFirstName" aria-describedby="emailHelp">
                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>

                            <div class="form-group col-md-6">
                                <label style="display: flex" for="exampleInputEmail1">البريد الإلكتروني</label>
                                <input type="email" class="form-control" name="email" value="{{$user->email}}"
                                       id="exampleInputEmail1" aria-describedby="emailHelp" disabled>
                                {{-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label style="display: flex" for="exampleInputPassword1">كلمة السر</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                            </div>
                            <div class="form-group col-md-6">
                                <label style="display: flex" for="exampleInputConfirmPassword1">تأكيد كلمة السر </label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       id="exampleInputConfirmPassword1">
                            </div>
                        </div>
                        {{-- <button type="submit" class="btn btn-primary">حفظ</button>
                        <button pd-popup-close="popupNew" href="#" class="btn btn-danger">إلغاء</button> --}}
                        <div class="modal-footer">
                            <button class="btn btn-primary" type="submit"><span class="fa fa-edit"></span> حفظ
                                التعديل
                            </button>
                            <button aria-label="Close" type="button" class="btn btn-secondary" data-dismiss="modal"
                                    pd-popup-close="popupNew">غلق
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $('#updateImage').on('click', function () {
                    $('[id^="avatar"]').fadeOut(1);
                    $('[id^="btnclicked1"]').hide();
                    $('[id^="btnclicked2"]').hide();
                    $('[id^="btnclicked3"]').hide();
                    $('[id^="btnclicked4"]').hide();
                    $('[id^="btnclicked5"]').hide();
                    $('[id^="btnclicked"]').fadeIn(1000);
                });
                $('[id^="btnclicked"]').on('click', function () {
                    var
                        id = this.id,
                        num = id.charAt(id.length - 1)
                    ;
                    $('[id^="btnclicked"]').fadeOut(1);
                    $('#btnclicked' + num).fadeIn(1000).addClass('center');
                    document.getElementById("img").setAttribute("value", num);
                });
                $('[id^="avatar"]').fadeIn(1000);
            })
        </script>
        {{-- end modal body --}}
        {{-- footer --}}
        {{-- end of footer --}}
    </div>
</div>
{{-- end of modal --}}
<!-- =======================================================================-->
{{--  Script --}}
<script>
    $(function () {
        //----- OPEN Modal
        $('[pd-popup-open]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-open');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeIn(100);
            e.preventDefault();
        });
        //----- CLOSE Modal
        $('[pd-popup-close]').on('click', function (e) {
            var targeted_popup_class = jQuery(this).attr('pd-popup-close');
            $('[pd-popup="' + targeted_popup_class + '"]').fadeOut(200);

            e.preventDefault();
        });
    });
</script>
{{-- End Of Modal Script --}}

{{-- =========================================== --}}
@section('js')
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
            integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
            crossorigin="anonymous"></script>
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>
@endsection
@endsection