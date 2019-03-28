</div>
</div>
</div>
</div>
</div>
</div>

<div id="exampleModalLive" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 1200px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel"> معنى الكلمة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <div id="asd">

                </div>
            </div>
        </div>
    </div>
</div>
<!-- /#wrapper -->
<!-- Bootstrap core JavaScript -->


<script src="{{asset('public/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{asset('public/js/vendor-all.min.js')}}"></script>
<script src="{{asset('public/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/js/pcoded.min.js')}}"></script>
<script src="{{asset('public/js/horizontal-menu.js')}}"></script>
<script src="{{asset('public/js/menu-setting.min.js')}}"></script>
<script src="{{asset('public/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('public/plugins/sweetalert/js/sweetalert.min.js')}}"></script>
@yield('js')
<!-- Menu Toggle Script -->
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=5g5faf78gvk6yfq9bd3bbfjo858kjx1q8o0nbiwtygo2e4er"></script>
<!-- New code -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.sweet-basic').on('click', function () {
            swal('Hello world!');
        });
        $('.sweet-success').on('click', function () {
            swal("Good job!", "You clicked the button!", "success");
        });
        $('.sweet-warning').on('click', function () {
            swal("Good job!", "You clicked the button!", "warning");
        });
        $('.sweet-error').on('click', function () {
            swal("Good job!", "You clicked the button!", "error");
        });
        $('.sweet-info').on('click', function () {
            swal("Good job!", "You clicked the button!", "info");
        });
    });
</script>

<!-- New code -->
<script>

    $("#menu-toggle").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    editor();

    function editor() {
        tinymce.init({
            mode: "specific_textareas",
            editor_selector: 'mceEditor',
            height: "480",
            paste_as_text: true,
            language_url: '{{url('public/js/langs/ar.js')}}',
            language: "ar",
            directionality: "rtl",
            fontsize_formats: "8pt 10pt 12pt 14pt 18pt 24pt 36pt",
            plugins: ['print  preview  searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help', "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern table wordcount"],
            toolbar1: 'ltr rtl | ContentSeperator  | formatselect | bold italic strikethrough forecolor backcolor | image link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat',

            // toolbar2: "sizeselect | bold italic | fontselect |  fontsizeselect ",
            paste_data_images: true,
            image_advtab: true,
            file_picker_callback: function (callback, value, meta) {
                if (meta.filetype == 'image') {
                    $('#upload').trigger('click');
                    $('#upload').on('change', function () {
                        var file = this.files[0];
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            callback(e.target.result, {
                                alt: ''
                            });
                        };
                        reader.readAsDataURL(file);
                    });
                }
            },

        });
    }

    (function () {
        if ($('#layout-sidenav').hasClass('sidenav-horizontal') || window.layoutHelpers.isSmallScreen()) {
            return;
        }
        try {
            window.layoutHelpers.setCollapsed(
                localStorage.getItem('layoutCollapsed') === 'true',
                false
            );
        } catch (e) {
        }
    })();
    $(function () {
        // Initialize sidenav
        $('#layout-sidenav').each(function () {
            new SideNav(this, {
                orientation: $(this).hasClass('sidenav-horizontal') ? 'horizontal' : 'vertical'
            });
        });

        // Initialize sidenav togglers
        $('body').on('click', '.layout-sidenav-toggle', function (e) {
            e.preventDefault();
            window.layoutHelpers.toggleCollapsed();
            if (!window.layoutHelpers.isSmallScreen()) {
                try {
                    localStorage.setItem('layoutCollapsed', String(window.layoutHelpers.isCollapsed()));
                } catch (e) {
                }
            }
        });
    });
    $(document).ready(function () {
        $("#pcoded").pcodedmenu({
            themelayout: 'horizontal',
            MenuTrigger: 'hover',
            SubMenuTrigger: 'hover',
        });


    });
</script>
<script>

    $('body').bind("contextmenu", function (e) {
        e.preventDefault();

        var top = e.pageY - 120;
        $("#cntnr").css("left", e.pageX);
        $("#cntnr").css("top", top);
        // $("#cntnr").hide(100);
        $("#cntnr").fadeIn(200, startFocusOut());


    });

    function startFocusOut() {
        $(document).on("click", function () {
            $("#cntnr").hide();
            $(document).off("click");
        });
        $(window).scroll(function () {
            $('#cntnr').fadeOut();
        })
    }


    $("#items > li").click(function () {
        $("#op").text("You have selected " + $(this).text());
    });

</script>

<script>
    if (!window.x) {
        x = {};
    }
    x.Selector = {};
    x.Selector.getSelected = function () {
        var t = '';
        if (window.getSelection) {
            t = window.getSelection();
        } else if (document.getSelection) {
            t = document.getSelection();
        } else if (document.selection) {
            t = document.selection.createRange().text;
        }
        return t;
    }

    function a() {

        var mytext = x.Selector.getSelected();
        $.ajax({
            type: "GET",
            url: "http://www.analyzer.ga:8082/WebApplication1/faces/Api.xhtml?pram=" + encodeURIComponent(mytext),
            crossDomain: true,
            async: true,
            success: function (data) {

                $("#asd").html(data);
                $("#exampleModalLive").modal();
            }
        });
    }

</script>
<script>
    $(document).mouseup(function (e) {
        var container = $("#hiddenDiv");
        var container2 = $("#hiddenDivUser");

        // if the target of the click isn't the container nor a descendant of the container
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            container.hide();
        }
        if (!container2.is(e.target) && container2.has(e.target).length === 0) {
            container2.hide();
        }
    });

</script>
</body>
</html>