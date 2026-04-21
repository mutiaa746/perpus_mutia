<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Buku - Neo E-Library</title>
    <style>
        :root {
            --bg: #f8fafc;
            --text: #0f172a;
            --muted: #64748b;
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

        .nav {
            position: sticky;
            top: 0;
            z-index: 10;
            border-bottom: 1px solid rgba(15, 23, 42, 0.14);
            background: rgba(248, 250, 252, 0.95);
            backdrop-filter: blur(10px);
        }

        .nav-inner {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            font-weight: 900;
            letter-spacing: 0.2px;
            white-space: nowrap;
        }

        .brand-logo {
            width: 70px;
            object-fit: contain;
            padding: 2px;
        }

        .spacer { flex: 1; }

        .nav-actions {
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .account-menu {
            position: relative;
        }

        .account-trigger {
            list-style: none;
        }

        .account-trigger::-webkit-details-marker {
            display: none;
        }

        .account-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            min-width: 160px;
            border: 1px solid rgba(15, 23, 42, 0.14);
            background: #ffffff;
            padding: 6px;
            z-index: 20;
        }

        .account-item {
            width: 100%;
            height: 34px;
            border: 0;
            background: transparent;
            color: rgba(15, 23, 42, 0.84);
            display: inline-flex;
            align-items: center;
            justify-content: flex-start;
            padding: 0 8px;
            font-size: 13px;
            cursor: pointer;
        }

        .account-item:hover {
            color: var(--primary);
        }

        .icon-btn {
            width: 34px;
            height: 34px;
            border: 0;
            background: transparent;
            color: rgba(15, 23, 42, 0.82);
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
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

        .icon-btn:hover {
            color: var(--primary);
        }

        .toast-overlay {
            position: fixed;
            inset: 0;
            z-index: 60;
            background: rgba(15, 23, 42, 0.45);
            backdrop-filter: blur(6px);
            display: grid;
            place-items: center;
            padding: 18px;
        }

        .toast-card {
            width: min(520px, 100%);
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.14);
            padding: 16px 16px;
            animation: toast-pop 200ms ease-out;
        }

        @keyframes toast-pop {
            from { transform: translateY(10px) scale(0.98); opacity: 0; }
            to { transform: translateY(0) scale(1); opacity: 1; }
        }

        .toast-title {
            margin: 0;
            font-weight: 900;
            letter-spacing: -0.2px;
            font-size: 15px;
            color: rgba(15, 23, 42, 0.92);
        }

        .toast-text {
            margin: 10px 0 0;
            color: rgba(15, 23, 42, 0.72);
            font-size: 13px;
            line-height: 1.55;
        }

        .toast-actions {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .nav-menu {
            position: relative;
        }

        .nav-trigger {
            list-style: none;
        }

        .nav-trigger::-webkit-details-marker {
            display: none;
        }

        .nav-dropdown {
            position: absolute;
            top: calc(100% + 8px);
            right: 0;
            width: min(320px, calc(100vw - 32px));
            border: 1px solid rgba(15, 23, 42, 0.14);
            background: #ffffff;
            padding: 12px;
            z-index: 20;
        }

        .nav-form {
            display: grid;
            gap: 10px;
        }

        .nav-form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            flex-wrap: wrap;
        }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
            padding: 18px 16px 28px;
        }

        .field label {
            display: block;
            font-size: 13px;
            color: rgba(15, 23, 42, 0.82);
            margin-bottom: 6px;
        }

        input, select {
            width: 100%;
            height: 38px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            color: var(--text);
            padding: 0 12px;
            outline: none;
        }

        input:focus, select:focus {
            border-color: rgba(37, 99, 235, 0.55);
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.12);
        }

        .btn {
            height: 38px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.16);
            background: #ffffff;
            cursor: pointer;
            color: rgba(15, 23, 42, 0.88);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
        }

        .btn-primary {
            border: 0;
            color: #ffffff;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.98), rgba(14, 165, 233, 0.98));
        }

        .grid {
            margin-top: 14px;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 14px;
        }

        .card {
            overflow: hidden;
            display: grid;
            grid-template-rows: auto 1fr;
            min-height: 220px;
        }

        .cover {
            width: 100%;
            aspect-ratio: 16 / 11;
            object-fit: cover;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.10), rgba(14, 165, 233, 0.10));
        }

        .card-body {
            padding: 8px 0;
            display: grid;
            gap: 8px;
        }

        .title {
            font-weight: 500;
            letter-spacing: -0.1px;
            font-size: 13px;
            line-height: 1.4;
            margin: 0;
        }

        .year {
            color: rgba(15, 23, 42, 0.66);
            font-size: 12px;
            line-height: 0;
            margin: 1px 0 0;
        }

        .card-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }

        .empty {
            margin-top: 14px;
            padding: 0;
            color: rgba(15, 23, 42, 0.70);
        }

        .pagination {
            margin-top: 14px;
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            flex-wrap: wrap;
        }

        .page-link {
            min-width: 38px;
            height: 38px;
            border-radius: 8px;
            border: 1px solid rgba(15, 23, 42, 0.14);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: rgba(15, 23, 42, 0.80);
            padding: 0 12px;
        }

        .page-link.active {
            border-color: var(--primary);
            color: var(--primary);
        }

        .page-link.disabled {
            opacity: 0.45;
            pointer-events: none;
        }

        @media (max-width: 980px) {
            .grid { grid-template-columns: repeat(2, 1fr); }
            .pagination { justify-content: flex-start; }
        }

        @media (max-width: 520px) {
            .grid { grid-template-columns: repeat(2, 1fr); }
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="nav-inner">
            <a class="brand" href="{{ route('catalog.index') }}">
                <img class="brand-logo" src="{{ asset('image/elibrary.png') }}" alt="E-Library">
                
            </a>
            <div class="spacer"></div>
            <div class="nav-actions">
                <details class="nav-menu" data-menu="search">
                    <summary class="icon-btn nav-trigger" aria-label="Cari" title="Cari">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <circle cx="11" cy="11" r="7"></circle>
                            <path d="M20 20l-3.5-3.5"></path>
                        </svg>
                    </summary>
                    <div class="nav-dropdown">
                        <form class="nav-form" method="GET" action="{{ route('catalog.index') }}">
                            <input type="hidden" name="category_id" value="{{ $categoryId }}">
                            <div class="field" style="margin: 0;">
                                <label for="nav_q">Cari</label>
                                <input id="nav_q" name="q" value="{{ $q }}" placeholder="Judul / penulis / penerbit...">
                            </div>
                            <div class="nav-form-actions">
                                <a class="btn" href="{{ route('catalog.index', ['category_id' => $categoryId]) }}">Reset</a>
                                <button class="btn btn-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </details>

                <details class="nav-menu" data-menu="filter">
                    <summary class="icon-btn nav-trigger" aria-label="Filter" title="Filter">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M3 5h18l-7 8v6l-4 2v-8L3 5Z"></path>
                        </svg>
                    </summary>
                    <div class="nav-dropdown">
                        <form class="nav-form" method="GET" action="{{ route('catalog.index') }}">
                            <input type="hidden" name="q" value="{{ $q }}">
                            <div class="field" style="margin: 0;">
                                <label for="nav_category_id">Kategori</label>
                                <select id="nav_category_id" name="category_id">
                                    <option value="">Semua Kategori</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }}" @selected((string) $categoryId === (string) $category->category_id)>
                                            {{ $category->category_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="nav-form-actions">
                                <a class="btn" href="{{ route('catalog.index', ['q' => $q]) }}">Reset</a>
                                <button class="btn btn-primary" type="submit">Terapkan</button>
                            </div>
                        </form>
                    </div>
                </details>
                @if (auth('admin')->check())
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="icon-btn" type="submit" aria-label="Logout" title="Logout">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <path d="M10 17v-3H3v-4h7V7l5 5-5 5Zm8-14H8a2 2 0 0 0-2 2v3h2V5h10v14H8v-3H6v3a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z"/>
                            </svg>
                        </button>
                    </form>
                @elseif (auth('peminjam')->check())
                    <a class="icon-btn" href="{{ route('mahasiswa.cart.show') }}" aria-label="Keranjang" title="Keranjang">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6 6h15l-1.5 9h-12L6 6Z"></path>
                            <path d="M6 6 5 3H2"></path>
                            <circle cx="9" cy="20" r="1"></circle>
                            <circle cx="18" cy="20" r="1"></circle>
                        </svg>
                    </a>
                    <a class="icon-btn" href="{{ route('mahasiswa.borrowings.index') }}" aria-label="Peminjaman" title="Peminjaman">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M6 4h12v16H6V4Z"></path>
                            <path d="M8 8h8"></path>
                            <path d="M8 12h8"></path>
                            <path d="M8 16h6"></path>
                        </svg>
                    </a>
                    <details class="account-menu">
                        <summary class="icon-btn account-trigger" aria-label="Menu akun" title="Menu akun">
                            <svg viewBox="0 0 24 24" aria-hidden="true">
                                <circle cx="12" cy="8" r="4"></circle>
                                <path d="M4 21c0-4 3.6-7 8-7s8 3 8 7"></path>
                            </svg>
                        </summary>
                        <div class="account-dropdown">
                            <a class="account-item" href="{{ route('mahasiswa.profile.edit') }}">Profil</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="account-item" type="submit">Logout</button>
                            </form>
                        </div>
                    </details>
                @else
                    <a class="icon-btn" href="{{ route('mahasiswa.login') }}" aria-label="Login" title="Login">
                        <svg viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M10 17v-3H3v-4h7V7l5 5-5 5Zm8-14H8a2 2 0 0 0-2 2v3h2V5h10v14H8v-3H6v3a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2Z"/>
                        </svg>
                    </a>
                @endif
            </div>
        </div>
    </header>

    <main class="container">
        @if ($books->count() === 0)
            <div class="empty">Belum ada buku yang cocok dengan pencarian kamu.</div>
        @else
            <section class="grid" aria-label="Daftar buku">
                @foreach ($books as $book)
                    <article class="card">
                        <a href="{{ route('catalog.show', $book) }}" aria-label="Detail buku {{ $book->title }}">
                            @if ($book->image)
                                <img class="cover" src="{{ asset($book->image) }}" alt="Cover">
                            @else
                                <div class="cover"></div>
                            @endif
                        </a>
                        <div class="card-body">
                            <p class="title">{{ $book->title }}</p>
                            <p class="year">{{ $book->publication_year ?? '-' }}</p>
                            <div class="card-actions">
                                <div style="display: inline-flex; gap: 10px; align-items: center;">
                                    @if (auth('peminjam')->check())
                                        <form method="POST" action="{{ route('mahasiswa.cart.add', $book) }}">
                                            @csrf
                                            <button class="btn" type="submit" aria-label="Tambah ke keranjang" title="Tambah ke keranjang">+</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </section>

            @php
                $current = $books->currentPage();
                $last = $books->lastPage();
                $start = max(1, $current - 2);
                $end = min($last, $current + 2);
            @endphp

            @if ($last > 1)
                <nav class="pagination" aria-label="Pagination">
                    <a class="page-link {{ $books->onFirstPage() ? 'disabled' : '' }}" href="{{ $books->previousPageUrl() ?? '#' }}">Prev</a>
                    @for ($page = $start; $page <= $end; $page++)
                        <a class="page-link {{ $page === $current ? 'active' : '' }}" href="{{ $books->url($page) }}">{{ $page }}</a>
                    @endfor
                    <a class="page-link {{ $books->hasMorePages() ? '' : 'disabled' }}" href="{{ $books->nextPageUrl() ?? '#' }}">Next</a>
                </nav>
            @endif
        @endif
    </main>

    @if (session('cart_added'))
        <div class="toast-overlay" data-toast>
            <div class="toast-card" role="dialog" aria-modal="true" aria-labelledby="toast-title">
                <p class="toast-title" id="toast-title">Berhasil</p>
                <p class="toast-text">
                    Buku <strong>{{ session('cart_added_title') }}</strong> ditambahkan ke keranjang peminjaman.
                </p>
                <div class="toast-actions">
                    <a class="btn" href="{{ route('mahasiswa.cart.show') }}">Lihat Keranjang</a>
                    <button class="btn btn-primary" type="button" data-toast-ok>OK</button>
                </div>
            </div>
        </div>
    @endif

    <script>
        (function () {
            document.querySelectorAll('details[data-menu]').forEach(function (details) {
                details.addEventListener('toggle', function () {
                    if (!details.open) return;
                    var menu = details.getAttribute('data-menu');
                    document.querySelectorAll('details[data-menu]').forEach(function (other) {
                        if (other !== details) other.open = false;
                    });

                    if (menu === 'search') {
                        var input = details.querySelector('#nav_q');
                        if (input) input.focus();
                    }

                    if (menu === 'filter') {
                        var select = details.querySelector('#nav_category_id');
                        if (select) select.focus();
                    }
                });
            });

            document.addEventListener('keydown', function (e) {
                if (e.key !== 'Escape') return;
                document.querySelectorAll('details[data-menu]').forEach(function (d) { d.open = false; });
            });

            var toast = document.querySelector('[data-toast]');
            var toastOk = document.querySelector('[data-toast-ok]');
            var closeToast = function () {
                if (!toast) return;
                toast.remove();
            };

            if (toast) {
                toast.addEventListener('click', function (e) {
                    if (e.target === toast) closeToast();
                });
                window.setTimeout(closeToast, 2200);
            }

            if (toastOk) toastOk.addEventListener('click', closeToast);
        })();
    </script>
</body>
</html>
