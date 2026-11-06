import React from 'react';
import { Routes, Route, Navigate } from 'react-router-dom';
import DigicamPage from './pages/frontpages/DigicamPage';

function Dashboard() {
    return <DigicamPage />;
}

function AdminDashboard() {
    return (
        <div className="p-6">
            <h1 className="text-3xl font-bold">Admin REPLAY</h1>
            <p className="mt-2 text-gray-600">
                Kelola koleksi kamera digicam.
            </p>
        </div>
    );
}

export default function App() {
    return (
        <Routes>
            <Route path="/" element={<Dashboard />} />
            <Route path="/admin" element={<AdminDashboard />} />
            <Route path="*" element={<Navigate to="/" replace />} />
        </Routes>
    );
}