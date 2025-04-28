<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.header')
    <div class="d-flex align-items-stretch">
        @include('partials.sidebar')
        <div class="page-content">
            @yield('content')
            @include('partials.footer')
        </div>
    </div>
    @include('partials.scripts')
</body>
</html>
