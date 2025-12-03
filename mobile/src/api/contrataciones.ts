import apiClient from "./client";
import type {
    ApiResponse,
    ContratacionResumen,
    ContratacionDetalle,
    EstadoContratacion,
    TipoServicio,
    ContratacionCreada,
} from "../types";

interface ContratacionesParams {
    estado?: EstadoContratacion;
    tipo?: TipoServicio;
}

export const contratacionesApi = {
    getAll: async (params?: ContratacionesParams): Promise<ApiResponse<ContratacionResumen[]>> => {
        const response = await apiClient.get<ApiResponse<ContratacionResumen[]>>(
            "/contrataciones",
            { params }
        );
        return response.data;
    },

    getById: async (id: string): Promise<ApiResponse<ContratacionDetalle>> => {
        const response = await apiClient.get<ApiResponse<ContratacionDetalle>>(
            `/contrataciones/${id}`
        );
        return response.data;
    },

    create: async (servicioId: string): Promise<ApiResponse<ContratacionCreada>> => {
        const response = await apiClient.post<ApiResponse<ContratacionCreada>>("/contrataciones", {
            id_servicio: servicioId,
        });
        return response.data;
    },
};
