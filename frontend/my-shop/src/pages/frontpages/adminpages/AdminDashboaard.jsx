import React, { useState } from 'react';
import { Link } from 'react-router-dom';
import { useProducts } from '../../../context/ProductContext';

export default function AdminDashboard() {
    const {
        products,
        isLoading,
        isError,
        deleteProduct
    } = useProducts();

    const [searchTerm, setSearchTerm] = useState('');
    const [selectedCategory, setSelectedCategory] = useState('');

    const kategoris = [
        ...new Set(
            products
                .map((menu) => menu.kategori?.nama_kategori)
                .filter(Boolean)
        )
    ];

    const filteredMenus = products.filter((menu) => {
        const cocokNama = menu.nama
            .toLowerCase()
            .includes(searchTerm.toLowerCase());

        const cocokKategori = selectedCategory
            ? menu.kategori?.nama_kategori === selectedCategory
            : true;

        return cocokNama && cocokKategori;
    });

    const handleDelete = async (id) => {
        if (window.confirm('Apakah kamu yakin ingin menghapus menu ini?')) {
            await deleteProduct.mutateAsync(id);
        }
    };

    const getImageUrl = (gambar) => {
        if (!gambar) return null;

        if (gambar.startsWith('http')) {
            return gambar;
        }

        if (gambar.startsWith('/imeges/')) {
            return gambar;
        }

        return `http://127.0.0.1:8000/storage/${gambar.replace(/^\/+/, '')}`;
    };

    return (
        <div className="p-8 font-sans">
            <h1 className="text-2xl font-bold text-[#1b4332] mb-6">
                Manajemen Menu
            </h1>

            <div className="bg-white p-5 rounded-xl border border-gray-200 shadow-sm mb-5">
                <div className="flex flex-col md:flex-row gap-3 items-center">
                    <select
                        value={selectedCategory}
                        onChange={(e) => setSelectedCategory(e.target.value)}
                        className="w-full md:w-48 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                    >
                        <option value="">Semua Kategori</option>

                        {kategoris.map((kategori) => (
                            <option key={kategori} value={kategori}>
                                {kategori}
                            </option>
                        ))}
                    </select>

                    <input
                        type="text"
                        placeholder="Cari menu..."
                        value={searchTerm}
                        onChange={(e) => setSearchTerm(e.target.value)}
                        className="w-full md:w-64 border border-gray-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                    />

                    <button
                        onClick={() => {
                            setSearchTerm('');
                            setSelectedCategory('');
                        }}
                        className="w-full md:w-auto bg-[#2d6a4f] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#1b4332]"
                    >
                        Reset
                    </button>

                    <Link
                        to="/admin/add-menu"
                        className="w-full md:w-auto md:ml-auto text-center bg-[#2d6a4f] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#1b4332]"
                    >
                        + Tambah Menu
                    </Link>
                </div>
            </div>

            <div className="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                {isLoading ? (
                    <p className="text-center py-8 text-gray-500">
                        Memuat data menu...
                    </p>
                ) : isError ? (
                    <p className="text-center py-8 text-red-500">
                        Gagal mengambil data menu dari server.
                    </p>
                ) : (
                    <div className="overflow-x-auto">
                        <table className="w-full text-left text-sm">
                            <thead className="bg-[#e8f5e9] text-[#1b4332]">
                                <tr>
                                    <th className="px-4 py-3 border-b">No</th>
                                    <th className="px-4 py-3 border-b">Gambar</th>
                                    <th className="px-4 py-3 border-b">Nama Menu</th>
                                    <th className="px-4 py-3 border-b">Kategori</th>
                                    <th className="px-4 py-3 border-b">Harga</th>
                                    <th className="px-4 py-3 border-b text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody className="divide-y divide-gray-100 text-gray-700">
                                {filteredMenus.length === 0 ? (
                                    <tr>
                                        <td
                                            colSpan="6"
                                            className="text-center py-8 text-gray-400"
                                        >
                                            Menu tidak ditemukan.
                                        </td>
                                    </tr>
                                ) : (
                                    filteredMenus.map((menu, index) => (
                                        <tr
                                            key={menu.id}
                                            className="hover:bg-[#f6fbf6]"
                                        >
                                            <td className="px-4 py-3">
                                                {index + 1}
                                            </td>

                                            <td className="px-4 py-3">
                                                {menu.gambar ? (
                                                    <img
                                                        src={getImageUrl(menu.gambar)}
                                                        alt={menu.nama}
                                                        className="w-14 h-14 object-cover rounded-lg"
                                                    />
                                                ) : (
                                                    <div className="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center text-xs text-gray-400">
                                                        No Image
                                                    </div>
                                                )}
                                            </td>

                                            <td className="px-4 py-3 font-semibold text-[#1b4332]">
                                                {menu.nama}
                                            </td>

                                            <td className="px-4 py-3">
                                                {menu.kategori?.nama_kategori || '-'}
                                            </td>

                                            <td className="px-4 py-3 whitespace-nowrap">
                                                Rp {Number(menu.harga).toLocaleString('id-ID')}
                                            </td>

                                            <td className="px-4 py-3">
                                                <div className="flex justify-center gap-3">
                                                    <Link
                                                        to={`/admin/edit-menu/${menu.id}`}
                                                        className="text-blue-600 hover:text-blue-800 font-semibold"
                                                    >
                                                        Edit
                                                    </Link>

                                                    <button
                                                        onClick={() => handleDelete(menu.id)}
                                                        className="text-red-600 hover:text-red-800 font-semibold"
                                                    >
                                                        Hapus
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    ))
                                )}
                            </tbody>
                        </table>
                    </div>
                )}
            </div>
        </div>
    );
}