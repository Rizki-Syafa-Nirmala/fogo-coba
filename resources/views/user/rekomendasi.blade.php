@extends('layouts.page')

@section('content-user')

<!-- Simple Header Section -->
<section class="bg-orange-50  py-24">
    <div class="max-w-screen-xl mx-auto px-4">
      <div class="mb-6 max-w-3xl">
        <h1 class="text-xl md:text-3xl font-extrabold mb-4 leading-tight">
          Rekomendasi <span class="text-orange-600">{{ session('user_kota') }}</span>
        </h1>
        <p class="text-gray-600 text-base md:text-lg mb-5 leading-relaxed">
          Temukan kuliner terbaik di sekitarmu dengan rekomendasi pilihan yang telah kami kurasi khusus untuk berbagai selera dan kebutuhan
        </p>
        <div class="flex flex-wrap items-center gap-x-6 gap-y-2 text-xs text-gray-500 font-medium">
          <span class="flex items-center space-x-1.5">
            <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            <span>{{ session('user_kota') }}</span>
          </span>
            {{-- <span class="flex items-center space-x-1.5">
                <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span>50+ Resto Terpilih</span>
            </span> --}}
        </div>
      </div>
    </div>
</section>


<!-- Terdekat Section -->

@if($terdekat->count() > 0)

<section class="py-10 bg-white">
   <div class="max-w-screen-xl mx-auto px-4">
     <!-- Section Header -->
     <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
       <div>
         <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
           Terdekat
         </h2>

       </div>
     </div>

     <!-- Cards Grid -->


     <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-10 mb-6">
       @foreach ($terdekat as $makanan)
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
               @if ($makanan->jarak_km !== null )
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

     <!-- Show All Button -->
     <div class="flex justify-center py-4">
       <a href="{{ route('lihatsemuarekomendasi', 'terdekat') }}" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition-colors duration-200">
         Tampilkan semua
       </a>
     </div>
   </div>
</section>
@endif
 <!-- Terdekat Section -->


@if($termurah->count() > 0)

<section class="py-10 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
        <div>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
            Termurah
          </h2>

        </div>
      </div>

      <!-- Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-10 mb-6">
          @foreach ($termurah as $makanan)
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
                  @if ($makanan->jarak_km !== null )
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

        <!-- Show All Button -->
        <div class="flex justify-center py-4">
          <a href="{{ route('lihatsemuarekomendasi', 'termurah') }}" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition-colors duration-200">
            Tampilkan semua
          </a>
        </div>
    </div>
</section>
@endif


@if ($terpopuler->count() > 0)

<section class="py-10 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
      <!-- Section Header -->
      <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
        <div>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
            Terpopuler
          </h2>

        </div>
      </div>

      <!-- Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-10 mb-6">
          @foreach ($terpopuler as $makanan)
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
                  @if ($makanan->jarak_km !== null )
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

        <!-- Show All Button -->
        <div class="flex justify-center py-4">
          <a href="{{ route('lihatsemuarekomendasi', 'terpopuler') }}" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition-colors duration-200">
            Tampilkan semua
          </a>
        </div>
    </div>
</section>
@endif
{{-- terpopuler --}}


@if ($terbaik->count() > 0)

{{-- terbaik --}}
<section class="py-10 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
        <div>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
            Terbaik
          </h2>

        </div>
      </div>

      <!-- Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-10 mb-6">
          @foreach ($terbaik as $makanan)
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
                  @if ($makanan->jarak_km !== null )
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

        <!-- Show All Button -->
        <div class="flex justify-center py-4">
          <a href="{{ route('lihatsemuarekomendasi', 'terbaik') }}" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition-colors duration-200">
            Tampilkan semua
          </a>
        </div>
    </div>
</section>
@endif

@if ($terfavorit->count() > 0)

{{-- terbaik --}}
<section class="py-10 bg-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between mb-4">
        <div>
          <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900 mb-2">
            Terfavorit
          </h2>

        </div>
      </div>

      <!-- Cards Grid -->
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 xl:grid-cols-4 gap-10 mb-6">
          @foreach ($terfavorit as $makanan)
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
                  @if ($makanan->jarak_km !== null )
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

        <!-- Show All Button -->
        <div class="flex justify-center py-4">
          <a href="{{ route('lihatsemuarekomendasi', 'terfavorit') }}" type="button" class="text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2 text-center transition-colors duration-200">
            Tampilkan semua
          </a>
        </div>
    </div>
</section>
@endif
@include('components.modal-food')

@endsection
