<?php

namespace App\Http\Controllers\Pelanggan;

use Midtrans\Snap;
use Midtrans\Config;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Utils\GeoUtils;
use App\Models\Transaksi;
use App\Models\Mitra;
use App\Models\Makanan;
use App\Models\Kategori;
use App\Http\Controllers\Controller;



class MakananController extends Controller
{

    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

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
    public function index(Request $request)
    {
        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        // Ambil semua kategori dan mitra untuk filter
        $kategoris = Kategori::all();
        $mitras = Mitra::all();

        $makanans = $this->getProcessedMakanans($userKota, $userLat, $userLon);

            // Jika user belum login (guest)
        if (!auth()->check()) {

            if($this->agent->isMobile()){
                return view('user-mobile.install');
            }
            return view('guest.home', compact('makanans', 'kategoris', 'mitras'));
        }

        if ($this->agent->isMobile()) {
            return view('user-mobile.beranda', compact('makanans', 'kategoris', 'mitras'));
        }else{

            return view('user.food', compact('makanans', 'kategoris', 'mitras'));
        }
    }

    public function byCategory($kategoriId,)
    {
        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        $kategoris = Kategori::all();
        $mitras = Mitra::all();
        $selectedKategori = Kategori::findOrFail($kategoriId);

        $ambilmakanan = $this->getProcessedMakanans($userKota, $userLat, $userLon);

        $makanans = $ambilmakanan->filter(function ($makanan) use ($kategoriId) {
            return $makanan->kategoris_id == $kategoriId;
        });

         return view('user.food', compact('kategoris', 'makanans', 'selectedKategori' , 'mitras'));
    }

    public function detailmakanan($id)
    {
        $makanan = Makanan::with('kategoris', 'mitra', 'ulasan')->findOrFail($id);

        $makanan->average_rating = $makanan->ulasan->isNotEmpty() ? number_format($makanan->ulasan->avg('rating'), 1) : 0;
        $makanan->rating_count = $makanan->ulasan->count();

        if($this->agent->isMobile()){
            return view('user-mobile.detail-makanan', compact('makanan'));
        }
    }

    public function semuamakananmobile($kategoriId = null)
    {
        $userKota = session('user_kota'); // Ambil kota dari session
        $userLat = session('user_latitude'); // latitude user yang sudah disimpan
        $userLon = session('user_longitude'); // longitude user yang sudah disimpan

        $kategoris = Kategori::all();
        $mitras = Mitra::all();
        $selectedKategori = $kategoriId ? Kategori::findOrFail($kategoriId) : null;

        $ambilmakanan = $this->getProcessedMakanans($userKota, $userLat, $userLon);

        $makanans = $ambilmakanan->filter(function ($makanan) use ($kategoriId) {
            return $kategoriId ? $makanan->kategoris_id == $kategoriId :true;
        });
        return view('user-mobile.makanan', compact('makanans', 'kategoris', 'mitras', 'selectedKategori'));
    }


    public function userTransactions()
    {

        $transaksis= Transaksi::with('makanan', 'mitra')
                        ->where('user_id', auth()->id())
                        // ->whereDoesntHave('reviews') // Filter transaksi yang belum di-review
                        ->where('status_pembayaran', 'sudah dibayar')
                        ->latest()
                        ->get()
                        ->sortBy(function ($transaksi) {
                            // Urutkan berdasarkan ada tidaknya review (yang belum di-review berada di atas)
                            return $transaksi->ulasan ? 0 : 1;
                        })
                        ->sortBy('status')
                        ->reverse();

        return view('user.transaksi', compact('transaksis'));
    }

    public function update(Request $request, $id)
    {
        if($this->agent->isMobile()){
            try {
                $transaksi = Transaksi::findOrFail($id);
                $transaksi->update(['status' => 'Selesai']);
                $user = $transaksi->user; // pastikan relasi user() ada di model Transaksi

                // Misal kolom nominal di transaksi bernama 'total'
                $poinTambahan = floor($transaksi->total_harga / 1000); // 1 poin per 1000 rupiah
                $user->point += $poinTambahan;
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Pesanan berhasil diselesaikan'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyelesaikan pesanan'
                ], 500);
            }
        }
        $transaksi = Transaksi::findOrFail($id);

        // Hanya update jika status sebelumnya bukan 'Selesai'
        if ($transaksi->status !== 'Selesai') {
            $transaksi->status = 'Selesai';
            $transaksi->save();

            // Tambahkan poin ke user berdasarkan total transaksi
            $user = $transaksi->user; // pastikan relasi user() ada di model Transaksi

            // Misal kolom nominal di transaksi bernama 'total'
            $poinTambahan = floor($transaksi->total_harga / 1000); // 1 poin per 1000 rupiah
            $user->point += $poinTambahan;
            $user->save();
        }

        return redirect()->back()->with('success', 'Status pesanan diperbarui dan poin diberikan.');
    }

    public function rate(Request $request, $id)
    {
        // Validasi input rating dan review
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        // Menyimpan data rating dan review ke tabel reviews
        $review = new Review();
        $review->makanan_id = $id;  // Menggunakan food_id sesuai dengan ID transaksi atau produk
        $review->user_id = auth()->id();  // Menggunakan user yang sedang login
        $review->rating = $validated['rating'];
        $review->comment = $validated['review'];
        $review->save();

        // Respons sukses
        return response()->json(['success' => 'Rating dan Review berhasil disimpan']);
    }

}
