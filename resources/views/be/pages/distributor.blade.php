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
        <h2 class="h5 mb-0">Distributor List</h2>
        <div class="d-flex align-items-center">
            <a href="" class="btn btn-primary">Add Distributor</a>
            <form method="GET" action="" class="form-inline ml-3" style="max-width: 250px;">
                <div class="input-group w-100">
                    <input type="text" name="search" class="form-control" placeholder="Cari distributor..." value="{{ request('search') }}">
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
                    <th>Nama Distributor</th>
                    <th>Email</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($distributors as $distributor)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $distributor->nama_distributor }}</td>
                    <td>{{ $distributor->email }}</td>
                    <td>{{ $distributor->no_telp }}</td>
                    <td>{{ $distributor->alamat }}</td>
                    <td>{{ $distributor->created_at }}</td>
                    <td>{{ $distributor->updated_at }}</td>
                    <td>
                        <a href="{{ route('be.admin.distributor.edit', $distributor->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('be.admin.distributor.destroy', $distributor->id) }}" method="POST" class="d-inline delete-distributor-form">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-sm btn-danger btn-delete-distributor">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center">Belum ada distributor.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.btn-delete-distributor').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Hapus Distributor?',
                text: 'Apakah anda yakin ingin menghapus distributor ini?',
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
