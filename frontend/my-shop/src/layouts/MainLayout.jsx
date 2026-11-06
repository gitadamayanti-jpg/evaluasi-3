import React, { useState } from "react";
import { Outlet, useLocation } from "react-router-dom";
import Navbar from "../components/Navbar";

export default function MainLayout({ cartItems = {}, setCartItems, handleAddToCart, handleUpdateQty }) {
  const [searchTerm, setSearchTerm] = useState('');
  const [selectedCategory, setSelectedCategory] = useState('Semua Kategori');

  const location = useLocation();
  const isProductDetailPage = location.pathname.toLowerCase().includes('/product');

  return (
    <div className="flex flex-col min-h-screen bg-gray-50">
      <div className="sticky top-0 z-50">
        <Navbar cartItems={cartItems} />

        {!isProductDetailPage && (
          <header className="bg-white p-4 shadow-sm flex flex-col md:flex-row gap-3 justify-between items-center px-6 border-b border-gray-200">
            <input
              type="text"
              placeholder="Cari produk..."
              value={searchTerm}
              onChange={(e) => setSearchTerm(e.target.value)}
              className="w-full md:w-1/3 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
            />
            <select
              value={selectedCategory}
              onChange={(e) => setSelectedCategory(e.target.value)}
              className="w-full md:w-auto px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white text-sm"
            >
              <option value="Semua Kategori">Semua Kategori</option>
              <option value="Paket Nasi">Paket Nasi</option>
              <option value="Lauk">Lauk</option>
              <option value="Minuman">Minuman</option>
            </select>
          </header>
        )}
      </div>

      {/* Main Section */}
      <main className="flex-1 p-6 max-w-7xl w-full mx-auto">
        <Outlet context={{ searchTerm, selectedCategory, cartItems, setCartItems, handleAddToCart, handleUpdateQty }} />
      </main>

      {/* Footer */}
      <footer className="bg-gray-800 text-white text-center p-4">
        <p>© 2026 Nasi Padang Salero Minang | Version 1.0</p>
      </footer>
    </div>
  );
}