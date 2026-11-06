import React from 'react';
import { Link } from 'react-router-dom';

export default function Navbar({ cartItems = {} }) {
    const totalItems = Object.values(cartItems).reduce(
        (sum, qty) => sum + qty,
        0
    );

    return (
        <nav className="bg-[#1b4332] text-white px-8 py-4 flex justify-between items-center shadow-md">
            <div className="font-bold text-2xl tracking-wide">
                <Link to="/">Salero Minang</Link>
            </div>

            <div className="flex gap-6 text-sm font-medium">
                <Link
                    to="/"
                    className="hover:text-emerald-200 transition"
                >
                    Dashboard
                </Link>

                <Link
                    to="/cart"
                    className="hover:text-emerald-200 transition"
                >
                    Keranjang {totalItems > 0 && `(${totalItems})`}
                </Link>

                <Link
                    to="/checkout"
                    className="hover:text-emerald-200 transition"
                >
                    Checkout
                </Link>

                <Link
                    to="/admin"
                    className="hover:text-emerald-200 transition"
                >
                    Admin
                </Link>
            </div>
        </nav>
    );
}