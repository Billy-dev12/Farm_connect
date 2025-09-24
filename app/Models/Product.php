<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'kategori',
        'harga',
        'stok',
        'status',
        'gambar',
        'farmer_id'
    ];

    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    // cek stok
    public function isInStock()
    {
        return $this->stok > 0;
    }
}
