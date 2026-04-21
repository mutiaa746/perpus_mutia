<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Neo E-Library Universitas Malikussaleh</title>
    <style>
        :root {
            --bg: #0b1020;
            --text: rgba(255, 255, 255, 0.92);
            --muted: rgba(255, 255, 255, 0.78);
            --stroke: rgba(255, 255, 255, 0.18);
            --primary: #f59e0b;
            --shadow: 0 24px 80px rgba(0, 0, 0, 0.45);
        }

        * { box-sizing: border-box; }
        html, body { height: 100%; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            font-family: ui-sans-serif, system-ui, -apple-system, Segoe UI, Roboto, Helvetica, Arial, "Apple Color Emoji", "Segoe UI Emoji";
            color: var(--text);
            background: #0b1020;
        }

        a { color: inherit; text-decoration: none; }

        .nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 10;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            background: rgba(11, 16, 32, 0.42);
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
            font-weight: 800;
            letter-spacing: 0.2px;
            white-space: nowrap;
        }

        .brand-logo {
            width: 26px;
            height: 26px;
            border-radius: 8px;
            object-fit: contain;
            background: rgba(255, 255, 255, 0.9);
            padding: 4px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-left: 8px;
            flex: 1;
        }

        .nav-links a {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.85);
            padding: 8px 10px;
            border-radius: 10px;
        }

        .nav-links a:hover {
            background: rgba(255, 255, 255, 0.08);
        }

        .user {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 7px 10px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.06);
        }

        .user-name {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.9);
            font-weight: 700;
            white-space: nowrap;
        }

        .profile {
            width: 34px;
            height: 34px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.08);
        }

        .profile svg { width: 18px; height: 18px; fill: rgba(255, 255, 255, 0.88); }

        .logout-btn {
            height: 34px;
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, 0.16);
            background: rgba(255, 255, 255, 0.08);
            color: rgba(255, 255, 255, 0.9);
            padding: 0 12px;
            font-weight: 700;
            cursor: pointer;
        }

        .hero {
            min-height: 100vh;
            background-image: url("{{ asset('image/landing.jpeg') }}");
            background-size: cover;
            background-position: center;
            position: relative;
            display: grid;
            place-items: center;
            padding: 92px 18px 40px;
        }

        .hero::before {
            content: "";
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg, rgba(11, 16, 32, 0.62), rgba(11, 16, 32, 0.55), rgba(11, 16, 32, 0.72));
        }

        .hero-content {
            position: relative;
            width: min(1100px, 100%);
            text-align: center;
            padding: 20px 14px;
        }

        .hero-title {
            margin: 0;
            font-weight: 900;
            letter-spacing: -1px;
            font-size: clamp(34px, 5.4vw, 64px);
            line-height: 1.02;
            text-shadow: var(--shadow);
        }

        .hero-subtitle {
            margin: 10px 0 0 0;
            color: var(--muted);
            font-size: clamp(14px, 2.2vw, 18px);
            line-height: 1.6;
        }

        .section {
            padding: 52px 16px;
            background: #0b1020;
        }

        .container {
            width: min(1100px, 100%);
            margin: 0 auto;
        }

        .section h2 {
            margin: 0;
            font-size: 22px;
            letter-spacing: -0.2px;
        }

        .section p {
            margin: 12px 0 0 0;
            color: rgba(255, 255, 255, 0.76);
            line-height: 1.7;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-top: 18px;
        }

        .card {
            border: 1px solid rgba(255, 255, 255, 0.12);
            background: rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            padding: 14px 14px;
            display: block;
        }

        .card:hover {
            border-color: rgba(245, 158, 11, 0.28);
            background: rgba(255, 255, 255, 0.07);
        }

        .card strong { display: block; font-size: 14px; }
        .card span { display: block; margin-top: 8px; color: rgba(255, 255, 255, 0.74); line-height: 1.6; font-size: 13px; }

        footer {
            padding: 18px 16px 24px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 12px;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            background: #0b1020;
        }

        #beranda, #tentang {
            scroll-margin-top: 70px;
        }

        @media (max-width: 760px) {
            .nav-links { gap: 8px; }
            .nav-links a { padding: 8px 8px; }
            .cards { grid-template-columns: 1fr; }
            .user-name { display: none; }
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="nav-inner">
            <a class="brand" href="#beranda">
                <img class="brand-logo" src="{{ asset('image/elibrary.png') }}" alt="E-Library">
                Neo E-Library
            </a>
            <nav class="nav-links" aria-label="Navigasi">
                <a href="#beranda">Beranda</a>
                <a href="#tentang">Tentang E-Perpustakaan</a>
                <a href="{{ route('catalog.index') }}">Katalog Buku</a>
            </nav>

            <div class="user">
                <div class="user-name">
                    {{ explode(' ', trim(auth('peminjam')->user()->nama))[0] }}
                </div>
                <a class="profile" href="{{ route('mahasiswa.profile.edit') }}" aria-label="Profil">
                    <svg viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M12 12a4 4 0 1 0-4-4 4 4 0 0 0 4 4Zm0 2c-4.42 0-8 2-8 4.5V21h16v-2.5c0-2.5-3.58-4.5-8-4.5Z"/>
                    </svg>
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">Keluar</button>
                </form>
            </div>
        </div>
    </header>

    <section id="beranda" class="hero" role="banner">
        <div class="hero-content">
            <h1 class="hero-title">Neo E-Library<br>Universitas Malikussaleh</h1>
            <p class="hero-subtitle">Selamat datang, {{ explode(' ', trim(auth('peminjam')->user()->nama))[0] }}.</p>
        </div>
    </section>

    <section id="tentang" class="section">
        <div class="container">
            <h2>Tentang E-Perpustakaan</h2>
            <p>
                Neo E-Library adalah portal yang membantu mahasiswa mengakses informasi perpustakaan, melihat katalog, dan memantau aktivitas peminjaman secara lebih praktis.
            </p>

            <div class="cards">
                <a class="card" href="{{ route('catalog.index') }}">
                    <strong>Katalog Buku</strong>
                    <span>Lihat daftar buku yang tersedia dan informasi detailnya.</span>
                </a>
                <div class="card">
                    <strong>Riwayat Pinjam</strong>
                    <span>Pantau peminjaman yang sedang berjalan dan yang sudah selesai.</span>
                </div>
                <div class="card">
                    <strong>Profil Mahasiswa</strong>
                    <span>Kelola data akun dan informasi profil dari menu profil.</span>
                </div>
            </div>
        </div>
    </section>

    <footer>© {{ date('Y') }} Neo E-Library Universitas Malikussaleh</footer>
</body>
</html>
