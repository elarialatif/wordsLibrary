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
                <div class="dropdown"  id="notify" >

                    </div>

            </li>
            <li>
                <div class="dropdown drp-user">

                    <a id="showUser" onclick="showUser()"  ><span
                                id="count"> </span> <i class="icon feather icon-settings"></i><i
                                class="fa fa-angle-down"></i></a>
                    <div id="hiddenDivUser" style="display: none" class="dropdown-menu dropdown-menu-right profile-notification showUser">
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

    {{--var message, ShowDiv = $('#showNofication'), count = $('#count'), c;--}}
    {{--var slh = new StreamLabHtml();--}}
    {{--var sls = new StreamLabSocket({--}}
        {{--appId: "{{ config('stream_lab.app_id') }}",--}}
        {{--channelName: "test",--}}
        {{--event: "*"--}}
    {{--});--}}
    {{--sls.socket.onmessage = function (res) {--}}
        {{--slh.setData(res);--}}
        {{--// $('#note').empty();--}}
        {{--if (slh.getSource() === 'messages') {--}}

            {{--message = slh.getMessage();--}}
            {{--console.log(message);--}}
            {{--if (message.indexOf({{auth()->id()}}) != -1) {--}}
                {{--c = parseInt(count.html());--}}
                {{--count.html(c + 1);--}}

                {{--slh.append('newNote', '<li>' +--}}
                    {{--'<div class="media-body unread">\n' +--}}

                    {{--' <p>' +--}}
                    {{--message[message.length - 1] +--}}
                    {{--'</p>\n' +--}}

                    {{--'</div>'--}}
                    {{--+ '</li>')--}}
            {{--}--}}

        {{--}--}}
    {{--}--}}
function showUser(){
        $('#hiddenDiv').css('display','none');
        $('#hiddenDivUser').toggle();
    }
    function test() {
        $('#hiddenDivUser').css('display','none');

        var li = $("#note li");
        $("#showall").html('إظهار الكل');
        li.slice(8, li.length).css("display", "none");
        // setTimeout(function () {
        //     count.html(0);
        //     $('.unread').each(function () {
        //         $(this).removeClass('unread');
        //     });
        // }, 5000);
        $.get('{{url('MarkAllSeen')}}', function () {
        });
        $("#test").remove();
        $('#hiddenDiv').toggle();
        if($('#hiddenDiv').css('display')=='block'){
            clearTimeout(time);
        }else{
            time=setTimeout(function() {
                $('#notify').load("{{url('notify')}}");
            }, 10000);
        }
    }



    setTimeout(function() {
       $('#notify').load("{{url('notify')}}");
       }, 1000);
</script>