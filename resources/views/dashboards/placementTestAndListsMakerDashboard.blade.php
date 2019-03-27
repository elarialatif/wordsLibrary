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
        max-height: 100% ;
        min-height: auto ;
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
                <div class="col-md-12 col-xl-12 all">
                    <div class="card project-task">
                        <div class="card-block">
                            <div class="row align-items-center justify-content-center">
                                <div class="col">
                                    <i class="mdi mdi-file-upload f-30 text-c-blue"></i>
                                    <h5 class="m-0">عدد العناصر المدخلة</h5>
                                </div>
                                <div class="col-auto">
                                    <label class="label theme-bg text-white f-14 f-w-400 float-right normal-num-show">{{$sharedArrayBetweenUsers['all_lists']}}</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
