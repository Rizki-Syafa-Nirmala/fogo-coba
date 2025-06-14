@extends('layouts.page')

@section('content-user-mobile')
<div class="bg-gray-50 min-h-screen">
    <div class="flex justify-center items-start pb-18">
        <div class="w-full max-w-md bg-white shadow-xsx relative min-h-screen">

            {{-- Header --}}
            <div class="flex items-center justify-between p-4 bg-white sticky top-0 z-20 border-b border-gray-100">
                <a href="{{ route('mobile.profile') }}" type="button" id="back-button"
                        class="inline-flex items-center p-2 text-gray-600 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 transition-colors duration-200">
                    <i class="fas fa-arrow-left w-5 h-5"></i>
                </a>
                <h1 class="text-lg font-semibold text-gray-900">GANTI PASSWORD</h1>
                <div class="w-9"></div>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
            <div class="mx-4 mt-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-green-600"></i>
                    <div>
                        <span class="font-medium">Success!</span>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
            @endif

            {{-- Error Messages --}}
            @if($errors->any())
            <div class="mx-4 mt-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle mr-2 mt-0.5 text-red-600"></i>
                    <div>
                        <span class="font-medium">Error!</span>
                        @if($errors->has('current_password'))
                            {{ $errors->first('current_password') }}
                        @elseif($errors->has('new_password'))
                            {{ $errors->first('new_password') }}
                        @elseif($errors->has('new_password_confirmation'))
                            {{ $errors->first('new_password_confirmation') }}
                        @else
                            {{ $errors->first() }}
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <div class="px-6 py-4">
                <form class="space-y-5" id="changePasswordForm" method="POST" action="{{ route('mobile.password.update') }}">
                    @csrf

                    <!-- Current Password -->
                    <div>
                        <label for="current_password" class="block mb-3 text-sm font-medium text-gray-800">
                            Current Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" id="current_password" name="current_password"
                                class="bg-gray-50 border-0 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-200 focus:bg-white block w-full pl-12 pr-12 py-4 transition-all duration-200 @error('current_password') border-red-500 ring-2 ring-red-500 @enderror"
                                placeholder="Enter current password"
                                value="{{ old('current_password') }}"
                                required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4" onclick="togglePassword('current_password')">
                                <i id="eye-current" class="fas fa-eye text-gray-400 text-sm"></i>
                            </button>
                        </div>
                    </div>

                    <!-- New Password -->
                    <div>
                        <label for="new_password" class="block mb-3 text-sm font-medium text-gray-800">
                            New Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" id="new_password" name="new_password"
                                class="bg-gray-50 border-0 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-200 focus:bg-white block w-full pl-12 pr-12 py-4 transition-all duration-200 @error('new_password') border-red-500 ring-2 ring-red-500 @enderror"
                                placeholder="Enter new password"
                                value="{{ old('new_password') }}"
                                required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4" onclick="togglePassword('new_password')">
                                <i id="eye-new" class="fas fa-eye text-gray-400 text-sm"></i>
                            </button>
                        </div>

                        <!-- Password Strength Indicator -->
                        <div class="mt-2">
                            <div class="flex items-center space-x-2">
                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                    <div id="strength-bar" class="bg-red-400 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
                                </div>
                                <span id="strength-text" class="text-xs font-medium text-gray-500">Weak</span>
                            </div>
                        </div>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="new_password_confirmation" class="block mb-3 text-sm font-medium text-gray-800">
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="fas fa-lock text-gray-400 text-sm"></i>
                            </div>
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation"
                                class="bg-gray-50 border-0 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-blue-200 focus:bg-white block w-full pl-12 pr-12 py-4 transition-all duration-200 @error('new_password_confirmation') border-red-500 ring-2 ring-red-500 @enderror"
                                placeholder="Confirm new password"
                                value="{{ old('new_password_confirmation') }}"
                                required>
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4" onclick="togglePassword('new_password_confirmation')">
                                <i id="eye-confirm" class="fas fa-eye text-gray-400 text-sm"></i>
                            </button>
                        </div>
                        <div id="password-match" class="mt-2 text-sm hidden">
                            <span class="text-red-500">Passwords do not match</span>
                        </div>
                    </div>

                    <!-- Password Requirements -->
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mt-6">
                        <h4 class="text-sm font-medium text-gray-700 mb-3">Password Requirements:</h4>
                        <ul class="text-sm text-gray-600 space-y-2">
                            <li id="req-length" class="flex items-center">
                                <div class="w-4 h-4 mr-3 rounded-full border border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-check text-xs text-gray-300 hidden"></i>
                                </div>
                                At least 8 characters long
                            </li>
                            <li id="req-case" class="flex items-center">
                                <div class="w-4 h-4 mr-3 rounded-full border border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-check text-xs text-gray-300 hidden"></i>
                                </div>
                                Contains uppercase and lowercase letters
                            </li>
                            <li id="req-number" class="flex items-center">
                                <div class="w-4 h-4 mr-3 rounded-full border border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-check text-xs text-gray-300 hidden"></i>
                                </div>
                                Contains at least one number
                            </li>
                            <li id="req-special" class="flex items-center">
                                <div class="w-4 h-4 mr-3 rounded-full border border-gray-300 flex items-center justify-center">
                                    <i class="fas fa-check text-xs text-gray-300 hidden"></i>
                                </div>
                                Contains at least one special character
                            </li>
                        </ul>
                    </div>
                </form>
            </div>

            {{-- Fixed Submit Button --}}
            <div class="fixed bottom-0 left-0 right-0 pt-4 pb-6 px-2 bg-white border-t border-gray-100 shadow-lg z-30">
                <div class="max-w-md mx-auto">
                    <button type="submit"
                            form="changePasswordForm"
                            id="submit-button"
                            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-semibold rounded-2xl text-base px-6 py-4 text-center transition-all duration-200 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg">
                        <i class="fas fa-lock mr-2"></i>
                        Change Password
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
// Global function for password visibility toggle
function togglePassword(fieldId) {
    console.log('Toggle password for:', fieldId); // Debug log

    const field = document.getElementById(fieldId);
    let eyeIconId;

    switch(fieldId) {
        case 'current_password':
            eyeIconId = 'eye-current';
            break;
        case 'new_password':
            eyeIconId = 'eye-new';
            break;
        case 'new_password_confirmation':
            eyeIconId = 'eye-confirm';
            break;
        default:
            console.error('Unknown field ID:', fieldId);
            return;
    }

    const eyeIcon = document.getElementById(eyeIconId);

    console.log('Field:', field, 'Eye icon:', eyeIcon); // Debug log

    if (field && eyeIcon) {
        if (field.type === 'password') {
            field.type = 'text';
            eyeIcon.className = 'fas fa-eye-slash text-gray-400 text-sm';
        } else {
            field.type = 'password';
            eyeIcon.className = 'fas fa-eye text-gray-400 text-sm';
        }
    } else {
        console.error('Elements not found - Field:', field, 'Eye icon:', eyeIcon);
    }
}

// Wait for DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded, initializing password form...'); // Debug log

    // Get all required elements
    const form = document.getElementById('changePasswordForm');
    const submitButton = document.getElementById('submit-button');
    const backButton = document.getElementById('back-button');
    const newPassword = document.getElementById('new_password');
    const confirmPassword = document.getElementById('new_password_confirmation');
    const passwordMatch = document.getElementById('password-match');
    const strengthText = document.getElementById('strength-text');
    const strengthBar = document.getElementById('strength-bar');

    console.log('Elements found:', {
        form: !!form,
        submitButton: !!submitButton,
        newPassword: !!newPassword,
        confirmPassword: !!confirmPassword,
        strengthText: !!strengthText,
        strengthBar: !!strengthBar
    }); // Debug log

    // Check if required elements exist
    if (!newPassword || !confirmPassword) {
        console.error('Critical elements missing');
        return;
    }

    // Password strength checker
    function checkPasswordStrength(password) {
        console.log('Checking password strength for:', password ? 'password entered' : 'empty password'); // Debug log

        let score = 0;

        // Reset all requirements first if password is empty
        if (!password) {
            ['req-length', 'req-case', 'req-number', 'req-special'].forEach(id => {
                updateRequirement(id, false);
            });

            if (strengthText && strengthBar) {
                strengthText.textContent = 'Weak';
                strengthBar.className = 'bg-red-400 h-2 rounded-full transition-all duration-300';
                strengthBar.style.width = '0%';
            }
            return false;
        }

        // Length check (minimum 8 characters)
        if (password.length >= 8) {
            score += 1;
            updateRequirement('req-length', true);
        } else {
            updateRequirement('req-length', false);
        }

        // Case check (both uppercase and lowercase)
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) {
            score += 1;
            updateRequirement('req-case', true);
        } else {
            updateRequirement('req-case', false);
        }

        // Number check
        if (/\d/.test(password)) {
            score += 1;
            updateRequirement('req-number', true);
        } else {
            updateRequirement('req-number', false);
        }

        // Special character check
        if (/[!@#$%^&*(),.?":{}|<>_+=\-\[\]\\\/~`]/.test(password)) {
            score += 1;
            updateRequirement('req-special', true);
        } else {
            updateRequirement('req-special', false);
        }

        // Update strength indicator
        if (strengthText && strengthBar) {
            const strengthLevels = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];
            const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-blue-500', 'bg-green-500'];
            const widths = ['20%', '40%', '60%', '80%', '100%'];

            const strengthIndex = Math.min(score, 4);
            strengthText.textContent = strengthLevels[strengthIndex];

            // Remove all possible color classes first
            strengthBar.className = 'h-2 rounded-full transition-all duration-300';
            strengthBar.classList.add(colors[strengthIndex]);
            strengthBar.style.width = widths[strengthIndex];
        }

        console.log('Password strength score:', score); // Debug log
        return score >= 4;
    }

    function updateRequirement(id, met) {
        const element = document.getElementById(id);
        if (!element) {
            console.error('Requirement element not found:', id);
            return;
        }

        const checkContainer = element.querySelector('div');
        const checkIcon = element.querySelector('i');

        if (!checkContainer || !checkIcon) {
            console.error('Check container or icon not found for:', id);
            return;
        }

        if (met) {
            checkContainer.classList.remove('border-gray-300');
            checkContainer.classList.add('bg-green-500', 'border-green-500');
            checkIcon.classList.remove('text-gray-300', 'hidden');
            checkIcon.classList.add('text-white');
            element.classList.remove('text-gray-600');
            element.classList.add('text-green-600');
        } else {
            checkContainer.classList.remove('bg-green-500', 'border-green-500');
            checkContainer.classList.add('border-gray-300');
            checkIcon.classList.remove('text-white');
            checkIcon.classList.add('text-gray-300', 'hidden');
            element.classList.remove('text-green-600');
            element.classList.add('text-gray-600');
        }
    }

    // Password match validation
    function checkPasswordMatch() {
        const newPass = newPassword.value;
        const confirmPass = confirmPassword.value;

        if (confirmPass && newPass !== confirmPass) {
            passwordMatch.classList.remove('hidden');
            confirmPassword.classList.add('border-red-500', 'ring-2', 'ring-red-500', 'focus:ring-red-500');
            confirmPassword.classList.remove('focus:ring-blue-200');
            return false;
        } else {
            passwordMatch.classList.add('hidden');
            confirmPassword.classList.remove('border-red-500', 'ring-2', 'ring-red-500', 'focus:ring-red-500');
            confirmPassword.classList.add('focus:ring-blue-200');
            return true;
        }
    }

    // Add event listeners
    newPassword.addEventListener('input', function() {
        console.log('New password input changed'); // Debug log
        checkPasswordStrength(this.value);
        if (confirmPassword.value) {
            checkPasswordMatch();
        }
    });

    confirmPassword.addEventListener('input', function() {
        console.log('Confirm password input changed'); // Debug log
        checkPasswordMatch();
    });

    // Form submission with loading state
    if (form && submitButton) {
        form.addEventListener('submit', function(e) {
            console.log('Form submitted'); // Debug log
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
        });
    }

    // Back button functionality
    if (backButton) {
        backButton.addEventListener('click', function(e) {
            e.preventDefault();
            console.log('Back button clicked'); // Debug log

            const currentPasswordField = document.getElementById('current_password');
            const hasChanges = (currentPasswordField && currentPasswordField.value.trim()) ||
                              newPassword.value.trim() ||
                              confirmPassword.value.trim();

            if (hasChanges) {
                if (confirm('Are you sure you want to go back? Any unsaved changes will be lost.')) {
                    window.history.back();
                }
            } else {
                window.history.back();
            }
        });
    }

    // Initialize on page load
    if (newPassword.value) {
        checkPasswordStrength(newPassword.value);
    }

    if (newPassword.value && confirmPassword.value) {
        checkPasswordMatch();
    }

    console.log('Password form initialization complete'); // Debug log
});
</script>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
@endpush
@endsection
