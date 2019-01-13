<div class="loader-bg">
    <div class="loader-track">
        <div class="loader-fill"></div>
    </div>
</div>
<!-- [ Pre-loader ] End -->
<style>
    .unread {
        background-color: #cfdae3;
    }
</style>
<!-- [ navigation menu ] start -->
<nav class="pcoded-navbar theme-horizontal">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo">
            <a href="{{url('home')}}" class="b-brand">
                <div class="b-bg">
                    <i class="feather icon-trending-up"></i>
                </div>
                <span class="b-title">برمجيات القراءة</span>
            </a>
            <a class="mobile-menu" id="mobile-collapse" href="javascript:"><span></span></a>
        </div>
    </div>
</nav>


<!-- [ navigation menu ] end -->

<!-- [ Header ] start -->
<header class="navbar pcoded-header navbar-expand-lg navbar-light">
    <div class="m-header">
        <a class="mobile-menu" id="mobile-collapse1" href="javascript:"><span></span></a>
        <a href="{{url('home')}}" class="b-brand">
            <div class="b-bg">
                <i class="feather icon-trending-up"></i>
            </div>
            <span class="b-title">برمجيات القراءة</span>
        </a>
    </div>
    <a class="mobile-menu" id="mobile-header" href="javascript:">
        <i class="feather icon-more-horizontal"></i>
    </a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li><a href="javascript:" class="full-screen" onclick="javascript:toggleFullScreen()"><i
                            class="feather icon-maximize"></i></a></li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="javascript:" data-toggle="dropdown" onclick="test()"><span
                                id="count"> @php
                                $notify=auth()->user()->notifications;

 $grouped = $notify->where('read_at',null);

                            @endphp {{$grouped->count()}}</span><i
                                class="icon feather icon-bell"></i></a>
                    <div class="dropdown-menu dropdown-menu-right notification">
                        <div class="noti-head">
                            <h6 class="d-inline-block m-b-0">الاشعارات</h6>
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
                </div>
            </li>
            <li>
                <div class="dropdown drp-user">
                    <a href="javascript:" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="icon feather icon-settings"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-notification">
                        <div class="pro-head">
                            <a href="{{url('profile')}}"  >
                                @if(auth()->user()->img !=null)
                            <img src="{{asset('public/images/user/'.auth()->user()->img.'.jpg')}}" class="img-radius"
                                 alt="User-Profile-Image">
                                @endif
                            <span> @if(auth()->check()) {{auth()->user()->name}}
                                @else
                                    زائر
                                @endif</span>
                            </a>
                        </div>
                        <ul class="pro-body">
                            @if (auth()->check())
                                <li><a href="{{url('logout')}}" class="dropdown-item"><i
                                                class="feather icon-log-out"></i> تسجيل خروج </a></li>
                            @else
                                <li><a href="{{url('login')}}" class="dropdown-item"><i
                                                class="feather icon-log-out"></i> تسجيل دخول </a></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</header>
<!-- [ Header ] end -->

<script src="{{asset('public/StreamLab/StreamLab.js')}}"></script>

<script>

    var message, ShowDiv = $('#showNofication'), count = $('#count'), c;
    var slh = new StreamLabHtml();
    var sls = new StreamLabSocket({
        appId: "{{ config('stream_lab.app_id') }}",
        channelName: "test",
        event: "*"
    });
    sls.socket.onmessage = function (res) {
        slh.setData(res);
        // $('#note').empty();
        if (slh.getSource() === 'messages') {

            message = slh.getMessage();
            console.log(message);
            if (message.indexOf({{auth()->id()}}) != -1) {
                c = parseInt(count.html());
                count.html(c + 1);

                slh.append('newNote', '<li>' +
                    '<div class="media-body unread">\n' +

                    ' <p>' +
                    message[message.length - 1] +
                    '</p>\n' +

                    '</div>'
                    + '</li>')
            }

        }
    }

    function test() {
        var li = $("#note li");
        $("#showall").html('إظهار الكل');
        li.slice(8, li.length).css("display", "none");
        setTimeout(function () {
            count.html(0);
            $('.unread').each(function () {
                $(this).removeClass('unread');
            });
        }, 5000);
        $.get('{{url('MarkAllSeen')}}', function () {
        });
        $("#test").remove();
    }

    $("#showall").hover(function (event) {
        $("#showall").empty();
        var li = $("#note li");
        li.slice(0, li.length).css("display", "block");
    });


</script>