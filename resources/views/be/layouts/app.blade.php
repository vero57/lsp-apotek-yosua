<!DOCTYPE html>
<html lang="en">
<head>
    @include('be.partials.head')
</head>
<body>
    <div class="main-wrapper">
        @include('be.partials.header')
        @include('be.partials.sidebar')

        <div class="page-wrapper">
            @yield('content')
        </div>
    </div>

    @include('be.partials.footer')
</body>
</html>
