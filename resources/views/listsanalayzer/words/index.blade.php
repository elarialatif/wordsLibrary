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
                                        كل الكلمات
                                    </h5>
                                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">اضافه كلمات
                                        جديدة<i class="fa fa-plus"></i></a>
                                    {{--model for add new user--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true" >
                                        <div class="modal-dialog" role="document">

                                            <form action="{{url('createWords')}}" method="post">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">اضافه كلمات
                                                            جديدة</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">


                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label> الصف :</label>
                                                                    <select class="form-control" id="grade" name="grade_id">
                                                                        <option>اختر الصف</option>
                                                                        @foreach($grades as $grade)
                                                                            <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label> الكلمة :</label>
                                                                    <input type="text" class="form-control" name="word[0]" />
                                                                </div>
                                                                <button  id="btn" type="button" class="btn btn-icon btn-outline-primary"><i class="feather icon-plus-square"></i></button>

                                                            </div>

                                                        </div>

                                                        <div id="ST0">
                                                        </div>



                                                    </div>
                                                    <div class="modal-footer">
                                                        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span> إضافة
                                                            الكلمة
                                                        </button>
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">غلق
                                                        </button>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--end modal--}}
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
                                                    <th>الكلمة</th>
                                                    <th>المستوى</th>

                                                    <th>الصف</th>

                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($words as $word)
                                                    <tr>
                                                        <td>{{$word->word}}</td>
                                                        <td>@if($word->level==\App\Helper\ArticleLevels::Easy)
                                                                سهله
                                                                @else
                                                                صعبه
                                                        @endif
                                                        </td>

                                                        <td>{{$word->grade->name}}</td>
                                                        <?php
                                                        $grade=\App\Repository\GradesRepository::find($word->grade_id);
                                                        ?>

                                                    </tr>
                                                @endforeach
                                                </tbody>
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


        $('#level').change(function() {
            var levelID = $(this).val();
            if (levelID) {
                $.ajax({
                    type: "GET",
                    url: "{{url('getGradeList')}}/" + levelID,
                    success: function (res) {
                        if (res) {
                            $("#grade").empty();
                            $("#grade").append('<option >اختر الصف</option>');
                            $.each(res,function (key,value) {
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

        var count = 0;
        $("#btn").click(function () {
            count++;
            $("<div class='modal-footer' id='ST"+count+"'>" +
                "<input type = 'hidden' name = 'user_id' value = '{{auth()->id()}}' >" +
                "<input type = 'text' class = 'form-control' id= 'word[" + count + "]' placeholder = 'الكلمه' name = 'word[" + count + "]' >" +
                "<button class='btn btn-icon btn-outline-danger' id=\"btn[" + count + "]\" onclick='remove("+count+")'> <i class=\"feather icon-minus-square\"></i></button>" +
                "</div>").insertBefore("#ST0");
        });
        function remove(count) {
            $('#ST'+count).remove();
        }

        $(document).ready(function() {
            setTimeout(function() {
                $(" <div class=\"row\">" +
                    "<div class=\"col-md-6\">" +
                    "<div class=\"form-group\">" +
                    "<select class=\"form-control\" name=\"grade_id\" id=\"grade_id\" onchange='change()'>>" +
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
            window.location = '{{url('wordsFilter')}}/' + test;
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
