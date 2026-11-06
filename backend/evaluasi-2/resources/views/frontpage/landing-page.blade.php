<x-home-layout>

    <style>
        .replay-container {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 24px 32px 40px;
        }

        .replay-heading {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .replay-heading h1 {
            margin: 0;
            color: #172554;
            font-size: 32px;
            font-weight: 800;
        }

        .replay-heading p {
            margin-top: 8px;
            color: #64748b;
            font-size: 15px;
        }

        .replay-filter {
            display: flex;
            align-items: end;
            justify-content: space-between;
            gap: 18px;
            margin-bottom: 28px;
            padding: 20px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
        }

        .replay-search {
            display: flex;
            flex: 1;
            gap: 10px;
        }

        .replay-search input,
        .replay-category select {
            width: 100%;
            min-height: 44px;
            padding: 10px 13px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            background: #fff;
            color: #334155;
            font-size: 14px;
        }

        .replay-search input:focus,
        .replay-category select:focus {
            border-color: #2563eb;
            outline: none;
        }

        .replay-search button {
            min-height: 44px;
            padding: 0 23px;
            border: none;
            border-radius: 7px;
            background: #2563eb;
            color: #fff;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .replay-search button:hover {
            background: #1d4ed8;
        }

        .replay-category {
            width: 250px;
        }

        .replay-category label {
            display: block;
            margin-bottom: 8px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .replay-product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 28px;
            width: 100%;
        }
        .replay-product-card {
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .replay-product-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, 0.10);
        }

        .replay-product-image {
            display: flex;
            height: 245px;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 20px;
            border-bottom: 1px solid #f1f5f9;
            background: #fff;
        }

        .replay-product-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .replay-no-image {
            color: #94a3b8;
            font-size: 14px;
        }

        .replay-product-info {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 20px;
        }

        .replay-product-category {
            display: inline-block;
            align-self: flex-start;
            margin-bottom: 10px;
            padding: 5px 10px;
            border-radius: 20px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .replay-product-name {
            margin-bottom: 5px;
            color: #172554;
            font-size: 19px;
            font-weight: 800;
            line-height: 1.5;
        }

        .replay-product-brand {
            margin-bottom: 13px;
            color: #64748b;
            font-size: 14px;
        }

        .replay-product-price {
            margin-bottom: 9px;
            color: #2563eb;
            font-size: 21px;
            font-weight: 800;
        }

        .replay-product-stock {
            margin-bottom: 14px;
            color: #64748b;
            font-size: 13px;
        }

        .replay-product-description {
            display: -webkit-box;
            overflow: hidden;
            margin-bottom: 20px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.8;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .replay-product-actions {
            display: flex;
            flex-direction: column;
            gap: 9px;
            margin-top: auto;
        }

        .replay-detail-button,
        .replay-cart-button {
            display: block;
            width: 100%;
            padding: 12px 15px;
            border: none;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 700;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .replay-detail-button {
            background: #2563eb;
            color: #fff;
        }

        .replay-detail-button:hover {
            background: #1d4ed8;
        }

        .replay-cart-button {
            background: #eff6ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
        }

        .replay-cart-button:hover {
            background: #dbeafe;
        }

        .replay-cart-button:disabled {
            background: #e2e8f0;
            color: #94a3b8;
            border-color: #e2e8f0;
            cursor: not-allowed;
        }

        .replay-alert {
            margin-bottom: 20px;
            padding: 13px 16px;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            background: #f0fdf4;
            color: #166534;
            font-size: 14px;
        }

        .replay-empty {
            grid-column: 1 / -1;
            padding: 55px 20px;
            border: 1px dashed #cbd5e1;
            border-radius: 12px;
            background: #fff;
            text-align: center;
        }

        .replay-empty h3 {
            margin-bottom: 8px;
            color: #334155;
            font-size: 20px;
            font-weight: 700;
        }

        .replay-empty p {
            color: #64748b;
            font-size: 14px;
        }

        .replay-reset {
            display: inline-block;
            margin-top: 15px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
        }

            @media (max-width: 1100px) {
            .replay-container {
                padding: 24px;
            }

            .replay-product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 22px;
            }
        }

        @media (max-width: 650px) {
            .replay-container {
                padding: 18px 14px 30px;
            }

            .replay-product-grid {
                grid-template-columns: 1fr;
                gap: 18px;
            }
        }
    </style>

    <div class="replay-container">

        <section class="replay-heading">
            <div>
                <h1>Koleksi Kamera REPLAY</h1>
                <p>Temukan kamera digital pilihan untuk mengabadikan setiap momen.</p>
            </div>
        </section>

        @if (session('success'))
            <div class="replay-alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="replay-alert" style="background:#fef2f2;color:#991b1b;border-color:#fecaca;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ url('/') }}" method="GET" class="replay-filter">

            <div class="replay-search">
                <input
                    type="text"
                    name="cari"
                    value="{{ request('cari') }}"
                    placeholder="Cari nama atau merek kamera..."
                >

                <button type="submit">Cari</button>
            </div>

            <div class="replay-category">
    

                <select
                    name="id_kategori"
                    id="id_kategori"
                    onchange="this.form.submit()"
                >
                    <option value="">Semua Kategori</option>

                    @foreach ($kategoris as $kategori)
                        <option
                            value="{{ $kategori->id_kategori }}"
                            {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}
                        >
                            {{ $kategori->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

        </form>

        <section>
            <div class="replay-product-grid">

                @forelse ($digicam as $item)
                    <article class="replay-product-card">

                        <div class="replay-product-image">
                            @if ($item->foto)
                                <img
                                    src="{{ asset('storage/' . $item->foto) }}"
                                    alt="{{ $item->nama }}"
                                    loading="lazy"
                                >
                            @else
                                <span class="replay-no-image">
                                    Foto belum tersedia
                                </span>
                            @endif
                        </div>

                        <div class="replay-product-info">

                            <span class="replay-product-category">
                                {{ $item->kategoriDigicam->nama_kategori ?? 'Belum ada kategori' }}
                            </span>

                            <h3 class="replay-product-name">
                                {{ $item->nama }}
                            </h3>

                            <p class="replay-product-brand">
                                {{ $item->merek }}
                            </p>

                            <p class="replay-product-price">
                                Rp {{ number_format($item->harga, 0, ',', '.') }}
                            </p>

                            <p class="replay-product-stock">
                                Stok tersedia: {{ $item->stok }}
                            </p>

                            <p class="replay-product-description">
                                {{ $item->deskripsi ?: 'Informasi kamera belum tersedia.' }}
                            </p>

                            <div class="replay-product-actions">
                                <a
                                    href="{{ route('digicam.show', $item->id) }}"
                                    class="replay-detail-button"
                                >
                                    Lihat Detail
                                </a>

                                @if ($item->stok > 0)
                                    <form
                                        action="{{ route('cart.add', $item->id) }}"
                                        method="POST"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="replay-cart-button"
                                        >
                                            Tambah ke Keranjang
                                        </button>
                                    </form>
                                @else
                                    <button
                                        type="button"
                                        class="replay-cart-button"
                                        disabled
                                    >
                                        Stok Habis
                                    </button>
                                @endif
                            </div>

                        </div>
                    </article>
                @empty
                    <div class="replay-empty">
                        <h3>Produk tidak ditemukan</h3>

                        <p>
                            Belum ada kamera yang sesuai dengan pencarian atau kategori pilihanmu.
                        </p>

                        <a href="{{ url('/') }}" class="replay-reset">
                            Tampilkan Semua Produk
                        </a>
                    </div>
                @endforelse

            </div>
        </section>

        @if (method_exists($digicam, 'links'))
            <div style="margin-top: 28px;">
                {{ $digicam->links() }}
            </div>
        @endif

    </div>

</x-home-layout>