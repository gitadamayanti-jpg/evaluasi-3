import React from 'react';
import { useQuery } from '@tanstack/react-query';
import apiClient from '../../apiClient';

export default function DigicamPage() {
    const {
        data: digicam = [],
        isLoading,
        isError,
        error,
    } = useQuery({
        queryKey: ['digicam'],
        queryFn: async () => {
            const response = await apiClient.get('/digicam');
            return response.data.data;
        },
    });

    if (isLoading) {
        return <p className="p-6">Memuat data kamera...</p>;
    }

    if (isError) {
        return (
            <div className="p-6">
                <h2 className="font-semibold text-red-600">
                    Gagal mengambil data kamera
                </h2>

                <p className="mt-2">
                    {error.response?.data?.message ||
                        'Terjadi kesalahan saat menghubungi API.'}
                </p>

                {error.response?.status === 401 && (
                    <p className="mt-2 text-sm text-gray-600">
                        Silakan login terlebih dahulu untuk mengakses data kamera.
                    </p>
                )}
            </div>
        );
    }

    return (
        <div className="p-6">
            <h1 className="mb-6 text-3xl font-bold">
                Koleksi Kamera REPLAY
            </h1>

            {digicam.length === 0 ? (
                <p>Belum ada data kamera.</p>
            ) : (
                <div className="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    {digicam.map((item) => (
                        <div
                            key={item.id}
                            className="overflow-hidden rounded-lg border bg-white shadow-sm"
                        >
                            {item.foto && (
                                <img
                                    src={`/storage/${item.foto}`}
                                    alt={item.nama}
                                    className="h-48 w-full object-cover"
                                />
                            )}

                            <div className="p-4">
                                <h2 className="text-lg font-semibold">
                                    {item.nama}
                                </h2>

                                <p className="text-sm text-gray-500">
                                    {item.merek}
                                </p>

                                <p className="mt-2 font-bold text-blue-700">
                                    Rp {Number(item.harga).toLocaleString('id-ID')}
                                </p>

                                <p className="mt-1 text-sm">
                                    Stok: {item.stok}
                                </p>

                                <p className="mt-2 text-sm text-gray-600">
                                    {item.deskripsi}
                                </p>
                            </div>
                        </div>
                    ))}
                </div>
            )}
        </div>
    );
}