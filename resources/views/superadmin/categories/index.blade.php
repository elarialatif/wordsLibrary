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
                                        صفحة التصنيفات
                                    </h5>
                                    <a data-toggle="modal" data-target="#exampleModal" class="btn btn-primary"
                                       style="color: white;float: left;font-weight: bold">إضافة تصنيف
                                        جديد<i
                                                class="fa fa-plus"></i></a>
                                    {{--model for add new user--}}
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            {{ Form::open(array('url' => 'categories')) }}
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">إضافة تصنيف
                                                        جديد</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="name" class="col-form-label">اسم التصنيف</label>
                                                        <div class="col-md-6 {{ $errors->has('name') ? 'has-error' : ''}}">
                                                            <input class="form-control" name="name" type="text" value=""
                                                                   id="name" required minlength="4">
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="parent_id">التصنيفات</label>
                                                        <div class="col-md-6">
                                                            <select class="form-control " name="parent_id">
                                                                <option value=""> تصنيف رئيسى</option>
                                                                @foreach($categories_all as $parent)
                                                                    @if($parent->parent_id==null)
                                                                        <option value="{{$parent->id}}">
                                                                            &#10000; {{$parent->name}}  </option>

                                                                        @if ($parent->children->count())
                                                                            @foreach ($parent->children as $child)

                                                                                <option value="{{ $child->id }}"> &emsp;
                                                                                    &#9000;
                                                                                    &#9000; {{ $child->name }}</option>
                                                                                @if($child->children->count())
                                                                                    @foreach ($child->children as $child)

                                                                                        <option value="{{ $child->id }}">
                                                                                            &emsp; &nbsp; &nbsp; &#9000;&#9000;&#9000; {{ $child->name }}</option>
                                                                                        @if($child->children->count())
                                                                                            @foreach ($child->children as $child)

                                                                                                <option value="{{ $child->id }}">
                                                                                                    &emsp; &nbsp; &nbsp;&nbsp;&nbsp;
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
                                                        </div>
                                                    </div>


                                                </div>
                                                <div class="modal-footer">
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            {{ Form::button('حفظ <i class="fas fa-caret-left"></i>', ['type' => 'submit', 'class' => 'btn btn-primary pull-left'] ) }}
                                                            {{ Form::close() }}
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">غلق
                                                    </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-8 col-md-8 col-sm-12">
                                            <div class="dd" id="nestable">
                                                <ol class="dd-list">
                                                @foreach($categories_all as $parent)
                                                    @if($parent->parent_id==null)
                                                            <li class="dd-item" data-id="{{$parent->id}}">
                                                                <div class="dd3-content"
                                                                     style="padding: 3px 10px 5px 40px;">{{$parent->name}}
                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a  href="{{"categories"}}/{{$parent->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                    </div>
                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$parent->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                    </div>
                                                                </div>

                                                            @if ($parent->children->count())
                                                                @foreach ($parent->children as $child)
                                                                    <ol class="dd-list"style="margin-right: 45px;width: 97.2%;">
                                                                        <li class="dd-item"
                                                                            data-id="{{$child->id}}">
                                                                            <div class="dd3-content"
                                                                                 style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                </div>
                                                                                <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                </div>
                                                                            </div>

                                                                        @if($child->children->count())
                                                                            @foreach ($child->children as $child)
                                                                                    <ol class="dd-list"style="margin-right: 45px;width: 96.8%;">
                                                                                    <li class="dd-item"
                                                                                        data-id="{{$child->id}}">
                                                                                        <div class="dd3-content"
                                                                                             style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                            <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                            </div>
                                                                                            <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                            </div>
                                                                                        </div>

                                                                                    @if($child->children->count())
                                                                                        @foreach ($child->children as $child)
                                                                                                <ol class="dd-list"style="margin-right: 45px;width: 96.8%;">
                                                                                                <li class="dd-item"
                                                                                                    data-id="{{$child->id}}">
                                                                                                    <div class="dd3-content"
                                                                                                         style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                        <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                        </div>
                                                                                                        <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @if($child->children->count())
                                                                                                    @foreach ($child->children as $child)
                                                                                                            <ol class="dd-list"style="margin-right: 45px;width: 96.8%;">
                                                                                                            <li class="dd-item"
                                                                                                                data-id="{{$child->id}}">
                                                                                                                <div class="dd3-content"
                                                                                                                     style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                                    </div>
                                                                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                                    </div>
                                                                                                                </div>

                                                                                                            @if($child->children->count())
                                                                                                                @foreach ($child->children as $child)
                                                                                                                        <ol class="dd-list"style="margin-right: 45px;width: 96.8%;">
                                                                                                                        <li class="dd-item"
                                                                                                                            data-id="{{$child->id}}">
                                                                                                                            <div class="dd3-content"
                                                                                                                                 style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                                                <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                                                </div>
                                                                                                                                <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                                                </div>
                                                                                                                            </div>

                                                                                                                        @if($child->children->count())
                                                                                                                            @foreach ($child->children as $child)
                                                                                                                                <ol class="dd-list">
                                                                                                                                    <li class="dd-item"
                                                                                                                                        data-id="{{$child->id}}">
                                                                                                                                        <div class="dd3-content"
                                                                                                                                             style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                                                            <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                                                            </div>
                                                                                                                                            <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                                                            </div>
                                                                                                                                        </div>
                                                                                                                                    @if($child->children->count())
                                                                                                                                        @foreach ($child->children as $child)
                                                                                                                                            <ol class="dd-list">
                                                                                                                                                <li class="dd-item"
                                                                                                                                                    data-id="{{$child->id}}">
                                                                                                                                                    <div class="dd3-content"
                                                                                                                                                         style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                                                                        <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                                                                        </div>
                                                                                                                                                        <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                @if($child->children->count())
                                                                                                                                                    @foreach ($child->children as $child)
                                                                                                                                                        <ol class="dd-list">
                                                                                                                                                            <li class="dd-item"
                                                                                                                                                                data-id="{{$child->id}}">
                                                                                                                                                                <div class="dd3-content"
                                                                                                                                                                     style="padding: 3px 10px 5px 40px;">{{$child->name}}
                                                                                                                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #f44236;
                                                                border-color: #f44236;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{"categories"}}/{{$child->id}}/delete"
                                                                                                             class="fa fa-trash"
                                                                                                             style="color: white"> </a>
                                                                                                                                                                    </div>
                                                                                                                                                                    <div style="float: left;margin-left: 2px;font-size: 16px;color: #fff;background-color: #1de9b6;
                                                                border-color: #1de9b6;padding: 1px 6px 2px;text-align: center;vertical-align: top;
                                                                margin-bottom: -1px;border-radius: 5px; "><a href="{{url("categories")}}/{{$child->id}}/edit"
                                                                                                             class="fas fa-edit"
                                                                                                             style="color: white"></a>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                            </li>
                                                                                                                                                        </ol>
                                                                                                                                                    @endforeach
                                                                                                                                                @endif
                                                                                                                                                    </li>

                                                                                                                                            </ol>
                                                                                                                                        @endforeach
                                                                                                                                    @endif
                                                                                                                                        </li>

                                                                                                                                </ol>
                                                                                                                            @endforeach
                                                                                                                        @endif
                                                                                                                            </li>

                                                                                                                    </ol>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                                </li>

                                                                                                        </ol>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                                    </li>

                                                                                            </ol>
                                                                                        @endforeach
                                                                                    @endif
                                                                                        </li>

                                                                                </ol>
                                                                            @endforeach
                                                                        @endif
                                                                        </li>

                                                                    </ol>
                                                                @endforeach

                                                            @endif
                                                            @endif
                                                            </li>
                                                        @endforeach
                                                        </ol>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-block">
                                <div class="table-responsive">
                                    <table id="key-act-button"
                                           class="display table nowrap table-striped table-hover"
                                           style="width:100%">

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
    <script type="text/javascript">
        $(window).on('load', function () {
            var updateOutput = function (e) {
                var list = e.length ? e : $(e.target),
                    output = list.data('output');
                if (window.JSON) {
                    output.val(window.JSON.stringify(list.nestable('serialize')));
                } else {
                    output.val('JSON browser support required for this demo.');
                }
            };

            // activate Nestable for list 1
            $('#nestable').nestable({
                group: 1
            })
                .on('change', updateOutput);

            // activate Nestable for list 2
            $('#nestable2').nestable({
                group: 1
            })
                .on('change', updateOutput);
            // activate Nestable for list 3
            $('#nestable3').nestable({
                group: 1
            })
                .on('change', updateOutput);

            // output initial serialised data
            updateOutput($('#nestable').data('output', $('#nestable-output')));
            updateOutput($('#nestable2').data('output', $('#nestable2-output')));
            updateOutput($('#nestable3').data('output', $('#nestable3-output')));

            $('#nestable-menu').on('click', function (e) {
                var target = $(e.target),
                    action = target.data('action');
                if (action === 'expand-all') {
                    $('.dd').nestable('expandAll');
                }
                if (action === 'collapse-all') {
                    $('.dd').nestable('collapseAll');
                }
            });

            $('#nestable3').nestable();
        });
    </script>
    <script src="{{asset('public/plugins/nestable-master/js/jquery.nestable.js')}}"></script>

@endsection
@endsection