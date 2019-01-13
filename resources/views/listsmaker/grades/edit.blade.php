@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
    <form action="{{url('grades')}}/{{$grades->id}}" method="post">
        {{ method_field('PUT') }}
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> اسم المرحله :</label>
                    <input type="text" class="form-control" value="{{$grades->name}}" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> اسم المرحله :</label>
                    <select class="form-control" name="level_id">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}" {{($grades->level_id==$level->id)?'selected':''}}>{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>تعديل</button>
        </form>
    </div>
@endsection