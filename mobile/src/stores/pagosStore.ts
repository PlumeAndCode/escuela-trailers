import { create } from "zustand";
import type { PagoResumen, PagosResumen, EstadoPago, TipoPago, PagoRealizado } from "../types";
import { pagosApi } from "../api/pagos";
import { useDashboardStore } from "./dashboardStore";

interface PagosState {
    pagos: PagoResumen[];
    resumen: PagosResumen | null;
    filtroEstado: EstadoPago | null;
    isLoading: boolean;
    isPagando: boolean;
    error: string | null;

    // Actions
    fetchPagos: (estado?: EstadoPago) => Promise<void>;
    setFiltro: (estado: EstadoPago | null) => void;
    procesarPago: (pagoId: string, tipoPago: TipoPago) => Promise<PagoRealizado | null>;
    refresh: () => Promise<void>;
    clearError: () => void;
}

export const usePagosStore = create<PagosState>((set, get) => ({
    pagos: [],
    resumen: null,
    filtroEstado: null,
    isLoading: false,
    isPagando: false,
    error: null,

    fetchPagos: async (estado?: EstadoPago) => {
        set({ isLoading: true, error: null });
        try {
            const response = await pagosApi.getAll(estado);
            if (response.success) {
                set({
                    pagos: response.data || [],
                    resumen: response.resumen || null,
                });
            } else {
                set({ pagos: [], resumen: null });
            }
        } catch (error: any) {
            console.log("Error fetching pagos:", error);
            set({ error: "Error al cargar pagos", pagos: [], resumen: null });
        } finally {
            set({ isLoading: false });
        }
    },

    setFiltro: (estado: EstadoPago | null) => {
        set({ filtroEstado: estado });
        get().fetchPagos(estado || undefined);
    },

    procesarPago: async (pagoId: string, tipoPago: TipoPago) => {
        set({ isPagando: true, error: null });
        try {
            const response = await pagosApi.pagar(pagoId, tipoPago);
            if (response.success) {
                // Refrescar la lista de pagos
                await get().refresh();
                // Recargar el dashboard para actualizar estadísticas
                useDashboardStore.getState().fetchDashboard();
                return response.data;
            }
            return null;
        } catch (error: any) {
            const message = error.response?.data?.message || "Error al procesar pago";
            set({ error: message });
            return null;
        } finally {
            set({ isPagando: false });
        }
    },

    refresh: async () => {
        const { filtroEstado, fetchPagos } = get();
        await fetchPagos(filtroEstado || undefined);
    },

    clearError: () => set({ error: null }),
}));
