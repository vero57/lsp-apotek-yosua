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
        <h2 class="h5 mb-0">Product List</h2>
        <a href="{{ route('be.admin.products.create') }}" class="btn btn-primary">Add Product</a>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover mb-0">
            <thead class="thead-light">
                <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Harga Jual</th>
                    <th>Deskripsi Obat</th>
                    <th>Foto 1</th>
                    <th>Foto 2</th>
                    <th>Foto 3</th>
                    <th>Stok</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Hexellnaw</td>
                    <td>5000</td>
                    <td>Obat penumbuh kanker.</td>
                    <td><img src="https://via.placeholder.com/40" alt="foto1"></td>
                    <td><img src="https://via.placeholder.com/40" alt="foto2"></td>
                    <td><img src="https://via.placeholder.com/40" alt="foto3"></td>
                    <td>100</td>
                    <td>2024-06-01 10:00:00</td>
                    <td>2024-06-02 12:00:00</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Skibidi</td>
                    <td>12000</td>
                    <td>Obat penyubur kehamilan.</td>
                    <td><img src="https://via.placeholder.com/40" alt="foto1"></td>
                    <td><img src="https://via.placeholder.com/40" alt="foto2"></td>
                    <td><img src="https://via.placeholder.com/40" alt="foto3"></td>
                    <td>50</td>
                    <td>2024-06-03 09:30:00</td>
                    <td>2024-06-04 11:00:00</td>
                    <td>
                        <a href="#" class="btn btn-sm btn-warning">Edit</a>
                        <a href="#" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
