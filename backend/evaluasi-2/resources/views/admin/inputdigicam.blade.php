<x-admin-layout>
    <style>
        .form-page {
            max-width: 850px;
            margin: 0 auto;
            color: #333;
        }

        .form-header {
            margin-bottom: 24px;
        }

        .form-header h2 {
            margin: 0 0 6px;
            font-size: 24px;
            font-weight: 700;
        }

        .form-header p {
            margin: 0;
            color: #666;
            font-size: 14px;
        }

        .form-card {
            padding: 24px;
            background: #fff;
            border: 1px solid #ddd;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 14px;
            font-weight: 600;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 3px;
            background: #fff;
            color: #333;
            font-family: inherit;
            font-size: 14px;
            box-sizing: border-box;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #4263eb;
            outline: none;
        }

        .form-group input.is-invalid,
        .form-group textarea.is-invalid,
        .form-group select.is-invalid {
            border-color: #dc2626;
        }

        .form-error {
            color: #dc2626;
            font-size: 12px;
        }

        .form-hint {
            color: #777;
            font-size: 12px;
        }

        .current-photo {
            width: 140px;
            height: 100px;
            margin-top: 6px;
            border: 1px solid #ddd;
            object-fit: cover;
        }

        .form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 24px;
            padding-top: 18px;
            border-top: 1px solid #eee;
        }

        .form-btn {
            display: inline-block;
            padding: 10px 18px;
            border: none;
            border-radius: 3px;
            font-family: inherit;
            font-size: 14px;
            text-align: center;
            text-decoration: none;
            cursor: pointer;
        }

        .form-btn-cancel {
            background: #eee;
            color: #333;
        }

        .form-btn-save {
            background: #4263eb;
            color: #fff;
        }

        @media (max-width: 650px) {
            .form-card {
                padding: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .form-group.full {
                grid-column: auto;
            }
        }
    </style>

    <div class="form-page">

        <div class="form-header">
            <h2>{{ $title }}</h2>
            <p>Lengkapi informasi kamera digital yang akan disimpan.</p>
        </div>

        <div class="form-card">

            <form
                action="{{ isset($digicam) ? route('digicam.update', $digicam->getKey()) : route('digicam.store') }}"
                method="POST"
                enctype="multipart/form-data"
                novalidate
            >
                @csrf

                @if (isset($digicam))
                    @method('PUT')
                @endif

                <div class="form-grid">

                    <div class="form-group">
                        <label for="nama">Nama Digicam</label>
                        <input
                            type="text"
                            id="nama"
                            name="nama"
                            value="{{ old('nama', $digicam->nama ?? '') }}"
                            placeholder="Masukkan nama kamera"
                            class="{{ $errors->has('nama') ? 'is-invalid' : '' }}"
                        >
                        @error('nama')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="merek">Merek</label>
                        <input
                            type="text"
                            id="merek"
                            name="merek"
                            value="{{ old('merek', $digicam->merek ?? '') }}"
                            placeholder="Masukkan merek kamera"
                            class="{{ $errors->has('merek') ? 'is-invalid' : '' }}"
                        >
                        @error('merek')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga (Rp)</label>
                        <input
                            type="number"
                            id="harga"
                            name="harga"
                            min="0"
                            step="0.01"
                            value="{{ old('harga', $digicam->harga ?? '') }}"
                            placeholder="Contoh: 7500000"
                            class="{{ $errors->has('harga') ? 'is-invalid' : '' }}"
                        >
                        <span class="form-hint">Masukkan angka tanpa titik pemisah ribuan.</span>
                        @error('harga')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="stok">Stok (unit)</label>
                        <input
                            type="number"
                            id="stok"
                            name="stok"
                            min="0"
                            step="1"
                            value="{{ old('stok', $digicam->stok ?? '') }}"
                            placeholder="Masukkan jumlah stok"
                            class="{{ $errors->has('stok') ? 'is-invalid' : '' }}"
                        >
                        @error('stok')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="id_kategori">Kategori Kamera</label>
                        <select
                            id="id_kategori"
                            name="id_kategori"
                            class="{{ $errors->has('id_kategori') ? 'is-invalid' : '' }}"
                        >
                            <option value="">-- Pilih Kategori --</option>
                            @foreach ($kategoris as $kategori)
                                <option
                                    value="{{ $kategori->id_kategori }}"
                                    {{ old('id_kategori', $digicam->id_kategori ?? '') == $kategori->id_kategori ? 'selected' : '' }}
                                >
                                    {{ $kategori->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('id_kategori')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="deskripsi">Deskripsi Produk</label>
                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="4"
                            placeholder="Masukkan deskripsi kamera"
                            class="{{ $errors->has('deskripsi') ? 'is-invalid' : '' }}"
                        >{{ old('deskripsi', $digicam->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="foto">Foto Digicam</label>

                        @if (isset($digicam) && $digicam->foto)
                            <img
                                src="{{ asset('storage/' . $digicam->foto) }}"
                                alt="{{ $digicam->nama }}"
                                class="current-photo"
                            >
                        @endif

                        <input
                            type="file"
                            id="foto"
                            name="foto"
                            accept=".jpg,.jpeg,.png,.webp"
                            class="{{ $errors->has('foto') ? 'is-invalid' : '' }}"
                        >

                        <span class="form-hint">
                            Format JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                            @if (isset($digicam))
                                Kosongkan jika tidak ingin mengganti foto.
                            @endif
                        </span>

                        @error('foto')
                            <span class="form-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="form-footer">
                    <a href="{{ route('digicam.index') }}" class="form-btn form-btn-cancel">
                        Batal
                    </a>

                    <button type="submit" class="form-btn form-btn-save">
                        {{ isset($digicam) ? 'Simpan Perubahan' : 'Simpan Digicam' }}
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const digicamToast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        @if ($errors->any())
            digicamToast.fire({
                icon: 'error',
                title: @json($errors->first())
            });
        @endif

        @if (session('success'))
            digicamToast.fire({
                icon: 'success',
                title: @json(session('success'))
            });
        @endif

        @if (session('error'))
            digicamToast.fire({
                icon: 'error',
                title: @json(session('error'))
            });
        @endif
    </script>

</x-admin-layout>