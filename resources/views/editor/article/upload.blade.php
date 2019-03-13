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
                                        رفع ملف
                                    </h5>

                                </div>
                                <div class="card-block">
                                    <div class="table-responsive">

                                        <form action="{{url('saveUploadArticle')}}" method="post"
                                              enctype="multipart/form-data">
                                            {{csrf_field()}}
                                            <div id="page-content-wrapper">
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="jumbotron">
                                                            <h6><img src="{{url('public/images/1.png')}}" width="40px">
                                                                من فضلك قم برفع الملف</h6><br>
                                                            <form method="post" action="#" id="#">
                                                                <div class="form-group files">
                                                                    <label for="addFileNameToEmptyDiv"
                                                                           style="border-style: dotted;height: 400px;width:100%; background-color: white">
                                                                        <div style="text-align: center;margin-top: 50px;font-size: 200px;color: #6c757d">
                                                                            <i class="feather icon-upload"></i>
                                                                        </div>
                                                                        <div style="text-align: center;margin-top: 5px;font-size: 22px;color: #6c757d">
                                                                            <span style="font-weight: bold">لرفع الملف اضغط هنا</span>
                                                                        </div>
                                                                    </label>
                                                                    <input type="file" id="addFileNameToEmptyDiv" class="form-control"
                                                                           multiple="" style="display: none;"
                                                                           name="filename" accept=".doc,.docx,.txt"> <h4
                                                                            id="empty"></h4>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="jumbotron">
                                                            <h6><img src="{{url('public/images/2.png')}}" width="40px">
                                                                التصنيف </h6>
                                                            <div class="form-group">
                                                                <label for="sel1"> </label>
                                                                <select name="cat_id_list[]" multiple=""
                                                                        class=" form-control ui fluid dropdown"
                                                                        id="sell">
                                                                    @foreach($categories_all as $parent)
                                                                        @if($parent->parent_id==null)
                                                                            <option value="{{$parent->id}}">
                                                                                &#10000; {{$parent->name}}  </option>

                                                                            @if ($parent->children->count())
                                                                                @foreach ($parent->children as $child)

                                                                                    <option value="{{ $child->id }}">
                                                                                        &emsp;
                                                                                        &#9000;
                                                                                        &#9000; {{ $child->name }}</option>
                                                                                    @if($child->children->count())
                                                                                        @foreach ($child->children as $child)

                                                                                            <option value="{{ $child->id }}">
                                                                                                &emsp; &nbsp; &nbsp;
                                                                                                &#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                            @if($child->children->count())
                                                                                                @foreach ($child->children as $child)

                                                                                                    <option value="{{ $child->id }}">
                                                                                                        &emsp; &nbsp;
                                                                                                        &nbsp;&nbsp;&nbsp;
                                                                                                        &#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                                    @if($child->children->count())
                                                                                                        @foreach ($child->children as $child)

                                                                                                            <option value="{{ $child->id }}">
                                                                                                                &emsp;
                                                                                                                &nbsp;
                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                &#9000;&#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                                            @if($child->children->count())
                                                                                                                @foreach ($child->children as $child)

                                                                                                                    <option value="{{ $child->id }}">
                                                                                                                        &emsp;
                                                                                                                        &nbsp;
                                                                                                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                        &#9000;&#9000;&#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                                                    @if($child->children->count())
                                                                                                                        @foreach ($child->children as $child)

                                                                                                                            <option value="{{ $child->id }}">
                                                                                                                                &emsp;
                                                                                                                                &nbsp;
                                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                                &#9000;&#9000;&#9000;&#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                                                            @if($child->children->count())
                                                                                                                                @foreach ($child->children as $child)

                                                                                                                                    <option value="{{ $child->id }}">
                                                                                                                                        &emsp;
                                                                                                                                        &nbsp;
                                                                                                                                        &nbsp;
                                                                                                                                        &nbsp;&nbsp;&nbsp;
                                                                                                                                        &nbsp;&nbsp;&nbsp;
                                                                                                                                        &#9000;&#9000;&#9000;&#9000;&#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                                                                    @if($child->children->count())
                                                                                                                                        @foreach ($child->children as $child)

                                                                                                                                            <option value="{{ $child->id }}">
                                                                                                                                                &emsp;
                                                                                                                                                &nbsp;&emsp;
                                                                                                                                                &nbsp;
                                                                                                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                                                                                                &#9000;
                                                                                                                                                &#9000;&#9000;&#9000;&#9000;&#9000;&#9000;&#9000;&#9000; {{ $child->name }}</option>

                                                                                                                                        @endforeach
                                                                                                                                    @endif
                                                                                                                                @endforeach
                                                                                                                            @endif
                                                                                                                        @endforeach
                                                                                                                    @endif
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        @endforeach
                                                                                                    @endif
                                                                                                @endforeach
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif

                                                                                @endforeach

                                                                            @endif
                                                                        @endif

                                                                    @endforeach
                                                                </select>
                                                                <br>
                                                                <div class="form-group">
                                                                    <label> المؤلف</label>
                                                                    <input class="form-control" type="text"
                                                                           name="editor">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> اسم المقال</label>
                                                                    <input class="form-control" type="text"
                                                                           name="articleName">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> بيانات النشر</label>
                                                                    <input class="form-control" type="text"
                                                                           name="publish_details">
                                                                </div>
                                                                <div class="form-group">
                                                                    <label> المرجع</label>
                                                                    <input class="form-control" type="text"
                                                                           name="reference">
                                                                </div>
                                                                <input type="hidden" name="list_id"
                                                                       value="{{$list_id}}">

                                                                <div class="form-group">
                                                                    <label>الصوره:</label>
                                                                    <input type="file"
                                                                           class="form-control" name="image"
                                                                           placeholder="الصوره" required>

                                                                </div>
                                                                <div class="form-group">
                                                                    <label>صوره الدرس:</label>
                                                                    <input type="file"
                                                                           class="form-control" name="featureImage"
                                                                           placeholder="صوره الدرس" required>

                                                                </div>

                                                                <div class="form-group">
                                                                    <label>اسم اللينك:</label>
                                                                    <input type="text" required
                                                                           class="form-control" name="name[]"
                                                                           placeholder="اللينك">
                                                                    <label>اللينك:</label>
                                                                    <input type="url" required
                                                                           class="form-control" name="link[]"
                                                                           placeholder="اللينك">
                                                                </div>

                                                                <button class="btn btn-outline-info" id="btn"><i
                                                                            class="fa fa-plus"></i></button>
                                                                <div id="emptyLink">
                                                                </div>
                                                            </div>
                                                            <br><br><br><br><br>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary btn-block"
                                                        style="height: 56px !important;padding: 15px;"><span
                                                            class="fa fa-check-circle"></span> رفع الملف
                                                </button>

                                                <br>
                                                <br>
                                                <br>

                                        </form>
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
    <script src="{{ asset('public/js/jquery.min.js')}}"></script>
    <script src="{{ asset('public/plugins/data-tables/js/datatables.min.js')}}"></script>
    <script src="{{ asset('public/js/pages/tbl-datatable-custom.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.1.8/semantic.min.css">
    <script>
       // function  addFileNameToEmptyDiv() {
            $('#addFileNameToEmptyDiv').change(function (e) {
                var fileName = e.target.files[0].name;

                $('#empty').empty();
                $('#empty').html("تم اختيار " + fileName);
                $('#empty').css("color", "red");
            });
    //    }

    </script>
    <script>
        $('.ui.fluid.dropdown').dropdown();
        $('.item').css("text-align", "right");

        function lists() {
            $("#filter").click(function (event) {
                event.preventDefault();
            });
            $("#list_id").empty();
            $("#list_id").append('<option value="">اختر موضوع</option>');
            var garde_id = $('#grade_id').val();
            var country_id = $('#country_id').val();
            $.ajax({

                url: "{{url('Ajax/getLists')}}" + '/' + garde_id + '/' + country_id,
                type: "get",
            }).done(function (res) {
                if (res.length == 0) {
                    $("#list_id").empty();
                    $("#list_id").append('<option selected > لا توجد مواضيع</option>');
                }
                $.each(res, function (key, value) {
                    $("#list_id").append('<option  value="' + value.id + '">' + value.list + '</option>');
                });
            });
        }


    </script>
    <script>
        var i = 1;
        $("#btn").click(function (event) {
            event.preventDefault();
            $("#emptyLink").append("<div class='row' id='btn[" + i + "]' >" +
                "<div class = 'form-group' >" +
                "        <label>اسم اللينك:</label>\n" +
                "                                                                    <input  type=\"text\"\n" +
                "                                                                            class=\"form-control\" required name=\"name[]\"\n" +
                "                                                                            placeholder=\"اللينك\">" +
                "<label for= 'link' >  اللينك</label> " +
                "<input type = 'url' required class = 'form-control' id= 'link[]' placeholder = 'اللينك' name = 'link[]' >" +
                "</br>" +
                "<button class='btn btn-danger' id=\"btn[" + i + "]\" onclick='remove()'> حذف</button>" +
                "</div>" +
                "</div>"
            )
            ;
            i++;
        });

        function remove() {
            var id = event.target.id;
            var remove = document.getElementById(id);
            remove.remove();
        }
    </script>
@endsection

@endsection
