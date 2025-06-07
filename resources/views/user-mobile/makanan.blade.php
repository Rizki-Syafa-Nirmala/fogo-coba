@extends('layouts.page')


@section('content-user-mobile')

    <div class=" min-h-10 bg-cover" style="background-image: url('{{ asset('images/mariah-hewines-J89GBos3avo-unsplash.jpg') }}')">
        <div class="pt-8 px-5 pb-6">
            <div class="flex justify-between items-center mb-6">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('foods') }}" aria-label="Back" class="text-white text-2xl">
                    <i class="fas fa-arrow-left">
                    </i>
                </a>
            </div>

            <h1 class="text-white font-semibold text-xl mb-1">
            {{ $selectedKategori->nama  }}
            </h1>
            <p class="text-yellow-100 text-xs font-normal">
                {{ $makanans->count() }} Makanan
            </p>
        </div>
        {{-- nampilin makanan --}}
        <div class="bg-gray-50 rounded-t-3xl px-5 pt-5 pb-8">
            <div class="grid grid-cols-2 gap-4">
                @foreach ($makanans as $makanan)
                    <a href="{{ route('detailmakanan', $makanan->id) }}"  class="relative rounded-xl overflow-hidden bg-gray-100 bg-opacity-80 border border-gray-500">
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
        </div>
    </body>
@endsection
