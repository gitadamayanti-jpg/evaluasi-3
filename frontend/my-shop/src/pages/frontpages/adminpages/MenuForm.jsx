import React, { useState } from 'react';
import { Link, useNavigate } from 'react-router-dom';
import toast from 'react-hot-toast';
import { useProducts } from '../../../context/ProductContext';

export default function MenuForm() {
    const { products, addProduct } = useProducts();
    const navigate = useNavigate();

    const [formData, setFormData] = useState({
        nama: '',
        deskripsi: '',
        harga: '',
        kategori_id: '',
        gambar: null
    });

    const [errors, setErrors] = useState({});

    const kategoris = [
        ...new Map(
            products
                .filter((menu) => menu.kategori)
                .map((menu) => [
                    menu.kategori.id,
                    menu.kategori
                ])
        ).values()
    ];

    const handleChange = (e) => {
        const { name, value, files } = e.target;

        setFormData({
            ...formData,
            [name]: files ? files[0] : value
        });

        setErrors({
            ...errors,
            [name]: ''
        });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        setErrors({});

        const data = new FormData();

        data.append('nama', formData.nama);
        data.append('deskripsi', formData.deskripsi);
        data.append('harga', formData.harga);
        data.append('kategori_id', formData.kategori_id);

        if (formData.gambar) {
            data.append('gambar', formData.gambar);
        }

        try {
            await addProduct.mutateAsync(data);
            navigate('/admin');
        } catch (error) {
            if (error.response?.status === 422) {
                setErrors(error.response.data.errors || {});
                toast.error('Periksa kembali data yang dimasukkan.');
            }
        }
    };

    const inputClass = (field) =>
        `w-full border rounded-lg px-3 py-2 text-sm focus:outline-none ${
            errors[field]
                ? 'border-red-500 focus:ring-1 focus:ring-red-500'
                : 'border-gray-300 focus:ring-2 focus:ring-[#2d6a4f]'
        }`;

    return (
        <div className="p-8 font-sans">
            <div className="mb-6">
                <h1 className="text-2xl font-bold text-[#1b4332]">
                    Tambah Menu
                </h1>
                <p className="text-sm text-gray-500 mt-1">
                    Masukkan informasi menu makanan baru.
                </p>
            </div>

            <div className="bg-white rounded-xl border border-gray-200 shadow-sm p-6 max-w-3xl">
                <form onSubmit={handleSubmit}>
                    <div className="mb-4">
                        <label className="block text-sm font-semibold text-gray-700 mb-2">
                            Nama Menu
                        </label>
                        <input
                            type="text"
                            name="nama"
                            value={formData.nama}
                            onChange={handleChange}
                            className={inputClass('nama')}
                            placeholder="Masukkan nama menu"
                        />
                        {errors.nama && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.nama[0]}
                            </p>
                        )}
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-semibold text-gray-700 mb-2">
                            Kategori
                        </label>
                        <select
                            name="kategori_id"
                            value={formData.kategori_id}
                            onChange={handleChange}
                            className={inputClass('kategori_id')}
                        >
                            <option value="">Pilih Kategori</option>
                            {kategoris.map((kategori) => (
                                <option key={kategori.id} value={kategori.id}>
                                    {kategori.nama_kategori}
                                </option>
                            ))}
                        </select>
                        {errors.kategori_id && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.kategori_id[0]}
                            </p>
                        )}
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-semibold text-gray-700 mb-2">
                            Harga
                        </label>
                        <input
                            type="number"
                            name="harga"
                            value={formData.harga}
                            onChange={handleChange}
                            className={inputClass('harga')}
                            placeholder="Masukkan harga"
                            min="0"
                            step="1"
                        />
                        {errors.harga && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.harga[0]}
                            </p>
                        )}
                    </div>

                    <div className="mb-4">
                        <label className="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi
                        </label>
                        <textarea
                            name="deskripsi"
                            value={formData.deskripsi}
                            onChange={handleChange}
                            className={inputClass('deskripsi')}
                            placeholder="Masukkan deskripsi menu"
                            rows="4"
                        />
                        {errors.deskripsi && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.deskripsi[0]}
                            </p>
                        )}
                    </div>

                    <div className="mb-6">
                        <label className="block text-sm font-semibold text-gray-700 mb-2">
                            Gambar Menu
                        </label>
                        <input
                            type="file"
                            name="gambar"
                            accept="image/*"
                            onChange={handleChange}
                            className={inputClass('gambar')}
                        />
                        {errors.gambar && (
                            <p className="text-red-500 text-sm mt-1">
                                {errors.gambar[0]}
                            </p>
                        )}
                    </div>

                    <div className="flex gap-3">
                        <button
                            type="submit"
                            disabled={addProduct.isPending}
                            className="bg-[#2d6a4f] text-white px-5 py-2 rounded-lg text-sm font-semibold hover:bg-[#1b4332] disabled:opacity-50"
                        >
                            {addProduct.isPending ? 'Menyimpan...' : 'Simpan'}
                        </button>

                        <Link
                            to="/admin"
                            className="bg-gray-200 text-gray-700 px-5 py-2 rounded-lg text-sm font-semibold hover:bg-gray-300"
                        >
                            Batal
                        </Link>
                    </div>
                </form>
            </div>
        </div>
    );
}