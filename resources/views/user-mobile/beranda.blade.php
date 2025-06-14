@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')

<div class="pb-20 pt-2 ">

    <div class="bg-white pt-4">

        <div class="max-w-md mx-auto ">
                @php
                    date_default_timezone_set('Asia/Jakarta');
                    $hour = date('H');

                    if ($hour < 12) {
                        $greeting = 'Selamat Pagi';
                    } elseif ($hour < 18) {
                        $greeting = 'Selamat Sore';
                    } else {
                        $greeting = 'Selamat Malam';
                    }
                @endphp
            <div class="flex justify-between items-start mb-4 px-2">
                <div class="flex-1">
                    <p class="text-gray-500 text-sm mb-1">
                        {{ $greeting }}
                    </p>
                    <h1 class="font-bold text-lg leading-tight mb-2">
                        {{ Auth::user()->name }}
                    </h1>
                </div>

                <div class="flex justify-center items-start pt-1  px-1">
                    <div class="flex items-center gap-2 border border-[#2B7A99] rounded-full px-4 py-2 bg-white shadow-sm w-full max-w-sm min-w-[8rem]">
                        <i class="fas fa-map-marker-alt text-[#2B7A99] text-sm"></i>
                        <span class="text-[#2B7A99] text-sm truncate text-center w-full" title="{{ session('user_kota') ?? 'Lokasi tidak diketahui' }}">
                            {{ session('user_kota') ?? 'Lokasi tidak diketahui' }}
                        </span>
                    </div>
                </div>

            </div>


           <!-- Recommended Recipe card smaller width and height -->

            <div class="flex space-x-4 overflow-x-auto scrollbar-hide mb-6 px-1">
                <!-- Card 1 -->
                <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
                    <img alt="Top view of a dark-themed recipe dish with a spoon and ingredients on a dark wooden table" class="w-full h-36 object-cover rounded-xl" src="https://storage.googleapis.com/a1aa/image/96e2cc35-38f9-4307-bd91-71f8e1105d2e.jpg"/>
                    <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                    Rekomendasi
                    <br/>
                    Terdekat
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
                    <img alt="Top view of a light-themed recipe dish with fresh ingredients on a wooden table" class="w-full h-36 object-cover rounded-xl" height="144" src="https://storage.googleapis.com/a1aa/image/70726c3c-45c3-4b60-7446-5cb7101bccc7.jpg" width="288"/>
                    <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                    Fresh
                    <br/>
                    Recipe Delivered
                    </div>
                </div>
                <!-- Card 3 -->
                <div class="rounded-xl overflow-hidden relative w-72 flex-shrink-0">
                    <img alt="Top view of a colorful salad bowl with vegetables and dressing" class="w-full h-36 object-cover rounded-xl" height="144" src="https://storage.googleapis.com/a1aa/image/d3e6b10e-bebf-4e67-0b6e-8173b80193a4.jpg" width="288"/>
                    <div class="absolute bottom-4 left-4 text-white font-semibold text-base leading-snug drop-shadow-lg">
                    Healthy
                    <br/>
                    Recipe Ideas
                    </div>
                </div>
            </div>
           <!-- Categories heading with arrow -->
            <div class="flex justify-between items-center mb-3 px-2">
                <h2 class="font-semibold text-gray-900 text-base">
                Kategori
                </h2>
            </div>
           <!-- Categories scroll container -->
            <div class="flex space-x-4 overflow-x-auto pb-2 px-2 scrollbar-hide">
                <!-- Button dengan background gambar -->
                @foreach ($kategoris as $kategori)
                    <a href="{{ route('mobile.makananmobile', $kategori->id) }}" type="button" class="inline-flexbg-white text-black border border-gray-900 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100 whitespace-nowrap items-center px-2 py-2 text-sm font-medium  rounded-full">
                    {{ $kategori->nama }}
                    </a>
                @endforeach
            </div>
        </div>
        <div class="max-w-md mx-auto pt-4">
            <div class="flex items-center justify-between mb-4 px-2">
                <h2 class="font-semibold text-base">
                    Makanan yang Tersedia
                </h2>
                <a href="{{ route('mobile.makananmobile') }}" class="text-black text-lg pr-3">
                    <i class="fas fa-arrow-right">
                    </i>
                </a>
            </div>
            <div  class="flex overflow-x-auto gap-6 px-1 mb-2 scrollbar-hide">
                @foreach ($makanans as $makanan)
                <a href="{{ route('mobile.detailmakanan', $makanan->id) }}" class="makanan-item {{ $loop->index >= 4 ? 'hidden' : '' }} flex-shrink-0 relative rounded-xl overflow-hidden bg-gray-100 w-60 aspect-square flex flex-col justify-end shadow-md">
                    <img alt="Glass of fresh orange juice with sliced oranges and rosemary on white background" class="w-60 h-full object-cover absolute inset-0" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"/>
                    @if ($makanan->rating_count > 0)
                    <div class="absolute top-3 left-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-yellow-400 text-sm font-semibold flex items-center space-x-1">
                        <i class="fas fa-star">
                        </i>
                        <span>
                            {{ $makanan->average_rating }}
                        </span>
                    </div>
                    @endif
                    {{-- Jarak di kanan atas --}}
                    <div class="absolute top-3 right-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-white text-xs font-small">
                        {{ $makanan->jarak_km }} KM
                    </div>
                    <div class="relative z-10 p-3  bg-gray-900/50 rounded-b-xl">
                        <h3 class="text-orange-300 font-semibold text-xl w-full flex items-center gap-1">
                            <span class="truncate block max-w-[90%]">
                                {{ $makanan->nama }}
                            </span>
                        </h3>
                        <div class="text-gray-100 text-lg font-normal mt-1">
                            Rp {{ number_format($makanan->harga, 0, ',', '.') }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        let visible = 4;
        const step = 4;
        const items = document.querySelectorAll('.makanan-item');
        const button = document.getElementById('toggle-button');

        function toggleMakanan() {
            const hiddenItems = Array.from(items).filter(item => item.classList.contains('hidden'));

            if (hiddenItems.length === 0) {
                // Jika semua sudah tampil, kembali ke awal
                items.forEach((item, index) => {
                    if (index >= 4) item.classList.add('hidden');
                });
                visible = 4;
                button.innerText = 'Tampilkan Lebih Banyak';
            } else {
                // Tampilkan item berikutnya sebanyak step
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
</div>



@endsection
