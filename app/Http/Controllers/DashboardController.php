<?php

namespace App\Http\Controllers;

use App\Models\DummyProduct;
use App\Models\User;
use App\Models\Produk;
use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Dashboard Petani
     */
    public function petani()
    {
        $user = Auth::user();

        // Cek apakah user adalah petani
        if (!$user->isPetani()) {
            abort(403, 'Unauthorized access.');
        }

        // Statistik untuk petani
        $totalProduk = DummyProduct::where('user_id', $user->id)->count();
        $produkAktif = DummyProduct::where('user_id', $user->id)->where('stok', '>', 0)->count();
        $totalPesanan = Pesanan::whereHas('detail', function ($query) use ($user) {
            $query->whereHas('produk', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->count();
        $pesananBaru = Pesanan::whereHas('detail', function ($query) use ($user) {
            $query->whereHas('produk', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->where('status_pesanan', 'diproses')->count();

        // Pesanan terbaru
        $recentOrders = Pesanan::whereHas('detail', function ($query) use ($user) {
            $query->whereHas('produk', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        })->with(['detail.produk', 'user'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Produk terbaru
        $recentProducts = Produk::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('dashboard.farmer', compact(
            'user',
            'totalProduk',
            'produkAktif',
            'totalPesanan',
            'pesananBaru',
            'recentOrders',
            'recentProducts'
        ));
    }

    /**
     * Dashboard Konsumen (untuk comparison)
     */
    public function konsumen()
    {
        $user = Auth::user();

        if (!$user->isKonsumen()) {
            abort(403, 'Unauthorized access.');
        }

        $latestProducts = DummyProduct::latest()->take(6)->get();

        return view('dashboard.customer', compact('user', 'latestProducts'));
    }
}