<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Ulasan;
use App\Models\Transaksi;


class ReviewController extends Controller
{
        protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }
    /**
     * Menyimpan rating dan review untuk suatu transaksi atau produk
     */
    public function index()
    {
        // if($this->agent->isMobile()){

        //     $ulasans = Ulasan::where('user_id', auth()->id());
        //     return view('user-mobile.review', compact('ulasans'));
        // }
        // Mengambil semua review untuk pengguna yang sedang login
        $ulasans = Ulasan::where('user_id', auth()->id())->paginate(10);

        return view('user.review', compact('ulasans'));
    }

    public function create($id)
    {
        if ($this->agent->isMobile()) {
        $transaksi = Transaksi::findOrFail($id);

        // Cari ulasan yang sudah ada
        $existingUlasan = Ulasan::where('transaksi_id', $id)
                            ->where('user_id', auth()->id()) // atau sesuai logic Anda
                            ->first();

        // dd($transaksi);
        return view('user-mobile.rating', compact('transaksi', 'existingUlasan'));
        }
    }
    public function rate(Request $request, $id)
    {

        if ($this->agent->isMobile()) {
            $request->validate([
            'rating' => 'required|integer|between:1,5',
            'komen' => 'required|string|max:1000',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah sudah ada ulasan sebelumnya
        $existingUlasan = Ulasan::where('transaksi_id', $id)
                                ->where('user_id', auth()->id())
                                ->first();

        if ($existingUlasan) {
            // Update ulasan yang sudah ada
            $existingUlasan->update([
                'rating' => $request->rating,
                'komen' => $request->komen,
                'updated_at' => now()
            ]);

            return redirect()->back()->with('success', 'Ulasan berhasil diperbarui!');
        } else {
            // Buat ulasan baru
            Ulasan::create([
                'transaksi_id' => $id,
                'user_id' => auth()->id(),
                'rating' => $request->rating,
                'komen' => $request->komen,
            ]);

            return redirect()->back()->with('success', 'Ulasan berhasil disimpan!');
        }
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komen' => 'required|string',
        ]);

        $transaksi = Transaksi::findOrFail($id);

        Ulasan::create([
            'makanan_id' => $transaksi->makanan_id, // Pastikan ini ada di tabel transaksi
            'user_id' => auth()->id(),
            'transaksi_id' => $transaksi->id, // Pastikan transaction_id dimasukkan
            'rating' => $request->rating,
            'komen' => $request->komen,
        ]);

        return back()->with('success', 'Rating dan Review berhasil disimpan');
    }

    public function update(Request $request, $id)
    {
        // Validasi data yang akan diupdate (rating dan comment)
        // dd($request->all());  // Debugging untuk melihat data yang dikirim melalui form

        $ulasan = Ulasan::findOrFail($id);

        // Validasi input dari form
        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',  // Rating harus antara 1 dan 5
            'komen' => 'nullable|string|max:1000',     // Comment bisa null atau maksimal 1000 karakter
        ]);

        // Update hanya rating dan comment
        $review->update([
            'rating' => $validated['rating'], // Update rating
            'komen' => $request->input('komen'),   // Update comment
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('review')->with('success', 'Review updated successfully!');
    }




}
