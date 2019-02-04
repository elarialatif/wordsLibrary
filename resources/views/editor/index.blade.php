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
                                        كل المقالات
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
                                                    <th> ادخال المقال سهل</th>
                                                    <th>ادخال المقال متوسط</th>
                                                    <th>ادخال المقال صعب</th>
                                                    <th>ارسال الى المراجعه</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($fiels as $file)

                                                    @php  $list=\App\Models\ContentList::with('grade')->where('id',$file->list_id)->first();
            $grade=\App\Models\Grade::where('id',$list->grade->id)->first();
            $article= App\Models\Article::where('list_id',$file->list_id)->get();
                                                    @endphp
                                                    @if($list->step!=\App\Helper\Steps::INSERTING_ARTICLE)
                                                        @continue
                                                    @endif
                                                    <tr @if ($article->count()<App\Helper\ArticleLevels::NumberOfLevels)  style="background: #f0726f" @endif>

                                                        <td>{{$list->id}}</td>

                                                        <td>{{$file->lists->list}}</td>

                                                        <td>{{$list->grade->name}}</td>
                                                        <td><a href="{{url('editor/add/article/'.$file->id.'/'.\App\Helper\ArticleLevels::Easy.'/'.'index')}}"> <span
                                                                        @if (!App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Easy)) class="fa  fa-plus fa-2x"
                                                                        @else  class="fa  fa-edit fa-2x" @endif></span></a>
                                                        </td>
                                                        <td><a href="{{url('editor/add/article/'.$file->id.'/'.\app\Helper\ArticleLevels::Normal.'/'.'index')}}"> <span
                                                                        @if (!App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Normal)) class="fa  fa-plus fa-2x"
                                                                        @else  class="fa  fa-edit fa-2x" @endif></span></a>
                                                        </td>
                                                        <td><a href="{{url('editor/add/article/'.$file->id.'/'.\app\Helper\ArticleLevels::Hard.'/'.'index')}}"> <span
                                                                        @if (!App\Repository\ArticalRepository::getArticleByLevel($list->id,\App\Helper\ArticleLevels::Hard)) class="fa  fa-plus fa-2x"
                                                                        @else  class="fa  fa-edit fa-2x" @endif></span></a>
                                                        </td>
                                                        @if ($article->count()==App\Helper\ArticleLevels::NumberOfLevels)
                                                            <td><a class="btn btn-success" href="{{url('editor/sendArticleOfListToReviewer/'.$list->id)}}">
                                                                    ارسال</a>
                                                            </td>
                                                        @else
                                                            <td><button class="btn btn-default"> مغلق</button>
                                                            </td>
                                                        @endif
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
