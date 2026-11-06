import React from 'react';
import { useParams, useNavigate } from 'react-router-dom';
import { useProducts } from '../../context/ProductContext';

export default function ProductDetail({
    cartItems = {},
    handleAddToCart,
    handleUpdateQty
}) {
    const { id } = useParams();
    const navigate = useNavigate();

    const {
        products,
        isLoading,
        isError
    } = useProducts();

    const product = products.find(
        (item) => String(item.id) === String(id)
    );

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

    if (isLoading) {
        return (
            <div className="min-h-screen bg-[#e8f5e9] flex items-center justify-center">
                <p className="text-[#2d6a4f] font-semibold">
                    Memuat detail produk...
                </p>
            </div>
        );
    }

    if (isError) {
        return (
            <div className="min-h-screen bg-[#e8f5e9] flex items-center justify-center">
                <p className="text-red-600 font-semibold">
                    Gagal mengambil data produk.
                </p>
            </div>
        );
    }

    if (!product) {
        return (
            <div className="min-h-screen bg-[#e8f5e9] p-8 font-sans flex flex-col items-center justify-center">
                <div className="bg-white p-6 rounded-2xl border border-red-300 text-center max-w-md w-full">
                    <h2 className="text-xl font-bold text-red-600 mb-4">
                        Produk Tidak Ditemukan
                    </h2>

                    <button
                        onClick={() => navigate('/')}
                        className="px-4 py-2 bg-[#2d6a4f] text-white rounded-xl text-sm font-semibold hover:bg-[#1b4332] transition"
                    >
                        Kembali ke Dashboard
                    </button>
                </div>
            </div>
        );
    }

    const qty = cartItems[product.id] || 0;

    return (
        <div className="min-h-screen bg-[#e8f5e9] p-8 font-sans">
            <div className="max-w-4xl mx-auto">

                <div className="flex justify-start mb-6">
                    <button
                        onClick={() => navigate('/')}
                        className="px-5 py-2.5 bg-[#2d6a4f] text-white rounded-xl text-sm font-semibold hover:bg-[#1b4332] transition shadow-sm flex items-center gap-2"
                    >
                        ← Kembali ke Dashboard
                    </button>
                </div>

                <div className="bg-white p-6 md:p-8 rounded-2xl border border-[#74c69d] shadow-sm flex flex-col md:flex-row gap-8 items-start">

                    {product.gambar && (
                        <img
                            src={getImageUrl(product.gambar)}
                            alt={product.nama}
                            className="w-full md:w-80 h-72 object-cover rounded-xl border border-gray-100"
                        />
                    )}

                    <div className="flex-1 flex flex-col justify-between h-full">
                        <div>
                            <span className="inline-block bg-[#e8f5e9] text-[#2d6a4f] text-xs font-bold px-3 py-1 rounded-full mb-2">
                                {product.kategori?.nama_kategori}
                            </span>

                            <h1 className="text-2xl font-bold text-gray-900 mb-3">
                                {product.nama}
                            </h1>

                            <p className="text-gray-700 text-base leading-relaxed mb-4">
                                {product.deskripsi}
                            </p>

                            <p className="text-[#1b4332] font-bold text-xl mb-6">
                                Rp {Number(product.harga).toLocaleString('id-ID')}
                            </p>
                        </div>

                        <div className="mt-4 pt-4 border-t border-gray-100">
                            {qty === 0 ? (
                                <button
                                    type="button"
                                    onClick={() => handleAddToCart?.(product.id)}
                                    className="w-full py-3 px-6 bg-[#2d6a4f] text-white rounded-xl font-semibold text-sm hover:bg-[#1b4332] transition"
                                >
                                    + Tambah ke Keranjang
                                </button>
                            ) : (
                                <div className="flex items-center justify-between border border-[#2d6a4f] bg-[#e8f5e9] px-6 py-2 rounded-xl">
                                    <span className="text-sm font-bold text-[#1b4332]">
                                        Jumlah di Keranjang:
                                    </span>

                                    <div className="flex items-center gap-3">
                                        <button
                                            type="button"
                                            onClick={() => handleUpdateQty?.(product.id, -1)}
                                            className="font-bold text-[#2d6a4f] text-xl px-2 hover:opacity-75"
                                        >
                                            -
                                        </button>

                                        <span className="font-bold text-base text-[#1b4332]">
                                            {qty}
                                        </span>

                                        <button
                                            type="button"
                                            onClick={() => handleUpdateQty?.(product.id, 1)}
                                            className="font-bold text-[#2d6a4f] text-xl px-2 hover:opacity-75"
                                        >
                                            +
                                        </button>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}