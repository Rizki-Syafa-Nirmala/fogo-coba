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
                <section class="bg-white dark:bg-gray-900 min-h-screen py-8 px-6">
                    <div class="mx-auto max-w-7xl bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
                        <div class="relative flex items-center mb-6 h-[40px]">
                            <!-- SVG di pojok kiri -->
                            <a href="{{ route('foods') }}" class="absolute left-0">
                                <svg class="w-[29px] h-[29px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="m15 19-7-7 7-7"/>
                                </svg>
                            </a>

                            <!-- Judul di tengah -->
                            <h2 class="mx-auto text-2xl font-semibold text-gray-900 dark:text-white">
                                Settings
                            </h2>
                        </div>


                      <!-- Tabs -->
                      <ul class="flex flex-wrap md:text-md font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
                        <li class="me-2">
                            <a href="{{ route('profile.index') }}" class="inline-block p-4 rounded-t-lg {{ request()->routeIs('profile.index') ? 'dark:text-blue-400' : 'dark:text-gray-400  hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-gray-300' }}" >
                            Settings Profile
                            </a>
                        </li>
                        <li class="me-2">
                            <a href="{{ route('akun.index') }}" class="inline-block p-4 rounded-t-lg {{ request()->routeIs('akun.index') ? 'dark:text-blue-400' : 'dark:text-gray-400  hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 dark:hover:text-gray-300' }}">
                            Settings Account
                            </a>
                        </li>
                      </ul>

                      @yield('content')
                    </div>
                </section>
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
