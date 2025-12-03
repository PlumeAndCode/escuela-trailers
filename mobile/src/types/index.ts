// ==========================================
// TIPOS DE LA API - ESCUELA DE TRAILERS
// ==========================================

// --- Usuario ---
export interface User {
    id: string;
    nombre_completo: string;
    email: string;
    telefono: string | null;
    rol: "cliente" | "encargado" | "administrador";
    email_verificado: boolean;
    foto_perfil: string;
    created_at?: string;
}

// --- Auth ---
export interface LoginRequest {
    email: string;
    password: string;
    device_name?: string;
}

export interface LoginResponse {
    success: boolean;
    message: string;
    data: {
        user: User;
        token: string;
        token_type: string;
    };
}

// --- Dashboard ---
export interface DashboardStats {
    servicios_activos: number;
    total_contrataciones: number;
    pagos_pendientes: number;
    monto_pendiente: number;
    monto_pendiente_formateado: string;
    cursos_inscritos: number;
    progreso_promedio: number;
}

export interface ProximoPago {
    id: string;
    servicio: string;
    monto: number;
    monto_formateado: string;
    fecha: string;
    estado: "pendiente" | "vencido";
    vencido: boolean;
}

export interface ServicioReciente {
    id: string;
    servicio: string;
    tipo: TipoServicio;
    estado: "pendiente" | "activo";
    fecha: string;
}

export interface DashboardData {
    usuario: {
        nombre: string;
        email: string;
    };
    estadisticas: DashboardStats;
    proximos_pagos: ProximoPago[];
    servicios_recientes: ServicioReciente[];
}

// --- Servicios ---
export type TipoServicio = "curso" | "leccion" | "licencia" | "renta_trailer";

export interface Servicio {
    id: string;
    nombre: string;
    tipo: TipoServicio;
    descripcion: string;
    precio: number;
    precio_formateado: string;
    activo?: boolean;
}

// --- Contrataciones ---
export type EstadoContratacion = "pendiente" | "activo" | "finalizado";

export interface ContratacionResumen {
    id: string;
    servicio: {
        id: string;
        nombre: string;
        tipo: TipoServicio;
        precio: number;
    };
    fecha_contratacion: string;
    estado: EstadoContratacion;
    pagos_pendientes: number;
}

export interface ContratacionDetalle extends ContratacionResumen {
    curso?: {
        id: string;
        nombre: string;
        descripcion: string;
        avance_porcentaje: number;
        total_lecciones: number;
        lecciones_completadas: number;
    };
    pagos: {
        total: number;
        pagados: number;
        pendientes: number;
        vencidos: number;
        monto_total: number;
        monto_pagado: number;
    };
}

// --- Pagos ---
export type EstadoPago = "pagado" | "pendiente" | "vencido";
export type TipoPago = "efectivo" | "tarjeta" | "linea";

export interface PagoResumen {
    id: string;
    servicio: string;
    monto: number;
    monto_formateado: string;
    fecha_pago: string;
    tipo_pago: TipoPago;
    estado: EstadoPago;
}

export interface PagoDetalle extends PagoResumen {
    contratacion_id: string;
    created_at: string;
}

export interface PagosResumen {
    total_pagos: number;
    pagados: number;
    pendientes: number;
    vencidos: number;
    monto_total_pagado: number;
    monto_pendiente: number;
}

// --- Cursos ---
export type EstadoLeccion = "completada" | "en_progreso" | "no_iniciada" | "bloqueada";

export interface CursoResumen {
    id: string;
    nombre: string;
    descripcion: string;
    avance_porcentaje: number;
    total_lecciones: number;
    lecciones_completadas: number;
    estado_contratacion: EstadoContratacion;
}

export interface Leccion {
    id: string;
    numero: number;
    titulo: string;
    descripcion: string;
    duracion_minutos: number;
    estado: EstadoLeccion;
    completada: boolean;
    en_progreso: boolean;
    bloqueada: boolean;
}

export interface CursoProgreso {
    curso: {
        id: string;
        nombre: string;
        descripcion: string;
    };
    progreso: {
        porcentaje: number;
        total_lecciones: number;
        completadas: number;
        restantes: number;
    };
    lecciones: Leccion[];
}

// --- API Response ---
export interface ApiResponse<T> {
    success: boolean;
    message?: string;
    data: T;
}

export interface ApiError {
    message: string;
    errors?: Record<string, string[]>;
}

// --- Contratación creada ---
export interface ContratacionCreada {
    id: string;
    servicio: {
        id: string;
        nombre: string;
        tipo: TipoServicio;
        precio: number;
        precio_formateado: string;
    };
    fecha_contratacion: string;
    estado: EstadoContratacion;
    pago: {
        id: string;
        monto: number;
        monto_formateado: string;
        fecha_limite: string;
        estado: EstadoPago;
    };
}

// --- Pago realizado ---
export interface PagoRealizado {
    id: string;
    servicio: string;
    monto: number;
    monto_formateado: string;
    fecha_pago: string;
    tipo_pago: TipoPago;
    estado: EstadoPago;
    contratacion_activa: boolean;
}

// --- Update Perfil ---
export interface UpdatePerfilRequest {
    nombre_completo?: string;
    telefono?: string;
}
