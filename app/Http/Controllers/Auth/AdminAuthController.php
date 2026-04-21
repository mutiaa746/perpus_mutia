<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function create()
    {
        return view('auth.admin-login');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::guard('peminjam')->check()) {
            Auth::guard('peminjam')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        if (! Auth::guard('admin')->attempt($credentials)) {
            return back()
                ->withInput($request->only('username'))
                ->withErrors([
                    'username' => 'Username atau password salah.',
                ]);
        }

        $request->session()->regenerate();

        return redirect()->route('admin.dashboard');
    }
}
