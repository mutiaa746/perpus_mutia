<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return view('mahasiswa.profile', [
            'user' => $request->user('peminjam'),
        ]);
    }

    public function printCard(Request $request)
    {
        return view('mahasiswa.card-print', [
            'user' => $request->user('peminjam'),
        ]);
    }

    public function borrowings(Request $request)
    {
        $user = $request->user('peminjam');

        $borrowings = Borrowing::query()
            ->where('peminjam_id', $user->id)
            ->with(['admin', 'items.book'])
            ->orderByDesc('borrow_date')
            ->paginate(10);

        return view('mahasiswa.borrowings.index', [
            'user' => $user,
            'borrowings' => $borrowings,
        ]);
    }

    public function showBorrowing(Request $request, Borrowing $borrowing)
    {
        $user = $request->user('peminjam');

        if ((int) $borrowing->peminjam_id !== (int) $user->id) {
            abort(403);
        }

        $borrowing->load(['admin', 'items.book']);

        return view('mahasiswa.borrowings.show', [
            'user' => $user,
            'borrowing' => $borrowing,
        ]);
    }

    public function printBorrowing(Request $request, Borrowing $borrowing)
    {
        $user = $request->user('peminjam');

        if ((int) $borrowing->peminjam_id !== (int) $user->id) {
            abort(403);
        }

        if ($borrowing->status !== 'pending') {
            return redirect()->route('mahasiswa.borrowings.show', $borrowing);
        }

        $borrowing->load(['items.book']);

        return view('mahasiswa.borrowings.print', [
            'user' => $user,
            'borrowing' => $borrowing,
        ]);
    }

    public function update(Request $request)
    {
        $user = $request->user('peminjam');

        $data = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'umur' => ['required', 'integer', 'min:1', 'max:150'],
            'tanggal_lahir' => ['required', 'date'],
            'tempat_lahir' => ['required', 'string', 'max:255'],
            'nomor_hp' => ['required', 'string', 'max:30'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('peminjams', 'email')->ignore($user->id, 'id'),
            ],
            'alamat' => ['required', 'string'],
            'foto' => ['nullable', 'image', 'max:2048'],
            'jenis_kelamin' => ['required', 'in:L,P'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ]);

        $user->nama = $data['nama'];
        $user->umur = $data['umur'];
        $user->tanggal_lahir = $data['tanggal_lahir'];
        $user->tempat_lahir = $data['tempat_lahir'];
        $user->nomor_hp = $data['nomor_hp'];
        $user->email = $data['email'];
        $user->alamat = $data['alamat'];
        $user->jenis_kelamin = $data['jenis_kelamin'];

        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        if ($request->hasFile('foto')) {
            $destinationPath = public_path('uploads/peminjams');
            File::ensureDirectoryExists($destinationPath);

            $extension = $request->file('foto')->getClientOriginalExtension();
            $filename = uniqid('peminjam_', true).($extension ? '.'.$extension : '');

            $request->file('foto')->move($destinationPath, $filename);
            $user->foto = 'uploads/peminjams/'.$filename;
        }

        $user->save();

        return back()->with('status', 'Profil berhasil diperbarui.');
    }
}
