@extends('layouts.page')

@section('content-user')

<section class="bg-gray-50 py-10">
    <div class="max-w-5xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-black-600">My Reviews</h2>
            <div class="mt-4 sm:mt-0">
                <select class="w-40 rounded-md border border-gray-300 bg-white py-2 px-3 text-sm text-gray-700 shadow-sm focus:ring-2 focus:ring-blue-500">
                    <option selected>All Reviews</option>
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
        </div>

        <!-- List Reviews -->
        <div class="space-y-6">
            @foreach ($ulasans as $ulasan)
            <div class="bg-white border border-gray-200 rounded-xl p-6 flex justify-between items-start hover:shadow-md transition">

                <div>
                    <h3 class="text-lg font-semibold text-gray-800">{{ $ulasan->makanan->nama }}</h3>
                    <p class="mt-2 text-gray-600">{{ $ulasan->komen }}</p>
                </div>

                <div class="flex flex-col items-end space-y-2">
                    <div class="flex space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5" fill="{{ $i <= $ulasan->rating ? '#facc15' : '#d1d5db' }}" viewBox="0 0 24 24">
                                <path d="M12 17.27L18.18 21l-1.63-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.45 4.73L5.82 21z"/>
                            </svg>
                        @endfor
                    </div>

                    <div class="relative">
                        <button id="dropdownButton{{ $ulasan->id }}" class="rounded-full p-2 text-gray-500 hover:bg-gray-100" data-dropdown-toggle="dropdownMenu{{ $ulasan->id }}">
                            <svg class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 3a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5a1.5 1.5 0 110 3 1.5 1.5 0 010-3zm0 5a1.5 1.5 0 110 3 1.5 1.5 0 010-3z"/>
                            </svg>
                        </button>

                        <div id="dropdownMenu{{ $ulasan->id }}" class="hidden absolute right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg">
                            <button data-modal-target="editModal{{ $ulasan->id }}" data-modal-toggle="editModal{{ $ulasan->id }}" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Review</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Edit Modal -->
            <div id="editModal{{ $ulasan->id }}" class="fixed inset-0 z-50 hidden flex items-center justify-center bg-black bg-opacity-50">
                <div class="bg-white rounded-lg p-6 w-full max-w-md">
                    <div class="flex justify-between mb-4">
                        <h3 class="text-xl font-semibold">Edit Review</h3>
                        <button data-modal-toggle="editModal{{ $ulasan->id }}" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
                    </div>

                    <form action="{{ route('review.update', $ulasan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="flex justify-center mb-4 text-3xl text-yellow-400">
                            @for ($i = 5; $i >= 1; $i--)
                                <input type="radio" id="star{{ $i }}_{{ $ulasan->id }}" name="rating" value="{{ $i }}" {{ $ulasan->rating == $i ? 'checked' : '' }} class="hidden peer" />
                                <label for="star{{ $i }}_{{ $ulasan->id }}" class="cursor-pointer peer-checked:text-yellow-400">&#9733;</label>
                            @endfor
                        </div>

                        <textarea name="comment" rows="4" class="w-full border border-gray-300 rounded-md p-3 mb-4" required>{{ old('comment', $ulasan->comment) }}</textarea>

                        <div class="flex justify-end gap-2">
                            <button type="button" data-modal-toggle="editModal{{ $ulasan->id }}" class="px-4 py-2 border rounded-md">Cancel</button>
                            <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-10">
            {{ $ulasans->links() }}
        </div>
    </div>
</section>

@endsection
