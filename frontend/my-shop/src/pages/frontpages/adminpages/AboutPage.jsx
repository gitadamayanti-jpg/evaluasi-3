import React from 'react';

export default function AboutPage() {
  return (
    <div className="p-8 font-sans bg-[#f8fdf9] min-h-screen">
      <h1 className="text-2xl font-bold text-gray-900 mb-6">Tentang Panel Admin Salero Minang</h1>

      <div className="bg-white p-6 rounded-2xl border border-[#74c69d] shadow-sm max-w-3xl space-y-4">
        <div>
          <h2 className="text-lg font-bold text-[#1b4332] mb-1">Sistem Manajemen Salero Minang</h2>
          <p className="text-gray-600 text-sm leading-relaxed">
            Panel Admin ini digunakan untuk mengelola data menu makanan, memantau daftar transaksi masuk, serta mengatur operasional pemesanan online Rumah Makan Salero Minang secara real-time.
          </p>
        </div>

        <div className="border-t border-gray-100 pt-4 grid grid-cols-2 gap-4 text-xs">
          <div>
            <p className="text-gray-400 font-medium">Versi Aplikasi</p>
            <p className="font-bold text-gray-800 text-sm">v1.0.0 (Salero Minang Admin)</p>
          </div>
        </div>
      </div>
    </div>
  );
}