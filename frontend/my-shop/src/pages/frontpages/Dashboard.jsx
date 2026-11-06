import React from 'react';
import { Link, useOutletContext } from 'react-router-dom';
import { useProducts } from '../../context/ProductContext';

export default function Dashboard(props) {
    const context = useOutletContext() || {};

    const cartItems = props.cartItems || context.cartItems || {};
    const setCartItems = props.setCartItems || context.setCartItems || (() => {});
    const searchTerm = context.searchTerm || '';
    const selectedCategory = context.selectedCategory || 'Semua Kategori';

    const {
        products,
        isLoading,
        isError,
        error
    } = useProducts();

    const handleAddToCart = (id, quantity = 1) => {
        if (context.handleAddToCart) {
            context.handleAddToCart(id, quantity);
            return;
        }

        setCartItems((prev) => ({
            ...prev,
            [id]: (prev[id] || 0) + quantity
        }));
    };

    const handleUpdateQty = (id, delta) => {
        if (context.handleUpdateQty) {
            context.handleUpdateQty(id, delta);
            return;
        }

        setCartItems((prev) => {
            const currentQty = prev[id] || 0;
            const newQty = currentQty + delta;

            if (newQty <= 0) {
                const updated = { ...prev };
                delete updated[id];
                return updated;
            }

            return { ...prev, [id]: newQty };
        });
    };

    // Mengatur alamat gambar dari frontend dan backend
    const getImageUrl = (gambar) => {
        if (!gambar) return null;

        if (gambar.startsWith('http')) {
            return gambar;
        }

        if (gambar.startsWith('/imeges/')) {
            return gambar;
        }

        if (gambar.startsWith('/')) {
            return `http://127.0.0.1:8000${gambar}`;
        }

        return `http://127.0.0.1:8000/storage/${gambar.replace(/^\/+/, '')}`;
    };

    const filteredMenu = products.filter((item) => {
        const namaKategori = item.kategori?.nama_kategori || '';

        const cocokNama = (item.nama || '')
            .toLowerCase()
            .includes(searchTerm.toLowerCase());

        const cocokKategori =
            selectedCategory === 'Semua Kategori' ||
            namaKategori === selectedCategory ||
            (selectedCategory === 'Lauk' && namaKategori === 'Lauk & Sayuran');

        return cocokNama && cocokKategori;
    });

    if (isLoading) {
        return (
            <div className="text-center py-20 text-[#2d6a4f]">
                <p className="text-xl font-semibold">
                    Memuat menu Salero Minang...
                </p>
            </div>
        );
    }

    if (isError) {
        return (
            <div className="text-center py-20 text-red-600">
                <p className="text-xl font-semibold">
                    Gagal mengambil data menu.
                </p>
                <p>{error?.message}</p>
            </div>
        );
    }

    return (
        <div className="space-y-8">
            <div className="text-center bg-[#e8f5e9] py-10 rounded-xl">
                <h1 className="text-3xl md:text-4xl font-bold text-[#2d6a4f]">
                    Menu Salero Minang
                </h1>
                <p className="text-gray-600 mt-3">
                    Nikmati aneka hidangan khas Minang dengan cita rasa istimewa.
                </p>
            </div>

            <div>
                <h2 className="text-2xl font-bold text-[#2d6a4f] mb-6">
                    Daftar Menu
                </h2>

                {filteredMenu.length === 0 ? (
                    <div className="text-center py-16 bg-white rounded-xl border">
                        <p className="text-gray-500 text-lg">
                            Menu tidak ditemukan.
                        </p>
                    </div>
                ) : (
                    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        {filteredMenu.map((item) => (
                            <div
                                key={item.id}
                                className="bg-white rounded-xl shadow-md overflow-hidden border border-[#74c69d] hover:shadow-lg transition"
                            >
                                <Link to={`/product/${item.id}`}>
                                    <img
                                        src={getImageUrl(item.gambar)}
                                        alt={item.nama}
                                        className="w-full h-52 object-cover"
                                        onError={(e) => {
                                            e.currentTarget.style.display = 'none';
                                        }}
                                    />
                                </Link>

                                <div className="p-5">
                                    <h3 className="text-lg font-bold text-[#2d6a4f]">
                                        {item.nama}
                                    </h3>

                                    <p className="text-sm text-gray-500 mt-2">
                                        {item.kategori?.nama_kategori}
                                    </p>

                                    <p className="text-gray-600 text-sm mt-2 line-clamp-2">
                                        {item.deskripsi}
                                    </p>

                                    <p className="text-lg font-bold text-[#2d6a4f] mt-4">
                                        Rp {Number(item.harga).toLocaleString('id-ID')}
                                    </p>

                                    <div className="flex gap-2 mt-4">
                                        <Link
                                            to={`/product/${item.id}`}
                                            className="flex-1 text-center border border-[#2d6a4f] text-[#2d6a4f] py-2 rounded-lg hover:bg-[#e8f5e9] transition text-sm font-semibold"
                                        >
                                            Detail
                                        </Link>

                                        {(cartItems[item.id] || 0) > 0 ? (
                                            <div className="flex items-center gap-3 bg-[#e8f5e9] rounded-lg px-3">
                                                <button
                                                    onClick={() => handleUpdateQty(item.id, -1)}
                                                    className="text-[#2d6a4f] font-bold"
                                                >
                                                    -
                                                </button>

                                                <span className="font-semibold text-[#2d6a4f]">
                                                    {cartItems[item.id]}
                                                </span>

                                                <button
                                                    onClick={() => handleUpdateQty(item.id, 1)}
                                                    className="text-[#2d6a4f] font-bold"
                                                >
                                                    +
                                                </button>
                                            </div>
                                        ) : (
                                            <button
                                                onClick={() => handleAddToCart(item.id)}
                                                className="flex-1 bg-[#2d6a4f] text-white py-2 rounded-lg hover:bg-[#1b4332] transition text-sm font-semibold"
                                            >
                                                + Keranjang
                                            </button>
                                        )}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>
                )}
            </div>
        </div>
    );
}