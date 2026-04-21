<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowingItem extends Model
{
    use HasFactory;

    protected $table = 'borrowing_items';

    protected $primaryKey = 'borrow_item_id';

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'borrow_id',
        'book_id',
        'quantity',
    ];

    public function borrowing()
    {
        return $this->belongsTo(Borrowing::class, 'borrow_id', 'borrow_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
