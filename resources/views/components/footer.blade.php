<footer class="relative overflow-hidden bg-gradient-to-br from-orange-100 via-white to-orange-50">
    {{-- Decorative Background Elements --}}
    <div class="absolute inset-0">
        <div class="absolute -top-16 -left-16 w-[250px] h-[250px] bg-orange-300 opacity-20 rounded-full filter blur-2xl"></div>
        <div class="absolute top-0 right-0 w-[180px] h-[180px] bg-orange-200 opacity-30 rounded-full filter blur-2xl"></div>
        <div class="absolute bottom-12 left-1/3 w-[220px] h-[220px] bg-orange-200 opacity-15 rounded-full filter blur-2xl"></div>
        <div class="absolute bottom-6 right-6 w-[150px] h-[150px] bg-orange-300 opacity-25 rounded-full filter blur-2xl"></div>
    </div>

    <div class="relative max-w-6xl mx-auto px-6 py-8">
        {{-- Brand Section --}}
        <div class="text-center mb-6">
            <h3 class="text-2xl font-extrabold text-orange-600">FOGO</h3>
            <p class="text-md text-gray-700 max-w-md mx-auto leading-relaxed">
                Platform untuk menyelamatkan makanan sisa produksi yang masih layak konsumsi dari gerai-gerai makanan favoritmu.
            </p>
        </div>

        {{-- Contact Section --}}
        <div class="flex flex-wrap justify-center gap-3 mb-4">
            {{-- Email --}}
                <div class="w-6 h-6 bg-blue-400 rounded-md flex items-center justify-center">
                    <img src="{{ asset('images/icons/email.svg') }}" class="w-4 h-4">
                </div>
                <p class="text-sm text-orange-700 font-semibold">support@fogo.id</p>

            {{-- Telepon --}}
                <div class="w-6 h-6 bg-green-400 rounded-md flex items-center justify-center">
                    <img src="{{ asset('images/icons/telepon.svg') }}" class="w-5 h-5">
                </div>
                <p class="text-sm text-orange-700 font-semibold">0812-3456-7890</p>

            {{-- Lokasi --}}
                <div class="w-6 h-6 bg-red-400 rounded-md flex items-center justify-center">
                    <img src="{{ asset('images/icons/map2.svg') }}" class="w-5 h-5">
                </div>
                <p class="text-sm text-orange-700 font-semibold">Semarang, Indonesia</p>
        </div>

        {{-- Social Media --}}
        <div class="text-center mb-4">
            <h4 class="text-orange-700 font-semibold text-sm mb-1">Ikuti Kami</h4>
            <div class="flex justify-center space-x-2">
                <a href="https://www.instagram.com" target="_blank" class="group w-8 h-8 bg-white/70 backdrop-blur-sm rounded-xl flex items-center justify-center border border-orange-200 hover:bg-orange-100 hover:scale-110 transition-all duration-300 shadow">
                    <img src="{{ asset('images/icons/instagram.png') }}" alt="Instagram" class="w-4 h-4 group-hover:opacity-80 transition-opacity">
                </a>
                <a href="https://x.com/" target="_blank" class="group w-8 h-8 bg-white/70 backdrop-blur-sm rounded-xl flex items-center justify-center border border-orange-200 hover:bg-orange-100 hover:scale-110 transition-all duration-300 shadow">
                    <img src="{{ asset('images/icons/twitter.png') }}" alt="Twitter" class="w-4 h-4 group-hover:opacity-80 transition-opacity">
                </a>
                <a href="https://www.facebook.com/?locale=id_ID" target="_blank" class="group w-8 h-8 bg-white/70 backdrop-blur-sm rounded-xl flex items-center justify-center border border-orange-200 hover:bg-orange-100 hover:scale-110 transition-all duration-300 shadow">
                    <img src="{{ asset('images/icons/facebook.png') }}" alt="Facebook" class="w-4 h-4 group-hover:opacity-80 transition-opacity">
                </a>
                <a href="https://www.whatsapp.com/?lang=id" target="_blank" class="group w-8 h-8 bg-white/70 backdrop-blur-sm rounded-xl flex items-center justify-center border border-orange-200 hover:bg-orange-100 hover:scale-110 transition-all duration-300 shadow">
                    <img src="{{ asset('images/icons/whatsapp.png') }}" alt="WhatsApp" class="w-4 h-4 group-hover:opacity-80 transition-opacity">
                </a>
            </div>
        </div>

        {{-- Copyright --}}
        <div class="text-center pt-4 border-t border-orange-200">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 bg-white/60 backdrop-blur-sm rounded-full border border-orange-200 shadow">
                <div class="w-5 h-5 bg-orange-400 rounded-full flex items-center justify-center">
                    <span class="text-white font-bold text-xs">©</span>
                </div>
                <p class="text-xs text-orange-600 font-semibold">2025 FOGO. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>
