<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
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

// Halaman Utama (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// ====================
// AUTHENTICATION ROUTES
// ====================

// Register Routes
Route::get('/register/consumer', [AuthController::class, 'showConsumerRegister'])->name('register.consumer');
Route::post('/register/consumer', [AuthController::class, 'registerConsumer'])->name('register.consumer.post');
Route::get('/register/farmer', [AuthController::class, 'showFarmerRegister'])->name('register.farmer');
Route::post('/register/farmer', [AuthController::class, 'registerFarmer'])->name('register.farmer.post');

// Login Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Logout Route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ====================
// VERIFICATION ROUTES
// ====================

// Verification Pending (untuk petani yang belum diverifikasi)
Route::get('/verification-pending', function () {
    return view('auth.pending');
})->name('verification.pending');

// Verification Rejected (untuk petani yang ditolak)
Route::get('/verification-rejected', function () {
    return view('auth.rejected');
})->name('verification.rejected');

// ====================
// ADMIN ROUTES
// ====================

// Admin Routes dengan middleware auth dan admin
// routes/web.php

Route::prefix('admin')->middleware(['auth', 'admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/farmer/{farmer}/verify', [AdminController::class, 'verifyFarmer'])->name('verify.farmer');
    Route::get('/farmer/{farmer}/download-proposal', [AdminController::class, 'downloadProposal'])->name('download-proposal');
});

// ====================
// AUTHENTICATED ROUTES
// ====================

// Routes yang memerlukan authentication
Route::middleware(['auth'])->group(function () {

    // routes/web.php

    // Dashboard Routes
    Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard/petani', [DashboardController::class, 'petani'])->name('dashboard.farmer');
        Route::get('/dashboard/konsumen', [DashboardController::class, 'konsumen'])->name('dashboard.customer');
    });
    // Profile Routes   
    Route::prefix('profile')->name('profile.')->group(function () {
        Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
        Route::put('/update', [ProfileController::class, 'update'])->name('update');
    });

    // Bisa tambahkan routes lain di sini
    // Contoh:
    // Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    // Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
});

// ====================
// FALLBACK ROUTE
// ====================

// Route untuk handle 404 (optional)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});