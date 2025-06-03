@extends('layouts.setting')

@section('content')

<div>
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>

            <div class="pt-4 grid grid-cols-1 gap-4 md:grid-cols-3" >
                <div class="col-span-1 place-content-center">
                    <div class="flex items-center justify-center space-x-4">
                        <!-- Assuming current profile picture URL is in `currentProfilePictureUrl` -->
                        <img id="preview-image" class="w-40 h-40 rounded-full object-cover" src="{{ Auth::user()->profpic ? asset('storage/'.Auth::user()->profpic) : asset('images/user.png') }}" alt="Profile Picture">
                        <div>
                        <label for="profile_picture" class="cursor-pointer text-blue-600">
                            <svg class="w-10 h-10 text-gray-800 dark:text-white"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0.9" d="M10.779 17.779 4.36 19.918 6.5 13.5m4.279 4.279 8.364-8.643a3.027 3.027 0 0 0-2.14-5.165 3.03 3.03 0 0 0-2.14.886L6.5 13.5m4.279 4.279L6.499 13.5m2.14 2.14 6.213-6.504M12.75 7.04 17 11.28"/>
                            </svg>
                        </label>

                        <input type="file" id="profile_picture" name="profile_picture" class="hidden" onchange="previewImage(event)">
                        </div>
                    </div>
                </div>

                <div class=" col-span md:col-span-2">

                    <div class="grid grid-cols-2 gap-4">

                        <!-- Name Field -->
                        <div class="mt-4">
                            <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John Doe" value="{{ Auth::user()->name }}" required>
                        </div>
                        <!-- Name Field -->
                        <div class="mt-4">
                            <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="belum ada" value="{{ Auth::user()->last_name }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="text" id="email" name="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ex: 085889241514" value="{{ Auth::user()->email }}">
                    </div>

                    <!-- phone Field -->
                    <div class="mt-4">
                        <label for="phone" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ex: 085889241514" value="{{ Auth::user()->no_telp }}">
                    </div>

                    <!-- Address Field -->
                    <div class="mt-4">
                        <label for="address" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Address</label>
                        <input type="text" id="address" name="address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="ex: Jl. Kebon Jeruk" value="{{ Auth::user()->alamat }}">
                    </div>
                </div>
            </div>
        </div>
        <!-- Profile Picture -->
        <div class="flex items-center mt-10 p-4 md:p-5 space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
            <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Changes</button>
        </div>

    </form>
</div>



@endsection
