<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Partner;
use App\Models\Kategori;
use App\Models\Food;
use App\Http\Controllers\Controller;


class FoodController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori dan mitra untuk filter
        $kategoris = Kategori::all();
        $partners = Partner::all();
        // $review = Review::all();

        // $kategoris = $request->input('kategoris', []); // Ambil data kategori yang dipilih
        // $partner = $request->input('partner', []); // Ambil data restoran yang dipilih

        // Debug untuk mengecek apakah data diterima
        // dd($kategoris, $partner);


            // Ambil data food hanya yang berstatus 'available'
            $foods = Food::with(['kategoris', 'partner', 'reviews'])
            ->where('status', 'available') // Filter hanya yang tersedia
            ->when($request->has('kategoris'), function ($query) use ($request) {
                // Pastikan request kategoris adalah array
                if ($request->kategoris) {
                    $query->whereIn('kategoris_id', $request->kategoris); // Filter berdasarkan kategori
                }
            })
            ->when($request->has('partner'), function ($query) use ($request) {
                // Pastikan request partner adalah array
                if ($request->partner) {
                    $query->whereIn('partner_id', $request->partner); // Filter berdasarkan partner
                }
            })
            ->get()
            ->map(function ($food) {
                // Hitung rata-rata rating makanan
                $food->average_rating = $food->reviews->isNotEmpty() ? number_format($food->reviews->avg('rating'), 1) : 0;
                $food->rating_count = $food->reviews->count();

             // Hitung jumlah review berdasarkan masing-masing rating
             $ratingCounts = [
                5 => $food->reviews->where('rating', 5)->count(),
                4 => $food->reviews->where('rating', 4)->count(),
                3 => $food->reviews->where('rating', 3)->count(),
                2 => $food->reviews->where('rating', 2)->count(),
                1 => $food->reviews->where('rating', 1)->count(),
            ];

            // Hitung total review untuk persentase
            // Hitung jumlah masing-masing rating
            $food->rating_5 = $food->reviews->where('rating', 5)->count();
            $food->rating_4 = $food->reviews->where('rating', 4)->count();
            $food->rating_3 = $food->reviews->where('rating', 3)->count();
            $food->rating_2 = $food->reviews->where('rating', 2)->count();
            $food->rating_1 = $food->reviews->where('rating', 1)->count();

            // Hitung persentase review per bintang
            $total_reviews = $food->reviews->count();
            $food->rating_5_percent = $total_reviews > 0 ? ($food->rating_5 / $total_reviews) * 100 : 0;
            $food->rating_4_percent = $total_reviews > 0 ? ($food->rating_4 / $total_reviews) * 100 : 0;
            $food->rating_3_percent = $total_reviews > 0 ? ($food->rating_3 / $total_reviews) * 100 : 0;
            $food->rating_2_percent = $total_reviews > 0 ? ($food->rating_2 / $total_reviews) * 100 : 0;
            $food->rating_1_percent = $total_reviews > 0 ? ($food->rating_1 / $total_reviews) * 100 : 0;

            return $food;
            });




        return view('user.food', compact('foods', 'kategoris', 'partners'));
    }

    public function storeTransaction(Request $request)
    {
        $food = Food::findOrFail($request->food_id);

        $partnerId = $food->partner_id;

        Transaction::create([
            'user_id' => auth()->id(),
            'food_id' => $food->id,
            'partner_id' => $partnerId,
            'total_price' => $food->price,
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
