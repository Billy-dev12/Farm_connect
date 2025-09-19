<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'no_hp' => 'required|string|max:15',
            'alamat_pengiriman' => 'required|string'
        ]);

        $user = Auth::user();
        $user->no_hp = $request->no_hp;
        $user->alamat_pengiriman = $request->alamat_pengiriman;
        $user->save();

        return redirect()->route('profile.edit')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}