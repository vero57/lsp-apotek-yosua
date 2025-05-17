@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Daftar Penjualan</h2>
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
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- Ambil data penjualan dari controller --}}
                @forelse($penjualan as $i => $item)
                <tr>
                    <td>{{ $i+1 }}</td>
                    <td>{{ $item->metodeBayar ? $item->metodeBayar->metode_pembayaran : '-' }}</td>
                    <td>{{ $item->tgl_penjualan }}</td>
                    <td>
                        @if($item->url_resep)
                            <a href="{{ asset('storage/' . $item->url_resep) }}" target="_blank">Lihat Resep</a>
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->ongkos_kirim }}</td>
                    <td>{{ $item->biaya_app }}</td>
                    <td>{{ $item->total_bayar }}</td>
                    <td>
                        <form id="status-form-{{ $item->id }}" action="{{ route('penjualan.updateStatus') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <select name="status" class="form-control form-control-sm d-inline-block" style="width:auto;display:inline-block;">
                                @foreach($enum as $status)
                                    <option value="{{ $status }}" @if($item->status_order == $status) selected @endif>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    </td>
                    <td>{{ $item->keterangan_status }}</td>
                    <td>
                        {{ $item->jenisPengiriman ? $item->jenisPengiriman->nama_jenis_pengiriman : '-' }}
                    </td>
                    <td>{{ $item->pelanggan ? $item->pelanggan->nama_pelanggan : '-' }}</td>
                    <td>
                        <button type="submit" class="btn btn-success btn-sm" title="Simpan Status"
                            form="status-form-{{ $item->id }}">
                            <i class="fa fa-check"></i>
                        </button>
                        <form action="{{ route('penjualan.cancelOrder') }}" method="POST" style="display:inline;" class="cancel-order-form">
                            @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-danger btn-sm" title="Batalkan Pesanan">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="12" class="text-center">Belum ada data penjualan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

@push('scripts')
@endpush
