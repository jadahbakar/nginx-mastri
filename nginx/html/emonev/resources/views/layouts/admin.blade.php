<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('material/assets/images/favicon-copy.png') }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('material/assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <!--alerts CSS -->
    <link href="{{ asset('material/assets/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" type="text/css">
    <!-- chartist CSS -->
    <link href="{{ asset('material/assets/plugins/chartist-js/dist/chartist.min.css') }}" rel="stylesheet">
    <link href="{{ asset('material/assets/plugins/chartist-js/dist/chartist-init.css') }}" rel="stylesheet">
    <link href="{{ asset('material/assets/plugins/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('material/assets/plugins/css-chart/css-chart.css') }}" rel="stylesheet">
    <!--This page css - Morris CSS -->
    <link href="{{ asset('material/assets/plugins/c3-master/c3.min.css') }}" rel="stylesheet">
    <!-- Vector CSS -->
    <link href="{{ asset('material/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <!-- Custom CSS -->
    <link href="{{ asset('material/design/css/style.css') }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href="{{ asset('material/design/css/colors/blue.css') }}" id="theme" rel="stylesheet">

    <link href="{{ asset('pluginku/pagination.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
    <style type="text/css">
        /* Form Error */
        label.error {
            color: #c4002e;
            font-weight: 300;
        }
        .form-control.error {
            border: 1px solid #c4002e;
        }

        /*Sweet Alert*/
        .sa-button-container {
            display: -webkit-flex;
            display: flex;
            -webkit-justify-content: center;
                      justify-content: center;
        }
        .sa-button-container .cancel {
            -webkit-order: 2;
                    order: 2;
        }
        .sa-button-container .sa-confirm-button-container {
            -webkit-order: 1;
                    order: 1;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border logo-center">
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <!-- ============================================================== -->
                <!-- Logo -->
                <!-- ============================================================== -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="">
                        <!-- Logo icon -->
                        <b>
                            <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                            <!-- Light Logo icon -->
                            <img src="{{ asset('material/assets/images/logo-icon-copy.png') }}" alt="homepage" class="light-logo" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span>
                         <!-- Light Logo text -->    
                         <img src="{{ asset('material/assets/images/logo-light-text-copy.png') }}" class="light-logo" alt="homepage" /></span> </a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse">
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav mr-auto mt-md-0">
                        <!-- This is  -->
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class="nav-item hidden-sm-down search-box">
                            <a class="nav-link hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-soundcloud"></i></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Messages -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown mega-dropdown"> <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="mdi mdi-view-grid"></i></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- End Messages -->
                        <!-- ============================================================== -->
                    </ul>
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav my-lg-0">
                        <!-- ============================================================== -->
                        <!-- Profile -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="{{ asset('material/avatar.jpg') }}" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="{{ asset('material/avatar.jpg') }}" alt="user"></div>
                                            <div class="u-text">
                                                <h4>{{ Auth::user()->name }}</h4>
                                                <p class="text-muted">{{ Auth::user()->email }}</p></div>
                                        </div>
                                    </li>
                                    <li role="separator" class="divider"></li>
                                    <li><a href="{{ url('ganti-password') }}"><i class="ti-lock"></i> Ganti Password</a></li>
                                    <li>
                                        <a href="" onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();">
                                            <i class="fa fa-power-off"></i> Logout
                                        </a>

                                        <form id="logout-form-1" action="{{ route('logout') }}" method="post" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- ============================================================== -->
                        <!-- Language -->
                        <!-- ============================================================== -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="flag-icon flag-icon-id"></i></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li @if(isset($varGlobal['beranda'])) {!! $varGlobal['beranda'] !!} @endif>
                            <a href="{{ url('beranda') }}"><i class="mdi mdi-gauge"></i><span class="hide-menu">Beranda </span></a>
                        </li>
                        <li @if(isset($varGlobal['data-sp2d'])) {!! $varGlobal['data-sp2d'] !!} @endif>
                            <a href="{{ url('data-sp2d') }}"><i class="mdi mdi-bullseye"></i><span class="hide-menu">Data SP2D</span></a>
                        </li>
                        <li @if(isset($varGlobal['data-spj'])) {!! $varGlobal['data-spj'] !!}} @endif>
                            <a href="{{ url('data-spj') }}"><i class="mdi mdi-chart-bubble"></i><span class="hide-menu">Data SPJ</span></a>
                        </li>
                        <li @if(isset($varGlobal['laporan'])) {!! $varGlobal['laporan'] !!}} @endif>
                            <a href="{{ url('laporan') }}"><i class="mdi mdi-book-multiple"></i><span class="hide-menu">Laporan</span></a>
                        </li>
                        <li @if(isset($varGlobal['user'])) {!! $varGlobal['user'] !!} @endif>
                            <a href="{{ url('user') }}"><i class="mdi mdi-account-multiple-outline"></i><span class="hide-menu">User</span></a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            @if(Session::has('pesanSukses'))
                <script type="text/javascript">
                    function codeAddress() {
                        swal({
                            title: "Berhasil !",   
                            text: "<b>{{ Session::get('pesanSukses') }}</b>",   
                            type: "success", 
                            html: true
                        });
                    }
                    window.onload = codeAddress;
                </script>
            @endif

            @if(Session::has('pesanError'))
                <script type="text/javascript">
                    function codeAddress() {
                        swal({
                            title: "Gagal !",   
                            text: "<b>{{ Session::get('pesanError') }}</b>",   
                            type: "error", 
                            html: true
                        });
                    }
                    window.onload = codeAddress;
                </script>
            @endif

            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
               
               @yield('konten')

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer">
                © {{ \Carbon\Carbon::now()->format('Y') }} E-Monev Pembangunan Kota Semarang. Design by Visual Media.
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('material/assets/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('material/assets/plugins/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('material/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('material/design/js/jquery.slimscroll.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('material/design/js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('material/design/js/sidebarmenu.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('material/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('material/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--stickey kit -->
    <script src="{{ asset('material/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js') }}"></script>
    <script src="{{ asset('material/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('material/assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('material/design/js/custom.js') }}"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <!-- ============================================================== -->
    <!--c3 JavaScript -->
    <script src="{{ asset('material/assets/plugins/d3/d3.min.js') }}"></script>
    <script src="{{ asset('material/assets/plugins/c3-master/c3.min.js') }}"></script>
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <script src="{{ asset('material/assets/plugins/styleswitcher/jQuery.style.switcher.js') }}"></script>
    <!-- Sweet-Alert  -->
    <script src="{{ asset('material/assets/plugins/sweetalert/sweetalert.min.js') }}"></script>

    <!--Validate-->
    <script src="{{ asset('pluginku/jquery-validation-1.15.1/dist/jquery.validate.js') }}"></script>
    <script src="{{ asset('pluginku/chart-js/Chart.js') }}"></script>

    <script type="text/javascript">
        $().ready(function() {   
            //Confirm Message
            $('button.btn-danger').on('click', function(e){
                e.preventDefault();
                var $self = $(this);
                swal({   
                    reverseButton: true,
                    title: "Data yakin dihapus ?",   
                    text: "<b>Mohon diteliti sebelum menghapus data</b>",   
                    type: "warning",  
                    confirmButtonText: "Hapus",   
                    cancelButtonText: "Batal",   
                    showCancelButton: true,   
                    confirmButtonColor: "#DD6B55",    
                    closeOnConfirm: false,
                    html: true
                }, function(){ 
                    $self.parents(".delete_form").submit();
                });
            });
        });

        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    @yield('javascript')
</body>

</html>
