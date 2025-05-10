@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    @if(session('success'))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1800
            });
        </script>
    @endif
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Jenis Pengiriman List</h2>
        <a href="{{ route('be.admin.jenispengiriman.create') }}" class="btn btn-primary">Tambah Jenis Pengiriman</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Jenis Kirim</th>
                    <th>Nama Ekspedisi</th>
                    <th>Logo Ekspedisi</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @forelse($jenisPengiriman as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->jenis_kirim }}</td>
                    <td>{{ $item->nama_ekspedisi }}</td>
                    <td>
                        @if($item->logo_ekspedisi)
                            <img src="{{ asset('storage/' . $item->logo_ekspedisi) }}" alt="logo" width="40">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data jenis pengiriman.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
