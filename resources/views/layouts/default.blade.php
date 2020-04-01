<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Expense Manager</title>
        <meta name="description" content="Expense Manager">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="all,follow">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- include Laravel CSS-->
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <!-- Font Awesome CSS-->
        <link rel="stylesheet" href="{{ asset('theme/vendor/font-awesome/css/font-awesome.min.css') }}">
        <!-- Custom Font Icons CSS-->
        <link rel="stylesheet" href="{{ asset('theme/css/font.css') }}">
        <!-- Google fonts - Muli-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Muli:300,400,700">
        <!-- theme stylesheet-->
        <link rel="stylesheet" href="{{ asset('theme/css/style.default.css') }}" id="theme-stylesheet">
        <!-- Custom stylesheet - for your changes-->
        <link rel="stylesheet" href="{{ asset('theme/css/custom.css') }}">
        <!-- Favicon-->
        <link rel="shortcut icon" href="{{ asset('theme/img/favicon.ico') }}">
        @yield('css')
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

        <!-- include Laravel JS-->
        <script src="{{ mix('/js/app.js') }}"></script>

        @yield('head_js')
    </head>
    <body>
        @include('partials.header')
        <div class="d-flex align-items-stretch">
            @include('partials.navigation')
            <div class="page-content">
                <div class="page-header no-margin-bottom d-flex justify-content-between pr-5">
                    <div class="container-fluid">
                        <h2 class="h5 no-margin-bottom">{{ $pageTitle ?? '' }}</h2>
                    </div>
                </div>
                @yield('breadcrumbs')
                <section class="no-padding-top no-padding-bottom">
                    <div class="container-fluid">
                        @yield('content')
                    </div>
                </section>

                @include('partials.footer')
            </div>
        </div>
        <script src="{{ asset('theme/js/front.js') }}"></script>
        @yield('scripts')
    </body>
</html>