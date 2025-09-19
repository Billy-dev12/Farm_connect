<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'no_hp',
        'alamat_pengiriman',
        'jenis_tanaman',
        'lokasi_pertanian',
        'luas_lahan',
        'status',
        'verified_at',
        'verified_by',
        'alasan_penolakan',
        'proposal_path',
        'proposal_filename',
        'proposal_uploaded_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'luas_lahan' => 'decimal:2',
        'verified_at' => 'datetime',
    ];

    // Helper methods
    public function isPetani(): bool
    {
        return $this->role === 'farmer';
    }

    public function isKonsumen(): bool
    {
        return $this->role === 'consumer';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function hasProposal(): bool
    {
        return !empty($this->proposal_path);
    }

    public function getProposalUrl(): string
    {
        return $this->proposal_path ? asset('storage/' . $this->proposal_path) : '';
    }
}