import apiClient from "./client";
import * as SecureStore from "expo-secure-store";
import type { LoginRequest, LoginResponse, User, ApiResponse } from "../types";

export const authApi = {
    login: async (credentials: LoginRequest): Promise<LoginResponse> => {
        const response = await apiClient.post<LoginResponse>("/login", {
            ...credentials,
            device_name: "mobile-app",
        });

        // Guardar token en storage seguro
        if (response.data.success) {
            await SecureStore.setItemAsync("auth_token", response.data.data.token);
        }

        return response.data;
    },

    logout: async (): Promise<void> => {
        try {
            await apiClient.post("/logout");
        } finally {
            await SecureStore.deleteItemAsync("auth_token");
        }
    },

    getPerfil: async (): Promise<ApiResponse<User>> => {
        const response = await apiClient.get<ApiResponse<User>>("/perfil");
        return response.data;
    },

    updatePerfil: async (data: Partial<User>): Promise<ApiResponse<User>> => {
        const response = await apiClient.put<ApiResponse<User>>("/perfil", data);
        return response.data;
    },

    isAuthenticated: async (): Promise<boolean> => {
        const token = await SecureStore.getItemAsync("auth_token");
        return !!token;
    },
};
