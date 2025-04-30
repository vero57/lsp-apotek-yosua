<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('be/css/loginbe.css') }}">
</head>
<body>
<div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="auth-card w-100" style="max-width:400px;">
        <h3 class="auth-title text-center">Login</h3>
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <form method="POST" action="{{ route('be.login') }}">
            @csrf
            <div class="form-group mb-3">
                <label for="username">Username</label>
                <input id="username" type="text" class="form-control" name="username" required autofocus>
            </div>
            <div class="form-group mb-4">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>
        </form>
        <div class="mt-3 text-center">
            Jika belum mempunyai akun, silahkan hubungi admin untuk mendaftar.
        </div>
    </div>
</div>
</body>
</html>
