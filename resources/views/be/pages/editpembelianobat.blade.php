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
        <div class="form-group mb-3">
            <label for="jumlah_beli">Jumlah Beli</label>
            <input type="number" class="form-control w-100" id="jumlah_beli" name="jumlah_beli" min="1" value="{{ old('jumlah_beli', isset($pembelianobat->jumlah_beli) ? $pembelianobat->jumlah_beli : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="number" class="form-control w-100" id="harga_beli" name="harga_beli" min="0" value="{{ old('harga_beli', isset($pembelianobat->harga_beli) ? $pembelianobat->harga_beli : '') }}">
        </div>
        <div class="form-group mb-3">
            <label for="total_bayar">Total Bayar</label>
            <input type="text" class="form-control w-100" id="total_bayar" name="total_bayar" readonly value="{{ old('total_bayar', number_format($pembelianobat->total_bayar, 0, '', '.')) }}">
        </div>
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
        <button type="submit" class="btn btn-primary">Update Pembelian</button>
        <a href="{{ route($routePrefix) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahBeliInput = document.getElementById('jumlah_beli');
    const hargaBeliInput = document.getElementById('harga_beli');
    const totalBayarInput = document.getElementById('total_bayar');
    const form = document.getElementById('form-edit-pembelian');

    function formatRupiah(angka) {
        if (!angka) return '';
        return angka.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function updateTotalBayar() {
        const jumlah = parseInt(jumlahBeliInput.value) || 0;
        const harga = parseInt(hargaBeliInput.value) || 0;
        const total = jumlah * harga;
        totalBayarInput.value = total ? formatRupiah(total) : '';
    }

    if (jumlahBeliInput && hargaBeliInput && totalBayarInput) {
        jumlahBeliInput.addEventListener('input', updateTotalBayar);
        hargaBeliInput.addEventListener('input', updateTotalBayar);
        // Set initial value on page load
        updateTotalBayar();
    }

    // Remove dots before submit so value is numeric
    form.addEventListener('submit', function(e) {
        if (totalBayarInput) {
            totalBayarInput.value = totalBayarInput.value.replace(/\./g, '');
        }
    });
});
</script>
@endsection
