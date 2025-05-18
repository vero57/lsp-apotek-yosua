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
                        <div class="status-tab text-center flex-fill" data-status="dibatalkan" style="cursor:pointer;">
                            <span id="tab-dibatalkan" class="fw-bold">Dibatalkan</span>
                        </div>
                        <div class="status-tab text-center flex-fill" data-status="selesai" style="cursor:pointer;">
                            <span id="tab-selesai" class="fw-bold">Selesai</span>
                        </div>
                    </div>
                    <div id="status-content">
                        <div id="content-diproses">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Diproses</h5>
                                @php
                                    // Group penjualan by status
                                    $userId = session('user_id');
                                    $penjualanDiproses = \App\Models\Penjualan::with(['pelanggan', 'metodeBayar'])
                                        ->where('id_pelanggan', $userId)
                                        ->where('status_order', 'Menunggu Konfirmasi')
                                        ->orderByDesc('tgl_penjualan')
                                        ->get();
                                @endphp
                                @forelse($penjualanDiproses as $item)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Order id #{{ $item->id }}</div>
                                            <div class="text-muted small">Total: Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-muted small">Tanggal Pesan: {{ $item->tgl_penjualan }}</div>
                                        </div>
                                        <span class="badge bg-warning text-dark  ms-3">{{ $item->status_order ?? 'Diproses' }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted">Tidak ada pesanan diproses.</div>
                                @endforelse
                            </div>
                        </div>
                        <div id="content-dikirim" style="display:none;">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Dikirim</h5>
                                @php
                                    $penjualanDikirim = \App\Models\Penjualan::with(['pelanggan', 'metodeBayar'])
                                        ->where('id_pelanggan', $userId)
                                        ->where(function($q){
                                            $q->where('status_order', 'Dikirim')
                                              ->orWhere('status_order', 'Menunggu Kurir');
                                        })
                                        ->orderByDesc('tgl_penjualan')
                                        ->get();
                                @endphp
                                @forelse($penjualanDikirim as $item)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Order #{{ $item->id }}</div>
                                            <div class="text-muted small">Total: Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-muted small">Tanggal Pesan: {{ $item->tgl_penjualan }}</div>
                                        </div>
                                        <span class="badge bg-info text-white ms-3">{{ $item->status_order ?? 'Dikirim' }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted">Tidak ada pesanan dikirim.</div>
                                @endforelse
                            </div>
                        </div>
                        <div id="content-dibatalkan" style="display:none;">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Dibatalkan</h5>
                                @php
                                    $penjualanDibatalkan = \App\Models\Penjualan::with(['pelanggan', 'metodeBayar'])
                                        ->where('id_pelanggan', $userId)
                                        ->where(function($q){
                                            $q->where('status_order', 'Dibatalkan')
                                              ->orWhere('status_order', 'Dibatalkan Penjual');
                                        })
                                        ->orderByDesc('tgl_penjualan')
                                        ->get();
                                @endphp
                                @forelse($penjualanDibatalkan as $item)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Order #{{ $item->id }}</div>
                                            <div class="text-muted small">Total: Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-muted small">Tanggal Pesan: {{ $item->tgl_penjualan }}</div>
                                        </div>
                                        <span class="badge bg-danger ms-3 text-white">{{ $item->status_order ?? 'Dibatalkan' }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted">Tidak ada pesanan dibatalkan.</div>
                                @endforelse
                            </div>
                        </div>
                        <div id="content-selesai" style="display:none;">
                            <div class="mb-3">
                                <h5 class="fw-bold mb-3">Pesanan Selesai</h5>
                                @php
                                    $penjualanSelesai = \App\Models\Penjualan::with(['pelanggan', 'metodeBayar'])
                                        ->where('id_pelanggan', $userId)
                                        ->where('status_order', 'Selesai')
                                        ->orderByDesc('tgl_penjualan')
                                        ->get();
                                @endphp
                                @forelse($penjualanSelesai as $item)
                                <div class="card mb-3 shadow-sm">
                                    <div class="card-body d-flex align-items-center">
                                        <img src="{{ asset('fe/img/noimage.png') }}" alt="Obat" style="width:60px;height:60px;object-fit:cover;border-radius:8px;margin-right:16px;">
                                        <div class="flex-grow-1">
                                            <div class="fw-bold">Order #{{ $item->id }}</div>
                                            <div class="text-muted small">Total: Rp{{ number_format($item->total_bayar, 0, ',', '.') }}</div>
                                            <div class="text-muted small">Tanggal Pesan: {{ $item->tgl_penjualan }}</div>
                                        </div>
                                        <span class="badge bg-success ms-3 text-white">{{ $item->status_order ?? 'Selesai' }}</span>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center text-muted">Tidak ada pesanan selesai.</div>
                                @endforelse
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
                if(tab === 'dibatalkan') $('.status-tab[data-status="dibatalkan"]').addClass('active');
                if(tab === 'selesai') $('.status-tab[data-status="selesai"]').addClass('active');
                $('#content-diproses').toggle(tab === 'diproses');
                $('#content-dikirim').toggle(tab === 'dikirim');
                $('#content-dibatalkan').toggle(tab === 'dibatalkan');
                $('#content-selesai').toggle(tab === 'selesai');
            }
            $('.status-tab').on('click', function() {
                setActive($(this).data('status'));
            });
        });
    </script>
</body>
@endsection