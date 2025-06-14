@extends('layouts.page')

@section('content-user-mobile')
<div class="bg-gray-50">
    <div class="max-w-md mx-auto bg-white min-h-screen flex flex-col">
        <!-- Header -->
        <div class="flex items-center justify-between p-4 bg-white border-b border-gray-200">
            <a href="{{ route('mobile.semua-transaksi') }}" class="inline-flex items-center p-2 text-gray-500 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <h1 class="text-lg font-semibold text-gray-900">
                @if(isset($existingUlasan))
                    Edit Ulasan
                @else
                    Tulis Ulasan
                @endif
            </h1>
            <div class="w-9"></div> <!-- Spacer for center alignment -->
        </div>

        <!-- Alert Messages -->
        @if(session('success'))
            <div class="mx-4 mt-4 p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 border border-green-200" role="alert">
                <div class="flex">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Berhasil!</span> {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="mx-4 mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <div class="flex">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Error!</span> {{ session('error') }}
                    </div>
                </div>
            </div>
        @endif

        @if($errors->any())
            <div class="mx-4 mt-4 p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200" role="alert">
                <div class="flex">
                    <svg class="flex-shrink-0 inline w-4 h-4 mr-3 mt-[2px]" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <div>
                        <span class="font-medium">Error!</span>
                        @if($errors->has('error'))
                            {{ $errors->first('error') }}
                        @else
                            <ul class="mt-1 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <!-- Show existing review info if editing -->
        @if(isset($existingUlasan))
            <div class="mx-4 mt-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                <div class="flex items-center mb-2">
                    <svg class="w-4 h-4 text-blue-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-sm font-medium text-blue-800">Mengedit ulasan yang sudah ada</span>
                </div>
                <p class="text-xs text-blue-600">Anda sudah memberikan ulasan sebelumnya. Silakan edit jika diperlukan.</p>
            </div>
        @endif

        <!-- Review Form -->
        <form id="review-form" method="POST" action="{{ route('mobile.transaksi.ulasan', ['id' => $transaksi->id]) }}">
            @csrf
            <input type="hidden" name="transaksi_id" value="{{ $transaksi->id }}">
            <!-- Mengambil rating dari database jika ada, atau dari old input jika ada error validasi -->
            <input type="hidden" name="rating" id="rating-input" value="{{ old('rating', $existingUlasan->rating ?? 0) }}">

            <!-- Content -->
            <div class="p-6 flex-1 flex flex-col">
                <!-- Question -->
                <div class="text-center mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">Bagaimana pendapat Anda?</h2>
                    <p class="text-sm text-gray-500">Silahkan berikan rating dengan mengklik bintang di bawah ini</p>
                </div>

                <!-- Star Rating -->
                <div class="flex justify-center mb-2">
                    <div class="flex items-center space-x-2" id="star-rating">
                        @for($i = 1; $i <= 5; $i++)
                        <button type="button" class="star-btn transform hover:scale-110 transition-transform duration-150 focus:outline-none focus:ring-2 focus:ring-yellow-300 rounded" data-rating="{{ $i }}" aria-label="Rating {{ $i }} bintang">
                            <!-- Bintang akan diatur warnanya melalui JavaScript berdasarkan rating dari database -->
                            <svg class="w-10 h-10 text-gray-300 hover:text-yellow-400 transition-colors duration-150" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </button>
                        @endfor
                    </div>
                </div>

                <!-- Rating Text -->
                <div class="text-center mb-6">
                    <span id="rating-text" class="text-sm text-gray-500">Pilih rating Anda</span>
                </div>

                @error('rating')
                    <div class="mb-4 p-3 text-sm text-red-800 rounded-lg bg-red-50 border border-red-200">
                        {{ $message }}
                    </div>
                @enderror

                <!-- Review Text Area -->
                <div class="flex-1 mb-6">
                    <div class="flex items-center mb-3">
                        <svg class="w-4 h-4 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                        </svg>
                        <label for="komen" class="text-sm text-gray-500">Ceritakan pengalaman Anda</label>
                    </div>
                    <!-- Textarea akan diisi dengan komentar dari database jika ada -->
                    <textarea
                        name="komen"
                        id="komen"
                        rows="6"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 resize-none @error('komen') border-red-500 @enderror"
                        placeholder="Tulis ulasan Anda di sini..."
                        maxlength="1000"
                        required>{{ old('komen', $existingUlasan->komen ?? '') }}</textarea>

                    @error('komen')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div class="flex justify-between items-center mt-1">
                        <p class="text-xs text-gray-500">Maksimal 1000 karakter</p>
                        <p class="text-xs text-gray-500"><span id="char-count">0</span>/1000</p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-auto">
                    @if(isset($existingUlasan))
                        <button
                            type="submit"
                            id="submit-review"
                            class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-4 focus:outline-none transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <span id="button-text">Update Ulasan dan Rating</span>
                            <span id="loading-text" class="hidden">
                                <svg class="inline w-4 h-4 mr-2 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengupdate...
                            </span>
                        </button>
                    @else
                        <button
                            type="submit"
                            id="submit-review"
                            class="w-full text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-4 focus:outline-none transition-all duration-200 transform hover:scale-[1.02] active:scale-[0.98] disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none">
                            <span id="button-text">Berikan Ulasan dan Rating</span>
                            <span id="loading-text" class="hidden">
                                <svg class="inline w-4 h-4 mr-2 text-white animate-spin" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Menyimpan...
                            </span>
                        </button>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <script>
        // Star rating functionality
        const starButtons = document.querySelectorAll('.star-btn');
        const ratingInput = document.getElementById('rating-input');
        const ratingText = document.getElementById('rating-text');
        const komentarTextarea = document.getElementById('komen');
        const charCount = document.getElementById('char-count');

        // Mengambil rating dari input hidden yang sudah diset dari database
        let currentRating = parseInt(ratingInput.value) || 0;

        // Set initial rating jika ada data dari database
        if (currentRating > 0) {
            updateStars();
            updateRatingText();
            console.log(`Loaded existing rating: ${currentRating} stars`);
        }

        // Rating text messages
        const ratingMessages = {
            0: 'Pilih rating Anda',
            1: 'Sangat Buruk',
            2: 'Buruk',
            3: 'Cukup',
            4: 'Baik',
            5: 'Sangat Baik'
        };

        // Character count functionality
        function updateCharCount() {
            const currentLength = komentarTextarea.value.length;
            charCount.textContent = currentLength;

            if (currentLength > 900) {
                charCount.classList.add('text-red-500');
            } else {
                charCount.classList.remove('text-red-500');
            }
        }

        komentarTextarea.addEventListener('input', updateCharCount);

        starButtons.forEach((button, index) => {
            // Click handler - set permanent rating
            button.addEventListener('click', (e) => {
                e.preventDefault();
                currentRating = index + 1;
                ratingInput.value = currentRating;
                updateStars();
                updateRatingText();

                // Visual feedback for click
                button.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    button.style.transform = 'scale(1)';
                }, 150);

                console.log(`Rating set to: ${currentRating} stars`);
            });

            // Hover effects
            button.addEventListener('mouseenter', () => {
                highlightStars(index + 1);
                updateRatingText(index + 1);
            });
        });

        // Reset to current rating when mouse leaves the rating area
        document.getElementById('star-rating').addEventListener('mouseleave', () => {
            updateStars();
            updateRatingText();
        });

        // Function untuk update tampilan bintang berdasarkan rating
        function updateStars() {
            starButtons.forEach((button, index) => {
                const star = button.querySelector('svg');
                if (index < currentRating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Function untuk highlight bintang saat hover
        function highlightStars(rating) {
            starButtons.forEach((button, index) => {
                const star = button.querySelector('svg');
                if (index < rating) {
                    star.classList.remove('text-gray-300');
                    star.classList.add('text-yellow-400');
                } else {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                }
            });
        }

        // Function untuk update text rating
        function updateRatingText(hoverRating = null) {
            const displayRating = hoverRating || currentRating;
            ratingText.textContent = ratingMessages[displayRating];
        }

        // Initialize on page load - penting untuk menampilkan data existing
        document.addEventListener('DOMContentLoaded', function() {
            updateStars(); // Akan menampilkan bintang kuning sesuai rating dari database
            updateRatingText(); // Akan menampilkan text sesuai rating
            updateCharCount(); // Akan menampilkan jumlah karakter existing

            // Debug info
            if (currentRating > 0) {
                console.log(`Displaying existing review: ${currentRating} stars, comment: "${komentarTextarea.value}"`);
            }
        });
    </script>
</div>
@endsection
