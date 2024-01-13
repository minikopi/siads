<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Zanex – Bootstrap  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin, dashboard, dashboard ui, admin dashboard template, admin panel dashboard, admin panel html, admin panel html template, admin panel template, admin ui templates, administrative templates, best admin dashboard, best admin templates, bootstrap 4 admin template, bootstrap admin dashboard, bootstrap admin panel, html css admin templates, html5 admin template, premium bootstrap templates, responsive admin template, template admin bootstrap 4, themeforest html">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/brand/favicon.ico') }}" />

    <!-- TITLE -->
    <title>Sistem Informasi Akademik Darus Sunnah - SIADS</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/plugins.css') }}" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('css/icons.css') }}" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/css/bootstrap-datepicker.min.css" integrity="sha512-34s5cpvaNG3BknEWSuOncX28vz97bRI59UnVtEEpFX536A7BtZSJHsDyFoCl8S7Dt2TPzcrCEoHBGeM4SUBDBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- JQUERY JS -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
</head>

<body class="app sidebar-mini ltr light-mode">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="{{ asset('images/loader.svg') }}" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        @if (Auth::check())
            <div class="page-main">

                @include('layouts.header')

                @include('layouts.sidebar')

                @yield('content')

                <!-- FOOTER -->
                @include('layouts.footer')
                <!-- FOOTER END -->
            </div>
        @else
            <div class="page login-page">
                @yield('content')
            </div>
        @endif


        <!-- BACK-TO-TOP -->
        <a href="#top" id="back-to-top"><i class="fa fa-angle-up"></i></a>

        <!-- BOOTSTRAP JS -->
        <script src="{{ asset('plugins/bootstrap/js/popper.min.js') }}"></script>
        <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>

        <!-- SPARKLINE JS-->
        <script src="{{ asset('js/jquery.sparkline.min.js') }}"></script>

        <!-- CHART-CIRCLE JS-->
        <script src="{{ asset('js/circle-progress.min.js') }}"></script>

        <!-- CHARTJS CHART JS-->
        <script src="{{ asset('plugins/chart/Chart.bundle.js') }}"></script>
        <script src="{{ asset('plugins/chart/utils.js') }}"></script>

        <!-- PIETY CHART JS-->
        <script src="{{ asset('plugins/peitychart/jquery.peity.min.js') }}"></script>
        <script src="{{ asset('plugins/peitychart/peitychart.init.js') }}"></script>

        <!-- INTERNAL SELECT2 JS -->
        <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

        <!-- TIMEPICKER JS -->
		<script src="{{ asset('plugins/time-picker/jquery.timepicker.js') }}"></script>
		<script src="{{ asset('plugins/time-picker/toggles.min.js') }}"></script>

        <!-- ECHART JS-->
        <script src="{{ asset('plugins/echarts/echarts.js') }}"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" integrity="sha512-LsnSViqQyaXpD4mBBdRYeP6sRwJiJveh2ZIbW41EBrNmKxgr/LFZIiWT6yr+nycvhvauz8c2nYMhrP80YhG7Cw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- SIDE-MENU JS-->
        <script src="{{ asset('plugins/sidemenu/sidemenu.js') }}"></script>

        <!-- Sticky js -->
        <script src="{{ asset('js/sticky.js') }}"></script>

        <!-- SIDEBAR JS -->
        <script src="{{ asset('plugins/sidebar/sidebar.js') }}"></script>

        <!-- Perfect SCROLLBAR JS-->
        <script src="{{ asset('plugins/p-scroll/perfect-scrollbar.js') }}"></script>
        <script src="{{ asset('plugins/p-scroll/pscroll.js') }}"></script>
        <script src="{{ asset('plugins/p-scroll/pscroll-1.js') }}"></script>

        <!-- APEXCHART JS -->
        <script src="{{ asset('js/apexcharts.js') }}"></script>


        <!-- Color Theme js -->
        <script src="{{ asset('js/themeColors.js') }}"></script>

        <!-- swither styles js -->
        <script src="{{ asset('js/swither-styles.js') }}"></script>

        <!-- CUSTOM JS -->
        <script src="{{ asset('js/custom.js') }}"></script>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.min.css">
        <!-- SweetAlert2 JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
        @stack('custom')
</body>

</html>
