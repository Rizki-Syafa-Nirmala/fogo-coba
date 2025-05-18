    <!-- Modal Filter -->
    <form action="{{ route('foods') }}" method="GET" id="filterModal" tabindex="-1" aria-hidden="true" class="fixed left-0 right-0 top-0 z-50 hidden h-modal w-full overflow-y-auto overflow-x-hidden p-4 md:inset-0 md:h-full">
        @csrf
        <div class="relative h-full w-full max-w-xl md:h-auto">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
                <!-- Modal header -->
                <div class="flex items-start justify-between rounded-t p-4 md:p-5">
                    <h3 class="text-lg font-normal text-gray-500 dark:text-gray-400">Filter</h3>
                    <button type="button" class="ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-100 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="filterModal">
                        <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18 17.94 6M18 18 6.06 6" />
                        </svg>
                        <span class="sr-only">Tutup Modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                    <div class="px-4 md:px-5">
                        <div class="mb-4 border-b border-gray-200 dark:border-gray-700">
                            <ul class="-mb-px flex flex-wrap text-center text-sm font-medium" id="myTab" data-tabs-toggle="#myTabContent" role="tablist">
                                <li class="mr-1" role="presentation">
                                  <button class="inline-block pb-2 pr-1" id="kategori-tab" data-tabs-target="#kategori" type="button" role="tab" aria-controls="profile" aria-selected="false">Kategori</button>
                                </li>
                                <li class="mr-1" role="presentation">
                                  <button class="inline-block px-2 pb-2 hover:border-gray-300 hover:text-gray-600 dark:hover:text-gray-300" id="restoran-tab" data-tabs-target="#restoran-filters" type="button" role="tab" aria-controls="restoran-filters" aria-selected="false">Restoran Filter</button>
                                </li>
                            </ul>
                        </div>

                        <div id="myTabContent">
                            <div class="grid grid-cols-2 gap-4 md:grid-cols-3" id="kategori" role="tabpanel" aria-labelledby="kategori-tab">
                                <div class="space-y-3">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">kategori</h5>
                                    @foreach ($kategoris as $kategori)
                                    <div class="flex items-center">
                                            <input type="checkbox" id="kategori{{ $kategori->id }}" name="kategoris[]" value="{{ $kategori->id }}" {{ in_array($kategori->id, request('kategoris', [])) ? 'checked' : '' }}  class="h-4 w-4  rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                                            <label for="kategori{{ $kategori->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $kategori->nama }}</label>

                                    </div>
                                    @endforeach
                                </div>
                                <div class="space-y-3">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">restoran</h5>
                                    @foreach ($partners as $partner)
                                    <div class="flex items-center">
                                        <div>
                                            <input  type="checkbox" id="partner{{ $partner->id }}" name="partner[]" value="{{ $partner->id }}" {{ in_array($partner->id, request('partner', [])) ? 'checked' : '' }}  class="h-4 w-4  rounded border-gray-300 bg-gray-100 text-primary-600 focus:ring-2 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600">
                                            <label for="partner{{ $partner->id }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $partner->name }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                        </div>

                        <div class="space-y-4" id="restoran-filters" role="tabpanel" aria-labelledby="restoran-tab">
                            <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
                                <div class="grid grid-cols-2 gap-3">
                                    <h5 class="text-lg font-medium uppercase text-black dark:text-white">pilih Restoran</h5>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="flex items-center space-x-4 rounded-b p-4 dark:border-gray-600 md:p-5">
                        <button type="submit" class="rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-800">Terapkan Filter</button>
                        <a href="{{ route('foods') }}" type="reset" class="rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Reset</a>
                    </div>

            </div>
        </div>
    </form>
