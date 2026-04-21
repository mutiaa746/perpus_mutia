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

        .brand-dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            background: var(--primary);
            box-shadow: 0 0 0 5px rgba(245, 158, 11, 0.18);
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

        .login {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 40px;
            padding: 0 14px;
            border-radius: 12px;
            font-weight: 700;
            font-size: 14px;
           
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
        }
    </style>
</head>
<body>
    <header class="nav">
        <div class="nav-inner">
            <a class="brand" href="#beranda">
                <span class="brand-dot" aria-hidden="true"></span>
                Neo E-Library
            </a>
            <nav class="nav-links" aria-label="Navigasi">
                <a href="#beranda">Beranda</a>
                <a href="#tentang">Tentang E-Perpustakaan</a>
                <a href="{{ route('catalog.index') }}">Katalog Buku</a>
            </nav>
            <a class="login" href="{{ route('mahasiswa.login') }}">Login</a>
        </div>
    </header>

    <section id="beranda" class="hero" role="banner">
        <div class="hero-content">
            <h1 class="hero-title">Neo E-Library<br>Universitas Malikussaleh</h1>
            <p class="hero-subtitle">Akses perpustakaan kampus secara online untuk mahasiswa.</p>
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
                
            </div>
        </div>
    </section>

    <footer>© {{ date('Y') }} Neo E-Library Universitas Malikussaleh</footer>
</body>
</html>
