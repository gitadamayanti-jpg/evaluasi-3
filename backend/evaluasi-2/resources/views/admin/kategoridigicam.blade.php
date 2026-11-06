```blade
<x-admin-layout>
    <style>
        .kategori-page {
            padding: 25px;
            color: #172b4d;
        }

        .kategori-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            flex-wrap: wrap;
            margin-bottom: 25px;
        }

        .kategori-header h2 {
            font-size: 26px;
            font-weight: 700;
            margin: 0;
        }

        .kategori-subtitle {
            color: #64748b;
            font-size: 14px;
            margin-top: 6px;
        }

        .kategori-card {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(15, 23, 42, .04);
        }

        .kategori-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            padding: 20px 22px;
        }

        .kategori-toolbar p {
            color: #64748b;
            font-size: 14px;
            margin: 0;
        }

        .kategori-btn {
            display: inline-block;
            padding: 9px 14px;
            border-radius: 7px;
            border: none;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            white-space: nowrap;
        }

        .kategori-add {
            background: #4263eb;
            color: white;
        }

        .kategori-add:hover {
            background: #3451d1;
        }

        .kategori-edit {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .kategori-delete {
            background: #fef2f2;
            color: #dc2626;
        }

        .kategori-table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .kategori-table {
            width: 100%;
            border-collapse: collapse;
        }

        .kategori-table th {
            text-align: left;
            padding: 15px 22px;
            background: #f8fafc;
            color: #64748b;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .kategori-table td {
            padding: 17px 22px;
            border-top: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .kategori-table tbody tr:hover {
            background: #f8fafc;
        }

        .kategori-number {
            color: #64748b;
            width: 70px;
        }

        .kategori-name {
            color: #172b4d;
            font-weight: 600;
        }

        .kategori-actions {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .kategori-actions form {
            margin: 0;
        }

        .kategori-message {
            padding: 12px 16px;
            border-radius: 8px;
            margin: 20px 22px 0;
            background: #dcfce7;
            color: #166534;
            font-size: 14px;
        }

        .kategori-empty {
            text-align: center;
            color: #64748b;
            padding: 35px !important;
        }

        @media (max-width: 600px) {
            .kategori-page {
                padding: 15px;
            }

            .kategori-table {
                min-width: 550px;
            }
        }
    </style>

    <div class="kategori-page">
        <div class="kategori-header">
            <div>
                <h2>{{ $title }}</h2>
                <div class="kategori-subtitle">
                    Kelola kategori kamera digital di REPLAY.
                </div>
            </div>

            <a href="{{ route('kategori-digicam.create') }}"
               class="kategori-btn kategori-add">
                + Tambah Kategori
            </a>
        </div>

        <div class="kategori-card">
            @if (session('success'))
                <div class="kategori-message">
                    {{ session('success') }}
                </div>
            @endif

            <div class="kategori-toolbar">
                <p>
                    Total kategori:
                    <strong>{{ $kategoris->count() }}</strong>
                </p>
            </div>

            <div class="kategori-table-wrapper">
                <table class="kategori-table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($kategoris as $kategori)
                            <tr>
                                <td class="kategori-number">
                                    {{ $loop->iteration }}
                                </td>

                                <td class="kategori-name">
                                    {{ $kategori->nama_kategori }}
                                </td>

                                <td>
                                    <div class="kategori-actions">
                                        <a href="{{ route('kategori-digicam.edit', $kategori->id_kategori) }}"
                                           class="kategori-btn kategori-edit">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('kategori-digicam.destroy', $kategori->id_kategori) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="kategori-btn kategori-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="kategori-empty">
                                    Belum ada kategori kamera.
                                    <br>
                                    Klik tombol Tambah Kategori untuk memulai.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
```