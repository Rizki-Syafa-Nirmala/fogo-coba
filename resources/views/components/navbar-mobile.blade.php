

<div class="fixed z-50 w-full h-20 max-w-lg -translate-x-1/2 bg-white border border-gray-200  bottom-0 left-1/2 ">
    <div class="grid h-full max-w-lg grid-cols-5 mx-auto pb-4">
        <a href="{{ route('foods') }}" data-tooltip-target="tooltip-home" type="button" class="inline-flex flex-col items-center justify-center px-5 rounded-s-full hover:bg-gray-50  group">
            <svg class="w-5 h-5 mb-1  {{ request()->routeIs('mobile.foods') ? 'text-blue-600 ' : 'text-gray-500' }} group-hover:text-blue-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
            </svg>
            <span class="sr-only">Home</span>
        </a>
        <div id="tooltip-home" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip">
            Home
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="{{ route('mobile.rekomendasimobile', 'random') }}" data-tooltip-target="tooltip-wallet" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50">
            <svg class=" mb-1  {{ request()->routeIs('mobile.rekomendasimobile') ? 'text-blue-600 ' : 'text-gray-500' }} group-hover:text-blue-600" weight="22" height="22" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 512 512" xmlns:xlink="http://www.w3.org/1999/xlink">
            <path d="M482 259l-452 0c-16,0 -30,-13 -30,-30 0,-17 14,-31 30,-31l452 0c16,0 30,15 30,31 0,16 -14,30 -30,30z"></path>
            <path d="M418 493l-324 0c-11,0 -20,-7 -25,-22 0,0 0,0 0,0l-48 -199c3,1 6,1 9,1l452 0c3,0 6,0 9,-1l-49 199c-3,13 -13,22 -24,22zm-47 -35c-4,0 -7,-3 -7,-7l0 -160c0,-4 3,-7 7,-7 4,0 7,3 7,7l0 160c0,4 -3,7 -7,7zm-58 0c-4,0 -7,-3 -7,-7l0 -160c0,-4 3,-7 7,-7 4,0 7,3 7,7l0 160c0,4 -3,7 -7,7zm-57 0c-4,0 -7,-3 -7,-7l0 -160c0,-4 3,-7 7,-7 4,0 7,3 7,7l0 160c0,4 -3,7 -7,7zm-58 0c-4,0 -7,-3 -7,-7l0 -160c0,-4 3,-7 7,-7 4,0 7,3 7,7l0 160c0,4 -3,7 -7,7zm-57 0c-4,0 -7,-3 -7,-7l0 -160c0,-4 3,-7 7,-7 4,0 7,3 7,7l0 160c0,4 -3,7 -7,7z"></path>
            <path d="M457 493l-402 0c-4,0 -7,-3 -7,-7 0,-4 3,-7 7,-7l402 0c4,0 7,3 7,7 0,4 -3,7 -7,7z"></path>
            <path d="M49 184l0 -126c0,-20 17,-37 38,-37 20,0 37,17 37,37l0 126 -75 0z"></path>
            <path d="M345 184l0 -28 118 -55 0 35 -105 48 -13 0zm0 -45l0 -41 103 -48c1,0 1,0 2,-1 6,11 11,23 12,37l-117 53zm1 -58c3,-14 8,-26 15,-37 12,-15 27,-23 43,-23 13,0 26,6 37,17 -1,0 -1,0 -1,0l-94 43zm117 71l0 32 -70 0 70 -32z"></path>
            <path d="M194 184l-3 -5 98 -58 13 23 -68 40 -40 0zm-11 -17l0 -1c-7,-13 -6,-22 -5,-30 2,-8 3,-18 -4,-37l55 -32c1,0 1,0 2,0 12,15 22,19 30,23 7,4 14,8 20,18l0 1 -98 58zm127 -11l16 28 -64 0 48 -28z"></path>
            <path d="M163 88c-1,0 -1,0 -2,0 -2,-1 -3,-2 -4,-3l-8 -15c-7,-11 -3,-26 8,-33 1,0 1,0 1,0l25 -15c6,-3 13,-4 19,-2 6,1 11,6 14,11l9 15c1,1 1,3 1,5 -1,2 -2,3 -3,4l-56 32c-2,1 -3,1 -4,1z"></path>
            </svg>
            <span class="sr-only">Rekomendasi</span>
        </a>
        <div id="tooltip-wallet" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Rekomendasi
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <div class="flex items-center justify-center">
            <a href="{{ route('mobile.makananmobile') }}" data-tooltip-target="tooltip-new" type="button" class="inline-flex items-center justify-center w-10 h-10 font-medium {{ request()->routeIs('mobile.makananmobile') ? 'bg-blue-700' : 'bg-gray-500' }} rounded-full hover:bg-blue-700 group focus:ring-4 focus:ring-blue-300 focus:outline-none ">
                    <svg class="w-6 h-6 text-white" fill="currentColor" aria-hidden="true" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 32 32" style="enable-background:new 0 0 32 32;" xml:space="preserve">

                    <path class="st0" d="M6.5,13.5c-2.6-2.6-2.6-6.7,0-9.3l11.1,11.1l3.7,3.7l5.7,5.7c1,1,1,2.5,0,3.5l0,0c-1,1-2.8,1-3.7-0.2l-4.1-5.1 c-1-1.3-2.8-1.7-4.4-1.1l0,0L6.5,13.5z"></path>

                    <path class="st0" d="M19.1,16.8c0.4-0.1,0.7-0.1,1.1-0.2c1.3-0.1,2.8-0.8,4.3-2.3l4.9-4.9"></path>
                    <path class="st0" d="M12.3,19.3L5.3,25c-1.1,0.8-1.2,2.4-0.2,3.3c1,1,2.5,0.8,3.3-0.2l5.7-7.1"></path>
                    <path class="st0" d="M24,4L19,8.9c-1.5,1.5-2.3,3-2.3,4.3c0,0.4-0.1,0.7-0.2,1.1"></path>
                    </svg>
                <span class="sr-only">Makanan</span>
            </a>
        </div>
        <div id="tooltip-new" role="tooltip" class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-xs opacity-0 tooltip ">
            Makanan
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <a href="{{ route('mobile.transaksiberlangsung') }}" data-tooltip-target="tooltip-settings" type="button" class="inline-flex flex-col items-center justify-center px-5 hover:bg-gray-50  group">
            <svg class="mb-1 {{ request()->routeIs('mobile.transaksiberlangsung') || request()->routeIs('mobile.semua-transaksi') ? 'text-blue-600 ' : 'text-gray-500' }} group-hover:text-blue-600" width="22" height="22" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" aria-hidden="true"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:serif="http://www.serif.com/" style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;">
                <path d="M8.261,3.75l-0.761,0c-0.414,0 -0.75,0.336 -0.75,0.75l-0,2.5c-0,0.414 0.336,0.75 0.75,0.75l9,0c0.414,0 0.75,-0.336 0.75,-0.75l0,-2.5c0,-0.414 -0.336,-0.75 -0.75,-0.75l-0.761,0c-0.127,-1.402 -1.305,-2.5 -2.739,-2.5l-2,0c-1.434,0 -2.612,1.098 -2.739,2.5Z"></path>
                <path d="M5.75,4.75l-0.25,0c-0.967,0 -1.75,0.784 -1.75,1.75l0,14.5c0,0.967 0.784,1.75 1.75,1.75c2.727,0 10.273,0 13,0c0.966,0 1.75,-0.783 1.75,-1.75l0,-14.5c-0,-0.966 -0.783,-1.75 -1.75,-1.75l-0.25,0l0,2.25c0,0.966 -0.784,1.75 -1.75,1.75c-0,0 -9,0 -9,0c-0.966,0 -1.75,-0.784 -1.75,-1.75l0,-2.25Zm2.25,14l8,0c0.414,0 0.75,-0.336 0.75,-0.75c0,-0.414 -0.336,-0.75 -0.75,-0.75l-8,0c-0.414,0 -0.75,0.336 -0.75,0.75c0,0.414 0.336,0.75 0.75,0.75Zm0,-3.5l8,0c0.414,0 0.75,-0.336 0.75,-0.75c0,-0.414 -0.336,-0.75 -0.75,-0.75l-8,0c-0.414,0 -0.75,0.336 -0.75,0.75c0,0.414 0.336,0.75 0.75,0.75Zm1.5,-3.5l5,0c0.414,0 0.75,-0.336 0.75,-0.75c0,-0.414 -0.336,-0.75 -0.75,-0.75l-5,0c-0.414,0 -0.75,0.336 -0.75,0.75c0,0.414 0.336,0.75 0.75,0.75Z"></path>
            </svg>
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
