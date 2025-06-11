<?php

namespace App\Http\Controllers;

use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Makanan;

class TransaksiController extends Controller
{

    protected $agent;

    public function __construct()
    {
        $this->agent = new Agent();
    }

    public function tampilkantransaksi($id)
    {

        $transaksi = Transaksi::findOrFail($id);
        if (!$transaksi) {
        abort(404, 'Transaksi tidak ditemukan');
        }
        // Cek apakah transaksi milik user yang sedang login
        if ($transaksi->user_id !== auth()->id()) {
            return redirect()->route('foods');
        }
        $snapToken = $transaksi->snap_token;

        return view('user.order', compact('transaksi', 'snapToken'));
    }

    public function buattransaksi(Request $request)
    {
        // dd($request->all());
        $makanan = Makanan::findOrFail($request->makanan_id);

        $mitraId = $makanan->mitra_id;

        $orderId = 'ORDER-' . uniqid();

        $transaksi = Transaksi::create([
            'order_id' => $orderId,
            'user_id' => auth()->id(),
            'makanan_id' => $makanan->id,
            'mitra_id' => $mitraId,
            'total_harga' => $makanan->harga,
            'status_pembayaran' => 'Belum dibayar',
        ]);

        $transaksi->save();


        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function bayar($id)
    {
        $transaksi = Transaksi::findOrFail($id);

        // Cek apakah transaksi milik user yang sedang login
        if ($transaksi->user_id !== auth()->id()) {
            return redirect()->route('foods');
        }

        if ($transaksi->status_pembayaran === 'sudah dibayar') {
            return redirect()->route('transaksi.show', $transaksi->id);
        }else {
            if (!$transaksi->snap_token) {
                // Set konfigurasi Midtrans
                \Midtrans\Config::$serverKey = config('midtrans.server_key');
                \Midtrans\Config::$isProduction = false;
                \Midtrans\Config::$isSanitized = true;
                \Midtrans\Config::$is3ds = true;

                // Parameter untuk Midtrans
                $params = [
                    'transaction_details' => [
                        'order_id' => $transaksi->order_id,
                        'gross_amount' => $transaksi->total_harga,
                    ],
                    'customer_details' => [
                        'first_name' => $transaksi->user->name,
                        'email' => $transaksi->user->email,
                        'phone' => $transaksi->user->no_telp,
                    ],
                ];

                // Buat Snap Token dan simpan
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                $transaksi->snap_token = $snapToken;
                $transaksi->save();
            } else {
                $snapToken = $transaksi->snap_token;
            }

        }

        // Kirim ke view
        return view('user.order', [
            'transaksi' => $transaksi,
            'snapToken' => $snapToken
        ]);
    }


    public function transaksi()
    {

        if ($this->agent->isMobile()) {
            $transaksis = Transaksi::where('user_id', auth()->id())
                ->where(function ($query) {
                    $query->where('status', '!=', 'selesai')
                        ->orWhereNull('status');
                })
                ->orderByRaw("FIELD(status_pembayaran, 'belum dibayar', 'proses', 'sudah dibayar', 'gagal', 'dibatalkan')")
                ->get();
            return view('user-mobile.order', compact('transaksis'));

        }
            $transaksis = Transaksi::where('user_id', auth()->id())
            ->where('status_pembayaran', 'belum dibayar');


        return view('user.transaksi.transaksiberlangsung', compact('transaksis'));
    }

    public function ajaxStatus()
    {
        $transaksis = Transaksi::where('user_id', auth()->id())->get(['id', 'status', 'status_pembayaran']);
        return response()->json($transaksis);
    }
    public function semuatransaksi()
    {

        if($this->agent->isMobile()){
            $transaksis = Transaksi::where('user_id', auth()->id())
            ->where('status', 'selesai')
            ->get();

            return view('user-mobile.order', compact('transaksis'));
        }
        $transaksis = Transaksi::all()
            ->where('user_id', auth()->id())
            ->where('status_pembayaran', '!=', 'belum dibayar');


        return view('user.transaksi.riwayattransaksi', compact('transaksis'));
    }
    public function hitungPotongan(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $user = auth()->user();
        $gunakanPoin = $request->input('point') == 1;

        $harga = $transaksi->makanan->harga;

        // Cek apakah sebelumnya pakai poin
        $sebelumnyaGunakanPoin = $transaksi->point;

        if ($gunakanPoin) {
            // Hitung potongan maksimal
            $maksPotongan = $user->point * 100;
            $potongan = min($harga, $maksPotongan);
            $poinTerpakai = floor($potongan / 100);

            // Simpan potongan dan kurangi poin user
            $transaksi->total_harga = $harga - $potongan;
            $transaksi->point = true;

            $user->point -= $poinTerpakai;
            $user->save();
        } else {
            // Jika sebelumnya pakai poin, kembalikan poin ke user
            if ($sebelumnyaGunakanPoin) {
                $potonganSebelumnya = $harga - $transaksi->total_harga;
                $poinYangDipakai = floor($potonganSebelumnya / 100);

                $user->point += $poinYangDipakai;
                $user->save();
            }

            // Reset ke harga asli
            $transaksi->total_harga = $harga;
            $transaksi->point = false;
        }

        $transaksi->save();

        return redirect()
            ->route('transaksi.show', $transaksi->id)
            ->with('success', 'Penggunaan poin berhasil diperbarui.');
    }



}
