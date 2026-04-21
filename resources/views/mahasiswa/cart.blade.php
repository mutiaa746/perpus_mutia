<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Keranjang Peminjaman</title>
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
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            background: var(--bg);
            color: var(--text);
        }

        a { color: inherit; text-decoration: none; }

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

        .title {
            font-weight: 900;
            letter-spacing: -0.2px;
            font-size: 15px;
        }

        .spacer { flex: 1; }

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

        .icon-btn svg {
            width: 20px;
            height: 20px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .icon-btn:hover { color: var(--primary); }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 18px 16px 28px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            text-align: left;
            padding: 10px 0;
            border-bottom: 1px solid rgba(15, 23, 42, 0.10);
            font-size: 13px;
        }

        th { color: rgba(15, 23, 42, 0.82); font-weight: 900; }
        td { color: rgba(15, 23, 42, 0.84); }

        .muted { color: rgba(15, 23, 42, 0.64); font-size: 12px; }

        .qty {
            width: 70px;
            height: 34px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            padding: 0 10px;
        }

        .btn {
            height: 34px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            cursor: pointer;
            color: rgba(15, 23, 42, 0.88);
            font-weight: 800;
            font-size: 12px;
        }

        .btn-primary {
            border: 0;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
        }

        .btn-danger {
            border-color: rgba(239, 68, 68, 0.25);
            color: rgba(127, 29, 29, 0.92);
            background: rgba(239, 68, 68, 0.06);
        }

        .actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <header class="topbar">
        <div class="topbar-inner">
            <a class="icon-btn" href="{{ route('catalog.index') }}" aria-label="Kembali" title="Kembali">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="title">Keranjang Peminjaman</div>
            <div class="spacer"></div>
            <a class="icon-btn" href="{{ route('mahasiswa.profile.edit') }}" aria-label="Profil" title="Profil">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <circle cx="12" cy="8" r="4"></circle>
                    <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"></path>
                </svg>
            </a>
        </div>
    </header>

    <main class="container">
        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        @if ($items->count() === 0)
            <div class="muted">Keranjang masih kosong. Tambahkan buku dari katalog.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Buku</th>
                        <th style="width: 120px;">Jumlah</th>
                        <th style="width: 170px; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>
                                <div style="font-weight: 900;">{{ $item->book?->title ?? '-' }}</div>
                                <div class="muted">Stok: {{ $item->book?->stock ?? 0 }}</div>
                            </td>
                            <td>
                                <form method="POST" action="{{ route('mahasiswa.cart.item.update', $item) }}">
                                    @csrf
                                    @method('PATCH')
                                    <input class="qty" type="number" name="quantity" min="1" value="{{ $item->quantity }}" required>
                                    <button class="btn" type="submit">Update</button>
                                </form>
                            </td>
                            <td style="text-align: right;">
                                <form method="POST" action="{{ route('mahasiswa.cart.item.remove', $item) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="actions">
                <form method="POST" action="{{ route('mahasiswa.cart.checkout') }}">
                    @csrf
                    <button class="btn btn-primary" type="submit">Ajukan Peminjaman</button>
                </form>
            </div>
        @endif
    </main>
</body>
</html>

