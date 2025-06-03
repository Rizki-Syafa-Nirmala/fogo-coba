@extends('layouts.page')



@section('content-user')
    <section class="bg-gradient-to-br from-[#f8fafc] to-[#e0e7ef] py-8 antialiased dark:bg-gradient-to-br dark:from-gray-900 dark:to-gray-800 md:py-16">
        <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
            <div class="mx-auto max-w-3xl shadow-xl rounded-2xl bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 p-6">
                <h2 class="text-2xl font-bold text-[#1e293b] dark:text-white sm:text-3xl mb-4">Order summary</h2>
                <div class="mt-6 space-y-4 border-b border-t border-gray-200 py-8 dark:border-gray-700 sm:mt-8">
                    <h4 class="text-lg font-semibold text-[#0f172a] dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-[#3b82f6]" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                        Informasi Pelanggan
                    </h4>
                    <dl>
                        <dt class="text-base font-medium text-[#334155] dark:text-white">Data Pelanggan</dt>
                        <dd class="mt-1 text-base font-normal text-gray-500 dark:text-gray-400">{{ $transaksi->user->name }}-{{ $transaksi->user->no_telp }}, {{ $transaksi->user->alamat }}</dd>
                    </dl>
                    <button type="button" data-modal-target="billingInformationModal" data-modal-toggle="billingInformationModal" class="text-base font-medium text-[#3b82f6] hover:underline">lihat detail</button>
                </div>
                <div class="mt-6 sm:mt-8">
                    <div class="relative overflow-x-auto border-b border-gray-200 dark:border-gray-800 rounded-lg">
                        <table class="w-full text-left font-medium text-[#1e293b] dark:text-white md:table-fixed">
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-800">
                            <tr>
                                <td class="whitespace-nowrap py-4 md:w-[384px]">
                                    <div class="flex items-center gap-4">
                                        <div class="flex items-center aspect-square w-12 h-12 shrink-0 rounded-lg overflow-hidden border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800">
                                            <img class="h-auto w-full max-h-full dark:hidden" src="{{ $transaksi->makanan->gambar_makanan ? asset('storage/'.$transaksi->makanan->gambar_makanan) : asset('images/food.png') }}" alt="imac image" />
                                            <img class="hidden h-auto w-full max-h-full dark:block" src="{{ $transaksi->makanan->gambar_makanan ? asset('storage/'.$transaksi->makanan->gambar_makanan) : asset('images/food.png') }}" alt="imac image" />
                                        </div>
                                        <div class="hover:underline font-semibold">{{ $transaksi->makanan->nama }}</div>
                                    </div>
                                </td>
                                <td class="p-4 text-right text-base font-bold text-[#10b981] dark:text-green-400">Rp.{{ number_format($transaksi->makanan->harga) }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4 space-y-6">
                        <h4 class="text-xl font-semibold text-[#0f172a] dark:text-white">Ringkasan Pembayaran</h4>
                        <div class="space-y-4">
                            <div class="space-y-2">

                                @if ($transaksi->user->point > 0 && $transaksi->status_pembayaran === 'belum dibayar')
                                <!-- Toggle potongan poin -->
                                <form id="form-poin" action="{{ route('hitungPotongan', $transaksi->id) }}" method="POST">
                                    @csrf

                                    <!-- Hidden field agar checkbox unchecked tetap mengirim nilai -->
                                    <input type="hidden" name="point" value="0">

                                    <label class="inline-flex items-center cursor-pointer">
                                        <input
                                            type="checkbox"
                                            name="point"
                                            value="1"
                                            {{ old('point', $transaksi->point) ? 'checked' : '' }}
                                            class="sr-only peer"
                                            onchange="document.getElementById('form-poin').submit();"
                                            >
                                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                                            <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Gunakan Poin</span>
                                        </label>
                                </form>
                                @endif
                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">Harga Makanan</dt>
                                    <dd class="text-base font-medium text-[#1e293b] dark:text-white">Rp.{{ number_format($transaksi->makanan->harga) }}</dd>
                                </dl>


                                @if ($transaksi->point === 1)


                                <dl class="flex items-center justify-between gap-4">
                                    <dt class="text-gray-500 dark:text-gray-400">diskon poin</dt>
                                    <dd class="text-base font-medium text-red-400 dark:text-white">-Rp.{{ number_format($transaksi->makanan->harga - $transaksi->total_harga)}}</dd>
                                </dl>
                                @endif

                                <!-- Add more payment details here if needed -->
                            </div>
                            <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                                <dt class="text-lg font-bold text-[#0f172a] dark:text-white">Total</dt>
                                <dd id="total-harga" class="text-lg font-bold text-[#10b981] dark:text-green-400">Rp.{{ number_format($transaksi->total_harga) }}</dd>
                            </dl>
                        </div>
                        @if ($transaksi->status_pembayaran == 'belum dibayar')

                        <div class="gap-4 sm:flex sm:items-center">
                            <input type="hidden" name="id" value="{{ $transaksi->id }}">
                            <a href="{{ route('bayar', $transaksi->id) }}"class="mt-4 flex w-full items-center justify-center rounded-lg bg-gradient-to-r from-[#3b82f6] to-[#06b6d4] px-5 py-2.5 text-sm font-semibold text-white shadow-lg hover:scale-105 transition-transform duration-200 focus:outline-none focus:ring-4 focus:ring-[#3b82f6]/30 sm:mt-0">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a5 5 0 00-10 0v2a2 2 0 00-2 2v7a2 2 0 002 2h10a2 2 0 002-2v-7a2 2 0 00-2-2z" /></svg>
                                BAYAR SEKARANG
                            </a>
                        </div>
                        @else
                            <div class="mt-4 text-center">
                                <p class="text-gray-500 dark:text-gray-400">{{ $transaksi->status_pembayaran }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="billingInformationModal" tabindex="-1" aria-hidden="true" class="antialiased fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-auto w-full max-h-full items-center justify-center overflow-y-auto overflow-x-hidden antialiased md:inset-0">
        <div class="relative max-h-auto w-full max-h-full max-w-lg p-4">
            <!-- Modal content -->
            <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
            <!-- Modal header -->
            <div class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Detail Pelanggan</h3>
                <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="billingInformationModal">
                <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <div class="mb-4">
                    <label for="first_name_billing_modal" class ="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> First Name* </label>
                    <p class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                        {{ $transaksi->user->name }}
                    </p>
                </div>

                @if ($transaksi->user->last_name != null)
                <div class="mb-4">
                    <label for="last_name_billing_modal" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Last Name* </label>
                    <p class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                        {{ $transaksi->user->last_name }}
                    </p>
                </div>
                @endif

                <div class="mb-4 sm:col-span-2">
                    <label for="phone-input_billing_modal" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Phone Number* </label>
                    <div class="flex items-center">
                        {{-- <div class="relative w-full">
                            <input type="text" id="phone-input" class="z-20 block w-full rounded-e-lg border border-s-0 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:border-s-gray-700  dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" placeholder="123-456-7890" required />
                        </div> --}}
                        <p class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                            {{ $transaksi->user->no_telp }}
                        </p>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="address_billing_modal" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Shipping Address* </label>
                    <p class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500">
                        {{ $transaksi->user->alamat }}
                    </p>

                </div>
            </div>
            </div>
        </div>
    </div>
@if ($transaksi->status_pembayaran == 'belum dibayar')

    @if ($snapToken != null)
    <script type="text/javascript"
        src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{config('midtrans.client_key')}}">
    </script>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function () {
                window.snap.pay('{{ $snapToken }}', {
                    onSuccess: function(result){
                        console.log("Pembayaran sukses", result);
                        window.location.href = '{{ route('transaksi') }}'; // arahkan ke halaman sukses kamu
                    },
                    onPending: function(result){
                        console.log("Pembayaran pending", result);
                    },
                    onError: function(result){
                        console.log("Pembayaran error", result);
                        alert("Terjadi kesalahan saat pembayaran");
                    },
                    onClose: function(){
                        console.log('Popup ditutup oleh pengguna');
                    }
                });
        });
    </script>
    @endif
@endif



@endsection
