@extends('layouts.page')

@section('content-user')
<div class="bg-white py-8 antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mx-auto max-w-5xl">
            <div class="gap-4 sm:flex sm:items-center sm:justify-between">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">My orders</h2>
                <div class="mt-6 gap-4 space-y-4 sm:mt-0 sm:flex sm:items-center sm:justify-end sm:space-y-0">
                    <div>
                        <label for="duration" class="sr-only mb-2 block text-sm font-medium text-gray-900 dark:text-white">Select duration</label>
                        <select id="duration" class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
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
                    'Proses' => 'me-2 mt-1.5 inline-flex items-center rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-white dark:bg-primary-900 dark:text-white',
                    'Siap ambil' => 'me-2 mt-1.5 inline-flex items-center rounded bg-yellow-100 px-2.5 py-0.5 text-xs font-medium text-white dark:bg-yellow-900 dark:text-white',
                    'Selesai' => 'me-2 mt-1.5 inline-flex items-center rounded bg-green-100 px-2.5 py-0.5 text-xs font-medium text-white dark:bg-green-900 dark:text-white',
                    default => 'bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300'
                };
            @endphp

            <div class="mt-6 flow-root sm:mt-8">
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    <div class="flex flex-wrap items-center gap-y-4 py-6">
                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Order ID:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">
                                <a href="#" class="hover:underline">{{ $transaksi->id }}</a>
                            </dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Date:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">{{ $transaksi->created_at->format('d M Y, H:i') }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Price:</dt>
                            <dd class="mt-1.5 text-base font-semibold text-gray-900 dark:text-white">Rp.{{ number_format($transaksi->total_harga, 2) }}</dd>
                        </dl>

                        <dl class="w-1/2 sm:w-1/4 lg:w-auto lg:flex-1">
                            <dt class="text-base font-medium text-gray-500 dark:text-gray-400">Status:</dt>
                            <dd class="{{ $statusColor }}">
                                {{ ucfirst($transaksi->status) }}
                            </dd>
                        </dl>

                        <div class="w-full grid sm:grid-cols-2 lg:flex lg:w-64 lg:items-center lg:justify-end gap-4">
                            @if($transaksi->status === 'Siap ambil')
                                <form action="{{ route('transactions.complete', $transaksi->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Ini penting -->
                                    <button type="submit" class="w-full rounded-lg border border-green-700 px-3 py-2 text-center text-sm font-medium text-green-700 hover:bg-green-700 hover:text-white focus:outline-none focus:ring-4 focus:ring-green-300 dark:border-green-500 dark:text-green-500 dark:hover:bg-green-600 dark:hover:text-white dark:focus:ring-green-900 lg:w-auto">
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

                                @if($transaksi->ulasan) <!-- Periksa apakah reviews ada dan kosong -->
                                    <div class="flex gap-2 items-center">

                                            @for ($i = 1; $i <= 5; $i++)
                                            <svg class="w-5 h-5" fill="{{ $i <= $transaksi->ulasan->rating ? 'yellow' : 'gray' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path>
                                            </svg>
                                            @endfor
                                    </div>
                                @else
                                <!-- Tampilkan pesan bahwa review sudah diberikan -->
                                <!-- Tombol Buka Modal -->
                                    <button data-modal-target="ratingReviewModal{{ $transaksi->id }}" data-modal-toggle="ratingReviewModal{{ $transaksi->id }}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                                        Beri Rating dan Review
                                    </button>
                                @endif

                            <!-- Modal Flowbite -->
                            <div id="ratingReviewModal{{ $transaksi->id }}" tabindex="-1" aria-hidden="true" class="hidden fixed top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative w-full max-w-md max-h-full mx-auto">
                                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                        <!-- Header -->
                                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                Beri Rating dan Review
                                            </h3>
                                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-hide="ratingReviewModal{{ $transaksi->id }}">
                                                <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 7.586l4.293-4.293a1 1 0 111.414 1.414L11.414 9l4.293 4.293a1 1 0 11-1.414 1.414L10 10.414l-4.293 4.293a1 1 0 11-1.414-1.414L8.586 9 4.293 4.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                <span class="sr-only">Tutup</span>
                                            </button>
                                        </div>

                                        <!-- Body Form -->
                                        <form method="POST" action="{{ route('transactions.rate', $transaksi->id) }}">
                                            @csrf
                                            <div class="p-6 space-y-4">
                                                <div>
                                                    <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating (1-5)</label>
                                                    <!-- Bintang Rating dengan Flowbite -->
                                                    <div class="flex justify-center text-5xl flex-row-reverse">
                                                        <!-- 5 Star -->
                                                        <input type="radio" id="star5_{{ $transaksi->id }}" name="rating" value="5" class="hidden peer" />
                                                        <label for="star5_{{ $transaksi->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                                        <!-- 4 Star -->
                                                        <input type="radio" id="star4_{{ $transaksi->id }}" name="rating" value="4" class="hidden peer" />
                                                        <label for="star4_{{ $transaksi->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                                        <!-- 3 Star -->
                                                        <input type="radio" id="star3_{{ $transaksi->id }}" name="rating" value="3" class="hidden peer" />
                                                        <label for="star3_{{ $transaksi->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                                        <!-- 2 Star -->
                                                        <input type="radio" id="star2_{{ $transaksi->id }}" name="rating" value="2" class="hidden peer" />
                                                        <label for="star2_{{ $transaksi->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                                        <!-- 1 Star -->
                                                        <input type="radio" id="star1_{{ $transaksi->id }}" name="rating" value="1" class="hidden peer" />
                                                        <label for="star1_{{ $transaksi->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>
                                                    </div>

                                                </div>
                                                <div>
                                                    <label for="komen" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Review</label>
                                                    <textarea id="komen" name="komen" rows="4" required
                                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"></textarea>
                                                </div>
                                            </div>

                                            <!-- Footer -->
                                            <div class="flex items-center justify-end p-4 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                <button type="submit" class="text-white bg-blue-600 hover:bg-blue-700 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                                    Kirim Review
                                                </button>
                                                <button type="button" data-modal-hide="ratingReviewModal{{ $transaksi->id }}"
                                                    class="ml-2 text-gray-700 bg-gray-200 hover:bg-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
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
                <p class="text-center text-gray-500 dark:text-gray-400">Tidak ada transaksi yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
