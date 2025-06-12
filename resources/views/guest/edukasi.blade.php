@extends('layouts.page')

@section('navbar-guest')
@include('components.navbar')

<section class="bg-gradient-to-br from-orange-50 via-amber-50 to-yellow-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        {{-- Hero Section with Overlay --}}
        <div class="relative mb-12 rounded-3xl overflow-hidden shadow-2xl">
            <img src="{{ asset('images/bakery.jpg') }}" alt="Memahami Tanggal Kadaluarsa" class="w-full h-96 object-cover">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center text-2xl">
                        📅
                    </div>
                    <div class="text-sm opacity-90">
                        <p class="font-medium">FOGO Tips</p>
                        <p>{{ date('d M Y') }}</p>
                    </div>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-4">
                    Memahami Tanggal Kadaluarsa untuk Mengurangi Food Waste
                </h1>
                <p class="text-lg opacity-90 max-w-2xl">
                    Jangan buru-buru buang makanan! Pahami dulu perbedaan antara "Best Before" dan "Expired Date"
                </p>
            </div>
        </div>

        {{-- Main Content Card --}}
        <div class="bg-white rounded-3xl shadow-xl p-8 md:p-12 mb-8">
            
            {{-- Introduction with Icon --}}
            <div class="flex items-start gap-4 mb-8 p-6 bg-gradient-to-r from-red-50 to-orange-50 rounded-2xl border-l-4 border-red-400">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-red-700 mb-2">Fakta Mengejutkan!</h3>
                    <p class="text-gray-700 leading-relaxed">
                        Salah satu penyebab utama food waste yang terjadi di rumah tangga adalah kesalahpahaman terhadap tanggal kadaluarsa. Banyak orang langsung membuang makanan begitu melihat tanggal yang tertera di kemasan, tanpa benar-benar memahami artinya.
                    </p>
                </div>
            </div>

            {{-- Best Before vs Expired Date Comparison --}}
            <div class="grid md:grid-cols-2 gap-6 mb-10">
                {{-- Best Before Card --}}
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 p-6 rounded-2xl border border-green-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-green-700">Best Before</h3>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Mengacu pada <strong>kualitas makanan</strong>, bukan keamanannya. Setelah tanggal tersebut, makanan mungkin tidak lagi memiliki rasa, aroma, atau tekstur terbaik, tapi tetap bisa dikonsumsi jika tidak ada perubahan fisik atau bau mencurigakan.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Makanan Kering</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Snack</span>
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-sm rounded-full">Produk Kaleng</span>
                    </div>
                </div>

                {{-- Expired Date Card --}}
                <div class="bg-gradient-to-br from-red-50 to-pink-50 p-6 rounded-2xl border border-red-200 hover:shadow-lg transition-all duration-300">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-red-700">Expired Date</h3>
                    </div>
                    <p class="text-gray-700 mb-4">
                        Adalah <strong>batas keamanan konsumsi</strong>. Melewati tanggal ini, makanan berisiko menimbulkan gangguan kesehatan karena kontaminasi bakteri atau jamur.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">Susu</span>
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">Yoghurt</span>
                        <span class="px-3 py-1 bg-red-100 text-red-700 text-sm rounded-full">Daging Olahan</span>
                    </div>
                </div>
            </div>

            {{-- Statistics Section --}}
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-2xl mb-8 border border-blue-200">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-blue-500 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-blue-700">Data Mengejutkan</h3>
                        <p class="text-blue-600">Survei WRAP UK (2020)</p>
                    </div>
                </div>
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">70%</div>
                        <p class="text-gray-700">Masyarakat membuang makanan karena salah mengartikan label tanggal</p>
                    </div>
                    <div class="text-center">
                        <div class="text-4xl font-bold text-blue-600 mb-2">🇮🇩</div>
                        <p class="text-gray-700">Di Indonesia, fenomena ini juga sering terjadi karena kurangnya edukasi</p>
                    </div>
                </div>
            </div>

            {{-- 3P Method Section --}}
            <div class="bg-gradient-to-br from-orange-50 to-yellow-50 p-8 rounded-2xl border-l-4 border-orange-400 mb-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">3P</span>
                    </div>
                    <h3 class="text-2xl font-bold text-orange-700">Metode 3P Sebelum Membuang Makanan</h3>
                </div>
                
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="text-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-purple-700 mb-2">1. Perhatikan</h4>
                        <p class="text-sm text-gray-600">Apakah ada perubahan warna, jamur, atau tekstur yang aneh?</p>
                    </div>
                    
                    <div class="text-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4V2a1 1 0 011-1h8a1 1 0 011 1v2m-9 0h10m-10 0a2 2 0 00-2 2v14a2 2 0 002 2h10a2 2 0 002-2V6a2 2 0 00-2-2"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-green-700 mb-2">2. Penciuman</h4>
                        <p class="text-sm text-gray-600">Apakah aromanya masih normal atau sudah tengik/asam?</p>
                    </div>
                    
                    <div class="text-center p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-blue-700 mb-2">3. Pencicipan</h4>
                        <p class="text-sm text-gray-600">Untuk makanan yang ragu-ragu, coba sedikit dulu dengan hati-hati</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Action Section --}}
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <div class="text-center mb-8">
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Mulai Kurangi Food Waste Hari Ini!</h3>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Dengan memahami perbedaan tanggal kadaluarsa, kita bisa mengurangi pemborosan makanan hingga 30%. Mari bersama-sama melawan food waste!
                </p>
            </div>
            
            {{-- Navigation Section --}}
            <div class="flex flex-col sm:flex-row justify-between items-center gap-6 pt-6 border-t border-gray-200">
                <a href="{{ url()->previous() != url()->current() ? url()->previous() : route('guest.home') }}" 
                   class="group inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-500 to-red-500 text-white font-semibold rounded-full hover:from-orange-600 hover:to-red-600 transform hover:scale-105 transition-all duration-300 shadow-lg">
                    <svg class="w-5 h-5 mr-3 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span>Kembali</span>
                </a>
                
                {{-- Enhanced Share Buttons --}}
                <div class="flex items-center gap-4">
                    <span class="text-gray-500 text-sm font-medium">Bagikan artikel ini:</span>
                    <div class="flex space-x-3">
                        <a href="#" class="group w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-facebook-f text-sm group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-blue-400 hover:bg-blue-500 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-twitter text-sm group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-pink-600 hover:bg-pink-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-instagram text-sm group-hover:scale-110 transition-transform"></i>
                        </a>
                        <a href="#" class="group w-12 h-12 bg-green-600 hover:bg-green-700 text-white rounded-full flex items-center justify-center transition-all duration-300 transform hover:scale-110 shadow-lg">
                            <i class="fab fa-whatsapp text-sm group-hover:scale-110 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="text-center py-8">
            <div class="inline-flex items-center gap-3 px-6 py-3 bg-white rounded-full shadow-lg">
                <div class="w-8 h-8 bg-orange-500 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-sm">F</span>
                </div>
                <p class="text-gray-600 font-medium">&copy; {{ date('Y') }} FOGO - Fighting Food Waste Together</p>
            </div>
        </div>
    </div>
</section>

{{-- Add some custom CSS for animations --}}
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.6s ease-out;
}

.hover-lift:hover {
    transform: translateY(-5px);
}
</style>
@endsection