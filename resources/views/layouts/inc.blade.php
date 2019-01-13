<div id="sidebar-wrapper">
    <ul class="sidebar-nav">
        <br>
        <li class="sidebar-brand">
            <a href="#">
                <img src="{{url('public/images/logow.png')}}" width="150">
            </a>
        </li>
        <br> <br>
        <li>
            <a href="index.html">الرئيسية</a>
        </li>

        <li>
            <a href="#">الدعم</a>
        </li>
        <li>
            <a href="#">أسئلة شائعة</a>
        </li>


    </ul>
</div>


<script>
    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>