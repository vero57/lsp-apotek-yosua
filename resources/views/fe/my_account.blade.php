@extends('fe.layouts.master')

@section('title', 'About')


@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">
            <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner2.jpg') }})">
                <div class="container">
                    <div class="row">
                        <!-- Page Title Start -->
                        <div class="page-title text-center col">
                            <h1>Account</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- About Section Start-->
            <div class="about-section section pt-120 pb-90">
                <div class="container">

                </div>
            </div><!-- About Section End-->
            <!-- Footer Section Start-->
        </div><!-- Main Wrapper End -->
        <!-- JS
        ============================================ -->
        <!-- jQuery JS -->
        <script src="{{ asset('fe/js/vendor/jquery-1.12.0.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ asset('fe/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
        <!-- Plugins JS -->
        <script src="{{ asset('fe/js/plugins.js') }}"></script>
        <!-- Ajax Mail JS -->
        <script src="{{ asset('fe/js/ajax-mail.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('fe/js/main.js') }}"></script>
    </body>
@endsection
