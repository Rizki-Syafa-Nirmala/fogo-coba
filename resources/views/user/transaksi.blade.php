@extends('layouts.page')

@section('content-user')
<div class="bg-gray-50 py-8 antialiased md:py-16 min-h-screen">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-2xl font-bold text-orange-600 sm:text-3xl">My orders</h2>
                <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                    <div>
                        <label for="duration" class="sr-only mb-2 block text-sm font-medium text-orange-600">Select duration</label>
                        <select id="duration" class="block w-full rounded-lg border border-orange-200 bg-orange-50 p-2.5 text-sm text-orange-700 focus:border-orange-300 focus:ring-orange-200">
                                <option selected>this week</option>
                            <option value="this month">this month</option>
                            <option value="last 3 months">the last 3 months</option>
                            <option value="lats 6 months">the last 6 months</option>
                            <option value="this year">this year</option>
                        </select>
                    </div>
                </div>
            </div>

            @forelse($transaksis as $transaksi)
            @php
                $statusColor = match($transaksi->status) {
                    'Proses' => 'me-2 mt-1.5 inline-flex items-center rounded bg-orange-200 px-2.5 py-0.5 text-xs font-medium text-orange-800',
                    'Siap ambil' => 'me-2 mt-1.5 inline-flex items-center rounded bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-700',
                    'Selesai' => 'me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-green-800',
                    default => 'bg-gray-100 text-gray-800'
                };
            @endphp

            <div class="mt-6 flow-root sm:mt-8">
                <div class="divide-y divide-gray-200">
                    <div class="flex flex-wrap items-center gap-y-4 py-6">
                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-orange-400">Order ID:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900">
                                <a href="#" class="hover:underline">{{ $transaksi->order_id }}</a>
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-orange-400">Date:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900">{{ $transaksi->created_at->format('d M Y, H:i') }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-orange-400">Price:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900">Rp.{{ number_format($transaksi->total_harga, 2) }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-orange-400">Status:</dt>
                            <dd class="{{ $statusColor }}">
                                {{ ucfirst($transaksi->status) }}
                            </dd>
                        </dl>

                        <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">

                            @if($transaksi->status === 'Siap ambil')
                                <form action="{{ route('transactions.complete', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="w-full rounded-lg border border-green-200 px-3 py-2 text-center text-sm font-medium text-green-700 hover:bg-green-100 hover:text-green-900 focus:outline-none focus:ring-2 focus:ring-green-100 lg:w-auto">
                                        Pesanan Selesai
                                    </button>
                                </form>

                                @if(session('success'))
                                    <script>
                                        Swal.fire({
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: '{{ session('success') }}',
                                            confirmButtonColor: '#3085d6',
                                        });
                                    </script>
                                @endif
                            @endif

                            @if($transaksi->status == 'Selesai')
                                @if($transaksi->ulasan)
                                    <div class="flex gap-2 items-center">
                                        @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-5 h-5" fill="{{ $i <= $transaksi->ulasan->rating ? '#fbbf24' : '#e5e7eb' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path>
                                        </svg>
                                        @endfor
                                    </div>
                                @else
                                    <button data-modal-target="ratingReviewModal{{ $transaksi->id }}" data-modal-toggle="ratingReviewModal{{ $transaksi->id }}" class="px-4 py-2 bg-orange-200 text-orange-800 rounded-md hover:bg-orange-300">
                                        Beri Rating dan Review
                                    </button>
                                @endif

                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition duration-200 text-sm">Detail</a>

                            <div id="ratingReviewModal{{ $transaksi->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full mx-auto">
                                    <div class="relative bg-white rounded-lg shadow">
                                        <div class="flex items-start justify-between p-4 border-b rounded-t border-orange-100">
                                            <h3 class="text-xl font-semibold text-orange-600">
                                                Beri Rating dan Review
                                            </h3>
                                            <button type="button" class="text-orange-400 bg-transparent hover:bg-orange-100 hover:text-orange-700 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="ratingReviewModal{{ $transaksi->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 7.586l4.293-4.293a1 1 0 111.414 1.414L11.414 9l4.293 4.293a1 1 0 11-1.414 1.414L10 10.414l-4.293 4.293a1 1 0 11-1.414-1.414L8.586 9 4.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="sr-only">Tutup</span>
                                            </button>
                                        </div>
                                        <form method="POST" action="{{ route('transactions.rate', $transaksi->id) }}">
                                            @csrf
                                            <div class="p-6 space-y-4">
                                                <div>
                                                    <label for="rating" class="block mb-2 text-sm font-medium text-orange-600">Rating (1-5)</label>
                                                    <div class="flex justify-center text-5xl flex-row-reverse">
                                                        <input type="radio" id="star5_{{ $transaksi->id }}" name="rating" value="5" class="hidden peer" />
                                                        <label for="star5_{{ $transaksi->id }}" class="text-orange-200 cursor-pointer peer-checked:text-orange-400">&#9733;</label>
                                                        <input type="radio" id="star4_{{ $transaksi->id }}" name="rating" value="4" class="hidden peer" />
                                                        <label for="star4_{{ $transaksi->id }}" class="text-orange-200 cursor-pointer peer-checked:text-orange-400">&#9733;</label>
                                                        <input type="radio" id="star3_{{ $transaksi->id }}" name="rating" value="3" class="hidden peer" />
                                                        <label for="star3_{{ $transaksi->id }}" class="text-orange-200 cursor-pointer peer-checked:text-orange-400">&#9733;</label>
                                                        <input type="radio" id="star2_{{ $transaksi->id }}" name="rating" value="2" class="hidden peer" />
                                                        <label for="star2_{{ $transaksi->id }}" class="text-orange-200 cursor-pointer peer-checked:text-orange-400">&#9733;</label>
                                                        <input type="radio" id="star1_{{ $transaksi->id }}" name="rating" value="1" class="hidden peer" />
                                                        <label for="star1_{{ $transaksi->id }}" class="text-orange-200 cursor-pointer peer-checked:text-orange-400">&#9733;</label>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label for="komen" class="block mb-2 text-sm font-medium text-orange-600">Review</label>
                                                    <textarea id="komen" name="komen" rows="4" required class="bg-orange-50 border border-orange-100 text-orange-900 text-sm rounded-lg focus:ring-orange-200 focus:border-orange-200 block w-full p-2.5"></textarea>
                                                </div>
                                            </div>
                                            <div class="flex items-center justify-end p-4 border-t border-orange-100 rounded-b">
                                                <button type="submit" class="text-white bg-orange-400 hover:bg-orange-500 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Kirim Review
                                                </button>
                                                <button type="button" data-modal-hide="ratingReviewModal{{ $transaksi->id }}" class="ml-2 text-orange-700 bg-orange-100 hover:bg-orange-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Tutup
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <p class="text-center text-orange-300">Tidak ada transaksi yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
