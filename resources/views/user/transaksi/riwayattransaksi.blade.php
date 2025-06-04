@extends('layouts.transaksi')

@section('content')


<div class="md:w-3/4 p-4 ">

    <!-- Riwayat Transaksi Section -->
    <div id="history-transactions" class="transaction-section space-y-6">
        @forelse($transaksis as $transaksi) {{-- Assuming you'll pass $historyTransactions from controller --}}
            @if ($transaksi->status_pembayaran == 'gagal')
            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-orange-500">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                    <div class="mb-4 sm:mb-0">
                        <p class="text-sm font-semibold text-orange-600">
                            ID Transaksi: #{{ $transaksi->order_id }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Tanggal: {{ $transaksi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-orange-100 text-orange-700 text-sm font-medium rounded-full">
                        Status: {{ ucfirst($transaksi->status_pembayaran) }}
                    </span>
                </div>
                {{-- Placeholder for transaction items --}}

                    <div class="mb-4">
                        <h4 class="text-md font-semibold text-gray-700 mb-2">Item:</h4>
                        <div class="list-disc list-inside text-gray-600 text-sm">
                                <div> {{ $transaksi->makanan->nama }}</div>
                        </div>
                    </div>
                <div class="flex flex-col sm:flex-row justify-between items-center mt-4 pt-4 border-t border-gray-200">
                    <span class="text-lg font-bold text-orange-600 mb-2 sm:mb-0">Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    <div class="flex space-x-3">
                        {{-- @if ($transaksi->status == 'pending')
                            <a href="{{ route('transaksi-semua') }}" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition duration-200 text-sm">Batalkan</a>
                        @endif --}}
                        @if ($transaksi->status_pembayaran != 'gagal')

                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 text-sm">Detail</a>
                        @endif
                    </div>
                </div>
            </div>
            @else

            <div class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-green-500">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-4">
                    <div class="mb-4 sm:mb-0">
                        <p class="text-sm font-semibold text-green-600">
                            ID Transaksi: #{{ $transaksi->order_id }}
                        </p>
                        <p class="text-xs text-gray-500">
                            Tanggal: {{ $transaksi->created_at->format('d M Y, H:i') }}
                        </p>
                    </div>
                    <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                        Status: {{ ucfirst($transaksi->status) }}
                    </span>
                </div>
                {{-- Placeholder for transaction items --}}
                <div class="mb-4">
                    <h4 class="text-md font-semibold text-gray-700 mb-2">Item:</h4>
                    <div class="list-disc list-inside text-gray-600 text-sm">
                            <div> {{ $transaksi->makanan->nama }}</div>
                    </div>
                </div>
                <div class="flex flex-col sm:flex-row justify-between items-center mt-4 pt-4 border-t border-gray-200">
                    <span class="text-lg font-bold text-gray-700 mb-2 sm:mb-0">Total: Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</span>
                    <div class="flex space-x-3">
                        <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 text-sm">Detail</a>

                        {{-- You can add a 'Review' button here if applicable --}}
                        {{-- <a href="#" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600 transition duration-200 text-sm">Ulas</a> --}}
                    </div>
                </div>
            </div>
            @endif
        @empty
            <div class="bg-white shadow-lg rounded-xl p-6 text-center">
                <p class="text-gray-600">Tidak ada riwayat transaksi.</p>
            </div>
        @endforelse
    </div>
</div>

@endsection
