<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fogo</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript"
		src="https://app.stg.midtrans.com/snap/snap.js"
    data-client-key="{{config('midtrans.client_key')}}"></script>
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
               {{-- <div class="fixed top-0 left-0 z-50 w-full ">

        </div> --}}
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
                    <div class="pt-20">
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

<script>
    async function ambilLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async function (pos) {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                const APP_URL = "{{ config('app.url') }}";

                try {
                    const response = await fetch(`${APP_URL}ambil-kota`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            latitude: lat,
                            longitude: lon
                        })
                    });

                    const data = await response.json();

                    if (data.status === 'ok') {
                        location.reload();
                    } else {
                        console.error('Error dari server:', data.message);
                    }
                } catch (err) {
                    console.error('Gagal mengirim lokasi:', err);
                }
            }, function (error) {
                console.error('Gagal ambil lokasi:', error);
            });
        } else {
            console.error('Geolocation tidak didukung di browser ini.');
        }
    }

    @if (!session('user_kota'))
        document.addEventListener('DOMContentLoaded', function () {
            ambilLokasi();
        });
    @endif
</script>


</html>
