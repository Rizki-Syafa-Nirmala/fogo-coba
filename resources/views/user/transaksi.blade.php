@extends('layouts.page')

@section('content-user')

<section class="bg-gray-50 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-black-600">My Orders</h2>
            <div class="mt-4 sm:mt-0">
                <select id="duration" class="w-40 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option selected>this week</option>
                    <option value="this month">this month</option>
                    <option value="last 3 months">the last 3 months</option>
                    <option value="last 6 months">the last 6 months</option>
                    <option value="this year">this year</option>
                </select>
            </div>
        </div>

        <!-- List Orders -->
        <div class="space-y-6">
            @forelse($transaksis as $transaksi)
                @php
                    $statusColor = match($transaksi->status) {
                        'Proses' => 'bg-orange-200 text-orange-800',
                        'Siap ambil' => 'bg-yellow-200 text-yellow-800',
                        'Selesai' => 'bg-green-200 text-green-800',
                        default => 'bg-gray-200 text-gray-800'
                    };
                @endphp

                <div class="bg-white border border-gray-200 rounded-xl p-6 hover:shadow-md transition">
                    <div class="grid grid-cols-6 text-sm font-medium text-gray-500 border-b pb-3 mb-4">
                        <div class="col-span-1">Tanggal</div>
                        <div class="col-span-2">Order ID</div>
                        <div class="col-span-1">Harga</div>
                        <div class="col-span-1">Status</div>
                        <div class="col-span-1 text-right">Aksi</div>
                    </div>

                    <div class="grid grid-cols-6 text-sm text-gray-800 items-center gap-4 py-2">
                        <div class="col-span-1">{{ $transaksi->created_at->format('d/m/y H:i') }}</div>

                        <div class="col-span-2 text-blue-600 font-medium">
                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="hover:underline">
                                {{ $transaksi->order_id }}
                            </a>
                        </div>

                        <div class="col-span-1 font-semibold">
                            Rp {{ number_format($transaksi->total_harga, 0) }}
                        </div>

                        <div class="col-span-1">
                            <span class="inline-block px-3 py-1 text-sm font-semibold rounded-full {{ $statusColor }}">
                                {{ ucfirst($transaksi->status) }}
                            </span>
                        </div>

                        <div class="col-span-1 text-right flex justify-end items-center space-x-2">
                            @if($transaksi->status === 'Siap ambil')
                                <form action="{{ route('transactions.complete', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="rounded-lg bg-green-500 text-white px-3 py-1 text-sm hover:bg-green-600 transition">
                                        Selesai
                                    </button>
                                </form>
                            @endif

                            @if($transaksi->status === 'Selesai')
                                @if($transaksi->ulasan)
                                    <div class="flex items-center gap-0.5">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-4 h-4" fill="{{ $i <= $transaksi->ulasan->rating ? '#fbbf24' : '#e5e7eb' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                                            </svg>
                                        @endfor
                                    </div>
                                @else
                                    <button data-modal-target="ratingReviewModal{{ $transaksi->id }}" data-modal-toggle="ratingReviewModal{{ $transaksi->id }}" class="bg-orange-100 text-orange-800 px-3 py-1 rounded-lg text-sm hover:bg-orange-200 transition">
                                        Review
                                    </button>
                                @endif
                            @endif

                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-lg hover:bg-blue-600 text-sm transition">
                                Detail
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-400">Tidak ada transaksi yang tersedia.</p>
            @endforelse
        </div>
    </div>
</section>

@endsection
