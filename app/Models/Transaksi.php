<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = 
    [
        'user_id',
        'makanan_id',
        'mitra_id',
        'total_harga',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function makanan()
    {
        return $this->belongsTo(Makanan::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

    public function ulasan()
    {
        return $this->hasOne(Ulasan::class);
    }

    protected $casts = [
        'total_harga' => 'decimal:2',
    ];
}
