<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::query()
            ->with('category')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.books.index', [
            'books' => $books,
        ]);
    }

    public function create()
    {
        $categories = Category::query()
            ->orderBy('category_name')
            ->get();

        return view('admin.books.create', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'publication_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'page_count' => ['nullable', 'integer', 'min:1'],
            'category_id' => ['nullable', 'integer', 'exists:Categories,category_id'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeBookImage($request);
        }

        Book::create($data);

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Buku berhasil ditambahkan.');
    }

    public function edit(Book $book)
    {
        $categories = Category::query()
            ->orderBy('category_name')
            ->get();

        return view('admin.books.edit', [
            'book' => $book->load('category'),
            'categories' => $categories,
        ]);
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'author' => ['required', 'string', 'max:255'],
            'publisher' => ['nullable', 'string', 'max:255'],
            'publication_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'page_count' => ['nullable', 'integer', 'min:1'],
            'category_id' => ['nullable', 'integer', 'exists:Categories,category_id'],
            'image' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $this->deletePublicImage($book->image);
            $data['image'] = $this->storeBookImage($request);
        }

        $book->update($data);

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $this->deletePublicImage($book->image);
        $book->delete();

        return redirect()
            ->route('admin.books.index')
            ->with('status', 'Buku berhasil dihapus.');
    }

    private function storeBookImage(Request $request): string
    {
        $dir = public_path('image/books');

        if (! is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();
        $filename = Str::uuid()->toString().($ext ? '.'.$ext : '');
        $file->move($dir, $filename);

        return 'image/books/'.$filename;
    }

    private function deletePublicImage(?string $path): void
    {
        if (! $path) {
            return;
        }

        $fullPath = public_path($path);

        if (is_file($fullPath)) {
            @unlink($fullPath);
        }
    }
}
