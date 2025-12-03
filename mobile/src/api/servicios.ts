import apiClient from "./client";
import type { ApiResponse, Servicio, TipoServicio } from "../types";

export const serviciosApi = {
    getAll: async (tipo?: TipoServicio): Promise<ApiResponse<Servicio[]>> => {
        const params = tipo ? { tipo } : {};
        const response = await apiClient.get<ApiResponse<Servicio[]>>("/servicios", { params });
        return response.data;
    },

    getById: async (id: string): Promise<ApiResponse<Servicio>> => {
        const response = await apiClient.get<ApiResponse<Servicio>>(`/servicios/${id}`);
        return response.data;
    },
};
