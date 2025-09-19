<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Hapus constructor dengan middleware

    public function dashboard()
    {
        $pendingFarmers = User::where('role', 'farmer')
            ->where('status', 'pending')
            ->get();

        $adminContact = [
            'phone' => '0812-3456-7890',
            'email' => 'admin@sistem-pertanian.com',
            'whatsapp' => '0812-3456-7890'
        ];

        return view('admin.dashboard', compact('pendingFarmers', 'adminContact'));
    }

    public function verifyFarmer(Request $request, User $farmer)
    {
        $request->validate([
            'action' => 'required|in:approve,reject',
            'alasan_penolakan' => 'required_if:action,reject|string'
        ]);

        if ($farmer->role !== 'farmer') {
            abort(404);
        }

        if ($request->action === 'approve') {
            $farmer->status = 'active';
            $farmer->verified_at = now();
            $farmer->verified_by = Auth::id();
            $farmer->alasan_penolakan = null;
            $message = 'Petani berhasil diverifikasi!';
        } else {
            $farmer->status = 'rejected';
            $farmer->alasan_penolakan = $request->alasan_penolakan;
            $message = 'Petani ditolak dengan alasan: ' . $request->alasan_penolakan;
        }

        $farmer->save();

        return redirect()->route('admin.dashboard')->with('success', $message);
    }
    // app/Http/Controllers/AdminController.php

    public function downloadProposal(User $farmer)
    {
        if ($farmer->role !== 'farmer' || !$farmer->hasProposal()) {
            abort(404, 'Proposal tidak ditemukan');
        }

        $filePath = storage_path('app/public/' . $farmer->proposal_path);

        if (!file_exists($filePath)) {
            abort(404, 'File proposal tidak ditemukan di server');
        }

        return response()->download($filePath, $farmer->proposal_filename);
    }
}