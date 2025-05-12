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
        <div class="cart-section section pt-50 pinb-90">
            <div class="container">
                <div class="w-100 mb-4 p-4 bg-light rounded">
                    <!-- Kolom 1 -->
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa fa-map-marker me-2" aria-hidden="true" style="font-size:2rem; color:red;">&nbsp;</i>
                        <span class="fw-bold" style="font-size: 2.5em; color:red;">Alamat Pengiriman</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <div class="fw-bold" style="font-size: 1.5em">Donianto</div>
                            <div class="text-muted fs-6">0812-3456-7890</div>
                        </div>
                        <div class="flex-grow-1 d-flex flex-column align-items-center">
                            <span class="fs-5 text-center w-100 text-break" style="max-width: 400px;">
                                Jl. Raya Karadenan No.7, Karadenan, Kec. Cibinong, Kabupaten Bogor, Jawa Barat 16111
                            </span>
                        </div>
                        <div class="text-end" style="min-width:110px;">
                            <a href="#" class="ms-2 text-primary text-decoration-underline fs-6" style="font-size:1em;">Ubah alamat</a>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 p-4 bg-white rounded">
                    <!-- Kolom 2 -->
                    <div class="fw-bold mb-3" style="font-size: 2em; color:red;">Obat yang dipesan</div>
                    <div class="row fw-semibold text-secondary mb-2" style="font-size: 1.1em;">
                        <div class="col-6">Nama Produk</div>
                        <div class="col-2 text-center">Harga Satuan</div>
                        <div class="col-2 text-center">Jumlah</div>
                        <div class="col-2 text-end">Subtotal</div>
                    </div>
                    <div class="row align-items-center py-2" style="border-bottom:1px solid #f0f0f0;">
                        <div class="col-6">
                            Paracetamol 500mg Strip
                        </div>
                        <div class="col-2 text-center">
                            Rp5.000
                        </div>
                        <div class="col-2 text-center">
                            2
                        </div>
                        <div class="col-2 text-end fw-semibold">
                            Rp10.000
                        </div>
                    </div>
                    <!-- Tambahkan baris produk lain di sini jika perlu -->

                    <div class="row mt-4">
                        <div class="col-md-6 mb-2">
                            <div class="p-3 bg-light rounded d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-semibold fs-5">Opsi pengiriman</span>
                                    <select class="form-select fw-bold fs-5 ms-2" style="width:auto;min-width:120px;">
                                        <option selected>Reguler</option>
                                        <option>Express</option>
                                        <option>Kilat</option>
                                    </select>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-semibold fs-5">Harga ongkir</span>
                                    <span class="fw-bold fs-5">Rp10.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-2">
                            <div class="p-3 bg-light rounded text-center">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold" style="font-size:2em;">Total pesanan</span>
                                    <span class="text-secondary" style="font-size:1em;">Rp10.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-100 mb-4 p-4 bg-secondary rounded text-white">
                    <!-- Kolom 3 -->
                    Kolom 3
                </div>
            </div>
        </div><!-- Checkout Section End-->

    <!-- Main Wrapper End -->

    <!-- JS Assets -->
    <script src="{{ asset('fe/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <script src="{{ asset('fe/js/popper.min.js') }}"></script>
    <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('fe/js/plugins.js') }}"></script>
    <script src="{{ asset('fe/js/ajax-mail.js') }}"></script>
    <script src="{{ asset('fe/js/main.js') }}"></script>
</body>
@endsection
