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
                        <!-- Jenis Obat -->
                        <div style="margin-bottom:10px;">
                            Jenis obat: {{ $product->jenisObat->jenis ?? '-' }}
                        </div>
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
                            <form id="form-add-to-cart-detail">
                                @csrf
                                <div class="product-quantity" style="display: flex; align-items: center; gap: 5px; margin-bottom: 10px;">
                                    <button type="button" class="qty-btn" id="qty-decrease" style="background:#f5f5f5;color:red;border:none;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fa fa-chevron-left"></i>
                                    </button>
                                    <input id="qtybox" name="jumlah_order" type="text" value="1" style="width:50px;text-align:center;border:none;background:#f5f5f5;font-size:16px;border-radius:8px;"/>
                                    <button type="button" class="qty-btn" id="qty-increase" style="background:#f5f5f5;color:red;border:none;border-radius:50%;width:32px;height:32px;display:flex;align-items:center;justify-content:center;">
                                        <i class="fa fa-chevron-right"></i>
                                    </button>
                                </div>
                                <input type="hidden" name="id_obat" value="{{ $product->id }}">
                                <button type="submit" class="add-to-cart" style="margin-top:0;width:100%;background:red;color:#fff;border:none;padding:10px 0;border-radius:8px;font-weight:bold;transition:background 0.2s;">Tambah ke Keranjang</button>
                            </form>
                        </div>
                        <!-- Action Button -->
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
    <script>
        $(function() {
            $('#qty-decrease').click(function() {
                let $qty = $('#qtybox');
                let val = parseInt($qty.val()) || 0;
                if(val > 1) $qty.val(val - 1);
            });
            $('#qty-increase').click(function() {
                let $qty = $('#qtybox');
                let val = parseInt($qty.val()) || 1;
                $qty.val(val + 1);
            });
            $('#qtybox').on('input', function() {
                let val = parseInt($(this).val()) || 1;
                if(val < 1) $(this).val(1);
            });

            // Add to cart AJAX
            $('#form-add-to-cart-detail').submit(function(e) {
                e.preventDefault();
                var form = this;
                var formData = new FormData(form);
                $.ajax({
                    url: "{{ route('fe.cart.add') }}",
                    method: "POST",
                    headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.success) {
                            showCartToast('Berhasil ditambahkan ke keranjang!');
                            setTimeout(function(){ location.reload(); }, 1200);
                        } else {
                            showCartToast(data.message || 'Gagal menambahkan ke keranjang', true);
                        }
                    },
                    error: function(xhr) {
                        if(xhr.status === 401) {
                            window.location.href = "{{ route('login') }}";
                            return;
                        }
                        showCartToast('Gagal menambahkan ke keranjang', true);
                    }
                });
            });

            function showCartToast(message, isError = false) {
                var toast = $('#cart-toast');
                var msg = $('#cart-toast-message');
                toast.show();
                msg.text(message);
                toast.children().first().css('background', isError ? '#dc3545' : '#28a745');
                setTimeout(function(){
                    toast.hide();
                }, 2000);
            }
        });
    </script>
</body>
@endsection