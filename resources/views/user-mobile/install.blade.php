@extends('layouts.page')

@section('content-mobile')
<div class="bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 min-h-screen flex items-center justify-center p-5 text-white">
    <div class="max-w-md w-full text-center">
        <!-- App Icon -->
        <div class="w-32 h-32 bg-white rounded-3xl mx-auto mb-8 flex items-center justify-center shadow-2xl text-6xl text-indigo-600 transform hover:scale-105 transition-transform">
            📱
        </div>

        <!-- Title & Subtitle -->
        <h1 class="text-3xl md:text-4xl font-bold mb-4">Aplikasi PWA</h1>
        <p class="text-lg opacity-90 mb-10 leading-relaxed">
            Install aplikasi kami untuk pengalaman yang lebih baik.
            Akses offline, notifikasi push, dan performa seperti aplikasi native.
        </p>

        <!-- Download Button -->
        <button id="downloadBtn" class="bg-white text-indigo-600 px-8 py-4 rounded-full text-lg font-semibold shadow-lg hover:shadow-xl hover:-translate-y-1 disabled:opacity-60 disabled:cursor-not-allowed disabled:transform-none transition-all duration-300 inline-flex items-center gap-3 mb-6">
            <div class="w-6 h-6 border-2 border-indigo-600 border-t-transparent rounded-full loader hidden"></div>
            <span id="btnText">📥 Install Aplikasi</span>
        </button>

        <!-- Status Message -->
        <div id="statusMessage" class="status-message px-5 py-3 rounded-xl text-sm hidden mt-5"></div>

        <!-- Features -->
        <div class="mt-8 text-left">
            <h3 class="text-xl font-semibold mb-4 text-center">Fitur Aplikasi:</h3>
            <div class="space-y-4">
                <div class="flex items-center text-sm opacity-90">
                    <span class="text-green-400 text-lg mr-3">✓</span>
                    <span>Akses offline tanpa internet</span>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span class="text-green-400 text-lg mr-3">✓</span>
                    <span>Notifikasi push real-time</span>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span class="text-green-400 text-lg mr-3">✓</span>
                    <span>Performa cepat seperti aplikasi native</span>
                </div>
                <div class="flex items-center text-sm opacity-90">
                    <span class="text-green-400 text-lg mr-3">✓</span>
                    <span>Hemat penyimpanan device</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let deferredPrompt;
        let isInstalling = false;

        // Event listener untuk beforeinstallprompt
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            console.log('PWA install prompt ready');
        });

        // Cek apakah service worker sudah terdaftar
        function checkServiceWorker() {
            if ('serviceWorker' in navigator) {
                navigator.serviceWorker.getRegistrations().then(registrations => {
                    if (registrations.length > 0) {
                        showStatus('Service Worker sudah terdaftar', 'success');
                    }
                });
            }
        }

        // Fungsi untuk mendaftarkan service worker
        async function registerServiceWorker() {
            if ('serviceWorker' in navigator) {
                try {
                    const registration = await navigator.serviceWorker.register('/sw.js');
                    console.log('Service Worker registered:', registration);
                    showStatus('Service Worker berhasil didaftarkan!', 'success');
                    return true;
                } catch (error) {
                    console.error('Service Worker registration failed:', error);
                    showStatus('Gagal mendaftarkan Service Worker', 'error');
                    return false;
                }
            } else {
                showStatus('Browser tidak mendukung Service Worker', 'error');
                return false;
            }
        }

        // Fungsi untuk menampilkan status
        function showStatus(message, status) {
            const statusEl = document.getElementById('statusMessage');
            statusEl.textContent = message;
            statusEl.className = `status-message px-5 py-3 rounded-xl text-sm mt-5`;

            // Add status-specific classes
            if (status === 'success') {
                statusEl.classList.add('bg-green-500/20', 'border', 'border-green-400/30', 'text-green-100');
            } else if (status === 'error') {
                statusEl.classList.add('bg-red-500/20', 'border', 'border-red-400/30', 'text-red-100');
            } else if (status === 'info') {
                statusEl.classList.add('bg-blue-500/20', 'border', 'border-blue-400/30', 'text-blue-100');
            }

            statusEl.classList.remove('hidden');

            // Hide status after 5 seconds
            setTimeout(() => {
                statusEl.classList.add('hidden');
            }, 5000);
        }

        // Fungsi untuk toggle loading state
        function toggleLoading(loading) {
            const btn = document.getElementById('downloadBtn');
            const loader = btn.querySelector('.loader');
            const btnText = document.getElementById('btnText');

            if (loading) {
                btn.disabled = true;
                loader.classList.remove('hidden');
                btnText.textContent = 'Menginstall...';
            } else {
                btn.disabled = false;
                loader.classList.add('hidden');
                btnText.textContent = '📥 Install Aplikasi';
            }
        }

        // Fungsi utama untuk install PWA
        async function installPWA() {
            if (isInstalling) return;

            isInstalling = true;
            toggleLoading(true);

            try {
                // 1. Daftarkan service worker terlebih dahulu
                showStatus('Mendaftarkan Service Worker...', 'info');
                const swRegistered = await registerServiceWorker();

                if (!swRegistered) {
                    toggleLoading(false);
                    isInstalling = false;
                    return;
                }

                // 2. Tunggu sebentar untuk memastikan SW terdaftar
                await new Promise(resolve => setTimeout(resolve, 1000));

                // 3. Coba install PWA
                if (deferredPrompt) {
                    showStatus('Menampilkan dialog install...', 'info');
                    deferredPrompt.prompt();

                    const { outcome } = await deferredPrompt.userChoice;

                    if (outcome === 'accepted') {
                        showStatus('Aplikasi berhasil diinstall!', 'success');
                        document.getElementById('btnText').textContent = '✅ Terinstall';
                    } else {
                        showStatus('Install dibatalkan', 'error');
                    }

                    deferredPrompt = null;
                } else {
                    // Fallback untuk browser yang tidak mendukung install prompt
                    if (window.DeviceMotionEvent && typeof DeviceMotionEvent.requestPermission === 'function') {
                        // iOS Safari
                        showStatus('Buka menu Share > Add to Home Screen untuk menginstall', 'info');
                    } else {
                        showStatus('Buka menu browser > Add to Home Screen untuk menginstall', 'info');
                    }
                }

            } catch (error) {
                console.error('Error installing PWA:', error);
                showStatus('Terjadi kesalahan saat install', 'error');
            } finally {
                toggleLoading(false);
                isInstalling = false;
            }
        }

        // Event listener untuk tombol download
        document.getElementById('downloadBtn').addEventListener('click', installPWA);

        // Cek status saat halaman dimuat
        window.addEventListener('load', () => {
            checkServiceWorker();

            // Cek apakah PWA sudah terinstall
            if (window.matchMedia && window.matchMedia('(display-mode: standalone)').matches) {
                document.getElementById('btnText').textContent = '✅ Sudah Terinstall';
                document.getElementById('downloadBtn').disabled = true;
                showStatus('Aplikasi sudah terinstall!', 'success');
            }
        });

        // Event listener untuk appinstalled
        window.addEventListener('appinstalled', () => {
            console.log('PWA was installed');
            showStatus('Aplikasi berhasil terinstall!', 'success');
            document.getElementById('btnText').textContent = '✅ Terinstall';
        });
    </script>
</div>

@endsection
