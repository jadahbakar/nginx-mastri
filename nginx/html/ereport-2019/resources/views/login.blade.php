<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description" content="E-Report Pemerintah Kota Semarang, Keuangan Pemerintah Kota Semarang, Akuntansi, Pengeluaran, Penerimaan, Konsolidasi">
        <meta name="keywords" content="E-Report Pemerintah Kota Semarang, Keuangan Pemerintah Kota Semarang, Akuntansi, Pengeluaran, Penerimaan, Konsolidasi">
        <meta name="author" content="Visualmedia Semarang">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>E-Report Pemerintah Kota Semarang</title>
        <link rel="apple-touch-icon" href="{{ url('my-assets/gambar/logo-icon-120.png') }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ url('my-assets/gambar/logo-icon-128.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
        <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/vendors.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/vendors/css/forms/icheck/icheck.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/vendors/css/forms/icheck/custom.css') }}">
        <!-- END VENDOR CSS-->
        <!-- BEGIN MODERN CSS-->
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/app.css') }}">
        <!-- END MODERN CSS-->
        <!-- BEGIN Page Level CSS-->
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/core/colors/palette-gradient.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/pages/login-register.css') }}">
        <!-- END Page Level CSS-->
        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ url('modern/assets/css/style.css') }}">
        <!-- END Custom CSS-->
    </head>
    <body class="horizontal-layout horizontal-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row"></div>
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="col-md-4 col-10 box-shadow-2 p-0">
                                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                                    <div class="card-header border-0">
                                        <div class="card-title text-center">
                                            <img src="{{ url('my-assets/gambar/logo-login-2.png') }}" alt="branding logo">
                                        </div>

                                        @if($errors->has('gagal'))
                                            <div class="alert alert-danger alert-dismissible mb-2" role="alert" style="margin-top: 10px;">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                     <span aria-hidden="true">&times;</span>
                                                </button>
                                                <strong>Opps gagal !</strong> {{ $errors->first('gagal') }}
                                            </div>
                                        @endif

                                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                            <span>Login Sosial Media</span>
                                        </h6>
                                    </div>
                                    <div class="card-content">
                                        <div class="text-center">
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-google">
                                                <span class="la la-google"></span>
                                            </a>
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-facebook">
                                                <span class="la la-facebook"></span>
                                            </a>
                                            <a href="#" class="btn btn-social-icon mr-1 mb-1 btn-outline-twitter">
                                                <span class="la la-twitter"></span>
                                            </a>
                                        </div>
                                        <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                                            <span>Atau Akun Personal</span>
                                        </p>
                                        <div class="card-body">
                                            {!! Form::open(['id'=>'form-login', 'method'=>'POST', 'url'=>'/login', 'class'=>'form-horizontal']) !!}
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    {!! Form::text('kode_pengguna', null, ['class'=>'form-control', 'placeholder'=>'Inputkan Kode Pengguna']) !!}
                                                    <div class="form-control-position">
                                                        <i class="ft-user"></i>
                                                    </div>
                                                </fieldset>
                                                <fieldset class="form-group position-relative has-icon-left">
                                                    {!! Form::password('password', ['class'=>'form-control', 'placeholder'=>'Inputkan Password']) !!}
                                                    <div class="form-control-position">
                                                        <i class="la la-key"></i>
                                                    </div>
                                                </fieldset>
                                                <div class="form-group row">
                                                    <div class="col-md-6 col-12 text-center text-sm-left">
                                                        <fieldset>
                                                            <input type="checkbox" name="remember" id="remember-me" class="chk-remember">
                                                            <label for="remember-me"> Remember Me</label>
                                                        </fieldset>
                                                    </div>
                                                    {{-- <div class="col-md-6 col-12 float-sm-left text-center text-sm-right"><a href="recover-password.html" class="card-link">Forgot Password?</a></div> --}}
                                                </div>
                                                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i> Login</button>
                                            {!! Form::close() !!}  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- ////////////////////////////////////////////////////////////////////////////-->
        <!-- BEGIN VENDOR JS-->
        <script src="{{ url('modern/app-assets/vendors/js/vendors.min.js') }}" type="text/javascript"></script>
        <!-- BEGIN VENDOR JS-->
        <!-- BEGIN PAGE VENDOR JS-->
        <script type="text/javascript" src="{{ url('modern/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
        <script type="text/javascript" src="{{ url('modern/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
        <script src="{{ url('modern/app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
        <script src="{{ url('modern/app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
        <!-- END PAGE VENDOR JS-->
        <!-- BEGIN MODERN JS-->
        <script src="{{ url('modern/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
        <script src="{{ url('modern/app-assets/js/core/app.js') }}" type="text/javascript"></script>
        <!-- END MODERN JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <script type="text/javascript" src="{{ url('modern/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}"></script>
        <script src="{{ url('modern/app-assets/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL JS-->

        <!--Validate-->
        <script src="{{ asset('my-assets/plugins/jquery-validation-1.15.1/dist/jquery.validate.js') }}"></script>
        <script src="{{ asset('my-assets/plugins/jquery-validation-1.15.1/dist/additional-methods.js') }}"></script>

        <script type="text/javascript">
            $(document).ready(function() {  
                $("#form-login").validate({
                    rules: {
                        kode_pengguna: "required",
                        password: "required"
                    },
                    messages: {
                        kode_pengguna: "Kolom kode pengguna harus diisi",
                        password: "Kolom password harus diisi"
                    }
                });
            });
        </script>
    </body>
</html>