@extends('layouts.page')

@section('content-user-mobile')
<div class="bg-[#f8f9fc] min-h-screen">
    <div class="max-w-md mx-auto">
        <!-- Header -->
        <header class="flex items-center bg-white border-b border-gray-200 px-4 py-5 shadow-sm">
            <a href="{{ route('mobile.profile') }}" aria-label="Go back" class="text-black text-lg">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="flex-grow text-center font-semibold text-lg text-black">
                PROFILE SAYA
            </h1>
            <div class="w-6"></div>
        </header>

        <!-- Content -->
        <form action="{{ route('profile.update') }}" method="POST" class="bg-white px-4 py-6 pb-32">
            @csrf
            @method('PUT')

                {{-- <h2 class="font-semibold text-lg text-black mb-3 text-center">INFORMASI PRIBADI</h2> --}}

            <div class="space-y-4 mb-6">
                <!-- First Name Input -->
                <div class="relative">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Depan</label>
                    <div class="flex items-center space-x-3 border border-gray-200 rounded-md px-4 py-3 focus-within:border-black focus-within:ring-1 focus-within:ring-black">
                        <i class="far fa-user text-gray-700 text-base"></i>
                        <input
                            type="text"
                            name="first_name"
                            value="{{ auth()->user()->name }}"
                            placeholder="Masukan Nama Depan"
                            class="flex-1 text-gray-700 text-sm  bg-transparent border-none outline-none focus:ring-0"
                            required
                        >
                    </div>
                    @error('first_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Last Name Input -->
                <div class="relative">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nama Belakang</label>
                    <div class="flex items-center space-x-3 border border-gray-200 rounded-md px-4 py-3 focus-within:border-black focus-within:ring-1 focus-within:ring-black">
                        <i class="far fa-user text-gray-700 text-base focus-within:text-black"></i>
                        <input
                            type="text"
                            name="last_name"
                            value="{{ auth()->user()->last_name }}"
                            placeholder="Masukan Nama Belakang"
                            class="flex-1 text-gray-700 text-sm bg-transparent border-none outline-none focus:ring-0"
                        >
                    </div>
                    @error('last_name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email Input -->
                <div class="relative">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Email</label>
                    <div class="flex items-center space-x-3 border border-gray-200 rounded-md px-4 py-3 focus-within:border-black focus-within:ring-1 focus-within:ring-black">
                        <i class="far fa-envelope text-gray-5-700 text-base"></i>
                        <input
                            type="email"
                            name="email"
                            value="{{ auth()->user()->email }}"
                            placeholder="Masukan Email"
                            class="flex-1 text-gray-700 text-sm bg-transparent border-none outline-none focus:ring-0"
                            required
                        >
                    </div>
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone Input -->
                <div class="relative">
                    <label class="block text-gray-700 text-sm font-medium mb-2">Nomor Telepon</label>
                    <div class="flex items-center space-x-3 border border-gray-200 rounded-md px-4 py-3 focus-within:border-black focus-within:ring-1 focus-within:ring-black">
                        <i class="fas fa-phone-alt text-gray-700 text-base"></i>
                        <input
                            type="tel"
                            name="phone"
                            value="{{ auth()->user()->no_telp }}"
                            placeholder="Masukan Nomor Telepon"
                            class="flex-1 text-gray-700 text-sm bg-transparent border-none outline-none focus:ring-0"
                        >
                    </div>
                    @error('phone')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Action Buttons fixed at bottom -->
            <div class="fixed bottom-0 left-1/2 transform -translate-x-1/2 w-full max-w-md px-4 pb-10 bg-white">
                <div class="space-y-3">
                    <!-- Delete Account Button -->
                    <button
                        type="button"
                        id="deleteAccountBtn"
                        class="w-full bg-red-500 text-white text-center py-3 rounded-md text-sm font-semibold hover:bg-red-600 transition-colors duration-200 flex items-center justify-center space-x-2"
                    >
                        <i class="fas fa-trash-alt"></i>
                        <span>Hapus Akun</span>
                    </button>

                    <!-- Save Button -->
                    <a href=""
                        type="submit"
                        id="saveLink4"
                        class="block w-full bg-black text-white text-center py-3 rounded-md text-sm font-semibold hover:bg-gray-900 transition-colors duration-200"
                    >
                        Simpan
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg mx-4 w-full max-w-sm">
        <div class="p-6">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 text-center mb-2">Hapus Akun</h3>
            <p class="text-sm text-gray-600 text-center mb-6">
                Anda yakin ingin menghapus akun? Tindakan ini tidak dapat dibatalkan dan semua data Anda akan hilang.
            </p>
            <div class="flex space-x-3">
                <button
                    id="cancelDeleteBtn"
                    class="flex-1 px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors duration-200"
                >
                    Batal
                </button>
                <form action="" method="POST" class="flex-1">
                    @csrf
                    @method('DELETE')
                    <button
                        type="submit"
                        id="confirmDeleteBtn"
                        class="w-full px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 transition-colors duration-200"
                    >
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const saveLink = document.getElementById('saveLink4');
    const deleteAccountBtn = document.getElementById('deleteAccountBtn');
    const deleteModal = document.getElementById('deleteModal');
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    const confirmDeleteBtn = document.getElementById('confirmDeleteBtn');

    // Save button functionality
    if (saveLink) {
        saveLink.addEventListener('click', function(e) {
            e.preventDefault();

            // Disable link
            this.style.pointerEvents = 'none';
            this.style.opacity = '0.6';
            this.textContent = 'Saving...';

            // Simulate processing time then redirect
            setTimeout(() => {
                window.location.href = this.href;
            }, 800);
        });
    }

    // Delete account button functionality
    if (deleteAccountBtn) {
        deleteAccountBtn.addEventListener('click', function() {
            deleteModal.classList.remove('hidden');
        });
    }

    // Cancel delete button
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.add('hidden');
        });
    }

    // Confirm delete button
    if (confirmDeleteBtn) {
        confirmDeleteBtn.addEventListener('click', function() {
            // Disable button
            this.disabled = true;
            this.style.opacity = '0.6';
            this.textContent = 'Menghapus...';
        });
    }

    // Close modal when clicking outside
    deleteModal.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
    });
});
</script>
@endsection
