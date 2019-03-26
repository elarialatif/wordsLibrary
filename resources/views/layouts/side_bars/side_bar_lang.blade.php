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
        <div class="navbar-content sidenav-horizontal" id="layout-sidenav">
            <ul class="nav pcoded-inner-navbar sidenav-inner">
                <li class="nav-item {{request()->is("home")?"active":""}}">
                    <a href="{{url('/')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">الرئيسية</span></a>
                </li>
                <li class="nav-item {{request()->is("languestic")?"active":""}}">
                    <a href="{{url('languestic')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="mdi mdi-file"></i></span>
                        <span class="pcoded-mtext">موضوعات جديدة </span></a>
                </li>
                <li class="nav-item {{request()->is("languestic/myList")?"active":""}}">
                    <a href="{{url('languestic/myList')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">موضوعاتى </span></a>
                </li>
                <li class="nav-item {{request()->is("languestic/resend")?"active":""}}">
                    <a href="{{url('languestic/resend')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">موضوعات معادة</span></a>
                </li>
                <li class="nav-item {{request()->is("userArchive")?"active":""}}">
                    <a href="{{url('userArchive')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="mdi mdi-chart-donut-variant"></i></span>
                        <span class="pcoded-mtext">الأرشيف</span></a>
                </li>
                <li class="nav-item {{request()->is("/tashkel")?"active":""}}">
                    <a href="{{url('/tashkel')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-home"></i></span>
                        <span class="pcoded-mtext">تشكيل</span></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

