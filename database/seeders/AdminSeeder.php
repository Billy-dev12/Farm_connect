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

        DB::table('users')->insert([
            'name' => 'petani',
            'email' => 'petani@example.com',
            'password' => Hash::make('password'),
            'role' => 'farmer',
            'no_hp' => '08123456789',
            'alamat_pengiriman' => null,
            'jenis_tanaman' => 'Tomat',
            'lokasi_pertanian' => 'bandung',
            'luas_lahan' => 2.9,
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
        $this->command->warn('-----------------------------');
        $this->command->info('✅ Petani berhasil dibuat!');
        $this->command->warn('📧 Email: petani@example.com');
        $this->command->warn('🔑 Password: password');
    }
}