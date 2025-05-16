@extends('fe.layouts.master')   
@section('title', 'Status Pembelian')
@section('content')

<body>
    <!-- Main Wrapper Start -->
    <div class="section" id="main-wrapper">
        <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner.jpg') }})">
            <div class="container">
                <div class="row">
                    <!-- Page Title Start -->
                    <div class="page-title text-center col">
                        <h1>Status</h1>
                    </div><!-- Page Title End -->
                </div>
            </div>
        </div><!-- Page Banner Section End-->
        <div class="blog-section section bg-gray pt-100 pb-60">
            <div class="container">
                <div class="w-100 bg-white rounded shadow-sm p-4" style="max-width:100%;margin-left:auto;margin-right:auto;">
                    <style>
                        .status-tab .fw-bold {
                            border-bottom: 3px solid transparent;
                            padding-bottom: 6px;
                            transition: color 0.2s, border-bottom 0.2s;
                        }
                        .status-tab.active .fw-bold {
                            color: #e74c3c !important;
                            border-bottom: 3px solid #e74c3c;
                        }
                    </style>
                    <div class="d-flex justify-content-between align-items-center mb-4" id="status-tabs">
                        <div class="status-tab text-center flex-fill active" data-status="diproses" style="cursor:pointer;">
                            <span id="tab-diproses" class="fw-bold">Diproses</span>
                        </div>
                        <div class="status-tab text-center flex-fill" data-status="dikirim" style="cursor:pointer;">
                            <span id="tab-dikirim" class="fw-bold">Dikirim</span>
                        </div>
                        <div class="status-tab text-center flex-fill" data-status="selesai" style="cursor:pointer;">
                            <span id="tab-selesai" class="fw-bold">Selesai</span>
                        </div>
                    </div>
                    <div id="status-content">
                        <div id="content-diproses">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Diproses</h5>
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Paracetamol 500mg</div>
                                            <div class="text-muted small">Jumlah: 2 | Harga: Rp10.000</div>
                                            <div class="text-muted small">Tanggal Pesan: 2024-06-10</div>
                                        </div>
                                        <span class="badge bg-warning text-dark ms-3">Diproses</span>
                                    </div>
                                </div>
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Amoxicillin 500mg</div>
                                            <div class="text-muted small">Jumlah: 1 | Harga: Rp15.000</div>
                                            <div class="text-muted small">Tanggal Pesan: 2024-06-09</div>
                                        </div>
                                        <span class="badge bg-warning text-dark ms-3">Diproses</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-dikirim" style="display:none;">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Dikirim</h5>
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Vitamin C 1000mg</div>
                                            <div class="text-muted small">Jumlah: 1 | Harga: Rp20.000</div>
                                            <div class="text-muted small">Tanggal Pesan: 2024-06-08</div>
                                        </div>
                                        <span class="badge bg-info text-dark ms-3">Dikirim</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="content-selesai" style="display:none;">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Selesai</h5>
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Ibuprofen 400mg</div>
                                            <div class="text-muted small">Jumlah: 1 | Harga: Rp12.000</div>
                                            <div class="text-muted small">Tanggal Pesan: 2024-06-05</div>
                                        </div>
                                        <span class="badge bg-success ms-3">Selesai</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Blog Section End-->
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
            function setActive(tab) {
                $('.status-tab').removeClass('active');
                if(tab === 'diproses') $('.status-tab[data-status="diproses"]').addClass('active');
                if(tab === 'dikirim') $('.status-tab[data-status="dikirim"]').addClass('active');
                if(tab === 'selesai') $('.status-tab[data-status="selesai"]').addClass('active');
                $('#content-diproses').toggle(tab === 'diproses');
                $('#content-dikirim').toggle(tab === 'dikirim');
                $('#content-selesai').toggle(tab === 'selesai');
            }
            $('.status-tab').on('click', function() {
                setActive($(this).data('status'));
            });
        });
    </script>
</body>
@endsection