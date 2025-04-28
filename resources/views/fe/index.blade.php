@extends('fe.layouts.master')

@section('title', 'Index')

@include('fe.partials.header')
@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">
            <!-- Header Section Start -->
            <!-- Header Section End -->

            <!-- Hero Slider Start-->
            <div class="hero-slider section fix">
                <!-- Hero Slide Item Start-->
                <div class="hero-item" style="background-image: url({{ asset('fe/img/hero/1.png') }})">
                    <!-- Hero Content Start-->
                    <div class="hero-content text-center m-auto">
                        <h2>Selamat Datang</h2>
                        <h1>Pharmashees</h1>
                        <p>Menyediakan berbagai macam obat yang sudah di verifikasi oleh BPOM</p>
                        <a href="#">LEARN MORE</a>
                    </div><!-- Hero Content End-->
                </div><!-- Hero Slide Item End-->
                <!-- Hero Slide Item Start-->
                <div class="hero-item" style="background-image: url({{ asset('fe/img/hero/2.png') }})">
                    <!-- Hero Content Start-->
                    <div class="hero-content text-center m-auto">
                        <h2>Save 50%</h2>
                        <h1>Khusus pelanggan baru</h1>
                        <p>Hemat sampai dengan 50% untuk pengguna baru</p>
                        <a href="#">LEARN MORE</a>
                    </div><!-- Hero Content End-->
                </div><!-- Hero Slide Item End-->
                <div class="hero-item" style="background-image: url({{ asset('fe/img/hero/3.jpg') }})">
                    <!-- Hero Content Start-->
                    <div class="hero-content text-center m-auto">
                        <h2>Apoteker yang sudah terlatih</h2>
                        <h1>Pharmashees</h1>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                        <a href="#">LEARN MORE</a>
                    </div><!-- Hero Content End-->
                </div><!-- Hero Slide Item End-->
                <div class="hero-item" style="background-image: url({{ asset('fe/img/hero/4.jpg') }})">
                    <!-- Hero Content Start-->
                    <div class="hero-content text-center m-auto">
                        <h2>Save 25%</h2>
                        <h1>Christmas Sale</h1>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which.</p>
                        <a href="#">LEARN MORE</a>
                    </div><!-- Hero Content End-->
                </div><!-- Hero Slide Item End-->
            </div><!-- Hero Slider End-->

            <!-- Banner Section Start-->
            <div class="banner-section section pt-120">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-30">
                            <div class="single-banner">
                                <img alt="banner" src="{{ asset('fe/img/banner/1.jpg') }}"/>
                                <div class="banner-content right">
                                    <h1 class="white"><span>Gifts</span>Christmas</h1>
                                    <a class="button" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 mb-30">
                            <div class="single-banner">
                                <img alt="banner" src="{{ asset('fe/img/banner/2.jpg') }}"/>
                                <div class="banner-content left">
                                    <h2 class="black"><span class="small">Save <span class="red">25%</span></span><span class="red">Offer</span> Christmas</h2>
                                    <a class="link" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Banner Section End-->

            <!-- Product Section Start-->
            <div class="product-section section pt-70 pb-60">
                <div class="container">
                    <!-- Section Title Start-->
                    <div class="row">
                        <div class="section-title text-center col mb-60">
                            <h1>Featured Products</h1>
                        </div>
                    </div><!-- Section Title End-->
                    <!-- Product Wrapper Start-->
                    @include('fe.partials.products', ['showLoadMore' => true])
                    <!-- Product Wrapper End-->
                </div>
            </div><!-- Product Section End-->

            <!-- Testimonial Section Start-->





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