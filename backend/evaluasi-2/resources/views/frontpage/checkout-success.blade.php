<x-home-layout>
    <div class="flex w-full items-center justify-center" style="min-height: 65vh; padding: 40px 20px;">
        <div class="w-full max-w-xl rounded-xl border border-slate-100 bg-white px-8 py-10 text-center shadow-md sm:px-12">

            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-green-100">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-9 w-9 text-green-600"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h1 class="mt-6 text-2xl font-bold text-slate-800 sm:text-3xl">
                Checkout Berhasil!
            </h1>

            <p class="mt-4 text-slate-600">
                Terima kasih, {{ $checkout['nama'] }}.
            </p>

            <p class="mt-2 text-slate-500">
                Pesanan kamera REPLAY kamu berhasil diproses.
            </p>

            <a href="{{ url('/') }}"
                class="mt-7 inline-flex items-center justify-center rounded-lg bg-blue-600 px-6 py-3 font-semibold text-white transition duration-200 hover:bg-blue-700">
                Kembali ke Homepage
            </a>

        </div>
    </div>
</x-home-layout>