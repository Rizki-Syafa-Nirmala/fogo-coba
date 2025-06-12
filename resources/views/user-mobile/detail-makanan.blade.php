@extends('layouts.page')

@section('content-user-mobile')


<div class="pb-20 pt-2 ">

    <div class="max-w-md w-full bg-white rounded-lg  overflow-hidden">
        <div class="relative bg-[#fefefe] rounded-b-[100px]">
            <img alt="{{ $makanan->nama }}" class="w-full object-contain pt-12" height="300" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}" width="400"/>
            @php
                $previousUrl = url()->previous();
                $currentUrl = url()->current();

                // Ganti dengan pattern URL yang benar
                $shouldRedirectToFoods = !Str::contains($previousUrl, [
                    '/mobile/rekomendasi/',     // sesuai URL pattern asli
                    '/mobile/makanan/Kategori'  // sesuai URL pattern asli
                ]) || $previousUrl == $currentUrl;
            @endphp
            <a href="{{ $shouldRedirectToFoods ? route('foods') : $previousUrl }}" class="absolute top-4 left-4 text-black text-xl">
                <i class="fas fa-arrow-left">
                </i>
            </a>
        </div>
        <hr class="border-b border-gray-900 shadow-lg"/>
        <div class="py-6 px-2 space-y-4">
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
            </p>
            <!-- Ganti bagian form di file blade Anda dengan ini -->
            <div class="fixed bottom-0 left-0 w-full px-2 pb-8 bg-white z-50">
                <button onclick="showConfirmation()" class="w-full bg-orange-400 hover:bg-orange-500 text-white font-semibold rounded-md py-3 flex items-center justify-center space-x-2 transition-colors">
                    <span>Pesan Sekarang</span>
                    <i class="fas fa-shopping-bag"></i>
                </button>
            </div>

            <!-- Modal Konfirmasi -->
            <div id="confirmationModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-[60] hidden">
                <div class="bg-white rounded-lg p-6 mx-4 max-w-sm w-full">
                    <div class="text-center">
                        <div class="mb-4">
                            <i class="fas fa-question-circle text-orange-400 text-4xl"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Konfirmasi Pemesanan
                        </h3>
                        <p class="text-gray-600 mb-6">
                            Apakah Anda yakin ingin memesan <strong>{{ $makanan->nama }}</strong> seharga <strong>Rp {{ number_format($makanan->harga, 0, ',', '.') }}</strong>?
                        </p>
                        <div class="flex space-x-3">
                            <button onclick="hideConfirmation()" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-md transition-colors">
                                Batal
                            </button>
                            <button onclick="confirmOrder()" class="flex-1 bg-orange-400 hover:bg-orange-500 text-white font-semibold py-2 px-4 rounded-md transition-colors">
                                Ya, Pesan
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form tersembunyi untuk submit -->
            <form id="orderForm" action="{{ route('mobile.buat.transaksi') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
            </form>
            {{-- <div class="fixed bottom-0 left-0 w-full px-2 pb-8 bg-white z-50">
                <form action="{{ route('mobile.buat.transaksi') }}" method="POST">
                    @csrf
                    <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                    <button type="submit" class="w-full bg-orange-400 text-white font-semibold rounded-md py-3 flex items-center justify-center space-x-2">
                        <span>Pesan Sekarang</span>
                        <i class="fas fa-shopping-bag"></i>
                    </button>
                </form>
            </div> --}}
        </div>
    </div>
</div>
<script>
function showConfirmation() {
    document.getElementById('confirmationModal').classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideConfirmation() {
    document.getElementById('confirmationModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function confirmOrder() {
    // Submit form setelah konfirmasi
    document.getElementById('orderForm').submit();
}

// Close modal when clicking outside
document.getElementById('confirmationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideConfirmation();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideConfirmation();
    }
});
</script>

@endsection
