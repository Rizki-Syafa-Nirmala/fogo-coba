@extends('layouts.page')

@section('content-user-mobile')
<div class="bg-gray-50 text-gray-800 font-sans min-h-screen flex flex-col pb-4">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-30">
        <div class="max-w-md mx-auto px-4 py-3 flex items-center gap-4">
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('mobile.transaksiberlangsung') }}"
               aria-label="Kembali"
               class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-500 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-lg font-semibold flex-1 text-center text-gray-900">Detail Transaksi</h1>
            <div class="w-10 h-10"></div> <!-- Spacer for layout balance -->
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow max-w-md mx-auto w-full py-4 px-2 space-y-4">
        <!-- Status Alerts -->
        @include('components.transaksi-alerts', ['transaksi' => $transaksi])

        <!-- Transaction Information -->
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
                    <dd class="text-right font-mono text-sm bg-gray-50 px-2 py-1 rounded border">
                        {{ $transaksi->order_id }}
                    </dd>
                </div>

                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Tanggal & Waktu</dt>
                    <dd class="text-right text-gray-900">
                        {{ $transaksi->created_at->format('d M Y, H:i') }}
                    </dd>
                </div>

                @if (!empty($transaksi->status))
                <div class="flex justify-between items-center">
                    <dt class="font-medium text-gray-600">Status</dt>
                    <dd>
                        @php
                            $statusClasses = [
                                'proses' => [
                                    'bg' => 'bg-yellow-100',
                                    'text' => 'text-yellow-800',
                                    'dot' => 'bg-yellow-500'
                                ],
                                'selesai' => [
                                    'bg' => 'bg-green-100',
                                    'text' => 'text-green-800',
                                    'dot' => 'bg-green-500'
                                ],
                                'siap ambil' => [
                                    'bg' => 'bg-blue-100',
                                    'text' => 'text-blue-800',
                                    'dot' => 'bg-blue-500'
                                ],
                                'default' => [
                                    'bg' => 'bg-gray-100',
                                    'text' => 'text-gray-800',
                                    'dot' => 'bg-gray-500'
                                ]
                            ];

                            $status = strtolower($transaksi->status);
                            $classes = $statusClasses[$status] ?? $statusClasses['default'];
                        @endphp

                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium {{ $classes['bg'] }} {{ $classes['text'] }}">
                            <span class="w-2 h-2 {{ $classes['dot'] }} rounded-full"></span>
                            {{ ucfirst($transaksi->status) }}
                        </span>
                    </dd>
                </div>
                @endif

                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Status Pembayaran</dt>
                    <dd class="text-right">
                        @php
                            $paymentStatusClasses = [
                                'sudah dibayar' => 'text-green-700 bg-green-100 px-2 py-1 rounded-full text-xs font-medium',
                                'belum dibayar' => 'text-red-700 bg-red-100 px-2 py-1 rounded-full text-xs font-medium',
                                'default' => 'text-gray-900'
                            ];

                            $paymentStatus = strtolower($transaksi->status_pembayaran);
                            $paymentClass = $paymentStatusClasses[$paymentStatus] ?? $paymentStatusClasses['default'];
                        @endphp

                        <span class="{{ $paymentClass }}">
                            {{ ucfirst($transaksi->status_pembayaran) }}
                        </span>
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Pickup Information -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Pengambilan Pesanan</h3>
            </div>

            <dl class="space-y-4">
                <div class="flex justify-between items-start">
                    <dt class="font-medium text-gray-600">Lokasi</dt>
                    <dd class="text-right text-gray-900 max-w-[60%]">
                        <div class="font-medium">{{ $transaksi->mitra->name }}</div>
                        <div class="text-sm text-gray-500 mt-1">{{ $transaksi->mitra->alamat }}</div>
                    </dd>
                </div>
            </dl>
        </div>

        <!-- Points Usage Form -->
        @if (empty($transaksi->snap_token) && ($transaksi->point || auth()->user()->point > 0))
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <form id="form-poin" action="{{ route('mobile.hitungPotongan', $transaksi->id) }}" method="POST">
                @csrf
                <input type="hidden" name="point" value="0">

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <div>
                            <div class="font-medium text-gray-900">Gunakan Poin</div>
                            <div class="text-sm text-gray-500">Poin tersedia: {{ number_format(auth()->user()->point, 0, ',', '.') }}</div>
                        </div>
                    </div>

                    <label class="inline-flex items-center cursor-pointer">
                        <input type="checkbox"
                               name="point"
                               value="1"
                               {{ old('point', $transaksi->point) ? 'checked' : '' }}
                               class="sr-only peer"
                               onchange="document.getElementById('form-poin').submit();">
                        <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                    </label>
                </div>
            </form>
        </div>
        @endif

        <!-- Order Details -->
        <div class="bg-white border border-gray-200 rounded-lg shadow-sm p-4">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                </svg>
                <h2 class="text-lg font-semibold text-gray-900">Detail Pesanan</h2>
            </div>

            <div class="space-y-4">
                <!-- Product Item -->
                <div class="flex justify-between items-center py-3 border-b border-gray-100">
                    <div class="flex-1">
                        <h4 class="font-medium text-gray-900">{{ $transaksi->makanan->nama }}</h4>
                        <p class="text-sm text-gray-500 mt-1">Harga satuan</p>
                    </div>
                    <div class="text-right">
                        <span class="font-medium text-gray-900">
                            Rp {{ number_format($transaksi->makanan->harga, 0, ',', '.') }}
                        </span>
                    </div>
                </div>

                <!-- Pricing Summary -->
                <div class="space-y-3 pt-2">
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500">Harga Makanan</dt>
                        <dd class="text-base font-medium text-[#1e293b]">Rp.{{ number_format($transaksi->makanan->harga) }}</dd>
                    </dl>

                    @if ($transaksi->point === 1)
                    <dl class="flex items-center justify-between gap-4">
                        <dt class="text-gray-500">Diskon Poin</dt>
                        <dd class="text-base font-medium text-red-400">-Rp.{{ number_format($transaksi->makanan->harga - $transaksi->total_harga) }}</dd>
                    </dl>
                    @endif

                    <div class="border-t border-gray-200 pt-3">
                        <dl class="flex items-center justify-between gap-4">
                            <dt class="text-lg font-semibold text-gray-900">Total</dt>
                            <dd class="text-lg font-bold text-blue-600">
                                Rp.{{ number_format($transaksi->total_harga ?? $transaksi->makanan->harga) }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        @if ($transaksi->status_pembayaran !== 'sudah dibayar' )
            <div class="pt-2">
                @if(empty($transaksi->snap_token) && ($transaksi->point == 0 || auth()->user()->point > 0))
                    <!-- Tombol trigger modal -->
                    <button
                        onclick="openModal()"
                        class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center inline-flex items-center justify-center gap-2 transition-colors shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Lakukan Pembayaran
                    </button>
                @else
                    <a href="{{ route('mobile.bayar', $transaksi->id) }}"
                    class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 text-center inline-flex items-center justify-center gap-2 transition-colors shadow-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Bayar Sekarang
                    </a>
                @endif
            </div>
        @endif

        <!-- Modal konfirmasi pembayaran -->
        <div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
            <div class="bg-white rounded-lg mx-4 w-full max-w-sm">
                <div class="p-6">
                    <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full mb-4">
                        <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-sm text-gray-600 text-center mb-6">
                        Anda memilih untuk tidak menggunakan poin dalam pembayaran ini. Setelah melanjutkan, transaksi tidak dapat dibatalkan atau diubah. Lanjutkan sekarang?
                    </p>
                    <div class="flex space-x-3">
                        <button
                            onclick="closeModal()"
                            class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                            Batal
                        </button>
                        <a href="{{ route('mobile.bayar', $transaksi->id) }}"
                        class="flex-1 text-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                            Lanjutkan
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>
</div>

<script>
    function openModal() {
        document.getElementById('paymentModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }
</script>

<!-- Midtrans Payment Script -->
@if ($transaksi->status_pembayaran == 'belum dibayar' && !empty($snapToken))
<script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}">
</script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        window.snap.pay('{{ $snapToken }}', {
            onSuccess: function(result) {
                console.log("Pembayaran sukses", result);
                window.location.href = '{{ route('transaksi') }}';
            },
            onPending: function(result) {
                console.log("Pembayaran pending", result);
                alert("Pembayaran sedang diproses. Silakan cek status pembayaran Anda.");
            },
            onError: function(result) {
                console.log("Pembayaran error", result);
                alert("Terjadi kesalahan saat pembayaran. Silakan coba lagi.");
            },
            onClose: function() {
                console.log('Popup pembayaran ditutup oleh pengguna');
            }
        });
    });
</script>
@endif
@endsection
