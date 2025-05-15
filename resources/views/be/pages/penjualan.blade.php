@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Daftar Penjualan</h2>
        {{-- Tombol tambah penjualan jika diperlukan --}}
        {{-- <a href="#" class="btn btn-primary">Tambah Penjualan</a> --}}
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Metode Pembayaran</th>
                    <th>Tanggal Penjualan</th>
                    <th>URL Resep</th>
                    <th>Ongkos Kirim</th>
                    <th>Biaya App</th>
                    <th>Total Bayar</th>
                    <th>Status Order</th>
                    <th>Keterangan Status</th>
                    <th>Jenis Pengiriman</th>
                    <th>Pelanggan</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @php
                $penjualan = [
                    [
                        'metode_bayar' => 'Transfer Bank',
                        'tgl_penjualan' => '2024-06-01',
                        'url_resep' => null,
                        'ongkos_kirim' => 10000,
                        'biaya_app' => 2000,
                        'total_bayar' => 50000,
                        'status_order' => 'Selesai',
                        'keterangan_status' => 'Pesanan diterima',
                        'jenis_kirim' => 'Reguler',
                        'pelanggan' => 'Budi Santoso',
                        'created_at' => '2024-06-01 10:00:00',
                        'updated_at' => '2024-06-01 12:00:00',
                    ],
                    [
                        'metode_bayar' => 'COD',
                        'tgl_penjualan' => '2024-06-02',
                        'url_resep' => 'resep/12345.jpg',
                        'ongkos_kirim' => 12000,
                        'biaya_app' => 2500,
                        'total_bayar' => 75000,
                        'status_order' => 'Pending',
                        'keterangan_status' => 'Menunggu pembayaran',
                        'jenis_kirim' => 'Express',
                        'pelanggan' => 'Siti Aminah',
                        'created_at' => '2024-06-02 09:30:00',
                        'updated_at' => '2024-06-02 09:45:00',
                    ],
                ];
                @endphp
                @forelse($penjualan as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item['metode_bayar'] }}</td>
                    <td>{{ $item['tgl_penjualan'] }}</td>
                    <td>
                        @if($item['url_resep'])
                            <a href="{{ asset('storage/' . $item['url_resep']) }}" target="_blank">Lihat Resep</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item['ongkos_kirim'] }}</td>
                    <td>{{ $item['biaya_app'] }}</td>
                    <td>{{ $item['total_bayar'] }}</td>
                    <td>{{ $item['status_order'] }}</td>
                    <td>{{ $item['keterangan_status'] }}</td>
                    <td>{{ $item['jenis_kirim'] }}</td>
                    <td>{{ $item['pelanggan'] }}</td>
                    <td>{{ $item['created_at'] }}</td>
                    <td>{{ $item['updated_at'] }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="13" class="text-center">Belum ada data penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
