<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DummyProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk',
        'deskripsi',
        'kategori',
        'lokasi',
        'harga',
        'stok',
        'satuan',
        'gambar',
        'farmer_id'
    ];

    // Relasi ke petani
    public function farmer()
    {
        return $this->belongsTo(User::class, 'farmer_id');
    }

    // Scope untuk pencarian
    public function scopeSearch($query, $search)
    {
        return $query->where('nama_produk', 'like', '%' . $search . '%')
            ->orWhere('deskripsi', 'like', '%' . $search . '%');
    }

    // Scope untuk filter kategori
    public function scopeCategory($query, $category)
    {
        return $query->where('kategori', $category);
    }

    // Scope untuk filter lokasi
    public function scopeLocation($query, $location)
    {
        return $query->where('lokasi', 'like', '%' . $location . '%');
    }

    // Relasi ke Rating
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Relasi ke OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Helper untuk average rating
    public function averageRating()
    {
        return $this->ratings()->avg('rating') ?: 0;
    }
}