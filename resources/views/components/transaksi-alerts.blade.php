{{-- resources/views/components/transaction-alerts.blade.php --}}

@if ($transaksi->status === 'siap ambil')
<!-- Ready for Pickup Alert -->
<div class="flex items-start p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
    </svg>
    <div>
        <span class="font-medium">Pesanan Siap Diambil!</span>
        <div class="mt-1">
            Mohon ambil pesanan tepat waktu sesuai jadwal yang telah ditentukan. Terima kasih sudah membantu mengurangi limbah makanan! 🌱
        </div>
    </div>
</div>

@elseif (strtolower($transaksi->status) === 'selesai')
<!-- Completed Transaction Alert -->
<div class="flex items-start p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50" role="alert">
    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM13.854 6.854a.5.5 0 0 0-.708-.708L9 10.293 6.854 8.146a.5.5 0 1 0-.708.708l2.5 2.5a.5.5 0 0 0 .708 0l4.5-4.5Z"/>
    </svg>
    <div>
        <span class="font-medium">Transaksi Selesai!</span>
        <div class="mt-1">
            Terima kasih sudah membantu mengurangi limbah makanan! 🌱
        </div>
    </div>
</div>

@elseif ($transaksi->status_pembayaran === 'belum dibayar')
<!-- Payment Required Alert -->
<div class="flex items-start p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50" role="alert">
    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16Zm.93 6.829a.75.75 0 1 0-1.86-.378l-.292 1.445a.75.75 0 0 0 1.86.378L10.93 8.83ZM10 12.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
    </svg>
    <div>
        <span class="font-medium">Pembayaran Diperlukan!</span>
        <div class="mt-1">
            Mohon lakukan pembayaran agar pesanan dapat diproses. Terima kasih sudah membantu mengurangi limbah makanan! 🌱
        </div>
    </div>
</div>

@elseif ($transaksi->status === 'proses')
<!-- Processing Alert -->
<div class="flex items-start p-4 mb-4 text-sm text-yellow-800 border border-yellow-300 rounded-lg bg-yellow-50" role="alert">
    <svg class="flex-shrink-0 w-4 h-4 mt-0.5 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
        <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 2a8 8 0 1 1 0 16 8 8 0 0 1 0-16Zm.93 6.829a.75.75 0 1 0-1.86-.378l-.292 1.445a.75.75 0 0 0 1.86.378L10.93 8.83ZM10 12.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"/>
    </svg>
    <div>
        <span class="font-medium">Pesanan Sedang Diproses!</span>
        <div class="mt-1">
            Mohon menunggu, pesanan Anda sedang dipersiapkan. Terima kasih sudah membantu mengurangi limbah makanan! 🌱
        </div>
    </div>
</div>
@endif
