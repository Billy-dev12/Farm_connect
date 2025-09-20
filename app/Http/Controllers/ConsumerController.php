<?php

namespace App\Http\Controllers;

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
                'label' => 'required|string|max:255',
                'penerima' => 'required|string|max:255',
                'no_hp' => 'required|string|max:15',
                'alamat_lengkap' => 'required|string',
                'provinsi' => 'required|string|max:255',
                'kota' => 'required|string|max:255',
                'kecamatan' => 'required|string|max:255',
                'kode_pos' => 'required|string|max:10',
                'is_default' => 'boolean'
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
            Log::error('Validation error:', ['errors' => $e->errors()->all()]);

            // Jika terjadi error validasi
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->errors()->all())
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
        $validated = $request->validate([
            'label' => 'required|string|max:255',
            'penerima' => 'required|string|max:255',
            'no_hp' => 'required|string|max:15',
            'alamat_lengkap' => 'required|string',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'is_default' => 'boolean'
        ]);

        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);

        // Jika dijadikan default, set yang lain jadi false
        if (isset($validated['is_default']) && $validated['is_default']) {
            $user->addresses()->where('id', '!=', $id)->update(['is_default' => false]);
        }

        $address->update($validated);

        return redirect()->route('konsumen.addresses')
            ->with('success', 'Alamat berhasil diperbarui!');
    }

    public function deleteAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);

        // Cek jika ini alamat default, tidak boleh dihapus
        if ($address->is_default) {
            return redirect()->route('konsumen.addresses')
                ->with('error', 'Alamat utama tidak dapat dihapus!');
        }

        $address->delete();

        return redirect()->route('konsumen.addresses')
            ->with('success', 'Alamat berhasil dihapus!');
    }

    public function getAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);

        return response()->json($address);
    }

    public function setDefaultAddress($id)
    {
        $user = Auth::user();
        $address = $user->addresses()->findOrFail($id);

        // Set semua alamat lain menjadi non-default
        $user->addresses()->where('id', '!=', $id)->update(['is_default' => false]);

        // Set alamat ini menjadi default
        $address->update(['is_default' => true]);

        return redirect()->route('konsumen.addresses')
            ->with('success', 'Alamat utama berhasil diperbarui!');
    }

    // Riwayat Pembelian
    public function purchaseHistory()
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->paginate(10);

        return view('consumer.purchase-history', compact('orders'));
    }

    public function purchaseDetail($id)
    {
        $user = Auth::user();
        $order = $user->orders()->with('items.product')->findOrFail($id);

        return view('consumer.purchase-detail', compact('order'));
    }
}