@extends('fe.layouts.master')

@section('title', 'About')


@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">
            <!-- Header Section Start -->
            <!-- Header Section End -->
            <!-- Page Banner Section Start-->
            <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner2.jpg') }})">
                <div class="container">
                    <div class="row">
                        <!-- Page Title Start -->
                        <div class="page-title text-center col">
                            <h1>About us</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- About Section Start-->
            <div class="about-section section pt-120 pb-90">
                <div class="container">
                    <div class="row flex-row-reverse">
                        <!-- About Image -->
                        <div class="about-image col-lg-6 col-12 mb-30">
                            <a class="video-popup" href="https://www.youtube.com/watch?v=7e90gBu4pas">
                                <img alt="" src="{{ asset('fe/img/about.jpg') }}"/>
                            </a>
                        </div>
                        <!-- Mission Content -->
                        <div class="about-content col-lg-6 col-12 mb-30">
                            <h2>About <span>Christ</span></h2>
                            <p>There are many variations of passages of Lorem Ipsum available, majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly kn je believable There are manations of passages of Lorem Ipsum available, but the majority ahave suffered ami tar cholnay vulbo na alte ration. majority have suffered alteration in</p>
                            <a class="button" href="#">Shop Now</a>
                        </div>
                    </div>
                </div>
            </div><!-- About Section End-->
            <!-- Team Section Start-->
            <div class="team-section section pb-120">
                <div class="container">
                    <div class="row">
                        <div class="section-title text-center col mb-60">
                            <h1>Our Team</h1>
                        </div>
                    </div>
                    <div class="team-wrapper row">
                        <div class="single-team col-lg-3 col-md-6 col-12">
                            <img alt="team" src="{{ asset('fe/img/team/1.jpg') }}"/>
                            <div class="content">
                                <h4>Terry Soto</h4>
                                <span>CEO</span>
                            </div>
                        </div>
                        <div class="single-team col-lg-3 col-md-6 col-12">
                            <img alt="team" src="{{ asset('fe/img/team/2.jpg') }}"/>
                            <div class="content">
                                <h4>Maria Lane</h4>
                                <span>Marketer</span>
                            </div>
                        </div>
                        <div class="single-team col-lg-3 col-md-6 col-12">
                            <img alt="team" src="{{ asset('fe/img/team/3.jpg') }}"/>
                            <div class="content">
                                <h4>Justin Evans</h4>
                                <span>developer</span>
                            </div>
                        </div>
                        <div class="single-team col-lg-3 col-md-6 col-12">
                            <img alt="team" src="{{ asset('fe/img/team/4.jpg') }}"/>
                            <div class="content">
                                <h4>Rose Dixon</h4>
                                <span>Designer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Team Section End-->
            <!-- Funfact Section Start-->
            <div class="funfact-section section pb-90">
                <div class="container">
                    <div class="row">
                        <!-- Single Fact -->
                        <div class="single-fact text-center col-sm-3 col-6 mb-30">
                            <div class="wrap">
                                <i class="fa fa-users"></i>
                                <h2 class="counter">110</h2>
                                <p>Happy Clients</p>
                            </div>
                        </div>
                        <!-- Single Fact -->
                        <div class="single-fact text-center col-sm-3 col-6 mb-30">
                            <div class="wrap">
                                <i class="fa fa-trophy"></i>
                                <h2 class="counter">90</h2>
                                <p>Award Winning</p>
                            </div>
                        </div>
                        <!-- Single Fact -->
                        <div class="single-fact text-center col-sm-3 col-6 mb-30">
                            <div class="wrap">
                                <i class="fa fa-thumbs-up"></i>
                                <h2 class="counter">230</h2>
                                <p>Project Done</p>
                            </div>
                        </div>
                        <!-- Single Fact -->
                        <div class="single-fact text-center col-sm-3 col-6 mb-30">
                            <div class="wrap">
                                <i class="fa fa-coffee"></i>
                                <h2 class="counter">350</h2>
                                <p>Cups of Coffee</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Funfact Section End-->
            <!-- Client Section Start-->
            <div class="client-section section pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="client-slider text-center">
                                <!-- Single Client -->
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/1.png') }}"/></div>
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/2.png') }}"/></div>
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/3.png') }}"/></div>
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/4.png') }}"/></div>
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/5.png') }}"/></div>
                                <div class="single-client"><img alt="client" src="{{ asset('fe/img/client/6.png') }}"/></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Client Section End-->
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