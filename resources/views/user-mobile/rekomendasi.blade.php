@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')

<body class="bg-white p-4">
    <div class="max-w-md mx-auto">
        <!-- Title -->
        <div class="flex flex-col items-center mb-6">
            <h2 class="font-semibold text-xl text-gray-900 mb-4 tracking-wide">
                Makanan yang Tersedia
            </h2>
            <!-- Category Scroll -->
            <div class="w-full max-w-md overflow-x-auto scrollbar-hide">
                <div class="flex space-x-3 px-1">
                    <button class="whitespace-nowrap bg-blue-600 text-white text-sm font-semibold px-3    py-2 rounded-full shadow-md hover:bg-blue-700 transition">
                    Semua Makanan
                    </button>
                    <button class="whitespace-nowrap bg-gray-200 text-gray-800 text-sm font-semibold px-5 py-2 rounded-full shadow-sm hover:bg-gray-300 transition">
                    Makanan Ringan
                    </button>
                    <button class="whitespace-nowrap bg-gray-200 text-gray-800 text-sm font-semibold px-5 py-2 rounded-full shadow-sm hover:bg-gray-300 transition">
                    Minuman
                    </button>
                    <button class="whitespace-nowrap bg-gray-200 text-gray-800 text-sm font-semibold px-5 py-2 rounded-full shadow-sm hover:bg-gray-300 transition">
                    Cemilan
                    </button>
                </div>
            </div>
        </div>
        <!-- Food Cards (No Scroll) -->
        <div class="flex space-x-5 px-1 pb-2">
            <div class="border border-gray-300 rounded-xl w-44 shadow hover:shadow-lg transition cursor-pointer bg-white">
                <div class="p-4 border-b border-gray-300 flex justify-center bg-gradient-to-b from-blue-50 to-white rounded-t-xl">
                    <img
                    alt="Gift box icon with ribbon and bow in grayscale"
                    class="w-24 h-24 object-contain"
                    height="96"
                    src="https://storage.googleapis.com/a1aa/image/2df0b00f-bd6e-40ee-0e8d-93fc19034c1d.jpg"
                    width="96"
                    />
                </div>
                <div class="p-4 bg-gray-50 rounded-b-xl">
                    <p
                    class="text-sm font-semibold text-gray-900 truncate"
                    title="quos aliquid"
                    >
                    quos aliquid
                    </p>
                    <p class="text-sm font-bold text-blue-600 mt-1">Rp 97.346</p>
                    <p class="text-xs font-medium text-gray-500 mt-1">0.31 KM</p>
                </div>
            </div>
            <div class="border border-gray-300 rounded-xl w-44 shadow hover:shadow-lg transition cursor-pointer bg-white">

                <div class="p-4 border-b border-gray-300 flex justify-center bg-gradient-to-b from-blue-50 to-white rounded-t-xl">
                    <img
                    alt="Gift box icon with ribbon and bow in grayscale"
                    class="w-24 h-24 object-contain"
                    height="96"
                    src="https://storage.googleapis.com/a1aa/image/2df0b00f-bd6e-40ee-0e8d-93fc19034c1d.jpg"
                    width="96"
                    />
                </div>
                <div class="p-4 bg-gray-50 rounded-b-xl">
                    <p
                    class="text-sm font-semibold text-gray-900 truncate"
                    title="deserunt conseq..."
                    >
                    deserunt conseq...
                    </p>
                    <p class="text-sm font-bold text-blue-600 mt-1">Rp 75.848</p>
                    <p class="text-xs font-medium text-gray-500 mt-1">0.31 KM</p>
                </div>
            </div>
        </div>
    </div>
</body>

@endsection
