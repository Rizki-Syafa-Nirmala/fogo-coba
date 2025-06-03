@extends('layouts.setting')

@section('content')




<div class="w-full md:w-3/4">
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="border-2 rounded-2xl shadow-4xl p-8">
        @csrf
        <div>
            <div class=" grid grid-cols-1 gap-8 md:grid-cols-3">
                <div class="col-span-1 flex flex-col items-center justify-center">
                    <div class="flex flex-col items-center space-y-4">
                        <div class="relative group">
                            <img id="preview-image" class="w-40 h-40 rounded-full object-cover border-4 border-orange-200 shadow-lg transition-transform duration-300 group-hover:scale-105" src="{{ Auth::user()->profpic ? asset('storage/'.Auth::user()->profpic) : asset('images/user.png') }}" alt="Profile Picture">
                            <label for="profile_picture" class="absolute bottom-2 right-2 bg-orange-600 text-white p-2 rounded-full shadow-lg cursor-pointer opacity-80 hover:opacity-100 transition-opacity duration-200">
                                <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/></svg>
                            </label>
                            <input type="file" id="profile_picture" name="profile_picture" class="hidden" onchange="previewImage(event)">
                        </div>
                        <span class="text-xs text-gray-500">Klik ikon pensil untuk ganti foto</span>
                    </div>
                </div>
                <div class="col-span-2">
                    <div class="grid grid-cols-2 gap-6">
                        <!-- Name Field -->
                        <div class="mt-4">
                            <label for="first_name" class="block mb-2 text-sm font-semibold text-gray-900">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" placeholder="John Doe" value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="mt-4">
                            <label for="last_name" class="block mb-2 text-sm font-semibold text-gray-900">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" placeholder="belum ada" value="{{ Auth::user()->last_name }}">
                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="email" class="block mb-2 text-sm font-semibold text-gray-900">Email</label>
                        <input type="text" id="email" name="email" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" placeholder="ex: johndoe@email.com" value="{{ Auth::user()->email }}">
                    </div>
                    <div class="mt-4">
                        <label for="phone" class="block mb-2 text-sm font-semibold text-gray-900">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" placeholder="ex: 085889241514" value="{{ Auth::user()->no_telp }}">
                    </div>
                    <div class="mt-4">
                        <label for="address" class="block mb-2 text-sm font-semibold text-gray-900">Address</label>
                        <input type="text" id="address" name="address" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" placeholder="ex: Jl. Kebon Jeruk" value="{{ Auth::user()->alamat }}">
                    </div>
                </div>
            </div>
        </div>
        <div class="flex items-center mt-10 p-4 md:p-5 space-x-3 border-t border-orange-200 rounded-b">
            <button type="submit" class="text-white bg-gradient-to-r from-orange-600 to-red-600 hover:from-red-600 hover:to-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-200 font-bold rounded-lg text-base px-8 py-3 shadow-lg transition-all duration-300">Save Changes</button>
        </div>
    </form>
</div>


@endsection
