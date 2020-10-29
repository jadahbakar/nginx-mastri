<!-- BEGIN VENDOR JS-->
<script src="{{ url('modern/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
<!-- BEGIN VENDOR JS-->
<!-- BEGIN PAGE VENDOR JS-->
<script type="text/javascript" src="{{ url('modern/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script type="text/javascript" src="{{ url('modern/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ url('modern/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/vendors/js/timeline/horizontal-timeline.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/vendors/js/extensions/sweetalert.min.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/vendors/js/pickers/dateTime/moment-with-locales.min.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/vendors/js/pickers/daterange/daterangepicker.js') }}" type="text/javascript"></script>
<!-- END PAGE VENDOR JS-->
<!-- BEGIN MODERN JS-->
<script src="{{ url('modern/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ url('modern/app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
<!-- END MODERN JS-->
<!-- BEGIN PAGE LEVEL JS-->
<script type="text/javascript" src="{{ url('modern/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}"></script>
{{-- <script src="{{ url('modern/app-assets/js/scripts/pages/dashboard-ecommerce.js') }}" type="text/javascript"></script> --}}
{{-- <script src="{{ url('modern/app-assets/js/scripts/tables/components/table-components.js') }}" type="text/javascript"></script> --}}
<!-- END PAGE LEVEL JS-->

<!--Validate-->
<script src="{{ asset('my-assets/plugins/jquery-validation-1.15.1/dist/jquery.validate.js') }}"></script>
<script src="{{ asset('my-assets/plugins/jquery-validation-1.15.1/dist/additional-methods.js') }}"></script>

<!--mask money-->
<script src="{{ asset('my-assets/plugins/numeral-js/src/numeral.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.1.1/socket.io.js"></script>
<script type="text/javascript">
	@if(env('APP_ENV') == 'production')
		var socket = io();
	@else
		var socket = io('192.168.10.10:3000');
	@endif

	$(".select2").select2();
	$('.singledate').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		locale: {
			format: 'DD-MM-Y'
		}
	});

	function findAndReplace(string, target, replacement) {
	    var i = 0, length = string.length;
	    for (i; i < length; i++) {
	        string = string.replace(target, replacement);
	    }
	    return string;
	}

	function mataUang(form){
		var nilai = $('#'+form).val();
		nilai = nilai.replace(/\./g, '');
		var string = numeral(nilai).format('(0,0)').replace(/,/g, '.');
		$('#'+form).val(string);
	}

	$.validator.setDefaults({
	    highlight: function(element) {
	        $(element).closest('.form-group').addClass('has-error');
	        $(element).closest('.form-control').addClass('error');
	    },
	    unhighlight: function(element) {
	        $(element).closest('.form-group').removeClass('has-error');
	        $(element).closest('.form-control').removeClass('error');
	    },
	    errorElement: 'label',
	    errorClass: 'error',
	    errorPlacement: function(error, element) {
	        if(element.parent('.input-group').length) {
	            error.insertAfter(element.parent());
	        } else {
	            error.insertAfter(element);
	        }
	    }
	});

	$().ready(function() {
	    //Confirm Message
	    $('table button.btn-danger').on('click', function(e){
	        e.preventDefault();
	        var $self = $(this);
	        swal({
			    title: "Data yakin dihapus ?",
			    text: "Mohon diteliti sebelum menghapus data",
			    icon: "warning",
			    buttons: {
			    	confirm: {
	                    text: "Hapus",
	                    value: true,
	                    visible: true,
	                    className: "btn-danger",
	                    closeModal: true
	                },
	                cancel: {
	                    text: "Batal",
	                    value: null,
	                    visible: true,
	                    className: "btn-secondary",
	                    closeModal: true,
	                }
			    }
			}).then(isConfirm => {
			    if (isConfirm) {
			        $self.parents(".delete_form").submit();
			    }
			});
        });

        $('.icheck1 input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
        });
    });

	$.ajaxSetup({
	    headers:{
	        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
	    }
	});
</script>
