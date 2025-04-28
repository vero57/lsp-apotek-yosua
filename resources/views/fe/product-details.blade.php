@extends('fe.layouts.master')

@section('title', 'Product Details')

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
                        <h1>Product details</h1>
                    </div><!-- Page Title End -->
                </div>
            </div>
        </div><!-- Page Banner Section End-->
        <!-- Product Section Start-->
        <div class="product-section section pt-110 pb-90">
            <div class="container">
                <!-- Product Wrapper Start-->
                <div class="row">
                    <!-- Product Image & Thumbnail Start -->
                    <div class="col-lg-7 col-12 mb-30">
                        <!-- Product Thumbnail -->
                        <div class="single-product-thumbnail product-thumbnail-slider float-left">
                            <div class="single-thumb">
                                <img alt="" src="{{ asset('fe/img/product-details/thumb-1.jpg') }}"/>
                            </div>
                            <div class="single-thumb">
                                <img alt="" src="{{ asset('fe/img/product-details/thumb-2.jpg') }}"/>
                            </div>
                            <div class="single-thumb">
                                <img alt="" src="{{ asset('fe/img/product-details/thumb-3.jpg') }}"/>
                            </div>
                            <div class="single-thumb">
                                <img alt="" src="{{ asset('fe/img/product-details/thumb-4.jpg') }}"/>
                            </div>
                        </div>
                        <!-- Product Image -->
                        <div class="single-product-image product-image-slider fix">
                            <div class="single-image">
                                <img alt="" src="{{ asset('fe/img/product-details/1.jpg') }}"/>
                            </div>
                            <div class="single-image">
                                <img alt="" src="{{ asset('fe/img/product-details/2.jpg') }}"/>
                            </div>
                            <div class="single-image">
                                <img alt="" src="{{ asset('fe/img/product-details/3.jpg') }}"/>
                            </div>
                            <div class="single-image">
                                <img alt="" src="{{ asset('fe/img/product-details/4.jpg') }}"/>
                            </div>
                        </div>
                    </div><!-- Product Image & Thumbnail End -->
                    <!-- Product Content Start -->
                    <div class="single-product-content col-lg-5 col-12 mb-30">
                        <!-- Title -->
                        <h1 class="title">Holiday Candle</h1>
                        <!-- Product Rating -->
                        <span class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <!-- Price -->
                        <span class="product-price">€ 120.0</span>
                        <!-- Description -->
                        <div class="description">
                            <p>There are many variations of passages of Lorem Ipsum avaable,majority have suffered alteration in some form, by injected humour, or rdomised words which don't look even slightly believable.</p>
                        </div>
                        <!-- Color -->
                        <div class="product-color fix">
                            <h5>Select Color</h5>
                            <form action="#">
                                <div class="color-box">
                                    <input id="color-1" name="color" type="radio"/>
                                    <label for="color-1" style="background-color: #51bd99;">color 1</label>
                                </div>
                                <div class="color-box">
                                    <input id="color-2" name="color" type="radio"/>
                                    <label for="color-2" style="background-color: #83a931;">color 2</label>
                                </div>
                                <div class="color-box">
                                    <input id="color-3" name="color" type="radio"/>
                                    <label for="color-3" style="background-color: #c8001e;">color 3</label>
                                </div>
                                <div class="color-box">
                                    <input id="color-4" name="color" type="radio"/>
                                    <label for="color-4" style="background-color: #414141;">color 4</label>
                                </div>
                            </form>
                        </div>
                        <!-- Quantity & Cart Button -->
                        <div class="product-quantity-cart fix">
                            <div class="product-quantity">
                                <input name="qtybox" type="text" value="0"/>
                            </div>
                            <button class="add-to-cart">add to cart</button>
                        </div>
                        <!-- Action Button -->
                        <div class="product-action-button fix">
                            <button><i class="ion-ios-email-outline"></i>Email to a friend</button>
                            <button><i class="ion-ios-heart-outline"></i>Wishlist</button>
                            <button><i class="ion-ios-printer-outline"></i>Print</button>
                        </div>
                        <!-- Social Share -->
                        <div class="product-share fix">
                            <h6>Share :</h6>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-pinterest-p"></i></a>
                        </div>
                    </div><!-- Product Content End -->
                </div><!-- Product Wrapper End-->
                <!-- Product Additional Info Start-->
                <div class="row">
                    <!-- Nav tabs -->
                    <div class="col-12 mt-30">
                        <ul class="pro-info-tab-list nav">
                            <li><a class="active" data-toggle="tab" href="#more-info">More info</a></li>
                            <li><a data-toggle="tab" href="#data-sheet">Data sheet</a></li>
                            <li><a data-toggle="tab" href="#reviews">Reviews</a></li>
                        </ul>
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content col-12">
                        <div class="pro-info-tab tab-pane active" id="more-info">
                            <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention.</p>
                        </div>
                        <div class="pro-info-tab tab-pane" id="data-sheet">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr class="odd">
                                        <td>Compositions</td>
                                        <td>Cotton</td>
                                    </tr>
                                    <tr class="even">
                                        <td>Styles</td>
                                        <td>Casual</td>
                                    </tr>
                                    <tr class="odd">
                                        <td>Properties</td>
                                        <td>Short Sleeve</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="pro-info-tab tab-pane" id="reviews">
                            <a class="button" href="#">Be the first to write your review!</a>
                        </div>
                    </div>
                </div><!-- Product Additional Info End-->
            </div>
        </div><!-- Product Section End-->
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