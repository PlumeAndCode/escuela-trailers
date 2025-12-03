import apiClient from "./client";
import type { ApiResponse, DashboardData } from "../types";

export const dashboardApi = {
    getDashboard: async (): Promise<ApiResponse<DashboardData>> => {
        const response = await apiClient.get<ApiResponse<DashboardData>>("/dashboard");
        return response.data;
    },
};
