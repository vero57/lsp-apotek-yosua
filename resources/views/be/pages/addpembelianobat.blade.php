@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add Pembelian Obat</h2>
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
    <form action="{{ route($routePrefix . '.store') }}" method="POST" id="form-add-pembelian">
        @csrf
        <div class="form-group mb-3">
            <label for="nonota">No Nota</label>
            <input type="text" class="form-control w-100" id="nonota" name="nonota" required value="{{ old('nonota') }}">
        </div>
        <div class="form-group mb-3">
            <label for="tgl_pembelian">Tanggal Pembelian</label>
            <input type="date" class="form-control w-100" id="tgl_pembelian" name="tgl_pembelian" required value="{{ old('tgl_pembelian') }}">
        </div>
        <div class="form-group mb-3">
            <label for="id_obat">Nama Obat</label>
            <select class="form-control w-100" id="id_obat" name="id_obat" required>
                <option value="">-- Pilih Obat --</option>
                @foreach($obats as $obat)
                    <option value="{{ $obat->id }}" {{ old('id_obat') == $obat->id ? 'selected' : '' }}>
                        {{ $obat->nama_obat }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group mb-3">
            <label for="jumlah_beli">Jumlah Beli</label>
            <input type="number" class="form-control w-100" id="jumlah_beli" name="jumlah_beli" min="1" required value="{{ old('jumlah_beli') }}">
        </div>
        <div class="form-group mb-3">
            <label for="harga_beli">Harga Beli</label>
            <input type="text" class="form-control w-100" id="harga_beli" name="harga_beli" required value="{{ old('harga_beli') }}">
        </div>
        <div class="form-group mb-3">
            <label for="subtotal">Subtotal</label>
            <input type="text" class="form-control w-100" id="subtotal" name="subtotal" readonly value="{{ old('subtotal') }}">
        </div>
        <div class="form-group mb-3">
            <label for="id_distributor">Distributor</label>
            <select class="form-control w-100" id="id_distributor" name="id_distributor" required>
                <option value="">-- Pilih Distributor --</option>
                @foreach($distributors as $distributor)
                    <option value="{{ $distributor->id }}" {{ old('id_distributor') == $distributor->id ? 'selected' : '' }}>
                        {{ $distributor->nama_distributor }}
                    </option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Pembelian</button>
        <a href="{{ route($routePrefix) }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jumlahBeliInput = document.getElementById('jumlah_beli');
    const hargaBeliInput = document.getElementById('harga_beli');
    const subtotalInput = document.getElementById('subtotal');
    const form = document.getElementById('form-add-pembelian');

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

    // Remove dots before submit so value is numeric
    form.addEventListener('submit', function(e) {
        hargaBeliInput.value = parseNumber(hargaBeliInput.value);
        subtotalInput.value = parseNumber(subtotalInput.value);
    });
});
</script>
@endsection
