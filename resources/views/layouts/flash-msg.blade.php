@if (Session::has('success'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('success') }}", "success");
        }
    </script>
    @php
        session()->forget('success');
    @endphp
@endif

@if (Session::has('error'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('error') }}", "error");
        }
    </script>
    @php
        session()->forget('error');
    @endphp
@endif
@if (Session::has('info'))
    <script>
        window.onload = function () {
            swal("", "{{ Session::get('info') }}", "info");
        }
    </script>
    @php
        session()->forget('error');
    @endphp
@endif

@if ($errors->any())
    <script>
        window.onload = function () {
            swal("", "<?php
                    foreach ($errors->all() as $error) {
                        echo $error . '\n';
                    }
                    ?>",
                "error");
        }
    </script>
@endif

