@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
    <form action="{{url('editList/')}}/{{$lists->id}}" method="post" enctype="multipart/form-data">
        {{ method_field('POST') }}
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> اسم القائمه :</label>
                    <input type="text" class="form-control" value="{{$lists->list}}" name="list">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                الصف:<br>
                <div class="form-group">
                    <select class="form-control" id="grade" name="grade_id">
                        @foreach($grades as $grade)
                            <option value="{{$grade->id}}" {{($lists->grade_id==$grade->id)?'selected':''}}>{{$grade->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-4">--}}
                {{--الصوره:<br>--}}
                {{--<div class="form-group">--}}
                    {{--<input type="file" class="form-control" value="{{$lists->list}}" name="image">--}}
                    {{--@if($lists->image != null)--}}
                        {{--<div>--}}
                            {{--<img  style="height: 250px;width: 250px;" src="{{asset('public/listsImage/'.$lists->image)}}">--}}
                        {{--</div>--}}
                        {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>تعديل</button>
        </form>
    </div>
    <script type="text/javascript">
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
@endsection