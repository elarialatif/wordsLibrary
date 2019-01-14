@extends('layouts.app')
@section('content')


<<<<<<< HEAD
{{-- ///////////////////////////////////////////////////////////////////////// --}}
<div class="container home">
    <div class="main-body">
        <div class="page-wrapper">
            <!-- [ Main Content ] start -->
            <!-- [ Row 1 ] start -->
            <div class="row topics">
                <!-- [ All Topics section ] start -->
                <div class="col-md-6 col-xl-6 all">
                    <div class="card project-task">
                        <div class="card-block">
                            <div class="row align-items-center justify-content-center">
                                <div class="col">
                                    <i class="mdi mdi-book-open-page-variant f-30 text-c-purple"></i>
                                    <h5 class="m-0">عدد الموضوعات الكلية</h5>
                                </div>
                                <div class="col-auto">
                                    <label class="label theme-bg text-white f-14 f-w-400 float-right">1400</label>
                                </div>
                            </div>
                            <div class="row align-items-center justify-content-center">
                                <div class="col">
                                    <i class="mdi mdi-file-upload f-30 text-c-blue"></i>
                                    <h5 class="m-0">عدد الموضوعات التي تم رفع مقال لها</h5>
                                </div>
                                <div class="col-auto">
                                    <label class="label theme-bg text-white f-14 f-w-400 float-right">1000</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ All Topics section ] end -->
                <!-- [ Completed Topics section ] start -->
                <div class="col-md-6 col-xl-6">
                    <div class="card project-task">
                        <div class="card-block">
                            <div class="row align-items-center justify-content-center">
                                <div class="col">
                                    <h5 class="m-0">عدد الموضوعات المنتهية</h5>
                                </div>
                                <div class="col-auto">
                                    <label class="label theme-bg text-white f-14 f-w-400 float-right">50</label>
                                </div>
                            </div>
                            <h6 class="text-muted mt-4 mb-3">الموضوعات المنتهية    50/1400 </h6>
                            <div class="progress">
                                <div class="progress-bar progress-c-theme" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ Completed Topics section ] end -->
            </div>
            <!-- [ Row 1 ] end -->
            <!-- [ Row 2 ] start -->
            <div class="row">
                <!-- [ Visitors section ] start -->
                <div class="col-md-4 col-xl-4">
                    <div class="card theme-bg visitor"><a>
                        <div class="card-block text-center">
                            <img class="img-female" src="{{asset('public/images/user/user-1.png')}}" alt="visitor-user">
                            <h5 class="text-white m-0"> <i class="fas fa-users"> </i>عدد المستخدمين</h5>
                            <h3 class="text-white m-t-20 f-w-300">235</h3>
                            <img class="img-men" src="{{asset('public/images/user/user-2.png')}}" alt="visitor-user">
                        </div></a>
                    </div>
                </div>
                <!-- [ Visitors section ] end -->
                <!-- [ Categories section ] start -->
                <div class="col-md-4 col-xl-4">
                    <div class="card theme-bg2 categories"><a>
                        <div class="card-block text-center">
                            <img class="img-female" src="{{asset('public/images/widget/category.png')}}">
                            <h5 class="text-white m-0"> <i class="fas fa-sitemap"> </i> عدد التصنيفات</h5>
                            <h3 class="text-white m-t-20 f-w-300">235</h3>
                            <img class="img-men" src="{{asset('public/images/widget/category.png')}}">
                        </div></a>
                    </div>
                </div>
                <!-- [ Categories section ] end -->
                <!-- [ Levels section ] start -->
                <div class="col-md-4 col-xl-4">
                    <div class="card theme-bg levels"><a>
                        <div class="card-block text-center">
                            <img class="img-female" src="{{asset('public/images/widget/cline.png')}}">
                            <h5 class="text-white m-0"> <i class="fas fa-chart-line"> </i> عدد المراحل</h5>
                            <h3 class="text-white m-t-20 f-w-300">235</h3>
                            <img class="img-men" src="{{asset('public/images/widget/cline.png')}}">
                        </div></a>
                    </div>
                </div>
                <!-- [ Levels section ] end -->
                
            </div> 
            <!-- [ Row 2 ] end -->
            <!-- [ Row 3 ] start -->
            <div class="row articles"> 
                <!-- [ user web-list ] start -->
                <div class="col-md-6 col-xl-6 m-b-30 user">
                    {{-- title --}}
                    <div class="card-header">
                        <h5>معدلات الأنتاج</h5>
                    </div>
                    {{-- title end --}}
                    <div class="tabbable boxed parentTabs">
                        <ul  id="myTab1" role="tablist" class="nav nav-tabs tab1">
                            <li class="nav-item" >
                                <a class="nav-link active" data-toggle="tab"  role="tab" href="#day" data->اليوم</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"  role="tab" href="#week">الاسبوع</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab"  role="tab" href="#all">الكل</a>
                            </li>
                        </ul>
                        <div class="nested-tab">
                            <div class="tab-pane fade active show" id="day">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"  role="tab" href="#daysub1">مدخل مقالات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#daysub2">محلل مقالات </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#daysub3">مراجع محتوى</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#daysub4">مدخل اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#daysub5">مراجع اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#daysub6">مراجع لغوي</a>
                                        </li>
                                    </ul>
                                    <div class="nested-content">
                                        <div class="tab-pane fade active in show" data-toggle="tab" id="daysub1">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" data-toggle="tab" id="daysub2">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                               <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub3">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub4">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub5">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub6">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub7">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="daysub8">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- week --}}
                            <div class="tab-pane fade" id="week">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"  role="tab" href="#weeksub1">مدخل مقالات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#weeksub2">محلل مقالات </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#weeksub3">مراجع محتوى</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#weeksub4">مدخل اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#weeksub5">مراجع اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#weeksub6">مراجع لغوي</a>
                                        </li>
                                    </ul>
                                    <div class="nested-content">
                                        <div class="tab-pane fade active in show" data-toggle="tab" id="weeksub1">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" data-toggle="tab" id="weeksub2">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub3">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub4">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub5">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub6">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub7">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="weeksub8">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- all --}}
                            <div class="tab-pane fade" id="all">
                                <div class="tabbable">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab"  role="tab" href="#allsub1">مدخل مقالات</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#allsub2">محلل مقالات </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#allsub3">مراجع محتوى</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#allsub4">مدخل اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#allsub5">مراجع اسئلة</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " data-toggle="tab"  role="tab" href="#allsub6">مراجع لغوي</a>
                                        </li>
                                    </ul>
                                    <div class="nested-content">
                                        <div class="tab-pane fade active in show" data-toggle="tab" id="allsub1">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" data-toggle="tab" id="weeksub2">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">12 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub3">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub4">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub5">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub6">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub7">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">11 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">7 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="allsub8">
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-up f-22 m-r-10 text-c-green"></i>3784</span>
                                                </div>
                                            </div>
                                            <div class="media">
                                                <div class="m-r-10 photo-table">
                                                    <a href="#!" id="insertTopic">
                                                    <img class="rounded-circle" style="width:40px;" src="{{asset('public/images/user/1.jpg')}}" alt="activity-user"></a>
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="m-0 d-inline">احمد احمد</h6>
                                                    <h6 class="permition">8 مدخل مقالات</h6>
                                                    <span class="float-right d-flex  align-items-center"><i class="fas fa-caret-down f-22 m-r-10 text-c-red"></i>1032</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{--  --}}
                        </div>
                    </div>
                </div>
                <script>
                    $("ul.nav-tabs a").click(function (e) {
                        e.preventDefault();  
                        $(this).tab('show');
                    });
                </script>
                <!-- [ user web-list ] start -->
                <!-- [ All Articles section ] start -->
                <div class="col-md-6 col-xl-6">
                    <div class="card statistial-visit">
                        <div class="card-header">
                            <h5>المقالات</h5>
                        </div>
                        <div class="card-block">
                            <span class="d-block"><i class="fas fa-sort-amount-up"></i>عدد الدروس الكليه </span>
                            <h3 class="f-w-300">4000</h3>
                            <div class="media mt-4 article_media">
                                <div class="photo-table">
                                    <h6> دروس تم رفعها</h6>
                                    <div class="progress">
                                        <div class="progress-bar progress-c-theme" role="progressbar" style="width:80%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <label class="label theme-bg text-white f-14">20%</label>
                                </div>
                            </div>
                            <div class="media mt-4 article_media">
                                <div class="photo-table">
                                    <h6>دروس تحت التحليل</h6>
                                    <div class="progress">
                                        <div class="progress-bar progress-c-theme2" role="progressbar" style="width:70%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <label class="label theme-bg2 text-white f-14">15%</label>
                                </div>
                            </div>
                            <div class="media mt-4 article_media">
                                <div class="photo-table">
                                    <h6>دروس تم تحليلها</h6>
                                    <div class="progress">
                                        <div class="progress-bar progress-c-blue" role="progressbar" style="width:60%;height:6px;" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                                <div class="media-body">
                                    <label class="label bg-c-blue text-white f-14 ">10%</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- [ All Articles section ] end -->
            </div>
            <!-- [ Row 3 ] end -->
            <!-- [ Row 4 ] start -->
            <div class="row">
                <div class="col-md-12 col-xl-12">
                    <div class=" full_result">
                        <div class="card-header borderless">
                            <h5 class="text-white">Statistics</h5>
                        </div>
                        <div class="card-block">
                            <div id="Statistics-sale" class="last-week-sales" style="height: 300px; overflow: hidden; text-align: left;"><div class="amcharts-main-div" style="position: relative;"><div class="amcharts-chart-div" style="overflow: hidden; position: relative; text-align: left; width: 456px; height: 300px; padding: 0px; cursor: default; touch-action: auto;"><svg version="1.1" style="position: absolute; width: 456px; height: 300px; top: 0px; left: 0.328125px;"><desc>JavaScript chart by amCharts 3.21.5</desc><defs><filter id="shadow" width="150%" height="150%"><feOffset result="offOut" in="SourceAlpha" dx="2" dy="2"></feOffset><feGaussianBlur result="blurOut" in="offOut" stdDeviation="10"></feGaussianBlur><feColorMatrix result="blurOut" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 .2 0"></feColorMatrix><feBlend in="SourceGraphic" in2="blurOut" mode="normal"></feBlend></filter></defs><g><path cs="100,100" d="M0.5,0.5 L455.5,0.5 L455.5,299.5 L0.5,299.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-bg"></path><path cs="100,100" d="M0.5,0.5 L455.5,0.5 L455.5,269.5 L0.5,269.5 L0.5,0.5 Z" fill="#FFFFFF" stroke="#000000" fill-opacity="0" stroke-width="1" stroke-opacity="0" class="amcharts-plot-area" transform="translate(0,10)"></path></g><g><g class="amcharts-category-axis" transform="translate(0,10)"></g><g class="amcharts-value-axis value-axis-valueAxisAuto0_1547122520234" transform="translate(0,10)" visibility="visible"></g></g><g transform="translate(0,10)" clip-path="url(#AmChartsEl-16)"><g visibility="hidden"><g transform="translate(380,0)" visibility="hidden"><rect x="0.5" y="0.5" width="152" height="269" rx="0" ry="0" stroke-width="1" fill="#fff" stroke="#fff" fill-opacity="1" stroke-opacity="1" class="amcharts-cursor-fill" transform="translate(-77,0)"></rect></g></g></g><g></g><g></g><g></g><g><g transform="translate(0,10)" class="amcharts-graph-line amcharts-graph-g3"><g></g><g clip-path="url(#AmChartsEl-18)"><path cs="100,100" d="M76.5,121.55 L228.5,161.9 L379.5,135 M0,0 L0,0" fill="none" stroke-width="3" stroke-opacity="1" stroke="#FFFFFF" stroke-linejoin="round" class="amcharts-graph-stroke"></path></g><clipPath id="AmChartsEl-18"><rect x="0" y="0" width="455" height="269" rx="0" ry="0" stroke-width="0"></rect></clipPath><g></g></g></g><g></g><g><path cs="100,100" d="M0.5,269.5 L455.5,269.5 L455.5,269.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(0,10)" class="amcharts-axis-zero-grid-valueAxisAuto0_1547122520234 amcharts-axis-zero-grid"></path><g class="amcharts-category-axis"><path cs="100,100" d="M0.5,0.5 L455.5,0.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(0,279)" class="amcharts-axis-line"></path></g><g class="amcharts-value-axis value-axis-valueAxisAuto0_1547122520234"><path cs="100,100" d="M0.5,0.5 L0.5,269.5" fill="none" stroke-width="1" stroke-opacity="0" stroke="#000000" transform="translate(0,10)" class="amcharts-axis-line" visibility="visible"></path></g></g><g><g transform="translate(0,10)" clip-path="url(#AmChartsEl-17)" style="pointer-events: none;"><path cs="100,100" d="M0.5,0.5 L455.5,0.5 L455.5,0.5" fill="none" stroke-width="1" stroke="#fff" class="amcharts-cursor-line amcharts-cursor-line-horizontal" visibility="hidden" transform="translate(0,43)"></path></g><clipPath id="AmChartsEl-17"><rect x="0" y="0" width="455" height="269" rx="0" ry="0" stroke-width="0"></rect></clipPath></g><g></g><g><g transform="translate(0,10)" class="amcharts-graph-line amcharts-graph-g3"><circle r="4" cx="0" cy="0" fill="#04A5F5" stroke="#fff" fill-opacity="1" stroke-width="3" stroke-opacity="3" transform="translate(76,121) scale(1)" aria-label="Bicycles 2001 55" class="amcharts-graph-bullet"></circle><circle r="4" cx="0" cy="0" fill="#04A5F5" stroke="#fff" fill-opacity="1" stroke-width="3" stroke-opacity="3" transform="translate(228,161) scale(1)" aria-label="Bicycles 2002 40" class="amcharts-graph-bullet"></circle><circle r="4" cx="0" cy="0" fill="#04A5F5" stroke="#fff" fill-opacity="1" stroke-width="3" stroke-opacity="3" transform="translate(379,135) scale(1)" aria-label="Bicycles 2003 50" class="amcharts-graph-bullet"></circle></g></g><g><g></g></g><g><g class="amcharts-category-axis" transform="translate(0,10)" visibility="visible"><text y="8" fill="#fff" font-family="Verdana" font-size="15px" opacity="1" text-anchor="middle" transform="translate(76.04109589201845,255.5)" class="amcharts-axis-label"><tspan y="8" x="0">2001</tspan></text><text y="8" fill="#fff" font-family="Verdana" font-size="15px" opacity="1" text-anchor="middle" transform="translate(228.04109589201846,255.5)" class="amcharts-axis-label"><tspan y="8" x="0">2002</tspan></text><text y="8" fill="#fff" font-family="Verdana" font-size="15px" opacity="1" text-anchor="middle" transform="translate(379.04109589201846,255.5)" class="amcharts-axis-label"><tspan y="8" x="0">2003</tspan></text></g><g class="amcharts-value-axis value-axis-valueAxisAuto0_1547122520234" transform="translate(0,10)" visibility="visible"><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,269)" class="amcharts-axis-label"><tspan y="0" x="0">0</tspan></text><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,215)" class="amcharts-axis-label"><tspan y="0" x="0">20</tspan></text><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,161)" class="amcharts-axis-label"><tspan y="0" x="0">40</tspan></text><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,108)" class="amcharts-axis-label"><tspan y="0" x="0">60</tspan></text><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,54)" class="amcharts-axis-label"><tspan y="0" x="0">80</tspan></text><text y="0" fill="#000000" font-family="Verdana" font-size="0px" opacity="1" text-anchor="end" transform="translate(-12,0)" class="amcharts-axis-label"><tspan y="0" x="0">100</tspan></text></g></g><g></g><g transform="translate(0,10)"></g><g></g><g></g><clipPath id="AmChartsEl-16"><rect x="-1" y="-1" width="457" height="271" rx="0" ry="0" stroke-width="0"></rect></clipPath></svg><a href="http://www.amcharts.com/javascript-charts/" title="JavaScript charts" style="position: absolute; text-decoration: none; color: rgb(0, 0, 0); font-family: Verdana; font-size: 11px; opacity: 0.7; display: block; left: 5px; top: 15px;"></a></div></div></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ Row 4 ] end -->
        </div>
    </div>
</div>
{{-- ///////////////////////////////////////////////////////////////////////// --}}
<script>
    //  config.EnableCors(new EnableCorsAttribute(Properties.Settings.Default.Cors, "", ""));

    $().ready(function () {

        $.ajax({
            url: "http://tahadz.com/mishkal/ajaxGet",
            jsonp: "callback",
            dataType: "jsonp",
            headers: {
                'Access-Control-Allow-Credentials' : true,
                'Access-Control-Allow-Origin':'*',
                'Access-Control-Allow-Methods':'GET',
                'Content-Type':'application/json',
            },
            data: {
                text: "السلام عليكم\nاهلا بكم\nكيف حالكم",
               action: "TashkeelText",
            },
            success: function (data) {
                alert('bafr');
                console.log(data.result); // server response
            }
        });
        // $.getJSON("http://tahadz.com/mishkal/ajaxGet", {
        //         text: "السلام عليكم\nاهلا بكم\nكيف حالكم",
        //         action: "TashkeelText",
        //     },
        //
        //
        //     function (data) {
        //         $("#result").text(data.result);
        //     });

    });
</script>
=======
>>>>>>> d310e11f27d9a76cd248b7df514aa7396b0dbe8c


@endsection