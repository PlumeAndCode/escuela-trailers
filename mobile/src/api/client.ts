import axios, { AxiosError, InternalAxiosRequestConfig } from "axios";
import * as SecureStore from "expo-secure-store";

// Cambia esta URL por tu IP local cuando pruebes en dispositivo físico
// Para emulador Android usa: http://10.0.2.2:8000/api
// Para dispositivo físico usa tu IP local: http://192.168.x.x:8000/api
const API_URL = "http://192.168.1.16:8000/api";

export const apiClient = axios.create({
    baseURL: API_URL,
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
    timeout: 15000,
});

// Interceptor para agregar token a las peticiones
apiClient.interceptors.request.use(
    async (config: InternalAxiosRequestConfig) => {
        const token = await SecureStore.getItemAsync("auth_token");
        if (token && config.headers) {
            config.headers.Authorization = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Interceptor para manejar errores de respuesta
apiClient.interceptors.response.use(
    (response) => response,
    async (error: AxiosError) => {
        if (error.response?.status === 401) {
            // Token expirado o inválido - limpiar storage
            await SecureStore.deleteItemAsync("auth_token");
        }
        return Promise.reject(error);
    }
);

export default apiClient;
