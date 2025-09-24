<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Tampilkan daftar produk
     */
    public function index()
    {
        $products = Product::latest()->get();
        return view('produk.index', compact('products'));
    }

    /**
     * Simpan produk baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'lokasi' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('produk', 'public');
        }

        $product = Product::create([
            'nama_produk' => $request->nama_produk,
            'deskripsi' => $request->deskripsi,
            'kategori' => $request->kategori,
            'lokasi' => $request->lokasi,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'satuan' => $request->satuan,
            'gambar' => $gambarPath,
            'farmer_id' => auth()->id() ?? 1, // sementara default 1 kalau belum login
        ]);

        return response()->json(['success' => true, 'message' => 'Produk berhasil ditambahkan', 'data' => $product]);
    }

    /**
     * Update produk
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'harga' => 'required|integer',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'lokasi' => 'required|string|max:100',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $product->update($data);

        return response()->json(['success' => true, 'message' => 'Produk berhasil diperbarui', 'data' => $product]);
    }

    /**
     * Hapus produk
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();

        return response()->json(['success' => true, 'message' => 'Produk berhasil dihapus']);
    }

    /**
     * Bulk insert produk
     */
    public function bulkStore(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
        ]);

        $inserted = [];
        foreach ($request->products as $prod) {
            $inserted[] = Product::create([
                'nama_produk' => $prod['nama_produk'] ?? 'Produk Tanpa Nama',
                'deskripsi' => $prod['deskripsi'] ?? '-',
                'kategori' => $prod['kategori'] ?? 'Umum',
                'lokasi' => $prod['lokasi'] ?? 'Gudang',
                'harga' => $prod['harga'] ?? 0,
                'stok' => $prod['stok'] ?? 0,
                'satuan' => $prod['satuan'] ?? 'pcs',
                'gambar' => null,
                'farmer_id' => auth()->id() ?? 1,
            ]);
        }

        return response()->json(['success' => true, 'message' => count($inserted) . ' produk berhasil ditambahkan']);
    }
}
