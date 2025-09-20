<?php

namespace Database\Seeders;

use App\Models\DummyProduct;
use App\Models\User;
use Illuminate\Database\Seeder;

class DummyProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil petani yang sudah ada
        $farmers = User::where('role', 'farmer')->get();

        if ($farmers->count() === 0) {
            $this->command->warn('Tidak ada petani ditemukan. Silakan buat petani terlebih dahulu.');
            return;
        }

        $products = [
            // Produk dari petani 1
            [
                'nama_produk' => 'Padi Organik Premium',
                'deskripsi' => 'Padi organik berkualitas tinggi, bebas pestisida, cocok untuk konsumsi sehari-hari',
                'kategori' => 'Bahan Pokok',
                'lokasi' => 'Karawang, Jawa Barat',
                'harga' => 5000,
                'stok' => 1000,
                'satuan' => 'kg',
                'gambar' => 'padi-organik.jpg'
            ],
            [
                'nama_produk' => 'Jagung Manis Super',
                'deskripsi' => 'Jagung manis varietas terbaru, manis dan renyah',
                'kategori' => 'Sayuran',
                'lokasi' => 'Karawang, Jawa Barat',
                'harga' => 3000,
                'stok' => 500,
                'satuan' => 'kg',
                'gambar' => 'jagung-manis.jpg'
            ],
            [
                'nama_produk' => 'Cabai Merah Pedas',
                'deskripsi' => 'Cabai merah segar, pedas dan berkualitas',
                'kategori' => 'Sayuran',
                'lokasi' => 'Karawang, Jawa Barat',
                'harga' => 15000,
                'stok' => 200,
                'satuan' => 'kg',
                'gambar' => 'cabai-merah.jpg'
            ],
            // Produk dari petani 2
            [
                'nama_produk' => 'Tomat Cherry',
                'deskripsi' => 'Tomat cherry segar, manis dan juicy',
                'kategori' => 'Sayuran',
                'lokasi' => 'Bogor, Jawa Barat',
                'harga' => 8000,
                'stok' => 300,
                'satuan' => 'kg',
                'gambar' => 'tomat-cherry.jpg'
            ],
            [
                'nama_produk' => 'Bayam Hijau Segar',
                'deskripsi' => 'Bayam hijau segar, kaya vitamin dan mineral',
                'kategori' => 'Sayuran Daun',
                'lokasi' => 'Bogor, Jawa Barat',
                'harga' => 2000,
                'stok' => 400,
                'satuan' => 'ikat',
                'gambar' => 'bayam-hijau.jpg'
            ],
            [
                'nama_produk' => 'Kangkung Segar',
                'deskripsi' => 'Kangkung segar, lembut dan enak',
                'kategori' => 'Sayuran Daun',
                'lokasi' => 'Bogor, Jawa Barat',
                'harga' => 1500,
                'stok' => 500,
                'satuan' => 'ikat',
                'gambar' => 'kangkung-segar.jpg'
            ],
            // Produk dari petani 3
            [
                'nama_produk' => 'Kentang Hebat',
                'deskripsi' => 'Kentang varietas unggul, besar dan padat',
                'kategori' => 'Umbi-umbian',
                'lokasi' => 'Garut, Jawa Barat',
                'harga' => 4000,
                'stok' => 600,
                'satuan' => 'kg',
                'gambar' => 'kentang-hebat.jpg'
            ],
            [
                'nama_produk' => 'Wortel Segar',
                'deskripsi' => 'Wortel segar, manis dan kaya vitamin A',
                'kategori' => 'Umbi-umbian',
                'lokasi' => 'Garut, Jawa Barat',
                'harga' => 3500,
                'stok' => 450,
                'satuan' => 'kg',
                'gambar' => 'wortel-segar.jpg'
            ],
            [
                'nama_produk' => 'Lombok Besar',
                'deskripsi' => 'Lombok besar, pedas dan aromatik',
                'kategori' => 'Rempah-rempah',
                'lokasi' => 'Garut, Jawa Barat',
                'harga' => 2500,
                'stok' => 300,
                'satuan' => 'kg',
                'gambar' => 'lombok-besar.jpg'
            ],
            [
                'nama_produk' => 'Bawang Merah',
                'deskripsi' => 'Bawang merah segar, berkualitas premium',
                'kategori' => 'Rempah-rempah',
                'lokasi' => 'Garut, Jawa Barat',
                'harga' => 12000,
                'stok' => 200,
                'satuan' => 'kg',
                'gambar' => 'bawang-merah.jpg'
            ]
        ];

        foreach ($products as $index => $productData) {
            // Assign ke petani secara bergantian
            $farmer = $farmers[$index % $farmers->count()];

            DummyProduct::create([
                'nama_produk' => $productData['nama_produk'],
                'deskripsi' => $productData['deskripsi'],
                'kategori' => $productData['kategori'],
                'lokasi' => $productData['lokasi'],
                'harga' => $productData['harga'],
                'stok' => $productData['stok'],
                'satuan' => $productData['satuan'],
                'gambar' => $productData['gambar'],
                'farmer_id' => $farmer->id
            ]);
        }

        $this->command->info('✅ Dummy produk berhasil dibuat!');
    }
}