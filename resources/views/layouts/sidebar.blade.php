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
                <li class="nav-item {{request()->is("users")?"active":""}}">
                    <a href="{{url('users')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-address-card"></i></span>
                        <span class="pcoded-mtext">المستخدمين</span>
                    </a>
                </li>
                <li class="nav-item {{request()->is("allLists")?"active":""}}">
                    <a href="{{url('allLists')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="fas fa-book-open"></i></span>
                        <span class="pcoded-mtext"> قائمة الموضوعات</span>
                    </a>
                </li>
                <li class="nav-item {{request()->is("levels")?"active":""}}">
                    <a href="{{url('levels')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="feather icon-layers"></i></span>
                        <span class="pcoded-mtext">المراحل</span>
                    </a>
                </li>

                <li class="nav-item {{request()->is("allWords")?"active":""}}">
                    <a href="{{url('allWords')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="mdi mdi-all-inclusive"></i></span>
                        <span class="pcoded-mtext">كل الكلمات</span>
                    </a>
                </li>
                <li class="nav-item {{request()->is("allFiles")?"active":""}}">
                    <a href="{{url('allFiles')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="mdi mdi-file"></i></span>
                        <span class="pcoded-mtext">ملفات المواضيع</span>
                    </a>
                </li>
                {{--<li class="nav-item {{request()->is("country")?"active":""}}">--}}
                    {{--<a href="{{url('country')}}" class="nav-link">--}}
                        {{--<span class="pcoded-micon"><i class="fas fa-flag"></i></span>--}}
                        {{--<span class="pcoded-mtext">الدول</span>--}}
                    {{--</a>--}}
                {{--</li>--}}
                <li class="nav-item {{request()->is("categories")?"active":""}}">
                    <a href="{{url('categories')}}" class="nav-link">
                        <span class="pcoded-micon"><i class="mdi mdi-chart-donut-variant"></i></span>
                        <span class="pcoded-mtext">التصنيفات</span>
                    </a>
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

