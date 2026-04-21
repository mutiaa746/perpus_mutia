<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Peminjam extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'peminjams';

    protected $primaryKey = 'id';

    protected $keyType = 'int';

    public $timestamps = false;

    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;

    protected $fillable = [
        'nama',
        'umur',
        'tanggal_lahir',
        'tempat_lahir',
        'nomor_hp',
        'email',
        'alamat',
        'foto',
        'jenis_kelamin',
        'nim',
        'verifikasi',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
        'tanggal_lahir' => 'date',
    ];
}
