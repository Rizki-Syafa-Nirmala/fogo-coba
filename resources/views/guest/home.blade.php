@extends('layouts.page')

@section('navbar-guest')
@include('components.navbar')
@endsection

@section('content')
{{-- Hero Section --}}
<header class="relative bg-gradient-to-br from-orange-100 via-white to-white overflow-hidden">
    <div class="absolute -top-20 -left-20 w-[500px] h-[500px] bg-orange-300 opacity-20 rounded-full filter blur-3xl"></div>
    <div class="absolute top-0 right-0 w-[300px] h-[300px] bg-orange-200 opacity-30 rounded-full filter blur-2xl"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-32 flex flex-col-reverse lg:flex-row items-center gap-16">

        {{-- Text Content --}}
        <div class="flex-1 text-center lg:text-left animate-fade-in-up">
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold leading-tight text-orange-500 drop-shadow-sm">
                Don't Waste<span class="text-gray-900">, Taste It!</span>
            </h1>
            <p class="mt-6 text-lg sm:text-xl text-gray-700 leading-relaxed max-w-lg mx-auto lg:mx-0">
                Nikmati makanan lezat dengan harga lebih rendah sambil membantu mengurangi sampah makanan.
            </p>
            
            {{-- Get Started Button - Improved --}}
            <a href="{{ route('foods') }}" 
               class="group mt-8 inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold rounded-full shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-300">
                <span class="mr-3 text-lg">Get Started</span>
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-300">
                    <i class="fas fa-arrow-right animate-bounce-right text-md"></i>
                </div>
            </a>
        </div>

        {{-- Image Content --}}
        <div class="flex-1 relative flex justify-center items-center animate-fade-in">
            <div class="absolute w-[380px] h-[380px] bg-orange-400 rounded-full shadow-2xl opacity-30"></div>
            <div class="absolute w-[320px] h-[320px] bg-orange-500 rounded-full shadow-2xl opacity-50"></div>
            <div class="relative w-[300px] h-[300px] overflow-hidden rounded-full shadow-xl ring-4 ring-white">
                <img src="{{ asset('images/makanan-guest.jpg') }}" alt="Food Image" class="w-full h-full object-cover">
            </div>
        </div>

    </div>
</header>

{{-- Main Content --}}
<main class="bg-white">
    {{-- Why Choose Us Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-20">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">
                <span class="relative">
                    Kenapa Harus FOGO?
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-0.5 bg-[#00B1CC]"></span>
                </span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            @php
                $features = [
                    [
                        'count' => 'Kemitraan', 
                        'text' => 'Kemitraan dengan pelaku usaha besar', 
                        'img' => 'mitra.jpg',
                    ],
                    [
                        'count' => 'Harga Terjangkau', 
                        'text' => 'Harga lebih terjangkau untuk konsumen',
                        'img' => 'uang.jpg',
                    ],
                    [
                        'count' => 'Peduli Sosial', 
                        'text' => 'Menjadi bagian dari gerakan peduli sosial dan lingkungan', 
                        'img' => 'sosial.jpg',
                    ],
                    [
                        'count' => 'Ramah Lingkungan', 
                        'text' => 'Mengurangi dampak limbah makanan dan emisi karbon', 
                        'img' => 'sampah.jpg',
                    ],
                ];
            @endphp

            @foreach ($features as $feature)
            <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-16 h-16 rounded-xl bg-cover p-3 group-hover:scale-110 transition-transform duration-300"
                        style="background-image: url('{{ asset('images/' . $feature['img']) }}')">
                    </div>
                    <div>
                        <h3 class="text-lg md:text-xl font-bold text-orange-300 mb-1">{{ $feature['count'] }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $feature['text'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Food Section --}}
    <section class="relative bg-gradient-to-br from-orange-400 via-orange-300 to-orange-200 overflow-hidden">
        <div class="absolute inset-0 bg-black/5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
            <div class="flex flex-col lg:flex-row items-start gap-8 lg:gap-16">
                {{-- Section Header --}}
                <div class="text-white lg:min-w-[300px]">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">Harga Makanan Terjangkau!</h2>
                    <p class="text-base md:text-lg text-white/90 leading-relaxed">
                        Pilihan pas buat kamu yang pengen makan enak tapi tetap irit. Nggak perlu mahal buat bisa puas!
                    </p>
                </div>

                {{-- Food Cards --}}
                <div class="flex gap-4 md:gap-6 overflow-x-auto scrollbar-hide pb-4">
                    @foreach ($makanans as $makanan)
                    <a href="{{ route('filament.user.auth.login')}}" class="makanan-item {{ $loop->index >= 10 ? 'hidden' : '' }} flex-shrink-0 relative rounded-xl overflow-hidden bg-gray-100 w-40 aspect-square flex flex-col justify-end shadow-md">
                        <img alt="Food Image" class="w-60 h-full object-cover absolute inset-0" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"/>
                        @if ($makanan->rating_count > 0)
                        <div class="absolute top-3 left-3 bg-black bg-opacity-50 rounded-md px-2 py-1 text-yellow-400 text-sm font-semibold flex items-center space-x-1">
                            <i class="fas fa-star"></i>
                            <span>{{ $makanan->averange_rating }}</span>
                        </div>
                        @endif
                        <div class="relative z-10 px-2 py-1 bg-gray-900/50 rounded-b-xl">
                            <h3 class="text-orange-300 font-semibold text-xl w-full flex items-center gap-1">
                                <span class="truncate block max-w-[90%]">{{ $makanan->nama }}</span>
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
    </section>

    {{-- Cara Pemesanan Section --}}
    <section class="py-12 px-6 sm:px-12 md:px-20 bg-gradient-to-br from-orange-50 via-white to-orange-50">
        <div class="max-w-7xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">
                Cara Pemesanan
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-10">
                <div class="flex flex-col items-center space-y-4 group">
                    <div class="bg-orange-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        1
                    </div>
                    <div class="relative">
                        <img alt="Ilustrasi memilih makanan sisa produksi di aplikasi, gambar tangan menunjuk layar ponsel dengan gambar makanan" 
                             class="w-24 h-24 object-contain group-hover:scale-105 transition-transform duration-300" 
                             height="120" 
                             src="https://storage.googleapis.com/a1aa/image/e4f564cf-38e3-46d5-10f5-930b4a7272cf.jpg" 
                             width="120"/>
                        <div class="absolute inset-0 bg-orange-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 group-hover:text-orange-600 transition-colors duration-300">
                        Pilih Makanan
                    </h3>
                    <p class="text-gray-600 max-w-xs leading-relaxed">
                        Telusuri dan pilih makanan sisa produksi yang ingin Anda pesan.
                    </p>
                </div>
                
                <div class="flex flex-col items-center space-y-4 group">
                    <div class="bg-orange-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        2
                    </div>
                    <div class="relative">
                        <img alt="Ilustrasi konfirmasi pesanan makanan, gambar tangan menekan tombol konfirmasi di layar ponsel" 
                             class="w-24 h-24 object-contain group-hover:scale-105 transition-transform duration-300" 
                             height="120" 
                             src="https://storage.googleapis.com/a1aa/image/4d2b1e7e-5279-4c79-87f8-ccba5854507d.jpg" 
                             width="120"/>
                        <div class="absolute inset-0 bg-orange-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 group-hover:text-orange-600 transition-colors duration-300">
                        Konfirmasi Pesanan
                    </h3>
                    <p class="text-gray-600 max-w-xs leading-relaxed">
                        Pastikan pesanan Anda sudah benar dan lakukan konfirmasi.
                    </p>
                </div>
                
                <div class="flex flex-col items-center space-y-4 group">
                    <div class="bg-orange-600 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl font-bold group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        3
                    </div>
                    <div class="relative">
                        <img alt="Ilustrasi mengambil makanan di tempat penjual, gambar orang mengambil makanan di konter warung" 
                             class="w-24 h-24 object-contain group-hover:scale-105 transition-transform duration-300" 
                             height="120" 
                             src="https://storage.googleapis.com/a1aa/image/809a78c4-a86f-4c44-880e-fe0b76eaaaf5.jpg" 
                             width="120"/>
                        <div class="absolute inset-0 bg-orange-100 rounded-full opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 group-hover:text-orange-600 transition-colors duration-300">
                        Ambil Makanan
                    </h3>
                    <p class="text-gray-600 max-w-xs leading-relaxed">
                        Datang ke penjual dan ambil makanan yang sudah Anda pesan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Education content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center lg:text-left mb-12 md:mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Mini Education</h2>
            <p class="text-sm md:text-base text-gray-600 leading-relaxed max-w-auto mx-auto lg:mx-0">
                Sampah makanan jadi masalah besar yang sering kita anggap sepele. Di Indonesia sendiri, jutaan ton makanan terbuang tiap tahun—padahal banyak yang masih layak makan. 
                Bukan cuma makanannya yang terbuang, tapi juga energi, air, dan sumber daya yang dipakai untuk memproduksinya. Lewat FOGO, yuk bareng-bareng jadi bagian dari gerakan penyelamatan makanan. Mulai dari belajar bareng, ubah kebiasaan, sampai eksplor ide kreatif dari sisa makanan. 
                Nggak perlu nunggu nanti—kita bisa mulai dari sekarang!
            </p>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
            @php
                $explore = [
                    ['title' => 'Best Before vs Expired', 'img' => 'images/date.png', 'color' => 'from-purple-400 to-purple-500', 'route' => 'edukasi'],
                    ['title' => 'Rahasia Roti Tetap Empuk', 'img' => 'images/artikel2.png', 'color' => 'from-blue-400 to-blue-500', 'route' => 'edukasi'],
                    ['title' => 'Tips Aman Simpan Makanan Sisa', 'img' => 'images/artikel3.png', 'color' => 'from-pink-400 to-pink-500', 'route' => 'edukasi'],
                    ['title' => 'Food Waste: The Hidden Cost of the Food We Throw Out I ClimateScience', 'img' => 'images/artikel4.png', 'color' => 'from-pink-400 to-pink-500', 'route' => 'edukasi'],
                ];
            @endphp
    
            @foreach ($explore as $item)
            <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100">
                <div class="flex flex-col items-center text-center space-y-4">
                    <div class="w-16 h-16 rounded-xl bg-cover p-3 group-hover:scale-110 transition-transform duration-300"
                        style="background-image: url('{{ asset($item['img']) }}')">
                    </div>
                    <div>
                        <h3 class="text-sm md:text-base font-semibold text-gray-800 group-hover:text-[#00B1CC] transition-colors duration-200">
                            {{ $item['title'] }}
                        </h3>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    
</main>
<x-footer />

{{-- Optional: Add simple custom animations --}}
<style>
@keyframes fade-in-up {
    0% { opacity: 0; transform: translateY(20px); }
    100% { opacity: 1; transform: translateY(0); }
}
@keyframes fade-in {
    0% { opacity: 0; }
    100% { opacity: 1; }
}
@keyframes bounce-right {
    0%, 100% { transform: translateX(0); }
    50% { transform: translateX(5px); }
}

.animate-fade-in-up {
    animation: fade-in-up 1s ease-out both;
}
.animate-fade-in {
    animation: fade-in 1.5s ease-out both;
}
.animate-bounce-right {
    animation: bounce-right 1s infinite;
}

.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
@endsection