<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('dummy_products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi')->nullable();
            $table->string('kategori');
            $table->string('lokasi');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('satuan');
            $table->string('gambar')->nullable();
            $table->unsignedBigInteger('farmer_id'); // pakai unsigned
            $table->timestamps();

            // kalau nanti ada relasi ke tabel users/petani
            // $table->foreign('farmer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // sesuai nama tabel
    }
};
