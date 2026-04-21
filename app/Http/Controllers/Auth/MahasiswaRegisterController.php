<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Peminjam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MahasiswaRegisterController extends Controller
{
    public function create()
    {
        return view('auth.mahasiswa-register');
    }

    public function cekVerifikasi(Request $request)
    {
        $data = $request->validate([
            'nim' => ['required', 'string'],
        ]);

        $nim = trim($data['nim']);

        $peminjam = Peminjam::query()
            ->where('nim', $nim)
            ->first();

        if (! $peminjam) {
            return response()->json([
                'found' => false,
            ]);
        }

        return response()->json([
            'found' => true,
            'verifikasi' => $peminjam->verifikasi,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'min:1', 'max:150'],
            'tanggal_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'nomor_hp' => ['required', 'string', 'max:30'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:peminjams,email'],
            'alamat' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'nim' => ['required', 'string', 'max:50', 'unique:peminjams,nim'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $destinationPath = public_path('uploads/peminjams');
            File::ensureDirectoryExists($destinationPath);

            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = uniqid('peminjam_', true).($extension ? '.'.$extension : '');

            $request->file('foto')->move($destinationPath, $filename);
            $fotoPath = 'uploads/peminjams/'.$filename;
        }

        Peminjam::create([
            'nama' => $data['nama'],
            'umur' => $data['umur'],
            'tanggal_lahir' => $data['tanggal_lahir'],
            'tempat_lahir' => $data['tempat_lahir'],
            'nomor_hp' => $data['nomor_hp'],
            'email' => $data['email'],
            'alamat' => $data['alamat'],
            'foto' => $fotoPath,
            'jenis_kelamin' => $data['jenis_kelamin'],
            'nim' => $data['nim'],
            'verifikasi' => 'belum_terdaftar',
            'password' => Hash::make($data['password']),
        ]);

        return redirect()
            ->route('mahasiswa.register')
            ->with('registered', true)
            ->with('registered_nim', $data['nim']);
    }
}
