import './bootstrap';
import Alpine from 'alpinejs';
import React from 'react';
import { createRoot } from 'react-dom/client';
import { BrowserRouter } from 'react-router-dom';
import { QueryClient, QueryClientProvider } from '@tanstack/react-query';
import { Toaster } from 'react-hot-toast';
import App from './app.jsx';

window.Alpine = Alpine;

Alpine.start();

const queryClient = new QueryClient();
const element = document.getElementById('replay-app');

if (element) {
    createRoot(element).render(
        <React.StrictMode>
            <QueryClientProvider client={queryClient}>
                <BrowserRouter>
                    <App />
                    <Toaster position="top-right" />
                </BrowserRouter>
            </QueryClientProvider>
        </React.StrictMode>
    );
}