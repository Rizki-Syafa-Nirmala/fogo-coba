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
        <!-- Menambahkan Navbar -->
        @php
            $agent = new Jenssegers\Agent\Agent();
        @endphp
        @if ($agent->isMobile())
            @include('components.navbar-mobile')

        @else
            @auth
                @include('components.navbar-user')
            @else
                @include('components.navbar')
            @endauth

        @endif
        <main>
            @if ($agent->isMobile())
                @auth
                    <div class="pt-20">
                        @yield('content-user-mobile')
                    </div>
                @else
                    <script>
                        window.location.href = "{{ route('filament.user.auth.login') }}";
                    </script>
                @endauth
            @else
                @auth
                    <div class="">
                        @yield('content-user')
                    </div>
                @else
                    <div class="pt-20">
                        @yield('content')
                @endauth
            @endif

                    <!-- Tambahkan JS di footer -->
        </main>
        <!-- Konten utama halaman -->
        @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
        @endif

        @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                html: `{!! implode('<br>', $errors->all()) !!}`,
            });
        </script>
        @endif
    </div>
</body>
</html>
