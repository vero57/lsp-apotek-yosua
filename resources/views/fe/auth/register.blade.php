<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('fe/css/loginRegister.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('fe/img/favicon.ico') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-form-side">
            <div class="text-center mb-4">
                <!-- <img src="{{ asset('favicon.ico') }}" alt="Logo" style="width:48px; margin-bottom:10px;"> -->
                <h2 class="mb-2">Register</h2>
                <p class="text-muted mb-0">Create your account to get started.</p>
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <!-- Nama -->
                <div class="form-group mb-3">
                    <label for="name" class="fw-semibold">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required autofocus value="{{ old('name') }}">
                </div>
                <!-- Email -->
                <div class="form-group mb-3">
                    <label for="email" class="fw-semibold">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
                </div>
                <!-- Password -->
                <div class="form-group mb-3">
                    <label for="password" class="fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <!-- Konfirmasi Password -->
                <div class="form-group mb-3">
                    <label for="password_confirmation" class="fw-semibold">Confirm Password</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Register</button>
                <div class="mt-3 text-center">
                    <span class="text-muted">Already have an account?</span>
                    <a href="{{ route('login') }}" class="fw-semibold">Login</a>
                </div>
            </form>
        </div>
        <div class="auth-image-side">
            <img src="{{ asset('fe/img/login-image.png') }}" alt="Register Illustration" style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
</div>
</body>
</html>
