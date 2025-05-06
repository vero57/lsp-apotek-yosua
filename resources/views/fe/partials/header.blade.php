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
                                        <li class="{{ Request::routeIs('fe.wishlist') ? 'active' : '' }}">
                                            <a href="{{ route('fe.wishlist') }}">Wishlist</a>
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
                                            <a data-toggle="dropdown" href="#">
                                                <i class="fa fa-shopping-cart"></i>
                                                <span class="num">2</span>
                                            </a>
                                            <!-- Mini Cart -->
                                            <div class="mini-cart-brief dropdown-menu text-left">
                                                <!-- Cart Products -->
                                                <div class="all-cart-product clearfix">
                                                    <div class="single-cart clearfix">
                                                        <div class="cart-image">
                                                            <a href="product-details.html">
                                                                <img alt="" src="img/cart/1.jpg"/>
                                                            </a>
                                                        </div>
                                                        <div class="cart-info">
                                                            <h5><a href="product-details.html">Holiday Candle</a></h5>
                                                            <p>1 x £9.00</p>
                                                            <a class="cart-delete" href="#" title="Remove this item">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="single-cart clearfix">
                                                        <div class="cart-image">
                                                            <a href="product-details.html">
                                                                <img alt="" src="img/cart/2.jpg"/>
                                                            </a>
                                                        </div>
                                                        <div class="cart-info">
                                                            <h5><a href="product-details.html">Christmas Tree</a></h5>
                                                            <p>1 x £9.00</p>
                                                            <a class="cart-delete" href="#" title="Remove this item">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Cart Total -->
                                                <div class="cart-totals">
                                                    <h5>Total <span>£12.00</span></h5>
                                                </div>
                                                <!-- Cart Button -->
                                                <div class="cart-bottom clearfix">
                                                    <a href="{{route('fe.checkout')}}">Check out</a>
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
                            <li class="{{ Request::routeIs('fe.contact') ? 'active' : '' }}">
                                <a href="{{ route('fe.contact') }}">contact</a>
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