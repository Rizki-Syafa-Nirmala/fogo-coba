<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $fillable = [
        'user_id',
        'makanan_id',
        'transaksi_id',
        'rating',
        'komen'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function makanan()
    {
        return $this->belongsTo(Makanan::class);
    }

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class);
    }
}
