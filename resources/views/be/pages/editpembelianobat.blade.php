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
    <form action="{{ route('be.admin.pembelianobat.update', $pembelianobat->id) }}" method="POST" id="form-edit-pembelian">
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
            <label for="total_bayar">Total Bayar</label>
            <input type="text" class="form-control w-100" id="total_bayar" name="total_bayar" required value="{{ old('total_bayar', number_format($pembelianobat->total_bayar, 0, '', '.')) }}">
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
        <a href="{{ route('be.admin.pembelianobat') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const totalBayarInput = document.getElementById('total_bayar');
    const form = document.getElementById('form-edit-pembelian');

    // Format input as user types
    totalBayarInput.addEventListener('input', function(e) {
        let value = this.value.replace(/\./g, '').replace(/[^0-9]/g, '');
        if (value) {
            this.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        } else {
            this.value = '';
        }
    });

    // Remove dots before submit so value is numeric
    form.addEventListener('submit', function(e) {
        totalBayarInput.value = totalBayarInput.value.replace(/\./g, '');
    });
});
</script>
@endsection
