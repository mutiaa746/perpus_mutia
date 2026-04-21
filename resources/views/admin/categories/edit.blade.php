@php($active = 'categories')
@extends('admin.layout')

@section('title', 'Edit Kategori - Admin')

@section('content')
    <section class="panel">
        <div class="panel-head">
            <h1>Edit Kategori</h1>
            <a class="btn" href="{{ route('admin.categories.index') }}">Kembali</a>
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

        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')

            <div class="field">
                <label for="category_name">Nama Kategori</label>
                <input id="category_name" name="category_name" value="{{ old('category_name', $category->category_name) }}" required>
            </div>

            <div class="field" style="display:flex;justify-content:flex-end;margin-top:14px;">
                <button class="btn primary" type="submit">Simpan</button>
            </div>
        </form>
    </section>
@endsection

