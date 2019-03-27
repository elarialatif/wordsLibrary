@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <div class="container">
            @if(auth()->user()->role!=\App\Helper\UsersTypes::EDITOR)
                <a href="{{url('createList')}}" class="btn btn-primary"> إضافة موضوع جديدة <i
                            class="fa fa-plus"></i></a>
            @endif
            <br>
            <br>
            <form method="post" action="{{url('listsFilter')}}">
                {{csrf_field()}}
                <div class="row">
                    <div class="col-md-4">
                        الدولة:<br>
                        <div class="form-group">
                            <select class="form-control" name="country_id" required>
                                <option value="">اختر الدوله</option>
                                @foreach($countries as $country)
                                    <option value="{{$country->id}}">{{$country->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        المرحلة:<br>
                        <div class="form-group">
                            <select class="form-control" id="level" name="level_id" required>
                                <option value="">اختر المرحلة</option>
                                @foreach($levels as $level)
                                    <option value="{{$level->id}}">{{$level->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        الصف:<br>
                        <div class="form-group">
                            <select class="form-control" id="grade" name="grade_id" required>
                                {{----}}
                                {{--@foreach($grades as $grade)--}}
                                {{--<option value="{{$grade->id}}">{{$grade->name}}</option>--}}
                                {{--@endforeach--}}
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">الذهاب الي الموضوعات</button>
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
@endsection