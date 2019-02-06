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
                                        مواضيع جديده
                                    </h5>
                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">
                                        <table id="key-act-button"
                                               class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>الكود</th>

                                                <th>الموضوع</th>

                                                <th>الصف</th>
                                                <th> عرض المقال سهل</th>
                                                <th>عرض المقال متوسط</th>
                                                <th>عرض المقال صعب</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($lists as $list)
                                                @php
                                                    $grade=\App\Models\Grade::with('level')->where('id',$list->grade_id)->first();
                                                @endphp
                                                @if($list->step!=\App\Helper\Steps::REVIEW_ARTICLE)
                                                    @continue
                                                @endif
                                                <tr id="{{$list->id}}">

                                                    <td>{{$list->id}}</td>

                                                    <td>{{$list->list}}</td>

                                                    <td>{{$list->grade->name}}</td>
                                                    <td><a
                                                                href="{{url('reviewer/view/article/'.$list->id.'/'.\App\Helper\ArticleLevels::Easy)}}">
                                                            <span class="fa  fa-eye fa-2x"></span> </a>
                                                    </td>
                                                    <td><a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Normal)}}"> <span
                                                                    class="fa  fa-eye fa-2x"></span> </a>
                                                    </td>
                                                    <td><a href="{{url('reviewer/view/article/'.$list->id.'/'.\app\Helper\ArticleLevels::Hard)}}"> <span
                                                                    class="fa  fa-eye fa-2x"></span> </a>
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

@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>

@endsection
@endsection
