<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fogo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>
        <div>
            <main>
                
                <div class="bg-gray-100 dark:bg-gray-900 container mx-auto pt-6 rounded-2xl shadow-xl p-6">

                    <section class=" min-h-screen px-6">
                        <div class="mx-auto max-w-7xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                            <div class="relative flex items-center mb-6 h-[40px]">
                                <a href="{{ route('foods') }}" class="absolute left-0">
                                    <svg class="w-[29px] h-[29px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m15 19-7-7 7-7"/>
                                    </svg>
                                </a>
                                <h2 class="mx-auto text-2xl font-semibold text-gray-900 dark:text-white">
                                    Settings
                                </h2>
                            </div>
                            <div class="flex flex-col md:flex-row gap-6 md:gap-8 border-t-4 pt-4 md:pt-6">
                                <!-- Sidebar Menu di kiri -->
                                <aside class="w-full md:w-1/4 flex flex-col space-y-2">
                                    <ul class="flex flex-row md:flex-col md:space-y-1 bg-white dark:bg-gray-800 p-3 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                                        <li class="mb-2">
                                            <a href="{{ route('profile.index') }}" 
                                               class="block px-4 py-2.5 rounded-md font-semibold text-gray-700 dark:text-gray-300 hover:bg-orange-100 dark:hover:bg-gray-700 hover:text-orange-600 dark:hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-150 ease-in-out 
                                                      {{ request()->routeIs('profile.index') ? 'bg-orange-100 dark:bg-gray-700 text-orange-600 dark:text-orange-400' : '' }}">
                                                Settings Profile
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('akun.index') }}" 
                                               class="block px-4 py-2.5 rounded-md font-semibold text-gray-700 dark:text-gray-300 hover:bg-orange-100 dark:hover:bg-gray-700 hover:text-orange-600 dark:hover:text-orange-400 focus:outline-none focus:ring-2 focus:ring-orange-500 transition-all duration-150 ease-in-out 
                                                      {{ request()->routeIs('akun.index') ? 'bg-orange-100 dark:bg-gray-700 text-orange-600 dark:text-orange-400' : '' }}">
                                                Settings Account
                                            </a>
                                        </li>
                                    </ul>
                                </aside>
                                <!-- Konten Form di kanan -->
                                @yield('content')
                            </div>
                        </div>
                    </section>
                    
                </div>

            </main>
        </div>
        <script>
            function previewImage(event) {
                const input = event.target;
                const reader = new FileReader();

                reader.onload = function(){
                    const preview = document.getElementById('preview-image');
                    preview.src = reader.result;
                }

                if (input.files && input.files[0]) {
                    reader.readAsDataURL(input.files[0]);
                }
            }

            @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Sukses!',
                text: '{{ session('success') }}',
            });
            @endif

            @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: '{{ session('error') }}',
            });
            @endif

            @if (session('swalMessage'))

                    Swal.fire({
                        title: "{{ session('swalMessage.title') }}",
                        text: "{{ session('swalMessage.text') }}",
                        icon: "{{ session('swalMessage.icon') }}",
                        confirmButtonText: 'OK'
                    });

            @endif

        </script>


    </body>
</html>
