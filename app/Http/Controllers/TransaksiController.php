<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;
use App\Models\Makanan;

class TransaksiController extends Controller
{

    public function tampilkantransaksi($id)
    {
        $transaksi = Transaksi::findOrFail($id);
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
            'status' => 'Proses',
            'status_pembayaran' => 'Belum dibayar',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

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
        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaksi->snap_token = $snapToken;
        $transaksi->save();


        return redirect()->route('transaksi.show', $transaksi->id);
    }

    public function transaksi()
    {
        $transaksis = Transaksi::all()
            ->where('user_id', auth()->id())
            ->where('status_pembayaran', 'belum dibayar');


        return view('user.transaksi.transaksiberlangsung', compact('transaksis'));
    }
    public function semuatransaksi()
    {
        $transaksis = Transaksi::all()
            ->where('user_id', auth()->id())
            ->where('status_pembayaran', '!=', 'belum dibayar');


        return view('user.transaksi.riwayattransaksi', compact('transaksis'));
    }
}
