@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-sm mx-auto bg-white min-h-screen">
        <!-- Header -->
        <div class="sticky top-0 z-50 bg-white border-b border-gray-200">
            <div class="px-4 py-6">
                <div class="text-center">
                    <h1 class="text-xl font-semibold text-gray-900">Rekomendasi Makanan</h1>
                    <p class="text-sm text-gray-500 mt-1">Temukan makanan terbaik untuk Anda</p>
                </div>
            </div>
        </div>

        <!-- Category Pills -->
        <div class="px-2 py-4">
            <div class="flex gap-2 overflow-x-auto scrollbar-hide pb-2">
                <a href="{{ route('mobile.rekomendasimobile', 'random') }}" type="button" class="inline-flex {{ request()->routeIs('mobile.rekomendasimobile') && request()->route('filter') == 'random' ? 'bg-blue-700 text-white' : 'bg-white text-black border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100' }}  whitespace-nowrap items-center px-4 py-2 text-sm font-medium  rounded-full">
                    Untuk Anda
                </a>
                <a href="{{ route('mobile.rekomendasimobile', 'terdekat') }}" type="button" class="inline-flex {{ request()->routeIs('mobile.rekomendasimobile') && request()->route('filter') == 'terdekat' ? 'bg-blue-700 text-white' : 'bg-white text-black border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100' }}  whitespace-nowrap items-center px-4 py-2 text-sm font-medium  rounded-full">
                    Terdekat
                </a>
                <a href="{{ route('mobile.rekomendasimobile', 'terbaik') }}" type="button" class="inline-flex {{ request()->routeIs('mobile.rekomendasimobile') && request()->route('filter') == 'terbaik' ? 'bg-blue-700 text-white' : 'bg-white text-black border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100' }}  whitespace-nowrap items-center px-4 py-2 text-sm font-medium  rounded-full">
                    Terbaik
                </a>
                <a href="{{ route('mobile.rekomendasimobile', 'terpopuler') }}" type="button" class="inline-flex {{ request()->routeIs('mobile.rekomendasimobile') && request()->route('filter') == 'terpopuler' ? 'bg-blue-700 text-white' : 'bg-white text-black border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100' }}  whitespace-nowrap items-center px-4 py-2 text-sm font-medium  rounded-full">
                    Terpopuler
                </a>
                <a href="{{ route('mobile.rekomendasimobile', 'terfavorit') }}" type="button" class="inline-flex {{ request()->routeIs('mobile.rekomendasimobile') && request()->route('filter') == 'terfavorit' ? 'bg-blue-700 text-white' : 'bg-white text-black border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:outline-none focus:ring-gray-100' }}  whitespace-nowrap items-center px-4 py-2 text-sm font-medium  rounded-full">
                    Terfavorit
                </a>
            </div>
        </div>

        <!-- Food Grid -->
        <div class="px-2 pb-24">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($filtered as $makanan)
                    <div class="max-w-full bg-white border border-gray-200 rounded-lg shadow hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                        {{-- Link ke detail --}}
                        <a href="{{ route('mobile.detailmakanan', $makanan->id) }}"
                        class="makanan-item flex-shrink-0 relative rounded-xl overflow-hidden bg-gray-100 w-full aspect-square flex flex-col justify-end shadow-md">

                            {{-- Gambar makanan --}}
                            <img
                                alt="{{ $makanan->nama }}"
                                class="w-60 h-full object-cover absolute inset-0"
                                src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"
                            />

                            {{-- Rating --}}
                            @if ($makanan->rating_count > 0)
                                <div class="absolute top-3 left-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-yellow-400 text-sm font-semibold flex items-center space-x-1">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $makanan->averange_rating }}</span>
                                </div>
                            @endif

                            {{-- Jarak di kanan atas --}}
                            <div class="absolute top-3 right-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-white text-xs font-small">
                                {{ $makanan->jarak_km }} KM
                            </div>

                            {{-- Informasi makanan --}}
                            <div class="relative z-10 pl-2 py-1 bg-gray-900/50 rounded-b-xl">
                                <h3 class="text-orange-300 font-semibold text-xl w-full flex items-center gap-1 ">
                                    <span class="truncate block max-w-[90%]">{{ $makanan->nama }}</span>
                                </h3>
                                <div class="text-gray-100 text-lg font-normal mt-1">
                                    Rp {{ number_format($makanan->harga, 0, ',', '.') }}
                                </div>
                            </div>

                        </a>
                    </div>
                @endforeach
            </div>

        </div>

        <!-- Empty State -->
        @if($filtered->isEmpty())
        <div class="flex flex-col items-center justify-center py-12 px-4">
            <svg class="w-24 h-24 text-gray-300 mb-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M10 0C4.612 0 0 4.336 0 9.667 0 17 10 20 10 20s10-3 10-10.333C20 4.336 15.388 0 10 0ZM10 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z"/>
            </svg>
            <h3 class="mb-2 text-lg font-semibold text-gray-900">Belum Ada Makanan</h3>
            <p class="text-gray-500 text-center">Makanan akan muncul di sini ketika tersedia</p>
        </div>
        @endif
    </div>
</div>
@endsection
