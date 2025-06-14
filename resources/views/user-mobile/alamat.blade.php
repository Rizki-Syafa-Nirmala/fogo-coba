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
                <h1 class="text-lg font-semibold text-gray-900">INFORMASI ALAMAT</h1>
                <div class="w-9"></div>
            </div>

            {{-- Success/Error Messages --}}
            <div id="success-alert" class="hidden mx-4 mt-4 p-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <div class="flex items-start">
                    <i class="fas fa-check-circle mr-2 mt-0.5 text-green-600"></i>
                    <div>
                        <span class="font-medium">Success!</span>
                        Address has been added successfully.
                    </div>
                </div>
            </div>

            <div id="error-alert" class="hidden mx-4 mt-4 p-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <div class="flex items-start">
                    <i class="fas fa-exclamation-circle mr-2 mt-0.5 text-red-600"></i>
                    <div>
                        <span class="font-medium">Error!</span>
                        Please fill in all required fields correctly.
                    </div>
                </div>
            </div>

            {{-- Form --}}
            <form id="address-form" class="px-4 pt-2 ">
                @csrf

                {{-- Address Information --}}
                <div class="space-y-6">

                    {{-- Street Address --}}
                    <div class="form-group">
                        <label class="block text-gray-700 text-sm font-medium mb-2">Alamat</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input type="text"
                                   id="address"
                                   name="address"
                                   class="form-input bg-white border border-gray-200 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-4 transition-all duration-200"
                                   placeholder="Street Address"
                                   required>
                        </div>
                    </div>

                    {{-- City and Zip Code Row --}}
                    <div class="grid grid-cols-2 gap-3">
                        {{-- City --}}
                        <div class="form-group">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-6a1 1 0 00-1-1H9a1 1 0 00-1 1v6a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input type="text"
                                       id="city"
                                       name="city"
                                       class="form-input bg-white border border-gray-200 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-4 transition-all duration-200"
                                       placeholder="City"
                                       required>
                            </div>
                        </div>

                        {{-- Zip Code --}}
                        <div class="form-group">
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"/>
                                    </svg>
                                </div>
                                <input type="text"
                                       id="zipcode"
                                       name="zipcode"
                                       class="form-input bg-white border border-gray-200 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-4 transition-all duration-200"
                                       placeholder="Zip Code"
                                       required>
                            </div>
                        </div>
                    </div>

                    {{-- Country --}}
                    <div class="form-group">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none z-10">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <select id="country"
                                    name="country"
                                    class="form-input bg-white border border-gray-200 text-gray-900 text-base rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 block w-full pl-12 pr-4 py-4 transition-all duration-200 appearance-none"
                                    required>
                                <option value="" disabled selected>Select Country</option>
                                <option value="ID">Indonesia</option>
                                <option value="MY">Malaysia</option>
                                <option value="SG">Singapore</option>
                                <option value="US">United States</option>
                                <option value="CA">Canada</option>
                                <option value="GB">United Kingdom</option>
                                <option value="AU">Australia</option>
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Save Address Toggle --}}
                {{-- <div class="pt-2">
                    <div class="flex items-center space-x-4 py-3">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox"
                                   id="saveAddress"
                                   name="save_address"
                                   class="sr-only peer"
                                   checked>
                            <div class="relative w-12 h-7 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-green-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-green-500"></div>
                        </label>
                        <label for="saveAddress" class="text-base font-medium text-gray-700 cursor-pointer">
                            Save this address for future use
                        </label>
                    </div>
                </div> --}}
            </form>

            {{-- Fixed Submit Button --}}
            <div class="fixed bottom-0 left-0 right-0 pt-4 pb-6 px-2 bg-white border-t border-gray-100 shadow-lg z-30">
                <div class="max-w-md mx-auto">
                    <button type="submit"
                            form="address-form"
                            class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-semibold rounded-2xl text-base px-6 py-4 text-center transition-all duration-200 transform hover:scale-[1.02] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none shadow-lg">
                        <i class="fas fa-plus mr-2"></i>
                        Add Address
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- Scripts --}}
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('address-form');
    const submitButton = document.querySelector('button[type="submit"]');
    const successAlert = document.getElementById('success-alert');
    const errorAlert = document.getElementById('error-alert');
    const backButton = document.getElementById('back-button');

    // Form validation and submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable submit button during processing
        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';

        // Get all required fields
        const requiredFields = this.querySelectorAll('input[required], select[required]');
        let isValid = true;
        let firstInvalidField = null;

        // Reset previous error states
        requiredFields.forEach(field => {
            field.classList.remove('border-red-500', 'ring-red-500', 'ring-2');
            field.parentElement.classList.remove('error');
        });

        // Hide alerts
        hideAlerts();

        // Validate fields
        requiredFields.forEach(field => {
            const value = field.value.trim();
            let fieldValid = true;

            if (!value) {
                fieldValid = false;
            } else if (field.type === 'email') {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                fieldValid = emailRegex.test(value);
            } else if (field.type === 'tel') {
                const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
                fieldValid = phoneRegex.test(value);
            }

            if (!fieldValid) {
                field.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                field.parentElement.classList.add('error');
                isValid = false;
                if (!firstInvalidField) {
                    firstInvalidField = field;
                }
            }
        });

        // Process form submission
        setTimeout(() => {
            if (isValid) {
                showSuccessAlert();
                // Simulate successful form submission
                setTimeout(() => {
                    resetForm();
                }, 2000);
            } else {
                showErrorAlert();
                if (firstInvalidField) {
                    firstInvalidField.focus();
                    firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.innerHTML = '<i class="fas fa-plus mr-2"></i>Add Address';
        }, 1000);
    });

    // Real-time validation
    form.querySelectorAll('input[required], select[required]').forEach(field => {
        field.addEventListener('input', function() {
            if (this.value.trim()) {
                this.classList.remove('border-red-500', 'ring-red-500', 'ring-2');
                this.parentElement.classList.remove('error');
            }
        });

        field.addEventListener('blur', function() {
            validateField(this);
        });
    });

    // Back button functionality
    backButton.addEventListener('click', function() {
        const hasChanges = Array.from(form.elements).some(element => {
            if (element.type === 'checkbox') {
                return element.id === 'saveAddress' ? !element.checked : element.checked;
            }
            return element.value.trim() !== '';
        });

        if (hasChanges) {
            if (confirm('Are you sure you want to go back? Any unsaved changes will be lost.')) {
                window.history.back();
            }
        } else {
            window.history.back();
        }
    });

    // Helper functions
    function validateField(field) {
        const value = field.value.trim();
        let isValid = true;

        if (field.hasAttribute('required') && !value) {
            isValid = false;
        } else if (field.type === 'email' && value) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            isValid = emailRegex.test(value);
        } else if (field.type === 'tel' && value) {
            const phoneRegex = /^[\+]?[0-9\s\-\(\)]{8,}$/;
            isValid = phoneRegex.test(value);
        }

        if (!isValid) {
            field.classList.add('border-red-500', 'ring-2', 'ring-red-500');
        } else {
            field.classList.remove('border-red-500', 'ring-red-500', 'ring-2');
        }

        return isValid;
    }

    function showSuccessAlert() {
        hideAlerts();
        successAlert.classList.remove('hidden');
        successAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function showErrorAlert() {
        hideAlerts();
        errorAlert.classList.remove('hidden');
        errorAlert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });

        setTimeout(() => {
            errorAlert.classList.add('hidden');
        }, 5000);
    }

    function hideAlerts() {
        successAlert.classList.add('hidden');
        errorAlert.classList.add('hidden');
    }

    function resetForm() {
        form.reset();
        document.getElementById('saveAddress').checked = true;
        hideAlerts();

        // Remove any error states
        form.querySelectorAll('.border-red-500').forEach(field => {
            field.classList.remove('border-red-500', 'ring-red-500', 'ring-2');
        });
    }
});
</script>
@endpush
@endsection
