@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Edit Obat</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('be.admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nama_obat">Nama Obat</label>
            <input type="text" class="form-control w-100" id="nama_obat" name="nama_obat" required value="{{ old('nama_obat', $product->nama_obat) }}">
        </div>
        <div class="form-group mb-3">
            <label for="idjenis">Jenis Obat</label>
            <select class="form-control w-100" id="idjenis" name="idjenis" required>
                <option value="">-- Pilih Jenis Obat --</option>
                @foreach($jenisObat as $jenis)
                    <option value="{{ $jenis->id }}" {{ old('idjenis', $product->idjenis) == $jenis->id ? 'selected' : '' }}>{{ $jenis->jenis }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="text" class="form-control w-100" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', isset($product->harga_beli) ? number_format($product->harga_beli, 0, '', '.') : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="margin">Margin (%)</label>
            <input type="number" class="form-control w-100" id="margin" name="margin" min="0" max="100" value="{{ old('margin', isset($product->margin) ? $product->margin : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="harga_jual">Harga Jual</label>
            <input type="text" class="form-control w-100" id="harga_jual" name="harga_jual" required readonly value="{{ old('harga_jual', number_format((int) $product->harga_jual, 0, '', '.')) }}">
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi_obat">Deskripsi Obat</label>
            <textarea class="form-control w-100" id="deskripsi_obat" name="deskripsi_obat" rows="3" required>{{ old('deskripsi_obat', $product->deskripsi_obat) }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="foto1">Foto 1</label>
            @if($product->foto1)
                <div class="mb-2"><img src="{{ asset('storage/' . $product->foto1) }}" alt="foto1" width="60"></div>
            @endif
            <input type="file" class="form-control w-100" id="foto1" name="foto1" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="foto2">Foto 2</label>
            @if($product->foto2)
                <div class="mb-2"><img src="{{ asset('storage/' . $product->foto2) }}" alt="foto2" width="60"></div>
            @endif
            <input type="file" class="form-control w-100" id="foto2" name="foto2" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="foto3">Foto 3</label>
            @if($product->foto3)
                <div class="mb-2"><img src="{{ asset('storage/' . $product->foto3) }}" alt="foto3" width="60"></div>
            @endif
            <input type="file" class="form-control w-100" id="foto3" name="foto3" accept="image/*">
        </div>
        <div class="form-group mb-3">
            <label for="stok">Stok</label>
            <input type="number" class="form-control w-100" id="stok" name="stok" required min="0" value="{{ old('stok', $product->stok) }}">
        </div>
        <button type="submit" class="btn btn-primary">Update Obat</button>
        <a href="{{ route('be.admin.products') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const hargaBeliInput = document.getElementById('harga_beli');
    const marginInput = document.getElementById('margin');
    const hargaJualInput = document.getElementById('harga_jual');

    function parseNumber(str) {
        return parseInt((str || '').toString().replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
    }

    function formatRupiah(angka) {
        if (!angka) return '';
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function hitungHargaJual() {
        const hargaBeli = parseNumber(hargaBeliInput.value);
        const margin = parseFloat(marginInput.value) || 0;
        const hargaJual = hargaBeli + (hargaBeli * margin / 100);
        hargaJualInput.value = hargaJual ? formatRupiah(Math.round(hargaJual)) : '';
    }

    if (hargaBeliInput && marginInput && hargaJualInput) {
        hargaBeliInput.addEventListener('input', function() {
            let value = this.value.replace(/\./g, '').replace(/[^0-9]/g, '');
            this.value = value ? formatRupiah(value) : '';
            hitungHargaJual();
        });
        marginInput.addEventListener('input', hitungHargaJual);
        // Set initial value on page load
        hitungHargaJual();
    }
});
</script>
@endsection
