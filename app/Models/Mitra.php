<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Mitra extends Authenticable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'deskripsi',
        'alamat',
    ];

    public function makanans()
    {
        return $this->hasMany(Makanan::class);
    }

        public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
