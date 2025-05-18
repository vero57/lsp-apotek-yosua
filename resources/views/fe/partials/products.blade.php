
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
                        <form class="form-add-to-cart" data-id="{{ $product->id }}">
                            @csrf
                            <input type="hidden" name="id_obat" value="{{ $product->id }}">
                            <input type="hidden" name="jumlah_order" value="1">
                            <button type="submit" class="btn btn-success btn-sm">Add to cart</button>
                        </form>
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

<!-- Toast Notification -->
<div id="cart-toast" style="display:none;position:fixed;top:30px;right:30px;z-index:9999;min-width:220px;">
    <div style="background:#28a745;color:#fff;padding:16px 24px;border-radius:6px;box-shadow:0 2px 8px rgba(0,0,0,0.15);font-weight:bold;">
        <span id="cart-toast-message"></span>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.form-add-to-cart').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            var formData = new FormData(form);
            fetch("{{ route('fe.cart.add') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': form.querySelector('input[name="_token"]').value,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(async res => {
                if (res.status === 401) {
                    window.location.href = "{{ route('login') }}";
                    return;
                }
                let data = await res.json();
                if (data.success) {
                    showCartToast('Berhasil ditambahkan ke keranjang!');
                    // Optional: reload header/cart count via AJAX
                    setTimeout(function(){ location.reload(); }, 1200);
                } else {
                    showCartToast(data.message || 'Gagal menambahkan ke keranjang', true);
                }
            })
            .catch(() => {
                showCartToast('Gagal menambahkan ke keranjang', true);
            });
        });
    });

    function showCartToast(message, isError = false) {
        var toast = document.getElementById('cart-toast');
        var msg = document.getElementById('cart-toast-message');
        toast.style.display = 'block';
        msg.textContent = message;
        toast.firstElementChild.style.background = isError ? '#dc3545' : '#28a745';
        setTimeout(function(){
            toast.style.display = 'none';
        }, 2000);
    }
});
</script>
