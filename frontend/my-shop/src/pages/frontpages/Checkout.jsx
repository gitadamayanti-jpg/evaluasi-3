import React, { useState } from 'react';
import { useNavigate, useOutletContext } from 'react-router-dom';
import { useProducts } from '../../context/ProductContext';
import { addOrder } from '../../Data/orders';

export default function Checkout(props) {
    const navigate = useNavigate();
    const context = useOutletContext() || {};

    const { products = [], isLoading, isError } = useProducts();

    const cartItems = props.cartItems || context.cartItems || {};
    const setCartItems = props.setCartItems || context.setCartItems;

    const [paymentMethod, setPaymentMethod] = useState('Tunai (COD)');
    const [formData, setFormData] = useState({
        nama: '',
        telepon: '',
        alamat: '',
        catatan: ''
    });
    const [isSuccess, setIsSuccess] = useState(false);

    const cartProducts = products
        .filter((item) => cartItems[item.id] && cartItems[item.id] > 0)
        .map((item) => ({
            ...item,
            quantity: cartItems[item.id],
            subtotal: Number(item.harga) * cartItems[item.id],
        }));

    const subtotal = cartProducts.reduce(
        (acc, curr) => acc + curr.subtotal,
        0
    );

    const ongkir = subtotal > 0 ? 10000 : 0;
    const totalPembayaran = subtotal + ongkir;

    const handleInputChange = (e) => {
        setFormData({
            ...formData,
            [e.target.name]: e.target.value
        });
    };

    const handleOrderSubmit = (e) => {
        e.preventDefault();

        if (cartProducts.length === 0) return;

        const menuSummary = cartProducts
            .map((item) => `${item.nama} (${item.quantity}x)`)
            .join(', ');

        // Simpan pesanan ke localStorage melalui orders.js
        addOrder({
            nama: formData.nama || 'Pelanggan',
            telepon: formData.telepon || '-',
            alamat: formData.alamat || '-',
            menu: menuSummary,
            total: totalPembayaran,
            status: 'Menunggu'
        });

        setIsSuccess(true);

        if (setCartItems) {
            setCartItems({});
        }
    };

    if (isLoading) {
        return (
            <div className="min-h-screen bg-[#e8f5e9] p-6 md:p-8 font-sans rounded-2xl">
                <div className="max-w-4xl mx-auto">
                    <h1 className="text-2xl font-bold text-gray-900 mb-6">
                        Checkout
                    </h1>
                    <p className="text-gray-600">Memuat data pesanan...</p>
                </div>
            </div>
        );
    }

    if (isError) {
        return (
            <div className="min-h-screen bg-[#e8f5e9] p-6 md:p-8 font-sans rounded-2xl">
                <div className="max-w-4xl mx-auto">
                    <h1 className="text-2xl font-bold text-gray-900 mb-6">
                        Checkout
                    </h1>
                    <p className="text-red-600">
                        Gagal mengambil data menu. Silakan coba lagi.
                    </p>
                </div>
            </div>
        );
    }

    return (
        <div className="min-h-screen bg-[#e8f5e9] p-6 md:p-8 font-sans rounded-2xl">
            <div className="max-w-4xl mx-auto">
                <h1 className="text-2xl font-bold text-gray-900 mb-6">
                    Checkout
                </h1>

                {isSuccess ? (
                    <div className="bg-white border border-gray-400 rounded-xl p-6 shadow-sm">
                        <h2 className="text-lg font-bold text-gray-900 mb-2">
                            Pesanan Berhasil!
                        </h2>
                        <p className="text-gray-600 text-sm">
                            Terima kasih sudah berbelanja di Salero Minang.
                        </p>
                    </div>
                ) : cartProducts.length > 0 ? (
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div className="md:col-span-2 space-y-6">
                            <div className="bg-white p-6 rounded-2xl border border-[#74c69d] shadow-sm">
                                <h2 className="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">
                                    1. Alamat Pengiriman
                                </h2>

                                <form
                                    id="checkout-form"
                                    onSubmit={handleOrderSubmit}
                                    className="space-y-4"
                                >
                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-1">
                                            Nama Penerima
                                        </label>
                                        <input
                                            type="text"
                                            name="nama"
                                            required
                                            placeholder="Masukkan nama lengkap"
                                            value={formData.nama}
                                            onChange={handleInputChange}
                                            className="w-full px-4 py-2 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-1">
                                            Nomor WhatsApp / Telepon
                                        </label>
                                        <input
                                            type="tel"
                                            name="telepon"
                                            required
                                            placeholder="0812xxxxxxx"
                                            value={formData.telepon}
                                            onChange={handleInputChange}
                                            className="w-full px-4 py-2 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                                        />
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-1">
                                            Alamat Lengkap
                                        </label>
                                        <textarea
                                            name="alamat"
                                            required
                                            rows="3"
                                            placeholder="Nama jalan, nomor rumah, patokan..."
                                            value={formData.alamat}
                                            onChange={handleInputChange}
                                            className="w-full px-4 py-2 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                                        ></textarea>
                                    </div>

                                    <div>
                                        <label className="block text-xs font-bold text-gray-700 mb-1">
                                            Catatan Pesanan (Opsional)
                                        </label>
                                        <input
                                            type="text"
                                            name="catatan"
                                            placeholder="Contoh: Kuah dibanyakin, sambal terpisah"
                                            value={formData.catatan}
                                            onChange={handleInputChange}
                                            className="w-full px-4 py-2 border rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-[#2d6a4f]"
                                        />
                                    </div>
                                </form>
                            </div>

                            <div className="bg-white p-6 rounded-2xl border border-[#74c69d] shadow-sm">
                                <h2 className="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">
                                    2. Metode Pembayaran
                                </h2>

                                <div className="space-y-3">
                                    {['Tunai (COD)', 'QRIS', 'E-Wallet', 'Transfer Bank'].map((method) => (
                                        <label
                                            key={method}
                                            className={`flex items-center justify-between p-3.5 border rounded-xl cursor-pointer transition ${
                                                paymentMethod === method
                                                    ? 'border-[#2d6a4f] bg-[#e8f5e9] font-bold text-[#1b4332]'
                                                    : 'border-gray-200 text-gray-700'
                                            }`}
                                        >
                                            <span className="text-sm">{method}</span>
                                            <input
                                                type="radio"
                                                name="payment"
                                                value={method}
                                                checked={paymentMethod === method}
                                                onChange={() => setPaymentMethod(method)}
                                                className="accent-[#2d6a4f]"
                                            />
                                        </label>
                                    ))}
                                </div>
                            </div>
                        </div>

                        <div className="space-y-6">
                            <div className="bg-white p-6 rounded-2xl border border-[#74c69d] shadow-sm">
                                <h2 className="text-lg font-bold text-gray-900 mb-4 pb-2 border-b">
                                    Rincian Pesanan
                                </h2>

                                <div className="space-y-3 mb-4 max-h-48 overflow-y-auto pr-1">
                                    {cartProducts.map((item) => (
                                        <div
                                            key={item.id}
                                            className="flex justify-between items-start text-xs"
                                        >
                                            <div>
                                                <p className="font-bold text-gray-800">
                                                    {item.nama}
                                                </p>
                                                <p className="text-gray-500">
                                                    {item.quantity}x @ Rp {Number(item.harga).toLocaleString('id-ID')}
                                                </p>
                                            </div>
                                            <span className="font-bold text-gray-900">
                                                Rp {item.subtotal.toLocaleString('id-ID')}
                                            </span>
                                        </div>
                                    ))}
                                </div>

                                <div className="border-t pt-3 space-y-2 text-xs text-gray-600">
                                    <div className="flex justify-between">
                                        <span>Subtotal Makanan</span>
                                        <span>
                                            Rp {subtotal.toLocaleString('id-ID')}
                                        </span>
                                    </div>

                                    <div className="flex justify-between">
                                        <span>Ongkos Kirim</span>
                                        <span>
                                            Rp {ongkir.toLocaleString('id-ID')}
                                        </span>
                                    </div>

                                    <div className="flex justify-between text-sm font-bold text-gray-900 pt-2 border-t">
                                        <span>Total Pembayaran</span>
                                        <span className="text-[#2d6a4f]">
                                            Rp {totalPembayaran.toLocaleString('id-ID')}
                                        </span>
                                    </div>
                                </div>

                                <button
                                    type="submit"
                                    form="checkout-form"
                                    className="w-full mt-6 py-3 bg-[#2d6a4f] text-white font-bold rounded-xl hover:bg-[#1b4332] transition text-center shadow-sm text-sm"
                                >
                                    Buat Pesanan Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                ) : (
                    <div className="bg-white border border-[#74c69d] rounded-2xl p-12 text-center">
                        <p className="text-gray-500 font-medium mb-4">
                            Tidak ada pesanan yang diselesaikan.
                        </p>
                        <button
                            onClick={() => navigate('/')}
                            className="px-6 py-2.5 bg-[#2d6a4f] text-white rounded-xl font-semibold text-sm hover:bg-[#1b4332] transition"
                        >
                            Kembali ke Dashboard
                        </button>
                    </div>
                )}
            </div>
        </div>
    );
}
