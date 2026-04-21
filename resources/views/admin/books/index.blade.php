@php($active = 'books')
@extends('admin.layout')

@section('title', 'Manajemen Buku - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Manajemen Buku</h1>
            <a class="btn primary" href="{{ route('admin.books.create') }}">Tambah Buku</a>
        </div>

        @if (session('status'))
            <div class="status">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Cover</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                    <th>Tahun</th>
                    <th style="text-align:right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>
                            @if ($book->image)
                                <img class="thumb" src="{{ asset($book->image) }}" alt="{{ $book->title }}">
                            @else
                                <div class="thumb"></div>
                            @endif
                        </td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->category?->category_name ?? '-' }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->publication_year ?? '-' }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.books.edit', $book) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.books.destroy', $book) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="color: rgba(15, 23, 42, 0.60);">Belum ada buku.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $books->links() }}
        </div>
    </section>
@endsection

