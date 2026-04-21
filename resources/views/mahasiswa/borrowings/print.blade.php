<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Kartu Peminjaman</title>
    <style>
        :root {
            --text: #0f172a;
            --muted: #475569;
            --stroke: rgba(15, 23, 42, 0.18);
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            color: var(--text);
            background: #ffffff;
        }

        .wrap { padding: 18px 16px; }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 12px;
        }

        .btn {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            cursor: pointer;
            font-weight: 800;
            color: rgba(15, 23, 42, 0.88);
        }

        .btn-primary {
            border: 0;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
        }

        .paper {
            width: 210mm;
            min-height: 297mm;
            padding: 14mm 14mm;
            border: 1px solid var(--stroke);
        }

        .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(15, 23, 42, 0.12);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
        }

        .brand strong {
            display: block;
            font-size: 14px;
            letter-spacing: 0.2px;
        }

        .brand span {
            display: block;
            margin-top: 2px;
            font-size: 12px;
            color: var(--muted);
        }

        .doc-meta {
            text-align: right;
            font-size: 12px;
            color: rgba(15, 23, 42, 0.82);
        }

        .doc-meta div { margin-top: 4px; }

        .section-title {
            margin: 14px 0 8px;
            font-weight: 900;
            font-size: 13px;
            letter-spacing: -0.1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th, td {
            text-align: left;
            padding: 10px 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            vertical-align: top;
        }

        th {
            background: rgba(15, 23, 42, 0.03);
            font-weight: 900;
        }

        .info-grid {
            margin-top: 10px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .box {
            border: 1px solid rgba(15, 23, 42, 0.16);
            padding: 10px 10px;
        }

        .row {
            display: grid;
            grid-template-columns: 120px 1fr;
            gap: 8px;
            padding: 4px 0;
            font-size: 12px;
        }

        .label { color: var(--muted); }

        .note {
            margin-top: 12px;
            border: 1px solid rgba(245, 158, 11, 0.28);
            padding: 10px 10px;
            font-size: 12px;
            color: rgba(120, 53, 15, 0.95);
            line-height: 1.55;
        }

        .signatures {
            margin-top: 18px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .sign {
            border: 1px solid rgba(15, 23, 42, 0.16);
            padding: 12px 12px;
            height: 46mm;
            display: grid;
            align-content: space-between;
        }

        .sign .who {
            font-size: 12px;
            font-weight: 900;
        }

        .sign .line {
            border-top: 1px solid rgba(15, 23, 42, 0.20);
            padding-top: 6px;
            font-size: 12px;
            color: rgba(15, 23, 42, 0.78);
        }

        @media print {
            @page { size: A4; margin: 10mm; }
            .actions { display: none; }
            .wrap { padding: 0; }
            .paper { border: 0; width: auto; min-height: auto; padding: 0; }
        }
    </style>
</head>
<body>
    <div class="wrap">
        <div class="actions">
            <button class="btn" type="button" onclick="history.back()">Kembali</button>
            <button class="btn btn-primary" type="button" onclick="window.print()">Print</button>
        </div>

        <div class="paper" aria-label="Kartu Peminjaman">
            <div class="head">
                <div class="brand">
                    <img src="{{ asset('image/elibrary.png') }}" alt="Logo">
                    <div>
                        <strong>KARTU PEMINJAMAN BUKU</strong>
                        <span>Neo E-Library - Universitas Malikussaleh</span>
                    </div>
                </div>
                <div class="doc-meta">
                    <div>No: #{{ $borrowing->borrow_id }}</div>
                    <div>Tanggal Ajukan: {{ optional($borrowing->borrow_date)->format('d-m-Y H:i') }}</div>
                    <div>Status: {{ strtoupper($borrowing->status) }}</div>
                </div>
            </div>

            <div class="info-grid">
                <div class="box">
                    <div class="section-title">Data Mahasiswa</div>
                    <div class="row"><div class="label">Nama</div><div>{{ $user->nama }}</div></div>
                    <div class="row"><div class="label">NIM</div><div>{{ $user->nim }}</div></div>
                    <div class="row"><div class="label">Email</div><div>{{ $user->email }}</div></div>
                    <div class="row"><div class="label">Nomor HP</div><div>{{ $user->nomor_hp }}</div></div>
                </div>
                <div class="box">
                    <div class="section-title">Ketentuan</div>
                    <div style="font-size: 12px; color: rgba(15, 23, 42, 0.82); line-height: 1.55;">
                        Tanggal kembali akan ditetapkan oleh admin setelah peminjaman disetujui.
                        Jika melewati tempo pengembalian yang ditetapkan admin, peminjam akan dikenakan denda sesuai ketentuan perpustakaan.
                    </div>
                </div>
            </div>

            <div class="section-title">Daftar Buku yang Diajukan</div>
            <table>
                <thead>
                    <tr>
                        <th style="width: 44px;">No</th>
                        <th>Judul Buku</th>
                        <th style="width: 90px;">Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($borrowing->items as $i => $item)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $item->book?->title ?? '-' }}</td>
                            <td>{{ $item->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="note">
                Dengan mencetak kartu ini, peminjam menyatakan data pengajuan peminjaman adalah benar dan bersedia mematuhi aturan peminjaman, termasuk denda keterlambatan.
            </div>

            <div class="signatures">
                <div class="sign">
                    <div class="who">Tanda Tangan Peminjam</div>
                    <div class="line">{{ $user->nama }} ({{ $user->nim }})</div>
                </div>
                <div class="sign">
                    <div class="who">Tanda Tangan Admin/Petugas</div>
                    <div class="line">(............................................)</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        window.setTimeout(function () {
            window.print();
        }, 200);
    </script>
</body>
</html>

