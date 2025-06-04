
@extends('layouts.page')

@section('content-user')
<div class="bg-gray-50  antialiased dark:bg-gray-900 ">


    <section class="relative bg-red-600 text-white rounded-b-3xl overflow-hidden">
        <!-- Content -->
        <div class="relative z-0  px-10 py-48 sm:py-32 lg:px-8 text-center"
        style="background-image: url('https://images.unsplash.com/photo-1458303210916-a83c4b8538e1?q=80&w=2006&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'); background-size: cover; background-position: center;
        background-size: cover; background-position: center;">
          <div class=" mx-auto">
            <h1 class="text-5xl font-extrabold tracking-tight text-white drop-shadow-lg sm:text-7xl">Makan Untuk Menjaga Lingkungan</h1>
            <p class="mt-6 text-xl leading-8 text-orange-100 drop-shadow">Bantu kurangi limbah makanan dengan memesan makanan sisa produksi dari mitra kami.</p>
            <!-- Form lokasi -->
            <form action="{{ route('ganti.kota') }}" method="POST" class="mt-10 max-w-md mx-auto bg-transparen rounded-2xl shadow-2xl p-6  flex flex-col space-y-4 transition-all duration-300 hover:shadow-orange-300">
                @csrf
                {{-- <label class="bg-white mx-auto px-2 rounded-xl text-lg font-bold text-orange-600 mb-1 ml-1">Lokasimu</label> --}}
                <div class="flex items-center flex-grow border-2 border-orange-400 bg-white rounded-2xl px-3 py-2 focus-within:ring-2 focus-within:ring-orange-500 transition-all duration-200">
                    <svg class="h-10 w-10 text-red-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                    </svg>
                    <input type="text" id="autocomplete" name="kota" value="{{ session('user_kota') }}" class="w-full border-none focus:outline-none text-black placeholder-black bg-white text-lg font-semibold" placeholder="Masukkan nama kota..." />
                    <button type="submit" class="flex items-center bg-orange-400 hover:bg-orange-500 text-gray-50 font-bold p-2 ml-2 rounded-xl transition duration-200 shadow-lg hover:scale-105" title="Cari Kota">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                    <button onclick="ambilLokasi()" class="flex items-center bg-orange-100 hover:bg-orange-200 text-orange-700 font-bold p-2 ml-2 rounded-xl transition duration-200 shadow-md hover:scale-105" title="Gunakan Lokasi Saat Ini">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                        </svg>
                    </button>
                </div>
            </form>
          </div>
        </div>
      </section>



    <!-- Category Navigation -->
    <div class="mx-auto max-w-screen-xl pt-20 px-4 mb-12 2xl:px-0">
        <div class="mb-6 text-center">
            <p class="text-4xl text-orange-700 dark:text-orange-300 font-semibold">Mau Makan Apa Hari Ini?</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 ">
            <a href="{{ route('foods') }}" class="group">
                <div class="relative rounded-xl overflow-hidden h-32 md:h-40 bg-cover bg-center transition-all duration-300 {{ !isset($selectedKategori) ? '' : 'grayscale group-hover:grayscale-0' }}"
                    style="background-image: url('https://images.unsplash.com/photo-1686150778458-ce4d48f9697d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                    <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-all"></div>
                    <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg drop-shadow-md">
                        Semua Makanan
                    </span>
                </div>
            </a>
            @foreach ($kategoris as $kategori)
                <a href="{{ route('makanan.kategori', $kategori->id) }}" class="group">
                    <div class="relative rounded-xl overflow-hidden h-32 md:h-40 bg-cover bg-center transition-all duration-300 {{ (isset($selectedKategori) && $selectedKategori->id == $kategori->id) ? '' : 'grayscale group-hover:grayscale-0' }}"
                        style="background-image: url('https://images.unsplash.com/photo-1686150778458-ce4d48f9697d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D')">
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-all"></div>
                        <span class="absolute inset-0 flex items-center justify-center text-white font-bold text-lg drop-shadow-md">
                            {{ $kategori->nama }}
                        </span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Existing Filter Button -->
    {{-- <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <div class="mb-4 items-end justify-between space-y-4 sm:flex sm:space-y-0 md:mb-8">
            <div class="flex items-center space-x-4 ">
                <button data-modal-toggle="filterModal" data-modal-target="filterModal" type="button" class="flex w-full items-center justify-center rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700 sm:w-auto">
                    <svg class="-ms-0.5 me-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M18.796 4H5.204a1 1 0 0 0-.753 1.659l5.302 6.058a1 1 0 0 1 .247.659v4.874a.5.5 0 0 0 .2.4l3 2.25a.5.5 0 0 0 .8-.4v-7.124a1 1 0 0 1 .247-.659l5.302-6.059c.566-.646.106-1.658-.753-1.658Z" />
                    </svg>
                    Filter
                    <svg class="-me-0.5 ms-2 h-4 w-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 9-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>
    </div> --}}

    <!-- Tombol untuk membuka modal filter -->

    @include('components.modal-filter')


    <!-- Daftar Makanan -->
    <div class="container mx-auto max-w-screen-xl px-4 mb-4 2xl:px-0">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
            @foreach ($makanans as $makanan)
            <div class="food-item rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 transform transition duration-300 hover:scale-105 hover:shadow-xl hover:shadow-orange-200 cursor-pointer" role="button" data-modal-target="{{ $makanan->id }}" data-modal-toggle="{{ $makanan->id }}">
                <div class="aspect-[3/2] w-full relative overflow-hidden">
                    <div class="animate-pulse bg-gray-200 absolute inset-0"></div>
                    <img class="mx-auto h-full dark:hidden relative z-10 object-cover"
                         src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"
                         alt="{{ $makanan->nama }}"
                         loading="lazy" />
                </div>
                <div class="pt-6">
                  <div class="mb-4 flex items-center justify-between gap-4">
                    <span class="me-2 rounded bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-800 dark:bg-orange-900 dark:text-orange-300">Up to 35% off</span>
                    <div class="flex items-center justify-end gap-1"></div>
                  </div>
                  <div class="text-lg font-semibold leading-tight text-gray-900 dark:text-white">
                    {{ $makanan->nama }}
                  </div>
                  <div class="mt-2 flex items-center gap-2">
                    @if ($makanan->rating_count > 0)
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4" fill="{{ $i <= $makanan->average_rating ? 'yellow' : 'gray' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z" />
                        </svg>
                        @endfor
                    </div>
                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $makanan->average_rating }}</p>
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">({{ $makanan->rating_count }})</p>
                    @else
                    <p class="text-sm font-medium text-gray-900 dark:text-white">belum ada rating</p>
                    @endif
                  </div>
                  <ul class="mt-2 flex flex-wrap items-center gap-4">
                    <li class="flex items-center gap-2 max-w-full">
                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"/>
                          </svg>
                      <p class="text-sm font-medium text-gray-500 dark:text-gray-400">{{ $makanan->mitra->name }}</p>
                      </p>
                    </li>
                    @if (session('user_latitude') && session('user_longitude') )
                    <li class="flex items-center gap-2 max-w-full">
                            <svg class="w-[20px] h-[20px] text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>

                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                {{ $makanan->jarak_km }} KM
                            </p>
                     </li>
                    @endif

                    <li class="flex items-center gap-2 max-w-full">
                        <svg class="w-[20px] h-[20px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M12 11H4m15.5 5a.5.5 0 0 0 .5-.5V8a1 1 0 0 0-1-1h-3.75a1 1 0 0 1-.829-.44l-1.436-2.12a1 1 0 0 0-.828-.44H8a1 1 0 0 0-1 1M4 9v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-7a1 1 0 0 0-1-1h-3.75a1 1 0 0 1-.829-.44L9.985 8.44A1 1 0 0 0 9.157 8H5a1 1 0 0 0-1 1Z"/>
                          </svg>
                      <span class="me-2 rounded-full bg-gradient-to-r from-orange-400 to-red-500 px-3 py-1 text-xs font-medium text-white">{{ $makanan->kategoris->nama }}</span>
                    </li>
                  </ul>
                  <div class="mt-4 flex flex-wrap items-center justify-between gap-4">
                    <p class="md:text-xl text-2xl font-extrabold leading-tight bg-gradient-to-r from-orange-600 to-red-600 bg-clip-text text-transparent">Rp{{ number_format($makanan->harga, 0, ',', '.') }}</p>
                  </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="flex justify-center gap-2 mt-10">
            <button id="showMoreBtn" class="px-5 py-2 rounded-full bg-white border border-orange-300 text-orange-700 hover:bg-orange-50 hover:border-orange-400 hover:text-orange-800 shadow-sm transition-all">Show More</button>
            <button id="showLessBtn" class="px-5 py-2 rounded-full bg-white border border-orange-300 text-orange-700 hover:bg-orange-50 hover:border-orange-400 hover:text-orange-800 shadow-sm transition-all hidden">Show Less</button>
        </div>
    </div>


@include('components.modal-food')
</div>

    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('filament-google-autocomplete-field.api-key') }}&libraries=places&language=id"></script>
    <script>
        const input = document.getElementById('autocomplete');
        const autocomplete = new google.maps.places.Autocomplete(input, {
            types: ['(cities)'],
            componentRestrictions: { country: 'id' } // opsional: hanya Indonesia
        });

        autocomplete.addListener('place_changed', () => {
        const place = autocomplete.getPlace();
        let level1 = '';

        // Cari komponen administrative_area_level_1
        for (const component of place.address_components) {
            if (component.types.includes('administrative_area_level_2')) {
                level1 = component.long_name;
                break;
            }
        }

        // Set value input hanya dengan administrative_area_level_1
        input.value = level1;
        });
    </script>
    <script>
        const items = document.querySelectorAll('.food-item');
        const showMoreBtn = document.getElementById('showMoreBtn');
        const showLessBtn = document.getElementById('showLessBtn');
        let shown = 8;
        function updateShown() {
            items.forEach((item, idx) => {
                item.style.display = idx < shown ? 'block' : 'none';
            });
            // ShowLess muncul jika sudah lebih dari 8 item yang tampil
            if (shown > 8) {
                showLessBtn.style.display = 'block';
            } else {
                showLessBtn.style.display = 'none';
            }
            // ShowMore tetap logika seperti sebelumnya
            if (shown >= items.length) {
                showMoreBtn.style.display = 'none';
            } else {
                showMoreBtn.style.display = 'block';
            }
        }
        updateShown();
        showMoreBtn.addEventListener('click', function() {
            shown += 4;
            updateShown();
        });
        showLessBtn.addEventListener('click', function() {
            shown = 8;
            updateShown();
        });
    </script>

@endsection


