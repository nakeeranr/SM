<!doctype html>
<html class="loading" lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'MySchool') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> -->

    <!-- Theme Files -->
    <link rel="apple-touch-icon" href="{{ asset('images/ico/apple-icon-120.html') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/css/forms/select/select2.min.css')}}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/themes/semi-dark-layout.min.css') }}">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages/authentication.css') }}">

    @include('layouts._pageHeader')
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom.css') }}">

    <!-- End.Theme Files -->
    
</head>



@if (Auth::guest())

<body class="vertical-layout 1-column navbar-sticky bg-full-screen-image footer-static blank-page light-layout pace-done menu-hide"
data-open="click" data-menu="vertical-menu-modern" data-col="1-column" style="overflow:auto">

    @else
    <body class="vertical-layout vertical-menu-modern 2-columns  navbar-sticky footer-static" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('layouts._navHeader')
    @include('layouts._navMenu')

    @endif

    <!-- BEGIN: Content-->
    <div class="app-content content">

    <div class="content-overlay"></div>

    <div class="content-wrapper">

    <div class="content-header row"></div>

            @yield('content')
    
        </div>
    </div>
    <!-- END: Content-->


    <!-- Theme Files -->
    <!-- BEGIN: Vendor JS-->

    <script>
        var assetBaseUrl = '{{ url('/') }}';
    </script>
    <script src="{{ asset('vendors/js/vendors.min.js') }}"></script>
    <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js') }}"></script>
    <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js') }}"></script>
    <script src="{{ asset('fonts/LivIconsEvo/js/LivIconsEvo.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

     <!-- BEGIN: Page Vendor JS-->
     <script src="{{ asset('vendors/js/forms/select/select2.full.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('js/scripts/forms/select/form-select2.min.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Page Vendor JS-->
    @include('layouts._pageFooter')
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('js/scripts/configs/vertical-menu-light.min.js') }}"></script>
    <script src="{{ asset('js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('js/core/app.min.js') }}"></script>
    <script src="{{ asset('js/scripts/components.min.js') }}"></script>
    <script src="{{ asset('js/scripts/footer.min.js') }}"></script>
    <!-- End.Theme Files -->
    

    @if (Auth::guest())

    @else

    <div class="sidenav-overlay"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
      <p class="clearfix mb-0"><span class="float-left d-inline-block">2020 &copy; SM</span>
      <span class="float-right d-sm-inline-block d-none">Crafted with<i class="bx bxs-heart pink mx-50 font-small-3"></i>by<a class="text-uppercase" href="" target="_blank">Nakeeran R</a></span>
        <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="bx bx-up-arrow-alt"></i></button>
      </p>
    </footer>
    <!-- END: Footer-->
    @endif
</body>
</html>
