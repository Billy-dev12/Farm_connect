<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus admin yang sudah ada (optional - untuk fresh install)
        DB::table('users')->where('role', 'admin')->delete();

        // Buat admin baru dengan DB::create
        DB::table('users')->insert([
            'name' => 'Admin Utama',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'no_hp' => '08123456789',
            'alamat_pengiriman' => 'Kantor Pusat',
            'jenis_tanaman' => null,
            'lokasi_pertanian' => null,
            'luas_lahan' => null,
            'status' => 'active',
            'verified_at' => now(),
            'verified_by' => null, // Admin tidak perlu verifikasi
            'alasan_penolakan' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->command->info('✅ Admin berhasil dibuat!');
        $this->command->warn('📧 Email: admin@example.com');
        $this->command->warn('🔑 Password: admin123');
    }
}