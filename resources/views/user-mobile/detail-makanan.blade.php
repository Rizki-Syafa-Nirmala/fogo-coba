@extends('layouts.page')

@section('content-user-mobile')
<div class="fixed inset-0 bg-black bg-opacity-40 backdrop-blur-md z-50 flex items-center justify-center p-4">
    <div class="relative w-full max-w-md bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        @php use Illuminate\Support\Str; @endphp

        <!-- Tombol Close -->
        <a href="{{ url()->previous() != url()->current() && !Str::contains(url()->previous(), 'mobile/transaksi/') ? url()->previous() : route('mobile.foods') }}"
                class="absolute top-4 right-4 z-10 text-gray-500 bg-white/80 hover:bg-gray-100 hover:text-gray-700 rounded-full w-12 h-12 flex items-center justify-center shadow transition">
            <i class="fas fa-times text-2xl"></i>
        </a>

        <div class="p-6 space-y-6 overflow-y-auto max-h-screen">

            <!-- Gambar -->
            <div class="relative overflow-hidden w-full h-56 rounded-xl bg-gray-50 border shadow-inner">
                <img src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/makanan.png') }}"
                     alt="{{ $makanan->nama }}"
                     class="w-full h-full object-cover transition duration-700">
            </div>

            <!-- Nama & Harga -->
            <div class="text-center space-y-2">
                <h1 class="text-2xl font-bold text-gray-900">{{ $makanan->nama }}({{ $makanan->mitra->name }})</h1>
                <p class="text-xl font-bold bg-gradient-to-r from-orange-500 to-red-500 bg-clip-text text-transparent">
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


                @if ($makanan->rating_count > 0)
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
                    <p class="text-sm text-gray-500">{{ $makanan->rating_count }} ulasan</p>
                @else
                    <p class="text-sm text-gray-400">Belum ada ulasan</p>
                @endif
            </div>

            <!-- Deskripsi -->
            <div class="px-2 text-gray-700 text-justify leading-relaxed">
                {{ $makanan->deskripsi ?? 'Tidak ada deskripsi untuk makanan ini.' }}
            </div>

            <button onclick="openModal()"
                    class="pt-2 w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold rounded-xl py-3 text-lg flex items-center justify-center space-x-2 transition">
                <span>Pesan Sekarang</span>
                <i class="fas fa-shopping-bag"></i>
            </button>
            {{-- <!-- Button Pesan -->
            <form action="{{ route('mobile.buat.transaksi') }}" method="POST" class="pt-2">
                @csrf
                <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                <button type="submit"
                        class="w-full bg-gradient-to-r from-orange-400 to-orange-500 text-white font-semibold rounded-xl py-3 text-lg flex items-center justify-center space-x-2 transition">
                    <span>Pesan Sekarang</span>
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </form> --}}
            <div id="konfirmasiModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
                <div class="bg-white rounded-lg mx-4 w-full max-w-sm">
                    <div class="p-6">
                        <div class="flex items-center justify-center w-12 h-12 mx-auto bg-yellow-100 rounded-full mb-4">
                            <i class="fas fa-exclamation-circle text-yellow-600 text-xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Konfirmasi Pemesanan</h3>
                        <p class="text-sm text-gray-600 text-center mb-6">
                            Apakah anda yakin ingin memesans <span class="font-bold">{{ $makanan->nama }}</span>? Lanjutkan untuk Melakukan Pembayaran
                        </p>
                        <div class="flex space-x-3">
                            <button
                                onclick="closeModal()"
                                class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors">
                                Batal
                            </button>
                            <form action="{{ route('mobile.buat.transaksi') }}" method="POST"

                            class="flex-1 text-center px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700 transition-colors">
                                @csrf
                                <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                                <button type="submit">

                                    Lanjutkan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    function openModal() {
        document.getElementById('konfirmasiModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('konfirmasiModal').classList.add('hidden');
    }
</script>
@endsection
