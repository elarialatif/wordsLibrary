
@section ('css')
    <link href="{{ asset('public/css/layouts/home.css') }}" rel="stylesheet">


    <script src="{{ asset('public/plugins/amchart/js/amcharts.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/gauge.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/serial.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/light.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/pie.min.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/ammap.min.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/usaLow.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/radar.js') }}"></script>
    <script src="{{ asset('public/plugins/amchart/js/worldLow.js') }}"></script>
    <!-- chart js -->
    <script src="{{ asset('public/js/pages/chart.js') }}"></script>
@endsection
<style>
    .normal-num-show{
        bottom: 0rem !important;
    }
    .home .row .card {
        max-height: 330px ;
        min-height: 330px ;
    }
    .home .articles .card.statistial-visit {
        height: 330px ;
    }
    .card.statistial-visit.work-show{
        height: auto;
        max-height: 100%;
    }
</style>
{{-- ///////////////////////////////////////////////////////////////////////// --}}
<div class="container home">
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <!-- [ Row 1 ] start -->
            <div class="row articles">
                <!-- [ All Articles section ] start -->
                <div class="col-md-12 col-xl-12">
                    <div class="card statistial-visit">
                        <div class="card-header">
                            <h5>الموضوعات</h5>
                        </div>
                        <div class="card-block">
                            <span class="d-block"><i class="fas fa-sort-amount-up"></i>عدد الموضوعات الكلية </span>
                            <h3 class="f-w-300">{{$sharedArrayBetweenUsers['all_lists']}}</h3>
                            <div class="media mt-4 article_media">
                                <div class="photo-table">
                                    <h6>موضوعات تم الانتهاء منها </h6>
                                    <div class="progress">
                                        <div class="progress-bar progress-c-theme" role="progressbar"
                                             style="width:{{($sharedArrayBetweenUsers['all_lists']==0)?0:round(($sharedArrayBetweenUsers['finished']/$sharedArrayBetweenUsers['all_lists'])*100)}}%;height:6px;"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <label class="label theme-bg text-white f-14">{{($sharedArrayBetweenUsers['all_lists']==0)? 0 :round(($sharedArrayBetweenUsers['finished']/$sharedArrayBetweenUsers['all_lists'])*100)}}
                                        %</label>
                                </div>
                            </div>
                            <div class="media mt-4 article_media">
                                <div class="photo-table">
                                    <h6>موضوعات لم يتم الانتهاء منها</h6>
                                    <div class="progress">
                                        <div class="progress-bar progress-c-theme2" role="progressbar"
                                             style="width:{{($sharedArrayBetweenUsers['all_lists']==0)?0:round(($sharedArrayBetweenUsers['underWork']/$sharedArrayBetweenUsers['all_lists'])*100)}}%;height:6px;"
                                             aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <label class="label theme-bg2 text-white f-14">{{($sharedArrayBetweenUsers['all_lists']==0)?0:round(($sharedArrayBetweenUsers['underWork']/$sharedArrayBetweenUsers['all_lists'])*100)}}
                                        %</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ All Articles section ] end -->
            </div>
            <div class="row topics">
                <!-- [ All Topics section ] start -->
                <div class="col-md-12 col-xl-12">
                    <div class="card statistial-visit work-show">
                        <div class="card-header">
                            <h5> آخر ما تم العمل عليه</h5>
                        </div>
                        <div class="card-block">
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th style="width:50%">#</th>
                                            <th style="width:50%">الموضوع</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sharedArrayBetweenUsers['tasks'] as $list)
                                            <tr>
                                                <td>{{$list->id}}</td>
                                                <td>{{$list->list}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--<a style="text-align: center" class="btn btn-primary" href="">المزيد</a>--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Row 2 ] start -->

            <!-- [ Row 2 ] end -->
            <!-- [ Row 3 ] start -->

            <!-- [ Row 3 ] end -->
        </div>
    </div>
</div>

