<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Peminjaman</title>
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

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 18px 16px 28px;
        }

        .chip {
            display: inline-flex;
            align-items: center;
            font-size: 12px;
            padding: 6px 10px;
            border: 1px solid rgba(15, 23, 42, 0.14);
            color: rgba(15, 23, 42, 0.82);
        }

        .chip.pending { border-color: rgba(245, 158, 11, 0.35); color: #92400e; }
        .chip.approved { border-color: rgba(16, 185, 129, 0.35); color: #065f46; }
        .chip.returned { border-color: rgba(15, 23, 42, 0.18); color: rgba(15, 23, 42, 0.78); }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th, td {
            text-align: left;
            padding: 12px 0;
            border-bottom: 1px solid rgba(15, 23, 42, 0.10);
            vertical-align: top;
        }

        th {
            color: rgba(15, 23, 42, 0.60);
            font-weight: 900;
            font-size: 12px;
            width: 220px;
        }

        .muted { color: rgba(15, 23, 42, 0.66); font-size: 12px; }
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
            <div class="title">Detail Peminjaman #{{ $borrowing->borrow_id }}</div>
            <div class="spacer"></div>
            <a class="icon-btn" href="{{ route('mahasiswa.cart.show') }}" aria-label="Keranjang" title="Keranjang">
                <svg viewBox="0 0 24 24" aria-hidden="true">
                    <path d="M6 6h15l-1.5 9h-12L6 6Z"></path>
                    <path d="M6 6 5 3H2"></path>
                    <circle cx="9" cy="20" r="1"></circle>
                    <circle cx="18" cy="20" r="1"></circle>
                </svg>
            </a>
        </div>
    </header>

    <main class="container">
        <table>
            <tbody>
                <tr>
                    <th>Status</th>
                    <td><span class="chip {{ $borrowing->status }}">{{ strtoupper($borrowing->status) }}</span></td>
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
                    <th>Catatan Admin</th>
                    <td style="white-space: pre-wrap;">{{ $borrowing->note ?? '-' }}</td>
                </tr>
            </tbody>
        </table>

        <div style="margin-top: 14px; font-weight: 900; letter-spacing: -0.2px;">Daftar Buku</div>
        <div class="muted" style="margin-top: 6px;">Berikut buku yang kamu ajukan pada peminjaman ini.</div>

        <table style="margin-top: 10px;">
            <thead>
                <tr>
                    <th style="width: auto;">Judul Buku</th>
                    <th style="width: 120px;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($borrowing->items as $item)
                    <tr>
                        <td>{{ $item->book?->title ?? '-' }}</td>
                        <td>{{ $item->quantity }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="muted">Tidak ada item.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </main>
</body>
</html>
