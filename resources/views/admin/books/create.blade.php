@php($active = 'books')
@extends('admin.layout')

@section('title', 'Tambah Buku - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Tambah Buku</h1>
            <a class="btn" href="{{ route('admin.books.index') }}">Kembali</a>
        </div>

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="field">
                <label for="title">Judul</label>
                <input id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="field">
                <label for="author">Penulis</label>
                <input id="author" name="author" value="{{ old('author') }}" required>
            </div>

            <div class="field">
                <label for="publisher">Penerbit</label>
                <input id="publisher" name="publisher" value="{{ old('publisher') }}">
            </div>

            <div class="field" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div>
                    <label for="publication_year">Tahun Terbit</label>
                    <input id="publication_year" name="publication_year" value="{{ old('publication_year') }}" inputmode="numeric">
                </div>
                <div>
                    <label for="page_count">Jumlah Halaman</label>
                    <input id="page_count" name="page_count" value="{{ old('page_count') }}" inputmode="numeric">
                </div>
            </div>

            <div class="field" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <div>
                    <label for="stock">Stok</label>
                    <input id="stock" name="stock" value="{{ old('stock') }}" required inputmode="numeric">
                </div>
                <div>
                    <label for="category_id">Kategori</label>
                    <select id="category_id" name="category_id">
                        <option value="">- Tanpa kategori -</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" @selected(old('category_id') == $category->category_id)>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="field">
                <label for="description">Deskripsi</label>
                <textarea id="description" name="description">{{ old('description') }}</textarea>
            </div>

            <div class="field">
                <label for="image">Gambar Cover</label>
                <input id="image" type="file" name="image" accept="image/*">
                <div class="muted">Opsional. Maks 2MB.</div>
            </div>

            <div class="field" style="display:flex;justify-content:flex-end;margin-top:14px;">
                <button class="btn primary" type="submit">Simpan</button>
            </div>
        </form>
    </section>
@endsection

