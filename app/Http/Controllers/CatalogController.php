<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $q = preg_replace('/\s+/', ' ', trim((string) $request->query('q', '')));
        $categoryId = $request->query('category_id');

        $booksQuery = Book::query()->with('category')->orderByDesc('created_at');

        $tokens = $q === '' ? [] : preg_split('/\s+/', $q, -1, PREG_SPLIT_NO_EMPTY);
        $tokens = array_slice($tokens, 0, 5);

        foreach ($tokens as $token) {
            $safe = addcslashes($token, '%_\\');
            $like = '%'.$safe.'%';

            $booksQuery->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('author', 'like', $like)
                    ->orWhere('publisher', 'like', $like);
            });
        }

        if ($categoryId !== null && $categoryId !== '') {
            $booksQuery->where('category_id', (int) $categoryId);
        }

        $books = $booksQuery->paginate(12)->withQueryString();

        $categories = Category::query()
            ->orderBy('category_name')
            ->get();

        return view('catalog.index', [
            'books' => $books,
            'categories' => $categories,
            'q' => $q,
            'categoryId' => $categoryId,
        ]);
    }

    public function show(Book $book)
    {
        $book->load('category');

        return view('catalog.show', [
            'book' => $book,
        ]);
    }
}
