<?php

use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\BorrowingController as AdminBorrowingController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\MahasiswaAuthController;
use App\Http\Controllers\Auth\MahasiswaRegisterController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\Mahasiswa\CartController as MahasiswaCartController;
use App\Http\Controllers\Mahasiswa\ProfileController as MahasiswaProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/katalog', [CatalogController::class, 'index'])->name('catalog.index');
Route::get('/katalog/{book}', [CatalogController::class, 'show'])->name('catalog.show');

Route::get('/home', function () {
    if (auth('admin')->check()) {
        return redirect()->route('admin.dashboard');
    }

    if (auth('peminjam')->check()) {
        return redirect()->route('catalog.index');
    }

    return redirect('/');
})->middleware('auth:admin,peminjam')->name('home');

Route::post('/logout', LogoutController::class)
    ->middleware('auth:admin,peminjam')
    ->name('logout');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['guest:peminjam', 'guest:admin'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'create'])->name('login');
        Route::post('/login', [AdminAuthController::class, 'store'])->name('login.store');
    });

    Route::middleware(['guest:peminjam', 'auth:admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/borrowings', [AdminBorrowingController::class, 'index'])->name('borrowings.index');
        Route::get('/borrowings/{borrowing}', [AdminBorrowingController::class, 'show'])->name('borrowings.show');
        Route::patch('/borrowings/{borrowing}/approve', [AdminBorrowingController::class, 'approve'])->name('borrowings.approve');
        Route::patch('/borrowings/{borrowing}/returned', [AdminBorrowingController::class, 'returned'])->name('borrowings.returned');
        Route::get('/peminjams/{peminjam}', [AdminDashboardController::class, 'showPeminjam'])
            ->name('peminjams.show');
        Route::patch('/peminjams/{peminjam}/verifikasi', [AdminDashboardController::class, 'verifikasiPeminjam'])
            ->name('peminjams.verifikasi');
        Route::delete('/peminjams/{peminjam}', [AdminDashboardController::class, 'destroyPeminjam'])
            ->name('peminjams.destroy');
        Route::resource('categories', AdminCategoryController::class)->except(['show']);
        Route::resource('books', AdminBookController::class)->except(['show']);
    });
});

Route::prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::middleware(['guest:admin', 'guest:peminjam'])->group(function () {
        Route::get('/login', [MahasiswaAuthController::class, 'create'])->name('login');
        Route::post('/login', [MahasiswaAuthController::class, 'store'])->name('login.store');
        Route::get('/register', [MahasiswaRegisterController::class, 'create'])->name('register');
        Route::post('/register', [MahasiswaRegisterController::class, 'store'])->name('register.store');
        Route::get('/register/cek-verifikasi', [MahasiswaRegisterController::class, 'cekVerifikasi'])->name('register.cek');
    });

    Route::middleware(['guest:admin', 'auth:peminjam'])->group(function () {
        Route::get('/', function () {
            return redirect()->route('catalog.index');
        })->name('dashboard');
        Route::get('/keranjang', [MahasiswaCartController::class, 'show'])->name('cart.show');
        Route::post('/keranjang/tambah/{book}', [MahasiswaCartController::class, 'add'])->name('cart.add');
        Route::patch('/keranjang/item/{cartItem}', [MahasiswaCartController::class, 'updateQuantity'])->name('cart.item.update');
        Route::delete('/keranjang/item/{cartItem}', [MahasiswaCartController::class, 'remove'])->name('cart.item.remove');
        Route::post('/keranjang/pinjam', [MahasiswaCartController::class, 'checkout'])->name('cart.checkout');
        Route::get('/profil', [MahasiswaProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profil', [MahasiswaProfileController::class, 'update'])->name('profile.update');
        Route::get('/kartu', [MahasiswaProfileController::class, 'printCard'])->name('card.print');
        Route::get('/peminjaman', [MahasiswaProfileController::class, 'borrowings'])->name('borrowings.index');
        Route::get('/peminjaman/{borrowing}', [MahasiswaProfileController::class, 'showBorrowing'])->name('borrowings.show');
        Route::get('/peminjaman/{borrowing}/cetak', [MahasiswaProfileController::class, 'printBorrowing'])->name('borrowings.print');
    });
});
