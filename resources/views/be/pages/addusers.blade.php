@extends('be.layouts.app')

@section('content')
<div class="page-content" style="padding: 24px;">
    <h2 class="h5 mb-4">Add New User</h2>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('be.admin.users.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" class="form-control w-100" id="name" name="name" required value="{{ old('name') }}">
        </div>
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control w-100" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control w-100" id="password" name="password" required>
        </div>
        <div class="form-group mb-3">
            <label for="jabatan">Jabatan</label>
            <select class="form-control w-100" id="jabatan" name="jabatan" required>
                <option value="">-- Pilih Jabatan --</option>
                @foreach($jabatans as $jabatan)
                    <option value="{{ $jabatan }}" {{ old('jabatan') == $jabatan ? 'selected' : '' }}>{{ $jabatan }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add User</button>
        <a href="{{ route('be.admin.users') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
