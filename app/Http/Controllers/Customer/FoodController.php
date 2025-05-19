<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Mitra;
use App\Models\Makanan;
use App\Models\Kategori;
use App\Http\Controllers\Controller;


class FoodController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori dan mitra untuk filter
        $kategoris = Kategori::all();
        $mitras = Mitra::all();
        // $review = Review::all();

        // $kategoris = $request->input('kategoris', []); // Ambil data kategori yang dipilih
        // $partner = $request->input('partner', []); // Ambil data restoran yang dipilih

        // Debug untuk mengecek apakah data diterima
        // dd($kategoris, $partner);


            // Ambil data food hanya yang berstatus 'available'
            $makanans = Makanan::with(['kategoris', 'mitra', 'ulasan'])
            ->where('tersedia', true) // Filter hanya yang tersedia
            ->when($request->has('kategoris'), function ($query) use ($request) {
                // Pastikan request kategoris adalah array
                if ($request->kategoris) {
                    $query->whereIn('kategoris_id', $request->kategoris); // Filter berdasarkan kategori
                }
            })
            ->when($request->has('mitra'), function ($query) use ($request) {
                // Pastikan request partner adalah array
                if ($request->mitra) {
                    $query->whereIn('mitra_id', $request->mitra); // Filter berdasarkan partner
                }
            })
            ->get()
            ->map(function ($makanan) {
                // Hitung rata-rata rating makanan
                $makanan->average_rating = $makanan->ulasan->isNotEmpty() ? number_format($makanan->ulasan->avg('rating'), 1) : 0;
                $makanan->rating_count = $makanan->ulasan->count();

             // Hitung jumlah review berdasarkan masing-masing rating
             $ratingCounts = [
                5 => $makanan->ulasan->where('rating', 5)->count(),
                4 => $makanan->ulasan->where('rating', 4)->count(),
                3 => $makanan->ulasan->where('rating', 3)->count(),
                2 => $makanan->ulasan->where('rating', 2)->count(),
                1 => $makanan->ulasan->where('rating', 1)->count(),
            ];

            // Hitung total review untuk persentase
            // Hitung jumlah masing-masing rating
            $makanan->rating_5 = $makanan->ulasan->where('rating', 5)->count();
            $makanan->rating_4 = $makanan->ulasan->where('rating', 4)->count();
            $makanan->rating_3 = $makanan->ulasan->where('rating', 3)->count();
            $makanan->rating_2 = $makanan->ulasan->where('rating', 2)->count();
            $makanan->rating_1 = $makanan->ulasan->where('rating', 1)->count();

            // Hitung persentase review per bintang
            $total_ulasan = $makanan->ulasan->count();
            $makanan->rating_5_percent = $total_ulasan > 0 ? ($makanan->rating_5 / $total_ulasan) * 100 : 0;
            $makanan->rating_4_percent = $total_ulasan > 0 ? ($makanan->rating_4 / $total_ulasan) * 100 : 0;
            $makanan->rating_3_percent = $total_ulasan > 0 ? ($makanan->rating_3 / $total_ulasan) * 100 : 0;
            $makanan->rating_2_percent = $total_ulasan > 0 ? ($makanan->rating_2 / $total_ulasan) * 100 : 0;
            $makanan->rating_1_percent = $total_ulasan > 0 ? ($makanan->rating_1 / $total_ulasan) * 100 : 0;

            return $makanan;
            });




        return view('user.food', compact('makanans', 'kategoris', 'mitras'));
    }

    public function storeTransaction(Request $request)
    {
        $makanan = Makanan::findOrFail($request->makanan_id);

        $mitraId = $makanan->mitra_id;


        Transaksi::create([
            'user_id' => auth()->id(),
            'makanan_id' => $makanan->id,
            'mitra_id' => $mitraId,
            'total_harga' => $makanan->harga,
            'status' => 'Proses',
        ]);



        return redirect()->route('transaksi')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function userTransactions()
    {

        $transaksis = Transaksi::with('makanan', 'mitra')
                        ->where('user_id', auth()->id())
                        // ->whereDoesntHave('reviews') // Filter transaksi yang belum di-review
                        ->latest()
                        ->get()
                        ->sortBy(function ($transaksis) {
                            // Urutkan berdasarkan ada tidaknya review (yang belum di-review berada di atas)
                            return $transaksis->ulasan ? 0 : 1;
                        })
                        ->sortBy('status')
                        ->reverse();

        return view('user.transaksi', compact('transaksis'));
    }

    public function update(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Cek agar hanya update dari ready_for_pickup ke completed

            $transaksi->status = 'Selesai';
        $transaksi->save();



        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
    }

    public function rate(Request $request, $id)
    {
        // Validasi input rating dan review
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komen' => 'required|string|max:255',
        ]);

        // Menyimpan data rating dan review ke tabel reviews
        $ulasan = new Review();
        $ulasan->makanan_id = $id;  // Menggunakan food_id sesuai dengan ID transaksi atau produk
        $ulasan->user_id = auth()->id();  // Menggunakan user yang sedang login
        $ulasan->rating = $validated['rating'];
        $ulasan->komen = $validated['komen'];
        $review->save();

        // Respons sukses
        return response()->json(['success' => 'Rating dan Review berhasil disimpan']);
    }

}
