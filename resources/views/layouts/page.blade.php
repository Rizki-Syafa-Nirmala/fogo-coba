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
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div>
        <!-- Menambahkan Navbar -->


        @php
            $agent = new Jenssegers\Agent\Agent();
        @endphp
        @if ($agent->isMobile())
            @yield('content-navbar-mobile')
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
                    <div class="">
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
        {{-- Spinner loading global --}}
    {{-- <div id="loading" class="text-center">
        <div role="status">
            <svg aria-hidden="true" class="inline w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <script>
        function showSpinner() {
            document.getElementById('loading').classList.remove('hidden');
        }

        function hideSpinner() {
            document.getElementById('loading').classList.add('hidden');
        }
    </script> --}}
</body>

<script>
    async function ambilLokasi() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(async function (pos) {
                const lat = pos.coords.latitude;
                const lon = pos.coords.longitude;
                const APP_URL = "{{ config('app.url') }}";

                try {
                    const response = await fetch(`${APP_URL}/ambil-kota`, {
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
