<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('fe/css/loginRegister.css') }}" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="{{ asset('fe/img/favicon.ico') }}">
</head>
<body>
<div class="auth-wrapper">
    <div class="auth-card">
        <div class="auth-form-side">
            <div class="text-center mb-4">
                <!-- <img src="{{ asset('fe/img/footer-logo.png') }}" alt="Logo" style="width:48px; margin-bottom:10px;"> -->
                <h2 class="mb-2">Login</h2>
                <p class="text-muted mb-0">Welcome back! Please login to your account.</p>
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label for="email" class="fw-semibold">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}">
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="fw-semibold">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-check mb-3">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember Me</label>
                </div>
                <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
                <div class="mt-3 text-center">
                    <span class="text-muted">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="fw-semibold">Register</a>
                </div>
            </form>
        </div>
        <div class="auth-image-side">
            <img src="{{ asset('fe/img/login-image.png') }}" alt="Login Illustration" style="width:100%; height:100%; object-fit:cover;">
        </div>
    </div>
</div>
</body>
</html>
