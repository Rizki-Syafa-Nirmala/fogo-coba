@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')

<div class="pb-20 pt-2 ">

    <div class="bg-white min-h-screen p-4">

        <div class="max-w-md mx-auto">
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
            <div class="flex justify-between items-start mb-4 px-1">
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
            <div class="flex justify-between items-center mb-3 px-1">
                <h2 class="font-semibold text-gray-900 text-base">
                Kategori
                </h2>
                <button aria-label="See more categories" class="text-gray-900 text-lg">
                <i class="fas fa-arrow-right">
                </i>
                </button>
            </div>
           <!-- Categories scroll container -->
            <div class="flex space-x-4 overflow-x-auto pb-2 px-1 scrollbar-hide">
                <!-- Button dengan background gambar -->
                @foreach ($kategoris as $kategori)
                    <a href="{{ route('makanan.kategori', $kategori->id) }}">
                        <button
                        class="flex-shrink-0 w-20 h-20 bg-cover bg-center rounded-2xl p-4 shadow-lg flex items-center justify-center text-white font-bold"
                        style="background-image: url('{{ asset('images/mariah-hewines-J89GBos3avo-unsplash.jpg') }}')"
                        >
                        {{ $kategori->nama }}
                        </button>
                    </a>
                @endforeach
            </div>
        </div>

            <div class="max-w-md mx-auto pt-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="font-semibold text-base">
                    Makanan yang Tersedia
                    </h2>
                    <a href="{{ route('makanan.kategori') }}" class="text-black text-lg">
                        <i class="fas fa-arrow-right">
                        </i>
                    </a>
                </div>
                <div  class="grid grid-cols-2 gap-4 mb-6">
                    @foreach ($makanans as $makanan)
                    {{-- <a href="{{ route('detailmakanan', $makanan->id) }}" class="makanan-item {{ $loop->index >= 4 ? 'hidden' : '' }} relative rounded-xl overflow-hidden bg-black aspect-square flex flex-col justify-end">
                        <img alt="Glass of fresh orange juice with sliced oranges and rosemary on white background" class="w-full h-full object-cover absolute inset-0" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"/>
                        @if ($makanan->rating_count > 0)

                        <div class="absolute top-3 left-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-yellow-400 text-sm font-semibold flex items-center space-x-1">
                            <i class="fas fa-star">
                            </i>
                            <span>
                            {{ $makanan->averange_rating }}
                            </span>
                        </div>
                        @endif
                        <div class="relative z-10 p-3 bg-gradient-to-t from-black/80 to-transparent rounded-b-xl">
                            <h3 class="text-outline font-semibold text-lg leading-tight">
                            {{ $makanan->nama }}
                            </h3>
                            <p class="text-yellow-300 text-xs mt-1">
                            Mitra: Citrus World
                            </p>
                            <p class="text-yellow-300 text-xs">
                            Jarak: 3.1 km
                            </p>
                            <div class="text-yellow-300 text-xs font-normal mt-1">
                            $4.9
                            </div>
                        </div>
                    </a> --}}
                    <a href="{{ route('detailmakanan', $makanan->id) }}"  class="makanan-item {{ $loop->index >= 4 ? 'hidden' : '' }} relative rounded-xl overflow-hidden bg-gray-100 bg-opacity-80 border border-gray-500">
                        <img alt="{{ $makanan->nama }}" class="w-full h-30 object-cover" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}">
                            @if ($makanan->rating_count > 0)
                            <div class="absolute top-2 left-2 flex items-center space-x-1 text-yellow-400 text-sm bg- bg-opacity-60 rounded px-1 py-0.5">
                            <i class="fas fa-star">
                            </i>
                            <span class="text-white text-xs font-semibold">
                            {{ $makanan->averange_rating }}
                            </span>
                            </div>
                            @endif
                            <div class="p-3 text-black border-t border-gray-500">
                            <h3 class="text-base font-semibold truncate w-full">
                            {{ $makanan->nama }}
                            </h3>
                            <p class="text-sm font-semibold mt-1">
                            Rp {{ number_format($makanan->harga, 0, ',', '.') }}
                            </p>
                            @if (session('user_latitude') && session('user_longitude') )
                            <p class="text-xs font-normal pt-2">
                            {{ $makanan->jarak_km }} KM
                            </p>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
                <button  id="toggle-button" onclick="toggleMakanan()" class="w-full bg-black text-white rounded-full py-3 text-center text-base font-semibold" type="button">
                    Tampilkan Lebih Banyak
                </button>
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
