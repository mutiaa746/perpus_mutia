<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $table = 'borrowings';

    protected $primaryKey = 'borrow_id';

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = [
        'peminjam_id',
        'borrow_date',
        'return_date',
        'status',
        'admin_id',
        'note',
    ];

    protected $casts = [
        'borrow_date' => 'datetime',
        'return_date' => 'datetime',
    ];

    public function items()
    {
        return $this->hasMany(BorrowingItem::class, 'borrow_id', 'borrow_id');
    }

    public function peminjam()
    {
        return $this->belongsTo(Peminjam::class, 'peminjam_id', 'id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id_admin');
    }
}
