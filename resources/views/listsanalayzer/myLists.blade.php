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
                                        مواضيعي
                                    </h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="text-align:center"
                                        ">
                                        <h3 style="background: #357935;color: #f1f1f1">مواضيعى الحاليه</h3>
                                    </div>
                                </div>
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
                                                    <th>الكود</th>

                                                    <th>الموضوع</th>

                                                    <th>الصف</th>
                                                    <th>عرض</th>
                                                    <th>رفع الملف</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($files as $file)
                                                    @php
                                                        $list=\App\Models\ContentList::with('level','grade','user')->where('id',$file->list_id)->first();

                                                    @endphp
                                                    @if ($list==null){

                                                    @continue;
                                                    @endif
                                                    @php  $list=\App\Models\ContentList::with('grade')->where('id',$file->list_id)->first();
            $grade=\App\Models\Grade::where('id',$list->grade->id)->first(); @endphp
                                                    @if($list->step!=\App\Helper\Steps::ANALYZING_FILE)
                                                        @continue
                                                    @endif
                                                    <tr>

                                                        <td>{{$file->id}}</td>

                                                        <td>{{$file->lists->list}}</td>

                                                        <td>{{$list->grade->name}}</td>
                                                        <td><a href="{{url('analysisUploadFiles/'.$file->id)}}"> <span
                                                                        class=" fa fa-eye"></span></a></td>
                                                        <td>
                                                            <a href="{{url('analyzer/SendListToEditor/'.$list->id.'/'.\App\Helper\Steps::UPLOADING_FILE)}}"
                                                               class="btn btn-icon btn-rounded btn-outline-secondary"><i
                                                                        class="feather icon-upload"></i></a></td>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" style="text-align:center"
                                    ">
                                    <h3 style="background: #357935;color: #f1f1f1"> مواضيعى السابقة</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-block">
                            <div class="card-header">
                                <div class="form-group">
                                    <div class="table-responsive">
                                        <table id="key-act-button2"
                                               class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>الكود</th>

                                                <th>الموضوع</th>

                                                <th>الصف</th>
                                                <th>عرض</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($files as $file)
                                                @php
                                                    $list=\App\Models\ContentList::with('level','grade','user')->where('id',$file->list_id)->first();

                                                @endphp
                                                @if ($list==null){

                                                @continue;
                                                @endif
                                                @php
            $grade=\App\Models\Grade::where('id',$list->grade->id)->first(); @endphp
                                                @if($list->step!=\App\Helper\Steps::INSERTING_ARTICLE)
                                                    @continue
                                                @endif
                                                <tr>

                                                    <td>{{$file->id}}</td>

                                                    <td>{{$file->lists->list}}</td>

                                                    <td>{{$list->grade->name}}</td>
                                                    <td><a href="{{url('analysisUploadFiles/'.$file->id)}}"> <span
                                                                    class=" fa fa-eye"></span></a></td>
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




@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')

    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection

