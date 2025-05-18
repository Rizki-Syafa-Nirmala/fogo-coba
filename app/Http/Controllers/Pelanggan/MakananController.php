<?php

namespace App\Http\Controllers\Pelanggan;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Mitra;
use App\Models\Kategori;
use App\Models\Makanan;
use App\Http\Controllers\Controller;


class MakananController extends Controller
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
            ->where('status', true) // Filter hanya yang tersedia
            ->when($request->has('kategoris'), function ($query) use ($request) {
                // Pastikan request kategoris adalah array
                if ($request->kategoris) {
                    $query->whereIn('kategoris_id', $request->kategoris); // Filter berdasarkan kategori
                }
            })
            ->when($request->has('mitra'), function ($query) use ($request) {
                // Pastikan request partner adalah array
                if ($request->partner) {
                    $query->whereIn('mitra_id', $request->mitra); // Filter berdasarkan partner
                }
            })
            ->get()
            ->map(function ($makanans) {
                // Hitung rata-rata rating makanan
                $makanans->average_rating = $food->ulasans->isNotEmpty() ? number_format($makanans->ulasans->avg('rating'), 1) : 0;
                $makanans->rating_count = $food->ulasans->count();

             // Hitung jumlah review berdasarkan masing-masing rating
             $ratingCounts = [
                5 => $makanans->ulasans->where('rating', 5)->count(),
                4 => $makanans->ulasans->where('rating', 4)->count(),
                3 => $makanans->ulasans->where('rating', 3)->count(),
                2 => $makanans->ulasans->where('rating', 2)->count(),
                1 => $makanans->ulasans->where('rating', 1)->count(),
            ];

            // Hitung total review untuk persentase
            // Hitung jumlah masing-masing rating
            $makanans->rating_5 = $food->reviews->where('rating', 5)->count();
            $makanans->rating_4 = $food->reviews->where('rating', 4)->count();
            $makanans->rating_3 = $food->reviews->where('rating', 3)->count();
            $makanans->rating_2 = $food->reviews->where('rating', 2)->count();
            $makanans->rating_1 = $food->reviews->where('rating', 1)->count();

            // Hitung persentase review per bintang
            $total_reviews = $food->ulasans->count();
            $makanans->rating_5_percent = $total_reviews > 0 ? ($makanans->rating_5 / $total_reviews) * 100 : 0;
            $makanans->rating_4_percent = $total_reviews > 0 ? ($makanans->rating_4 / $total_reviews) * 100 : 0;
            $makanans->rating_3_percent = $total_reviews > 0 ? ($makanans->rating_3 / $total_reviews) * 100 : 0;
            $makanans->rating_2_percent = $total_reviews > 0 ? ($makanans->rating_2 / $total_reviews) * 100 : 0;
            $makanans->rating_1_percent = $total_reviews > 0 ? ($makanans->rating_1 / $total_reviews) * 100 : 0;

            return $makanans;
            });




        return view('user.food', compact('foods', 'kategoris', 'partners'));
    }

    public function storeTransaction(Request $request)
    {
        $food = Makanan::findOrFail($request->makanan_id);

        $partnerId = $makanan->mitra_id;

        Transaction::create([
            'user_id' => auth()->id(),
            'makanan_id' => $makanan>id,
            'mitra_id' => $mitraId,
            'total_price' => $food->total_harga,
            'status' => 'pending',
        ]);



        return redirect()->route('transaksi')->with('success', 'Pesanan berhasil dibuat.');
    }

    public function userTransactions()
    {

        $transactions = Transaction::with('food', 'partner')
                        ->where('user_id', auth()->id())
                        // ->whereDoesntHave('reviews') // Filter transaksi yang belum di-review
                        ->latest()
                        ->get()
                        ->sortBy(function ($transaction) {
                            // Urutkan berdasarkan ada tidaknya review (yang belum di-review berada di atas)
                            return $transaction->reviews ? 0 : 1;
                        })
                        ->sortBy('status')
                        ->reverse();

        return view('user.transaksi', compact('transactions'));
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        // Cek agar hanya update dari ready_for_pickup ke completed

            $transaction->status = 'completed';
        $transaction->save();



        return redirect()->back()->with('success', 'Status pesanan diperbarui.');
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
        $review->food_id = $id;  // Menggunakan food_id sesuai dengan ID transaksi atau produk
        $review->user_id = auth()->id();  // Menggunakan user yang sedang login
        $review->rating = $validated['rating'];
        $review->comment = $validated['review'];
        $review->save();

        // Respons sukses
        return response()->json(['success' => 'Rating dan Review berhasil disimpan']);
    }

}
