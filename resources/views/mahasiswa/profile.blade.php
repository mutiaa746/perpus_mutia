<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profil Mahasiswa - Neo E-Library</title>
    <style>
        :root {
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #64748b;
            --stroke: rgba(15, 23, 42, 0.14);
            --primary: #2563eb;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            background: var(--bg);
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }

        .page { min-height: 100%; }

        .topbar {
            position: sticky;
            top: 0;
            z-index: 10;
            background: rgba(248, 250, 252, 0.95);
            border-bottom: 1px solid var(--stroke);
            backdrop-filter: blur(10px);
        }

        .topbar-inner {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border: 0;
            background: transparent;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(15, 23, 42, 0.82);
        }

        .icon-btn:hover { color: var(--primary); }

        .icon-btn svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .title {
            font-weight: 900;
            letter-spacing: -0.2px;
            font-size: 15px;
        }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 18px 16px 28px;
        }

        .layout {
            display: grid;
            grid-template-columns: 320px 1fr;
            gap: 16px;
            align-items: start;
        }

        .panel {
            border: 1px solid var(--stroke);
            background: transparent;
            padding: 14px 14px;
        }

        .panel-head {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .avatar {
            width: 72px;
            height: 72px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            background: #ffffff;
            object-fit: cover;
        }

        .avatar-fallback {
            width: 72px;
            height: 72px;
            border-radius: 999px;
            border: 1px solid var(--stroke);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(15, 23, 42, 0.72);
            background: #ffffff;
        }

        .avatar-fallback svg {
            width: 28px;
            height: 28px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .name {
            font-weight: 900;
            letter-spacing: -0.2px;
            font-size: 16px;
            margin: 0;
        }

        .sub {
            margin: 6px 0 0;
            color: rgba(15, 23, 42, 0.70);
            font-size: 13px;
            line-height: 1.5;
        }

        .chips {
            margin-top: 12px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .chip {
            border: 1px solid rgba(15, 23, 42, 0.14);
            color: rgba(15, 23, 42, 0.78);
            padding: 6px 10px;
            font-size: 12px;
        }

        .chip.ok {
            border-color: rgba(16, 185, 129, 0.35);
            color: #065f46;
        }

        .chip.no {
            border-color: rgba(245, 158, 11, 0.35);
            color: #92400e;
        }

        .divider {
            margin: 14px 0;
            border-top: 1px solid rgba(15, 23, 42, 0.10);
        }

        .help {
            color: rgba(15, 23, 42, 0.66);
            font-size: 12px;
            line-height: 1.6;
            margin: 0;
        }

        .section-title {
            margin: 0 0 8px;
            font-size: 13px;
            color: rgba(15, 23, 42, 0.82);
            font-weight: 900;
            letter-spacing: -0.1px;
        }

        .status {
            border: 1px solid rgba(16, 185, 129, 0.22);
            background: rgba(16, 185, 129, 0.08);
            padding: 12px 12px;
            margin: 12px 0 14px;
            color: #065f46;
        }

        .errors {
            border: 1px solid rgba(239, 68, 68, 0.22);
            background: rgba(239, 68, 68, 0.08);
            padding: 12px 12px;
            margin: 12px 0 14px;
            color: #7f1d1d;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        form { margin: 0; }

        label {
            display: block;
            font-size: 13px;
            color: rgba(15, 23, 42, 0.82);
            margin-bottom: 6px;
        }

        input, select {
            width: 100%;
            height: 40px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 0 12px;
            outline: none;
        }

        textarea {
            width: 100%;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 10px 12px;
            outline: none;
            resize: vertical;
            min-height: 92px;
        }

        input:focus, select:focus, textarea:focus {
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .muted {
            margin-top: 6px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .field { margin-top: 12px; }

        .actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn {
            height: 38px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            padding: 0 12px;
            cursor: pointer;
            font-weight: 800;
            background: #ffffff;
            color: rgba(15, 23, 42, 0.92);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary {
            border: 0;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
        }

        @media (max-width: 980px) {
            .layout { grid-template-columns: 1fr; }
        }

        @media (max-width: 620px) {
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <main class="page">
        @php
            $fotoSrc = null;
            if (! empty($user->foto)) {
                $fotoSrc = str_starts_with($user->foto, 'uploads/') ? asset($user->foto) : asset('storage/' . $user->foto);
            }
        @endphp

        <header class="topbar">
            <div class="topbar-inner">
                <a class="icon-btn" href="{{ route('catalog.index') }}" aria-label="Kembali" title="Kembali">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M15 19l-7-7 7-7"></path>
                    </svg>
                </a>
                <div class="title">Profil</div>
            </div>
        </header>

        <div class="container">
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

            <div class="layout">
                <aside class="panel">
                    <div class="panel-head">
                        @if ($fotoSrc)
                            <img class="avatar" src="{{ $fotoSrc }}" alt="Foto {{ $user->nama }}">
                        @else
                            <span class="avatar-fallback" aria-hidden="true">
                                <svg viewBox="0 0 24 24">
                                    <circle cx="12" cy="8" r="4"></circle>
                                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"></path>
                                </svg>
                            </span>
                        @endif

                        <div>
                            <p class="name">{{ $user->nama }}</p>
                            <p class="sub">NIM: {{ $user->nim }}</p>
                        </div>
                    </div>

                    <div class="chips">
                        @if ($user->verifikasi === 'terdaftar')
                            <span class="chip ok">Terverifikasi</span>
                        @else
                            <span class="chip no">Menunggu verifikasi</span>
                        @endif
                        <span class="chip">{{ $user->email }}</span>
                        <span class="chip">{{ $user->nomor_hp }}</span>
                    </div>

                    <div style="margin-top: 12px; display: flex; justify-content: flex-start;">
                        <a class="btn" href="{{ route('mahasiswa.card.print') }}" target="_blank" rel="noopener">Cetak Kartu</a>
                    </div>

                    <div class="divider"></div>
                    <p class="help">Foto bisa diganti lewat form di sebelah kanan. Jika belum diverifikasi, tetap bisa melengkapi data dulu.</p>
                </aside>

                <section class="panel">
                    <form method="POST" action="{{ route('mahasiswa.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div>
                            <div class="section-title">Data Pribadi</div>
                            <div class="grid">
                                <div class="field" style="margin-top: 0;">
                                    <label for="nim">NIM</label>
                                    <input id="nim" value="{{ $user->nim }}" disabled>
                                    <div class="muted">NIM tidak bisa diubah.</div>
                                </div>
                                <div class="field" style="margin-top: 0;">
                                    <label for="nama">Nama</label>
                                    <input id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                                </div>
                            </div>

                            <div class="grid">
                                <div class="field">
                                    <label for="jenis_kelamin">Jenis Kelamin</label>
                                    <select id="jenis_kelamin" name="jenis_kelamin" required>
                                        <option value="L" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'L')>Laki-laki</option>
                                        <option value="P" @selected(old('jenis_kelamin', $user->jenis_kelamin) === 'P')>Perempuan</option>
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="umur">Umur</label>
                                    <input id="umur" type="number" name="umur" value="{{ old('umur', $user->umur) }}" required min="1" max="150">
                                </div>
                            </div>

                            <div class="grid">
                                <div class="field">
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                    <input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir', $user->tempat_lahir) }}" required>
                                </div>
                                <div class="field">
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                    <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($user->tanggal_lahir)->format('Y-m-d')) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div>
                            <div class="section-title">Kontak</div>
                            <div class="grid">
                                <div class="field" style="margin-top: 0;">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required>
                                </div>
                                <div class="field" style="margin-top: 0;">
                                    <label for="nomor_hp">Nomor HP</label>
                                    <input id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp', $user->nomor_hp) }}" required>
                                </div>
                            </div>
                            <div class="field">
                                <label for="alamat">Alamat</label>
                                <textarea id="alamat" name="alamat" required>{{ old('alamat', $user->alamat) }}</textarea>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div>
                            <div class="section-title">Foto & Keamanan</div>
                            <div class="grid">
                                <div class="field" style="margin-top: 0;">
                                    <label for="foto">Foto</label>
                                    <input id="foto" type="file" name="foto" accept="image/*">
                                </div>
                                <div class="field" style="margin-top: 0;">
                                    <label for="password">Password Baru</label>
                                    <input id="password" type="password" name="password">
                                    <div class="muted">Kosongkan jika tidak ingin mengganti password.</div>
                                </div>
                            </div>

                            <div class="grid">
                                <div class="field" style="margin-top: 0;">
                                    <label for="password_confirmation">Konfirmasi Password Baru</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation">
                                </div>
                                <div class="field" style="margin-top: 0;"></div>
                            </div>
                        </div>

                        <div class="actions">
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
