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
                                        اضافة كلمات
                                    </h5>
                                </div>
                                <div class="card-header">
                                    <div class="form-group">
                                        <select id="inputNum" class="form-control">
                                            <option value="1">1</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="50">50</option>
                                        </select>
                                        <br>
                                        <button id="btn" class=" btn btn-primary"> اضافه حقول للكلمات</button>
                                    </div>
                                </div>
                                <div class="card-block">
                                    <div class="card-header">
                                        <div class="form-group">
                                            <form action="{{url('createWords')}}" method="post">
                                                {{csrf_field()}}
                                                <br>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        الصف:<br>
                                                        <div class="form-group">
                                                            <select class="form-control" id="grade" name="grade_id">
                                                                <option>اختر الصف</option>
                                                                @foreach($grades as $grade)
                                                                <option value="{{$grade->id}}">{{$grade->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label> الكلمة :</label>
                                                            <input type="text" class="form-control" name="word[0]"></input>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="empty">
                                                </div>
                                                <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span> إضافة
                                                    الكلمة
                                                </button>
                                                <br>
                                                <br>
                                                <br>
                                            </form>
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
        var i = 1;
        $("#btn").click(function (event) {
            event.preventDefault();
            for (count = 0; count < $("#inputNum").val(); count++) {
                $("#empty").append("<div class='row' id='btn[" + i + "]' >" +
                    "<div class='col-md-6'>" +
                    "<div class='form-group'>" +
                    "<div class = 'form-group' >" +
                    "<label for= 'word' >  الكلمة</label> " +
                    "<input type = 'hidden' name = 'user_id' value = '{{auth()->id()}}' >" +
                    "<input type = 'text' class = 'form-control' id= 'word[" + i + "]' placeholder = 'الكلمه' name = 'word[" + i + "]' >" +
                    "</br>" +
                    "<button class='btn btn-danger' id=\"btn[" + i + "]\" onclick='remove()'> حذف</button>" +
                    "</div>" +
                    "</div>" +
                    "</div>" +
                    "</div>"
                )
                ;
                i++;
            }
        });
        function remove() {
            var id = event.target.id;
            var remove = document.getElementById(id);
            remove.remove();
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
