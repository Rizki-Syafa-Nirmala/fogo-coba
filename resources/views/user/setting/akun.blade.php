@extends('layouts.setting')

@section('content')

<div class="w-full md:w-3/4">
    <form action="{{ route('password.update') }}" method="POST" class="rounded-2xl border-2 p-4">
        @csrf
        <div class="grid grid-cols-1  gap-6">
            <div class="">
                <label for="current_password" class="block mb-2 text-sm font-semibold text-gray-900">Current Password</label>
                <input type="password" id="current_password" name="current_password" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" required>
            </div>
            <div class="mt-4">
                <label for="new_password" class="block mb-2 text-sm font-semibold text-gray-900">New Password</label>
                <input type="password" id="new_password" name="new_password" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" required>
            </div>
            <div class="mt-4">
                <label for="new_password_confirmation" class="block mb-2 text-sm font-semibold text-gray-900">Confirm New Password</label>
                <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="bg-gray-50 border border-orange-300 text-gray-900 text-sm rounded-lg focus:ring-orange-400 focus:border-orange-400 block w-full p-2.5" required>
            </div>
        </div>
        <div class="flex items-center mt-10 p-4 md:p-5 space-x-3 border-t border-orange-200 rounded-b">
            <button type="submit" class="text-white bg-gradient-to-r from-orange-600 to-red-600 hover:from-red-600 hover:to-orange-600 focus:ring-4 focus:outline-none focus:ring-orange-200 font-bold rounded-lg text-base px-8 py-3 shadow-lg transition-all duration-300">Save Changes</button>
            <button type="button" class="ml-auto text-red-600 border border-red-300 bg-white hover:bg-red-50 focus:ring-2 focus:ring-red-200 font-bold rounded-lg text-base px-8 py-3 shadow transition-all duration-300">Delete Account</button>
        </div>
    </form>
</div>
@endsection
