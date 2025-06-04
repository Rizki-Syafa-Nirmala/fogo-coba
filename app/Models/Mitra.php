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
        'no_telp',
        'kota',
        'latitude',
        'longitude',
    ];

    public function makanans()
    {
        return $this->hasMany(Makanan::class);
    }

        public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }

            public function canAccessPanel(Panel $panel): bool
        {
            return true;
        }

        public static function calculateDistance($lat1, $lon1, $lat2, $lon2)
        {
            $earthRadius = 6371; // Kilometer

            $dLat = deg2rad($lat2 - $lat1);
            $dLon = deg2rad($lon2 - $lon1);

            $lat1 = deg2rad($lat1);
            $lat2 = deg2rad($lat2);

            $a = sin($dLat/2) * sin($dLat/2) +
                sin($dLon/2) * sin($dLon/2) * cos($lat1) * cos($lat2);
            $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
            return $earthRadius * $c;
        }
    }
