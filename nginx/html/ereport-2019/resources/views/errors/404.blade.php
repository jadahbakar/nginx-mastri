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
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/core/menu/menu-types/horizontal-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('modern/app-assets/css/pages/error.css') }}">
  <!-- END Page Level CSS-->
  <!-- BEGIN Custom CSS-->
  <link rel="stylesheet" type="text/css" href="{{ url('modern/assets/css/style.css') }}">
  <!-- END Custom CSS-->
</head>
<body class="horizontal-layout horizontal-menu 1-column   menu-expanded blank-page blank-page" data-open="hover" data-menu="horizontal-menu" data-col="1-column">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row"></div>
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-4 col-10 p-0">
                            <div class="card-header bg-transparent border-0">
                                <h2 class="error-code text-center mb-2">404</h2>
                                <h3 class="text-uppercase text-center">Halaman tidak ditemukan !</h3>
                            </div>
                            <div class="card-content">
                                <div class="row py-2">
                                    <div class="col-12">
                                        <a href="{{ url('beranda') }}" class="btn btn-primary btn-block"><i class="ft-home"></i> Kembali ke beranda</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="row">
                                    <p class="text-muted text-center col-12 py-1">© {{ \Carbon\Carbon::now()->format('Y') }} 
                                    <a href="#">Modern </a>Crafted with <i class="ft-heart pink"> </i> by <a href="http://visualmedia.web.id/">Visual Media</a></p>
                                    <div class="col-12 text-center">
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
  <!-- END PAGE VENDOR JS-->
  <!-- BEGIN MODERN JS-->
  <script src="{{ url('modern/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
  <script src="{{ url('modern/app-assets/js/core/app.js') }}" type="text/javascript"></script>
  <!-- END MODERN JS-->
  <!-- BEGIN PAGE LEVEL JS-->
  <script type="text/javascript" src="{{ url('modern/app-assets/js/scripts/ui/breadcrumbs-with-stats.js') }}"></script>
  <script src="{{ url('modern/app-assets/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
  <!-- END PAGE LEVEL JS-->
</body>
</html>