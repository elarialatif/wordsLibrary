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
                                                            <a href="{{url('restoreList/')}}/{{$list->id}}"
                                                               class="btn btn-icon btn-outline-info radbor"><i
                                                                        class="fa fa-redo"></i></a>
                                                            <a href="{{url('forceDeleteList/')}}/{{$list->id}}"
                                                               class="btn btn-icon btn-outline-danger radbor"><i
                                                                        class="fa fa-trash"></i></a>
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