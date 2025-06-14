@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add Jenis Obat</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('be.admin.products.storejenis') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group mb-3">
            <label for="jenis">Jenis</label>
            <input type="text" class="form-control w-100" id="jenis" name="jenis" required value="{{ old('jenis') }}">
        </div>
        <div class="form-group mb-3">
            <label for="deskripsi_jenis">Deskripsi Jenis</label>
            <textarea class="form-control w-100" id="deskripsi_jenis" name="deskripsi_jenis" rows="3" required>{{ old('deskripsi_jenis') }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="image_url">Image</label>
            <input type="file" class="form-control w-100" id="image_url" name="image_url" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Add Jenis Obat</button>
        <a href="{{ route('be.admin.products') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
