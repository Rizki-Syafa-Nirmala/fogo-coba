@foreach ($makanans as $makanan)
<div id="{{ $makanan->id }}" tabindex="-1" class="fixed inset-0 z-50 hidden w-full p-10 flex items-center justify-center">
    <div data-modal-hide="{{ $makanan->id }}" class="fixed inset-0 bg-orange-100/30 backdrop-blur-lg z-60"></div>
    <div class="relative w-full max-w-4xl max-h-[80vh] overflow-y-auto">
        <!-- Modal content -->
        <div class="relative  bg-white rounded-lg shadow-sm border-2 dark:bg-gray-900">
            <!-- Modal header -->
            <div class="flex items-center justify-between  p-4 md:p-5  rounded-t ">
                <button type="button" data-modal-hide="{{ $makanan->id }}" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="pb-2 md:px-10">
                <section class=" bg-white dark:bg-gray-900 antialiased">
                    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0">
                      <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16">
                        <div class="shrink-0 border border-orange-100 shadow-sm shadow-orange-100 max-w-md lg:max-w-lg mx-auto">
                          {{-- <img class="w-full dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/imac-front.svg" alt="" /> --}}
                          <img class="w-full  dark:hidden " src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}" alt="" />
                          <img class="w-full hidden dark:block" src="{{ $makanan->gambar_makanan ? asset('storage/'.$makanan->gambar_makanan) : asset('images/food.png') }}" alt="" />
                        </div>

                        <div class="mt-6 sm:mt-8 lg:mt-10">
                          <h1
                            class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white"
                          >
                            {{ $makanan->nama }}
                          </h1>
                          <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                            <p
                              class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-white"
                            >
                                Rp. {{ number_format($makanan->harga, 0, ',', '.') }}
                            </p>

                            <div class="flex items-center gap-2 mt-2 sm:mt-0">
                                @if ($makanan->rating_count > 0)
                                <div class="flex items-center gap-1">

                                    @for ($i = 1; $i <= 5; $i++)
                                    <svg
                                    class="w-4 h-4 text-yellow-300"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="{{ $i <= $makanan->average_rating ? 'yellow' : 'gray' }}"
                                    viewBox="0 0 24 24"
                                    >
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z"
                                    />
                                    </svg>
                                    @endfor
                                </div>
                                <p
                                    class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400"
                                >
                                    ({{ $makanan->average_rating }})
                                </p>
                                <a
                                href="#"
                                class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"
                                >
                                {{ $makanan->rating_count }} ulasan
                            </a>
                            @else
                            @endif

                            </div>
                          </div>

                            <form action="{{ route('transaksi.store') }}" method="POST" class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                                @csrf
                                <button
                                type="submit"
                                title=""
                                class="text-white mt-4 sm:mt-0 bg-orange-400 hover:bg-orange-500 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center"
                                >
                                <input type="hidden" name="makanan_id" value="{{ $makanan->id }}">
                                {{-- <input type="hidden" name="total_price" value="{{ $makanan->harga }}"> --}}
                                <svg
                                    class="w-5 h-5 -ms-2 me-2"
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="24"
                                    height="24"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6"
                                    />
                                </svg>

                                Add to cart
                                </button>
                            </form>


                        </div>
                        <p class="mb-6 text-gray-500 dark:text-gray-400">
                          {{ $makanan->deskripsi }}
                        </p>
                      </div>
                    </div>
                </section>
                <section class="py-10 bg-white antialiased dark:bg-gray-900 overflow-y-auto">
                    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                      <div class="flex items-center gap-2">
                        @if ($makanan->rating_count > 0)

                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">Reviews</h2>
                        @else
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white">No Reviews</h2>

                        @endif
                        <div class="mt-2 flex items-center gap-2 sm:mt-0">
                            @if ($makanan->rating_count > 0)
                            <div class="flex items-center gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 text-yellow-300"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="{{ $i <= $makanan->average_rating ? 'yellow' : 'gray' }}" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                @endfor
                                <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">({{ $makanan->average_rating }})</p>
                                <a href="#" class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-white"> {{ $makanan->rating_count }} Reviews </a>

                            </div>
                            @else

                            @endif
                        </div>
                      </div>

                      <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                        <div class="shrink-0 space-y-4">
                          <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-white">{{ $makanan->average_rating }} out of 5</p>
                          {{-- <button type="button" data-modal-target="review-modal" data-modal-toggle="review-modal" class="mb-2 me-2 rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Write a review</button> --}}
                        </div>

                        <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                          <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">5</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300"  xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                              <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $makanan->rating_5_percent }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">{{ $makanan->rating_5 > 0 ? $makanan->rating_5 : 0 }} <span class="hidden sm:inline">reviews</span>
                            </a>
                          </div>

                          <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">4</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                              <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $makanan->rating_4_percent }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">{{ $makanan->rating_5 > 0 ? $makanan->rating_4 : 0 }} <span class="hidden sm:inline">reviews</span>
                            </a>
                          </div>

                          <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">3</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                              <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $makanan->rating_3_percent }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">{{ $makanan->rating_3 > 0 ? $makanan->rating_3 : 0 }} <span class="hidden sm:inline">reviews</span></a>
                          </div>

                          <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">2</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                              <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $makanan->rating_2_percent }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">{{ $makanan->rating_2 > 0 ? $makanan->rating_2 : 0 }} <span class="hidden sm:inline">reviews</span></a>
                          </div>

                          <div class="flex items-center gap-2">
                            <p class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-white">1</p>
                            <svg class="h-4 w-4 shrink-0 text-yellow-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                              <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                            </svg>
                            <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                              <div class="h-1.5 rounded-full bg-yellow-300" style="width: {{ $makanan->rating_1_percent }}%"></div>
                            </div>
                            <a href="#" class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">{{ $makanan->rating_1 > 0 ? $makanan->rating_1 : 0 }} <span class="hidden sm:inline">reviews</span></a>
                          </div>
                        </div>
                      </div>

                      <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach ($makanan->ulasan as $ulasan  )
                        <div class="gap-3 py-6 sm:flex sm:items-start">
                          <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                            <div class="flex items-center gap-0.5">
                                @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 text-yellow-300" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="{{ $i <= $ulasan->rating ? 'yellow' : 'gray' }}" viewBox="0 0 24 24">
                                <path d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477l-4.552-.36-1.754-4.17Z" />
                                </svg>
                                @endfor
                            </div>

                            <div class="space-y-0.5">
                              <p class="text-base font-semibold text-gray-900 dark:text-white">{{ $ulasan->user->name }}</p>
                              <p class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $ulasan->updated_at->format('F j, Y \a\t h:i A') }}</p>
                            </div>
                          </div>

                          <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                            <p class="text-base font-normal text-gray-500 dark:text-gray-400">{{ $ulasan->komen }}</p>
                          </div>
                        </div>
                        @endforeach
                      </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>

@endforeach
