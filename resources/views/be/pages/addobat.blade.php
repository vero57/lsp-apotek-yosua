@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add New Obat</h2>
    <form action="{{ route('be.admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" class="form-control w-100" id="nama_obat" name="nama_obat" required>
        </div>
        <div class="form-group mb-3">
            <label for="idjenis">Jenis Obat</label>
            <select class="form-control w-100" id="idjenis" name="idjenis" required>
                <option value="">-- Pilih Jenis Obat --</option>
                @foreach($jenisObat as $jenis)
                    <option value="{{ $jenis->id }}">{{ $jenis->jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="harga_jual">Harga Jual</label>
            <input type="text" class="form-control w-100" id="harga_jual" name="harga_jual" required>
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi_obat">Deskripsi Obat</label>
            <textarea class="form-control w-100" id="deskripsi_obat" name="deskripsi_obat" rows="3" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="foto1">Foto 1</label>
            <input type="file" class="form-control w-100" id="foto1" name="foto1" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="foto2">Foto 2</label>
            <input type="file" class="form-control w-100" id="foto2" name="foto2" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="foto3">Foto 3</label>
            <input type="file" class="form-control w-100" id="foto3" name="foto3" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" class="form-control w-100" id="stok" name="stok" required min="0">
        </div>
        <button type="submit" class="btn btn-primary">Add Obat</button>
        <a href="{{ route('be.admin.products') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hargaInput = document.getElementById('harga_jual');
    if (hargaInput) {
        hargaInput.addEventListener('input', function(e) {
            let value = this.value.replace(/\D/g, '');
            if (value) {
                this.value = parseInt(value).toLocaleString('id-ID');
            } else {
                this.value = '';
            }
        });
    }
});
</script>
@endsection
