import React from 'react';
import { Link, useLocation } from 'react-router-dom';
import apiClient from '../utils/axiosClient';

export default function Sidebar({ sidebarOpen, setSidebarOpen }) {
    const location = useLocation();

    const handleLogout = async () => {
        try {
            await apiClient.post('/logout');
        } catch (error) {
            console.log('Logout API:', error);
        } finally {
            localStorage.removeItem('token');
            window.location.href = 'http://127.0.0.1:8000/login';
        }
    };

    const linkClass = (path) => {
        return `p-3 rounded-xl text-sm font-semibold transition ${
            location.pathname === path
                ? 'bg-[#2d6a4f] text-white shadow-sm'
                : 'text-gray-600 hover:bg-[#e8f5e9] hover:text-[#1b4332]'
        }`;
    };

    return (
        <div
            className={`w-64 min-h-screen bg-white border-r border-gray-200 p-6 flex flex-col font-sans
            ${sidebarOpen ? 'block' : 'hidden md:flex'}`}
        >
            <div className="mb-8">
                <h2 className="text-xl font-extrabold text-[#1b4332]">
                    Salero Minang
                </h2>
                <p className="text-xs text-[#2d6a4f] font-semibold">
                    Halaman admin
                </p>
            </div>

            <nav className="flex flex-col gap-2">
                <Link
                    to="/admin"
                    className={linkClass('/admin')}
                    onClick={() => setSidebarOpen(false)}
                >
                    Dashboard
                </Link>

                <Link
                    to="/admin/about"
                    className={linkClass('/admin/about')}
                    onClick={() => setSidebarOpen(false)}
                >
                    About
                </Link>

                <Link
                    to="/"
                    className="p-3 rounded-xl text-sm font-semibold text-gray-600 hover:bg-[#e8f5e9] hover:text-[#1b4332] transition"
                    onClick={() => setSidebarOpen(false)}
                >
                    Lihat Toko
                </Link>

                <button
                    onClick={handleLogout}
                    className="w-full text-left p-3 rounded-xl text-sm font-semibold text-red-600 hover:bg-red-50 transition"
                >
                    Logout
                </button>
            </nav>
        </div>
    );
}