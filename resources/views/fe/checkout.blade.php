@extends('fe.layouts.master')

@section('title', 'Checkout')

@section('content')
<body>
    <!-- Main Wrapper Start -->
    <div class="section" id="main-wrapper">
        
        <!-- Page Banner Section Start-->
        <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner.jpg') }})">
            <div class="container">
                <div class="row">
                    <div class="page-title text-center col">
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page Banner Section End-->

        <!-- Checkout Section Start-->
        <div class="cart-section section pt-120 pinb-90">
            <div class="container">
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6 col-12 mb-30">
                        <!-- Checkout Accordion Start -->
                        <div class="panel-group" id="checkout-accordion">

                            <!-- Checkout Method -->
                            <div class="panel single-accordion">
                                <a class="accordion-head" data-parent="#checkout-accordion" data-toggle="collapse" href="#checkout-method">1. Checkout Method</a>
                                <div class="collapse show" id="checkout-method">
                                    <div class="checkout-method accordion-body fix">
                                        <ul class="checkout-method-list">
                                            <li class="active" data-form="checkout-login-form">Login</li>
                                            <li data-form="checkout-register-form">Register</li>
                                        </ul>

                                        <form action="#" class="checkout-login-form">
                                            <div class="row">
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Email Address" type="email"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Password" type="password"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input type="submit" value="Login"/></div>
                                            </div>
                                        </form>

                                        <form action="#" class="checkout-register-form">
                                            <div class="row">
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Your Name" type="text"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Email Address" type="email"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Password" type="password"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input placeholder="Confirm Password" type="password"/></div>
                                                <div class="input-box col-md-6 col-12 mb-20"><input type="submit" value="Register"/></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Billing Method -->
                            <div class="panel single-accordion">
                                <a class="accordion-head collapsed" data-parent="#checkout-accordion" data-toggle="collapse" href="#billing-method">2. Billing Information</a>
                                <div class="collapse" id="billing-method">
                                    <div class="accordion-body billing-method fix">
                                        <form action="#" class="billing-form checkout-form">
                                            <div class="row">
                                                <div class="col-12 mb-20">
                                                    <select>
                                                        <option value="1">Select a country</option>
                                                        <option value="2">Bangladesh</option>
                                                        <!-- ... -->
                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="First Name" type="text"/></div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="Last Name" type="text"/></div>
                                                <div class="col-12 mb-20"><input placeholder="Company Name" type="text"/></div>
                                                <div class="col-12 mb-20"><input placeholder="Street address" type="text"/></div>
                                                <div class="col-12 mb-20"><input placeholder="Apartment, suite, unit etc. (optional)" type="text"/></div>
                                                <div class="col-12 mb-20"><input placeholder="Town / City" type="text"/></div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="State / County" type="text"/></div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="Postcode / Zip" type="text"/></div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="Email Address" type="email"/></div>
                                                <div class="col-md-6 col-12 mb-20"><input placeholder="Phone Number" type="text"/></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Shipping Method -->
                            <div class="panel single-accordion">
                                <a class="accordion-head collapsed" data-parent="#checkout-accordion" data-toggle="collapse" href="#shipping-method">3. Shipping Information</a>
                                <div class="collapse" id="shipping-method">
                                    <div class="accordion-body shipping-method fix">
                                        <h5>Shipping Address</h5>
                                        <p><span>Address:</span> Bootexperts, Banasree D-Block, Dhaka 1219, Bangladesh</p>
                                        <button class="shipping-form-toggle">Ship to a different address?</button>

                                        <form action="#" class="shipping-form checkout-form">
                                            <div class="row">
                                                <div class="col-12 mb-20">
                                                    <select>
                                                        <option value="1">Select a country</option>
                                                        <option value="2">Bangladesh</option>
                                                        <!-- ... -->
                                                    </select>
                                                </div>
                                                <!-- Nama, alamat, kota, email, dll. seperti pada form billing -->
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="panel single-accordion">
                                <a class="accordion-head collapsed" data-parent="#checkout-accordion" data-toggle="collapse" href="#payment-method">4. Payment Method</a>
                                <div class="collapse" id="payment-method">
                                    <div class="accordion-body payment-method fix">
                                        <ul class="payment-method-list">
                                            <li class="active">Check / Money Order</li>
                                            <li class="payment-form-toggle">Credit Card</li>
                                        </ul>
                                        <form action="#" class="payment-form">
                                            <div class="row">
                                                <div class="input-box col-12 mb-20">
                                                    <label for="card-name">Name on Card *</label>
                                                    <input id="card-name" type="text"/>
                                                </div>
                                                <div class="input-box col-12 mb-20">
                                                    <label>Credit Card Type</label>
                                                    <select>
                                                        <option>Please Select</option>
                                                        <option>Credit Card Type 1</option>
                                                        <option>Credit Card Type 2</option>
                                                    </select>
                                                </div>
                                                <div class="input-box col-12 mb-20">
                                                    <label for="card-number">Credit Card Number *</label>
                                                    <input id="card-number" type="text"/>
                                                </div>
                                                <div class="input-box col-12">
                                                    <div class="row">
                                                        <div class="input-box col-12">
                                                            <label>Expiration Date</label>
                                                        </div>
                                                        <div class="input-box col-md-6 col-12 mb-20">
                                                            <select>
                                                                <option>Month</option>
                                                                <option>Jan</option>
                                                                <!-- ... -->
                                                            </select>
                                                        </div>
                                                        <div class="input-box col-md-6 col-12 mb-20">
                                                            <select>
                                                                <option>Year</option>
                                                                <option>2025</option>
                                                                <!-- ... -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="input-box col-12">
                                                    <label for="card-Verify">Card Verification Number *</label>
                                                    <input id="card-Verify" type="text"/>
                                                    <a href="#">What is it?</a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div><!-- Checkout Accordion End -->
                    </div>

                    <!-- Order Summary -->
                    <div class="col-lg-6 col-12 mb-30">
                        <div class="order-details-wrapper">
                            <h2>Your Order</h2>
                            <div class="order-details">
                                <form action="#">
                                    <ul>
                                        <li><p class="strong">Product</p><p class="strong">Total</p></li>
                                        <li><p>Holiday Candle x1</p><p>$104.99</p></li>
                                        <li><p>Christmas Tree x1</p><p>$85.99</p></li>
                                        <li><p class="strong">Cart Subtotal</p><p class="strong">$190.98</p></li>
                                        <li>
                                            <p class="strong">Shipping</p>
                                            <p>
                                                <input id="flat" name="order-shipping" type="radio">
                                                <label for="flat">Flat Rate $7.00</label><br/>
                                                <input id="free" name="order-shipping" type="radio">
                                                <label for="free">Free Shipping</label>
                                            </p>
                                        </li>
                                        <li><p class="strong">Order Total</p><p class="strong">$190.98</p></li>
                                        <li><button class="button">Place Order</button></li>
                                    </ul>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Checkout Section End-->


    </div><!-- Main Wrapper End -->

    <!-- JS Assets -->
    <script src="{{ asset('fe/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('fe/js/popper.min.js') }}"></script>
    <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fe/js/plugins.js') }}"></script>
    <script src="{{ asset('fe/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('fe/js/main.js') }}"></script>
</body>
@endsection
