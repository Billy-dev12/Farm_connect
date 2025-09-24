<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Sistem Pertanian</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #4a7c59;
            --primary-dark: #3a6249;
            --secondary: #e74c3c;
            --background: #f8f9fa;
            --surface: #ffffff;
            --text-primary: #333333;
            --text-secondary: #666666;
            --border: #e5e7eb;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--background);
            color: var(--text-primary);
        }

        .cart-item {
            transition: all 0.3s ease;
        }

        .cart-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: var(--primary);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
        }

        .quantity-input {
            transition: all 0.3s ease;
        }

        .quantity-input:focus {
            box-shadow: 0 0 0 3px rgba(74, 124, 89, 0.2);
        }

        .header {
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), #6fa071);
        }
    </style>
</head>

<body>
    <div class="container mx-auto px-4 py-8 max-w-6xl">
        <!-- Header -->
        <div class="header p-6 mb-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800 flex items-center mb-4 md:mb-0">
                    <i class="fas fa-shopping-cart text-green-700 mr-3"></i>
                    <span>Keranjang Belanja</span>
                </h1>
                <a href="{{ route('konsumen.browse') }}"
                    class="btn-primary text-white px-6 py-3 rounded-full flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i>
                    <span>Lanjutkan Belanja</span>
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Produk di Keranjang</h2>

                        <div class="space-y-4">
                            @foreach ($cartItems as $cartItem)
                                <div class="cart-item bg-gray-50 rounded-xl p-4 flex items-center"
                                    data-id="{{ $cartItem->id }}">
                                    <div class="flex-shrink-0 w-20 h-20 bg-gray-200 rounded-lg overflow-hidden mr-4">
                                        @if ($cartItem->product->gambar)
                                            <img src="{{ asset('storage/' . $cartItem->product->gambar) }}"
                                                alt="{{ $cartItem->product->nama_produk }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('images/default-product.jpg') }}" alt="Default Product"
                                                class="w-full h-full object-cover">
                                        @endif
                                    </div>

                                    <div class="flex-grow">
                                        <h3 class="font-bold text-gray-800">{{ $cartItem->product->nama_produk }}</h3>
                                        <p class="text-red-500 font-bold">
                                            {{ $cartItem->getFormattedPriceAttribute() }}/{{ $cartItem->product->satuan }}
                                        </p>

                                        <div class="flex items-center mt-2">
                                            <div class="flex items-center border border-gray-300 rounded-lg">
                                                <button class="quantity-btn px-3 py-1 text-gray-600 hover:bg-gray-100"
                                                    data-id="{{ $cartItem->id }}" data-action="minus">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="number"
                                                    class="quantity-input w-16 text-center border-l border-r border-gray-300 py-1"
                                                    value="{{ $cartItem->quantity }}" min="1"
                                                    data-id="{{ $cartItem->id }}">
                                                <button class="quantity-btn px-3 py-1 text-gray-600 hover:bg-gray-100"
                                                    data-id="{{ $cartItem->id }}" data-action="plus">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>

                                            <span
                                                class="ml-4 font-bold">{{ $cartItem->getFormattedSubtotalAttribute() }}</span>
                                        </div>
                                    </div>

                                    <div class="flex-shrink-0 ml-4">
                                        <a href="{{ route('konsumen.cart.remove', $cartItem->id) }}"
                                            class="text-red-500 hover:text-red-700">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-lg p-6 sticky top-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>

                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between">
                                <span>Ongkos Kirim</span>
                                <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>

                            <div class="border-t border-gray-300 pt-4 flex justify-between font-bold text-lg">
                                <span>Total</span>
                                <span class="text-red-500">Rp {{ number_format($total, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <h3 class="font-bold text-gray-800 mb-3">Alamat Pengiriman</h3>

                        <div class="mb-6">
                            @if ($addresses->count() > 0)
                                <select id="address-select" class="w-full p-3 border border-gray-300 rounded-lg mb-4">
                                    @foreach ($addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ $address->is_default ? 'selected' : '' }}>
                                            {{ $address->label }} - {{ $address->penerima }}, {{ $address->kota }}
                                        </option>
                                    @endforeach
                                </select>

                                <div id="selected-address" class="bg-gray-50 p-4 rounded-lg">
                                    @php
                                        $defaultAddress =
                                            $addresses->firstWhere('is_default', true) ?? $addresses->first();
                                    @endphp
                                    <p class="font-bold">{{ $defaultAddress->penerima }}</p>
                                    <p class="text-sm">{{ $defaultAddress->no_hp }}</p>
                                    <p class="text-sm">{{ $defaultAddress->alamat_lengkap }},
                                        {{ $defaultAddress->kecamatan }}, {{ $defaultAddress->kota }},
                                        {{ $defaultAddress->provinsi }} {{ $defaultAddress->kode_pos }}</p>
                                </div>
                            @else
                                <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg mb-4">
                                    <p class="text-yellow-700">Anda belum memiliki alamat pengiriman.</p>
                                    <a href="{{ route('konsumen.addresses') }}"
                                        class="text-green-600 hover:text-green-800 font-medium">
                                        Tambah Alamat Baru
                                    </a>
                                </div>
                            @endif
                        </div>

                        <h3 class="font-bold text-gray-800 mb-3">Metode Pembayaran</h3>

                        <div class="mb-6">
                            <select id="payment-method" class="w-full p-3 border border-gray-300 rounded-lg">
                                <option value="transfer">Transfer Bank</option>
                                <option value="cod">COD (Bayar di Tempat)</option>
                                <option value="ewallet">E-Wallet</option>
                            </select>
                        </div>

                        <form id="checkout-form" action="{{ route('konsumen.checkout') }}" method="POST">
                            @csrf
                            <input type="hidden" name="address_id" id="address-input"
                                value="{{ $addresses->firstWhere('is_default', true)->id ?? $addresses->first()->id }}">
                            <input type="hidden" name="payment_method" id="payment-input" value="transfer">
                            <input type="hidden" name="notes" value="">

                            <div class="mb-4">
                                <label class="block text-gray-700 text-sm font-bold mb-2" for="notes">
                                    Catatan (Opsional)
                                </label>
                                <textarea id="notes-textarea"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    rows="3" placeholder="Catatan untuk pesanan Anda..."></textarea>
                            </div>

                            <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg font-bold">
                                Proses Checkout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <i class="fas fa-shopping-cart text-6xl text-gray-300 mb-5"></i>
                <h3 class="text-2xl font-bold text-gray-700 mb-3">Keranjang belanja Anda kosong</h3>
                <p class="text-gray-600 max-w-md mx-auto mb-6">Tambahkan produk ke keranjang untuk melanjutkan
                    pembelian</p>
                <a href="{{ route('konsumen.browse') }}"
                    class="btn-primary text-white px-8 py-3 rounded-full font-medium inline-block">
                    <i class="fas fa-shopping-basket mr-2"></i>
                    <span>Belanja Sekarang</span>
                </a>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Update quantity
            document.querySelectorAll('.quantity-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const action = this.getAttribute('data-action');
                    const input = document.querySelector(`input[data-id="${id}"]`);
                    let value = parseInt(input.value);

                    if (action === 'plus') {
                        value++;
                    } else if (action === 'minus' && value > 1) {
                        value--;
                    }

                    input.value = value;

                    // Update cart via AJAX
                    fetch('/konsumen/cart/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                id: id,
                                quantity: value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update subtotal
                                const cartItem = document.querySelector(
                                    `.cart-item[data-id="${id}"]`);
                                const subtotalElement = cartItem.querySelector(
                                    '.ml-4.font-bold');
                                subtotalElement.textContent = data.subtotal;

                                // Update total
                                updateTotal();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Update quantity when input changes
            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', function() {
                    const id = this.getAttribute('data-id');
                    const value = parseInt(this.value);

                    if (value < 1) this.value = 1;

                    // Update cart via AJAX
                    fetch('/konsumen/cart/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector(
                                    'meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                id: id,
                                quantity: value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update subtotal
                                const cartItem = document.querySelector(
                                    `.cart-item[data-id="${id}"]`);
                                const subtotalElement = cartItem.querySelector(
                                    '.ml-4.font-bold');
                                subtotalElement.textContent = data.subtotal;

                                // Update total
                                updateTotal();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Address selection
            const addressSelect = document.getElementById('address-select');
            const addressInput = document.getElementById('address-input');

            addressSelect.addEventListener('change', function() {
                addressInput.value = this.value;

                // Update selected address display
                fetch(`/api/address/${this.value}`)
                    .then(response => response.json())
                    .then(data => {
                        const selectedAddressDiv = document.getElementById('selected-address');
                        selectedAddressDiv.innerHTML = `
                            <p class="font-bold">${data.penerima}</p>
                            <p class="text-sm">${data.no_hp}</p>
                            <p class="text-sm">${data.alamat_lengkap}, ${data.kecamatan}, ${data.kota}, ${data.provinsi} ${data.kode_pos}</p>
                        `;
                    })
                    .catch(error => console.error('Error:', error));
            });

            // Payment method selection
            const paymentSelect = document.getElementById('payment-method');
            const paymentInput = document.getElementById('payment-input');

            paymentSelect.addEventListener('change', function() {
                paymentInput.value = this.value;
            });

            // Notes textarea
            const notesTextarea = document.getElementById('notes-textarea');
            const notesInput = document.querySelector('input[name="notes"]');

            notesTextarea.addEventListener('input', function() {
                notesInput.value = this.value;
            });

            // Update total function
            function updateTotal() {
                let subtotal = 0;

                document.querySelectorAll('.cart-item .ml-4.font-bold').forEach(element => {
                    const priceText = element.textContent;
                    const price = parseInt(priceText.replace(/[^\d]/g, ''));
                    subtotal += price;
                });

                // Update subtotal display
                const subtotalElements = document.querySelectorAll('.flex.justify-between span');
                if (subtotalElements.length > 0) {
                    subtotalElements[0].textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

                    // Update total
                    const shipping = 10000;
                    const total = subtotal + shipping;
                    subtotalElements[2].textContent = 'Rp ' + total.toLocaleString('id-ID');
                }
            }
        });
    </script>
</body>

</html>
