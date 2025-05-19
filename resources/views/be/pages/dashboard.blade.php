@extends('be.layouts.app')

@section('content')
<div class="content">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-money" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>
                            {{ number_format(\App\Models\Penjualan::sum('total_bayar'), 0, ',', '.') }}
                        </h3>
                        <span class="widget-title2">Summary <i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg1"><i class="fa fa-users" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ \App\Models\User::count() }}</h3>
                        <span class="widget-title1">Users <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ \App\Models\Pelanggan::count() }}</h3>
                        <span class="widget-title2">Pelanggan <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-medkit" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ \App\Models\Product::count() }}</h3>
                        <span class="widget-title3">Obat <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-money" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ \App\Models\Penjualan::whereNotIn('status_order', ['Dibatalkan Pelanggan', 'Dibatalkan Penjual'])->count() }}</h3>
                        <span class="widget-title4">Transaksi <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-times" aria-hidden="true"></i></span>
                    <div class="dash-widget-info text-right">
                        <h3>{{ \App\Models\Penjualan::whereIn('status_order', ['Dibatalkan Pelanggan', 'Dibatalkan Penjual'])->count() }}</h3>
                        <span class="widget-title3">Transaksi Dibatalkan<i class="fa fa-times" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="card mt-4">
            <div class="card-body">
                <h5 class="card-title">Penjualan Terbaru</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover mb-0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>ID</th>
                                <th>Tanggal</th>
                                <th>Pelanggan</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($penjualan_terbaru ?? [] as $i => $item)
                                <tr>
                                    <td>{{ $i+1 }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->tgl_penjualan }}</td>
                                    <td>{{ $item->pelanggan ? $item->pelanggan->nama_pelanggan : '-' }}</td>
                                    <td>{{ number_format($item->total_bayar, 0, ',', '.') }}</td>
                                    <td>{{ $item->status_order }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Belum ada data penjualan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    <a href="{{ route('penjualan.exportPdf') }}" class="btn btn-danger">
                        <i class="fa fa-file-pdf-o"></i> Download PDF
                    </a>
                </div>
            </div>
        </div>
    </div> <!-- end .content -->
</div>
@endsection
