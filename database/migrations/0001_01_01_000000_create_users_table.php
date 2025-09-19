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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('role')->default('consumer'); // consumer, farmer, admin
            $table->string('no_hp')->nullable();
            $table->text('alamat_pengiriman')->nullable(); // untuk konsumen
            $table->string('jenis_tanaman')->nullable(); // untuk petani
            $table->text('lokasi_pertanian')->nullable(); // untuk petani
            $table->decimal('luas_lahan', 8, 2)->nullable(); // untuk petani
            $table->string('status')->default('pending'); // pending, active, rejected
            $table->timestamp('verified_at')->nullable(); // untuk petani
            $table->foreignId('verified_by')->nullable()->constrained('users');
            $table->text('alasan_penolakan')->nullable(); // untuk petani
            $table->string('proposal_path')->nullable();
            $table->string('proposal_filename')->nullable();
            $table->timestamp('proposal_uploaded_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
