@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add Jenis Pengiriman</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('be.admin.jenispengiriman.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="jenis_kirim">Jenis Kirim</label>
            <input type="text" class="form-control w-100" id="jenis_kirim" name="jenis_kirim" required value="{{ old('jenis_kirim') }}">
        </div>
        <div class="form-group mb-3">
            <label for="nama_ekspedisi">Nama Ekspedisi</label>
            <input type="text" class="form-control w-100" id="nama_ekspedisi" name="nama_ekspedisi" required value="{{ old('nama_ekspedisi') }}">
        </div>
        <div class="form-group mb-3">
            <label for="logo_ekspedisi">Logo Ekspedisi</label>
            <input type="file" class="form-control w-100" id="logo_ekspedisi" name="logo_ekspedisi" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Jenis Pengiriman</button>
        <a href="{{ route('be.admin.jenispengiriman') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
