<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Borrowing;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $totalPeminjam = Peminjam::count();
        $totalAdmin = Admin::count();
        $totalUsers = $totalPeminjam + $totalAdmin;

        $pendingBorrowings = Borrowing::query()
            ->where('status', 'pending')
            ->count();

        $latestMahasiswa = Peminjam::query()
            ->orderByDesc('created_at')
            ->limit(8)
            ->get();

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalMahasiswa' => $totalPeminjam,
            'totalAdmin' => $totalAdmin,
            'pendingBorrowings' => $pendingBorrowings,
            'latestMahasiswa' => $latestMahasiswa,
        ]);
    }

    public function showPeminjam(Request $request, Peminjam $peminjam)
    {
        return view('admin.peminjams.show', [
            'peminjam' => $peminjam,
        ]);
    }

    public function verifikasiPeminjam(Request $request, Peminjam $peminjam)
    {
        $peminjam->verifikasi = 'terdaftar';
        $peminjam->save();

        return back()->with('status', 'Mahasiswa berhasil diverifikasi.');
    }

    public function destroyPeminjam(Request $request, Peminjam $peminjam)
    {
        if ($peminjam->foto) {
            if (str_starts_with($peminjam->foto, 'uploads/')) {
                File::delete(public_path($peminjam->foto));
            } else {
                Storage::disk('public')->delete($peminjam->foto);
            }
        }

        $peminjam->delete();

        return redirect()->route('admin.dashboard')->with('status', 'Mahasiswa berhasil dihapus.');
    }
}
