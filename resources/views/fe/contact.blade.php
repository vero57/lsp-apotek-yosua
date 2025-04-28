@extends('fe.layouts.master')

@section('title', 'Contact')

@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">

            <!-- Page Banner Section Start -->
            <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner3.jpg') }})">
                <div class="container">
                    <div class="row">
                        <div class="page-title text-center col">
                            <h1>contact us</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page Banner Section End -->

            <!-- Contact Section Start -->
            <div class="contact-section section bg-white pt-120">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-10 col-12 ml-auto mr-auto">
                            <div class="contact-wrapper">
                                <div class="row">

                                    <!-- Contact Info -->
                                    <div class="contact-info col-lg-5 col-12">
                                        <h4 class="title">Contact Info</h4>
                                        <p>It is a long established fact that readewill be distracted by the readable content of a page when looking at ilayout.</p>
                                        <ul>
                                            <li><span>Address:</span> House 09, Road 3, Dhaka</li>
                                            <li><span>Email:</span> christ@email.com</li>
                                            <li><span>Phone:</span> +99 854 785 65</li>
                                        </ul>
                                        <div class="contact-social">
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-instagram"></i></a>
                                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                        </div>
                                    </div>

                                    <!-- Contact Form -->
                                    <div class="contact-form col-lg-7 col-12">
                                        <h4 class="title">Send Your Message</h4>
                                        <form action="https://demo.hasthemes.com/christ-preview/christ/mail.php" id="contact-form" method="post">
                                            <input name="name" placeholder="Your Name" type="text" />
                                            <input name="email" placeholder="Your Email" type="email" />
                                            <textarea name="message" placeholder="Your Message"></textarea>
                                            <input type="submit" value="Submit" />
                                        </form>
                                        <p class="form-messege"></p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Contact Section End -->

            <!-- Contact Map -->
            <div id="contact-map"></div>


        </div>
        <!-- Main Wrapper End -->

        <!-- JS Scripts -->
        <script src="{{ asset('fe/js/vendor/jquery-1.12.0.min.js') }}"></script>
        <script src="{{ asset('fe/js/popper.min.js') }}"></script>
        <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('fe/js/plugins.js') }}"></script>
        <script src="{{ asset('fe/js/ajax-mail.js') }}"></script>
        <script src="{{ asset('fe/js/main.js') }}"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAlZPf84AAVt8_FFN7rwQY5nPgB02SlTKs"></script>
        <script src="{{ asset('fe/js/map.js') }}"></script>
    </body>
@endsection
