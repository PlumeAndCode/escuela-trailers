import { create } from "zustand";
import type { CursoResumen, CursoProgreso } from "../types";
import { cursosApi } from "../api/cursos";

interface CursosState {
    cursos: CursoResumen[];
    cursoActual: CursoProgreso | null;
    isLoading: boolean;
    error: string | null;

    // Actions
    fetchCursos: () => Promise<void>;
    fetchProgreso: (id: string) => Promise<void>;
    clearCursoActual: () => void;
}

export const useCursosStore = create<CursosState>((set) => ({
    cursos: [],
    cursoActual: null,
    isLoading: false,
    error: null,

    fetchCursos: async () => {
        set({ isLoading: true, error: null });
        try {
            const response = await cursosApi.getAll();
            if (response.success && response.data) {
                set({ cursos: response.data || [] });
            } else {
                set({ cursos: [] });
            }
        } catch (error: any) {
            set({ error: "Error al cargar cursos", cursos: [] });
        } finally {
            set({ isLoading: false });
        }
    },

    fetchProgreso: async (id: string) => {
        set({ isLoading: true, error: null });
        try {
            const response = await cursosApi.getProgreso(id);
            if (response.success) {
                set({ cursoActual: response.data });
            }
        } catch (error: any) {
            set({ error: "Error al cargar progreso" });
        } finally {
            set({ isLoading: false });
        }
    },

    clearCursoActual: () => set({ cursoActual: null }),
}));
