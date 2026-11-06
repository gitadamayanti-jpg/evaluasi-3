<x-home-layout>
    <div class="mx-auto w-full max-w-6xl" style="padding-top: 32px; padding-bottom: 48px;">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">
                Checkout
            </h1>
            <p class="mt-2 text-slate-500">
                Lengkapi informasi pembeli dan pilih metode pembayaran untuk pesanan REPLAY kamu.
            </p>
        </div>

        <div class="grid grid-cols-1 items-start gap-8 lg:grid-cols-3">
            <div class="lg:col-span-2">
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                    <h2 class="mb-6 text-xl font-bold text-slate-800">
                        Informasi Pembeli
                    </h2>

                    <form action="{{ route('checkout.store') }}" method="POST">
                        @csrf

                        <div class="mb-5">
                            <label for="nama" class="mb-2 block font-semibold text-slate-700">
                                Nama Lengkap
                            </label>
                            <input
                                type="text"
                                name="nama"
                                id="nama"
                                value="{{ old('nama') }}"
                                required
                                maxlength="255"
                                autocomplete="name"
                                placeholder="Masukkan nama lengkap"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >
                        </div>

                        <div class="mb-5">
                            <label for="email" class="mb-2 block font-semibold text-slate-700">
                                Email
                            </label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email') }}"
                                required
                                maxlength="255"
                                autocomplete="email"
                                placeholder="contoh@email.com"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >
                        </div>

                        <div class="mb-5">
                            <label for="alamat" class="mb-2 block font-semibold text-slate-700">
                                Alamat Lengkap
                            </label>
                            <textarea
                                name="alamat"
                                id="alamat"
                                rows="4"
                                required
                                maxlength="1000"
                                autocomplete="street-address"
                                placeholder="Masukkan alamat lengkap pengiriman"
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >{{ old('alamat') }}</textarea>
                        </div>

                        <div class="mb-6">
                            <label for="metode_pembayaran" class="mb-2 block font-semibold text-slate-700">
                                Metode Pembayaran
                            </label>

                            <select
                                name="metode_pembayaran"
                                id="metode_pembayaran"
                                required
                                class="w-full rounded-lg border border-slate-300 px-4 py-3 text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                            >
                                <option value="">Pilih Metode Pembayaran</option>
                                <option value="Transfer Bank" {{ old('metode_pembayaran') == 'Transfer Bank' ? 'selected' : '' }}>
                                    Transfer Bank
                                </option>
                                <option value="E-Wallet" {{ old('metode_pembayaran') == 'E-Wallet' ? 'selected' : '' }}>
                                    E-Wallet
                                </option>
                                <option value="COD" {{ old('metode_pembayaran') == 'COD' ? 'selected' : '' }}>
                                    COD (Bayar di Tempat)
                                </option>
                            </select>

                            <p class="mt-2 text-sm text-slate-500">
                                Pilih metode pembayaran yang kamu inginkan.
                            </p>
                        </div>

                        <div class="flex flex-wrap justify-end gap-3 border-t border-slate-200 pt-6">
                            <a
                                href="{{ route('cart.index') }}"
                                class="inline-flex items-center justify-center rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
                            >
                                Kembali ke Keranjang
                            </a>

                            <button
                                type="submit"
                                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700"
                            >
                                Konfirmasi Pesanan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="lg:col-span-1">
                <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
                    <h2 class="mb-6 text-xl font-bold text-slate-800">
                        Ringkasan Pesanan
                    </h2>

                    <div class="space-y-5">
                        @foreach ($cart as $item)
                            <div class="flex items-start justify-between gap-4 border-b border-slate-100 pb-4">
                                <div class="min-w-0">
                                    <p class="font-semibold text-slate-800">
                                        {{ $item['nama'] }}
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $item['merek'] }}
                                    </p>

                                    <p class="mt-2 text-sm text-slate-500">
                                        {{ $item['jumlah'] }} × Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                    </p>
                                </div>

                                <p class="whitespace-nowrap font-semibold text-slate-800">
                                    Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-6 flex items-center justify-between gap-4 border-t border-slate-200 pt-5">
                        <span class="font-semibold text-slate-600">
                            Total Belanja
                        </span>

                        <span class="text-xl font-bold text-blue-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>

                    <div class="mt-5 rounded-lg bg-blue-50 p-4">
                        <p class="text-sm leading-6 text-blue-800">
                            Periksa kembali produk dan total belanja sebelum menekan tombol Konfirmasi Pesanan.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-home-layout>