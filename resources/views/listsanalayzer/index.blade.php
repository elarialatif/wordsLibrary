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
                                        مواضيع جديدة
                                    </h5>
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
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($files as $file)

                                                        @php  $list=\App\Models\ContentList::with('grade')->where('id',$file->list_id)->first();
                                         if($list==null){
                                         continue;
                                         }
                                                 //   ()
           // $grade=\App\Models\Grade::where('id',$list->grade->id)->first(); @endphp
                                                        <tr>

                                                            <td>{{$file->id}}</td>

                                                            <td>{{$file->lists->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            <td><a href="{{url('analysisUploadFiles/'.$file->id)}}">
                                                                    <span class=" fa fa-eye"></span></a></td>
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

