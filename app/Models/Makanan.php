<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Makanan extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'deskripsi',
        'harga',
        'gambar_makanan',
        'kategoris_id',
        'mitras_id',
        'status'
    ];

    public function kategoris()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function mitra()
    {
        return $this->belongsTo(Mitra::class);
    }

        public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
    }
}
