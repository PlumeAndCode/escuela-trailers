import apiClient from "./client";
import type { ApiResponse, CursoResumen, CursoProgreso } from "../types";

export const cursosApi = {
    getAll: async (): Promise<ApiResponse<CursoResumen[]>> => {
        const response = await apiClient.get<ApiResponse<CursoResumen[]>>("/cursos");
        return response.data;
    },

    getProgreso: async (id: string): Promise<ApiResponse<CursoProgreso>> => {
        const response = await apiClient.get<ApiResponse<CursoProgreso>>(`/cursos/${id}/progreso`);
        return response.data;
    },
};
