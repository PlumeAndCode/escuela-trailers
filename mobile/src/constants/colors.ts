export const Colors = {
    primary: {
        50: "#fffbeb",
        100: "#fef3c7",
        200: "#fde68a",
        300: "#fcd34d",
        400: "#fbbf24",
        500: "#f59e0b",
        600: "#d97706",
        700: "#b45309",
        800: "#92400e",
        900: "#78350f",
    },
    secondary: {
        50: "#f8fafc",
        100: "#f1f5f9",
        200: "#e2e8f0",
        300: "#cbd5e1",
        400: "#94a3b8",
        500: "#64748b",
        600: "#475569",
        700: "#334155",
        800: "#1e293b",
        900: "#0f172a",
    },
    success: "#22c55e",
    warning: "#f59e0b",
    error: "#ef4444",
    info: "#3b82f6",
    white: "#ffffff",
    black: "#000000",
};

export const StatusColors: Record<string, string> = {
    pagado: "#22c55e",
    pendiente: "#f59e0b",
    vencido: "#ef4444",
    activo: "#22c55e",
    finalizado: "#3b82f6",
    completada: "#22c55e",
    en_progreso: "#3b82f6",
    no_iniciada: "#94a3b8",
    bloqueada: "#6b7280",
};

export const TipoServicioLabels: Record<string, string> = {
    curso: "Curso",
    leccion: "Lección",
    licencia: "Licencia",
    renta_trailer: "Renta de Tráiler",
};

export const TipoServicioIcons: Record<string, string> = {
    curso: "school",
    leccion: "book",
    licencia: "card",
    renta_trailer: "car",
};
