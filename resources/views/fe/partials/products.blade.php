<div class="row">
    @php
        $products = $products ?? collect();
    @endphp
    @foreach($products as $product)
        <div class="col-lg-4 col-md-6 col-12 mb-60">
            <div class="product">
                <div class="image">
                    <a class="img" href="{{ route('fe.product-details', ['id' => $product->id]) }}">
                        <img alt="{{ $product->nama_obat }}"
                             src="{{ $product->foto1 ? asset('storage/' . ltrim($product->foto1, '/')) : asset('fe/img/product/default.jpg') }}"/>
                    </a>
                    <a class="wishlist" href="#"><i class="fa fa-heart-o"></i></a>
                    @if($loop->first)
                        <span class="label">New</span>
                    @endif
                </div>
                <div class="content">
                    <div class="head fix">
                        <div class="title-category float-left">
                            <h5 class="title">
                                <a href="{{ route('fe.product-details', ['id' => $product->id]) }}">{{ $product->nama_obat }}</a>
                            </h5>
                            <a class="category" href="#">{{ $product->jenisObat->jenis ?? '-' }}</a>
                        </div>
                        <div class="price float-right">
                            <span class="new">Rp.{{ number_format($product->harga_jual, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="action-button fix">
                        @auth('pelanggan')
                            <a href="#">add to cart</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endforeach
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
