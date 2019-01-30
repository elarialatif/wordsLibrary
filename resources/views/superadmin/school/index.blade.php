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
                                        صفحة المدارس
                                    </h5>
                                    <a href="{{url('add/school')}}" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">اضافه مدرسة
                                        جديد<i
                                                class="fa fa-plus"></i></a>
                                    {{--model for add new user--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document" style="max-width: 50% !important;
">
                                            <center>
                                                       </center>
                                        </div>

                                    </div>
                                </div>
                                {{--end modal--}}
                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>الاسم</th>
                                            <th>الايميل</th>
                                            <th>الاجراءات</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($schools as $school)
                                            <tr>
                                                <td id="example"><a
                                                            href="#"> {{$school->name}}</a></td>
                                                <td>{{$school->email}}</td>

                                                <td>
                                                    <a href="{{url('edit/school/'.$school->id)}}"
                                                       class="btn btn-icon btn-outline-info radbor"> <i
                                                                class="fa fa-edit"></i></a>
                                                    <a href="#"
                                                       class="btn btn-icon btn-outline-danger radbor"><i
                                                                class="fa fa-trash"></i></a>
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
    <script>

        function archive(id) {
            window.location.assign("{{url('archive/')}}/" + id);
            //  window.location = {{url('archive/')}}+'/' + id;
            //   alert(id);
        }

        // $('#example').click(function () {
        //     var href = $(this).attr("href");
        //     if (href) {
        //
        //     }
        // });


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