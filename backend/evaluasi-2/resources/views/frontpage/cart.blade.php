<x-home-layout>
    <div class="mx-auto flex w-full max-w-6xl flex-col" style="padding-top: 32px; padding-bottom: 32px;">

        <div style="margin-bottom: 32px;">
            <h1 class="text-3xl font-bold text-slate-800" style="margin: 0 0 12px 0;">
                Keranjang Belanja
            </h1>

            <p class="text-slate-500" style="margin: 0;">
                Periksa kamera REPLAY yang ingin kamu beli.
            </p>
        </div>

        @php
            $total = 0;

            foreach ($cart as $item) {
                $total += $item['harga'] * $item['jumlah'];
            }
        @endphp

        @if (count($cart) > 0)

            <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

                <form action="{{ route('cart.update') }}" method="POST">
                    @csrf

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th class="px-6 py-5 font-semibold text-slate-700">Produk</th>
                                    <th class="px-6 py-5 font-semibold text-slate-700">Harga</th>
                                    <th class="px-6 py-5 font-semibold text-slate-700">Jumlah</th>
                                    <th class="px-6 py-5 font-semibold text-slate-700">Subtotal</th>
                                    <th class="px-6 py-5 text-center font-semibold text-slate-700">Aksi</th>
                                </tr>
                            </thead>

                            <tbody class="divide-y divide-slate-200">
                                @foreach ($cart as $id => $item)
                                    <tr>
                                        <td class="px-6 py-6">
                                            <div class="font-semibold text-slate-800">
                                                {{ $item['nama'] }}
                                            </div>

                                            <div class="mt-1 text-sm text-slate-500">
                                                {{ $item['merek'] }}
                                            </div>
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-6 text-slate-700">
                                            Rp {{ number_format($item['harga'], 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-6">
                                            <input
                                                type="number"
                                                name="jumlah[{{ $id }}]"
                                                value="{{ $item['jumlah'] }}"
                                                min="1"
                                                required
                                                class="w-24 rounded-lg border border-slate-300 px-3 py-3 text-slate-800 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100"
                                            >
                                        </td>

                                        <td class="whitespace-nowrap px-6 py-6 font-semibold text-slate-800">
                                            Rp {{ number_format($item['harga'] * $item['jumlah'], 0, ',', '.') }}
                                        </td>

                                        <td class="px-6 py-6 text-center">
                                            <button
                                                type="button"
                                                onclick="hapusProduk('{{ $id }}')"
                                                class="font-medium text-red-500 transition hover:text-red-700"
                                            >
                                                Hapus
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="flex flex-col gap-6 border-t border-slate-200 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">

                        <button
                            type="submit"
                            class="rounded-lg border border-slate-300 px-5 py-3 font-semibold text-slate-700 transition hover:bg-slate-50"
                        >
                            Perbarui Jumlah
                        </button>

                        <div class="text-right">
                            <p class="mb-2 text-sm text-slate-500">
                                Total Belanja
                            </p>

                            <p class="mb-5 text-3xl font-bold text-slate-800">
                                Rp {{ number_format($total, 0, ',', '.') }}
                            </p>

                            <a
                                href="{{ route('checkout.index') }}"
                                class="inline-block rounded-lg bg-blue-600 px-7 py-4 font-semibold text-white transition hover:bg-blue-700"
                            >
                                Lanjut Checkout
                            </a>
                        </div>

                    </div>
                </form>

                @foreach ($cart as $id => $item)
                    <form
                        id="hapus-produk-{{ $id }}"
                        action="{{ route('cart.remove', $id) }}"
                        method="POST"
                        class="hidden"
                    >
                        @csrf
                    </form>
                @endforeach

            </div>

        @else

            <div
                class="flex w-full flex-col items-center justify-center rounded-xl border border-slate-200 bg-white px-6 text-center shadow-sm"
                style="min-height: 400px; height: calc(100vh - 440px); padding-top: 48px; padding-bottom: 48px;"
            >
                <h2 class="text-2xl font-semibold text-slate-800">
                    Keranjang masih kosong
                </h2>

                <p class="mt-4 text-slate-500">
                    Yuk, temukan kamera favoritmu di koleksi REPLAY.
                </p>

                <a
                    href="{{ url('/') }}"
                    class="mt-8 inline-block rounded-lg bg-blue-600 px-8 py-4 font-semibold text-white transition hover:bg-blue-700"
                >
                    Lihat Koleksi Kamera
                </a>
            </div>

        @endif

    </div>

    <script>
        function hapusProduk(id) {
            if (confirm('Yakin ingin menghapus produk ini dari keranjang?')) {
                document.getElementById('hapus-produk-' + id).submit();
            }
        }
    </script>
</x-home-layout>