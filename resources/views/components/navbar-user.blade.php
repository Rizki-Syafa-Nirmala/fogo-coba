

<nav class="fixed top-0 left-0 z-50 w-full bg-white border-b border-orange-100 shadow-md  ">
    <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <a href="{{ route('foods') }}" class="flex items-center space-x-3">
                <img src="{{ asset('images/fogo.png') }}" class="h-20 w-auto" alt="Fogo Logo" />
                {{-- <span class="hidden sm:block text-xl font-bold text-orange-600 ">Fogo</span> --}}
            </a>

            <!-- Navigation Links - Desktop -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('foods') }}" class="nav-link {{ request()->routeIs('foods') ? 'text-orange-600'  : 'text-gray-600 hover:text-orange-600'}}">Beranda</a>
                @if (session('user_latitude') && session('user_longitude'))

                <a href="{{ route('rekomendasi') }}" class="nav-link {{ request()->routeIs('rekomendasi') ? 'text-orange-600'  : 'text-gray-600 hover:text-orange-600'   }}">Rekomendasi</a>
                @endif
                <a href="{{ route('transaksi') }}" class="nav-link {{ request()->routeIs('transaksi') ? 'text-orange-600'  : 'text-gray-600 hover:text-orange-600' }}">Pesanan Saya</a>
                <a href="{{ route('review') }}" class="nav-link {{ request()->routeIs('review') ? 'text-orange-600'  : 'text-gray-600 hover:text-orange-600'  }}">Review</a>
                <a href="#" class="nav-link text-gray-600 hover:text-orange-600  ">Contact</a>
            </div>

            <!-- User Menu -->
            <div class="flex items-center space-x-4">
                <button type="button" class="flex items-center justify-center p-2 rounded-full bg-orange-50 hover:bg-orange-100   transition-colors duration-200" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
                    <span class="sr-only">Open user menu</span>
                    @php
                        use Illuminate\Support\Facades\Auth;
                        $user = Auth::user();
                    @endphp
                    <img class="h-8 w-8 rounded-full object-cover ring-2 ring-orange-200 " src="{{ Auth::user()->profpic ? asset('storage/' . $user->profpic) : asset('images/user.png') }}" alt="user photo">
                </button>

                <!-- User Dropdown Menu -->
                <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-xl shadow-lg ring-1 ring-orange-200   " id="user-dropdown">
                    <!-- User Info Section -->
                    <div class="p-4 bg-gradient-to-r from-orange-50 to-orange-100   rounded-t-xl">
                        <div class="flex items-center space-x-3">
                            <img class="w-12 h-12 rounded-full object-cover ring-2 ring-orange-300 " src="{{ Auth::user()->profpic ? asset('storage/' . $user->profpic) : asset('images/user.png') }}" alt="user photo">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-gray-900 truncate ">{{ Auth::user()->name }} {{ Auth::user()->last_name }}</p>
                                <p class="text-xs text-gray-500 truncate ">{{ Auth::user()->email }}</p>
                                <p class="mt-1 text-xs font-medium text-orange-600 ">🎁 {{ Auth::user()->point }} point loyalitas</p>

                            </div>
                        </div>
                    </div>

                    <!-- Menu Items -->
                    <ul class="py-2" aria-labelledby="user-menu-button">
                        <li>
                            <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50   group transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-orange-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('belum-dibayar') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50   group transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-orange-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                </svg>
                                Transaksi
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('profile.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-orange-50   group transition-colors duration-200">
                                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-orange-500 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Settings
                            </a>
                        </li>
                        <li class="border-t border-gray-200  mt-2">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-red-50   group transition-colors duration-200">
                                    <svg class="w-5 h-5 mr-3 text-red-500 group-hover:text-red-600 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                    </svg>
                                    Sign out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

                <!-- Mobile menu button -->
                <button
                    data-collapse-toggle="navbar-user"
                    type="button"
                    class="inline-flex items-center justify-center p-2 rounded-lg text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-orange-500   md:hidden"
                >
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>
        </div>
        <!-- Mobile Navigation Menu -->
        <div class="hidden md:hidden" id="navbar-user">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('foods') }}" class="block rounded-md px-3 py-2 text-base font-medium transition-colors {{ request()->routeIs('foods') ? 'bg-orange-500 text-white' : 'text-gray-600 hover:bg-orange-50' }}">
                    Food Product
                </a>
                <a href="{{ route('transaksi') }}" class="block rounded-md px-3 py-2 text-base font-medium transition-colors {{ request()->routeIs('transaksi') ? 'bg-orange-500 text-white' : 'text-gray-600 hover:bg-orange-50'   }}">
                    My Order
                </a>
                <a href="{{ route('review') }}" class="block rounded-md px-3 py-2 text-base font-medium transition-colors {{ request()->routeIs('review') ? 'bg-orange-500 text-white' : 'text-gray-600 hover:bg-orange-50'    }}">
                    Review
                </a>
                <a href="#" class="block rounded-md px-3 py-2 text-base font-medium transition-colors text-gray-600 hover:bg-orange-50  ">
                    Contact
                </a>
            </div>
        </div>
    </div>
</nav>

<style>
    .nav-link {
        @apply text-sm font-medium transition-colors duration-200;
    }
    .mobile-nav-link {
        @apply block px-3 py-2 rounded-lg text-base font-medium transition-colors duration-200;
    }
    .dropdown-item {
        @apply block px-4 py-2 text-sm text-gray-700 hover:bg-orange-50   transition-colors duration-200;
    }
</style>


