@extends('fe.layouts.master')

@section('title', 'Cart')

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
                            <h1>Cart</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- Cart Section Start-->
            <div class="cart-section section pt-120 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mb-30">
                                <table class="table cart-table text-center">
                                    <!-- Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="number">#</th>
                                            <th class="image">image</th>
                                            <th class="name">product name</th>
                                            <th class="qty">quantity</th>
                                            <th class="price">price</th>
                                            <th class="total">totle</th>
                                            <th class="remove">remove</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <tr>
                                            <td><span class="cart-number">1</span></td>
                                            <td><a class="cart-pro-image" href="#"><img alt="" src="{{ asset('fe/img/product/1.jpg') }}"/></a></td>
                                            <td><a class="cart-pro-title" href="#">Holiday Candle</a></td>
                                            <td>
                                                <div class="product-quantity">
                                                    <input name="qtybox" type="text" value="0"/>
                                                </div>
                                            </td>
                                            <td><p class="cart-pro-price">$104.99</p></td>
                                            <td><p class="cart-price-total">$104.99</p></td>
                                            <td><button class="cart-pro-remove"><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td><span class="cart-number">2</span></td>
                                            <td><a class="cart-pro-image" href="#"><img alt="" src="{{ asset('fe/img/product/2.jpg') }}"/></a></td>
                                            <td><a class="cart-pro-title" href="#">Christmas Tree</a></td>
                                            <td>
                                                <div class="product-quantity">
                                                    <input name="qtybox" type="text" value="0"/>
                                                </div>
                                            </td>
                                            <td><p class="cart-pro-price">$85.99</p></td>
                                            <td><p class="cart-price-total">$85.99</p></td>
                                            <td><button class="cart-pro-remove"><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <!-- Cart Action -->
                                <div class="cart-action col-lg-4 col-md-6 col-12 mb-30">
                                    <a class="button" href="#">Continiue Shopping</a>
                                    <button class="button">update cart</button>
                                </div>
                                <!-- Cart Cuppon -->
                                <div class="cart-cuppon col-lg-4 col-md-6 col-12 mb-30">
                                    <h4 class="title">Discount Code</h4>
                                    <p>Enter your coupon code if you have</p>
                                    <form action="#" class="cuppon-form">
                                        <input placeholder="Cuppon Code" type="text"/>
                                        <button class="button">apply coupon</button>
                                    </form>
                                </div>
                                <!-- Cart Checkout Progress -->
                                <div class="cart-checkout-process col-lg-4 col-md-6 col-12 mb-30">
                                    <h4 class="title">Process Checkout</h4>
                                    <p><span>Subtotal</span><span>$190.98</span></p>
                                    <h5><span>Grand total</span><span>$190.98</span></h5>
                                    <button class="button">process to checkout</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Cart Section End-->
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