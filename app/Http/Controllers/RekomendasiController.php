<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Utils\GeoUtils;
use App\Models\Makanan;


class RekomendasiController extends Controller
{
    private function getProcessedMakanans($userKota, $userLat, $userLon)
    {
        // Ambil data food hanya yang berstatus 'available'
            $makanans = Makanan::with(['kategoris', 'mitra', 'ulasan'])
            ->where('tersedia', true) // Filter hanya yang tersedia
            ->when($userKota, function ($query) use ($userKota) {
                $query->whereHas('mitra', function ($q) use ($userKota) {
                    $q->where(function ($subQuery) use ($userKota) {
                        $subQuery->where('kota', 'like', "%{$userKota}%")
                                 ->orWhereRaw('? LIKE CONCAT("%", kota, "%")', [$userKota]);
                    });
                });
            })
            ->get()
            ->map(function ($makanans) use ($userLat, $userLon) {
                if ($makanans->mitra && $makanans->mitra->latitude && $makanans->mitra->longitude) {
                    $mitraLat = $makanans->mitra->latitude;
                    $mitraLon = $makanans->mitra->longitude;

                    $makanans->jarak_km = GeoUtils::hitungJarak($userLat, $userLon, $mitraLat, $mitraLon);
                } else {
                    $makanans->jarak_km = null;
                }

                return $makanans;
            })
            ->map(function ($makanans) {
                // Hitung rata-rata rating makanan
                $makanans->average_rating = $makanans  ->ulasan->isNotEmpty() ? number_format($makanans->ulasan->avg('rating'), 1) : 0;
                $makanans->rating_count = $makanans->ulasan->count();

             // Hitung jumlah review berdasarkan masing-masing rating
             $ratingCounts = [
                5 => $makanans->ulasan->where('rating', 5)->count(),
                4 => $makanans->ulasan->where('rating', 4)->count(),
                3 => $makanans->ulasan->where('rating', 3)->count(),
                2 => $makanans->ulasan->where('rating', 2)->count(),
                1 => $makanans->ulasan->where('rating', 1)->count(),
            ];

            // Hitung total ulasan untuk persentase
            // Hitung jumlah masing-masing rating
            $makanans->rating_5 = $makanans->ulasan->where('rating', 5)->count();
            $makanans->rating_4 = $makanans->ulasan->where('rating', 4)->count();
            $makanans->rating_3 = $makanans->ulasan->where('rating', 3)->count();
            $makanans->rating_2 = $makanans->ulasan->where('rating', 2)->count();
            $makanans->rating_1 = $makanans->ulasan->where('rating', 1)->count();

            // Hitung persentase review per bintang
            $total_ulasan = $makanans->ulasan->count();
            $makanans->rating_5_percent = $total_ulasan > 0 ? ($makanans->rating_5 / $total_ulasan) * 100 : 0;
            $makanans->rating_4_percent = $total_ulasan > 0 ? ($makanans->rating_4 / $total_ulasan) * 100 : 0;
            $makanans->rating_3_percent = $total_ulasan > 0 ? ($makanans->rating_3 / $total_ulasan) * 100 : 0;
            $makanans->rating_2_percent = $total_ulasan > 0 ? ($makanans->rating_2 / $total_ulasan) * 100 : 0;
            $makanans->rating_1_percent = $total_ulasan > 0 ? ($makanans->rating_1 / $total_ulasan) * 100 : 0;

            return $makanans;
        });
        return $makanans;
    }

    public function index()
    {
        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        $makanans = $this->getProcessedMakanans($userKota, $userLat, $userLon);

        $terdekat = $makanans->filter(function ($makanan) {
            return $makanan->jarak_km !== null && $makanan->jarak_km <= 5;
        })
        ->sortBy('jarak_km') // opsional: urutkan dari yang paling dekat
        ->values() // reset key agar indexing rapi di view
        ->take(4);
        $termurah = $makanans->filter(function ($makanan) {
            return $makanan->harga <= 50000;
        })
        ->sortBy('harga')->take(4);
        $terbaik = $makanans->filter(function ($makanan) {
            return $makanan->average_rating >= 4;
        })
        ->sortByDesc('average_rating')->take(4);
        $terpopuler = $makanans->filter(function ($makanan) {
            return $makanan->rating_count >= 1;
        })
        ->sortByDesc('rating_count')->take(4);
        $terfavorit = $makanans->filter(function ($makanan) {
            return $makanan->rating_5 >= 1;
        })
        ->sortByDesc('rating_5')->take(4);
        // dd($userLat, $userLon);





        return view('user.rekomendasi', compact('makanans', 'terdekat', 'termurah', 'terbaik', 'terpopuler', 'terfavorit'));
    }

    public function lihatsemua($filter)
    {

        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        $makanans = $this->getProcessedMakanans($userKota, $userLat, $userLon);

        if ($filter === 'terdekat') {
            $filtered = $makanans->filter(fn($m) => $m->jarak_km !== null && $m->jarak_km <= 5)
            ->sortBy('jarak_km')
            ->values();
        } elseif ($filter === 'termurah') {
            $filtered = $makanans->filter(fn($m) => $m->harga <= 100000)
            ->sortBy('harga')
            ->values();
        } elseif ($filter === 'terbaik') {
            $filtered = $makanans->filter(fn($m) => $m->average_rating >= 4)
            ->sortByDesc('average_rating')
            ->values();
        } elseif ($filter === 'terpopuler') {
            $filtered = $makanans->filter(fn($m) => $m->rating_count > 0)
            ->sortByDesc('rating_count')
            ->values();
        } elseif ($filter === 'terfavorit') {
            $filtered = $makanans->filter(fn($m) => $m->rating_5 > 0)
            ->sortByDesc('rating_5')
            ->values();
        }

        return view('user.rekomendasi-filter', compact('filtered', 'filter', 'makanans'));

    }

    public function rekomendasimakananmobile($filter)
    {

        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        $makanans = $this->getProcessedMakanans($userKota, $userLat, $userLon);

        if ($filter === 'terdekat') {
            $filtered = $makanans->filter(fn($m) => $m->jarak_km !== null && $m->jarak_km <= 5)
            ->sortBy('jarak_km')
            ->values();
        } elseif ($filter === 'termurah') {
            $filtered = $makanans->filter(fn($m) => $m->harga <= 100000)
            ->sortBy('harga')
            ->values();
        } elseif ($filter === 'terbaik') {
            $filtered = $makanans->filter(fn($m) => $m->average_rating >= 4)
            ->sortByDesc('average_rating')
            ->values();
        } elseif ($filter === 'terpopuler') {
            $filtered = $makanans->filter(fn($m) => $m->rating_count > 0)
            ->sortByDesc('rating_count')
            ->values();
        } elseif ($filter === 'terfavorit') {
            $filtered = $makanans->filter(fn($m) => $m->rating_5 > 0)
            ->sortByDesc('rating_5')
            ->values();
        } else if ($filter === 'semua') {
            $filtered = $makanans;
        }

        return view('user-mobile.rekomendasi', compact('filtered', 'filter', 'makanans'));



    }

}
