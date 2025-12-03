import { create } from "zustand";
import type { DashboardStats, ProximoPago, ServicioReciente } from "../types";
import { dashboardApi } from "../api/dashboard";

interface DashboardState {
    stats: DashboardStats | null;
    proximosPagos: ProximoPago[];
    serviciosRecientes: ServicioReciente[];
    isLoading: boolean;
    error: string | null;

    // Actions
    fetchDashboard: () => Promise<void>;
    refresh: () => Promise<void>;
}

export const useDashboardStore = create<DashboardState>((set) => ({
    stats: null,
    proximosPagos: [],
    serviciosRecientes: [],
    isLoading: false,
    error: null,

    fetchDashboard: async () => {
        set({ isLoading: true, error: null });
        try {
            const response = await dashboardApi.getDashboard();
            if (response.success && response.data) {
                set({
                    stats: response.data.estadisticas || null,
                    proximosPagos: response.data.proximos_pagos || [],
                    serviciosRecientes: response.data.servicios_recientes || [],
                });
            } else {
                set({ stats: null, proximosPagos: [], serviciosRecientes: [] });
            }
        } catch (error: any) {
            set({
                error: "Error al cargar dashboard",
                stats: null,
                proximosPagos: [],
                serviciosRecientes: [],
            });
        } finally {
            set({ isLoading: false });
        }
    },

    refresh: async () => {
        const { fetchDashboard } = useDashboardStore.getState();
        await fetchDashboard();
    },
}));
