<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaAuthController extends Controller
{
    public function create()
    {
        return view('auth.mahasiswa-login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'nim' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (! Auth::guard('peminjam')->attempt([
            'nim' => $credentials['nim'],
            'password' => $credentials['password'],
        ])) {
            return back()
                ->withInput($request->only('nim'))
                ->withErrors([
                    'nim' => 'NIM atau password salah.',
                ]);
        }

        $peminjam = Auth::guard('peminjam')->user();
        if ($peminjam && $peminjam->verifikasi !== 'terdaftar') {
            Auth::guard('peminjam')->logout();
            $request->session()->regenerate();

            return back()
                ->withInput($request->only('nim'))
                ->withErrors([
                    'nim' => 'Akun kamu belum diverifikasi admin. Silakan tunggu verifikasi.',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->route('catalog.index');
    }
}
