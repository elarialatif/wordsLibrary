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
                                    صفحة الموضوعات
                                </h5>
                                @if(auth()->user()->role!=\App\Helper\UsersTypes::EDITOR)
                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                   data-target="#exampleModal0"
                                   style="color: white;float: left;font-weight: bold"> اضافه موضوع جديد <i
                                            class="fa fa-plus"></i></a>
                                {{--model--}}
                                <div class="modal fade" id="exampleModal0"
                                     tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog " role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h6 class="modal-title" id="exampleModalLabel">اضافة موضوع</h6>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{url('createList')}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            الصف:<br>
                                                            <div class="form-group">
                                                                <select class="form-control" name="grade_id" id="grade">
                                                                    @foreach($grades as $grade)
                                                                    <option value="{{$grade->id}}">{{$grade->name}}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="hidden" name="user_id"
                                                                       value="{{auth()->id()}}">
                                                                <label> اسم الموضوع :</label>
                                                                <input  type="text"
                                                                       class="form-control" name="list[0]"
                                                                       placeholder="اسم الموضوع">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="empty">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">
                                                        غلق
                                                    </button>
                                                    <button class="btn btn-primary" type="submit"><span
                                                                class="fa fa-plus"></span> إضافة
                                                    </button>

                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{--end modal--}}
                                @endif
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>الموضوع</th>
                                            <th>الصف</th>
                                            <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($lists as $list)
                                        @php $article=\App\Models\ArticleFiles::where('list_id',$list->id)->first();
                                        $task=\App\Models\AssignTask::where('list_id',$list->id)->first(); @endphp
                                        @if($task && auth()->user()->role==\App\Helper\UsersTypes::EDITOR)
                                        @continue
                                        @endif
                                        <tr>
                                            <td width="50%">{{$list->list}}</td>
                                            <td width="50%">{{$list->grade->name}}</td>

                                            <td>
                                                @if(auth()->user()->role!=\App\Helper\UsersTypes::EDITOR)
                                                <a href="{{url('editList/')}}/{{$list->id}}"
                                                   class="btn btn-icon btn-outline-info radbor"><i
                                                            class="fa fa-edit"></i></a>
                                                <a href="{{url('deleteList/')}}/{{$list->id}}"
                                                   class="btn btn-icon btn-outline-danger radbor"><i
                                                            class="fa fa-trash"></i></a>
                                                @endif
                                                @if(auth()->user()->role==\App\Helper\UsersTypes::EDITOR &&!$task)
                                                <a href="{{url('saveUploadArticle/')}}/{{$list->id}}"
                                                   class="btn btn-icon btn-rounded btn-outline-secondary"><i
                                                            class="feather icon-upload"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
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
<script type="text/javascript">
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
    $(document).ready(function () {
        setTimeout(function () {
            $(" <div class=\"row\">" +
                "<div class=\"col-md-6\">" +
                "<div class=\"form-group\">" +
                "<select class=\"form-control\" name=\"grade_id\" id=\"grade_id\" onchange='change()'> " +
                "<option value=\"\">----</option>" +
                "<option value=\"all\">الكل</option>" +
                "@foreach($grades as $grade)" +
                "<option value=\"{{$grade->id}}\">{{$grade->name}}</option>" +
                "@endforeach" +
                "</select>" +
                "</div>" +
                "</div>" +
                "</div>"
            ).insertAfter(".dataTables_filter");
        }, 1000);
    });

    function change() {
        var test = $('#grade_id').find(":selected").val();
        window.location = '{{url('
        showLists
        ')}}/' + test;
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