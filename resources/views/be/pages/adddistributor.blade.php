@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add Distributor</h2>
    <form action="{{ route('be.admin.distributor.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nama_distributor">Nama Distributor</label>
            <input type="text" class="form-control w-100" id="nama_distributor" name="nama_distributor" required>
        </div>
        <div class="form-group mb-3">
            <label for="telepon">Telepon</label>
            <input type="text" class="form-control w-100" id="telepon" name="telepon" required>
        </div>
        <div class="form-group mb-3">
            <label for="alamat">Alamat</label>
            <textarea class="form-control w-100" id="alamat" name="alamat" rows="2" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Add Distributor</button>
        <a href="{{ route('be.admin.distributor') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
