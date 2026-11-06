import React from 'react';
import { useNavigate, useOutletContext } from 'react-router-dom';
import { useProducts } from '../../context/ProductContext';

export default function Cart(props) {
    const navigate = useNavigate();
    const context = useOutletContext() || {};

    const cartItems = props.cartItems || context.cartItems || {};
    const handleUpdateQty = props.handleUpdateQty || context.handleUpdateQty;

    const { products, isLoading, isError } = useProducts();

    const cartProducts = products
        .filter((item) => cartItems[item.id] && cartItems[item.id] > 0)
        .map((item) => ({
            ...item,
            quantity: cartItems[item.id],
            subtotal: Number(item.harga) * cartItems[item.id],
        }));

    const totalHarga = cartProducts.reduce(
        (acc, curr) => acc + curr.subtotal,
        0
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

    const handleRemoveProduct = (id) => {
        if (handleUpdateQty) {
            handleUpdateQty(id, -cartItems[id]);
        }
    };

    if (isLoading) {
        return (
            <div className="text-center py-20 text-[#2d6a4f]">
                Memuat keranjang...
            </div>
        );
    }

    if (isError) {
        return (
            <div className="text-center py-20 text-red-600">
                Gagal mengambil data menu.
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#e8f5e9] p-8 font-sans rounded-2xl">
            <div className="max-w-5xl mx-auto">
                <h1 className="text-2xl font-bold text-gray-900 mb-6">
                    Keranjang Belanja
                </h1>

                {cartProducts.length > 0 ? (
                    <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        {/* Daftar Produk */}
                        <div className="lg:col-span-2 space-y-4">
                            {cartProducts.map((item) => (
                                <div
                                    key={item.id}
                                    className="bg-white border border-[#74c69d] p-4 rounded-2xl flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm"
                                >
                                    <div className="flex items-center gap-4 w-full sm:w-auto">
                                        {item.gambar && (
                                            <img
                                                src={getImageUrl(item.gambar)}
                                                alt={item.nama}
                                                className="w-20 h-20 object-cover rounded-xl border border-gray-100 flex-shrink-0"
                                            />
                                        )}

                                        <div>
                                            <h3 className="font-bold text-gray-900">
                                                {item.nama}
                                            </h3>

                                            <p className="text-sm font-semibold text-[#2d6a4f]">
                                                Rp {Number(item.harga).toLocaleString('id-ID')}
                                            </p>
                                        </div>
                                    </div>

                                    <div className="flex items-center justify-between w-full sm:w-auto gap-6">

                                        {/* Tombol Tambah/Kurang */}
                                        <div className="flex items-center border border-[#2d6a4f] bg-[#e8f5e9] rounded-xl px-3 py-1">
                                            <button
                                                type="button"
                                                onClick={() => handleUpdateQty && handleUpdateQty(item.id, -1)}
                                                className="font-bold text-[#2d6a4f] text-lg px-2 hover:opacity-75"
                                            >
                                                -
                                            </button>

                                            <span className="font-bold text-sm text-[#1b4332] px-3">
                                                {item.quantity}
                                            </span>

                                            <button
                                                type="button"
                                                onClick={() => handleUpdateQty && handleUpdateQty(item.id, 1)}
                                                className="font-bold text-[#2d6a4f] text-lg px-2 hover:opacity-75"
                                            >
                                                +
                                            </button>
                                        </div>

                                        <div className="text-right">
                                            <p className="font-bold text-[#1b4332] text-sm">
                                                Rp {item.subtotal.toLocaleString('id-ID')}
                                            </p>

                                            <button
                                                type="button"
                                                onClick={() => handleRemoveProduct(item.id)}
                                                className="text-xs text-red-600 hover:text-red-800 font-semibold mt-1"
                                            >
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            ))}
                        </div>

                        {/* Ringkasan Pesanan */}
                        <div className="bg-white border border-[#74c69d] p-6 rounded-2xl h-fit shadow-sm">
                            <h2 className="text-lg font-bold text-gray-900 mb-4 border-b pb-2">
                                Ringkasan Pesanan
                            </h2>

                            <div className="space-y-2 text-sm text-gray-700 mb-4">
                                <div className="flex justify-between">
                                    <span>Total Items</span>
                                    <span className="font-semibold">
                                        {cartProducts.reduce(
                                            (sum, item) => sum + item.quantity,
                                            0
                                        )} Porsi
                                    </span>
                                </div>

                                <div className="flex justify-between text-base font-bold text-gray-900 pt-2 border-t">
                                    <span>Total Harga</span>
                                    <span className="text-[#2d6a4f]">
                                        Rp {totalHarga.toLocaleString('id-ID')}
                                    </span>
                                </div>
                            </div>

                            <button
                                type="button"
                                onClick={() => navigate('/checkout')}
                                className="w-full py-3 bg-[#2d6a4f] text-white font-bold rounded-xl hover:bg-[#1b4332] transition text-center shadow-sm"
                            >
                                Lanjut ke Checkout
                            </button>
                        </div>
                    </div>
                ) : (
                    <div className="bg-white border border-[#74c69d] rounded-2xl p-12 text-center">
                        <p className="text-gray-500 font-medium mb-4">
                            Keranjang belanjaanmu masih kosong.
                        </p>

                        <button
                            onClick={() => navigate('/')}
                            className="px-6 py-2.5 bg-[#2d6a4f] text-white rounded-xl font-semibold text-sm hover:bg-[#1b4332] transition"
                        >
                            Lihat Menu & Mulai Pesan
                        </button>
                    </div>
                )}
            </div>
        </div>
    );
}