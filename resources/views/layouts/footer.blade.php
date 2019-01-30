</div>
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
            plugins: ['print  preview fullpage searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount imagetools contextmenu colorpicker textpattern help', "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern table wordcount"],
            toolbar1: 'ltr rtl | ContentSeperator | fullscreen | formatselect | bold italic strikethrough forecolor backcolor | image link | alignleft aligncenter alignright alignjustify | numlist bullist outdent indent | removeformat',

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

</body>
</html>