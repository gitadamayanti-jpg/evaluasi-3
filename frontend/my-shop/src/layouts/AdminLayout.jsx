import { Outlet } from "react-router-dom";
import Sidebar from "../components/Sidebar";
import { useState } from "react";

export default function AdminLayout() {
    const [sidebarOpen, setSidebarOpen] = useState(false);

    return (
        <div className="flex h-screen bg-gray-100">
            <Sidebar
                sidebarOpen={sidebarOpen}
                setSidebarOpen={setSidebarOpen}
            />

            <div className="flex-1 flex flex-col min-w-0">
                <div className="md:hidden bg-white shadow p-4 flex justify-between items-center">
                    <h1 className="font-bold text-gray-800">REPLAY Admin</h1>

                    <button
                        className="p-2 border rounded"
                        onClick={() => setSidebarOpen(!sidebarOpen)}
                    >
                        ☰
                    </button>
                </div>

                <main className="flex-1 overflow-y-auto p-6">
                    <Outlet />
                </main>

                <footer className="text-center py-4 bg-white border-t border-gray-200 text-xs text-gray-600 font-medium">
                    © 2026 Salero Minang. All rights reserved.
                </footer>
            </div>
        </div>
    );
}