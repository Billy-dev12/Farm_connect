<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

// app/Http/Controllers/AuthController.php
class AuthController extends Controller
{
    // Register Konsumen
    public function showConsumerRegister()
    {
        return view('auth.register-consumer');
    }

    public function registerConsumer(Request $request)
    {
        try {
            // 1. Validation
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'no_hp' => 'required|string|max:15',
            ], [
                'name.required' => 'Nama lengkap harus diisi ya!',
                'name.max' => 'Nama terlalu panjang, maksimal 255 karakter.',
                'email.required' => 'Email wajib diisi untuk kami hubungi.',
                'email.email' => 'Format email tidak valid, cek lagi ya!',
                'email.unique' => 'Email ini sudah terdaftar. Mungkin sudah punya akun?',
                'password.required' => 'Password tidak boleh kosong.',
                'password.min' => 'Password minimal 6 karakter, untuk keamanan akunmu.',
                'password.confirmed' => 'Konfirmasi password tidak cocok. Cek lagi ya!',
                'no_hp.required' => 'Nomor HP harus diisi untuk verifikasi.',
                'no_hp.max' => 'Nomor HP terlalu panjang, maksimal 15 karakter.',
            ]);

            // 2. Create user dengan debugging
            $userData = [
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'consumer',
                'no_hp' => $validated['no_hp'],
                'alamat_pengiriman' => null,
                'status' => 'active',
            ];

            // Debug: Log data sebelum create
            \Log::info('Creating user with data:', $userData);

            $user = User::create($userData);

            // Debug: Log hasil create
            \Log::info('User created successfully:', ['user_id' => $user->id, 'user_email' => $user->email]);

            // 3. Login otomatis
            Auth::login($user);

            // 4. Redirect dengan success message
            return redirect()->route('dashboard.customer')
                ->with('success', 'Selamat datang, ' . $user->name . '! 🎉 Akunmu berhasil dibuat. Yuk, jelajahi platform pertanian kami!');

        } catch (ValidationException $e) {
            // Validation errors
            \Log::error('Validation error:', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);

            return back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Illuminate\Database\QueryException $e) {
            // Database errors - lebih detail
            \Log::error('Database error during registration:', [
                'message' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'code' => $e->getCode(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            $errorMessage = 'Maaf, ada masalah dengan database kami. ';

            // Tambahkan detail error untuk debugging
            if (config('app.debug')) {
                $errorMessage .= ' Error: ' . $e->getMessage();
            } else {
                $errorMessage .= 'Tim teknis sudah diberitahu. Silakan coba beberapa saat lagi! 🙏';
            }

            return back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();

        } catch (\Exception $e) {
            // Other errors
            \Log::error('Registration error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withErrors([
                    'error' => 'Ups! Ada yang salah saat proses pendaftaran. 🤔 Mohon cek kembali data Anda dan coba lagi. Jika masalah berlanjut, hubungi tim support kami.'
                ])
                ->withInput();
        }
    }

    // Register Petani
    public function showFarmerRegister()
    {
        return view('auth.register-farmer');
    }

    // app/Http/Controllers/AuthController.php

    public function registerFarmer(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
                'no_hp' => 'required|string|max:15',
                'jenis_tanaman' => 'required|string',
                'lokasi_pertanian' => 'required|string',
                'luas_lahan' => 'required|numeric|min:0.1',
                'proposal' => 'required|file|mimes:pdf|max:5120' // Max 5MB
            ], [
                'proposal.required' => 'Proposal pertanian wajib diupload!',
                'proposal.file' => 'Yang diupload harus berupa file!',
                'proposal.mimes' => 'Format file harus PDF!',
                'proposal.max' => 'Ukuran file maksimal 5MB!'
            ]);

            // Handle file upload
            if ($request->hasFile('proposal')) {
                $proposalFile = $request->file('proposal');
                $proposalFileName = time() . '_' . str_replace(' ', '_', $validated['name']) . '_proposal.' . $proposalFile->getClientOriginalExtension();

                // Simpan file ke storage/app/public/proposals
                $proposalPath = $proposalFile->storeAs('proposals', $proposalFileName, 'public');
            }

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'farmer',
                'no_hp' => $validated['no_hp'],
                'jenis_tanaman' => $validated['jenis_tanaman'],
                'lokasi_pertanian' => $validated['lokasi_pertanian'],
                'luas_lahan' => $validated['luas_lahan'],
                'status' => 'pending',
                'proposal_path' => $proposalPath ?? null,
                'proposal_filename' => $proposalFileName ?? null,
                'proposal_uploaded_at' => now()
            ]);

            return redirect()->route('login')
                ->with('success', 'Pendaftaran berhasil, ' . $user->name . '! 🌱 Proposal Anda telah diterima. Tim kami akan mengevaluasi proposal dalam 2x24 jam.');

        } catch (ValidationException $e) {
            return back()
                ->withErrors($e->validator)
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Farmer registration error: ' . $e->getMessage());

            return back()
                ->withErrors([
                    'error' => 'Ups! Ada yang salah saat proses pendaftaran. Silakan coba lagi.'
                ])
                ->withInput();
        }
    }

    // Login
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            // 1. Validation dengan custom messages
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ], [
                'email.required' => 'Email harus diisi ya!',
                'email.email' => 'Format email tidak valid, cek lagi ya!',
                'password.required' => 'Password tidak boleh kosong.',
            ]);

            // 2. Cek user exists
            $user = User::where('email', $credentials['email'])->first();

            if (!$user) {
                \Log::warning('Login failed - user not found:', ['email' => $credentials['email']]);

                return back()
                    ->withErrors([
                        'email' => 'Email tidak terdaftar. Cek lagi atau daftar dulu ya! 📝'
                    ])
                    ->onlyInput('email');
            }

            // 3. Attempt login
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                // Cek status petani
                if ($user->isPetani()) {
                    if (!$user->isActive()) {
                        // Simpan data user di session sebelum logout
                        $userData = [
                            'name' => $user->name,
                            'email' => $user->email,
                            'alasan_penolakan' => $user->alasan_penolakan
                        ];

                        Auth::logout();

                        if ($user->isPending()) {
                            return redirect()->route('verification.pending')
                                ->with('user_data', $userData)
                                ->with('info', 'Halo, ' . $user->name . '! Akun petani Anda masih dalam proses verifikasi. ⏳ Mohon tunggu 1x24 jam untuk konfirmasi dari admin.');
                        } elseif ($user->isRejected()) {
                            return redirect()->route('verification.rejected')
                                ->with('user_data', $userData)
                                ->with('warning', 'Maaf, ' . $user->name . '. Akun petani Anda tidak disetujui. 😔 Alasan: ' . $user->alasan_penolakan);
                        }
                    }
                }

                // Redirect sesuai role
                $redirectRoute = '';
                $welcomeMessage = '';

                if ($user->isAdmin()) {
                    $redirectRoute = 'admin.dashboard';
                    $welcomeMessage = 'Selamat datang kembali, Admin! 👋';
                } elseif ($user->isPetani()) {
                    $redirectRoute = 'dashboard.farmer';
                    $welcomeMessage = 'Selamat datang kembali, Petani ' . $user->name . '! 🌾 Semoga panenmu melimpah hari ini!';
                } else {
                    $redirectRoute = 'dashboard.konsumen';
                    $welcomeMessage = 'Selamat datang kembali, ' . $user->name . '! 🛒 Yuk, lihat produk pertanian segar hari ini!';
                }

                return redirect()->route($redirectRoute)
                    ->with('success', $welcomeMessage);
            }

            // 4. Jika attempt gagal
            \Log::warning('Login attempt failed - invalid credentials:', [
                'email' => $credentials['email'],
                'timestamp' => now()
            ]);

            return back()
                ->withErrors([
                    'email' => 'Email atau password salah. Cek lagi ya! 🔍'
                ])
                ->onlyInput('email');

        } catch (ValidationException $e) {
            // Validation errors
            \Log::error('Login validation error:', [
                'errors' => $e->errors(),
                'request' => $request->all()
            ]);

            return back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Illuminate\Database\QueryException $e) {
            // Database errors
            \Log::error('Database error during login:', [
                'message' => $e->getMessage(),
                'sql' => $e->getSql(),
                'bindings' => $e->getBindings(),
                'code' => $e->getCode()
            ]);

            return back()
                ->withErrors([
                    'error' => 'Maaf, ada masalah dengan database kami. Tim teknis sudah diberitahu. Silakan coba beberapa saat lagi! 🙏'
                ])
                ->withInput();

        } catch (\Exception $e) {
            // Other errors - lebih detail
            \Log::error('Login error:', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            // Tampilkan error detail di development
            $errorMessage = 'Ups! Ada yang salah saat proses login. 🤔 ';

            if (config('app.debug')) {
                $errorMessage .= 'Error: ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine();
            } else {
                $errorMessage .= 'Silakan coba lagi atau hubungi tim support jika masalah berlanjut.';
            }

            return back()
                ->withErrors(['error' => $errorMessage])
                ->withInput();
        }
    }

    public function logout(Request $request)
    {
        try {
            // 1. Ambil user info sebelum logout
            $user = Auth::user();

            if (!$user) {
                // Jika sudah logout, redirect ke login
                return redirect()->route('login')
                    ->with('info', 'Anda sudah logout. Silakan login kembali jika ingin menggunakan aplikasi.');
            }

            $userInfo = [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'last_activity' => now()
            ];

            // 2. Logging logout activity
            \Log::info('User logout', $userInfo);

            // 3. Logout proses
            Auth::logout();

            // 4. Invalidate session
            $request->session()->invalidate();

            // 5. Regenerate CSRF token
            $request->session()->regenerateToken();

            // 6. Determine message based on role
            $message = '';

            switch ($user->role) {
                case 'admin':
                    $message = 'Terima kasih, ' . $user->name . '! 👋 Sesi admin telah berakhir. Platform pertanian kami aman berkat pengawasan Anda.';
                    break;

                case 'farmer':
                    $message = 'Terima kasih, Petani ' . $user->name . '! 🌾 Semoga panen Anda selalu melimpah. Jangan lupa update status produk ya!';
                    break;

                case 'consumer':
                    $message = 'Terima kasih, ' . $user->name . '! 🛒 Sampai jumpa lagi di platform pertanian kami. Jangan lupa cek produk fresh hari ini!';
                    break;

                default:
                    $message = 'Terima kasih, ' . $user->name . '! 👋 Sampai jumpa lagi di platform pertanian kami.';
            }

            // 7. Redirect dengan success message
            return redirect()->route('login')
                ->with('success', $message);

        } catch (\Exception $e) {
            // Handle unexpected errors
            \Log::error('Logout error:', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'user_id' => Auth::id() ?? 'unknown'
            ]);

            // Fallback redirect
            return redirect()->route('login')
                ->with('warning', 'Terjadi kesalahan saat logout. Silakan tutup browser untuk keamanan akun Anda.');
        }
    }
}