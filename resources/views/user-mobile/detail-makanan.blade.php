@extends('layouts.page')

@section('content-user-mobile')


<div class="pb-20 pt-2 ">

    <div class="max-w-md w-full bg-white rounded-lg  overflow-hidden">
        <div class="relative bg-[#fefefe] rounded-b-[100px]">
            <img alt="Three fresh green organic lemons with two green leaves, one lemon cut in half showing juicy interior" class="w-full object-contain pt-12" height="300" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}" width="400"/>
            <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('foods') }}" class="absolute top-4 left-4 text-black text-xl">
                <i class="fas fa-arrow-left">
                </i>
            </a>
        </div>
        <hr class="border-t-2 border-[#3ea2ff]"/>
        <div class="p-6 space-y-4">
            <h1 class="font-bold text-xl text-black text-center">
            {{ $makanan->nama }}
            </h1>
            <p class="text-black font-semibold text-lg">
            Rp {{ number_format($makanan->harga, 0, ',', '.') }}
            </p>

            @if ($makanan->rating_count > 0)
            <div class="flex items-center space-x-1">
            <p class="font-semibold text-sm text-black">
            {{ $makanan->avarange_rating }}
            </p>
            @php
                $fullStars = floor($makanan->average_rating);
                $halfStar = ($makanan->average_rating - $fullStars) >= 0.5;
                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);
            @endphp

            <div class="flex text-yellow-400 text-md">
                {{-- Bintang penuh --}}
                @for ($i = 0; $i < $fullStars; $i++)
                    <i class="fas fa-star"></i>
                @endfor

                {{-- Bintang setengah --}}
                @if ($halfStar)
                    <i class="fas fa-star-half-alt"></i>
                @endif

                {{-- Bintang kosong --}}
                @for ($i = 0; $i < $emptyStars; $i++)
                    <i class="far fa-star"></i>
                @endfor
            </div>
            <p class="text-md text-gray-400">
            {{ $makanan->rating_count }} ulasan
            </p>
            @else
            <p class="text-md text-gray-400">
            Belum ada ulasan
            </p>
            @endif
            </div>
            <p class="text-md text-black leading-relaxed font-normal px-2 pb-8">
            Organic Mountain works as a seller for many organic growers of organic
                lemons. Organic lemons are easy to spot in your produce aisle. They are
                just like regular lemons, but they will usually have a few more scars on
                the outside of the lemon skin. Organic lemons are considered to be the
                world's finest lemon for juicing
            <span class="font-semibold">
            more
            </span>
            </p>
            <div class="fixed bottom-0 left-0 w-full px-4 pb-8 bg-white z-50">
                <button class="w-full bg-gradient-to-r from-[#6cc24a] to-[#2bb673] text-white font-semibold rounded-md py-3 flex items-center justify-center space-x-2">
                    <span>Add to cart</span>
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@endsection
