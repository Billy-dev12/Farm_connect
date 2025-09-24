<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ====================
// HALAMAN UTAMA
// ====================

// Halaman Utama (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// ====================
// AUTHENTICATION ROUTES
// ====================

// Register Routes (untuk guest - belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/register/consumer', [AuthController::class, 'showConsumerRegister'])->name('registrasi.konsumen');
    Route::post('/register/consumer', [AuthController::class, 'registerConsumer'])->name('register.consumer.post');
    Route::get('/register/farmer', [AuthController::class, 'showFarmerRegister'])->name('register.farmer');
    Route::post('/register/farmer', [AuthController::class, 'registerFarmer'])->name('register.farmer.post');

    // Login Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

// Logout Route (untuk yang sudah login)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware(['auth']);

// ====================
// VERIFICATION ROUTES
// ====================

// Verification Routes (untuk guest - belum login)
Route::middleware(['guest'])->prefix('verification')->name('verification.')->group(function () {
    Route::get('/pending', function () {
        return view('auth.pending');
    })->name('pending');

    Route::get('/rejected', function () {
        return view('auth.rejected');
    })->name('rejected');
});

// ====================
// ADMIN ROUTES
// ====================

// Admin Routes dengan middleware auth dan admin
Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::post('/farmer/{farmer}/verify', [AdminController::class, 'verifyFarmer'])->name('verify.farmer');
        Route::get('/farmer/{farmer}/download-proposal', [AdminController::class, 'downloadProposal'])->name('download-proposal');
    });

// ====================
// DASHBOARD ROUTES
// ====================

// Dashboard Routes dengan middleware auth
Route::prefix('dashboard')
    ->middleware(['auth'])
    ->name('dashboard.')
    ->group(function () {
        Route::get('/petani', [DashboardController::class, 'petani'])->name('petani');
        Route::get('/konsumen', [DashboardController::class, 'konsumen'])->name('konsumen');
    });

// ====================
// PROFILE ROUTES
// ====================

// Profile Routes dengan middleware auth
Route::prefix('profile')
    ->middleware(['auth'])
    ->name('profile.')
    ->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });

// ====================
// KONSUMEN ROUTES
// ====================

// Konsumen Routes dengan middleware auth
Route::prefix('konsumen')
    ->middleware(['auth'])
    ->name('konsumen.')
    ->group(function () {
        // Dashboard Konsumen
        Route::get('/dashboard', [ConsumerController::class, 'dashboard'])->name('dashboard');

        // Cart
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
        Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/cart/clear', [CartController::class, 'clear'])->name('cart.clear');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');



        // Browse & Search Products
        Route::get('/produk', [ConsumerController::class, 'browse'])->name('browse');
        Route::get('/produk/search', [ConsumerController::class, 'search'])->name('search');

        // Product Detail
        Route::get('/produk/{id}', [ConsumerController::class, 'show'])->name('show');

        // Wishlist
        Route::get('/wishlist', [ConsumerController::class, 'wishlist'])->name('wishlist');
        Route::post('/wishlist/{productId}', [ConsumerController::class, 'addToWishlist'])->name('wishlist.add');
        Route::delete('/wishlist/{productId}', [ConsumerController::class, 'removeFromWishlist'])->name('wishlist.remove');

        // Alamat Pengiriman
        Route::get('/alamat', [ConsumerController::class, 'addresses'])->name('addresses');
        Route::post('/alamat', [ConsumerController::class, 'storeAddress'])->name('addresses.store');
        Route::put('/alamat/{id}', [ConsumerController::class, 'updateAddress'])->name('addresses.update');
        Route::delete('/alamat/{id}', [ConsumerController::class, 'deleteAddress'])->name('addresses.delete');
        Route::get('/alamat/get/{id}', [ConsumerController::class, 'getAddress'])->name('addresses.get');
        Route::post('/alamat/{id}/set-default', [ConsumerController::class, 'setDefaultAddress'])->name('addresses.set-default');

        // Riwayat Pembelian
        Route::get('/riwayat', [ConsumerController::class, 'purchaseHistory'])->name('purchase.history');
        Route::get('/riwayat/{id}', [ConsumerController::class, 'purchaseDetail'])->name('purchase.detail');

        // Rating & Review
        Route::get('/rating', [ConsumerController::class, 'ratings'])->name('ratings');
        Route::post('/produk/{id}/rating', [ConsumerController::class, 'submitRating'])->name('rating.submit');
    });

// ====================
// API ROUTES (Optional untuk future development)
// ====================

// API Routes untuk mobile app
Route::prefix('api')
    ->middleware(['auth:api', 'throttle'])
    ->name('api.')
    ->group(function () {
        // API endpoints untuk mobile
        Route::get('/products', [ConsumerController::class, 'apiProducts']);
        Route::get('/products/{id}', [ConsumerController::class, 'apiProductDetail']);
    });

// ====================
// FALLBACK ROUTE
// ====================

// Route untuk handle 404 dengan smart redirect
Route::fallback(function () {
    if (request()->is('konsumen/*')) {
        // Jika route dimulai dengan /konsumen tapi tidak ditemukan
        return redirect()->route('konsumen.browse')->with('error', 'Halaman yang Anda cari tidak ditemukan.');
    }

    if (request()->is('dashboard/*')) {
        // Jika route dimulai dengan /dashboard tapi tidak ditemukan
        return redirect()->route('dashboard.konsumen')->with('error', 'Dashboard tidak ditemukan.');
    }

    // Default 404 page
    return response()->view('errors.404', [], 404);
});


// ====================
// Route produk
//=====================

Route::resource('produk',ProdukController::class);
Route::post('/produk/bulk-store', [ProdukController::class, 'bulkStore'])->name('produk.bulkStore');

// ====================
// REDIRECT ROUTES (Optional - untuk kemudahan)
// ====================

// Redirect routes untuk kemudahan
Route::get('/home', function () {
    return redirect('/');
});

Route::get('/beranda', function () {
    return redirect('/');
});

// ====================
// DEBUG ROUTES (Hanya di development)
// ====================

if (config('app.debug')) {
    Route::get('/debug/routes', function () {
        $routes = Route::getRoutes();
        $routeList = [];

        foreach ($routes as $route) {
            $routeList[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName()
            ];
        }

        return response()->json($routeList);
    })->name('debug.routes');
}