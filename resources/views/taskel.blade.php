@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="container">


            <div class="main-body">
                <div class="page-wrapper">
                    <!-- [ Main Content ] start -->
                    <div class="row">
                        <!-- [ sample-page ] start -->
                        <div class="col-md-12 col-xl-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">

                                <li class="nav-item">
                                    <a class="nav-link active" id="week-tab" data-toggle="tab" href="#weekTasks"
                                       role="tab" aria-controls="profile" aria-selected="true">تشكيل</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="weekTasks" role="tabpanel"
                                     aria-labelledby="week-tab">
                                    <form action="{{url('tashkel')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="comment">النص:</label>
                                            <textarea name="text" class="form-control"
                                                      id="comment"
                                                      rows="20"> @if(isset($text)) {{$text}} @endif</textarea>
                                        </div>
                                        <button class="btn btn-info " type="submit"> تشكيل</button>
                                    </form>
                                    <div class="media friendlist-box align-items-center justify-content-center m-b-20">
                                        @if(isset($textTaskel))
                                            @if(strstr($textTaskel,"Taha") !== 'Taha')

                                                <br>
                                                <div>
                                                    <span> {{$textTaskel}}</span>
                                                </div>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- [ sample-page ] end -->
                    </div>
                    <!-- [ Main Content ] end -->
                </div>
            </div>

        </div>
    </div>
@endsection