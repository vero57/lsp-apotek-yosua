<!doctype html>
<html lang="en">
    <head>
    <meta charset="utf-8"/>
    <meta content="ie=edge" http-equiv="x-ua-compatible"/>
    <title></title>
    <meta content="" name="description"/>
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <!-- Favicon -->
    <link href="{{ asset('fe/img/favicon.ico') }}" rel="shortcut icon" type="image/x-icon"/>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet"/>
    <!-- CSS
        ============================================ -->
    <!-- Bootstrap CSS -->
    <link href="{{ asset('fe/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <!-- Icon Font CSS -->
    <link href="{{ asset('fe/css/font-awesome.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('fe/css/ionicons.min.css') }}" rel="stylesheet"/>
    <!-- Plugins CSS -->
    <link href="{{ asset('fe/css/plugins.css') }}" rel="stylesheet"/>
    <!-- Style CSS -->
    <link href="{{ asset('fe/style.css') }}" rel="stylesheet"/>
    <!-- Modernizer JS -->
    <script src="{{ asset('fe/js/vendor/modernizr-2.8.3.min.js') }}"></script>
    </head>
    <body>
        @include('fe.partials.header')
        <div class="content">
            @yield('content')
        </div>
        @include('fe.partials.footer')
        @include('fe.partials.scripts')
    </body>
</html>