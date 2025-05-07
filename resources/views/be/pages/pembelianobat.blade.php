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
            @php
                $user = Auth::guard('web')->user();
                $isApotekar = $user && $user->jabatan === 'apotekar';
                $routePrefix = $isApotekar ? 'be.apotekar.pembelianobat' : 'be.admin.pembelianobat';
            @endphp
            <a href="{{ route('be.admin.pembelianobat.detail.create') }}" class="btn btn-primary mr-2">Add Detail</a>
            <a href="{{ route($routePrefix . '.create') }}" class="btn btn-primary mr-2">Add Pembelian</a>
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
                        <button type="button" class="btn btn-sm btn-info btn-detail-pembelian" data-toggle="modal" data-target="#modalDetailPembelian" data-id="{{ $pembelian->id }}">
                            Detail
                        </button>
                        <a href="{{ route($routePrefix . '.edit', $pembelian->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route($routePrefix . '.destroy', $pembelian->id) }}" method="POST" style="display:inline;" class="delete-pembelian-form">
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

<!-- Modal Detail Pembelian -->
<div class="modal fade" id="modalDetailPembelian" tabindex="-1" role="dialog" aria-labelledby="modalDetailPembelianLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalDetailPembelianLabel">Detail Pembelian</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="detail-loading" style="display:none;text-align:center;">
            <span>Loading...</span>
        </div>
        <div id="detail-content">
            <div class="text-center text-muted">Belum ada detail pembelian.</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
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


    document.querySelectorAll('.btn-detail-pembelian').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var pembelianId = btn.getAttribute('data-id');
            var loading = document.getElementById('detail-loading');
            var content = document.getElementById('detail-content');
            loading.style.display = 'block';
            content.innerHTML = '';
            fetch('/admin/pembelian-obat/' + pembelianId + '/detail')
                .then(res => res.json())
                .then(data => {
                    loading.style.display = 'none';
                    if (data.success && data.details.length > 0) {
                        let html = `<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Obat</th>
                                    <th>Jumlah Beli</th>
                                    <th>Harga Beli</th>
                                    <th>Subtotal</th>
                                    <th>No Nota</th>
                                </tr>
                            </thead>
                            <tbody>`;
                        data.details.forEach(function(row) {
                            html += `<tr>
                                <td>${row.nama_obat}</td>
                                <td>${row.jumlah_beli}</td>
                                <td>Rp. ${parseInt(row.harga_beli).toLocaleString('id-ID')}</td>
                                <td>Rp. ${parseInt(row.subtotal).toLocaleString('id-ID')}</td>
                                <td>${row.nonota}</td>
                            </tr>`;
                        });
                        html += `</tbody></table>`;
                        content.innerHTML = html;
                    } else {
                        content.innerHTML = '<div class="text-center text-muted">Belum ada detail pembelian.</div>';
                    }
                })
                .catch(() => {
                    loading.style.display = 'none';
                    content.innerHTML = '<div class="alert alert-danger">Gagal mengambil data.</div>';
                });
        });
    });
});
</script>
@endsection
