@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Edit Pembelian Obat</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @php
        $user = Auth::guard('web')->user();
        $isApotekar = $user && $user->jabatan === 'apotekar';
        $routePrefix = $isApotekar ? 'be.apotekar.pembelianobat' : 'be.admin.pembelianobat';
        if (!isset($obats)) {
            $obats = \App\Models\Product::all(['id', 'nama_obat']);
        }   
    @endphp
    <form action="{{ route($routePrefix . '.update', $pembelianobat->id) }}" method="POST" id="form-edit-pembelian">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="nonota">No Nota</label>
            <input type="text" class="form-control w-100" id="nonota" name="nonota" required value="{{ old('nonota', $pembelianobat->nonota) }}">
        </div>
        <div class="form-group mb-3">
            <label for="tgl_pembelian">Tanggal Pembelian</label>
            <input type="date" class="form-control w-100" id="tgl_pembelian" name="tgl_pembelian" required value="{{ old('tgl_pembelian', $pembelianobat->tgl_pembelian) }}">
        </div>
        {{-- Tambahkan input detail pembelian --}}
        <div class="form-group mb-3">
            <label for="id_obat">Nama Obat</label>
            <select class="form-control w-100" id="id_obat" name="id_obat" required>
                <option value="">-- Pilih Obat --</option>
                @foreach($obats as $obat)
                    <option value="{{ $obat->id }}" 
                        {{ old('id_obat', isset($detailpembelian) ? $detailpembelian->id_obat : '') == $obat->id ? 'selected' : '' }}>
                        {{ $obat->nama_obat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="jumlah_beli">Jumlah Beli</label>
            <input type="number" class="form-control w-100" id="jumlah_beli" name="jumlah_beli" min="1" value="{{ old('jumlah_beli', isset($detailpembelian) ? $detailpembelian->jumlah_beli : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="text" class="form-control w-100" id="harga_beli" name="harga_beli" value="{{ old('harga_beli', isset($detailpembelian) ? number_format($detailpembelian->harga_beli, 0, '', '.') : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="subtotal">Subtotal</label>
            <input type="text" class="form-control w-100" id="subtotal" name="subtotal" readonly value="{{ old('subtotal', isset($detailpembelian) ? number_format($detailpembelian->subtotal, 0, '', '.') : '') }}">
        </div>
        {{-- End input detail pembelian --}}
        <div class="form-group mb-3">
            <label for="id_distributor">Distributor</label>
            <select class="form-control w-100" id="id_distributor" name="id_distributor" required>
                <option value="">-- Pilih Distributor --</option>
                @foreach($distributors as $distributor)
                    <option value="{{ $distributor->id }}" {{ old('id_distributor', $pembelianobat->id_distributor) == $distributor->id ? 'selected' : '' }}>
                        {{ $distributor->nama_distributor }}
                    </option>
                @endforeach
            </select>
        </div>
        {{-- Tambahkan input hidden total_bayar agar tetap dikirim --}}
        <input type="hidden" id="total_bayar" name="total_bayar" value="{{ old('total_bayar', isset($detailpembelian) ? $detailpembelian->subtotal : $pembelianobat->total_bayar) }}">
        <button type="submit" class="btn btn-primary">Update Pembelian</button>
        <a href="{{ route($routePrefix) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahBeliInput = document.getElementById('jumlah_beli');
    const hargaBeliInput = document.getElementById('harga_beli');
    const subtotalInput = document.getElementById('subtotal');
    const totalBayarInput = document.getElementById('total_bayar');
    const form = document.getElementById('form-edit-pembelian');

    function formatRupiah(angka) {
        if (!angka) return '';
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function parseNumber(str) {
        return parseInt(str.replace(/\./g, '').replace(/[^0-9]/g, '')) || 0;
    }

    function updateSubtotal() {
        const jumlah = parseNumber(jumlahBeliInput.value);
        const harga = parseNumber(hargaBeliInput.value);
        const subtotal = jumlah * harga;
        subtotalInput.value = subtotal ? formatRupiah(subtotal) : '';
        // Set hidden total_bayar juga
        totalBayarInput.value = subtotal ? subtotal : '';
    }

    jumlahBeliInput.addEventListener('input', function() {
        if (this.value < 1) this.value = 1;
        updateSubtotal();
    });

    hargaBeliInput.addEventListener('input', function() {
        let value = this.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        if (value) {
            this.value = formatRupiah(value);
        } else {
            this.value = '';
        }
        updateSubtotal();
    });

    // Set subtotal & total_bayar on page load
    updateSubtotal();

    // Remove dots before submit so value is numeric
    form.addEventListener('submit', function(e) {
        hargaBeliInput.value = parseNumber(hargaBeliInput.value);
        subtotalInput.value = parseNumber(subtotalInput.value);
        totalBayarInput.value = parseNumber(totalBayarInput.value);
    });
});
</script>
@endsection
