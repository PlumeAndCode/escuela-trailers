import apiClient from "./client";
import type {
    PagoResumen,
    PagoDetalle,
    PagosResumen,
    EstadoPago,
    TipoPago,
    ApiResponse,
    PagoRealizado,
} from "../types";

interface PagosApiResponse {
    success: boolean;
    data: PagoResumen[];
    resumen: PagosResumen;
}

export const pagosApi = {
    getAll: async (estado?: EstadoPago): Promise<PagosApiResponse> => {
        const params = estado ? { estado } : {};
        const response = await apiClient.get<PagosApiResponse>("/pagos", { params });
        return response.data;
    },

    getById: async (id: string): Promise<ApiResponse<PagoDetalle>> => {
        const response = await apiClient.get<ApiResponse<PagoDetalle>>(`/pagos/${id}`);
        return response.data;
    },

    pagar: async (id: string, tipoPago: TipoPago): Promise<ApiResponse<PagoRealizado>> => {
        const response = await apiClient.post<ApiResponse<PagoRealizado>>(`/pagos/${id}/pagar`, {
            tipo_pago: tipoPago,
        });
        return response.data;
    },

    descargarComprobante: async (id: string): Promise<Blob> => {
        const response = await apiClient.get(`/pagos/${id}/comprobante`, {
            responseType: "blob",
        });
        return response.data;
    },
};
