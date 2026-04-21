<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $status = (string) $request->query('status', 'pending');
        $status = in_array($status, ['pending', 'approved', 'returned'], true) ? $status : 'pending';

        $borrowings = Borrowing::query()
            ->with(['peminjam', 'admin'])
            ->where('status', $status)
            ->orderByDesc('borrow_date')
            ->paginate(12)
            ->withQueryString();

        $counts = Borrowing::query()
            ->selectRaw("sum(case when status = 'pending' then 1 else 0 end) as pending_count")
            ->selectRaw("sum(case when status = 'approved' then 1 else 0 end) as approved_count")
            ->selectRaw("sum(case when status = 'returned' then 1 else 0 end) as returned_count")
            ->first();

        return view('admin.borrowings.index', [
            'borrowings' => $borrowings,
            'status' => $status,
            'counts' => $counts,
        ]);
    }

    public function show(Request $request, Borrowing $borrowing)
    {
        $borrowing->load(['peminjam', 'admin', 'items.book']);

        return view('admin.borrowings.show', [
            'borrowing' => $borrowing,
        ]);
    }

    public function approve(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->withErrors([
                'borrowing' => 'Peminjaman tidak dalam status pending.',
            ]);
        }

        $data = $request->validate([
            'return_date' => ['required', 'date'],
            'note' => ['nullable', 'string'],
        ]);

        try {
            DB::transaction(function () use ($borrowing, $data, $request) {
                $borrowing->loadMissing(['items.book']);

                foreach ($borrowing->items as $item) {
                    $book = Book::query()
                        ->where('book_id', $item->book_id)
                        ->lockForUpdate()
                        ->firstOrFail();

                    if ($item->quantity > $book->stock) {
                        throw new \RuntimeException('Stok buku tidak mencukupi: '.$book->title);
                    }

                    $book->stock = $book->stock - $item->quantity;
                    $book->save();
                }

                $borrowing->status = 'approved';
                $borrowing->admin_id = $request->user('admin')->id_admin;
                $borrowing->return_date = $data['return_date'];
                $borrowing->note = $data['note'] ?? null;
                $borrowing->save();
            });
        } catch (\RuntimeException $e) {
            return back()->withErrors([
                'borrowing' => $e->getMessage(),
            ]);
        }

        return redirect()
            ->route('admin.borrowings.show', $borrowing)
            ->with('status', 'Peminjaman berhasil disetujui.');
    }

    public function returned(Request $request, Borrowing $borrowing)
    {
        if ($borrowing->status !== 'approved') {
            return back()->withErrors([
                'borrowing' => 'Peminjaman harus berstatus approved untuk ditandai kembali.',
            ]);
        }

        $data = $request->validate([
            'note' => ['nullable', 'string'],
        ]);

        DB::transaction(function () use ($borrowing, $data, $request) {
            $borrowing->loadMissing(['items.book']);

            foreach ($borrowing->items as $item) {
                $book = Book::query()
                    ->where('book_id', $item->book_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                $book->stock = $book->stock + $item->quantity;
                $book->save();
            }

            $borrowing->status = 'returned';
            $borrowing->admin_id = $request->user('admin')->id_admin;
            $borrowing->note = $data['note'] ?? $borrowing->note;
            $borrowing->save();
        });

        return redirect()
            ->route('admin.borrowings.show', $borrowing)
            ->with('status', 'Peminjaman ditandai sudah dikembalikan.');
    }
}
