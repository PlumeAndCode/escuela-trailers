import { create } from "zustand";
import * as SecureStore from "expo-secure-store";
import type { User, UpdatePerfilRequest } from "../types";
import { authApi } from "../api/auth";

interface AuthState {
    user: User | null;
    isAuthenticated: boolean;
    isLoading: boolean;
    error: string | null;

    // Actions
    login: (email: string, password: string) => Promise<boolean>;
    logout: () => Promise<void>;
    loadUser: () => Promise<void>;
    checkAuth: () => Promise<boolean>;
    updateProfile: (data: UpdatePerfilRequest) => Promise<boolean>;
    clearError: () => void;
}

export const useAuthStore = create<AuthState>((set, get) => ({
    user: null,
    isAuthenticated: false,
    isLoading: false,
    error: null,

    login: async (email: string, password: string) => {
        set({ isLoading: true, error: null });
        try {
            const response = await authApi.login({ email, password });

            if (response.success) {
                set({
                    user: response.data.user,
                    isAuthenticated: true,
                    isLoading: false,
                });
                return true;
            }
            return false;
        } catch (error: any) {
            const message = error.response?.data?.message || "Error al iniciar sesión";
            set({ error: message, isLoading: false });
            return false;
        }
    },

    logout: async () => {
        set({ isLoading: true });
        try {
            await authApi.logout();
        } finally {
            set({
                user: null,
                isAuthenticated: false,
                isLoading: false,
            });
        }
    },

    loadUser: async () => {
        set({ isLoading: true });
        try {
            const response = await authApi.getPerfil();
            if (response.success) {
                set({ user: response.data, isAuthenticated: true });
            }
        } catch (error) {
            set({ user: null, isAuthenticated: false });
        } finally {
            set({ isLoading: false });
        }
    },

    checkAuth: async () => {
        const token = await SecureStore.getItemAsync("auth_token");
        if (token) {
            await get().loadUser();
            return get().isAuthenticated;
        }
        return false;
    },

    updateProfile: async (data: UpdatePerfilRequest) => {
        set({ isLoading: true, error: null });
        try {
            const response = await authApi.updatePerfil(data);
            if (response.success) {
                set({ user: response.data });
                return true;
            }
            return false;
        } catch (error: any) {
            const message = error.response?.data?.message || "Error al actualizar perfil";
            set({ error: message });
            return false;
        } finally {
            set({ isLoading: false });
        }
    },

    clearError: () => set({ error: null }),
}));
