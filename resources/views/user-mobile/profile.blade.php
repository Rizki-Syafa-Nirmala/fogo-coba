@extends('layouts.page')


@section('content-user-mobile')
<div class="bg-white min-h-screen flex justify-center items-start">
    <div class="w-full max-w-md bg-white rounded-lg shadow-sm overflow-hidden">
        <!-- Header -->
        <header class="flex items-center bg-white border-b border-gray-200 px-4 py-5 shadow-sm">
            <a href="{{ route('mobile.foods') }}" aria-label="Go back" class="text-black text-lg">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="flex-grow text-center font-semibold text-lg text-black">
                DETAIL INFORMASI
            </h1>
            <div class="w-6"></div>
        </header>
        <!-- Profile Header -->
        <div class="py-12 px-6">
            <div class="flex flex-col items-center relative">
                 <!-- Profile Image with Camera Icon -->
                <div class="relative">
                    <img
                        alt="Profile picture of {{ Auth::user()->name }}"
                        class="w-24 h-24 rounded-full object-cover border-2 border-gray-100"
                        src="{{ Auth::user()->profpic ? asset('storage/' . Auth::user()->profpic) : asset('images/user.png') }}"
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
                    {{ Auth::user()->name }}
                </h2>
                <p class="text-gray-500 text-sm mt-1">
                    {{ Auth::user()->email }}
                </p>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="border-t border-gray-100">
            <ul class="divide-y divide-gray-100">
                <li>
                    <a
                        href="{{ route('mobile.profile-saya') }}"
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-user-cog text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Pengaturan Profile</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                {{-- <li>
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
                </li> --}}

                <li>
                    <a
                        href="{{ route('mobile.pengaturan-alamat') }}"
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-map-marker-alt text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Pengaturan Alamat</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <li>
                    <a
                        href="{{ route('mobile.ganti-password') }}"
                        class="flex items-center justify-between py-4 px-6 hover:bg-gray-50 transition-colors duration-150"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-lock text-gray-950 w-5 text-center"></i>
                            <span class="text-gray-700 text-sm font-medium">Ganti Password</span>
                        </div>
                        <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
                    </a>
                </li>

                <!-- Delete Account Section -->
                <li class="border-t-4 border-gray-200">
                    <button
                        type="button"
                        class="w-full flex items-center justify-between py-4 px-6 hover:bg-red-50 transition-colors duration-150 text-left"
                        onclick="showDeleteAccountModal()"
                    >
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-trash-alt text-red-500 w-5 text-center"></i>
                            <span class="text-red-600 text-sm font-medium">Hapus Akun</span>
                        </div>
                        <i class="fas fa-chevron-right text-red-400 text-xs"></i>
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Fixed Bottom Logout Button -->
<div class="fixed bottom-0 left-0 right-0 bg-white px-4 py-3 shadow-lg pb-8">
    <div class="max-w-md mx-auto">
        <!-- Logout Button -->
        <button
            type="button"
            class="w-full flex items-center justify-center py-3 px-4 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-150 shadow-sm"
            onclick="showLogoutModal()"
        >
            <i class="fas fa-sign-out-alt mr-2"></i>
            <span class="font-medium">Keluar</span>
        </button>
    </div>
</div>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all duration-300">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-sign-out-alt text-red-600 text-xl"></i>
            </div>

            <!-- Content -->
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Keluar dari Akun?</h3>
                <p class="text-gray-500 text-sm mb-6">Anda akan keluar dari akun Anda. Pastikan semua data telah tersimpan.</p>
            </div>

            <!-- Actions -->
            <div class="flex space-x-3">
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="hideLogoutModal()"
                >
                    Batal
                </button>
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="confirmLogout()"
                >
                    Ya, Keluar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Confirmation Modal -->
<div id="deleteAccountModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all duration-300">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full mb-4">
                <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
            </div>

            <!-- Content -->
            <div class="text-center">
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Hapus Akun Permanen?</h3>
                <p class="text-gray-500 text-sm mb-4">Tindakan ini tidak dapat dibatalkan. Semua data, riwayat, dan informasi akun Anda akan hilang permanen.</p>

                <!-- Warning Box -->
                <div class="bg-red-50 border border-red-200 rounded-lg p-3 mb-6">
                    <div class="flex items-start space-x-2">
                        <i class="fas fa-exclamation-circle text-red-500 text-sm mt-0.5"></i>
                        <div class="text-left">
                            <p class="text-red-700 text-xs font-medium mb-1">Data yang akan hilang:</p>
                            <ul class="text-red-600 text-xs space-y-0.5">
                                <li>• Profil dan pengaturan</li>
                                <li>• Riwayat transaksi</li>
                                <li>• Data alamat tersimpan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex space-x-3">
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="hideDeleteAccountModal()"
                >
                    Batal
                </button>
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="confirmDeleteAccount()"
                >
                    Ya, Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Hidden form for delete account -->
<form id="deleteAccountForm" method="POST" action="{{ route('account.delete') }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
// Logout Modal Functions
function showLogoutModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideLogoutModal() {
    const modal = document.getElementById('logoutModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function confirmLogout() {
    // Create a form dynamically and submit it
    var form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("logout") }}';

    // Add CSRF token
    var csrfToken = document.createElement('input');
    csrfToken.type = 'hidden';
    csrfToken.name = '_token';
    csrfToken.value = '{{ csrf_token() }}';
    form.appendChild(csrfToken);

    document.body.appendChild(form);
    form.submit();
}

// Delete Account Modal Functions
function showDeleteAccountModal() {
    const modal = document.getElementById('deleteAccountModal');
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function hideDeleteAccountModal() {
    const modal = document.getElementById('deleteAccountModal');
    modal.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function confirmDeleteAccount() {
    document.getElementById('deleteAccountForm').submit();
}

// Close modals when clicking outside
document.getElementById('logoutModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideLogoutModal();
    }
});

document.getElementById('deleteAccountModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideDeleteAccountModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideLogoutModal();
        hideDeleteAccountModal();
    }
});
</script>
@endsection
