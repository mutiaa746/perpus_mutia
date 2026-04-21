<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingItem;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show(Request $request)
    {
        $peminjam = $request->user('peminjam');

        $cart = Cart::query()->firstOrCreate([
            'peminjam_id' => $peminjam->id,
        ]);

        $items = CartItem::query()
            ->where('cart_id', $cart->cart_id)
            ->with('book')
            ->orderByDesc('cart_item_id')
            ->get();

        return view('mahasiswa.cart', [
            'cart' => $cart,
            'items' => $items,
        ]);
    }

    public function add(Request $request, Book $book)
    {
        $peminjam = $request->user('peminjam');

        $cart = Cart::query()->firstOrCreate([
            'peminjam_id' => $peminjam->id,
        ]);

        $item = CartItem::query()->firstOrCreate(
            [
                'cart_id' => $cart->cart_id,
                'book_id' => $book->book_id,
            ],
            [
                'quantity' => 0,
            ]
        );

        $newQuantity = $item->quantity + 1;
        if ($newQuantity > $book->stock) {
            return back()->withErrors([
                'cart' => 'Stok buku tidak mencukupi.',
            ]);
        }

        $item->quantity = $newQuantity;
        $item->save();

        return back()
            ->with('cart_added', true)
            ->with('cart_added_title', $book->title);
    }

    public function updateQuantity(Request $request, CartItem $cartItem)
    {
        $peminjam = $request->user('peminjam');

        $cart = Cart::query()->where('peminjam_id', $peminjam->id)->first();
        if (! $cart || (int) $cartItem->cart_id !== (int) $cart->cart_id) {
            abort(403);
        }

        $cartItem->loadMissing('book');

        $data = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:'.$cartItem->book->stock],
        ]);

        $cartItem->quantity = (int) $data['quantity'];
        $cartItem->save();

        return back()->with('status', 'Keranjang diperbarui.');
    }

    public function remove(Request $request, CartItem $cartItem)
    {
        $peminjam = $request->user('peminjam');

        $cart = Cart::query()->where('peminjam_id', $peminjam->id)->first();
        if (! $cart || (int) $cartItem->cart_id !== (int) $cart->cart_id) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('status', 'Item dihapus dari keranjang.');
    }

    public function checkout(Request $request)
    {
        $peminjam = $request->user('peminjam');

        $cart = Cart::query()->where('peminjam_id', $peminjam->id)->first();
        if (! $cart) {
            return back()->withErrors([
                'cart' => 'Keranjang belum ada.',
            ]);
        }

        $items = CartItem::query()
            ->where('cart_id', $cart->cart_id)
            ->with('book')
            ->get();

        if ($items->isEmpty()) {
            return back()->withErrors([
                'cart' => 'Keranjang masih kosong.',
            ]);
        }

        foreach ($items as $item) {
            if ($item->quantity > $item->book->stock) {
                return back()->withErrors([
                    'cart' => 'Stok buku tidak mencukupi untuk: '.$item->book->title,
                ]);
            }
        }

        $borrowing = Borrowing::create([
            'peminjam_id' => $peminjam->id,
            'status' => 'pending',
            'note' => null,
            'admin_id' => null,
            'return_date' => null,
        ]);

        foreach ($items as $item) {
            BorrowingItem::create([
                'borrow_id' => $borrowing->borrow_id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
            ]);
        }

        CartItem::query()->where('cart_id', $cart->cart_id)->delete();

        return redirect()->route('mahasiswa.cart.show')->with('status', 'Permintaan peminjaman berhasil dikirim. Menunggu verifikasi admin.');
    }
}
