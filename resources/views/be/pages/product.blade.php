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
            <h2 id="table-title" class="h5 mb-0 mr-2">List Obat</h2>
            <button type="button" id="switch-table-btn" class="btn btn-light p-2 ml-2" title="Switch View" style="border-radius: 50%;">
                <i class="fa fa-exchange"></i>
            </button>
        </div>
        <div class="d-flex align-items-center">
            <a href="{{ route('be.admin.products.createjenis') }}" class="btn btn-primary mr-2">Add Jenis Obat</a>
            <a href="{{ route('be.admin.products.create') }}" class="btn btn-primary">Add Obat</a>
            <form method="GET" action="" class="form-inline ml-3" style="max-width: 250px;" id="search-form">
                <div class="input-group w-100">
                    <input type="text" id="search-input" name="search" class="form-control" placeholder="Cari obat..." value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
                <input type="hidden" id="table-type" name="table" value="{{ request('table', 'product') }}">
            </form>
        </div>
    </div>
    <div id="product-table" style="{{ request('table', 'product') == 'jenis' ? 'display:none;' : '' }}">
        <div class="table-responsive">
            <table class="table table-bordered table-hover mb-0">
                <thead class="thead-light">
                    <tr>
                        <th>No</th>
                        <th>Nama Obat</th>
                        <th>Jenis Obat</th>
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
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->nama_obat }}</td>
                        <td>{{ $product->jenisObat ? $product->jenisObat->jenis : '-' }}</td>
                        <td>{{ 'Rp. ' . number_format((int) $product->harga_jual, 0, ',', '.') }}</td>
                        <td>{{ $product->deskripsi_obat }}</td>
                        <td>
                            @if($product->foto1)
                                <img src="{{ asset('storage/' . $product->foto1) }}" alt="foto1" width="40">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->foto2)
                                <img src="{{ asset('storage/' . $product->foto2) }}" alt="foto2" width="40">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            @if($product->foto3)
                                <img src="{{ asset('storage/' . $product->foto3) }}" alt="foto3" width="40">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>{{ $product->stok }}</td>
                        <td>{{ $product->created_at }}</td>
                        <td>{{ $product->updated_at }}</td>
                        <td>
                            <a href="{{ route('be.admin.products.edit', $product->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('be.admin.products.destroy', $product->id) }}" method="POST" style="display:inline;" class="delete-product-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">Belum ada produk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div id="jenis-table" style="{{ request('table', 'product') == 'jenis' ? '' : 'display:none;' }}">
        @include('be.partials.jenistableobat', ['jenisObat' => $jenisObat])
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ambil status table dari query string
    let showingProduct = "{{ request('table', 'product') }}" !== 'jenis';
    const switchBtn = document.getElementById('switch-table-btn');
    const tableTitle = document.getElementById('table-title');
    const productTable = document.getElementById('product-table');
    const jenisTable = document.getElementById('jenis-table');
    const searchInput = document.getElementById('search-input');
    const searchForm = document.getElementById('search-form');
    const tableTypeInput = document.getElementById('table-type');

    function setTableState(isProduct) {
        showingProduct = isProduct;
        if (showingProduct) {
            tableTitle.textContent = 'List Obat';
            productTable.style.display = '';
            jenisTable.style.display = 'none';
            if (searchInput) searchInput.placeholder = 'Cari obat...';
            if (tableTypeInput) tableTypeInput.value = 'product';
        } else {
            tableTitle.textContent = 'Jenis Obat';
            productTable.style.display = 'none';
            jenisTable.style.display = '';
            if (searchInput) searchInput.placeholder = 'Cari jenis obat';
            if (tableTypeInput) tableTypeInput.value = 'jenis';
        }
    }

    setTableState(showingProduct);

    switchBtn.addEventListener('click', function () {
        setTableState(!showingProduct);
        const url = new URL(window.location);
        url.searchParams.set('table', showingProduct ? 'product' : 'jenis');
        window.history.replaceState({}, '', url);
    });

    // Delete confirmation with SweetAlert
    document.querySelectorAll('.delete-product-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Swal.fire({
                title: 'Yakin ingin menghapus produk ini?',
                text: "Data yang dihapus tidak dapat dikembalikan.",
                icon: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#6E7881',
                confirmButtonColor: '#7066E0',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
});
</script>
@endsection
