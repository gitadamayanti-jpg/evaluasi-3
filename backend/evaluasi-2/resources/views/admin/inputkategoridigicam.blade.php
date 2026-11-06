
<x-admin-layout>
    <style>
        .kategori-page {
            max-width: 700px;
            margin: 0 auto;
        }

        .kategori-page h2 {
            font-size: 26px;
            font-weight: 700;
            color: #172b4d;
            margin: 0 0 8px;
        }

        .kategori-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 24px;
        }

        .kategori-card {
            background: white;
            padding: 28px;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(15, 23, 42, 0.04);
        }

        .kategori-label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 9px;
        }

        .kategori-input {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            font-size: 14px;
            box-sizing: border-box;
        }

        .kategori-input:focus {
            outline: none;
            border-color: #4263eb;
            box-shadow: 0 0 0 3px rgba(66, 99, 235, 0.12);
        }

        .kategori-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .kategori-btn {
            display: inline-block;
            padding: 11px 18px;
            border: none;
            border-radius: 7px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }

        .kategori-cancel {
            color: #475569;
            background: #f1f5f9;
        }

        .kategori-save {
            color: white;
            background: #4263eb;
        }

        .kategori-error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 12px;
        }
    </style>

    <div class="kategori-page">
        <h2>{{ $title }}</h2>
        <p class="kategori-subtitle">
            Masukkan nama kategori kamera untuk toko REPLAY.
        </p>

        <div class="kategori-card">
            <form
                action="{{ isset($kategori) ? route('kategori-digicam.update', $kategori->id_kategori) : route('kategori-digicam.store') }}"
                method="POST"
            >
                @csrf

                @if (isset($kategori))
                    @method('PUT')
                @endif

                <label for="nama_kategori" class="kategori-label">
                    Nama Kategori
                </label>

                <input
                    type="text"
                    id="nama_kategori"
                    name="nama_kategori"
                    class="kategori-input"
                    value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}"
                    placeholder="Contoh: Digital Compact"
                    required
                >

                @error('nama_kategori')
                    <p class="kategori-error">{{ $message }}</p>
                @enderror

                <div class="kategori-actions">
                    <a
                        href="{{ route('kategori-digicam.index') }}"
                        class="kategori-btn kategori-cancel"
                    >
                        Batal
                    </a>

                    <button type="submit" class="kategori-btn kategori-save">
                        {{ isset($kategori) ? 'Simpan Perubahan' : 'Simpan Kategori' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>
