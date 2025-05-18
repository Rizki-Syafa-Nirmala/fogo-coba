@extends('layouts.setting')

@section('content')

<div class="container mx-auto py-6">

    <form action="{{ route('password.update') }}" method="POST">
    <!-- Profile Picture -->
        @csrf 

            <div class="flex flex-col w-1/2 pt-4">
                <p class="text-lg text-center md:text-left font-semibold text-gray-900 dark:text-white">
                    Change Your Password
                </p>
                <!-- password Field -->
                <div class="mt-4">
                    <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                    <input type="password" id="current-password" name="current-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input your current password">
                </div>
                <!-- password Field -->
                <div class="mt-4">
                    <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                    <input type="password" id="new-password" name="new-password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input your new password ">
                </div>
                <!-- password Field -->
                <div class="mt-4">
                    <label for="new-password-confirmation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password Confirmation</label>
                    <input type="password" id="new_password_confirmation" name="new-password-confirmation"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Input your new password for confirmation">
                </div>

            </div>

        <div class="flex items-center mt-8 p-4 md:p-5 space-x-5 md:space-x-3 rtl:space-x-reverse border-t border-gray-200 rounded-b dark:border-gray-600">
            <button  type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Save Changes</button>
            <button  type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-white focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-red-700 dark:bg-red-800 dark:text-white dark:border-red-600 dark:hover:text-white dark:hover:bg-red-700">Delete Account</button>
        </div>
    </form>

</div>
@endsection
