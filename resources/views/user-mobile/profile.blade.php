@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')
<div class="bg-white min-h-screen flex justify-center items-start pt-16">
    <div class="w-full max-w-md bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Profile Header -->
        <div class="pb-8 px-6">
            <div class="flex flex-col items-center relative">
                 <!-- Profile Image with Camera Icon -->
                <div class="relative">
                    <img
                        alt="Profile picture of {{ $user->name ?? 'Olivia Austin' }}"
                        class="w-24 h-24 rounded-full object-cover border-2 border-gray-100"
                        src="{{ Auth::user()->profpic ? asset('storage/' . $user->profpic) : asset('images/user.png') }}"
                        width="96"
                        height="96"
                    />
                    <button
                        type="button"
                        class="absolute bottom-0 right-0 bg-green-500 hover:bg-green-600 border-3 border-white rounded-full w-7 h-7 flex justify-center items-center transition-colors duration-200 shadow-sm"
                        aria-label="Change profile picture"
                    >
                        <i class="fas fa-camera text-white text-xs"></i>
                    </button>
                </div>

                <!-- User Info -->
                <h2 class="mt-4 font-semibold text-gray-900 text-base">
                    {{ auth()->user()->name }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">
                    {{ auth()->user()->email }}
                </p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="border-t border-gray-100">
            <ul class="divide-y divide-gray-100">
                <li>
                    <a
                        href=""
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-user text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Profile Saya</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <li>
                    <a
                        href=""
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-user-cog text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Pengaturan Akun</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <li>
                    <a
                        href=""
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-lock text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Ganti Password</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <li>
                    <a
                        href=""
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">My Address</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <!-- Logout Section -->
                <li class="border-t-4 border-gray-200">
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center justify-between py-4 px-6 hover:bg-red-50 transition-colors duration-150 text-left"
                            onclick="return confirm('Are you sure you want to sign out?')"
                        >
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-sign-out-alt text-red-500 w-5 text-center"></i>
                                <span class="text-red-600 text-sm font-medium">Sign out</span>
                            </div>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
</div>
@endsection
