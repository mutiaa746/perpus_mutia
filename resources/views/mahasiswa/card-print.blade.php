<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak Kartu Mahasiswa</title>
    <style>
        :root {
            --text: #0f172a;
            --muted: #475569;
            --stroke: rgba(15, 23, 42, 0.18);
            --primary: #2563eb;
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial;
            color: var(--text);
            background: #ffffff;
        }

        .wrap {
            padding: 18px 16px;
        }

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

        .sheet {
            display: grid;
            grid-template-columns: repeat(2, max-content);
            gap: 18px;
            align-items: start;
            justify-content: start;
        }

        .card {
            width: 86mm;
            height: 54mm;
            border: 1px solid var(--stroke);
            padding: 8mm 8mm;
            display: grid;
            grid-template-rows: auto 1fr auto;
        }

        .head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .brand img {
            width: 22px;
            height: 22px;
            object-fit: contain;
        }

        .brand strong {
            display: block;
            font-size: 10px;
            letter-spacing: 0.2px;
        }

        .brand span {
            display: block;
            font-size: 8px;
            color: var(--muted);
            margin-top: 2px;
        }

        .type {
            font-size: 8px;
            border: 1px solid rgba(37, 99, 235, 0.35);
            color: rgba(29, 78, 216, 0.95);
            padding: 4px 6px;
        }

        .body {
            margin-top: 8px;
            display: grid;
            grid-template-columns: 1fr 20mm;
            gap: 8px;
            align-items: start;
        }

        .field {
            display: grid;
            grid-template-columns: 46px 1fr;
            gap: 6px;
            font-size: 8.5px;
            line-height: 1.35;
            margin-top: 4px;
        }

        .label { color: var(--muted); }

        .photo {
            width: 20mm;
            height: 26mm;
            border: 1px solid var(--stroke);
            object-fit: cover;
        }

        .photo-fallback {
            width: 20mm;
            height: 26mm;
            border: 1px solid var(--stroke);
            display: grid;
            place-items: center;
            font-size: 8px;
            color: var(--muted);
        }

        .foot {
            margin-top: 6px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            font-size: 8px;
            color: var(--muted);
        }

        .sign {
            width: 26mm;
            border-top: 1px solid rgba(15, 23, 42, 0.18);
            padding-top: 2px;
            text-align: center;
            font-size: 7px;
            color: rgba(15, 23, 42, 0.72);
        }

        .back-title {
            font-weight: 900;
            font-size: 9px;
            letter-spacing: 0.2px;
        }

        .back-list {
            margin-top: 8px;
            display: grid;
            gap: 6px;
            font-size: 8.5px;
            color: rgba(15, 23, 42, 0.82);
            line-height: 1.35;
        }

        .back-list span {
            color: var(--muted);
        }

        .back-note {
            margin-top: 8px;
            font-size: 8px;
            color: var(--muted);
            line-height: 1.45;
        }

        @media print {
            @page { margin: 10mm; }
            body { background: #ffffff; }
            .actions { display: none; }
            .wrap { padding: 0; }
        }
    </style>
</head>
<body>
    @php
        $fotoSrc = null;
        if (! empty($user->foto)) {
            $fotoSrc = str_starts_with($user->foto, 'uploads/') ? asset($user->foto) : asset('storage/' . $user->foto);
        }
    @endphp

    <div class="wrap">
        <div class="actions">
           
            <button class="btn btn-primary" type="button" onclick="window.print()">Print</button>
        </div>

        <div class="sheet" aria-label="Kartu mahasiswa">
            <section class="card" aria-label="Kartu depan">
                <div class="head">
                    <div class="brand">
                        <img src="{{ asset('image/elibrary.png') }}" alt="Logo">
                        <div>
                            <strong>KARTU TANDA MAHASISWA</strong>
                            <span>Universitas Malikussaleh</span>
                        </div>
                    </div>
                    <span class="type">Neo E-Library</span>
                </div>

                <div class="body">
                    <div>
                        <div class="field">
                            <div class="label">Nama</div>
                            <div>{{ $user->nama }}</div>
                        </div>
                        <div class="field">
                            <div class="label">NIM</div>
                            <div>{{ $user->nim }}</div>
                        </div>
                        <div class="field">
                            <div class="label">Lahir</div>
                            <div>{{ $user->tempat_lahir }}, {{ optional($user->tanggal_lahir)->format('d-m-Y') }}</div>
                        </div>
                        <div class="field">
                            <div class="label">JK</div>
                            <div>{{ $user->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</div>
                        </div>
                    </div>
                    <div>
                        @if ($fotoSrc)
                            <img class="photo" src="{{ $fotoSrc }}" alt="Foto">
                        @else
                            <div class="photo-fallback">FOTO</div>
                        @endif
                    </div>
                </div>

                <div class="foot">
                    <div>{{ $user->verifikasi === 'terdaftar' ? 'Terverifikasi' : 'Menunggu Verifikasi' }}</div>
                    <div class="sign">Tanda Tangan</div>
                </div>
            </section>

            <section class="card" aria-label="Kartu belakang">
                <div class="head">
                    <div class="brand">
                        <img src="{{ asset('image/elibrary.png') }}" alt="Logo">
                        <div>
                            <strong class="back-title">INFORMASI MAHASISWA</strong>
                            <span>Neo E-Library</span>
                        </div>
                    </div>
                </div>

                <div class="back-list">
                    <div><span>Email:</span> {{ $user->email }}</div>
                    <div><span>Nomor HP:</span> {{ $user->nomor_hp }}</div>
                    <div><span>Alamat:</span> {{ $user->alamat }}</div>
                </div>

                <div class="back-note">
                    Kartu ini merupakan identitas mahasiswa pada sistem Neo E-Library. Jika kartu hilang, segera laporkan ke admin.
                </div>
            </section>
        </div>
    </div>

    <script>
        window.setTimeout(function () {
            window.print();
        }, 200);
    </script>
</body>
</html>
