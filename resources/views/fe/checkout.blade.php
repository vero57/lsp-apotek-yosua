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
                                <img src="{{ $item->obat && $item->obat->foto1 ? asset('storage/' . $item->obat->foto1) : asset('fe/img/noimage.png') }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;margin-right:12px;">
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
                                    <select id="select-jenis-pengiriman" class="form-select fw-bold fs-5 ms-2" style="width:auto;min-width:180px;">
                                        <option value="">Pilih opsi pengiriman</option>
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

                    // Cek apakah ada obat keras di cart berdasarkan relasi idjenis
                    $adaObatKeras = false;
                    foreach ($cartItems as $item) {
                        // Pastikan relasi jenisObat sudah eager loaded
                        if (
                            $item->obat &&
                            $item->obat->jenisObat &&
                            isset($item->obat->jenisObat->jenis) &&
                            strtolower($item->obat->jenisObat->jenis) === 'obat keras'
                        ) {
                            $adaObatKeras = true;
                            break;
                        }
                    }
                @endphp

                @if($adaObatKeras)
                <!-- KOTAK BARU DIMULAI -->
                <div class="w-100 mb-4 p-4 bg-white rounded text-black">
                    <!-- Title mirip kotak "Obat yang dipesan" -->
                    <div class="fw-bold mb-3" style="font-size: 2em; color:red;">Resep untuk obat keras</div>
                    <div class="text-black-50 mb-3" style="font-size:1.1em;">
                        Untuk membeli obat keras, kamu harus menyertakan resep dokter
                    </div>
                    <form id="form-upload-resep" enctype="multipart/form-data">
                        <div class="mb-2">
                            <label for="resep_file" class="form-label fw-semibold">Upload Resep Dokter (jpg, jpeg, png) <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="resep_file" name="resep_file" accept=".jpg,.jpeg,.png,image/jpeg,image/png" required>
                        </div>
                        <div id="preview-resep" class="mt-2"></div>
                    </form>
                </div>
                <!-- KOTAK BARU SELESAI -->
                @endif

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
                            <button id="btn-buat-pesanan" class="btn btn-lg w-100 mt-2" style="background: #ccc; color:#fff; font-weight:bold;" disabled>Buat Pesanan</button>
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
        // --- VARIABEL UNTUK VALIDASI ---
        var adaObatKeras = {{ $adaObatKeras ? 'true' : 'false' }};
        var resepValid = !adaObatKeras; // jika tidak ada obat keras, resep dianggap valid
        var pengirimanValid = false;

        // --- FUNGSI CEK VALIDASI ---
        function updateButtonState() {
            if (resepValid && pengirimanValid) {
                $('#btn-buat-pesanan').prop('disabled', false).css('background', 'red').css('cursor', 'pointer');
            } else {
                $('#btn-buat-pesanan').prop('disabled', true).css('background', '#ccc').css('cursor', 'not-allowed');
            }
        }

        // --- EVENT PILIHAN PENGIRIMAN ---
        $('#select-jenis-pengiriman').on('change', function() {
            pengirimanValid = $(this).val() !== '';
            updateButtonState();
        });

        // --- EVENT UPLOAD RESEP (WAJIB JIKA OBAT KERAS) ---
        $('#resep_file').on('change', function(e) {
            const file = e.target.files[0];
            const preview = $('#preview-resep');
            preview.empty();
            if (file) {
                const ext = file.name.split('.').pop().toLowerCase();
                if (['jpg', 'jpeg', 'png'].includes(ext)) {
                    const reader = new FileReader();
                    reader.onload = function(ev) {
                        preview.html('<img src="'+ev.target.result+'" alt="Preview Resep" style="max-width:200px;max-height:200px;border-radius:8px;border:1px solid #ccc;">');
                    };
                    reader.readAsDataURL(file);
                    resepValid = true;
                } else {
                    preview.html('<span class="text-danger">Format file tidak didukung. Hanya jpg, jpeg, png.</span>');
                    $(this).val('');
                    resepValid = false;
                }
            } else {
                resepValid = false;
            }
            updateButtonState();
        });

        // --- INISIALISASI BUTTON STATE ---
        updateButtonState();

        // --- HANDLE KLIK BUTTON BUAT PESANAN ---
        $('#btn-buat-pesanan').on('click', function(e) {
            e.preventDefault();
            if (!resepValid || !pengirimanValid) return;

            var formData = new FormData();
            formData.append('_token', '{{ csrf_token() }}');
            // Tambahkan id_jenis_kirim ke formData
            formData.append('id_jenis_kirim', $('#select-jenis-pengiriman').val());
            // Jika ada file resep, tambahkan ke formData
            var resepInput = $('#resep_file')[0];
            if (resepInput && resepInput.files.length > 0) {
                formData.append('resep_file', resepInput.files[0]);
            }
            $.ajax({
                url: '{{ route("fe.checkout.pay") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if(res.snapToken) {
                        window.snap.pay(res.snapToken, {
                            onSuccess: function(result){
                                var confirmData = new FormData();
                                confirmData.append('_token', '{{ csrf_token() }}');
                                confirmData.append('midtrans_result', JSON.stringify(result));
                                confirmData.append('id_jenis_kirim', $('#select-jenis-pengiriman').val());
                                if (resepInput && resepInput.files.length > 0) {
                                    confirmData.append('resep_file', resepInput.files[0]);
                                }
                                $.ajax({
                                    url: '{{ route("fe.checkout.pay") }}',
                                    type: 'POST',
                                    data: confirmData,
                                    processData: false,
                                    contentType: false,
                                    success: function() {
                                        window.location.reload();
                                    }
                                });
                            },
                            onPending: function(result){
                                var confirmData = new FormData();
                                confirmData.append('_token', '{{ csrf_token() }}');
                                confirmData.append('midtrans_result', JSON.stringify(result));
                                confirmData.append('id_jenis_kirim', $('#select-jenis-pengiriman').val());
                                if (resepInput && resepInput.files.length > 0) {
                                    confirmData.append('resep_file', resepInput.files[0]);
                                }
                                $.ajax({
                                    url: '{{ route("fe.checkout.pay") }}',
                                    type: 'POST',
                                    data: confirmData,
                                    processData: false,
                                    contentType: false,
                                    success: function() {
                                        window.location.reload();
                                    }
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

    // Preview resep image (non-GIF only)
    $('#resep_file').on('change', function(e) {
        const file = e.target.files[0];
        const preview = $('#preview-resep');
        preview.empty();
        if (file) {
            const ext = file.name.split('.').pop().toLowerCase();
            if (['jpg', 'jpeg', 'png'].includes(ext)) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    preview.html('<img src="'+ev.target.result+'" alt="Preview Resep" style="max-width:200px;max-height:200px;border-radius:8px;border:1px solid #ccc;">');
                };
                reader.readAsDataURL(file);
            } else {
                preview.html('<span class="text-danger">Format file tidak didukung. Hanya jpg, jpeg, png.</span>');
                $(this).val('');
            }
        }
    });
    </script>
@endsection
