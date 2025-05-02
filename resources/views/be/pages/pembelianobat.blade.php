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
        <div class="d-flex align-items-center">
            <h2 class="h5 mb-0 mr-2">List Pembelian Obat</h2>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('be.admin.pembelianobat.create') }}" class="btn btn-primary mr-2">Add Pembelian</a>
            <form method="GET" action="" class="form-inline ml-2" style="max-width: 250px;">
                <div class="input-group w-100">
                    <input type="text" name="search" class="form-control" placeholder="Cari no nota/distributor..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>No Nota</th>
                    <th>Tgl Pembelian</th>
                    <th>Total Bayar</th>
                    <th>Distributor</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pembelianobat as $pembelian)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pembelian->nonota }}</td>
                    <td>{{ $pembelian->tgl_pembelian }}</td>
                    <td>{{ 'Rp. ' . number_format((int) $pembelian->total_bayar, 0, ',', '.') }}</td>
                    <td>{{ $pembelian->distributor ? $pembelian->distributor->nama_distributor : '-' }}</td>
                    <td>
                        <a href="{{ route('be.admin.pembelianobat.edit', $pembelian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('be.admin.pembelianobat.destroy', $pembelian->id) }}" method="POST" style="display:inline;" class="delete-pembelian-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-delete-pembelian">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada data pembelian obat.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete-pembelian').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Pembelian?',
                text: 'Apakah anda yakin ingin menghapus data pembelian ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        });
    });
});
</script>
@endsection
