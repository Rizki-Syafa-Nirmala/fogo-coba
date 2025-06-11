@extends('layouts.page')

@section('content-navbar-mobile')
    @include('components.navbar-mobile')
@endsection

@section('content-user-mobile')
<div class="bg-gray-50">
    <div class="max-w-sm mx-auto bg-white min-h-screen">
        <!-- Header -->
        <header class="sticky top-0 z-50 bg-white border-b border-gray-300 shadow-sm">
                <div class="flex items-center justify-between px-4 py-4">

                    <h1 class="text-xl font-semibold text-gray-900 text-center flex-1">Pesanan Saya</h1>

                    <!-- Spacer agar posisi tetap tengah -->
                    <div style="width: 24px;"></div>
                    <!-- Tombol Trigger -->
                    <button id="refresh-status-btn" class="text-orange-500 hover:text-orange-600">
                        <i class="fas fa-sync-alt text-xl"></i>
                    </button>
                </div>
        </header>

        <!-- Filter Tabs -->
        <div class="bg-white px-1 py-3 border-b border-gray-100">
            <div class="flex space-x-1">
                <a href="{{ route('mobile.transaksiberlangsung') }}" type="button"
                   class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('mobile.transaksiberlangsung') ? 'text-white bg-orange-400' : 'text-gray-900 bg-gray-50 border border-orange-600' }} rounded-lg">
                    <i class="fas fa-clock mr-2"></i> Berlangsung
                </a>
                <a href="{{ route('mobile.semua-transaksi') }}" type="button"
                        class="flex-1 inline-flex items-center justify-center px-4 py-2.5 text-sm font-medium {{ request()->routeIs('mobile.semua-transaksi') ? 'text-white bg-orange-400' : 'text-gray-900 bg-gray-50 border border-orange-600' }} rounded-lg">
                    <i class="fas fa-check-circle mr-2"></i> Selesai
                </a>
            </div>
        </div>

        @forelse ($transaksis as $transaksi)
        <!-- Order List -->
        <div class="px-1 py-2 space-y-4">
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <!-- Header Pesanan -->
                <div class="p-4 border-b border-gray-100">
                    <div class="flex items-center space-x-3">
                        <div id="status-icon-{{ $transaksi->id }}" class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i id="status-icon-i-{{ $transaksi->id }}" class="fas fa-shopping-bag text-green-600 text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">
                                        Pesanan {{ $transaksi->makanan->nama }}
                                    </p>
                                    <p class="text-xs text-gray-500 mt-0.5">
                                        {{ $transaksi->created_at->translatedFormat('d M Y H:i') }}
                                    </p>
                                </div>
                                <button type="button" onclick="toggleOrderDetails('order-{{ $transaksi->id }}')" class="text-gray-900 ">
                                    <i id="icon-{{ $transaksi->id }}" class="fas fa-chevron-up text-2xl"></i>
                                </button>
                            </div>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-hotel mr-1"></i> {{ $transaksi->mitra->name }}
                                </span>
                                <span class="text-sm font-semibold text-gray-900">Rp {{ number_format($transaksi->makanan->harga, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Status Pesanan -->
                <div id="order-{{ $transaksi->id }}" style="display: none;" class="p-4">
                    <h3 class="text-sm font-semibold text-gray-900 mb-4">Status Pesanan</h3>

                    @php
                        $steps = ['Pesanan dibuat', 'Pesanan dibayar', 'Diproses Mitra', 'Siap Ambil', 'Selesai'];
                        $currentStep = 0;
                        if ($transaksi->status_pembayaran === 'sudah dibayar') $currentStep = 1;
                        if ($transaksi->status === 'Proses') $currentStep = 2;
                        if ($transaksi->status === 'Siap ambil') $currentStep = 3;
                        if ($transaksi->status === 'Selesai') $currentStep = 4;
                    @endphp

                    @foreach ($steps as $index => $step)
                        @php $done = $index <= $currentStep; @endphp
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <div class="flex items-center space-x-3">
                                <div class="w-3 h-3 {{ $done ? 'bg-green-500' : 'bg-gray-300' }} rounded-full flex-shrink-0" id="status-bullet-{{ $transaksi->id }}-{{ $index }}"></div>
                                <span class="text-sm font-medium {{ $done ? 'text-gray-900' : 'text-gray-400' }}" id="status-text-{{ $transaksi->id }}-{{ $index }}">{{ $step }}</span>
                            </div>
                            <span class="text-sm {{ $done ? 'text-gray-500' : 'text-gray-400' }}" id="status-end-{{ $transaksi->id }}-{{ $index }}">{{ $done ? 'Selesai' : 'pending' }}</span>
                        </div>
                    @endforeach

                    <!-- Tombol Aksi -->
                        @if ($transaksi->status !== 'Selesai')

                        <div class="flex space-x-2 mt-6 pt-4 border-t border-gray-100">
                                <!-- Tombol Aksi -->

                                <button
                                    id="status-button-{{ $transaksi->id }}"
                                    type="button"
                                    class="flex-1 font-medium rounded-lg text-sm px-3 py-2 transition-all"
                                >
                                    <i class="fas mr-1" id="status-icon-{{ $transaksi->id }}"></i>
                                    <span id="status-label-{{ $transaksi->id }}"></span>
                                </button>

                            {{-- <button type="button" class="flex-1 text-gray-600 bg-gray-50 hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 transition-all">
                                <i class="fas fa-headset mr-1"></i> Bantuan
                            </button> --}}
                        </div>
                        @else
                        <!-- Tombol Aksi -->
                        <div class="flex space-x-2 mt-6 pt-4 border-t border-gray-100">
                            <button
                                type="button"
                                class="flex-1 text-gray-600 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-3 py-2 transition-all"
                            >
                                <i class="fas fa-eye mr-1"></i> Lihat Detail
                            </button>

                            <button
                                type="button"
                                class="flex-1 text-gray-900 bg-gray-50 hover:bg-gray-100 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-3 py-2 transition-all"
                            >
                                <i class="fas fa-star mr-1"></i> Beri Rating
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
        </div>
        @empty
        <div class="p-4 text-center text-gray-500">
            Belum ada pesanan.
        </div>
        @endforelse

        <div class="h-6"></div>
    </div>
</div>

<!-- Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
<script>

    function updateStatusButton(transaksi) {
        const button = document.getElementById(`status-button-${transaksi.id}`);
        const icon = document.getElementById(`status-icon-${transaksi.id}`);
        const label = document.getElementById(`status-label-${transaksi.id}`);

        if (!button || !icon || !label) return;

        // Reset class dan icon
        button.className = "flex-1 font-medium rounded-lg text-sm px-3 py-2 transition-all";
        icon.className = "fas mr-1";

        // Logika berdasarkan status
        if (transaksi.status_pembayaran === 'belum dibayar') {
            button.classList.add("text-yellow-700", "bg-yellow-100", "hover:bg-yellow-200");
            icon.classList.add("fa-money-bill");
            label.textContent = "Bayar Sekarang";
        } else if (transaksi.status === 'Siap ambil') {
            button.classList.add("text-green-600", "bg-green-50", "hover:bg-green-100");
            icon.classList.add("fa-check");
            label.textContent = "Selesaikan Pesanan";
        } else if (transaksi.status === 'Selesai') {
            button.classList.add("text-gray-600", "bg-gray-100", "hover:bg-gray-200");
            icon.classList.add("fa-eye");
            label.textContent = "Lihat Detail";
        } else {
            button.classList.add("text-blue-600", "bg-blue-50", "hover:bg-blue-100");
            icon.classList.add("fa-info-circle");
            label.textContent = "Status Pesanan";
        }
    }

    function toggleOrderDetails(orderId) {
        const detailsDiv = document.getElementById(orderId);
        const iconId = 'icon-' + orderId.split('-')[1];
        const icon = document.getElementById(iconId);

        if (detailsDiv.style.display === 'none' || detailsDiv.style.display === '') {
            detailsDiv.style.display = 'block';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        } else {
            detailsDiv.style.display = 'none';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        }
    }

// Fungsi utama untuk fetch status
    function fetchTransaksiStatus() {
        fetch("{{ route('mobile.ajax.transaksi.statusSemua') }}")
            .then(response => response.json())
            .then(data => {
                const steps = ['Pesanan dibuat', 'Pesanan dibayar', 'Diproses Mitra', 'Siap Ambil', 'Selesai'];

                data.forEach(transaksi => {
                    updateStatusButton(transaksi);
                });

                data.forEach(transaksi => {
                    let id = transaksi.id;
                    let currentStep = 0;

                    if (transaksi.status === 'Selesai') currentStep = 4;
                    else if (transaksi.status === 'Siap ambil') currentStep = 3;
                    else if (transaksi.status === 'Proses') currentStep = 2;
                    else if (transaksi.status_pembayaran === 'sudah dibayar') currentStep = 1;

                    steps.forEach((step, index) => {
                        const bullet = document.getElementById(`status-bullet-${id}-${index}`);
                        const text = document.getElementById(`status-text-${id}-${index}`);
                        const end = document.getElementById(`status-end-${id}-${index}`);
                        if (!bullet || !text || !end) return;

                        if (index <= currentStep) {
                            bullet.className = "w-3 h-3 bg-green-500 rounded-full flex-shrink-0";
                            text.className = "text-sm font-medium text-gray-900";
                            end.textContent = 'Selesai';
                            end.className = "text-sm text-gray-500";
                        } else {
                            bullet.className = "w-3 h-3 bg-gray-300 rounded-full flex-shrink-0";
                            text.className = "text-sm font-medium text-gray-400";
                            end.textContent = 'pending';
                            end.className = "text-sm text-gray-400";
                        }
                    });

                    const iconWrapper = document.getElementById(`status-icon-${id}`);
                    const icon = document.getElementById(`status-icon-i-${id}`);
                    if (!iconWrapper || !icon) return;

                    iconWrapper.className = "flex-shrink-0 w-12 h-12 rounded-full flex items-center justify-center";
                    icon.className = "fas text-lg";

                    if (transaksi.status_pembayaran === 'belum dibayar') {
                        iconWrapper.classList.add("bg-yellow-100");
                        icon.classList.add("fa-clock", "text-yellow-600");
                    } else if (transaksi.status === 'Proses') {
                        iconWrapper.classList.add("bg-blue-100");
                        icon.classList.add("fa-cogs", "text-blue-600");
                    } else if (transaksi.status === 'Siap ambil') {
                        iconWrapper.classList.add("bg-indigo-100");
                        icon.classList.add("fa-store", "text-indigo-600");
                    } else if (transaksi.status === 'Selesai') {
                        iconWrapper.classList.add("bg-green-100");
                        icon.classList.add("fa-check-circle", "text-green-600");
                    } else if (['Gagal', 'Dibatalkan'].includes(transaksi.status)) {
                        iconWrapper.classList.add("bg-red-100");
                        icon.classList.add("fa-times-circle", "text-red-600");
                    } else {
                        iconWrapper.classList.add("bg-gray-100");
                        icon.classList.add("fa-shopping-bag", "text-gray-600");
                    }
                });
            });
    }

    // Jalankan otomatis saat halaman dimuat
    window.addEventListener('DOMContentLoaded', () => {
        fetchTransaksiStatus(); // dipanggil otomatis sekali
    });

    // Masih bisa dipanggil juga lewat tombol kalau dibutuhkan
    document.getElementById('refresh-status-btn')?.addEventListener('click', () => {
        fetchTransaksiStatus(); // dipanggil manual lewat tombol
    });


</script>
@endsection
