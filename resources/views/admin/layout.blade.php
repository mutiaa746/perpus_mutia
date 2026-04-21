<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Panel - Neo E-Library')</title>
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
        }

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

        .status {
            border: 1px solid rgba(16, 185, 129, 0.22);
            background: rgba(16, 185, 129, 0.08);
            border-radius: 14px;
            padding: 12px 12px;
            margin: 0 0 12px;
            color: #065f46;
        }

        .errors {
            border: 1px solid rgba(239, 68, 68, 0.22);
            background: rgba(239, 68, 68, 0.08);
            border-radius: 14px;
            padding: 12px 12px;
            margin: 0 0 12px;
            color: #7f1d1d;
        }

        .errors ul { margin: 0; padding-left: 18px; }

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

        .btn {
            height: 34px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: #ffffff;
            color: rgba(15, 23, 42, 0.84);
            padding: 0 12px;
            font-weight: 800;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn.primary {
            border: 0;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
            color: #ffffff;
        }

        .btn.danger {
            border: 1px solid rgba(239, 68, 68, 0.20);
            background: rgba(239, 68, 68, 0.08);
            color: rgba(127, 29, 29, 0.92);
        }

        .actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        .field { margin-top: 12px; }

        label {
            display: block;
            font-size: 13px;
            color: rgba(15, 23, 42, 0.86);
            margin-bottom: 6px;
        }

        input, textarea, select {
            width: 100%;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: rgba(15, 23, 42, 0.92);
            padding: 10px 12px;
            outline: none;
            font-size: 14px;
        }

        input { height: 44px; }
        textarea { min-height: 110px; resize: vertical; }

        input:focus, textarea:focus, select:focus {
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .muted {
            margin-top: 6px;
            font-size: 12px;
            color: var(--muted);
            line-height: 1.5;
        }

        .thumb {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            border: 1px solid rgba(15, 23, 42, 0.10);
            background: rgba(15, 23, 42, 0.04);
            object-fit: cover;
        }

        .pagination {
            display: flex;
            justify-content: flex-end;
            margin-top: 12px;
        }

        @media (max-width: 980px) {
            .layout { grid-template-columns: 1fr; }
            .sidebar { position: sticky; top: 0; z-index: 20; }
            .search { min-width: 0; width: 100%; }
            .topbar { flex-wrap: wrap; }
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
                <a class="{{ ($active ?? '') === 'dashboard' ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 10.5 12 3l9 7.5V21a1 1 0 0 1-1 1h-6v-7H10v7H4a1 1 0 0 1-1-1V10.5Z"/>
                        </svg>
                    </span>
                    Dashboard
                </a>
                <a class="{{ ($active ?? '') === 'categories' ? 'active' : '' }}" href="{{ route('admin.categories.index') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M4 4h7v7H4V4Zm9 0h7v7h-7V4ZM4 13h7v7H4v-7Zm9 0h7v7h-7v-7Z"/>
                        </svg>
                    </span>
                    Kategori Buku
                </a>
                <a class="{{ ($active ?? '') === 'books' ? 'active' : '' }}" href="{{ route('admin.books.index') }}">
                    <span class="ico">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6 3h9a3 3 0 0 1 3 3v13a2 2 0 0 1-2 2H7a3 3 0 0 0-3 3V5a2 2 0 0 1 2-2Zm1 4v12h9V7H7Z"/>
                        </svg>
                    </span>
                    Data Buku
                </a>
                <a class="{{ ($active ?? '') === 'borrowings' ? 'active' : '' }}" href="{{ route('admin.borrowings.index') }}">
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
                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>
