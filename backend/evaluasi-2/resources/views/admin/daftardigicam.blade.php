<x-admin-layout>
    <style>
        .admin-products {
            width: 100%;
            color: #172b4d;
            font-family: Arial, sans-serif;
            font-size: 16px;
            box-sizing: border-box;
        }

        .admin-products *,
        .admin-products *::before,
        .admin-products *::after {
            box-sizing: border-box;
        }

        .admin-products h2 {
            font-size: 32px;
            font-weight: 700;
            margin: 0 0 28px;
            color: #172b4d;
        }

        .product-panel {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0, 0, 0, .06);
            width: 100%;
        }

        .admin-alert {
            padding: 16px 20px;
            margin-bottom: 20px;
            border-radius: 8px;
            background: #dcfce7;
            color: #166534;
            font-size: 16px;
            line-height: 1.6;
        }

        .admin-error {
            background: #fee2e2;
            color: #991b1b;
        }

        .admin-alert ul {
            margin: 8px 0 0 22px;
        }

        .product-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 26px;
        }

        .product-filter {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .product-filter input,
        .product-filter select {
            height: 48px;
            padding: 0 15px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #334155;
            font-family: inherit;
            font-size: 16px;
            outline: none;
        }

        .product-filter select {
            min-width: 190px;
        }

        .product-filter input {
            width: 260px;
        }

        .product-filter input:focus,
        .product-filter select:focus {
            border-color: #4361ee;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, .12);
        }

        .admin-products .btn-admin {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            padding: 13px 19px;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            cursor: pointer;
            font-family: inherit;
            font-size: 16px;
            font-weight: 600;
            line-height: 1.2;
            white-space: nowrap;
            transition: background .2s ease, color .2s ease;
        }

        .admin-products .btn-search {
            height: 48px;
            background: #4361ee;
            color: #fff;
        }

        .admin-products .btn-search:hover,
        .admin-products .btn-edit:hover {
            background: #3049ca;
        }

        .admin-products .btn-add {
            min-height: 48px;
            background: #16a34a;
            color: #fff;
        }

        .admin-products .btn-add:hover {
            background: #15803d;
        }

        .admin-products .btn-edit {
            min-width: 90px;
            min-height: 46px;
            background: #4361ee;
            color: #fff;
        }

        .admin-products .btn-delete {
            min-width: 90px;
            min-height: 46px;
            background: #fff;
            color: #dc2626;
            border: 1px solid #fca5a5;
        }

        .admin-products .btn-delete:hover {
            background: #fee2e2;
        }

        .admin-products .btn-reset {
            height: 48px;
            background: #e5e7eb;
            color: #374151;
        }

        .admin-products .btn-reset:hover {
            background: #d1d5db;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        .product-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            font-size: 16px;
        }

        .product-table thead th {
            background: #f1f5f9;
            color: #334155;
            font-size: 16px;
            font-weight: 700;
            padding: 17px 14px;
            border: 1px solid #cbd5e1;
            text-align: left;
        }

        .product-table tbody td {
            padding: 19px 14px;
            border: 1px solid #cbd5e1;
            text-align: left;
            vertical-align: middle;
            overflow-wrap: break-word;
        }

        .product-table tbody tr {
            height: 100px;
        }

        .product-table tbody tr:hover {
            background: #f8fafc;
        }

        .product-table .col-number {
            width: 5%;
        }

        .product-table .col-image {
            width: 10%;
        }

        .product-table .col-name {
            width: 29%;
        }

        .product-table .col-price {
            width: 20%;
        }

        .product-table .col-stock {
            width: 10%;
        }

        .product-table .col-actions {
            width: 26%;
        }

        .product-image {
            width: 75px;
            height: 75px;
            object-fit: contain;
            border-radius: 8px;
            background: #f8fafc;
            display: block;
        }

        .no-image {
            width: 75px;
            height: 75px;
            background: #f1f5f9;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 13px;
            text-align: center;
        }

        .product-name {
            font-size: 17px;
            font-weight: 700;
            color: #172b4d;
            margin-bottom: 6px;
            line-height: 1.5;
        }

        .product-brand {
            font-size: 15px;
            color: #64748b;
        }

        .product-price {
            font-size: 16px;
            font-weight: 500;
            white-space: nowrap;
        }

        .product-stock {
            font-size: 16px;
            text-align: center !important;
        }

        .product-table th.col-actions {
            text-align: center;
        }

        .product-table td.actions-cell {
            text-align: center;
        }

        .product-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            white-space: nowrap;
        }

        .product-actions form {
            margin: 0;
            padding: 0;
        }

        .product-actions .btn-admin {
            min-width: 90px;
            min-height: 46px;
            padding: 12px 15px;
            font-size: 16px;
            border-radius: 8px;
        }

        .admin-empty {
            text-align: center !important;
            padding: 40px 15px !important;
            color: #64748b;
            font-size: 16px;
        }

        .empty-title {
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #334155;
        }

        .product-pagination {
            margin-top: 26px;
            font-size: 15px;
        }

        @media (max-width: 1100px) {
            .product-panel {
                padding: 22px;
            }

            .product-table {
                min-width: 900px;
            }
        }

        @media (max-width: 650px) {
            .admin-products h2 {
                font-size: 26px;
            }

            .product-panel {
                padding: 15px;
            }

            .product-toolbar {
                align-items: stretch;
                flex-direction: column;
            }

            .product-filter {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                width: 100%;
            }

            .product-filter select,
            .product-filter input,
            .product-filter .btn-admin {
                width: 100%;
            }

            .admin-products .btn-add {
                width: 100%;
            }
        }
    </style>

    <div class="admin-products">
        <h2>Manajemen Produk</h2>

        @if (session('success'))
            <div class="admin-alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="admin-alert admin-error">
                <strong>Terjadi kesalahan:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="product-panel">
            <div class="product-toolbar">
                <form action="{{ route('digicam.index') }}"
                      method="GET"
                      class="product-filter">

                    <select name="id_kategori">
                        <option value="">Semua Kategori</option>

                        @foreach ($kategoris as $kategori)
                            <option
                                value="{{ $kategori->id_kategori }}"
                                {{ request('id_kategori') == $kategori->id_kategori ? 'selected' : '' }}>
                                {{ $kategori->nama_kategori }}
                            </option>
                        @endforeach
                    </select>

                    <input
                        type="text"
                        name="cari"
                        value="{{ request('cari') }}"
                        placeholder="Cari produk...">

                    <button type="submit" class="btn-admin btn-search">
                        Cari
                    </button>

                    @if (request()->filled('cari') || request()->filled('id_kategori'))
                        <a href="{{ route('digicam.index') }}"
                           class="btn-admin btn-reset">
                            Reset
                        </a>
                    @endif
                </form>

                <a href="{{ route('digicam.create') }}"
                   class="btn-admin btn-add">
                    + Tambah Produk
                </a>
            </div>

            <div class="table-wrapper">
                <table class="product-table">
                    <thead>
                        <tr>
                            <th class="col-number">No</th>
                            <th class="col-image">Image</th>
                            <th class="col-name">Nama</th>
                            <th class="col-price">Harga</th>
                            <th class="col-stock">Stok</th>
                            <th class="col-actions">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($digicam as $item)
                            <tr>
                                <td>
                                    {{ $digicam->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    @if ($item->foto)
                                        <img
                                            src="{{ asset('storage/' . $item->foto) }}"
                                            alt="{{ $item->nama }}"
                                            class="product-image"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                        <div class="no-image" style="display:none;">
                                            No Image
                                        </div>
                                    @else
                                        <div class="no-image">
                                            No Image
                                        </div>
                                    @endif
                                </td>

                                <td>
                                    <div class="product-name">
                                        {{ $item->nama }}
                                    </div>
                                    <div class="product-brand">
                                        {{ $item->merek }}
                                    </div>
                                </td>

                                <td class="product-price">
                                    Rp {{ number_format($item->harga, 0, ',', '.') }}
                                </td>

                                <td class="product-stock">
                                    {{ $item->stok }}
                                </td>

                                <td class="actions-cell">
                                    <div class="product-actions">
                                        <a
                                            href="{{ route('digicam.edit', $item->getKey()) }}"
                                            class="btn-admin btn-edit">
                                            Edit
                                        </a>

                                        <form
                                            action="{{ route('digicam.destroy', $item->getKey()) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn-admin btn-delete">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="admin-empty">
                                    <div class="empty-title">
                                        Produk tidak ditemukan
                                    </div>
                                    <div>
                                        Coba ubah kata pencarian atau pilih kategori lain.
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="product-pagination">
                {{ $digicam->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-admin-layout>