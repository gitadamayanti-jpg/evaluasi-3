<x-home-layout>

    <style>
        .detail-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 24px 0 40px;
            font-family: inherit;
            color: #1e293b;
        }

        .detail-back {
            display: inline-block;
            margin-bottom: 22px;
            color: #2563eb;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
        }

        .detail-back:hover {
            text-decoration: underline;
        }

        .detail-heading {
            margin-bottom: 22px;
        }

        .detail-heading h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 700;
            color: #172554;
        }

        .detail-heading p {
            margin-top: 7px;
            color: #64748b;
            font-size: 14px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: minmax(0, 1fr);
            align-items: start;
            gap: 22px;
        }

        .detail-card {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            padding: 20px;
        }

        .detail-image {
            display: flex;
            width: 100%;
            height: 350px;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-bottom: 16px;
            border-radius: 5px;
            background: #f8fafc;
        }

        .detail-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .detail-no-image {
            color: #94a3b8;
            font-size: 14px;
        }

        .detail-name {
            margin-bottom: 5px;
            color: #172554;
            font-size: 25px;
            font-weight: 700;
            line-height: 1.4;
        }

        .detail-brand {
            margin-bottom: 18px;
            color: #64748b;
            font-size: 15px;
        }

        .detail-price {
            margin-bottom: 20px;
            color: #2563eb;
            font-size: 25px;
            font-weight: 700;
        }

        .detail-information {
            border-top: 1px solid #e2e8f0;
            padding-top: 16px;
        }

        .detail-information h2 {
            margin-bottom: 12px;
            font-size: 17px;
            font-weight: 700;
        }

        .detail-row {
            display: flex;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .detail-label {
            width: 120px;
            flex-shrink: 0;
            color: #64748b;
        }

        .detail-value {
            color: #334155;
            overflow-wrap: anywhere;
        }

        .detail-description {
            margin-top: 15px;
            color: #475569;
            font-size: 14px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }

        .detail-description p {
            margin-top: 6px;
        }

        @media (max-width: 760px) {
            .detail-container {
                padding: 16px 0 32px;
            }

            .detail-image {
                height: 280px;
            }

            .detail-heading h1 {
                font-size: 24px;
            }

            .detail-card {
                padding: 16px;
            }

            .detail-row {
                flex-wrap: wrap;
            }
        }
    </style>

    <div class="detail-container">

        <a href="{{ url('/') }}" class="detail-back">
            ← Kembali ke Dashboard
        </a>

        <div class="detail-grid">

            <section class="detail-card">

                <div class="detail-image">
                    @if ($digicam->foto)
                        <img
                            src="{{ asset('storage/' . $digicam->foto) }}"
                            alt="{{ $digicam->nama }}"
                        >
                    @else
                        <span class="detail-no-image">
                            Foto kamera belum tersedia
                        </span>
                    @endif
                </div>

                <h2 class="detail-name">{{ $digicam->nama }}</h2>

                <p class="detail-brand">{{ $digicam->merek }}</p>

                <p class="detail-price">
                    Rp {{ number_format($digicam->harga, 0, ',', '.') }}
                </p>

                <div class="detail-information">

                    <h2>Informasi Produk</h2>

                    <div class="detail-row">
                        <span class="detail-label">Kategori</span>
                        <span class="detail-value">
                            {{ $digicam->kategoriDigicam->nama_kategori ?? 'Belum ada kategori' }}
                        </span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Merek</span>
                        <span class="detail-value">{{ $digicam->merek }}</span>
                    </div>

                    <div class="detail-row">
                        <span class="detail-label">Stok tersedia</span>
                        <span class="detail-value">{{ $digicam->stok }} unit</span>
                    </div>

                    <div class="detail-description">
                        <strong>Deskripsi Produk</strong>
                        <p>
                            {{ $digicam->deskripsi ?: 'Deskripsi kamera belum tersedia.' }}
                        </p>
                    </div>

                </div>

            </section>

        </div>

    </div>

</x-home-layout>