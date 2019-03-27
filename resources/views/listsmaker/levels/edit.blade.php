@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
    <form action="{{url('levels')}}/{{$levels->id}}" method="post">
        {{ method_field('PUT') }}
        {{csrf_field()}}
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label> اسم المرحلة :</label>
                    <input type="text" class="form-control" value="{{$levels->name}}" name="name">
                </div>
            </div>
        </div>
        <button class="btn btn-primary" type="submit"><span class="fa fa-plus"></span>تعديل</button>
        </form>
    </div>
@endsection