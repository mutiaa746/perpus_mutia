@php($active = 'categories')
@extends('admin.layout')

@section('title', 'Manajemen Kategori - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Manajemen Kategori</h1>
            <a class="btn primary" href="{{ route('admin.categories.create') }}">Tambah Kategori</a>
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
                    <th>ID</th>
                    <th>Nama Kategori</th>
                    <th style="text-align:right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td>#{{ $category->category_id }}</td>
                        <td>{{ $category->category_name }}</td>
                        <td>
                            <div class="actions">
                                <a class="btn" href="{{ route('admin.categories.edit', $category) }}">Edit</a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn danger" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" style="color: rgba(15, 23, 42, 0.60);">Belum ada kategori.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="pagination">
            {{ $categories->links() }}
        </div>
    </section>
@endsection

