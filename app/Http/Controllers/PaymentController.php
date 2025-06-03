<?php

namespace App\Http\Controllers;

// use Midtrans\Transaction;
use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class PaymentController extends Controller
{
    public function callback(Request $request)
{
    \Log::info('Midtrans Callback:', $request->all());

    $serverKey = config('midtrans.server_key');

    $orderId = $request->input('order_id');
    $statusCode = $request->input('status_code');
    $grossAmount = $request->input('gross_amount');
    $signatureKey = $request->input('signature_key');

    if (!$orderId || !$statusCode || !$grossAmount || !$signatureKey) {
        return response()->json(['message' => 'Data tidak lengkap'], 400);
    }

    $hashed = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

    if ($hashed !== $signatureKey) {
        return response()->json(['message' => 'Invalid signature'], 403);
    }

    $transaksi = Transaksi::where('order_id', $orderId)->first();

    if (!$transaksi) {
        return response()->json(['message' => 'Transaksi tidak ditemukan'], 404);
    }

    if ($transaksi->status_pembayaran === 'sudah dibayar') {
        return response()->json(['message' => 'Transaksi sudah dibayar']);
    }

    $transactionStatus = $request->input('transaction_status');
    $fraudStatus = $request->input('fraud_status');
    $paymentType = $request->input('payment_type');

    switch ($transactionStatus) {
        case 'capture':
            if ($paymentType == 'credit_card') {
                if ($fraudStatus == 'challenge') {
                    $transaksi->status_pembayaran = 'proses';
                } else {
                    $transaksi->status_pembayaran = 'sudah dibayar';

                }
            }
            break;
        case 'settlement':
            $transaksi->status_pembayaran = 'sudah dibayar';
            break;
        case 'pending':
            $transaksi->status_pembayaran = 'belum dibayar';
            break;
        case 'deny':
        case 'expire':
            $transaksi->status_pembayaran = 'gagal';
            break;
        case 'cancel':
            $transaksi->status_pembayaran = 'dibatalkan';
            break;
    }

    $transaksi->save();

    return response()->json(['message' => 'Callback diproses']);
}

}
