@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')
<div class="bg-orange-50 min-h-screen">
    <div class="max-w-sm mx-auto bg-white min-h-screen">

        <!-- Header -->
        <div class="sticky top-0 z-50 bg-gradient-to-r from-orange-50 via-white to-orange-100 border-b border-orange-200 shadow-sm">
            <div class="px-4 py-6 text-center">
                <h1 class="text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-orange-500 via-red-500 to-orange-400 drop-shadow-md">
                    Rekomendasi Buat Kamu!
                </h1>
                <p class="text-sm text-gray-600 mt-2">Aku kasih beberapa rekomendasi ya biar ga bingung! ✨</p>
            </div>
        </div>

        <!-- Category Pills -->
        <div class="px-3 py-4">
            <div class="flex gap-3 overflow-x-auto px-3 py-2 scrollbar-hide">
                @php
                    $filters = [
                        'random'     => 'Untuk Anda',
                        'terdekat'   => 'Terdekat',
                        'terbaik'    => 'Terbaik',
                        'terpopuler' => 'Terpopuler',
                        'terfavorit' => 'Terfavorit'
                    ];
                @endphp

                @foreach ($filters as $key => $label)
                    <a href="{{ route('mobile.rekomendasimobile', $key) }}"
                       class="inline-flex items-center whitespace-nowrap px-4 py-2 text-sm font-semibold rounded-full border transition-all duration-200
                       {{ request()->route('filter') == $key 
                           ? 'bg-orange-500 text-white shadow border-orange-500' 
                           : 'bg-orange-50 text-orange-600 border-orange-200 hover:bg-orange-100 hover:text-orange-700' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Food Grid -->
        <div class="px-3 pb-24">
            <div class="grid grid-cols-2 gap-4 px-2 mb-4">
                @foreach ($filtered as $makanan)
                    <a href="{{ route('mobile.detailmakanan', $makanan->id) }}" 
                       class="makanan-item relative rounded-xl border border-gray-300 bg-white shadow-sm p-3 flex flex-col justify-between">

                        <!-- Gambar & Jarak -->
                        <div class="relative w-full h-32 rounded-md overflow-hidden">
                            <img alt="{{ $makanan->nama }}" 
                                 class="w-full h-full object-cover" 
                                 src="{{ $makanan->gambar_makanan 
                                     ? asset('storage/'.$makanan->gambar_makanan) 
                                     : asset('images/makanan.png') }}">

                            <div class="absolute top-2 right-2 bg-black/60 text-white text-xs px-2 py-1 rounded-md">
                                {{ $makanan->jarak_km }} KM
                            </div>
                        </div>

                        <!-- Nama & Rating -->
                        <div class="mt-2">
                            <h3 class="text-sm font-semibold text-gray-900 truncate">{{ $makanan->nama }}</h3>

                            @if ($makanan->rating_count > 0)
                                <div class="flex items-center gap-1 mt-1">
                                    <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 .587l3.668 7.568L24 9.423l-6 5.845L19.335 24 12 20.01 4.665 24 6 15.268 0 9.423l8.332-1.268z"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-gray-900">{{ $makanan->average_rating }}</span>
                                    <span class="text-sm text-gray-500">({{ $makanan->rating_count }})</span>
                                </div>
                            @endif
                        </div>

                        <!-- Harga -->
                        <div class="mt-2">
                            <p class="text-lg font-extrabold bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">
                                Rp{{ number_format($makanan->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Empty State -->
        @if($filtered->isEmpty())
            <div class="flex flex-col items-center justify-center py-12 px-4 text-center">
                <svg class="w-20 h-20 text-gray-300 mb-3" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 0C4.612 0 0 4.336 0 9.667 0 17 10 20 10 20s10-3 10-10.333C20 4.336 15.388 0 10 0ZM10 14a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800">Belum Ada Makanan</h3>
                <p class="text-gray-500 mt-1">Makanan akan muncul di sini ketika tersedia</p>
            </div>
        @endif

    </div>
</div>
@endsection
