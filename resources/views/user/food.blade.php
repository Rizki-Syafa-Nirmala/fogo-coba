
@extends('layouts.page')

@section('content-user')
<div class="bg-gray-50  antialiased  ">
<section class="relative overflow-hidden">
  <div class="absolute inset-0 bg-cover bg-center z-0" style="background-image: url('https://images.unsplash.com/photo-1458303210916-a83c4b8538e1?q=80&w=2006&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D');">
    <div class="absolute inset-0 bg-gradient-to-b from-red-900/80 via-red-800/70 to-red-700/80"></div>
  </div>

  <div class="relative z-10 px-6 py-24 sm:py-32 lg:px-8 max-w-6xl mx-auto">
    <div class="flex flex-col items-center">
      {{-- Decorative Elements --}}
      <div class="absolute top-10 left-10 w-20 h-20 rounded-full bg-orange-400/30 blur-xl"></div>
      <div class="absolute bottom-20 right-10 w-32 h-32 rounded-full bg-red-500/30 blur-xl"></div>

      {{-- Badge --}}
      <div class="bg-orange-500 text-white px-4 py-1 rounded-full text-sm font-medium mb-6 animate-pulse">
        Selamatkan Makanan, Selamatkan Bumi
      </div>

      {{-- Main Heading with Animation --}}
      <h1 class="text-5xl md:text-6xl lg:text-7xl font-extrabold text-white text-center max-w-4xl leading-tight">
        <span class="inline-block transform hover:scale-105 transition-transform duration-300">Makan</span>
        <span class="inline-block transform hover:scale-105 transition-transform duration-300">Untuk</span>
        <span class="inline-block transform hover:scale-105 transition-transform duration-300">Menjaga</span>
        <span class="bg-gradient-to-r from-orange-300 to-yellow-200 text-transparent bg-clip-text inline-block transform hover:scale-105 transition-transform duration-300">Lingkungan
        </span>
      </h1>

      {{-- Subheading with improved styling --}}
      <p class="mt-8 text-xl md:text-2xl text-orange-100 text-center max-w-2xl leading-relaxed">
        Bantu kurangi limbah makanan dengan memesan makanan sisa produksi dari mitra kami.
      </p>

      {{-- Form with enhanced styling --}}
      <form action="{{ route('ganti.kota') }}" method="POST" class="mt-12 w-full max-w-2xl mx-auto">
        @csrf
        <div class="bg-white/10 backdrop-blur-md p-6 rounded-3xl shadow-2xl border border-white/20 transition-all duration-300 hover:shadow-orange-500/30">
          <div class="flex items-center flex-wrap sm:flex-nowrap gap-3 mt-2">
            <div class="flex items-center flex-grow bg-white rounded-2xl px-4 py-3 shadow-inner focus-within:ring-2 focus-within:ring-orange-500 transition-all duration-200 w-full">
              <svg class="h-8 w-8 text-red-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path
                  fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"
                />
              </svg>
              <input type="text" id="autocomplete" name="kota" value="{{ session('user_kota') }}"
                class="w-full border-none focus:outline-none text-gray-800 placeholder-gray-500 bg-transparent text-lg font-medium ml-3"
                placeholder="Masukkan nama kota..."
              />
            </div>

            <div class="flex gap-2 w-full sm:w-auto">
            <button type="submit" class="flex items-center justify-center bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold p-3 rounded-xl transition duration-300 shadow-lg hover:shadow-orange-500/50 hover:scale-105">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </button>
            </div>
            
            <button type="button" onclick="ambilLokasi()" class="flex items-center justify-center bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white font-bold px-4 py-3 rounded-xl transition duration-300 shadow-lg hover:shadow-orange-300/30 hover:scale-105 flex-grow sm:flex-grow-0"
            title="Gunakan Lokasi Saat Ini">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3" />
                </svg>
              </button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

    <!-- Category Navigation -->
<div class="mx-auto max-w-screen-xl pt-20 px-4 mb-12 2xl:px-0">
    <div class="mb-10 text-center">
        <h2 class="text-4xl md:text-5xl font-bold mb-2">
            Mau Makan <span class="text-orange-600">Apa Hari Ini?</span>
        </h2>
        <div class="w-24 h-1 bg-gradient-to-r from-orange-300 to-orange-600 mx-auto rounded-full"></div>
    </div>

    <div class="grid grid-cols-5 md:grid-cols-5 gap-5">
        <a href="{{ route('foods') }}" class="group">
            <div class="relative h-20 w-auto  rounded-xl overflow-hidden transition-all duration-300 
                {{ !isset($selectedKategori) ? 'ring-4 ring-orange-400 shadow-lg shadow-orange-200' : '' }}">
                <div class="absolute inset-0 bg-gradient-to-br from-orange-400 to-red-500 group-hover:from-orange-500 group-hover:to-red-600 transition-all duration-500"></div>
                
                <!-- Decorative Elements -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/10 rounded-full translate-y-8 -translate-x-8"></div>
                
                <!-- Text Content -->
                <div class="absolute inset-0 flex flex-col items-center justify-center p-1 transition-all duration-300 group-hover:scale-105">
                    <span class="text-white font-bold text-lg text-center drop-shadow-md">
                        Semua Makanan
                    </span>
                    <div class="w-0 group-hover:w-16 h-0.5 bg-white/70 mt-2 transition-all duration-300"></div>
                </div>
            </div>
        </a>
        
        <!-- Dynamic Categories -->
        @foreach ($kategoris as $index => $kategori)
            <a href="{{ route('makanan.kategori', $kategori->id) }}" class="group">
                <div class="relative h-20 rounded-xl overflow-hidden transition-all duration-300
                    {{ (isset($selectedKategori) && $selectedKategori->id == $kategori->id) ? 'ring-4 ring-orange-400 shadow-lg shadow-orange-200' : '' }}">
                    
                    <!-- Dynamic Gradient Background -->
                    <div class="absolute inset-0 transition-all duration-500
                        {{ $index % 5 == 0 ? 'bg-gradient-to-br from-blue-400 to-indigo-600 group-hover:from-blue-500 group-hover:to-indigo-700' : '' }}
                        {{ $index % 5 == 1 ? 'bg-gradient-to-br from-green-400 to-teal-600 group-hover:from-green-500 group-hover:to-teal-700' : '' }}
                        {{ $index % 5 == 2 ? 'bg-gradient-to-br from-purple-400 to-pink-600 group-hover:from-purple-500 group-hover:to-pink-700' : '' }}
                        {{ $index % 5 == 3 ? 'bg-gradient-to-br from-yellow-400 to-amber-600 group-hover:from-yellow-500 group-hover:to-amber-700' : '' }}
                        {{ $index % 5 == 4 ? 'bg-gradient-to-br from-red-400 to-rose-600 group-hover:from-red-500 group-hover:to-rose-700' : '' }}
                    "></div>
                    
                    <!-- Decorative Elements -->
                    <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -translate-y-10 translate-x-10"></div>
                    <div class="absolute bottom-0 left-0 w-16 h-16 bg-white/10 rounded-full translate-y-8 -translate-x-8"></div>
                    
                    <!-- Text Content -->
                    <div class="absolute inset-0 flex flex-col items-center justify-center p-4 transition-all duration-300 group-hover:scale-105">
                        <span class="text-white font-bold text-lg text-center drop-shadow-md">
                            {{ $kategori->nama }}
                        </span>
                        <div class="w-0 group-hover:w-16 h-0.5 bg-white/70 mt-2 transition-all duration-300"></div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>

    <!-- Daftar Makanan -->
    <div class="container mx-auto max-w-screen-xl px-4 mb-4 2xl:px-0">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-10">
            @foreach ($makanans as $makanan)
            <div class="food-item rounded-lg border border-gray-200 bg-white p-4 shadow-sm   transform transition duration-300 hover:scale-105 hover:shadow-xl hover:shadow-orange-200 cursor-pointer" role="button" data-modal-target="{{ $makanan->id }}" data-modal-toggle="{{ $makanan->id }}">
                <div class="aspect-[3/2] w-full relative overflow-hidden">
                    <div class="animate-pulse bg-gray-200 absolute inset-0"></div>
                     <img class="mx-auto h-full  relative z-10 object-cover"
                        src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}"
                        alt="{{ $makanan->nama }}"
                        loading="lazy" />
                </div>
                <div class="pt-6">
                  <div class="mb-4 flex items-center justify-between gap-4">
                    <span class="me-2 rounded bg-orange-100 px-2.5 py-0.5 text-xs font-medium text-orange-800  ">Up to 35% off</span>
                    <div class="flex items-center justify-end gap-1"></div>
                  </div>
                  <div class="text-lg font-semibold leading-tight text-gray-900 ">
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
                    <p class="text-sm font-medium text-gray-900 ">{{ $makanan->average_rating }}</p>
                    <p class="text-sm font-medium text-gray-500 ">({{ $makanan->rating_count }})</p>
                    @else
                    <p class="text-sm font-medium text-gray-900 ">belum ada rating</p>
                    @endif
                  </div>
                  <ul class="mt-2 flex flex-wrap items-center gap-4">
                    <li class="flex items-center gap-2 max-w-full">
                        <svg class="w-[20px] h-[20px] text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"/>
                          </svg>
                      <p class="text-sm font-medium text-gray-500 ">{{ $makanan->mitra->name }}</p>
                      </p>
                    </li>
                    @if (session('user_latitude') && session('user_longitude') )
                    <li class="flex items-center gap-2 max-w-full">
                            <svg class="w-[20px] h-[20px] text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>

                            <p class="text-sm font-medium text-gray-500 ">
                                {{ $makanan->jarak_km }} KM
                            </p>
                     </li>
                    @endif

                    <li class="flex items-center gap-2 max-w-full">
                        <svg class="w-[20px] h-[20px] text-gray-800 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
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

