@extends('layouts.page')

@section('navbar-guest')
@include('components.navbar')
@endsection

@section('content')
{{-- Hero Section --}}
<header class="relative bg-gradient-to-br from-[#FFF7ED] to-[#FFF1E7] overflow-hidden">
    {{-- Organic Orange Background Shape --}}
    <div class="absolute top-0 right-0 w-full h-full">
        <!-- <svg viewBox="0 0 1200 600" class="absolute top-0 right-0 w-full h-full" preserveAspectRatio="xMidYMid slice">
            <defs>
                <linearGradient id="orangeGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" style="stop-color:#FDBA74;stop-opacity:0.9" />
                    <stop offset="50%" style="stop-color:#FB923C;stop-opacity:0.8" />
                    <stop offset="100%" style="stop-color:#F97316;stop-opacity:0.9" />
                </linearGradient>
            </defs> 
            <path d="M400,0 Q800,50 1200,150 Q1200,300 1000,450 Q700,600 400,500 Q200,400 300,250 Q400,100 400,0 Z" 
                  fill="url(#orangeGradient)"/>
        </svg> -->
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
            {{-- Hero Content --}}
            <div class="space-y-6 text-center lg:text-left z-10 relative">
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold leading-tight">
                    <span class="relative inline-block">
                        <span class="relative z-10 px-2 bg-gradient-to-t from-orange-200/60 via-orange-100/40 to-transparent bg-no-repeat bg-bottom bg-[length:100%_0.6em]">
                            Don't Waste It, Taste It!
                        </span>
                    </span>
                </h1>
                
                <p class="text-base sm:text-lg text-gray-700 leading-relaxed max-w-lg mx-auto lg:mx-0">
                    Enjoy great food at a lower price while helping reduce food waste.
                </p>
                
                {{-- Get Started Button - Updated to Orange Theme --}}
                <a href="{{ route('foods') }}" 
                   class="group inline-flex items-center px-6 py-3 bg-gradient-to-r from-orange-400 to-orange-500 hover:from-orange-500 hover:to-orange-600 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                    <span class="mr-2">Get Started</span>
                    <div class="w-6 h-6 bg-white/20 rounded-full flex items-center justify-center group-hover:bg-white/30 transition-colors duration-200">
                        <i class="fas fa-arrow-right text-sm"></i>
                    </div>
                </a>
            </div>
            
            {{-- Hero Image --}}
            <div class="flex justify-end">
    <div class="w-60 h-60 overflow-hidden rounded-l-full drop-shadow-lg">
        <img src="{{ asset('images/makanan-guest.jpg') }}"
            alt="Ilustrasi makanan yang diselamatkan" 
            class="w-full h-full object-cover"
        />
    </div>
</div>
        </div>
    </div>
</header>

{{-- Main Content --}}
<main class="bg-white">
    {{-- Why Choose Us Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-xl md:text-2xl font-bold text-gray-900 mb-4">
                <span class="relative">
                    Why Choose Us?
                    <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-16 h-0.5 bg-[#00B1CC]"></span>
                </span>
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
            @php
                $features = [
                    [
                        'count' => '+500', 
                        'text' => 'Kemitraan dengan Pelaku Usaha Besar', 
                        'img' => 'food.png',
                    ],
                    [
                        'count' => '100%', 
                        'text' => 'Harga Lebih Terjangkau untuk Konsumen
', 
                        'img' => 'food.png',
                    ],
                    [
                        'count' => 'Hemat', 
                        'text' => 'Harga Terjangkau', 
                        'img' => 'food.png',
                    ],
                    [
                        'count' => 'Ramah Lingkungan', 
                        'text' => 'Kurangi Limbah Makanan', 
                        'img' => 'mariah-hewines-J89GBos3avo-unsplash.jpg',
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
                        <h3 class="text-lg md:text-xl font-bold text-[#00B1CC] mb-1">{{ $feature['count'] }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">{{ $feature['text'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Popular Course Section --}}
    <section class="bg-gradient-to-r from-orange-400 to-orange-500 relative overflow-hidden">
        <div class="absolute inset-0 bg-black/5"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-20">
            <div class="flex flex-col lg:flex-row items-start gap-8 lg:gap-16">
                {{-- Section Header --}}
                <div class="text-white lg:min-w-[300px]">
                    <h2 class="text-2xl md:text-3xl font-bold mb-4">
                        Popular Food</span>
                    </h2>
                    <p class="text-base md:text-lg text-white/90 leading-relaxed">
                        Discover the most popular food favorites! All of them are offered at a more affordable price because they come from leftover daily production that is still fit for consumption. 
                        Experience deliciousness without worry.
                    </p>
                </div>

                {{-- Food Cards --}}
                <div class="flex-1 relative">
                    <div class="flex gap-4 md:gap-6 overflow-x-auto scrollbar-hide pb-4 snap-x snap-mandatory">
                        @php
                            $courses = [
                                ['title' => 'Food Photography', 'img' => '8a904299-8ec6-4579-0a41-51259f46b3f6'],
                                ['title' => 'Creative Cooking', 'img' => '64b3815b-c816-4fd5-0246-1f2a77b3679e'],
                                ['title' => 'Healthy Recipes', 'img' => 'edde7589-669f-4504-bd2b-5c9a471b9610'],
                            ];
                        @endphp
                        
                        @foreach ($courses as $course)
                        <div class="min-w-[200px] md:min-w-[240px] bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 snap-start group">
                            <div class="relative overflow-hidden">
                                <img 
                                    src="https://storage.googleapis.com/a1aa/image/{{ $course['img'] }}.jpg"
                                    alt="{{ $course['title'] }}" 
                                    class="w-full h-32 md:h-36 object-cover group-hover:scale-105 transition-transform duration-300" 
                                />
                                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            </div>
                            <div class="p-4 md:p-5">
                                <h3 class="text-sm md:text-base font-semibold text-[#00B4C4] group-hover:text-[#007a8a] transition-colors duration-200">
                                    {{ $course['title'] }}
                                </h3>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    {{-- Navigation Buttons --}}
                    <button 
                        aria-label="Previous"
                        class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-2 bg-white/90 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-white hover:shadow-xl transition-all duration-200 z-10"
                    >
                        <i class="fas fa-chevron-left text-gray-700 text-sm"></i>
                    </button>
                    <button 
                        aria-label="Next"
                        class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-2 bg-white/90 backdrop-blur-sm rounded-full w-10 h-10 flex items-center justify-center shadow-lg hover:bg-white hover:shadow-xl transition-all duration-200 z-10"
                    >
                        <i class="fas fa-chevron-right text-gray-700 text-sm"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>

    {{-- Education content --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 md:py-24">
        <div class="text-center lg:text-left mb-12 md:mb-16">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Mini Education</span>
            </h2>
            <p class="text-sm md:text-base text-gray-600 leading-relaxed max-w-2x2 mx-auto lg:mx-0">
                Short and useful info on food, lifestyle and sustainability. Easy to understand, ready to implement!
            </p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6 lg:gap-8">
            @php
                $explore = [
                    ['title' => 'Photography', 'icon' => 'camera-retro', 'color' => 'from-purple-400 to-purple-500'],
                    ['title' => 'Artificial Intelligence', 'icon' => 'robot', 'color' => 'from-blue-400 to-blue-500'],
                    ['title' => 'Art', 'icon' => 'palette', 'color' => 'from-pink-400 to-pink-500'],
                    ['title' => 'Cooking', 'icon' => 'utensils', 'color' => 'from-orange-400 to-orange-500'],
                ];
            @endphp
            
            @foreach ($explore as $item)
            <div class="group bg-white rounded-2xl p-6 shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 cursor-pointer">
                <div class="text-center space-y-4">
                    <div class="w-16 h-16 mx-auto rounded-xl bg-gradient-to-br {{ $item['color'] }} flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-{{ $item['icon'] }} text-2xl text-white"></i>
                    </div>
                    <h3 class="text-sm md:text-base font-semibold text-gray-800 group-hover:text-[#00B1CC] transition-colors duration-200">
                        {{ $item['title'] }}
                    </h3>
                </div>
            </div>
            @endforeach
        </div>
    </section>
</main>
<x-footer />

@endsection