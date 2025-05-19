<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Mitra extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'deskripsi',
        'alamat',
    ];

    public function makanan()
    {
        return $this->hasMany(Makanan::class);
    }

        public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
