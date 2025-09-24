<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\DummyProduct;
use App\Models\User;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ConsumerController extends Controller
{
    // Dashboard Konsumen

    public function dashboard()
    {
        $user = Auth::user();

        // Ambil produk terbaru untuk ditampilkan di dashboard
        $latestProducts = DummyProduct::latest()->take(6)->get();

        return view('dashboard.customer', compact('user', 'latestProducts'));
    }

    // Browse & Search Produk
    public function browse(Request $request)
    {
        $query = DummyProduct::query();

        // Pencarian
        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_produk', 'like', '%' . $searchTerm . '%')
                    ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('kategori', $request->category);
        }

        // Filter lokasi
        if ($request->has('location') && $request->location != '') {
            $query->where('lokasi', 'like', '%' . $request->location . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'harga-terendah':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga-tertinggi':
                $query->orderBy('harga', 'desc');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Ambil semua produk yang sesuai dengan kriteria
        $allProducts = $query->get();

        // Pisahkan produk yang ada di wishlist dan yang tidak
        $user = Auth::user();
        $wishlistProductIds = [];

        // Pastikan user dan wishlist ada sebelum mencoba mengaksesnya
        if ($user && $user->wishlist) {
            $wishlistProductIds = $user->wishlist()->pluck('dummy_product_id')->toArray();
        }

        $wishlistProducts = $allProducts->filter(function ($product) use ($wishlistProductIds) {
            return in_array($product->id, $wishlistProductIds);
        });

        $otherProducts = $allProducts->filter(function ($product) use ($wishlistProductIds) {
            return !in_array($product->id, $wishlistProductIds);
        });

        // Gabungkan kembali dengan produk wishlist di atas
        $mergedProducts = $wishlistProducts->merge($otherProducts);

        // Buat paginasi manual
        $page = $request->get('page', 1);
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $mergedProducts->slice($offset, $perPage),
            $mergedProducts->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Get kategori untuk filter
        $categories = DummyProduct::distinct('kategori')->pluck('kategori');

        // Get lokasi untuk filter
        $locations = DummyProduct::distinct('lokasi')->pluck('lokasi');

        return view('consumer.browse', compact('products', 'categories', 'locations', 'wishlistProductIds'));
    }

    // Search Produk (untuk route khusus search)
    public function search(Request $request)
    {
        $query = DummyProduct::query();

        // Pencarian berdasarkan nama produk atau deskripsi
        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nama_produk', 'like', '%' . $searchTerm . '%')
                    ->orWhere('deskripsi', 'like', '%' . $searchTerm . '%');
            });
        }

        // Filter kategori
        if ($request->has('category') && $request->category != '') {
            $query->where('kategori', $request->category);
        }

        // Filter lokasi
        if ($request->has('location') && $request->location != '') {
            $query->where('lokasi', 'like', '%' . $request->location . '%');
        }

        // Sorting
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'harga-terendah':
                $query->orderBy('harga', 'asc');
                break;
            case 'harga-tertinggi':
                $query->orderBy('harga', 'desc');
                break;
            case 'terlama':
                $query->orderBy('created_at', 'asc');
                break;
            case 'terbaru':
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        // Ambil semua produk yang sesuai dengan kriteria
        $allProducts = $query->get();

        // Pisahkan produk yang ada di wishlist dan yang tidak
        $user = Auth::user();
        $wishlistProductIds = [];

        // Pastikan user dan wishlist ada sebelum mencoba mengaksesnya
        if ($user && $user->wishlist) {
            $wishlistProductIds = $user->wishlist()->pluck('dummy_product_id')->toArray();
        }

        $wishlistProducts = $allProducts->filter(function ($product) use ($wishlistProductIds) {
            return in_array($product->id, $wishlistProductIds);
        });

        $otherProducts = $allProducts->filter(function ($product) use ($wishlistProductIds) {
            return !in_array($product->id, $wishlistProductIds);
        });

        // Gabungkan kembali dengan produk wishlist di atas
        $mergedProducts = $wishlistProducts->merge($otherProducts);

        // Buat paginasi manual
        $page = $request->get('page', 1);
        $perPage = 12;
        $offset = ($page - 1) * $perPage;

        $products = new \Illuminate\Pagination\LengthAwarePaginator(
            $mergedProducts->slice($offset, $perPage),
            $mergedProducts->count(),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        // Get kategori untuk filter
        $categories = DummyProduct::distinct('kategori')->pluck('kategori');

        // Get lokasi untuk filter
        $locations = DummyProduct::distinct('lokasi')->pluck('lokasi');

        return view('consumer.browse', compact('products', 'categories', 'locations', 'wishlistProductIds'));
    }

    // Detail Produk
    public function show($id)
    {
        $product = DummyProduct::with('farmer')->findOrFail($id);

        // Produk terkait
        $relatedProducts = DummyProduct::where('kategori', $product->kategori)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('consumer.show', compact('product', 'relatedProducts'));
    }

    // Wishlist produk
    public function addToWishlist($productId)
    {
        $user = Auth::user();

        // Cek apakah produk ada
        $product = DummyProduct::findOrFail($productId);

        // Cek apakah sudah ada di wishlist
        if (!$user->wishlist()->where('dummy_product_id', $productId)->exists()) {
            $user->wishlist()->attach($productId);
            return redirect()->back()->with('success', 'Produk ditambahkan ke wishlist!');
        }

        return redirect()->back()->with('info', 'Produk sudah ada di wishlist!');
    }

    public function wishlist()
    {
        $user = Auth::user();
        $wishlistItems = $user->wishlist()->paginate(10);

        return view('consumer.wishlist', compact('wishlistItems'));
    }

    public function removeFromWishlist($productId)
    {
        $user = Auth::user();
        $user->wishlist()->detach($productId);

        return redirect()->back()->with('success', 'Produk dihapus dari wishlist!');
    }

    // Alamat Pengiriman
    public function addresses()
    {
        $user = Auth::user();
        $addresses = $user->addresses()->orderBy('is_default', 'desc')->get();

        return view('consumer.addresses', compact('addresses'));
    }

    public function storeAddress(Request $request)
    {
        try {
            // Log request data
            Log::info('Store address request:', $request->all());

            // Validasi input
            $validated = $request->validate([
                'label' => 'required|string|min:2|max:255',
                'penerima' => 'required|string|min:3|max:255',
                'no_hp' => 'required|string|regex:/^[0-9]{10,15}$/',
                'alamat_lengkap' => 'required|string|min:10',
                'provinsi' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kode_pos' => 'required|string|regex:/^[0-9]{5}$/',
                'is_default' => 'boolean'
            ], [
                'label.required' => 'Label alamat harus diisi',
                'label.min' => 'Label alamat minimal 2 karakter',
                'penerima.required' => 'Nama penerima harus diisi',
                'penerima.min' => 'Nama penerima minimal 3 karakter',
                'no_hp.required' => 'Nomor HP harus diisi',
                'no_hp.regex' => 'Nomor HP harus 10-15 digit angka',
                'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
                'alamat_lengkap.min' => 'Alamat lengkap minimal 10 karakter',
                'provinsi.required' => 'Provinsi harus diisi',
                'kota.required' => 'Kota/Kabupaten harus diisi',
                'kecamatan.required' => 'Kecamatan harus diisi',
                'kode_pos.required' => 'Kode pos harus diisi',
                'kode_pos.regex' => 'Kode pos harus 5 digit angka'
            ]);

            // Ambil user yang sedang login
            $user = Auth::user();

            // Log user
            Log::info('User ID:', ['user_id' => $user->id]);

            // Jika dijadikan default, set yang lain jadi false
            if (isset($validated['is_default']) && $validated['is_default']) {
                $user->addresses()->update(['is_default' => false]);
            }

            // Jika ini alamat pertama, jadikan default
            if ($user->addresses()->count() === 0) {
                $validated['is_default'] = true;
            }

            // Tambahkan user_id ke data yang akan disimpan
            $validated['user_id'] = $user->id;

            // Log validated data
            Log::info('Validated data:', $validated);

            // Buat alamat baru
            $address = $user->addresses()->create($validated);

            // Log created address
            Log::info('Created address:', $address->toArray());

            // Kembalikan response JSON untuk AJAX
            return response()->json([
                'success' => true,
                'message' => 'Alamat berhasil ditambahkan!',
                'address' => $address
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation error
            Log::error('Validation error:', ['errors' => $e->errors()]);

            // Jika terjadi error validasi
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', array_flatten($e->errors())),
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            // Log general error
            Log::error('Store address error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function updateAddress(Request $request, $id)
    {
        try {
            // Log request
            Log::info('Update address request:', [
                'id' => $id,
                'method' => $request->method(),
                'data' => $request->all(),
                'user_id' => Auth::id()
            ]);

            // Validasi input
            $validated = $request->validate([
                'label' => 'required|string|min:2|max:255',
                'penerima' => 'required|string|min:3|max:255',
                'no_hp' => 'required|string|regex:/^[0-9]{10,15}$/',
                'alamat_lengkap' => 'required|string|min:10',
                'provinsi' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kode_pos' => 'required|string|regex:/^[0-9]{5}$/',
                'is_default' => 'boolean'
            ], [
                'label.required' => 'Label alamat harus diisi',
                'label.min' => 'Label alamat minimal 2 karakter',
                'penerima.required' => 'Nama penerima harus diisi',
                'penerima.min' => 'Nama penerima minimal 3 karakter',
                'no_hp.required' => 'Nomor HP harus diisi',
                'no_hp.regex' => 'Nomor HP harus 10-15 digit angka',
                'alamat_lengkap.required' => 'Alamat lengkap harus diisi',
                'alamat_lengkap.min' => 'Alamat lengkap minimal 10 karakter',
                'provinsi.required' => 'Provinsi harus diisi',
                'kota.required' => 'Kota/Kabupaten harus diisi',
                'kecamatan.required' => 'Kecamatan harus diisi',
                'kode_pos.required' => 'Kode pos harus diisi',
                'kode_pos.regex' => 'Kode pos harus 5 digit angka'
            ]);

            $user = Auth::user();
            $address = $user->addresses()->findOrFail($id);

            // Jika dijadikan default, set yang lain jadi false
            if (isset($validated['is_default']) && $validated['is_default']) {
                $user->addresses()->where('id', '!=', $id)->update(['is_default' => false]);
            }

            $address->update($validated);

            // Kembalikan response JSON untuk AJAX
            return response()->json([
                'success' => true,
                'message' => 'Alamat berhasil diperbarui!',
                'address' => $address
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Log validation error
            Log::error('Validation error:', ['errors' => $e->errors()]);

            // Jika terjadi error validasi
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log error
            Log::error('Address not found:', ['id' => $id, 'user_id' => Auth::id()]);

            // Jika alamat tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan!'
            ], 404);
        } catch (\Exception $e) {
            // Log general error
            Log::error('Update address error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteAddress($id)
    {
        try {
            $user = Auth::user();
            $address = $user->addresses()->findOrFail($id);

            // Cek jika ini alamat default, tidak boleh dihapus
            if ($address->is_default) {
                return response()->json([
                    'success' => false,
                    'message' => 'Alamat utama tidak dapat dihapus!'
                ], 400);
            }

            $address->delete();

            // Kembalikan response JSON untuk AJAX
            return response()->json([
                'success' => true,
                'message' => 'Alamat berhasil dihapus!'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log error
            Log::error('Address not found:', ['id' => $id, 'user_id' => Auth::id()]);

            // Jika alamat tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan!'
            ], 404);
        } catch (\Exception $e) {
            // Log general error
            Log::error('Delete address error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function getAddress($id)
    {
        try {
            $user = Auth::user();
            $address = $user->addresses()->findOrFail($id);

            return response()->json($address);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log error
            Log::error('Address not found:', ['id' => $id, 'user_id' => Auth::id()]);

            // Jika alamat tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan!'
            ], 404);
        } catch (\Exception $e) {
            // Log general error
            Log::error('Get address error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function setDefaultAddress($id)
    {
        try {
            $user = Auth::user();
            $address = $user->addresses()->findOrFail($id);

            // Set semua alamat lain menjadi non-default
            $user->addresses()->where('id', '!=', $id)->update(['is_default' => false]);

            // Set alamat ini menjadi default
            $address->update(['is_default' => true]);

            // Kembalikan response JSON untuk AJAX
            return response()->json([
                'success' => true,
                'message' => 'Alamat utama berhasil diperbarui!'
            ]);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Log error
            Log::error('Address not found:', ['id' => $id, 'user_id' => Auth::id()]);

            // Jika alamat tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Alamat tidak ditemukan!'
            ], 404);
        } catch (\Exception $e) {
            // Log general error
            Log::error('Set default address error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Jika terjadi error lainnya
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    // Riwayat Pembelian
    public function purchaseHistory()
    {
        $user = Auth::user();

        // Ambil semua pesanan user dengan relasi items dan products
        $orders = $user->orders()
            ->with(['items.product', 'address']) // Load relasi yang diperlukan
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('consumer.purchase-history', compact('orders'));
    }

    public function purchaseDetail($id)
    {
        $user = Auth::user();

        // Ambil detail pesanan dengan semua relasi yang diperlukan
        $order = $user->orders()
            ->with(['items.product.farmer', 'address']) // Load relasi produk dan petani
            ->findOrFail($id);

        return view('consumer.purchase-detail', compact('order'));
    }

    // Fungsi untuk membuat pesanan baru (jika diperlukan)
    public function createOrder(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $validated = $request->validate([
            'address_id' => 'required|exists:addresses,id',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:dummy_products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string'
        ]);

        // Hitung subtotal
        $subtotal = 0;
        $orderItems = [];

        foreach ($validated['items'] as $item) {
            $product = DummyProduct::findOrFail($item['product_id']);

            // Cek stok
            if ($product->stok < $item['quantity']) {
                return response()->json([
                    'success' => false,
                    'message' => "Stok untuk {$product->nama_produk} tidak mencukupi"
                ], 400);
            }

            $itemSubtotal = $product->harga * $item['quantity'];
            $subtotal += $itemSubtotal;

            $orderItems[] = [
                'product_id' => $product->id,
                'price' => $product->harga,
                'quantity' => $item['quantity'],
                'subtotal' => $itemSubtotal
            ];
        }

        // Hitung ongkos kirim (bisa dihitung berdasarkan alamat atau berat total)
        $shippingCost = $this->calculateShippingCost($validated['address_id'], $orderItems);

        // Total amount
        $totalAmount = $subtotal + $shippingCost;

        // Buat pesanan
        $order = new Order();
        $order->user_id = $user->id;
        $order->address_id = $validated['address_id'];
        $order->order_number = Order::generateOrderNumber();
        $order->subtotal = $subtotal;
        $order->shipping_cost = $shippingCost;
        $order->total_amount = $totalAmount;
        $order->status = 'Pending';
        $order->payment_status = 'Unpaid';
        $order->notes = $validated['notes'] ?? null;
        $order->save();

        // Simpan order items
        foreach ($orderItems as $item) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['product_id'];
            $orderItem->price = $item['price'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->subtotal = $item['subtotal'];
            $orderItem->save();

            // Kurangi stok produk
            $product = DummyProduct::find($item['product_id']);
            $product->stok -= $item['quantity'];
            $product->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Pesanan berhasil dibuat',
            'order_id' => $order->id,
            'order_number' => $order->order_number
        ]);
    }

    // Fungsi untuk menghitung ongkos kirim (contoh sederhana)
    private function calculateShippingCost($addressId, $items)
    {
        // Di sini Anda bisa menghitung ongkos kirim berdasarkan alamat dan berat/total item
        // Untuk sementara, kita return nilai statis
        return 10000; // Rp 10.000
    }

    // Fungsi untuk update status pesanan (jika diperlukan)
    public function updateOrderStatus(Request $request, $id)
    {
        $user = Auth::user();
        $order = $user->orders()->findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:Pending,Processed,Shipped,Completed,Cancelled'
        ]);

        $order->status = $validated['status'];

        // Update timestamp berdasarkan status
        switch ($validated['status']) {
            case 'Processed':
                $order->processed_at = now();
                break;
            case 'Shipped':
                $order->shipped_at = now();
                break;
            case 'Completed':
                $order->completed_at = now();
                break;
            case 'Cancelled':
                $order->cancelled_at = now();

                // Kembalikan stok produk
                foreach ($order->items as $item) {
                    $product = $item->product;
                    $product->stok += $item->quantity;
                    $product->save();
                }
                break;
        }

        $order->save();

        return response()->json([
            'success' => true,
            'message' => 'Status pesanan berhasil diperbarui',
            'order' => $order
        ]);
    }

    public function addToCart(Request $request, $productId)
    {
        try {
            $user = Auth::user();
            $product = DummyProduct::findOrFail($productId);

            // Check if product is available
            if (!$product->isInStock()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak tersedia atau stok habis'
                ], 400);
            }

            // Check if product already in cart
            $existingCartItem = $user->carts()
                ->where('product_id', $productId)
                ->first();

            if ($existingCartItem) {
                // Update quantity if already in cart
                $newQuantity = $existingCartItem->quantity + 1;

                // Check if stock is sufficient
                if ($newQuantity > $product->stok) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Stok tidak mencukupi'
                    ], 400);
                }

                $existingCartItem->quantity = $newQuantity;
                $existingCartItem->calculateSubtotal();
                $existingCartItem->save();

                $message = 'Jumlah produk di keranjang diperbarui';
            } else {
                // Add new item to cart
                $cartItem = new Cart();
                $cartItem->user_id = $user->id;
                $cartItem->product_id = $productId;
                $cartItem->quantity = 1;
                $cartItem->price = $product->harga;
                $cartItem->calculateSubtotal();
                $cartItem->save();

                $message = 'Produk berhasil ditambahkan ke keranjang';
            }

            // Get cart count
            $cartCount = $user->carts()->count();

            return response()->json([
                'success' => true,
                'message' => $message,
                'cart_count' => $cartCount
            ]);

        } catch (\Exception $e) {
            Log::error('Error adding to cart: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}