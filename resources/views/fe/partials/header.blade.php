<div class="header-section section">
    <!-- Header Top Start -->
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Header Top Wrapper Start -->
                    <div class="header-top-wrapper">
                        <div class="row">
                            <!-- Header Social -->
                            <div class="header-social col-md-4 col-12">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <!-- Header Logo -->
                            <div class="header-logo col-md-4 col-12">
                                <a class="logo" href="{{ route('fe.index') }}">
                                    <img alt="logo" src="{{ asset('fe/img/logo.png') }}"/>
                                </a>
                            </div>
                            <!-- Account Menu -->
                            <div class="account-menu col-md-4 col-12">
                                <ul>
                                    @if(session('user_id'))
                                        <li><a href="{{ route('fe.my_account') }}">My Account</a></li>
                                        <li class="{{ Request::routeIs('fe.stauts') ? 'active' : '' }}">
                                            <a href="{{ route('fe.status') }}">My Order</a>
                                        </li>
                                        <li>
                                            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" style="background:none;border:none;padding:0;margin:0;color:inherit;cursor:pointer;">Logout</button>
                                            </form>
                                        </li>
                                        <li>
                                            
                                        </li>
                                        <li>
                                            @php
                                                $cartItems = [];
                                                $cartCount = 0;
                                                $cartTotal = 0;
                                                if(session('user_id')) {
                                                    $cartItems = \App\Models\Keranjang::with('obat')
                                                        ->where('id_pelanggan', session('user_id'))
                                                        ->get();
                                                    $cartCount = $cartItems->count(); // <-- hanya jumlah item unik
                                                    $cartTotal = $cartItems->sum('subtotal');
                                                }
                                            @endphp
                                            <a data-toggle="dropdown" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span class="num">{{ $cartCount }}</span>
                                            </a>
                                            <!-- Mini Cart -->
                                            <div class="mini-cart-brief dropdown-menu text-left">
                                                <!-- Cart Products -->
                                                <div class="all-cart-product clearfix">
                                                    @forelse($cartItems as $item)
                                                        <div class="single-cart clearfix">
                                                            <div class="cart-image">
                                                                <a href="{{ $item->obat ? route('fe.product-details', ['id' => $item->obat->id]) : '#' }}">
                                                                    <img alt="" src="{{ $item->obat && $item->obat->foto1 ? asset('storage/' . $item->obat->foto1) : asset('fe/img/noimage.png') }}"/>
                                                                </a>
                                                            </div>
                                                            <div class="cart-info">
                                                                <h5>
                                                                    <a href="{{ $item->obat ? route('fe.product-details', ['id' => $item->obat->id]) : '#' }}">
                                                                        {{ $item->obat ? $item->obat->nama_obat : '-' }}
                                                                    </a>
                                                                </h5>
                                                                <p>{{ $item->jumlah_order }} x Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                                                                <a class="cart-delete" href="#" title="Remove this item" data-id="{{ $item->id }}">
                                                                    <i class="fa fa-trash-o"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class="text-center text-muted py-2">Keranjang kosong</div>
                                                    @endforelse
                                                </div>
                                                <!-- Cart Total -->
                                                <div class="cart-totals">
                                                    <h5>Total <span>Rp{{ number_format($cartTotal, 0, ',', '.') }}</span></h5>
                                                </div>
                                                <!-- Cart Button -->
                                                <div class="cart-bottom clearfix">
                                                    <a href="{{ route('fe.cart') }}">Check Cart</a>
                                                </div>
                                            </div>
                                        </li>
                                    @else
                                        <li><a href="{{ route('login') }}">Login</a></li>
                                        <li><a href="{{ route('register') }}">Register</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div><!-- Header Top Wrapper End -->
                </div>
            </div>
        </div>
    </div><!-- Header Top End -->

    <!-- Header Bottom Start -->
    <div class="header-bottom section">
        <div class="container">
            <div class="row">
                <!-- Header Bottom Wrapper Start -->
                <div class="header-bottom-wrapper text-center col">
                    <!-- Header Bottom Logo -->
                    <div class="header-bottom-logo">
                        <a class="logo" href="{{ route('fe.index') }}">
                            <img alt="logo" src="{{ asset('fe/img/logo.png') }}"/>
                        </a>
                    </div>
                    <!-- Main Menu -->
                    <nav class="main-menu" id="main-menu">
                        <ul>
                            <li class="{{ Request::routeIs('fe.index') ? 'active' : '' }}">
                                <a href="{{ route('fe.index') }}">home</a>
                            </li>
                            <li class="{{ Request::routeIs('fe.shop') ? 'active' : '' }}">
                                <a href="{{ route('fe.shop') }}">shop</a>
                            </li>
                            <li class="{{ Request::routeIs('fe.about') ? 'active' : '' }}">
                                <a href="{{ route('fe.about') }}">About</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- Header Search -->
                    <div class="header-search">
                        <!-- Search Toggle -->
                        <button class="search-toggle"><i class="ion-ios-search-strong"></i></button>
                        <!-- Search Form -->
                        <div class="header-search-form">
                            <form action="{{ route('fe.shop') }}" method="GET">
                                <input placeholder="Search..." type="text" name="q" value="{{ request('q') }}"/>
                                <button type="submit"><i class="ion-ios-search-strong"></i></button>
                            </form>
                        </div>
                    </div>
                    <!-- Mobile Menu -->
                    <div class="mobile-menu section d-md-none"></div>
                </div><!-- Header Bottom Wrapper End -->
            </div>
        </div>
    </div><!-- Header Bottom End -->
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hapus item keranjang
    document.querySelectorAll('.cart-delete').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var id = btn.getAttribute('data-id');
            fetch("{{ route('fe.cart.delete') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: new URLSearchParams({id: id})
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    // Optional: reload only cart section, for now reload page
                    location.reload();
                }
            });
        });
    });
});
</script>