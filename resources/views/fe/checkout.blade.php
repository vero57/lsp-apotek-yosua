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
                            <div class="fw-bold" style="font-size: 1.5em">Leonardo</div>
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
                    @forelse($cartItems as $item)
                        <div class="row align-items-center py-2" style="border-bottom:1px solid #f0f0f0;">
                            <div class="col-6 d-flex align-items-center">
                                <img src="{{ $item->obat && $item->obat->foto1 ? asset('storage/' . $item->obat->foto1) : asset('fe/img/noimage.png') }}" alt="obat" style="width:48px;height:48px;object-fit:cover;border-radius:8px;margin-right:12px;">
                                <span>{{ $item->obat ? $item->obat->nama_obat : '-' }}</span>
                            </div>
                            <div class="col-2 text-center">
                                Rp{{ number_format($item->harga, 0, ',', '.') }}
                            </div>
                            <div class="col-2 text-center">
                                {{ $item->jumlah_order }}
                            </div>
                            <div class="col-2 text-end fw-semibold">
                                Rp{{ number_format($item->subtotal, 0, ',', '.') }}
                            </div>
                        </div>
                    @empty
                        <div class="row">
                            <div class="col text-center text-muted py-3">
                                Keranjang kosong
                            </div>
                        </div>
                    @endforelse

                    <div class="row mt-4">
                        <div class="col-md-6 mb-2">
                            <div class="p-3 bg-light rounded d-flex flex-column">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="fw-semibold fs-5">Opsi pengiriman</span>
                                    <select class="form-select fw-bold fs-5 ms-2" style="width:auto;min-width:120px;">
                                        @foreach($jenisPengiriman as $jenis)
                                            <option value="{{ $jenis->id }}">{{ $jenis->jenis_kirim }}</option>
                                        @endforeach
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
                                    <span class="text-secondary" style="font-size:1em;">
                                        Rp{{ number_format($cartTotal, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                    $proteksiProduk = 500;
                    $subtotalPengiriman = 10000;
                    $biayaLayanan = 2000;
                    $totalPembayaran = $cartTotal + $proteksiProduk + $subtotalPengiriman + $biayaLayanan;
                @endphp
                <div class="w-100 mb-4 p-4 bg-light rounded text-black">
                    <!-- Kolom 3: Ringkasan Pembayaran -->
                    <div class="d-flex flex-column">
                        <div class="w-100" style="max-width:350px; margin-left:auto;">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-black-50">Subtotal untuk Produk</span>
                                <span class="text-black">Rp{{ number_format($cartTotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-black-50">Total Proteksi Produk</span>
                                <span class="text-black">Rp{{ number_format($proteksiProduk, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-black-50">Subtotal Pengiriman</span>
                                <span class="text-black">Rp{{ number_format($subtotalPengiriman, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-black-50">Biaya Layanan <i class="fa fa-question-circle" title="Biaya layanan"></i></span>
                                <span class="text-black">Rp{{ number_format($biayaLayanan, 0, ',', '.') }}</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-bold" style="font-size:1.2em;">Total Pembayaran</span>
                                <span class="fw-bold" style="font-size:1.7em; color:#ff5722;">Rp{{ number_format($totalPembayaran, 0, ',', '.') }}</span>
                            </div>
                            <hr class="my-3" style="border-color: #fff; opacity:0.2;">
                        </div>
                        <div class="w-100" style="max-width:350px; margin-left:auto;">
                            <button id="btn-buat-pesanan" class="btn btn-lg w-100 mt-2" style="background:red; color:#fff; font-weight:bold;">Buat Pesanan</button>
                        </div>
                        <div class="w-100 mt-2 text-start" style="max-width:350px;">
                            <small class="text-black-50">
                                Dengan mengklik 'Buat Pesanan', kamu telah menyetujui 
                                <a href="#" class="text-info text-decoration-underline">Syarat &amp; Ketentuan Proteksi Produk</a> Pharmasheesh
                            </small>
                        </div>
                    </div>
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

    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
    $(document).ready(function() {
        $('#btn-buat-pesanan').on('click', function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route("fe.checkout.pay") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if(res.snapToken) {
                        window.snap.pay(res.snapToken, {
                            onSuccess: function(result){
                                $.post('{{ route("fe.checkout.pay") }}', {
                                    _token: '{{ csrf_token() }}',
                                    midtrans_result: JSON.stringify(result)
                                }, function() {
                                    window.location.reload();
                                });
                            },
                            onPending: function(result){

                                $.post('{{ route("fe.checkout.pay") }}', {
                                    _token: '{{ csrf_token() }}',
                                    midtrans_result: JSON.stringify(result)
                                }, function() {
                                    window.location.reload();
                                });
                            },
                            onError: function(result){ alert('Pembayaran gagal!'); }
                        });
                    } else {
                        alert('Gagal mendapatkan token pembayaran.');
                    }
                },
                error: function() {
                    alert('Gagal memproses pembayaran.');
                }
            });
        });
    });
    </script>
@endsection
