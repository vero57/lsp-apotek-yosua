@extends('fe.layouts.master')

@section('title', 'Product Details')

@section('content')
<body>
    <!-- Main Wrapper Start -->
    <div class="section" id="main-wrapper">
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
                            @foreach([$product->foto1, $product->foto2, $product->foto3] as $foto)
                                @if($foto)
                                    <div class="single-thumb">
                                        <img alt="" src="{{ asset('storage/' . ltrim($foto, '/')) }}"/>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- Product Image -->
                        <div class="single-product-image product-image-slider fix">
                            @foreach([$product->foto1, $product->foto2, $product->foto3] as $foto)
                                @if($foto)
                                    <div class="single-image">
                                        <img alt="" src="{{ asset('storage/' . ltrim($foto, '/')) }}"/>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div><!-- Product Image & Thumbnail End -->
                    <!-- Product Content Start -->
                    <div class="single-product-content col-lg-5 col-12 mb-30">
                        <!-- Title -->
                        <h1 class="title">{{ $product->nama_obat }}</h1>
                        <!-- Product Rating -->
                        <span class="product-rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                        </span>
                        <!-- Price -->
                        <span class="product-price">Rp{{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                        <!-- Description -->
                        <div class="description">
                            <p>{{ $product->deskripsi_obat }}</p>
                        </div>
                        <!-- Stock -->
                        <div class="product-stock fix">
                            <h5>Stok: {{ $product->stok }}</h5>
                        </div>
                        <!-- Quantity & Cart Button -->
                        <div class="product-quantity-cart fix">
                            <div class="product-quantity">
                                <input name="qtybox" type="text" value="0"/>
                            </div>
                            @auth('pelanggan')
                                <button class="add-to-cart">add to cart</button>
                            @endauth
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