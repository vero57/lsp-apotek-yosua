<div class="row">
    <!-- Product Start-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/1.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
                <span class="label">New</span>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Holiday Candle</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <!-- Product Start-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/2.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Christmas Tree</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/3.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Santa Claus Doll</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/4.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
                <span class="label">New</span>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Holiday Cap</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/5.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Holiday Doll</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <div class="col-lg-4 col-md-6 col-12 mb-60">
        <div class="product">
            <div class="image">
                <a class="img" href="{{route ('fe.product-details')}}"><img alt="Product" src="{{ asset('fe/img/product/6.jpg') }}"/></a>
                <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
            </div>
            <div class="content">
                <div class="head fix">
                    <div class="title-category float-left">
                        <h5 class="title"><a href="{{route ('fe.product-details')}}">Holiday Candle</a></h5>
                        <a class="category" href="shop.html">Catalog</a>
                    </div>
                    <div class="price float-right">
                        <span class="new">$38</span>
                    </div>
                </div>
                <div class="action-button fix">
                    <a href="#">add to cart</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Product End-->
    <!-- Pagination Start -->
    @if (!empty($showLoadMore) && $showLoadMore)
        <div class="col-12 mt-20 d-flex justify-content-center">
            <a href="{{ route('fe.shop') }}" class="btn btn-primary rounded-pill px-4 py-2" style="font-weight: bold;">
                Load More
            </a>
        </div>
    @else
        <div class="pagination col-12 mt-20">
            <ul>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li class="arrows"><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
        </div>
    @endif
    <!-- Pagination End -->
</div>
