@extends('layouts.app')
@section('content')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table class="table table-condensed" id="myTable">
        <thead>
        <tr>
            <th>الكود</th>

            <th>الموضوع</th>

            <th>إدخال المقال</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lists as $list)
            @php  $file=\App\Models\ArticleFiles::where('list_id',$list->id)->first();

                                  $task=\App\Models\AssignTask::where('list_id',$list->id)->first(); @endphp
            @if($file)
                @continue
            @endif
            <tr>
                <td>{{$list->id}}</td>
                <td>{{$list->list}}</td>

                <td>

                    <a href="{{url('saveUploadArticle/')}}/{{$list->id}}"
                       class="btn btn-success"><i
                                class="fa fa-arrow-circle-up"></i></a>


                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
@endsection