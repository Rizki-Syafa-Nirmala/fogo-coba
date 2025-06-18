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
                        id="mainProfileImage"
                    />
                    <button
                        type="button"
                        class="absolute bottom-0 right-0 bg-green-500 hover:bg-green-600 border-3 border-white rounded-full w-7 h-7 flex justify-center items-center transition-colors duration-200 shadow-sm"
                        aria-label="Change profile picture"
                        onclick="triggerProfilePictureUpload()"
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

<!-- Hidden file input for profile picture -->
<input type="file" id="profilePictureInput" accept="image/*" style="display: none;">

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

<!-- Profile Picture Preview Modal -->
<div id="profilePictureModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50 hidden">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-sm mx-auto transform transition-all duration-300">
        <div class="p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Preview Foto Profil</h3>
                <button type="button" onclick="hideProfilePictureModal()" class="text-gray-400 hover:text-gray-600 transition-colors">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>

            <!-- Preview Image -->
            <div class="flex justify-center mb-4">
                <div class="relative">
                    <img id="previewImage" src="" alt="Preview" class="w-32 h-32 rounded-full object-cover border-4 border-green-100 shadow-lg">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
            </div>

            <!-- File Info -->
            <div id="fileInfo" class="text-center text-sm text-gray-600 mb-6 bg-gray-50 rounded-lg p-3">
                <i class="fas fa-image text-gray-400 mr-2"></i>
                <span id="fileName"></span>
            </div>

            <!-- Actions -->
            <div class="flex space-x-3">
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="hideProfilePictureModal()"
                >
                    <i class="fas fa-times mr-2"></i>
                    Batal
                </button>
                <button
                    type="button"
                    class="flex-1 px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white rounded-lg transition-colors duration-150 font-medium text-sm"
                    onclick="uploadProfilePicture()"
                    id="uploadBtn"
                >
                    <span id="uploadBtnText">
                        <i class="fas fa-upload mr-2"></i>
                        Upload
                    </span>
                    <span id="uploadBtnLoading" class="hidden">
                        <i class="fas fa-spinner fa-spin mr-2"></i>
                        Mengupload...
                    </span>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Loading Overlay -->
<div id="uploadingOverlay" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-60 hidden">
    <div class="bg-white rounded-xl p-8 shadow-2xl max-w-sm mx-4">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-4">
                <i class="fas fa-cloud-upload-alt text-green-500 text-2xl animate-bounce"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Mengupload Foto</h3>
            <p class="text-gray-500 text-sm mb-4">Mohon tunggu sebentar...</p>
            <div class="w-full bg-gray-200 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full animate-pulse" style="width: 70%"></div>
            </div>
        </div>
    </div>
</div>

<!-- Success Toast -->
<div id="successToast" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-6 py-4 rounded-lg shadow-xl z-70 hidden transition-all duration-300">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <i class="fas fa-check-circle text-xl"></i>
        </div>
        <div>
            <p class="font-medium">Berhasil!</p>
            <p class="text-sm opacity-90" id="successMessage">Foto profil berhasil diperbarui</p>
        </div>
    </div>
</div>

<!-- Error Toast -->
<div id="errorToast" class="fixed top-4 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-6 py-4 rounded-lg shadow-xl z-70 hidden transition-all duration-300">
    <div class="flex items-center space-x-3">
        <div class="flex-shrink-0">
            <i class="fas fa-exclamation-circle text-xl"></i>
        </div>
        <div>
            <p class="font-medium">Terjadi Kesalahan!</p>
            <p class="text-sm opacity-90" id="errorMessage">Silakan coba lagi</p>
        </div>
    </div>
</div>

<!-- Hidden form for delete account -->
<form id="deleteAccountForm" method="POST" action="{{ route('account.delete') }}" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script>
let selectedFile = null;

// Profile Picture Upload Functions
function triggerProfilePictureUpload() {
    document.getElementById('profilePictureInput').click();
}

// Handle file selection
document.getElementById('profilePictureInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        // Validate file type
        if (!file.type.startsWith('image/')) {
            showErrorToast('Harap pilih file gambar yang valid!');
            return;
        }

        // Validate file size (max 5MB)
        if (file.size > 5 * 1024 * 1024) {
            showErrorToast('Ukuran file terlalu besar! Maksimal 5MB.');
            return;
        }

        selectedFile = file;
        showProfilePicturePreview(file);
    }
});

// Show preview modal
function showProfilePicturePreview(file) {
    const reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('previewImage').src = e.target.result;
        document.getElementById('fileName').textContent = `${file.name} (${formatFileSize(file.size)})`;
        document.getElementById('profilePictureModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    };
    reader.readAsDataURL(file);
}

// Hide preview modal
function hideProfilePictureModal() {
    document.getElementById('profilePictureModal').classList.add('hidden');
    document.body.style.overflow = 'auto';
    selectedFile = null;
    document.getElementById('profilePictureInput').value = '';
}

// Upload profile picture
function uploadProfilePicture() {
    if (!selectedFile) return;

    const formData = new FormData();
    formData.append('profile_picture', selectedFile);
    formData.append('_token', '{{ csrf_token() }}');
    formData.append('_method', 'PUT');

    // Show loading state
    const uploadBtn = document.getElementById('uploadBtn');
    const uploadBtnText = document.getElementById('uploadBtnText');
    const uploadBtnLoading = document.getElementById('uploadBtnLoading');
    
    uploadBtn.disabled = true;
    uploadBtnText.classList.add('hidden');
    uploadBtnLoading.classList.remove('hidden');

    // Show overlay
    document.getElementById('uploadingOverlay').classList.remove('hidden');
    hideProfilePictureModal();

    fetch('{{ route("mobile.profile.update-picture") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update profile image
            const profileImg = document.getElementById('mainProfileImage');
            if (profileImg) {
                profileImg.src = data.profile_picture_url + '?v=' + Date.now();
            }
            
            // Show success message
            showSuccessToast('Foto profil berhasil diperbarui!');
        } else {
            throw new Error(data.message || 'Terjadi kesalahan saat mengupload');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showErrorToast('Terjadi kesalahan: ' + error.message);
    })
    .finally(() => {
        // Reset button state
        uploadBtn.disabled = false;
        uploadBtnText.classList.remove('hidden');
        uploadBtnLoading.classList.add('hidden');
        document.getElementById('uploadingOverlay').classList.add('hidden');
    });
}

// Toast Functions
function showSuccessToast(message) {
    const toast = document.getElementById('successToast');
    const messageEl = document.getElementById('successMessage');
    messageEl.textContent = message;
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 4000);
}

function showErrorToast(message) {
    const toast = document.getElementById('errorToast');
    const messageEl = document.getElementById('errorMessage');
    messageEl.textContent = message;
    toast.classList.remove('hidden');
    
    setTimeout(() => {
        toast.classList.add('hidden');
    }, 4000);
}

// Utility Functions
function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
}

// Existing Logout Modal Functions
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

// Event Listeners for closing modals
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

document.getElementById('profilePictureModal').addEventListener('click', function(e) {
    if (e.target === this) {
        hideProfilePictureModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        hideLogoutModal();
        hideDeleteAccountModal();
        hideProfilePictureModal();
    }
});

// Auto-hide toasts when clicked
document.getElementById('successToast').addEventListener('click', function() {
    this.classList.add('hidden');
});

document.getElementById('errorToast').addEventListener('click', function() {
    this.classList.add('hidden');
});
</script>

<style>
/* Custom animations */
@keyframes slideInDown {
    from {
        transform: translate(-50%, -100%);
        opacity: 0;
    }
    to {
        transform: translate(-50%, 0);
        opacity: 1;
    }
}

#successToast:not(.hidden),
#errorToast:not(.hidden) {
    animation: slideInDown 0.3s ease-out;
}

/* Smooth transitions for modals */
#profilePictureModal > div,
#logoutModal > div,
#deleteAccountModal > div {
    transform: scale(0.95);
    transition: transform 0.3s ease-out;
}

#profilePictureModal:not(.hidden) > div,
#logoutModal:not(.hidden) > div,
#deleteAccountModal:not(.hidden) > div {
    transform: scale(1);
}

/* Loading animation */
@keyframes pulse {
    0%, 100% {
        opacity: 1;
    }
    50% {
        opacity: 0.5;
    }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

/* Hover effects */
.hover\:scale-105:hover {
    transform: scale(1.05);
}

/* Focus styles for accessibility */
button:focus,
input:focus {
    outline: 2px solid #10b981;
    outline-offset: 2px;
}
</style>

@endsection