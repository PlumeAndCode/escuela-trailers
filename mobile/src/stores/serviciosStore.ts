import { create } from "zustand";
import type { Servicio, TipoServicio, ContratacionCreada } from "../types";
import { serviciosApi } from "../api/servicios";
import { contratacionesApi } from "../api/contrataciones";
import { useDashboardStore } from "./dashboardStore";

interface ServiciosState {
    servicios: Servicio[];
    servicioActual: Servicio | null;
    filtroTipo: TipoServicio | null;
    isLoading: boolean;
    isContratando: boolean;
    error: string | null;

    // Actions
    fetchServicios: (tipo?: TipoServicio) => Promise<void>;
    fetchServicio: (id: string) => Promise<void>;
    setFiltro: (tipo: TipoServicio | null) => void;
    contratarServicio: (servicioId: string) => Promise<ContratacionCreada | null>;
    clearServicioActual: () => void;
    clearError: () => void;
}

export const useServiciosStore = create<ServiciosState>((set, get) => ({
    servicios: [],
    servicioActual: null,
    filtroTipo: null,
    isLoading: false,
    isContratando: false,
    error: null,

    fetchServicios: async (tipo?: TipoServicio) => {
        set({ isLoading: true, error: null });
        try {
            const response = await serviciosApi.getAll(tipo);
            if (response.success && response.data) {
                set({ servicios: response.data || [] });
            } else {
                set({ servicios: [] });
            }
        } catch (error: any) {
            set({ error: "Error al cargar servicios", servicios: [] });
        } finally {
            set({ isLoading: false });
        }
    },

    fetchServicio: async (id: string) => {
        set({ isLoading: true, error: null });
        try {
            const response = await serviciosApi.getById(id);
            if (response.success) {
                set({ servicioActual: response.data });
            }
        } catch (error: any) {
            set({ error: "Error al cargar servicio" });
        } finally {
            set({ isLoading: false });
        }
    },

    setFiltro: (tipo: TipoServicio | null) => {
        set({ filtroTipo: tipo });
        get().fetchServicios(tipo || undefined);
    },

    contratarServicio: async (servicioId: string) => {
        set({ isContratando: true, error: null });
        try {
            const response = await contratacionesApi.create(servicioId);
            if (response.success) {
                // Recargar el dashboard para actualizar estadísticas
                useDashboardStore.getState().fetchDashboard();
                return response.data;
            }
            return null;
        } catch (error: any) {
            const message = error.response?.data?.message || "Error al contratar servicio";
            set({ error: message });
            return null;
        } finally {
            set({ isContratando: false });
        }
    },

    clearServicioActual: () => set({ servicioActual: null }),

    clearError: () => set({ error: null }),
}));
