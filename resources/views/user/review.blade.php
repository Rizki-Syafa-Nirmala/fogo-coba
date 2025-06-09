@extends('layouts.page')

@section('content-user')

<section class="bg-white py-8 antialiased  md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
      <div class="mx-auto max-w-5xl">
        <div class="gap-4 sm:flex sm:items-center sm:justify-between">
          <h2 class="text-xl font-semibold text-gray-900  sm:text-2xl">My review</h2>
          <div class="mt-6 sm:mt-0">
            <label for="order-type" class="sr-only mb-2 block text-sm font-medium text-gray-900 ">Select ulasan type</label>
            <select id="order-type" class="block w-full min-w-[8rem] rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500      ">
              <option selected>All ulasans</option>
              <option value="5">5 stars</option>
              <option value="4">4 stars</option>
              <option value="3">3 stars</option>
              <option value="2">2 stars</option>
              <option value="1">1 star</option>
            </select>
          </div>
        </div>

        @foreach ($ulasans as $ulasan)

        <div class="mt-6 flow-root sm:mt-8">
            <div class="divide-y divide-gray-200 ">
                <div class="grid md:grid-cols-12 gap-4 md:gap-6 pb-4 md:pb-6">
                    <dl class="md:col-span-3 order-3 md:order-1">
                        <dt class="sr-only">Product:</dt>
                        <dd class="text-base font-semibold text-gray-900 ">
                        <a href="#" class="hover:underline">{{ $ulasan->makanan->nama }}</a>
                        </dd>
                    </dl>

                    <dl class="md:col-span-6 order-4 md:order-2">
                        <dt class="sr-only">Message:</dt>
                        <dd class=" text-gray-500 ">{{ $ulasan->komen }}</dd>
                    </dl>

                    <div class="md:col-span-3 content-center order-1 md:order-3 flex items-center justify-between">
                        <dl>

                            <dt class="sr-only">Stars:</dt>
                            <dd class="flex items-center space-x-1">
                                @for ($i = 1; $i <= 5; $i++)
                                <svg class="w-5 h-5" fill="{{ $i <= $ulasan->rating ? 'yellow' : 'gray' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M13.8 4.2a2 2 0 0 0-3.6 0L8.4 8.4l-4.6.3a2 2 0 0 0-1.1 3.5l3.5 3-1 4.4c-.5 1.7 1.4 3 2.9 2.1l3.9-2.3 3.9 2.3c1.5 1 3.4-.4 3-2.1l-1-4.4 3.4-3a2 2 0 0 0-1.1-3.5l-4.6-.3-1.8-4.2Z"></path>
                                </svg>
                                @endfor
                            </dd>
                        </dl>
                        <button id="actionsMenuDropdown{{ $ulasan->id }}"  type="button" class="inline-flex h-7 w-7 items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100  " data-dropdown-toggle="dropdownOrder{{ $ulasan->id }}">
                                <span class="sr-only"> Actions </span>
                                <svg class="h-6 w-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-width="4" d="M6 12h.01m6 0h.01m5.99 0h.01"></path>
                                </svg>
                        </button>
                        <div id="dropdownOrder{{ $ulasan->id }}" class="z-10 hidden w-40 divide-y divide-gray-100 rounded-lg bg-white shadow " data-popper-placement="bottom">
                            <div class="p-2 text-left text-sm font-medium text-gray-500 " aria-labelledby="actionsMenuDropdown">
                                <div>
                                    <button type="button" data-modal-target="editulasanModal{{ $ulasan->id }}" data-modal-toggle="editulasanModal{{ $ulasan->id }}"  class="group inline-flex w-full items-center rounded-md px-3 py-2 text-sm text-gray-500 hover:bg-gray-100 hover:text-gray-900   ">
                                        <svg class="me-1.5 h-4 w-4 text-gray-400 group-hover:text-gray-900  " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                        <span>Edit ulasan</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="editulasanModal{{ $ulasan->id }}" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
            <div class="relative max-h-full w-full max-w-2xl p-4">
                <!-- Modal content -->
                <div class="relative rounded-lg bg-white shadow ">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4  md:p-5">
                        <h3 class="mb-1 text-lg font-semibold text-gray-900 ">Edit ulasan</h3>
                    <button type="button" class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900  " data-modal-toggle="editulasanModal{{ $ulasan->id }}">
                        <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    </div>
                    <!-- Modal body -->
                    <form class="p-4 md:p-5" action="{{ route('review.update', $ulasan->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <div class="flex items-center flex-row text-5xl">
                                <div class="flex justify-center text-5xl flex-row-reverse">
                                    <!-- 5 Star -->
                                    <input type="radio" id="star5_{{ $ulasan->id }}" name="rating" value="5" {{ $ulasan->rating == 5 ? 'checked' : '' }} class="hidden peer" />
                                    <label for="star5_{{ $ulasan->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                    <!-- 4 Star -->
                                    <input type="radio" id="star4_{{ $ulasan->id }}" name="rating" value="4" {{ $ulasan->rating == 4? 'checked' : '' }} class="hidden peer" />
                                    <label for="star4_{{ $ulasan->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                    <!-- 3 Star -->
                                    <input type="radio" id="star3_{{ $ulasan->id }}" name="rating" value="3" {{ $ulasan->rating == 3 ? 'checked' : '' }} class="hidden peer" />
                                    <label for="star3_{{ $ulasan->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                    <!-- 2 Star -->
                                    <input type="radio" id="star2_{{ $ulasan->id }}" name="rating" value="2" {{ $ulasan->rating == 2 ? 'checked' : '' }} class="hidden peer" />
                                    <label for="star2_{{ $ulasan->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>

                                    <!-- 1 Star -->
                                    <input type="radio" id="star1_{{ $ulasan->id }}" name="rating" value="1" {{ $ulasan->rating == 1 ? 'checked' : '' }} class="hidden peer" />
                                    <label for="star1_{{ $ulasan->id }}" class="text-gray-400 cursor-pointer peer-checked:text-yellow-500">&#9733;</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-2">
                            <label for="comment" class="mb-2 block text-sm font-medium text-gray-900 ">ulasan</label>
                            <textarea id="comment"name="comment" rows="6" class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500      " required="">{{ old('comment', $ulasan->comment) }}</textarea>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4  md:pt-5">
                        <button type="submit" class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300   ">Edit ulasan</button>
                        <button type="button" data-modal-toggle="editulasanModal{{ $ulasan->id }}" class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100      ">Cancel</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>

        <nav class="mt-6 flex items-center justify-center sm:mt-8" aria-label="Page navigation example">
          <ul class="flex h-8 items-center -space-x-px text-sm">
            @if ($ulasans->onFirstPage())
                <li>
                <a href="#" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700     ">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </a>
                </li>
            @else
                <li>
                <a href="{{ $ulasans->previousPageUrl() }}" class="ms-0 flex h-8 items-center justify-center rounded-s-lg border border-e-0 border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700     ">
                    <span class="sr-only">Previous</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7" />
                    </svg>
                </a>
                </li>
            @endif

            @foreach ($ulasans->getUrlRange(1, $ulasans->lastPage()) as $page => $url)
            <li>
                <a href="{{ $url }}" class="flex h-8 items-center justify-center border border-gray-300 bg-white px-3 leading-tight text-gray-500 {{ $ulasans->currentPage() == $page ?   ''   :  ''    }} ">
                {{ $page }}
                </a>
            </li>
            @endforeach

            @if ($ulasans->hasMorePages())
                <li>
                <a href="#" class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700     ">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </a>
                </li>
            @else
                <li>
                <a href="#" class="flex h-8 items-center justify-center rounded-e-lg border border-gray-300 bg-white px-3 leading-tight text-gray-500 hover:bg-gray-100 hover:text-gray-700     ">
                    <span class="sr-only">Next</span>
                    <svg class="h-4 w-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
                    </svg>
                </a>
                </li>
            @endif
          </ul>
        </nav>
      </div>
    </div>
</section>


@endsection
