@php($active = 'borrowings')
@extends('admin.layout')

@section('title', 'Peminjaman - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Peminjaman</h1>
            <div class="actions" style="justify-content: flex-start;">
                <a class="btn {{ $status === 'pending' ? 'primary' : '' }}" href="{{ route('admin.borrowings.index', ['status' => 'pending']) }}">Pending ({{ (int) ($counts->pending_count ?? 0) }})</a>
                <a class="btn {{ $status === 'approved' ? 'primary' : '' }}" href="{{ route('admin.borrowings.index', ['status' => 'approved']) }}">Approved ({{ (int) ($counts->approved_count ?? 0) }})</a>
                <a class="btn {{ $status === 'returned' ? 'primary' : '' }}" href="{{ route('admin.borrowings.index', ['status' => 'returned']) }}">Returned ({{ (int) ($counts->returned_count ?? 0) }})</a>
            </div>
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
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mahasiswa</th>
                    <th>NIM</th>
                    <th>Status</th>
                    <th>Diproses</th>
                    <th>Tanggal</th>
                    <th style="text-align:right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowings as $borrowing)
                    <tr>
                        <td>#{{ $borrowing->borrow_id }}</td>
                        <td>{{ $borrowing->peminjam?->nama ?? '-' }}</td>
                        <td>{{ $borrowing->peminjam?->nim ?? '-' }}</td>
                        <td>
                            {{ strtoupper($borrowing->status) }}
                        </td>
                        <td>{{ $borrowing->admin?->nama_admin ?? '-' }}</td>
                        <td>{{ optional($borrowing->borrow_date)->format('d-m-Y H:i') }}</td>
                        <td style="text-align:right;">
                            <a class="btn" href="{{ route('admin.borrowings.show', $borrowing) }}">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="color: rgba(15, 23, 42, 0.60);">Belum ada data peminjaman.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $borrowings->links() }}
        </div>
    </section>
@endsection
