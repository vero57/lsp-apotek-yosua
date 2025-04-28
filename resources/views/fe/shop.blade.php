@extends('fe.layouts.master')

@section('title', 'Shop')

@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">
            <!-- Header Section Start -->
            <!-- Header Section End -->
            <!-- Page Banner Section Start-->
            <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner.jpg') }})">
                <div class="container">
                    <div class="row">
                        <!-- Page Title Start -->
                        <div class="page-title text-center col">
                            <h1>Obat-obatan</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- Product Section Start-->
            <div class="product-section section pt-120 pb-120">
                <div class="container">
                    <!-- Product Wrapper Start-->
                    @include('fe.partials.products')
                    <!-- Product Wrapper End-->
                </div>
            </div><!-- Product Section End-->
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