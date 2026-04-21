<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Mahasiswa - Neo E-Library</title>
    <style>
        :root {
            --bg: #f5f7fb;
            --text: #0f172a;
            --muted: #64748b;
            --stroke: rgba(15, 23, 42, 0.12);
            --card: #ffffff;
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

        .page {
            min-height: 100%;
            display: grid;
            place-items: center;
            padding: 26px 16px;
            background: var(--bg);
        }

        .split {
            width: min(980px, 100%);
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 14px;
            align-items: start;
        }

        .card {
            width: 100%;
            border: 1px solid var(--stroke);
            background: var(--card);
            border-radius: 18px;
            padding: 18px 18px;
            box-shadow: 0 18px 50px rgba(15, 23, 42, 0.12);
        }

        .head {
            margin-bottom: 14px;
            text-align: center;
        }

        .logo {
            display: inline-block;
            width: 150px;
            max-width: 100%;
            height: auto;
            margin: 2px auto 10px;
        }

        .head strong {
            display: block;
            font-size: 20px;
            letter-spacing: -0.2px;
        }

        .head span {
            display: block;
            margin-top: 6px;
            font-size: 13px;
            color: var(--muted);
            line-height: 1.5;
        }

        .errors {
            border: 1px solid rgba(239, 68, 68, 0.22);
            background: rgba(239, 68, 68, 0.08);
            border-radius: 14px;
            padding: 12px 12px;
            margin: 12px 0 14px;
            color: #7f1d1d;
        }

        .info {
            border: 1px solid rgba(37, 99, 235, 0.22);
            background: rgba(37, 99, 235, 0.08);
            border-radius: 14px;
            padding: 12px 12px;
            margin: 12px 0 14px;
            color: #1e3a8a;
        }

        .ok {
            border: 1px solid rgba(16, 185, 129, 0.22);
            background: rgba(16, 185, 129, 0.08);
            border-radius: 14px;
            padding: 12px 12px;
            margin: 12px 0 14px;
            color: #065f46;
        }

        .check-row {
            display: grid;
            grid-template-columns: 1fr 44px;
            gap: 10px;
            align-items: end;
        }

        .check-btn {
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .check-btn svg {
            width: 18px;
            height: 18px;
            fill: rgba(15, 23, 42, 0.78);
        }

        .check-result {
            margin-top: 10px;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        .grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .field {
            margin-top: 12px;
        }

        label {
            display: block;
            font-size: 13px;
            color: rgba(15, 23, 42, 0.86);
            margin-bottom: 6px;
        }

        input {
            width: 100%;
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 0 12px;
            outline: none;
        }

        select {
            width: 100%;
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 0 12px;
            outline: none;
        }

        textarea {
            width: 100%;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 10px 12px;
            outline: none;
            resize: vertical;
            min-height: 92px;
        }

        input:focus {
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        select:focus,
        textarea:focus {
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .actions {
            margin-top: 14px;
            display: grid;
            gap: 10px;
        }

        button {
            height: 44px;
            border-radius: 12px;
            border: 0;
            cursor: pointer;
            font-weight: 800;
            letter-spacing: 0.2px;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
        }

        .btn-secondary {
            background: #ffffff;
            color: rgba(15, 23, 42, 0.92);
            border: 1px solid rgba(15, 23, 42, 0.16);
        }

        .links {
            margin-top: 12px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            font-size: 13px;
            color: var(--muted);
        }

        .links a:hover {
            text-decoration: underline;
        }

        @media (max-width: 620px) {
            .grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 980px) {
            .split { grid-template-columns: 1fr; }
        }

        .overlay {
            position: fixed;
            inset: 0;
            display: grid;
            place-items: center;
            background: rgba(15, 23, 42, 0.55);
            backdrop-filter: blur(6px);
            padding: 18px;
            z-index: 50;
        }

        .overlay.hidden {
            display: none;
        }

        .overlay-card {
            width: min(520px, 100%);
            border-radius: 18px;
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.12);
            box-shadow: 0 24px 80px rgba(0, 0, 0, 0.35);
            padding: 18px 18px;
            animation: pop 240ms ease-out;
        }

        @keyframes pop {
            from { transform: translateY(10px) scale(0.98); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .overlay-head {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .checkmark {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.20);
        }

        .checkmark svg {
            width: 22px;
            height: 22px;
            fill: rgba(5, 150, 105, 0.95);
        }

        .overlay-title {
            margin: 0;
            font-weight: 900;
            letter-spacing: -0.2px;
            font-size: 18px;
        }

        .overlay-sub {
            margin: 6px 0 0;
            color: rgba(15, 23, 42, 0.70);
            font-size: 13px;
            line-height: 1.5;
        }

        .overlay-actions {
            margin-top: 14px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
            flex-wrap: wrap;
        }

        .overlay-actions a,
        .overlay-actions button {
            height: 40px;
            border-radius: 12px;
            padding: 0 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>
<body>
    @if (session('registered'))
        <div class="overlay" data-overlay>
            <div class="overlay-card">
                <div class="overlay-head">
                    <span class="checkmark" aria-hidden="true">
                        <svg viewBox="0 0 24 24">
                            <path d="M9 16.2 4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4z"/>
                        </svg>
                    </span>
                    <div>
                        <p class="overlay-title">Berhasil terdaftar</p>
                        <p class="overlay-sub">
                            Akun dengan NIM <strong>{{ session('registered_nim') }}</strong> sudah dibuat.
                            Silakan tunggu verifikasi admin sebelum bisa login.
                        </p>
                    </div>
                </div>

                <div class="overlay-actions">
                    <a class="btn-secondary" href="{{ route('mahasiswa.login') }}">Ke Login</a>
                    <button type="button" data-overlay-close>OK</button>
                </div>
            </div>
        </div>
    @endif

    <main class="page">
        <div class="split">
            <div class="card">
                <div class="head">
                    <img class="logo" src="{{ asset('image/elibrary.png') }}" alt="E-Library">
                    <strong>Daftar Mahasiswa</strong>
                    <span>Buat akun untuk masuk ke Neo E-Library Universitas Malikussaleh.</span>
                </div>

                @if ($errors->any())
                    <div class="errors">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('mahasiswa.register.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="grid">
                        <div class="field">
                            <label for="nama">Nama</label>
                            <input id="nama" name="nama" value="{{ old('nama') }}" required autofocus>
                        </div>

                        <div class="field">
                            <label for="nim">NIM</label>
                            <input id="nim" name="nim" value="{{ old('nim') }}" required>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="field">
                            <label for="umur">Umur</label>
                            <input id="umur" type="number" name="umur" value="{{ old('umur') }}" required min="1" max="150">
                        </div>

                        <div class="field">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="" disabled @selected(old('jenis_kelamin') === null)>Pilih...</option>
                                <option value="L" @selected(old('jenis_kelamin') === 'L')>Laki-laki</option>
                                <option value="P" @selected(old('jenis_kelamin') === 'P')>Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="field">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                        </div>

                        <div class="field">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input id="tanggal_lahir" type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required>
                        </div>
                    </div>

                    <div class="grid">
                        <div class="field">
                            <label for="nomor_hp">Nomor HP</label>
                            <input id="nomor_hp" name="nomor_hp" value="{{ old('nomor_hp') }}" required>
                        </div>

                        <div class="field">
                            <label for="email">Email</label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="field">
                        <label for="alamat">Alamat</label>
                        <textarea id="alamat" name="alamat" required>{{ old('alamat') }}</textarea>
                    </div>

                    <div class="field">
                        <label for="foto">Foto</label>
                        <input id="foto" type="file" name="foto" accept="image/*">
                    </div>

                    <div class="grid">
                        <div class="field">
                            <label for="password">Password</label>
                            <input id="password" type="password" name="password" required>
                        </div>

                        <div class="field">
                            <label for="password_confirmation">Konfirmasi Password</label>
                            <input id="password_confirmation" type="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="actions">
                        <button type="submit">Daftar</button>
                    </div>
                </form>

                <div class="links">
                    <a href="{{ url('/') }}">Kembali</a>
                    <a href="{{ route('mahasiswa.login') }}">Sudah punya akun? Login</a>
                </div>
            </div>

            <div class="card">
                <div class="head" style="text-align: left;">
                    <strong style="font-size: 18px;">Cek Verifikasi</strong>
                    <span>Masukkan NIM untuk melihat status akun kamu.</span>
                </div>

                <div class="field" style="margin-top: 0;">
                    <label for="cek_nim">NIM</label>
                    <div class="check-row">
                        <input id="cek_nim" value="">
                        <button class="check-btn" type="button" data-cek-verifikasi aria-label="Cek verifikasi">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M10 2a8 8 0 1 0 5.29 14.06l4.32 4.32 1.41-1.41-4.32-4.32A8 8 0 0 0 10 2Zm0 2a6 6 0 1 1-6 6 6 6 0 0 1 6-6Z"/>
                            </svg>
                        </button>
                    </div>
                    <div class="check-result" data-cek-result></div>
                </div>
            </div>
        </div>
    </main>

    <script>
        (function () {
            var nimInput = document.getElementById('cek_nim');
            var cekBtn = document.querySelector('[data-cek-verifikasi]');
            var resultEl = document.querySelector('[data-cek-result]');

            if (!nimInput || !cekBtn || !resultEl) return;

            var setResult = function (type, html) {
                resultEl.innerHTML = html;
                if (type === 'ok') {
                    resultEl.innerHTML = '<div class="ok">' + html + '</div>';
                    return;
                }
                if (type === 'info') {
                    resultEl.innerHTML = '<div class="info">' + html + '</div>';
                    return;
                }
                if (type === 'error') {
                    resultEl.innerHTML = '<div class="errors">' + html + '</div>';
                    return;
                }
                resultEl.innerHTML = '';
            };

            cekBtn.addEventListener('click', function () {
                var nim = (nimInput.value || '').trim();
                if (!nim) {
                    setResult('error', 'Masukkan NIM untuk cek verifikasi.');
                    return;
                }

                setResult('info', 'Mengecek status verifikasi...');

                var url = '{{ route('mahasiswa.register.cek') }}' + '?nim=' + encodeURIComponent(nim) + '&_ts=' + String(Date.now());
                fetch(url, { cache: 'no-store', headers: { 'Accept': 'application/json' } })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        if (!data || data.found === false) {
                            setResult('error', 'NIM <strong>' + nim + '</strong> belum terdaftar.');
                            return;
                        }

                        if (data.verifikasi === 'terdaftar') {
                            setResult('ok', 'Akun dengan NIM <strong>' + nim + '</strong> sudah <strong>diverifikasi</strong>. Silakan login.');
                            return;
                        }

                        setResult('info', 'Akun dengan NIM <strong>' + nim + '</strong> sudah terdaftar, status: <strong>menunggu verifikasi admin</strong>.');
                    })
                    .catch(function () {
                        setResult('error', 'Gagal cek verifikasi. Coba lagi.');
                    });
            });
        })();
    </script>

    @if (session('registered'))
        <script>
            (function () {
                var overlay = document.querySelector('[data-overlay]');
                if (!overlay) return;
                var closeBtn = document.querySelector('[data-overlay-close]');
                var close = function () { overlay.classList.add('hidden'); };
                if (closeBtn) closeBtn.addEventListener('click', close);
                overlay.addEventListener('click', function (e) {
                    if (e.target === overlay) close();
                });
                window.setTimeout(close, 3200);
            })();
        </script>
    @endif
</body>
</html>
