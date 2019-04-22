@extends('layouts.app')
@section('content')

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        @php
            session()->put('array',$Array);
            session()->put('finalArray',$finalArray);
        @endphp
        <div class="container">
            <div id="empty"></div>
        </div>
        <div class="main-body">
            <div class="page-wrapper">
                <!-- [ Main Content ] start -->
                <div class="row">
                    <!-- [ HTML5 Export button ] start -->
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>
                                      صفحة تحليل ملف ({{$list->list}})
                                </h5>
                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                        data-target="#myModal" style="float: left">عرض الملف الأصلي
                                </button>

                                @if($list->step ==\App\Helper\Steps::ANALYZING_FILE)
                                    <a style="float: left" class="btn btn-success btn-lg"
                                       href="{{url('analyzer/SendListToEditor/'.$list->id.'/'.\App\Helper\Steps::INSERTING_ARTICLE)}}">
                                        إرسال إلى محرر
                                        المقالات</a>
                                    <a style="float: left" class="btn btn-danger btn-lg"
                                       href="{{url('analyzer/SendListToEditor/'.$list->id.'/'.\App\Helper\Steps::UPLOADING_FILE)}}">
                                        رفع الملف مجددا
                                    </a>
                                @else
                                    <h3 style="float: left" class="btn btn-info btn btn-glow-success btn-lg">تم
                                        إرسال الموضوع إلى محرر المقالات مسبقا </h3>

                                @endif
                                <br>
                                <br>
                                @php $links = App\Models\Link::where('list_id',$list->id)->get(); @endphp
                                @foreach($links as $link)
                                    <a  href="{{$link->link}}">{{$link->name}}</a>
                                    <br>
                                @endforeach
                                <img src="{{url('/public/'.$list->image)}}">


                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button3"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>الكلمة</th>
                                            <th>التكرار</th>
                                            <th>سهل</th>
                                            <th>صعب</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($finalArray as $key =>$value)
                                            @php  $word = App\Models\Word::where(['word'=> $key,'grade_id'=>$list->grade_id])->first();
                                            @endphp
                                            <tr @if($word)  @if($word->level==App\Helper\ArticleLevels::Easy) style="background:#52d552"
                                                @endif
                                                @if($word->level==App\Helper\ArticleLevels::Hard) style="background:#ff6565" @endif @endif>

                                                <td>{{$key}}</td>
                                                <td>{{$value}}</td>
                                                <td><input type="checkbox" name="easy" value="{{$key}}"
                                                           onchange="change('{{$key}}','easy')" id="easy{{$key}}"
                                                           @if($word) @if($word->level==App\Helper\ArticleLevels::Easy)checked @endif @endif>
                                                </td>
                                                <td><input type="checkbox" name="hard" value="{{$key}}"
                                                           onchange="change('{{$key}}','hard')" id="hard{{$key}}"
                                                           @if($word) @if($word->level==App\Helper\ArticleLevels::Hard) checked @endif @endif>
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
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" style="text-align: center;color: blue">محتويات الملف</h4>
                </div>
                <div class="modal-body">
                    {{$File}}
                    @php
                        /*   foreach ($orginalFile as $key => $value) {
                                $word = App\Models\Word::where(['word'=> $value,'grade_id'=>$list->grade_id,'file_id'=>$file_id])->first();
                                if ($word) {
                                if($word->level==App\Helper\ArticleLevels::Easy)
                                    echo "<span style='color: green'> $value  </span>" . ' ';
                                     if($word->level==App\Helper\ArticleLevels::Hard)
                                    echo "<span style='color: red'> $value  </span>" . ' ';
                                } else {
                                    echo $value . ' ';
                                }
                            };*/
                    @endphp
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">غلق</button>
                </div>
            </div>

        </div>
    </div>
@section('css')
    <link rel="stylesheet" href="{{url('public/plugins/data-tables/css/datatables.min.css')}}">

@endsection
@section('js')
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>
    <script>
        function markAsDifficult() {
            $('#empty').empty();
            var arreasy = new Array();
            var arrhard = new Array();
            $("input:checkbox[name=easy]:checked").each(function () {
                arreasy.push($(this).val());

            });
            $("input:checkbox[name=hard]:checked").each(function () {
                arrhard.push($(this).val());

            });

            $.ajax({

                url: "{{url('Ajax/createWords')}}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "arreasy": arreasy,
                    "arrhard": arrhard,
                    "grade_id": "{{$list->grade_id}}",
                    "file_id": "{{$file_id}}",
                },
            }).done(function () {

                $('#empty').append('<div class=" btn-success"> تمت الإضافة بنجاح</div>');
                location.reload();
            });
        }

        $(document).ready(function () {
            setTimeout(function () {
                $(" <div class=\"row\">" +
                    "<div class=\"col-md-6\">" +
                    "<div class=\"form-group\">" +
                    "<input class=\"btn btn-info btn btn-glow-success btn-lg\"style=\"width: 80%;\n" +
                    "    text-align: right;\n" +
                    "    font-size: 14px;\n" +
                    "    font-weight: bold;\n" +
                    "    font-family: unset;\"  type='text' value='عدد كلمات المقال ({{count($Array)}})   وعدد الكلمات بعد التحليل ({{count($finalArray)}}) ' readonly />" +
                        @if($list->step ==\App\Helper\Steps::ANALYZING_FILE)
                            "<button class=\"btn btn-danger\" onclick=\"markAsDifficult()\"> حفظ المحدد</button>" +
                        @endif
                            "</div>" +
                    "</div>" +
                    "</div>").insertAfter(".dataTables_filter");
            }, 1000);
        });

        function change(word, level) {
            if (level === 'easy') {
                document.getElementById('hard' + word).checked = false;
            }
            if (level === 'hard') {
                document.getElementById('easy' + word).checked = false;
            }
        }
    </script>
@endsection

@endsection