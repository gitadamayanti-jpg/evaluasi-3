<nav x-data="{ open: false }" class="bg-[#2f5bea] border-b border-blue-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-10">
                <a href="{{ url('/') }}" class="text-white text-2xl font-bold tracking-widest">
                    REPLAY
                </a>

                <div class="hidden sm:flex items-center space-x-6">
                    <a href="{{ url('/') }}"
                       class="text-white px-3 py-2 rounded-md hover:bg-blue-700 transition">
                        Dashboard
                    </a>

                    <a href="{{ route('cart.index') }}"
                       class="text-white px-3 py-2 rounded-md hover:bg-blue-700 transition">
                        Keranjang
                    </a>

                    <a href="{{ route('checkout.index') }}"
                       class="text-white px-3 py-2 rounded-md hover:bg-blue-700 transition">
                        Checkout
                    </a>

                    <a href="{{ route('digicam.index') }}"
                       class="bg-white text-[#2f5bea] px-4 py-2 rounded-md font-semibold hover:bg-blue-50 transition">
                        Admin
                    </a>
                </div>
            </div>

            @auth
                <div class="hidden sm:flex items-center">
                    <span class="text-white font-medium">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            @endauth

            <div class="flex items-center sm:hidden">
                <button @click="open = !open"
                        class="p-2 rounded-md text-white hover:bg-blue-700 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }"
                              class="inline-flex"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }"
                              class="hidden"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div x-show="open" x-transition class="sm:hidden border-t border-blue-700">
        <div class="px-4 pt-3 pb-4 space-y-2">
            <a href="{{ url('/') }}"
               class="block text-white px-3 py-2 rounded-md hover:bg-blue-700">
                Dashboard
            </a>

            <a href="{{ route('cart.index') }}"
               class="block text-white px-3 py-2 rounded-md hover:bg-blue-700">
                Keranjang
            </a>

            <a href="{{ route('checkout.index') }}"
               class="block text-white px-3 py-2 rounded-md hover:bg-blue-700">
                Checkout
            </a>

            <a href="{{ route('digicam.index') }}"
               class="block bg-white text-[#2f5bea] px-3 py-2 rounded-md font-semibold">
                Admin
            </a>

            @auth
                <div class="text-white px-3 py-2 border-t border-blue-700">
                    {{ Auth::user()->name }}
                </div>
            @endauth
        </div>
    </div>
</nav>