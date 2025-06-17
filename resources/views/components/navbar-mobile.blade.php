

<div class="fixed z-50 w-full h-20 max-w-lg -translate-x-1/2 bg-white border border-gray-200  bottom-0 left-1/2 ">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto pb-4">
        <a href="{{ route('foods') }}" data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50  group">
            {{-- <svg class="w-5 h-5 mb-1  {{ request()->routeIs('mobile.foods') ? 'text-blue-600 ' : 'text-gray-500' }} group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg> --}}
            <i class="fas fa-home text-2xl {{ request()->routeIs('mobile.foods') ? 'text-orange-400 ' : 'text-gray-500' }}"></i>
            <span class="sr-only">Home</span>
        </a>
        <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip">
            Home
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="{{ route('mobile.rekomendasimobile', 'random') }}" data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
            <i class="fas fa-gift text-2xl {{ request()->routeIs('mobile.rekomendasimobile') ? 'text-orange-400 ' : 'text-gray-500' }}"></i>
            <span class="sr-only">Rekomendasi</span>
        </a>
        <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Rekomendasi
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div class="flex items-center justify-center">
            <a href="{{ route('mobile.makananmobile') }}" data-tooltip-target="tooltip-new" type="button" class="inline-flex items-center justify-center w-10 h-10 font-medium {{ request()->routeIs('mobile.makananmobile') ? 'bg-orange-400' : 'bg-gray-500' }} rounded-full">

                <i class="fas fa-utensils text-white"></i>
                <span class="sr-only">Makanan</span>
            </a>
        </div>
        <div id="tooltip-new" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Makanan
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="{{ route('mobile.transaksiberlangsung') }}" data-tooltip-target="tooltip-settings" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50  group">
            <i class="fas fa-clipboard-list text-2xl {{ request()->routeIs('mobile.transaksiberlangsung') || request()->routeIs('mobile.semua-transaksi') ? 'text-orange-400 ' : 'text-gray-500' }}"></i>
            <span class="sr-only">pesanan saya</span>
        </a>
        <div id="tooltip-settings" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Pesanan Saya
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        @php
            $user = Auth::user();
        @endphp
        <a href="{{ route('mobile.profile') }}" data-tooltip-target="tooltip-profile" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-e-full hover:bg-gray-50  group">
            <img src="{{ Auth::user()->profpic ? asset('storage/' . $user->profpic) : asset('images/user.png') }}" alt="Profile" class="w-7 h-7 {{ request()->routeIs('mobile.profile')  ? 'border border-orange-400' : 'grayscale border border-gray-950' }} rounded-full mb-1 group-hover:filter group-hover:brightness-125">
            <span class="sr-only">Profile</span>
        </a>
        <div id="tooltip-profile" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Profile
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
</div>
