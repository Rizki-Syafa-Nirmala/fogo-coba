@extends('layouts.page')

@section('content-user-mobile')
<div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col pb-4">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-30">
        <div class="max-w-md mx-auto px-4 py-3 flex items-center gap-4">
            <a  href="{{ url()->previous() != url()->current() ? url()->previous() : route('foods') }}"
                aria-label="Kembali"
                onclick="window.history.back()"
                class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors"
            >
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-lg font-semibold flex-1 text-center text-gray-900">Detail Transaksi</h1>
            <!-- Invisible spacer to balance the layout -->
            <div class="w-10 h-10"></div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-md mx-auto w-full py-4 px-2 space-y-4">


        @if ($transaksi->status === 'siap ambil')

        <!-- Alert Catatan -->
        <div class="flex items-center p-4 mb-4 text-sm text-blue-800 border border-blue-300 rounded-lg bg-blue-50" role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
            </svg>
            <div>
                <span class="font-medium">Catatan Penting!</span> Mohon ambil pesanan tepat waktu sesuai jadwal yang telah ditentukan. Terima kasih sudah membantu mengurangi limbah makanan! 🌱
            </div>
        </div>
        @endif
        <!-- Informasi Transaksi -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900">Informasi Transaksi</h2>
            </div>
            <dl class="space-y-4">
                <div class="flex justify-between items-start">
                    <dt class="text-lg text-gray-600">ID Transaksi</dt>
                    <dd class="text-right font-mono text-sm bg-gray-50 px-2 py-1 rounded border">{{ $transaksi->order_id }}</dd>
                </div>
                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Tanggal & Waktu</dt>
                    <dd class="text-right text-gray-900">{{ $transaksi->created_at->format('d M Y, H:i') }}</dd>
                </div>
                @if ($transaksi->status != null)
                <div class="flex justify-between items-center">
                    <dt class="font-medium text-gray-600">Status</dt>
                    <dd>
                        @php
                            switch(strtolower($transaksi->status)) {
                                case 'proses':
                                    $bgColor = 'bg-yellow-100';
                                    $textColor = 'text-yellow-800';
                                    $dotColor = 'bg-yellow-500';
                                    break;
                                case 'selesai':
                                    $bgColor = 'bg-green-100';
                                    $textColor = 'text-green-800';
                                    $dotColor = 'bg-green-500';
                                    break;
                                case 'siap ambil':
                                    $bgColor = 'bg-green-100';
                                    $textColor = 'text-green-800';
                                    $dotColor = 'bg-green-500';
                                    break;
                                default:
                                    $bgColor = 'bg-gray-100';
                                    $textColor = 'text-gray-800';
                                    $dotColor = 'bg-gray-500';
                                    break;
                            }
                        @endphp


                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium {{ $bgColor }} {{ $textColor }}">
                            <span class="w-full h-2 {{ $dotColor }} rounded-full"></span>
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </dd>
                </div>
                @endif
                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Status Pembayaran</dt>
                    <dd class="text-right text-gray-900">{{ $transaksi->status_pembayaran }}</dd>
                </div>
            </dl>
        </div>

        <!-- Informasi Pengambilan -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Pengambilan Pesanan</h3>
            </div>
            <dl class="space-y-4">
                {{-- <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Waktu Pengambilan</dt>
                    <dd class="text-right text-gray-900">15 Juni 2024<br><span class="text-sm text-gray-500">16:00 - 17:00 WIB</span></dd>
                </div> --}}
                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Lokasi</dt>
                    <dd class="text-right text-gray-900 max-w-[60%]">
                        {{ $transaksi->mitra->name }}<br>
                        <span class="text-sm text-gray-500">{{ $transaksi->mitra->alamat }}</span>
                    </dd>
                </div>
            </dl>
        </div>

        @if ( auth()->user()->poin > 0 && $transaksi->status_pembayaran === 'belum dibayar')
        <!-- Penggunaan Poin -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                    <div>
                        <label for="usePoints" class="text-gray-900 font-semibold text-base cursor-pointer block">Gunakan Poin</label>
                        <p class="text-sm text-gray-500">Poin anda: <span class="font-semibold text-blue-600">{{ Auth::user()->poin }}</span></p>
                    </div>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" id="usePoints" class="sr-only peer" onchange="togglePoints(this)">
                    <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                </label>
            </div>
        </div>
        @endif

        <!-- Detail Pesanan -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-6">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900">Detail Pesanan</h2>
            </div>

            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-500">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                        <tr>
                            <th scope="col" class="px-4 py-3">Nama Produk</th>
                            <th scope="col" class="px-4 py-3 text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="bg-white border-b hover:bg-gray-50">
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $transaksi->makanan->nama }}</td>
                            <td class="px-4 py-3 text-right text-gray-700">RP. {{ number_format($transaksi->makanan->harga, 0, ',', '.') }}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="font-semibold text-gray-900 bg-gray-50">
                            <th scope="row" class="px-4 py-3 text-base">Total Harga</th>
                            <td class="px-4 py-3 text-right">
                                <span id="totalPrice" class="text-lg font-bold text-blue-600">RP. {{ number_format($transaksi->makanan->harga, 0, ',', '.') }}</span>
                                <div id="discountInfo" class="hidden text-sm text-green-600 mt-1">
                                    <div>Subtotal: Rp 40.000</div>
                                    <div>Diskon Poin: -Rp 12.500</div>
                                    <div class="border-t pt-1 font-semibold">Total: <span id="finalTotal">Rp 27.500</span></div>
                                </div>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>


        @if ($transaksi->status_pembayaran !== 'sudah dibayar')
        <!-- Action Button -->
        <div class="pt-1">
            <a  href="{{ route('mobile.bayar', $transaksi->id) }}"
                type="button"
                class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center inline-flex items-center justify-center gap-2 transition-colors"
            >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                </svg>
                Bayar Sekarang
            </a>
        </div>
        @endif
    </main>

    {{-- <!-- Footer -->
    <footer class="bg-white border-t border-gray-100 mt-10 py-6 text-center max-w-md mx-auto w-full">
        <p class="text-gray-500 text-sm">
            &copy; 2024 Aplikasi Makanan Sisa Produksi
        </p>
    </footer> --}}
</div>

<script>
function togglePoints(checkbox) {
    const totalPriceElement = document.getElementById('totalPrice');
    const discountInfo = document.getElementById('discountInfo');
    const originalTotal = 40000;
    const pointsDiscount = 12500;

    if (checkbox.checked) {
        const newTotal = Math.max(0, originalTotal - pointsDiscount);
        totalPriceElement.textContent = `Rp ${newTotal.toLocaleString('id-ID')}`;
        totalPriceElement.classList.remove('text-blue-600');
        totalPriceElement.classList.add('text-green-600');

        // Show discount breakdown
        discountInfo.classList.remove('hidden');
        document.getElementById('finalTotal').textContent = `Rp ${newTotal.toLocaleString('id-ID')}`;
    } else {
        totalPriceElement.textContent = `Rp ${originalTotal.toLocaleString('id-ID')}`;
        totalPriceElement.classList.remove('text-green-600');
        totalPriceElement.classList.add('text-blue-600');

        // Hide discount breakdown
        discountInfo.classList.add('hidden');
    }
}

function processPayment() {
    const usePoints = document.getElementById('usePoints').checked;
    const pointsText = usePoints ? ' dengan menggunakan poin' : '';

    // Show loading state
    const button = event.target;
    const originalText = button.innerHTML;
    button.disabled = true;
    button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Memproses Pembayaran...
    `;

    // Simulate payment process
    setTimeout(() => {
        alert(`Proses pembayaran${pointsText} sedang diproses...`);
        button.disabled = false;
        button.innerHTML = originalText;

        // Redirect ke halaman pembayaran jika diperlukan
        // window.location.href = '/payment/process';
    }, 2000);
}
</script>

@if ($transaksi->status_pembayaran == 'belum dibayar')

    @if ($snapToken != null)
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{config('midtrans.client_key')}}">
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        console.log("Pembayaran sukses", result);
                        window.location.href = '{{ route('transaksi') }}'; // arahkan ke halaman sukses kamu
                    },
                    onPending: function(result){
                        console.log("Pembayaran pending", result);
                    },
                    onError: function(result){
                        console.log("Pembayaran error", result);
                        alert("Terjadi kesalahan saat pembayaran");
                    },
                    onClose: function(){
                        console.log('Popup ditutup oleh pengguna');
                    }
                });
        });
    </script>
    @endif
@endif
@endsection
