@php($active = 'dashboard')
@extends('admin.layout')

@section('title', 'Detail Mahasiswa - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Detail Mahasiswa</h1>
            <a class="btn" href="{{ route('admin.dashboard') }}">Kembali</a>
        </div>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        <div class="grid" style="grid-template-columns: 240px 1fr;">
            <div>
                @if ($peminjam->foto)
                    @php($fotoSrc = str_starts_with($peminjam->foto, 'uploads/') ? asset($peminjam->foto) : asset('storage/' . $peminjam->foto))
                    <img class="thumb" src="{{ $fotoSrc }}" alt="Foto {{ $peminjam->nama }}">
                @else
                    <div class="thumb"></div>
                @endif

                <div style="margin-top: 10px;">
                    @if ($peminjam->verifikasi === 'terdaftar')
                        <span class="tag ok">Terverifikasi</span>
                    @else
                        <span class="tag no">Menunggu Verifikasi</span>
                    @endif
                </div>

                @if ($peminjam->verifikasi !== 'terdaftar')
                    <form method="POST" action="{{ route('admin.peminjams.verifikasi', $peminjam) }}" style="margin-top: 12px;">
                        @csrf
                        @method('PATCH')
                        <button class="btn primary" type="submit" style="width: 100%;">Verifikasi</button>
                    </form>
                @endif

                <form method="POST" action="{{ route('admin.peminjams.destroy', $peminjam) }}" style="margin-top: 10px;" onsubmit="return confirm('Hapus mahasiswa {{ $peminjam->nama }} ({{ $peminjam->nim }})?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn danger" type="submit" style="width: 100%;">Hapus Mahasiswa</button>
                </form>
            </div>

            <div>
                <table>
                    <tbody>
                        <tr>
                            <th style="width: 220px;">Nama</th>
                            <td>{{ $peminjam->nama }}</td>
                        </tr>
                        <tr>
                            <th>NIM</th>
                            <td>{{ $peminjam->nim }}</td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td>{{ $peminjam->email }}</td>
                        </tr>
                        <tr>
                            <th>Nomor HP</th>
                            <td>{{ $peminjam->nomor_hp }}</td>
                        </tr>
                        <tr>
                            <th>Umur</th>
                            <td>{{ $peminjam->umur }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>
                                @if ($peminjam->jenis_kelamin === 'L')
                                    Laki-laki
                                @else
                                    Perempuan
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $peminjam->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ optional($peminjam->tanggal_lahir)->format('d-m-Y') }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td style="white-space: pre-wrap;">{{ $peminjam->alamat }}</td>
                        </tr>
                        <tr>
                            <th>Dibuat</th>
                            <td>{{ \Illuminate\Support\Carbon::parse($peminjam->created_at)->format('d-m-Y H:i') }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
