<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Review;


class ReviewController extends Controller
{
    /**
     * Menyimpan rating dan review untuk suatu transaksi atau produk
     */
    public function index()
    {
        // Mengambil semua review untuk pengguna yang sedang login
        $reviews = Review::where('user_id', auth()->id())->get();

        return view('user.review', compact('reviews'));
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string',
        ]);

        $transaction = Transaction::findOrFail($id);

        Review::create([
            'food_id' => $transaction->food_id, // Pastikan ini ada di tabel transaksi
            'user_id' => auth()->id(),
            'transaction_id' => $transaction->id, // Pastikan transaction_id dimasukkan
            'rating' => $request->rating,
            'comment' => $request->review,
        ]);

        return back()->with('success', 'Rating dan Review berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate (rating dan comment)
        // dd($request->all());  // Debugging untuk melihat data yang dikirim melalui form

        $review = Review::findOrFail($id);

        // Validasi input dari form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',  // Rating harus antara 1 dan 5
            'comment' => 'nullable|string|max:1000',     // Comment bisa null atau maksimal 1000 karakter
        ]);

        // Update hanya rating dan comment
        $review->update([
            'rating' => $validated['rating'], // Update rating
            'comment' => $request->input('comment'),   // Update comment
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('review')->with('success', 'Review updated successfully!');
    }




}
