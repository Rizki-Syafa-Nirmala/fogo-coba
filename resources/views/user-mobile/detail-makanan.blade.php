@extends('layouts.page')

@section('content-user-mobile')
<div class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">

        <!-- Tombol Close -->
        <button onclick="window.history.back()" 
                class="absolute top-4 right-4 z-10 text-gray-500 bg-white/80 hover:bg-gray-100 hover:text-gray-700 rounded-full w-12 h-12 flex items-center justify-center shadow transition">
            <i class="fas fa-times text-2xl"></i>
        </button>

        <div class="p-6 space-y-6 overflow-y-auto max-h-screen">

            <!-- Gambar -->
            <div class="relative overflow-hidden w-full h-56 rounded-xl bg-gray-50 border shadow-inner">
                <img src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/makanan.png') }}"
                     alt="{{ $makanan->nama }}" 
                     class="w-full h-full object-cover transition duration-700">
            </div>

            <!-- Nama & Harga -->
            <div class="text-center space-y-2">
                <h1 class="text-2xl font-bold text-gray-900">{{ $makanan->nama }}</h1>
                <p class="text-lg font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
                    Rp {{ number_format($makanan->harga, 0, ',', '.') }}
                </p>
            </div>

            <!-- Rating -->
            <div class="flex items-center justify-center gap-2">
                @php
                    $fullStars = floor($makanan->average_rating);
                    $halfStar = ($makanan->average_rating - $fullStars) >= 0.5;
                    $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
                @endphp

                <div class="flex text-yellow-400 text-lg">
                    @for ($i = 0; $i < $fullStars; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                    @if ($halfStar)
                        <i class="fas fa-star-half-alt"></i>
                    @endif
                    @for ($i = 0; $i < $emptyStars; $i++)
                        <i class="far fa-star"></i>
                    @endfor
                </div>

                @if ($makanan->rating_count > 0)
                    <p class="text-sm text-gray-500">{{ $makanan->rating_count }} ulasan</p>
                @else
                    <p class="text-sm text-gray-400">Belum ada ulasan</p>
                @endif
            </div>

            <!-- Deskripsi -->
            <div class="px-2 text-gray-700 text-justify leading-relaxed">
                {{ $makanan->deskripsi ?? 'Tidak ada deskripsi untuk makanan ini.' }}
            </div>

            <!-- Button Pesan -->
            <form action="{{ route('mobile.buat.transaksi') }}" method="POST" class="pt-2">
                @csrf
                <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold rounded-xl py-3 text-lg flex items-center justify-center space-x-2 transition">
                    <span>Pesan Sekarang</span>
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </form>

        </div>
    </div>
</div>
@endsection
