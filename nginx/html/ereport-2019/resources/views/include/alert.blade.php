@if(Session::has('pesanSukses'))
    <script type="text/javascript">
        function codeAddress() {
            //Success Message
		    swal("Berhasil !", "{{ Session::get('pesanSukses') }}", "success")
        }
        window.onload = codeAddress;
    </script>
@endif

@if(Session::has('pesanError'))
    <script type="text/javascript">
        function codeAddress() {
            //Success Message
		    swal("Gagal !", "{{ Session::get('pesanError') }}", "error")
        }
        window.onload = codeAddress;
    </script>
@endif

