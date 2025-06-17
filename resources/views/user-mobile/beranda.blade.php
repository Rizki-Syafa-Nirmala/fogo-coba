@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')

<div class="pb-15 pt-2">

    <!-- Greetings, Location & Points -->
    <div class="bg-white pt-4 pb-2">
        <div class="max-w-md mx-auto">

            @php
                date_default_timezone_set('Asia/Jakarta');
                $hour = date('H');
                if ($hour < 12) {
                    $greeting = 'Good Morning';
                } elseif ($hour < 18) {
                    $greeting = 'Good Afternoon';
                } else {
                    $greeting = 'Good Evening';
                }
            @endphp

            <!-- Greeting -->
            <div class="px-4">
                <p class="text-lg font-semibold text-gray-700">{{ $greeting }},</p>
                <h1 class="text-2xl font-bold text-gray-900">{{ Auth::user()->name }}</h1>
            </div>

            <!-- Location & Points -->
            <div class="flex items-center justify-between px-4 py-4 ">
                <div class="flex items-center gap-2 text-md text-gray-500">
                    <i class="fas fa-map-marker-alt text-orange-500"></i>
                    <span class="font-medium text-gray-700">{{ session('user_kota') }}</span>
                </div>

                <div class="flex items-center gap-1 bg-orange-50 border border-orange-200 text-orange-600 px-2 py-1 rounded-full shadow-sm">
                    <i class="fas fa-star text-orange-400 text-sm"></i>
                    <span class="font-semibold text-sm">{{ Auth::user()->point }} pts</span>
                </div>
            </div>

        </div>
    </div>

    <!-- Recommended Recipe Cards -->
    <div class="flex space-x-4 overflow-x-auto scrollbar-hide mb-6 px-1">
        <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
            <img class="w-full h-36 object-cover rounded-xl"
                 src="https://storage.googleapis.com/a1aa/image/96e2cc35-38f9-4307-bd91-71f8e1105d2e.jpg"
                 alt="Dark recipe">
            <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                Rekomendasi<br/>Terdekat
            </div>
        </div>

        <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
            <img class="w-full h-36 object-cover rounded-xl"
                 src="https://storage.googleapis.com/a1aa/image/70726c3c-45c3-4b60-7446-5cb7101bccc7.jpg"
                 alt="Fresh recipe">
            <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                Fresh<br/>Recipe Delivered
            </div>
        </div>

        <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
            <img class="w-full h-36 object-cover rounded-xl"
                 src="https://storage.googleapis.com/a1aa/image/d3e6b10e-bebf-4e67-0b6e-8173b80193a4.jpg"
                 alt="Healthy recipe">
            <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                Healthy<br/>Recipe Ideas
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="flex space-x-4 overflow-x-auto pb-2 px-2 scrollbar-hide">
        @foreach ($kategoris as $kategori)
            <a href="{{ route('mobile.makananmobile', $kategori->id) }}"
               class="inline-flex bg-orange-50 text-orange-600 whitespace-nowrap items-center px-3 py-2 text-lg font-medium rounded-full">
                {{ $kategori->nama }}
            </a>
        @endforeach
    </div>

    <!-- Makanan Section -->
    <div class="max-w-md mx-auto pt-4">
        <div class="flex items-center justify-between mb-4 px-2">
            <h2 class="font-semibold text-base">Makanan yang Tersedia</h2>
            <a href="{{ route('mobile.makananmobile') }}" class="text-black text-lg pr-3">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="flex overflow-x-auto gap-4 px-2 mb-4 scrollbar-hide">
            @foreach ($makanans as $makanan)
                <a href="{{ route('mobile.detailmakanan', $makanan->id) }}"
                   class="makanan-item {{ $loop->index >=4 ? 'hidden' : '' }} flex-shrink-0 relative rounded-xl border border-gray-300 bg-white shadow-sm p-3 w-40 flex flex-col justify-between">

                    <div class="relative w-full h-32 rounded-md overflow-hidden">
                        <img class="w-full h-full object-cover"
                             src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/makanan.png') }}"
                             alt="{{ $makanan->nama }}">
                    </div>

                    <div class="absolute top-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-md">
                            {{ $makanan->jarak_km }} KM
                    </div>

                    @if ($makanan->rating_count > 0)
                        <div class="flex items-center gap-1 mt-2">
                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845L19.335 24 12 20.01 4.665 24 6 15.268 0 9.423l8.332-1.268z"/>
                            </svg>
                            <span class="text-sm font-semibold text-gray-900">{{ $makanan->average_rating }}</span>
                            <span class="text-sm text-gray-500">({{ $makanan->rating_count }})</span>
                        </div>
                    @endif

                    <div class="mt-1">
                        <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $makanan->nama }}</h3>
                    </div>

                    <div class="mt-2">
                        <p class="text-lg font-extrabold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                            Rp{{ number_format($makanan->harga, 0, ',', '.') }}
                        </p>
                    </div>

                </a>
            @endforeach
        </div>
    </div>

</div>

<!-- Toggle Script -->
<script>
    let visible = 4;
    const step = 4;
    const items = document.querySelectorAll('.makanan-item');
    const button = document.getElementById('toggle-button');

    function toggleMakanan() {
        const hiddenItems = Array.from(items).filter(item => item.classList.contains('hidden'));

        if (hiddenItems.length === 0) {
            items.forEach((item, index) => {
                if (index >= 4) item.classList.add('hidden');
            });
            visible = 4;
            button.innerText = 'Tampilkan Lebih Banyak';
        } else {
            let shown = 0;
            for (let i = visible; i < items.length && shown < step; i++) {
                items[i].classList.remove('hidden');
                shown++;
            }
            visible += shown;
            if (visible >= items.length) {
                button.innerText = 'Tampilkan Lebih Sedikit';
            }
        }
    }
</script>

@endsection
