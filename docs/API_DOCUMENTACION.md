# 📱 API REST - Escuela de Trailers

Documentación completa de la API REST para la aplicación móvil de la Escuela de Trailers.

## 📋 Información General

| Concepto          | Valor                          |
| ----------------- | ------------------------------ |
| **Base URL**      | `http://tu-dominio.com/api`    |
| **Autenticación** | Bearer Token (Laravel Sanctum) |
| **Formato**       | JSON                           |
| **Charset**       | UTF-8                          |

## 🔐 Autenticación

La API utiliza **Laravel Sanctum** para la autenticación mediante tokens.

### Flujo de autenticación:

1. El usuario inicia sesión con email y contraseña
2. La API devuelve un token de acceso
3. El token se incluye en el header `Authorization` de todas las peticiones siguientes

```
Authorization: Bearer {token}
```

> ⚠️ **Nota:** Solo los usuarios con rol `cliente` pueden acceder a la API móvil.

---

## 🔓 Endpoints Públicos

### POST `/api/login`

Iniciar sesión y obtener token de acceso.

**Request:**

```json
{
    "email": "usuario@gmail.com",
    "password": "secreta123",
    "device_name": "iPhone 15 Pro" // opcional
}
```

**Response (200 OK):**

```json
{
    "success": true,
    "message": "Inicio de sesión exitoso",
    "data": {
        "user": {
            "id": "019ae02f-3ede-728c-bf57-18ee6731d301",
            "nombre_completo": "Usuario Cliente",
            "email": "usuario@gmail.com",
            "telefono": "4431112233",
            "rol": "cliente",
            "email_verificado": true,
            "foto_perfil": "https://ui-avatars.com/api/?name=UC&color=7F9CF5&background=EBF4FF"
        },
        "token": "1|abc123xyz...",
        "token_type": "Bearer"
    }
}
```

**Errores posibles:**

| Código | Mensaje                                                    |
| ------ | ---------------------------------------------------------- |
| 422    | Las credenciales proporcionadas son incorrectas            |
| 422    | Tu cuenta ha sido desactivada                              |
| 422    | Solo los clientes pueden acceder desde la aplicación móvil |

---

## 🔒 Endpoints Protegidos

> Todos los siguientes endpoints requieren el header `Authorization: Bearer {token}`

---

### POST `/api/logout`

Cerrar sesión y revocar el token actual.

**Response (200 OK):**

```json
{
    "success": true,
    "message": "Sesión cerrada correctamente"
}
```

---

### GET `/api/perfil`

Obtener información del perfil del usuario autenticado.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "id": "019ae02f-3ede-728c-bf57-18ee6731d301",
        "nombre_completo": "Usuario Cliente",
        "email": "usuario@gmail.com",
        "telefono": "4431112233",
        "rol": "cliente",
        "email_verificado": true,
        "foto_perfil": "https://ui-avatars.com/api/?name=UC",
        "created_at": "2025-12-02 10:30:00"
    }
}
```

---

### PUT `/api/perfil`

Actualizar información del perfil.

**Request:**

```json
{
    "nombre_completo": "Juan García López",
    "telefono": "4439876543"
}
```

**Response (200 OK):**

```json
{
    "success": true,
    "message": "Perfil actualizado correctamente",
    "data": {
        "id": "019ae02f-3ede-728c-bf57-18ee6731d301",
        "nombre_completo": "Juan García López",
        "email": "usuario@gmail.com",
        "telefono": "4439876543"
    }
}
```

---

## 📊 Dashboard

### GET `/api/dashboard`

Obtener resumen general del usuario: estadísticas, próximos pagos y servicios recientes.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "usuario": {
            "nombre": "Usuario Cliente",
            "email": "usuario@gmail.com"
        },
        "estadisticas": {
            "servicios_activos": 2,
            "total_contrataciones": 3,
            "pagos_pendientes": 5,
            "monto_pendiente": 2570.0,
            "monto_pendiente_formateado": "$2,570.00",
            "cursos_inscritos": 1,
            "progreso_promedio": 62.5
        },
        "proximos_pagos": [
            {
                "id": "uuid-pago",
                "servicio": "Curso Básico de Manejo",
                "monto": 500.0,
                "monto_formateado": "$500.00",
                "fecha": "2025-12-15",
                "estado": "pendiente",
                "vencido": false
            }
        ],
        "servicios_recientes": [
            {
                "id": "uuid-contratacion",
                "servicio": "Curso Básico de Manejo",
                "tipo": "curso",
                "estado": "activo",
                "fecha": "2025-11-20"
            }
        ]
    }
}
```

---

## 🛒 Servicios

### GET `/api/servicios`

Listar todos los servicios activos disponibles.

**Parámetros de query (opcionales):**
| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| `tipo` | string | Filtrar por tipo: `curso`, `leccion`, `licencia`, `renta_trailer` |

**Ejemplo:** `/api/servicios?tipo=curso`

**Response (200 OK):**

```json
{
    "success": true,
    "data": [
        {
            "id": "uuid-servicio",
            "nombre": "Curso Básico de Manejo de Tráiler",
            "tipo": "curso",
            "descripcion": "Aprende los fundamentos del manejo de tráiler...",
            "precio": 15000.0,
            "precio_formateado": "$15,000.00"
        },
        {
            "id": "uuid-servicio-2",
            "nombre": "Lección de Estacionamiento",
            "tipo": "leccion",
            "descripcion": "Clase individual de estacionamiento...",
            "precio": 500.0,
            "precio_formateado": "$500.00"
        }
    ],
    "tipos_disponibles": ["curso", "leccion", "licencia", "renta_trailer"]
}
```

---

### GET `/api/servicios/{id}`

Obtener detalle de un servicio específico.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "id": "uuid-servicio",
        "nombre": "Curso Básico de Manejo de Tráiler",
        "tipo": "curso",
        "descripcion": "Aprende los fundamentos del manejo de tráiler con instructores certificados.",
        "precio": 15000.0,
        "precio_formateado": "$15,000.00",
        "activo": true
    }
}
```

**Error (404 Not Found):**

```json
{
    "success": false,
    "message": "Servicio no encontrado"
}
```

---

## 📑 Contrataciones

### GET `/api/contrataciones`

Listar todas las contrataciones del usuario.

**Parámetros de query (opcionales):**
| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| `estado` | string | Filtrar por estado: `pendiente`, `activo`, `finalizado` |
| `tipo` | string | Filtrar por tipo de servicio: `curso`, `leccion`, `licencia`, `renta_trailer` |

**Ejemplo:** `/api/contrataciones?estado=activo&tipo=curso`

**Response (200 OK):**

```json
{
    "success": true,
    "data": [
        {
            "id": "uuid-contratacion",
            "servicio": {
                "id": "uuid-servicio",
                "nombre": "Curso Básico de Manejo de Tráiler",
                "tipo": "curso",
                "precio": 15000.0
            },
            "fecha_contratacion": "2025-11-01",
            "estado": "activo",
            "pagos_pendientes": 2
        }
    ],
    "total": 1
}
```

---

### GET `/api/contrataciones/{id}`

Obtener detalle completo de una contratación.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "id": "uuid-contratacion",
        "servicio": {
            "id": "uuid-servicio",
            "nombre": "Curso Básico de Manejo de Tráiler",
            "tipo": "curso",
            "descripcion": "Aprende los fundamentos...",
            "precio": 15000.0
        },
        "fecha_contratacion": "2025-11-01",
        "estado": "activo",
        "curso": {
            "id": "uuid-curso",
            "nombre": "Curso Básico de Manejo de Tráiler",
            "descripcion": "...",
            "avance_porcentaje": 62.5,
            "total_lecciones": 8,
            "lecciones_completadas": 5
        },
        "pagos": {
            "total": 3,
            "pagados": 1,
            "pendientes": 2,
            "vencidos": 0,
            "monto_total": 15000.0,
            "monto_pagado": 5000.0
        }
    }
}
```

---

## 💰 Pagos

### GET `/api/pagos`

Listar todos los pagos del usuario.

**Parámetros de query (opcionales):**
| Parámetro | Tipo | Descripción |
|-----------|------|-------------|
| `estado` | string | Filtrar por estado: `pagado`, `pendiente`, `vencido` |

**Ejemplo:** `/api/pagos?estado=pendiente`

**Response (200 OK):**

```json
{
    "success": true,
    "data": [
        {
            "id": "uuid-pago",
            "servicio": "Curso Básico de Manejo de Tráiler",
            "monto": 5000.0,
            "monto_formateado": "$5,000.00",
            "fecha_pago": "2025-12-15",
            "tipo_pago": "tarjeta",
            "estado": "pendiente"
        },
        {
            "id": "uuid-pago-2",
            "servicio": "Curso Básico de Manejo de Tráiler",
            "monto": 5000.0,
            "monto_formateado": "$5,000.00",
            "fecha_pago": "2025-11-15",
            "tipo_pago": "efectivo",
            "estado": "pagado"
        }
    ],
    "resumen": {
        "total_pagos": 2,
        "pagados": 1,
        "pendientes": 1,
        "vencidos": 0,
        "monto_total_pagado": 5000.0,
        "monto_pendiente": 5000.0
    }
}
```

---

### GET `/api/pagos/{id}`

Obtener detalle de un pago específico.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "id": "uuid-pago",
        "contratacion_id": "uuid-contratacion",
        "servicio": {
            "nombre": "Curso Básico de Manejo de Tráiler",
            "tipo": "curso"
        },
        "monto": 5000.0,
        "monto_formateado": "$5,000.00",
        "fecha_pago": "2025-11-15",
        "tipo_pago": "efectivo",
        "estado": "pagado",
        "created_at": "2025-11-01 10:30:00"
    }
}
```

---

### GET `/api/pagos/{id}/comprobante`

Descargar comprobante de pago en formato PDF.

> ⚠️ Solo disponible para pagos con estado `pagado`.

**Response (200 OK):**

- Content-Type: `application/pdf`
- Content-Disposition: `attachment; filename="comprobante-{id}.pdf"`

**Error (404 Not Found):**

```json
{
    "success": false,
    "message": "Comprobante no disponible. El pago debe estar pagado."
}
```

---

## 📚 Cursos y Progreso

### GET `/api/cursos`

Listar todos los cursos del usuario.

**Response (200 OK):**

```json
{
    "success": true,
    "data": [
        {
            "id": "uuid-curso",
            "nombre": "Curso Básico de Manejo de Tráiler",
            "descripcion": "Aprende los fundamentos...",
            "avance_porcentaje": 62.5,
            "total_lecciones": 8,
            "lecciones_completadas": 5,
            "estado_contratacion": "activo"
        }
    ],
    "total": 1
}
```

---

### GET `/api/cursos/{id}/progreso`

Obtener progreso detallado de un curso con todas sus lecciones.

**Response (200 OK):**

```json
{
    "success": true,
    "data": {
        "curso": {
            "id": "uuid-curso",
            "nombre": "Curso Básico de Manejo de Tráiler",
            "descripcion": "Aprende los fundamentos del manejo..."
        },
        "progreso": {
            "porcentaje": 62.5,
            "total_lecciones": 8,
            "completadas": 5,
            "restantes": 3
        },
        "lecciones": [
            {
                "id": "uuid-leccion-1",
                "numero": 1,
                "titulo": "Introducción al tráiler",
                "descripcion": "Conoce las partes del tráiler...",
                "duracion_minutos": 60,
                "estado": "completada",
                "completada": true,
                "en_progreso": false,
                "bloqueada": false
            },
            {
                "id": "uuid-leccion-2",
                "numero": 2,
                "titulo": "Técnicas de arranque",
                "descripcion": "Aprende a arrancar correctamente...",
                "duracion_minutos": 90,
                "estado": "completada",
                "completada": true,
                "en_progreso": false,
                "bloqueada": false
            },
            {
                "id": "uuid-leccion-6",
                "numero": 6,
                "titulo": "Maniobras en reversa",
                "descripcion": "Domina las maniobras en reversa...",
                "duracion_minutos": 120,
                "estado": "en_progreso",
                "completada": false,
                "en_progreso": true,
                "bloqueada": false
            },
            {
                "id": "uuid-leccion-7",
                "numero": 7,
                "titulo": "Estacionamiento",
                "descripcion": "Técnicas de estacionamiento...",
                "duracion_minutos": 90,
                "estado": "bloqueada",
                "completada": false,
                "en_progreso": false,
                "bloqueada": true
            }
        ]
    }
}
```

---

## 🚨 Códigos de Error

### Errores de autenticación

| Código | Descripción                                   |
| ------ | --------------------------------------------- |
| 401    | Token inválido o expirado                     |
| 403    | No tienes permiso para acceder a este recurso |

**Response (401 Unauthorized):**

```json
{
    "message": "Unauthenticated."
}
```

### Errores de validación

**Response (422 Unprocessable Entity):**

```json
{
    "message": "The email field is required.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

### Errores del servidor

| Código | Descripción                |
| ------ | -------------------------- |
| 404    | Recurso no encontrado      |
| 500    | Error interno del servidor |

---

## 📱 Ejemplo de Implementación (React Native)

```javascript
// api.js
import axios from "axios";
import AsyncStorage from "@react-native-async-storage/async-storage";

const API_URL = "http://tu-dominio.com/api";

const api = axios.create({
    baseURL: API_URL,
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
});

// Interceptor para agregar token
api.interceptors.request.use(async (config) => {
    const token = await AsyncStorage.getItem("token");
    if (token) {
        config.headers.Authorization = `Bearer ${token}`;
    }
    return config;
});

// Login
export const login = async (email, password) => {
    const response = await api.post("/login", { email, password });
    await AsyncStorage.setItem("token", response.data.data.token);
    return response.data;
};

// Logout
export const logout = async () => {
    await api.post("/logout");
    await AsyncStorage.removeItem("token");
};

// Dashboard
export const getDashboard = async () => {
    const response = await api.get("/dashboard");
    return response.data;
};

// Pagos
export const getPagos = async (estado = null) => {
    const params = estado ? { estado } : {};
    const response = await api.get("/pagos", { params });
    return response.data;
};

// Cursos
export const getCursos = async () => {
    const response = await api.get("/cursos");
    return response.data;
};

// Progreso de curso
export const getProgresoCurso = async (cursoId) => {
    const response = await api.get(`/cursos/${cursoId}/progreso`);
    return response.data;
};

export default api;
```

---

## 🧪 Testing con cURL

```bash
# Login
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"usuario@gmail.com","password":"secreta123"}'

# Dashboard (con token)
curl -X GET http://localhost:8000/api/dashboard \
  -H "Authorization: Bearer 1|tu-token-aqui"

# Pagos pendientes
curl -X GET "http://localhost:8000/api/pagos?estado=pendiente" \
  -H "Authorization: Bearer 1|tu-token-aqui"

# Progreso de curso
curl -X GET http://localhost:8000/api/cursos/{uuid}/progreso \
  -H "Authorization: Bearer 1|tu-token-aqui"
```

---

## 📌 Credenciales de Prueba

| Rol     | Email                      | Contraseña   |
| ------- | -------------------------- | ------------ |
| Cliente | `usuario@gmail.com`        | `secreta123` |
| Cliente | `luis.martinez@gmail.com`  | `secreta123` |
| Cliente | `sofia.gonzalez@gmail.com` | `secreta123` |

> ⚠️ Solo los usuarios con rol `cliente` pueden acceder a la API móvil.

---

## 📄 Changelog

### v1.0.0 (2025-12-02)

- ✅ Implementación inicial de la API
- ✅ Autenticación con Laravel Sanctum
- ✅ Endpoints de Dashboard, Servicios, Contrataciones, Pagos y Cursos
- ✅ Soporte para UUIDs en todos los modelos
- ✅ Descarga de comprobantes en PDF
