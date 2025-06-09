<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fogo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
    <body>
        <div>
            @php
            $agent = new Jenssegers\Agent\Agent();
            @endphp
            @if ($agent->isMobile())
            @include('components.navbar-mobile')

            @else
                {{-- <div class="fixed top-0 left-0 z-50 w-full ">

            </div> --}}
                @auth
                    @include('components.navbar-user')
                @else
                    @include('components.navbar')
                @endauth

                @endif
                <main class="pt-20">
                    <div class="container mx-auto pt-6 bg-gray-50  rounded-2xl shadow-xl p-6">

                        <section class="min-h-screen px-6">
                            <div class="flex flex-col md:flex-row gap-6 md:gap-8 pt-4 md:pt-6">
                                <!-- Sidebar Menu di kiri -->
                                <aside class="w-full md:w-1/4 p-2 flex flex-col">
                                    <ul class="flex flex-row md:flex-col md:space-y-1 bg-white shadow-xl  p-3 rounded-lg shadow-sm border border-gray-200 ">

                                        <li>
                                            <a href="{{ route('belum-dibayar') }}" class="block px-4 py-2 rounded-lg font-semibold text-gray-700 hover:bg-orange-100 hover:text-orange-700 focus:bg-orange-200 focus:text-orange-800 transition-all duration-200 {{ request()->routeIs('belum-dibayar') ? 'bg-orange-100 text-orange-700' : '' }}">
                                                Belum Dibayar
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('semua-transaksi') }}" class="block px-4 py-2 rounded-lg font-semibold text-gray-700 hover:bg-orange-100 hover:text-orange-700 focus:bg-orange-200 focus:text-orange-800 transition-all duration-200 {{ request()->routeIs('semua-transaksi') ? 'bg-orange-100 text-orange-700' : '' }}">
                                                Riwayat Transaksi
                                            </a>
                                    </ul>
                                </aside>
                                <!-- Konten Form di kanan -->
                                @yield('content')
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
