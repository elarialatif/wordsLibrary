@extends('layouts.app')
@section('content')
    <div class="container">
        <br>
        <br>
        <br>
        <div class="container">
            <a href="{{url('grades/create')}}" class="btn btn-primary"> اضافه صف جديد  <i class="fa fa-plus"></i></a>
            <a href="{{url('levels/create')}}" class="btn btn-success"> اضافه مرحله جديد  <i class="fa fa-plus"></i></a>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-condensed" id="myTable">
                        <thead>
                        <tr>
                            <th>الصف</th>
                            <th>المرحله</th>
                            <th>الاجراءات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($grades as $grade)
                            <tr>
                                <td>{{$grade->name}}</td>
                                <td>{{$grade->level->name}}</td>
                                <td>
                                    <a href="{{url('grades/')}}/{{$grade->id}}/edit" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                    <a href="{{url('grades/delete')}}/{{$grade->id}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <br>
            <br>
            @section('css')
                <link rel="stylesheet" type="text/css"
                      href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
                <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
            @endsection
            @section('js')
                <script src="{{ asset('public/js/jquery.min.js')}}"></script>
                <script src="{{ asset('public/js/jquery.dataTables.min.js')}}"></script>
                {{--<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>--}}
                <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
                <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#myTable').DataTable({
                            dom: 'lBfrtip',
                            buttons: {
                                buttons: [
                                    {
                                        extend: 'print', text: 'طباعه',
                                        className: "btn btn-success",
                                        init: function (api, node, config) {
                                            $(node).removeClass('dt-button buttons-print')
                                        }
                                    },
                                    {
                                        extend: 'copy', text: 'نسخ',
                                        className: "btn btn-info",
                                        init: function (api, node, config) {
                                            $(node).removeClass('dt-button buttons-copy buttons-html5')
                                        }
                                    },
                                    {
                                        extend: 'csv', text: 'CSV',
                                        className: "btn btn-primary",
                                        init: function (api, node, config) {
                                            $(node).removeClass('dt-button buttons-csv buttons-html5')
                                        }
                                    },
                                    {
                                        extend: 'pdf', text: 'PDF',
                                        className: "btn btn-default",
                                        init: function (api, node, config) {
                                            $(node).removeClass('dt-button buttons-pdf buttons-html5')
                                        }
                                    },
                                    {
                                        extend: 'excel', text: 'اكسيل',
                                        className: "btn btn-warning",
                                        init: function (api, node, config) {
                                            $(node).removeClass('dt-button buttons-excel buttons-html5')
                                        }
                                    },
                                ]
                            }, "lengthMenu": [[20, 40, 60, -1], [20, 40, 60, "All"]],
                            "language": {
                                "search": "  بحث :  ",
                                "paginate": {
                                    "previous": "السابق",
                                    "next": "التالى"
                                },
                                "info": "عرض _START_ الي _END_ من _TOTAL_ من الصفوف",
                                "lengthMenu": "عرض _MENU_ من الصفوف",
                                "loadingRecords": "جاري التحميل...",
                                "processing": "جاري التحميل...",
                                "zeroRecords": "لا يوجد نتائج",
                                "infoEmpty": "عرض 0 to 0 of 0 من الصفوف",
                                "infoFiltered": "(عرض من _MAX_ صف)",
                            }
                        });
                    });
                </script>
@endsection
@endsection