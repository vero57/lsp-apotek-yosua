@extends('fe.layouts.master')

@section('title', 'Shop')

@section('content')
    <body>
        <!-- Main Wrapper Start -->
        <div class="section" id="main-wrapper">
            <!-- Header Section Start -->
            <!-- Header Section End -->
            <!-- Page Banner Section Start-->
            <div class="page-banner-section section" style="background-image: url({{ asset('fe/img/bg/page-banner.jpg') }})">
                <div class="container">
                    <div class="row">
                        <!-- Page Title Start -->
                        <div class="page-title text-center col">
                            <h1>Obat-obatan</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- Product Section Start-->
            <div class="product-section section pt-120 pb-120">
                <div class="container">
                    @if(request('q'))
                        <div class="alert alert-info mb-3">
                            Hasil pencarian untuk: <strong>{{ request('q') }}</strong>
                        </div>
                    @endif

                    <form method="GET" action="{{ route('fe.shop') }}" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <select name="jenis" class="form-control" onchange="this.form.submit()">
                                    <option value="">-- Semua Jenis Obat --</option>
                                    @foreach($jenisList as $jenis)
                                        <option value="{{ $jenis->id }}" {{ request('jenis') == $jenis->id ? 'selected' : '' }}>
                                            {{ $jenis->jenis }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>

                    <!-- Product Wrapper Start-->
                    @include('fe.partials.products', ['products' => $products])
                    <!-- Product Wrapper End-->
                </div>
            </div><!-- Product Section End-->
        </div><!-- Main Wrapper End -->
        <!-- JS
        ============================================ -->
        <!-- jQuery JS -->
        <script src="{{ asset('fe/js/vendor/jquery-1.12.0.min.js') }}"></script>
        <!-- Popper JS -->
        <script src="{{ asset('fe/js/popper.min.js') }}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('fe/js/bootstrap.min.js') }}"></script>
        <!-- Plugins JS -->
        <script src="{{ asset('fe/js/plugins.js') }}"></script>
        <!-- Ajax Mail JS -->
        <script src="{{ asset('fe/js/ajax-mail.js') }}"></script>
        <!-- Main JS -->
        <script src="{{ asset('fe/js/main.js') }}"></script>
    </body>
@endsection