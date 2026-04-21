<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Neo E-Library</title>
    <style>
        :root {
            --bg: #f4f6fb;
            --card: #ffffff;
            --text: #0f172a;
            --muted: #64748b;
            --stroke: rgba(15, 23, 42, 0.12);
            --primary: #2563eb;
            --danger: #ef4444;
            --shadow: 0 18px 50px rgba(15, 23, 42, 0.10);
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
        }

        a { color: inherit; text-decoration: none; }

        .layout {
            min-height: 100%;
            display: grid;
            grid-template-columns: 260px 1fr;
        }

        .sidebar {
            padding: 18px 14px;
            background: var(--card);
            border-right: 1px solid rgba(15, 23, 42, 0.08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 10px;
            border-radius: 14px;
        }

        .brand img {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            background: #ffffff;
            padding: 6px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            object-fit: contain;
        }

        .brand strong { display: block; font-size: 14px; }
        .brand span { display: block; font-size: 12px; color: var(--muted); margin-top: 2px; }

        .nav {
            margin-top: 14px;
            display: grid;
            gap: 6px;
        }

        .nav a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 12px;
            color: rgba(15, 23, 42, 0.86);
            border: 1px solid transparent;
        }

        .nav a:hover {
            background: rgba(37, 99, 235, 0.06);
            border-color: rgba(37, 99, 235, 0.14);
        }

        .nav a.active {
            background: rgba(37, 99, 235, 0.10);
            border-color: rgba(37, 99, 235, 0.18);
            color: rgba(15, 23, 42, 0.95);
        }

        .ico {
            width: 18px;
            height: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .ico svg { width: 18px; height: 18px; fill: rgba(15, 23, 42, 0.72); }
        .nav a.active .ico svg { fill: rgba(37, 99, 235, 0.92); }

        .sidebar-bottom {
            margin-top: 18px;
            padding: 12px 10px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
        }

        .logout {
            width: 100%;
            height: 40px;
            border-radius: 12px;
            border: 1px solid rgba(239, 68, 68, 0.20);
            background: rgba(239, 68, 68, 0.08);
            color: rgba(127, 29, 29, 0.92);
            font-weight: 800;
            cursor: pointer;
        }

        .main {
            padding: 18px 18px;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            padding: 12px 14px;
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: rgba(255, 255, 255, 0.75);
            border-radius: 16px;
            backdrop-filter: blur(10px);
        }

        .search {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #ffffff;
            border-radius: 12px;
            min-width: min(520px, 100%);
        }

        .search svg { width: 18px; height: 18px; fill: rgba(15, 23, 42, 0.55); }
        .search input {
            border: 0;
            outline: none;
            width: 100%;
            font-size: 14px;
            color: rgba(15, 23, 42, 0.92);
        }

        .top-right {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            font-size: 12px;
            color: rgba(15, 23, 42, 0.72);
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #ffffff;
            padding: 8px 10px;
            border-radius: 999px;
        }

        .admin {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 6px 10px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #ffffff;
            border-radius: 999px;
        }

        .avatar {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: rgba(37, 99, 235, 0.10);
        }

        .avatar svg { width: 18px; height: 18px; fill: rgba(37, 99, 235, 0.92); }

        .admin-name {
            font-weight: 800;
            font-size: 14px;
            color: rgba(15, 23, 42, 0.92);
            white-space: nowrap;
        }

        .content {
            margin-top: 14px;
            display: grid;
            gap: 14px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .stat {
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: var(--card);
            border-radius: 16px;
            padding: 14px 14px;
            box-shadow: var(--shadow);
        }

        .stat span { display: block; color: var(--muted); font-size: 12px; }
        .stat strong { display: block; margin-top: 8px; font-size: 22px; letter-spacing: -0.3px; }

        .panel {
            border: 1px solid rgba(15, 23, 42, 0.08);
            background: var(--card);
            border-radius: 16px;
            padding: 14px 14px;
            box-shadow: var(--shadow);
        }

        .panel-head {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 10px;
        }

        .panel-head h1 {
            margin: 0;
            font-size: 18px;
            letter-spacing: -0.2px;
        }

        .tabs {
            display: inline-flex;
            gap: 8px;
            padding: 6px;
            background: rgba(15, 23, 42, 0.04);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 999px;
        }

        .tab {
            font-size: 12px;
            padding: 8px 10px;
            border-radius: 999px;
            color: rgba(15, 23, 42, 0.72);
            background: transparent;
        }

        .tab.active {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.10);
            color: rgba(15, 23, 42, 0.92);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 13px;
        }

        th, td {
            text-align: left;
            padding: 12px 10px;
            border-top: 1px solid rgba(15, 23, 42, 0.08);
            color: rgba(15, 23, 42, 0.88);
            vertical-align: middle;
        }

        th {
            color: rgba(15, 23, 42, 0.60);
            font-weight: 800;
            font-size: 12px;
        }

        .tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: rgba(15, 23, 42, 0.04);
            color: rgba(15, 23, 42, 0.72);
            white-space: nowrap;
        }

        .tag.ok {
            border-color: rgba(16, 185, 129, 0.18);
            background: rgba(16, 185, 129, 0.08);
            color: rgba(6, 95, 70, 0.92);
        }

        .tag.no {
            border-color: rgba(245, 158, 11, 0.18);
            background: rgba(245, 158, 11, 0.08);
            color: rgba(146, 64, 14, 0.92);
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .btn {
            height: 34px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #ffffff;
            color: rgba(15, 23, 42, 0.84);
            padding: 0 12px;
            font-weight: 800;
            cursor: pointer;
        }

        .btn.primary {
            border: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
            color: #ffffff;
        }

        @media (max-width: 980px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { position: sticky; top: 0; z-index: 20; }
            .search { min-width: 0; width: 100%; }
            .topbar { flex-wrap: wrap; }
            .grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="layout">
        <aside class="sidebar">
            <a class="brand" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('image/elibrary.png') }}" alt="E-Library">
                <div>
                    <strong>Neo E-Library</strong>
                    <span>Admin Panel</span>
                </div>
            </a>

            <nav class="nav" aria-label="Menu admin">
                <a class="active" href="{{ route('admin.dashboard') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-6v-7H10v7H4a1 1 0 0 1-1-1V10.5Z"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z"/>
                        </svg>
                    </span>
                    Kategori Buku
                </a>
                <a href="{{ route('admin.books.index') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 4h16v2H4V4Zm0 14h16v2H4v-2Zm0-7h16v2H4v-2Z"/>
                        </svg>
                    </span>
                    Data Buku
                </a>
                <a href="{{ route('admin.borrowings.index') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M7 18a2 2 0 0 1-2-2V5h14v11a2 2 0 0 1-2 2H7Zm12-15H5a2 2 0 0 0-2 2v11a4 4 0 0 0 4 4h10a4 4 0 0 0 4-4V5a2 2 0 0 0-2-2Z"/>
                            <path d="M7 8h10v2H7V8Zm0 4h10v2H7v-2Z"/>
                        </svg>
                    </span>
                    Peminjaman
                </a>
            </nav>

            <div class="sidebar-bottom">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout" type="submit">Logout</button>
                </form>
            </div>
        </aside>

        <main class="main">
            <div class="topbar">
                <div class="search" role="search">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M10 2a8 8 0 1 0 5.29 14.06l4.32 4.32 1.41-1.41-4.32-4.32A8 8 0 0 0 10 2Zm0 2a6 6 0 1 1-6 6 6 6 0 0 1 6-6Z"/>
                    </svg>
                    <input placeholder="Search..." aria-label="Search" />
                </div>

                <div class="top-right">
                    <div class="badge">Online</div>
                    <div class="admin">
                        <span class="avatar" aria-hidden="true">
                            <svg viewBox="0 0 24 24">
                                <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5c0-2.5-3.58-4.5-8-4.5Z"/>
                            </svg>
                        </span>
                        <span class="admin-name">{{ auth('admin')->user()->nama_admin }}</span>
                    </div>
                </div>
            </div>

            <div class="content">
                <div class="grid">
                    <div class="stat">
                        <span>Total Users</span>
                        <strong>{{ $totalUsers }}</strong>
                    </div>
                    <div class="stat">
                        <span>Total Mahasiswa</span>
                        <strong>{{ $totalMahasiswa }}</strong>
                    </div>
                    <div class="stat">
                        <span>Total Admin</span>
                        <strong>{{ $totalAdmin }}</strong>
                    </div>
                    <div class="stat">
                        <span>Peminjaman Pending</span>
                        <strong>{{ $pendingBorrowings }}</strong>
                        <div class="actions" style="margin-top: 10px; justify-content: flex-start;">
                            <a class="btn" href="{{ route('admin.borrowings.index', ['status' => 'pending']) }}">Lihat</a>
                        </div>
                    </div>
                </div>

                <section class="panel">
                    <div class="panel-head">
                        <h1>Mahasiswa Terbaru</h1>
                        <div class="tabs" aria-label="Tabs">
                            <span class="tab active">All</span>
                            <span class="tab">Verified</span>
                            <span class="tab">Unverified</span>
                        </div>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>NIM</th>
                                <th>Email</th>
                                <th>Verifikasi</th>
                                <th>Dibuat</th>
                                <th style="text-align:right;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($latestMahasiswa as $mhs)
                                <tr>
                                    <td>#{{ $mhs->id }}</td>
                                    <td>{{ $mhs->nama }}</td>
                                    <td>{{ $mhs->nim }}</td>
                                    <td>{{ $mhs->email }}</td>
                                    <td>
                                        @if ($mhs->verifikasi === 'terdaftar')
                                            <span class="tag ok">Terdaftar</span>
                                        @else
                                            <span class="tag no">Belum Terdaftar</span>
                                        @endif
                                    </td>
                                    <td>{{ \Illuminate\Support\Carbon::parse($mhs->created_at)->format('d-m-Y H:i') }}</td>
                                    <td style="text-align:right;">
                                        <div class="actions">
                                            <a class="btn" href="{{ route('admin.peminjams.show', $mhs) }}">Detail</a>
                                            <form method="POST" action="{{ route('admin.peminjams.destroy', $mhs) }}" onsubmit="return confirm('Hapus mahasiswa {{ $mhs->nama }} ({{ $mhs->nim }})?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn danger" type="submit">Hapus</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="color: rgba(15, 23, 42, 0.60);">Belum ada data mahasiswa.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </section>
            </div>
        </main>
    </div>
</body>
</html>
