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
                                        المقالات المرفوضة
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
                                                        <th> تعديل المقال سهل</th>
                                                        <th>تعديل المقال متوسط</th>
                                                        <th>تعديل المقال صعب</th>
                                                        <th>إرسال إلى المراجعة</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($lists as $list)

                                                        @php
                                                            $file=\App\Models\ArticleFiles::where('list_id',$list->id)->first();
                                                                            $grade=\App\Models\Grade::with('level')->where('id',$list->grade->id)->first();
                                                                            $article= App\Models\Article::where('list_id',$list->id)->get();
                                                                            $easy=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy);
                                                                $normal=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal);
                                                                $hard=App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard);
                                                                        if($easy)
                                                                        $issueseasy=\App\Models\Issues::where(['table' => 'article', 'field_id' => $easy->id,'step'=>\App\Helper\IssuesSteps::Open])->get();
                                                                        if($normal)
                                                                        $issuesnormal=\App\Models\Issues::where(['table' => 'article', 'field_id' => $normal->id,'step'=>\App\Helper\IssuesSteps::Open])->get();
                                                                        if($hard)
                                                                        $issueshard=\App\Models\Issues::where(['table' => 'article', 'field_id' => $hard->id,'step'=>\App\Helper\IssuesSteps::Open])->get();
                                                        @endphp
                                                        @if($list->step!=\App\Helper\Steps::reSendToEditorFormReviewer)
                                                            @continue
                                                        @endif
                                                        <tr @if ($article->count()< App\Helper\ArticleLevels::NumberOfLevels)  style="background: #f0726f" @endif>

                                                            <td>{{$list->id}}</td>

                                                            <td>{{$list->list}}</td>

                                                            <td>{{$list->grade->name}}</td>
                                                            <td>
                                                                <a @if(isset($issueseasy)) @if($issueseasy->count()>0) href="{{url('editor/add/article/'.$file->id.'/'.\App\Helper\ArticleLevels::Easy)}}" @endif @endif> <span
                                                                            @if(isset($issueseasy)) @if($issueseasy->count()>0)  style="color: #ff2733"
                                                                            class="fa  fa-edit fa-2x"
                                                                            @endif @if($issueseasy->count()==0) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif
                                                                    ></span></a>
                                                            </td>
                                                            <td>
                                                                <a @if(isset($issuesnormal))  @if($issuesnormal->count()>0)  href="{{url('editor/add/article/'.$file->id.'/'.\app\Helper\ArticleLevels::Normal)}}" @endif @endif> <span
                                                                            @if(isset($issuesnormal))  @if($issuesnormal->count()>0)  style="color: #ff2733"
                                                                            class="fa  fa-edit fa-2x"
                                                                            @endif @if($issuesnormal->count()==0) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif ></span> </a>
                                                            </td>
                                                            <td>
                                                                <a @if(isset($issueshard)) @if($issueshard->count()>0) href="{{url('editor/add/article/'.$file->id.'/'.\app\Helper\ArticleLevels::Hard)}}" @endif @endif> <span
                                                                            @if(isset($issueshard)) @if($issueshard->count()>0) style="color: #ff2733"
                                                                            class="fa  fa-edit fa-2x"
                                                                            @endif @if($issueshard->count()==0) style="color: green"
                                                                            class="fas fa-check-circle fa-2x"
                                                                            @endif @endif ></span></a>
                                                            </td>
                                                            @if ($issueshard->count()==0&&$issueseasy->count()==0&&$issuesnormal->count()==0)
                                                                <td><a class="btn btn-success"
                                                                       href="{{url('editor/reSendListOfArticleToReviewer/'.$list->id)}}">
                                                                        إعادة إرسال</a>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <button class="btn btn-default"> مغلق</button>
                                                                </td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <center><h3> ملفات تم رفضها</h3></center>
                                    <br>
                                    <div class="table-responsive">
                                        <table id="key-act-button"
                                               class="display table nowrap table-striped table-hover"
                                               style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>الكود</th>

                                                <th>الموضوع</th>

                                                <th>الصف</th>
                                                <th>رفع</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($Refusedlists as $list)
                                                <tr>

                                                    <td>{{$list->id}}</td>

                                                    <td>{{$list->list}}</td>

                                                    <td>{{$list->grade->name}}</td>
                                                    <td><a href="{{url('saveUploadArticle/'.$list->id)}}"
                                                           class="btn btn-icon btn-rounded btn-outline-secondary"><i
                                                                    class="feather icon-upload"></i></a></td>
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
