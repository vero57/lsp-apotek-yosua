@extends('fe.layouts.master')

@section('title', 'Cart')

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
                            <h1>Cart</h1>
                        </div><!-- Page Title End -->
                    </div>
                </div>
            </div><!-- Page Banner Section End-->
            <!-- Cart Section Start-->
            <div class="cart-section section pt-120 pb-90">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive mb-30">
                                @php
                                    $cartItems = [];
                                    $cartTotal = 0;
                                    if(session('user_id')) {
                                        $cartItems = \App\Models\Keranjang::with('obat')
                                            ->where('id_pelanggan', session('user_id'))
                                            ->get();
                                        $cartTotal = $cartItems->sum('subtotal');
                                    }
                                @endphp
                                <table class="table cart-table text-center">
                                    <!-- Table Head -->
                                    <thead>
                                        <tr>
                                            <th class="select">
                                                <span class="custom-checkbox custom-checkbox-all" id="select-all-cart"></span>
                                            </th>
                                            <th class="image">image</th>
                                            <th class="name">product name</th>
                                            <th class="qty">quantity</th>
                                            <th class="price">price</th>
                                            <th class="total">total</th>
                                            <th class="remove">remove</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        @forelse($cartItems as $i => $item)
                                            <tr>
                                                <td>
                                                    <span class="custom-checkbox cart-item-checkbox" data-id="{{ $item->id }}" data-checked="1"></span>
                                                </td>
                                                <td>
                                                    <a class="cart-pro-image" href="#">
                                                        <img alt="gambar obat " src="{{ $item->obat && $item->obat->foto1 ? asset('storage/' . $item->obat->foto1) : asset('fe/img/noimage.png') }}"/>
                                                    </a>
                                                </td>
                                                <td>
                                                    <a class="cart-pro-title" href="#">{{ $item->obat ? $item->obat->nama_obat : '-' }} </a>
                                                </td>
                                                <td>
                                                    <div class="product-quantity d-flex align-items-center justify-content-center">
                                                        <button type="button" class="qty-btn qty-btn-minus" style="border:none;background:#eee;padding:4px 10px;font-size:18px;">
                                                            <i class="fa fa-angle-left"></i>
                                                        </button>
                                                        <input name="qtybox" min="1" value="{{ $item->jumlah_order }}" data-price="{{ $item->harga }}" class="cart-qty-input text-center" data-id="{{ $item->id }}" style="width:50px;" readonly>
                                                        <button type="button" class="qty-btn qty-btn-plus" style="border:none;background:#eee;padding:4px 10px;font-size:18px;">
                                                            <i class="fa fa-angle-right"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="cart-pro-price">Rp{{ number_format($item->harga, 0, ',', '.') }}</p>
                                                </td>
                                                <td>
                                                    <p class="cart-price-total">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                                </td>
                                                <td>
                                                    <button class="cart-pro-remove" data-id="{{ $item->id }}"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="text-center text-muted">Keranjang kosong</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <!-- Cart Action -->
                                <div class="cart-action col-lg-4 col-md-6 col-12 mb-30">
                                    <a class="button" href="{{ route('fe.shop') }}">Continiue Shopping</a>
                                    <button class="button" disabled>update cart</button>
                                </div>
                                <!-- Cart Cuppon -->
                                <div class="cart-cuppon col-lg-4 col-md-6 col-12 mb-30">
                                    <h4 class="title">Discount Code</h4>
                                    <p>Enter your coupon code if you have</p>
                                    <form action="#" class="cuppon-form">
                                        <input placeholder="Cuppon Code" type="text"/>
                                        <button class="button" disabled>apply coupon</button>
                                    </form>
                                </div>
                                <!-- Cart Checkout Progress -->
                                <div class="cart-checkout-process col-lg-4 col-md-6 col-12 mb-30">
                                    <h4 class="title">Process Checkout</h4>
                                    <p><span>Subtotal</span><span>Rp{{ number_format($cartTotal, 0, ',', '.') }}</span></p>
                                    <h5><span>Grand total</span><span>Rp{{ number_format($cartTotal, 0, ',', '.') }}</span></h5>
                                    <form id="checkout-form" action="{{ route('fe.cart.processCheckout') }}" method="POST">
                                        @csrf
                                        <div id="checkout-hidden-inputs">
                                            @foreach($cartItems as $item)
                                                <input type="hidden" name="cart_id[]" value="{{ $item->id }}" id="cart_id_{{ $item->id }}">
                                                <input type="hidden" name="jumlah_order[{{ $item->id }}]" id="jumlah_order_{{ $item->id }}" value="{{ $item->jumlah_order }}">
                                            @endforeach
                                        </div>
                                        <button type="submit" class="button">process to checkout</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Cart Section End-->
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
        <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.cart-pro-remove').forEach(function(btn) {
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
                            // Hapus baris dari tabel tanpa reload
                            var tr = btn.closest('tr');
                            if (tr) tr.remove();
                            // Update subtotal dan grand total
                            let total = 0;
                            document.querySelectorAll('.cart-price-total').forEach(function(td) {
                                let val = td.textContent.replace(/[^\d]/g, '');
                                total += parseInt(val) || 0;
                            });
                            document.querySelectorAll('.cart-checkout-process span:last-child').forEach(function(span) {
                                span.textContent = 'Rp' + total.toLocaleString('id-ID');
                            });
                            // Jika kosong tampilkan pesan
                            if (document.querySelectorAll('.cart-pro-remove').length === 0) {
                                let tbody = document.querySelector('.cart-table tbody');
                                if (tbody) {
                                    tbody.innerHTML = '<tr><td colspan="7" class="text-center text-muted">Keranjang kosong</td></tr>';
                                }
                            }
                        }
                    });
                });
            });

            // Arrow button logic with fa-angle icons
            document.querySelectorAll('.qty-btn-minus').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var input = btn.parentElement.querySelector('.cart-qty-input');
                    var val = parseInt(input.value) || 1;
                    if (val > 1) {
                        input.value = val - 1;
                        input.dispatchEvent(new Event('input'));
                    }
                });
            });
            document.querySelectorAll('.qty-btn-plus').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    var input = btn.parentElement.querySelector('.cart-qty-input');
                    var val = parseInt(input.value) || 1;
                    input.value = val + 1;
                    input.dispatchEvent(new Event('input'));
                });
            });

            // Update subtotal and grand total when quantity changes
            document.querySelectorAll('.cart-qty-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    let qty = parseInt(this.value) || 1;
                    if (qty < 1) {
                        qty = 1;
                        this.value = 1;
                    }
                    const price = parseInt(this.getAttribute('data-price')) || 0;
                    const subtotal = qty * price;
                    // Update subtotal cell
                    const subtotalCell = this.closest('tr').querySelector('.cart-price-total');
                    if (subtotalCell) {
                        subtotalCell.textContent = 'Rp' + subtotal.toLocaleString('id-ID');
                    }
                    // Update grand total
                    let total = 0;
                    document.querySelectorAll('.cart-qty-input').forEach(function(qtyInput) {
                        const q = parseInt(qtyInput.value) || 1;
                        const p = parseInt(qtyInput.getAttribute('data-price')) || 0;
                        total += q * p;
                    });
                    document.querySelectorAll('.cart-checkout-process span:last-child').forEach(function(span) {
                        span.textContent = 'Rp' + total.toLocaleString('id-ID');
                    });
                    document.querySelectorAll('.cart-checkout-process p span:last-child').forEach(function(span) {
                        span.textContent = 'Rp' + total.toLocaleString('id-ID');
                    });
                });
            });

            // Update hidden input value when quantity changes
            document.querySelectorAll('.cart-qty-input').forEach(function(input) {
                input.addEventListener('input', function() {
                    var id = this.getAttribute('data-id');
                    var val = this.value;
                    var hiddenInput = document.getElementById('jumlah_order_' + id);
                    if (hiddenInput) hiddenInput.value = val;
                });
            });

            // Custom checkbox logic
            function setCheckboxState(el, checked) {
                if (checked) {
                    el.classList.add('checked');
                    el.setAttribute('data-checked', '1');
                } else {
                    el.classList.remove('checked');
                    el.setAttribute('data-checked', '0');
                }
            }
            // Init all item checkboxes as checked
            document.querySelectorAll('.cart-item-checkbox').forEach(function(cb) {
                setCheckboxState(cb, true);
            });
            // Init select all as checked if all checked
            function updateSelectAllCheckbox() {
                const all = document.querySelectorAll('.cart-item-checkbox');
                const allChecked = Array.from(all).every(cb => cb.getAttribute('data-checked') === '1');
                const selectAll = document.getElementById('select-all-cart');
                setCheckboxState(selectAll, allChecked);
            }
            // Toggle item checkbox
            document.querySelectorAll('.cart-item-checkbox').forEach(function(cb) {
                cb.addEventListener('click', function() {
                    const checked = cb.getAttribute('data-checked') === '1';
                    setCheckboxState(cb, !checked);
                    updateSelectAllCheckbox();
                });
            });
            // Toggle select all
            const selectAll = document.getElementById('select-all-cart');
            if (selectAll) {
                setCheckboxState(selectAll, true);
                selectAll.addEventListener('click', function() {
                    const checked = selectAll.getAttribute('data-checked') === '1';
                    document.querySelectorAll('.cart-item-checkbox').forEach(function(cb) {
                        setCheckboxState(cb, !checked);
                    });
                    setCheckboxState(selectAll, !checked);
                });
            }
            // Update select all on item change
            document.querySelectorAll('.cart-item-checkbox').forEach(function(cb) {
                cb.addEventListener('click', updateSelectAllCheckbox);
            });

            // Saat submit checkout, hanya kirim input hidden untuk item yang dicentang
            const checkoutForm = document.getElementById('checkout-form');
            if (checkoutForm) {
                checkoutForm.addEventListener('submit', function(e) {
                    // Ambil semua id item yang dicentang
                    const checkedIds = Array.from(document.querySelectorAll('.cart-item-checkbox'))
                        .filter(cb => cb.getAttribute('data-checked') === '1')
                        .map(cb => cb.getAttribute('data-id'));
                    // Hapus semua input hidden cart_id dan jumlah_order yang tidak dicentang
                    @foreach($cartItems as $item)
                        if (!checkedIds.includes('{{ $item->id }}')) {
                            var inputCartId = document.getElementById('cart_id_{{ $item->id }}');
                            var inputJumlah = document.getElementById('jumlah_order_{{ $item->id }}');
                            if (inputCartId) inputCartId.parentNode.removeChild(inputCartId);
                            if (inputJumlah) inputJumlah.parentNode.removeChild(inputJumlah);
                        }
                    @endforeach
                    // Jika tidak ada yang dicentang, cegah submit
                    if (checkedIds.length === 0) {
                        e.preventDefault();
                        alert('Pilih minimal satu produk untuk checkout.');
                    }
                });
            }
        });
        </script>
        <style>
        .custom-checkbox {
            display: inline-block;
            width: 22px;
            height: 22px;
            border: 2px solid #aaa;
            border-radius: 5px;
            background: #fff;
            position: relative;
            cursor: pointer;
            vertical-align: middle;
        }
        .custom-checkbox.checked {
            background: #ff5252;
            border-color: #ff5252;
        }
        .custom-checkbox.checked:after {
            content: '';
            position: absolute;
            left: 6px;
            top: 2px;
            width: 6px;
            height: 12px;
            border: solid #fff;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
        </style>
    </body>
@endsection