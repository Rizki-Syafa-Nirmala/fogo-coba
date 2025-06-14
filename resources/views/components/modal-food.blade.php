@foreach ($makanans as $makanan)
<div id="{{ $makanan->id }}" tabindex="-1" class="fixed inset-0 z-50 hidden w-full overflow-y-auto flex items-center justify-center">
    <div data-modal-hide="{{ $makanan->id }}" class="fixed inset-0 bg-gradient-to-br from-black/60 to-black/40 backdrop-blur-sm"></div>
    <div class="relative w-full max-w-4xl m-4">
    <div class="relative bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden max-h-[90vh] overflow-y-auto scrollbar-hide">
            <!-- Close button -->
            <button type="button" data-modal-hide="{{ $makanan->id }}" class="absolute top-4 right-4 z-10 text-gray-500 bg-white/80 hover:bg-gray-100 hover:text-gray-700 rounded-full p-2.5 inline-flex items-center justify-center shadow-sm transition">
                <img src="{{ asset('images/icons/close.svg') }}" class="w-7 h-7" />
            </button>

            <!-- Modal content -->
            <div class="p-6 md:p-8 space-y-10">
                <!-- Product content -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                    <!-- Image -->
                    <div class="relative overflow-hidden w-full h-64 rounded-xl border border-gray-100 bg-gray-50 shadow-inner group">
                        <img src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/makanan.png') }}"
                            alt="{{ $makanan->nama }}"
                            class="w-full h-full object-contain group-hover:scale-105 transition-transform duration-700">
                    </div>

                    <!-- Info -->
                    <div class="space-y-5">
                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900">{{ $makanan->nama }}</h1>

                        <div class="flex flex-wrap items-center gap-4">
                            <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($makanan->harga, 0, ',', '.') }}</p>
                            @if ($makanan->rating_count > 0)
                            <div class="flex items-center gap-2 bg-gray-100 text-sm px-3 py-1 rounded-lg">
                      <!-- Bintang -->
                      @for ($i = 1; $i <= 5; $i++)
                          <svg class="w-4 h-4 {{ $i <= $makanan->average_rating ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M12 .587l3.668 7.431 8.2 1.151-5.934 5.778L19.52 24 12 19.897 4.48 24l1.586-9.053L.132 9.169l8.2-1.151z"/>
                          </svg>
                      @endfor

                                <span class="text-sm font-medium text-gray-700">{{ $makanan->average_rating }} ({{ $makanan->rating_count }})</span>
                            </div>
                            @endif
                        </div>

                        <div class="bg-orange-50 p-4 rounded-lg border border-orange-100 text-gray-700 leading-relaxed">
                            {{ $makanan->deskripsi }}
                        </div>

                        <form action="{{ route('transaksi.store') }}" method="POST" class="pt-2">
                            @csrf
                            <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                            <button type="submit" class="w-full sm:w-auto flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white rounded-lg shadow-lg hover:shadow-orange-300 transition">
                                <img src="{{ asset('images/icons/cart.svg') }}" class="w-5 h-5" />
                                Pesan Sekarang
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Reviews -->
                @if ($makanan->rating_count > 0)
                <div class="pt-8 border-t border-gray-100">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Reviews</h2>

                    <!-- Rating summary -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Progress bars -->
                        <div class="space-y-3">
                            @for ($rating = 5; $rating >= 1; $rating--)
                            <div class="flex items-center gap-2">
                                <span class="w-4 text-sm font-semibold text-gray-700">{{ $rating }}</span>
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077..."/>
                                </svg>
                                <div class="w-full h-2.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-yellow-400 to-orange-400 rounded-full" style="width: {{ $makanan->{'rating_'.$rating.'_percent'} }}%"></div>
                                </div>
                                <span class="w-8 text-sm text-gray-600">{{ $makanan->{'rating_'.$rating} ?? 0 }}</span>
                            </div>
                            @endfor
                        </div>

                        <!-- Average rating -->
                        <div class="flex flex-col items-center justify-center">
                            <div class="text-6xl font-bold text-gray-900">{{ number_format($makanan->average_rating, 1) }}</div>
                            <div class="mt-1 text-sm text-gray-500">out of 5</div>
                            <div class="mt-3 flex gap-1">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg class="w-6 h-6 {{ $i <= $makanan->average_rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077..."/>
                                    </svg>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <!-- Individual Reviews -->
                    <div class="mt-10 space-y-6">
                        @foreach ($makanan->ulasan as $ulasan)
                        <div class="p-5 bg-white rounded-xl border border-gray-100 shadow-sm hover:shadow-md transition">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full bg-gradient-to-br from-orange-400 to-orange-600 text-white flex items-center justify-center font-bold">
                                    {{ substr($ulasan->user->name, 0, 1) }}
                                </div>
                                <div class="flex-1">
                                    <div class="flex justify-between items-center">
                                        <h4 class="font-semibold text-gray-900">{{ $ulasan->user->name }}</h4>
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">{{ $ulasan->updated_at->format('j M Y') }}</span>
                                    </div>
                                    <div class="mt-1 flex">
                                        @for ($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= $ulasan->rating ? 'text-yellow-400' : 'text-gray-200' }}" fill="currentColor" viewBox="0 0 24 24">
                                            <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077..."/>
                                        </svg>
                                        @endfor
                                    </div>
                                    <p class="mt-3 text-gray-600">{{ $ulasan->komen }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @else
                <div class="mt-10 text-center py-10 bg-gray-50 border border-gray-100 rounded-xl">
                    <svg class="w-12 h-12 mx-auto text-gray-300 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11.049 2.927..."/>
                    </svg>
                    <h3 class="text-lg font-semibold text-gray-900">Belum ada ulasan</h3>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endforeach
