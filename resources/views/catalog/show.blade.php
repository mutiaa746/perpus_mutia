<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $book->title }} - Detail Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .book-cover {
            width: 100%;
            height: 460px;
            object-fit: cover;
            background: linear-gradient(135deg, rgba(37, 99, 235, 0.10), rgba(14, 165, 233, 0.10));
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

        @media (max-width: 992px) {
            .book-cover { height: 320px; }
        }
    </style>
</head>
<body>
    <main class="container py-4">
        <div class="mb-3 d-flex gap-2 align-items-center">
            <a class="btn btn-outline-secondary" href="{{ route('catalog.index') }}" aria-label="Kembali" title="Kembali">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            @if (auth('peminjam')->check())
                <form method="POST" action="{{ route('mahasiswa.cart.add', $book) }}">
                    @csrf
                    <button class="btn btn-outline-primary" type="submit">Tambah ke Keranjang</button>
                </form>
            @endif
        </div>
        <div class="row g-3">
            <div class="col-12 col-lg-4">
                <div class="card border-0 shadow-sm overflow-hidden">
                    @if ($book->image)
                        <img class="book-cover" src="{{ asset($book->image) }}" alt="Cover">
                    @else
                        <img class="book-cover" src="{{ asset('image/landing.jpeg') }}" alt="Cover">
                    @endif
                </div>
            </div>
            <div class="col-12 col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h1 class="h5 fw-bold mb-1">{{ $book->title }}</h1>
                        <div class="text-secondary small mb-3">{{ $book->category?->category_name ?? 'Tanpa kategori' }}</div>

                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <span class="badge text-bg-success">Stok: {{ $book->stock }}</span>
                            <span class="badge text-bg-primary">Tahun: {{ $book->publication_year ?? '-' }}</span>
                            <span class="badge text-bg-secondary">Halaman: {{ $book->page_count ?? '-' }}</span>
                        </div>

                        <div class="row g-2 small mb-3">
                            <div class="col-12 col-md-4 text-secondary fw-semibold">Penulis</div>
                            <div class="col-12 col-md-8">{{ $book->author }}</div>
                            <div class="col-12 col-md-4 text-secondary fw-semibold">Penerbit</div>
                            <div class="col-12 col-md-8">{{ $book->publisher ?? '-' }}</div>
                        </div>

                        <div class="border-top pt-3">
                            <div class="fw-bold mb-2">Deskripsi</div>
                            <div class="text-secondary small" style="white-space: pre-wrap;">{{ $book->description ?: '-' }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @if (session('cart_added'))
        <div class="toast-overlay" data-toast>
            <div class="toast-card" role="dialog" aria-modal="true" aria-labelledby="toast-title">
                <p class="toast-title" id="toast-title">Berhasil</p>
                <p class="toast-text">
                    Buku <strong>{{ session('cart_added_title') }}</strong> ditambahkan ke keranjang peminjaman.
                </p>
                <div class="toast-actions">
                    <a class="btn btn-outline-secondary" href="{{ route('mahasiswa.cart.show') }}">Lihat Keranjang</a>
                    <button class="btn btn-primary" type="button" data-toast-ok>OK</button>
                </div>
            </div>
        </div>
        <script>
            (function () {
                var toast = document.querySelector('[data-toast]');
                var ok = document.querySelector('[data-toast-ok]');
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
                if (ok) ok.addEventListener('click', closeToast);
            })();
        </script>
    @endif
</body>
</html>
