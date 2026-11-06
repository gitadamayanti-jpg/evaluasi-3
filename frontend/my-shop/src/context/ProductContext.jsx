import React, { createContext, useContext } from 'react';
import { useQuery, useMutation, useQueryClient } from '@tanstack/react-query';
import toast from 'react-hot-toast';
import apiClient from '../utils/axiosClient';

const ProductContext = createContext();

export function ProductProvider({ children }) {
    const queryClient = useQueryClient();

    // GET ALL PRODUCTS
    const {
        data: products = [],
        isLoading,
        isError,
        error
    } = useQuery({
        queryKey: ['products'],
        queryFn: async () => {
            const response = await apiClient.get('/menu');
            return response.data.data;
        }
    });

    // GET PRODUCT DETAIL
    const getProductById = async (id) => {
        const response = await apiClient.get(`/menu/${id}`);
        return response.data.data;
    };

    // ADD PRODUCT
    const addProduct = useMutation({
        mutationFn: async (product) => {
            const response = await apiClient.post('/menu', product, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });

            return response.data;
        },
        onSuccess: (response) => {
            queryClient.invalidateQueries({ queryKey: ['products'] });
            toast.success(response.message || 'Menu berhasil ditambahkan.');
        },
        onError: (error) => {
            if (error.response?.status !== 422) {
                toast.error(
                    error.response?.data?.message || 'Gagal menambahkan menu.'
                );
            }
        }
    });

    // UPDATE PRODUCT
    const updateProduct = useMutation({
        mutationFn: async ({ id, product }) => {
            const response = await apiClient.post(
                `/menu/${id}?_method=PUT`,
                product,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            );

            return response.data;
        },
        onSuccess: (response) => {
            queryClient.invalidateQueries({ queryKey: ['products'] });
            toast.success(response.message || 'Menu berhasil diperbarui.');
        },
        onError: (error) => {
            if (error.response?.status !== 422) {
                toast.error(
                    error.response?.data?.message || 'Gagal memperbarui menu.'
                );
            }
        }
    });

    // DELETE PRODUCT
    const deleteProduct = useMutation({
        mutationFn: async (id) => {
            const response = await apiClient.delete(`/menu/${id}`);
            return response.data;
        },
        onSuccess: (response) => {
            queryClient.invalidateQueries({ queryKey: ['products'] });
            toast.success(response.message || 'Menu berhasil dihapus.');
        },
        onError: (error) => {
            toast.error(
                error.response?.data?.message || 'Gagal menghapus menu.'
            );
        }
    });

    const value = {
        products,
        isLoading,
        isError,
        error,
        getProductById,
        addProduct,
        updateProduct,
        deleteProduct
    };

    return (
        <ProductContext.Provider value={value}>
            {children}
        </ProductContext.Provider>
    );
}

export function useProducts() {
    return useContext(ProductContext);
}