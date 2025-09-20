<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_create_dummy_products_table.php
    public function up(): void
    {
        Schema::create('dummy_products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_produk');
            $table->text('deskripsi');
            $table->string('kategori');
            $table->string('lokasi');
            $table->integer('harga');
            $table->integer('stok');
            $table->string('satuan');
            $table->string('gambar')->nullable();
            $table->integer('farmer_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dummy_products');
    }
};
