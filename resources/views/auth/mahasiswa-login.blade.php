<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Mahasiswa - Neo E-Library</title>
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

        .card {
            width: min(440px, 100%);
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

        .errors ul {
            margin: 0;
            padding-left: 18px;
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

        input:focus {
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
    </style>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="head">
                <img class="logo" src="{{ asset('image/elibrary.png') }}" alt="E-Library">
                <strong>Login Mahasiswa</strong>
                <span>Masuk ke Neo E-Library Universitas Malikussaleh.</span>
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

            <form method="POST" action="{{ route('mahasiswa.login.store') }}">
                @csrf

                <div class="field">
                    <label for="nim">NIM</label>
                    <input id="nim" name="nim" value="{{ old('nim') }}" required autofocus>
                </div>

                <div class="field">
                    <label for="password">Password</label>
                    <input id="password" type="password" name="password" required>
                </div>

                <div class="actions">
                    <button type="submit">Login</button>
                </div>
            </form>

            <div class="links">
                <a href="{{ url('/') }}">Kembali</a>
                <a href="{{ route('mahasiswa.register') }}">Daftar</a>
            </div>
        </div>
    </main>
</body>
</html>
