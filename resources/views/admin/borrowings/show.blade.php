@php($active = 'borrowings')
@extends('admin.layout')

@section('title', 'Detail Peminjaman - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Detail Peminjaman #{{ $borrowing->borrow_id }}</h1>
            <a class="btn" href="{{ route('admin.borrowings.index', ['status' => $borrowing->status]) }}">Kembali</a>
        </div>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table>
            <tbody>
                <tr>
                    <th style="width: 220px;">Mahasiswa</th>
                    <td>{{ $borrowing->peminjam?->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <th>NIM</th>
                    <td>{{ $borrowing->peminjam?->nim ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>{{ strtoupper($borrowing->status) }}</td>
                </tr>
                <tr>
                    <th>Tanggal Pinjam</th>
                    <td>{{ optional($borrowing->borrow_date)->format('d-m-Y H:i') }}</td>
                </tr>
                <tr>
                    <th>Tanggal Kembali (Jadwal)</th>
                    <td>{{ $borrowing->return_date ? $borrowing->return_date->format('d-m-Y H:i') : '-' }}</td>
                </tr>
                <tr>
                    <th>Diproses Oleh</th>
                    <td>{{ $borrowing->admin?->nama_admin ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td style="white-space: pre-wrap;">{{ $borrowing->note ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
    </section>

    <section class="panel" style="margin-top: 14px;">
        <div class="panel-head">
            <h1>Daftar Buku</h1>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Buku</th>
                    <th>Stok Saat Ini</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowing->items as $item)
                    <tr>
                        <td>{{ $item->book?->title ?? '-' }}</td>
                        <td>{{ $item->book?->stock ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="color: rgba(15, 23, 42, 0.60);">Belum ada item.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    <section class="panel" style="margin-top: 14px;">
        <div class="panel-head">
            <h1>Aksi Admin</h1>
        </div>

        @if ($borrowing->status === 'pending')
            <form method="POST" action="{{ route('admin.borrowings.approve', $borrowing) }}">
                @csrf
                @method('PATCH')
                <div class="field" style="margin-top: 0;">
                    <label for="return_date">Tanggal Kembali (ditentukan admin)</label>
                    <input id="return_date" type="datetime-local" name="return_date" value="{{ old('return_date') }}" required>
                </div>
                <div class="field" style="margin-top: 0;">
                    <label for="note">Catatan (opsional)</label>
                    <textarea id="note" name="note">{{ old('note', $borrowing->note) }}</textarea>
                </div>
                <div class="actions" style="justify-content: flex-start; margin-top: 12px;">
                    <button class="btn primary" type="submit">Approve</button>
                </div>
            </form>
        @elseif ($borrowing->status === 'approved')
            <form method="POST" action="{{ route('admin.borrowings.returned', $borrowing) }}">
                @csrf
                @method('PATCH')
                <div class="field" style="margin-top: 0;">
                    <label for="note">Catatan (opsional)</label>
                    <textarea id="note" name="note">{{ old('note', $borrowing->note) }}</textarea>
                </div>
                <div class="actions" style="justify-content: flex-start; margin-top: 12px;">
                    <button class="btn primary" type="submit">Tandai Dikembalikan</button>
                </div>
            </form>
        @else
            <div style="color: rgba(15, 23, 42, 0.72);">Peminjaman sudah selesai.</div>
        @endif
    </section>
@endsection
