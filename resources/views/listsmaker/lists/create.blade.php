@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <div class="container">
        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <select id="inputNum" class="form-control col-md-4">
                        <option value="">اختر عدد الموضوعات</option>
                        <option value="1">1</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <button class="btn btn-primary" id="add">إضافة عدد معين</button>
                    <input class="form-control" type="number" name="number" style="display: none" id="inputNum2"
                           placeholder="ادخل الرقم">
                    <br>
                </div>
            </div>
        </div>
        <button id="btn" class=" btn btn-primary"> إضافة حقول للموضوعات</button>
        <form action="{{url('createList')}}" method="post">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-4">
                    الدولة:<br>
                    <div class="form-group">
                        <select class="form-control" name="country_id">
                            @foreach($countries as $country)
                                <option value="{{$country->id}}">{{$country->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    المرحلة:<br>
                    <div class="form-group">
                        <select class="form-control" name="level_id" id="level">
                            <option>اختر المرحلة</option>
                            @foreach($levels as $level)
                                <option value="{{$level->id}}">{{$level->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    الصف:<br>
                    <div class="form-group">
                        <select class="form-control" name="grade_id" id="grade">
                            {{--@foreach($grades as $grade)--}}
                            {{--<option value="{{$grade->id}}">{{$grade->name}}</option>--}}
                            {{--@endforeach--}}
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" name="user_id" value="{{auth()->id()}}">
                        <label> اسم الموضوع :</label>
                        <input style="margin-bottom: 50px" type="text" class="form-control" name="list[0]"
                               placeholder="اسم الموضوع">
                    </div>
                </div>
            </div>
            <div id="empty">
            </div>
            <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة</button>
            <br>
            <br>
            <br>
        </form>
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
        </script>
        <script>
            var i = 1;
            $('#add').click(function (e) {
                e.preventDefault();
                $('input[name=number]').toggle();
            });
            $("#btn").click(function (event) {
                event.preventDefault();
                if ($("#add").click()) {
                    $('input[name=number]').toggle();
                    for (count = 0; count < $('input[name=number]').val(); count++) {
                        $("#empty").append("<div class='row'>" +
                            "<div class='col-md-6'>" +
                            "<div class='form-group'>" +
                            "<div class = 'form-group' id='btn[" + i + "]'>" +
                            "<input type = 'hidden' name = 'user_id' value = '{{auth()->id()}}' >" +
                            "<input type = 'text' class = 'form-control' id= 'list[" + i + "]' placeholder = 'اسم الموضوع' name = 'list[" + i + "]' >" +
                            "</br>" +
                            "<button class='btn btn-danger' id=\"btn[" + i + "]\" onclick='remove()'><i class='fa fa-trash'></i> حذف</button>" +
                            "</div>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        )
                        ;
                        i++;
                    }
                }
                for (count = 0; count < $("#inputNum").val(); count++) {
                    $("#empty").append("<div class='row'>" +
                        "<div class='col-md-6'>" +
                        "<div class='form-group'>" +
                        "<div class = 'form-group' id='btn[" + i + "]'>" +
                        "<input type = 'text' class = 'form-control' id= 'list[" + i + "]' placeholder = 'اسم الموضوع' name = 'list[" + i + "]' >" +
                        "<input type = 'hidden' name = 'user_id' value = '{{auth()->id()}}' >" +
                        "</br>" +
                        "<button class='btn btn-danger' id=\"btn[" + i + "]\" onclick='remove()'><i class='fa fa-trash'></i> حذف</button>" +
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
    </div>
@endsection