
<a id="showW" onclick="test()"><span
            id="count">@php
            $notify=auth()->user()->notifications;

$grouped = $notify->where('read_at',null);

        @endphp {{$grouped->count()}}</span><i
            class="icon feather icon-bell"></i><i
            class="fa fa-angle-down"></i></a>
<div id="hiddenDiv" style="display: none" class="dropdown-menu dropdown-menu-right notification" >
<div class="noti-head">
    <h6 class="d-inline-block m-b-0">الإشعارات</h6>
    {{--<div class="float-right">--}}
    {{--<a href="javascript:" class="m-r-10">تم الاطلاع علي الكل</a>--}}
    {{--<a href="javascript:">حذف الكل</a>--}}
    {{--</div>--}}
</div>
<ul class="noti-body" id="note">
    <li class="n-title">
        <div class="media" id="newNote">
        </div>
    </li>
    <?php  $i = 0;?>
    @foreach(auth()->user()->notifications as $note)
        <li class="notification">
            <div class="media @if ($note->read_at == null) unread @endif">

                <div class="media-body">
                    {{--<p><strong>محمد ابراهيم</strong><span class="n-time text-muted"><i class="icon feather icon-clock m-r-10"></i>30 min</span></p>--}}
                    <p>{!! $note->data['data'] !!}</p>

                </div>
            </div>
        </li>

        <?php  $i++;?>
    @endforeach
</ul>
<div class="noti-footer">
    <a  id="showall"></a>
</div>
</div>
<script>
    $("#showall").hover(function (event) {
        $("#showall").empty();
        var li = $("#note li");
        li.slice(0, li.length).css("display", "block");
    });
    var time;
    time=setTimeout(function() {
        $('#notify').load("{{url('notify')}}");
    }, 10000);
</script>