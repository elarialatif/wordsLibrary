@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <div class="container">
    <form action="{{url('grades')}}" method="post">
       @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{--<input type="hidden" name="user_id" value="{{auth()->id()}}">--}}
                    <label> اسم الصف :</label>
                    <input type="text" class="form-control" name="name">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label> اسم المرحله :</label>
                    <select class="form-control" name="level_id">
                        @foreach($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>إضافة</button>
        </form>
    </div>
@endsection