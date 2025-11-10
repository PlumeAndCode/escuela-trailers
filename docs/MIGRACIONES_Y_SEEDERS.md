# Sistema de Base de Datos - Escuela de Manejo de Tráileres

## Resumen de Implementación

Se han creado exitosamente **10 migraciones** y **10 seeders** para el sistema de gestión de la escuela de manejo de tráileres.

---

## Migraciones Creadas

### 1. `2025_11_10_000001_create_servicios_table.php`

**Descripción:** Catálogo de servicios que ofrece la escuela (cursos, lecciones, licencias, renta de tráileres).

**Campos:**

- `id` (UUID, PK)
- `nombre_servicio` (TEXT)
- `tipo_servicio` (ENUM: curso, leccion, licencia, renta_trailer)
- `descripcion` (TEXT)
- `precio` (DECIMAL 10,2)
- `estado_servicio` (BOOLEAN, default: true)

---

### 2. `2025_11_10_000002_create_contrataciones_table.php`

**Descripción:** Registro de servicios contratados por usuarios.

**Campos:**

- `id` (UUID, PK)
- `id_usuario` (UUID, FK → users.id)
- `id_servicio` (UUID, FK → servicios.id)
- `fecha_contratacion` (TIMESTAMP)
- `estado_contratacion` (ENUM: pendiente, activo, finalizado)

---

### 3. `2025_11_10_000003_create_cursos_table.php`

**Descripción:** Gestión de cursos completos contratados.

**Campos:**

- `id` (UUID, PK)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `nombre_curso` (TEXT)
- `descripcion` (TEXT)
- `avance_porcentaje` (DECIMAL 5,2, default: 0.00)

---

### 4. `2025_11_10_000004_create_lecciones_table.php`

**Descripción:** Lecciones individuales que componen cada curso.

**Campos:**

- `id` (UUID, PK)
- `id_curso` (UUID, FK → cursos.id)
- `nombre_leccion` (TEXT)
- `descripcion` (TEXT)
- `estado_leccion` (ENUM: no_iniciada, en_progreso, completada, bloqueada)
- `observaciones` (TEXT, nullable)

---

### 5. `2025_11_10_000005_create_avance_leccion_table.php`

**Descripción:** Control del progreso de cada usuario en cada lección.

**Campos:**

- `id` (UUID, PK)
- `id_leccion` (UUID, FK → lecciones.id)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `estado_avance` (ENUM: pendiente, vista, pagada)

---

### 6. `2025_11_10_000006_create_lecciones_individuales_table.php`

**Descripción:** Lecciones contratadas de forma individual (no parte de un curso).

**Campos:**

- `id` (UUID, PK)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `fecha_programada` (TIMESTAMP)
- `estado_leccion` (ENUM: no_iniciada, en_progreso, completada, bloqueada)
- `observaciones` (TEXT, nullable)

---

### 7. `2025_11_10_000007_create_tramites_licencia_table.php`

**Descripción:** Seguimiento de trámites de licencia de conducir.

**Campos:**

- `id` (UUID, PK)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `tipo_licencia` (ENUM: A, B, C, D, E)
- `estado_tramite` (ENUM: proceso, completado, cancelado)

---

### 8. `2025_11_10_000008_create_trailers_table.php`

**Descripción:** Inventario de tráileres disponibles.

**Campos:**

- `id` (UUID, PK)
- `modelo` (TEXT)
- `numero_serie` (TEXT, unique)
- `placa` (TEXT, unique)
- `estado_trailer` (ENUM: disponible, rentado, mantenimiento)

---

### 9. `2025_11_10_000009_create_rentas_trailer_table.php`

**Descripción:** Registro de rentas de tráileres.

**Campos:**

- `id` (UUID, PK)
- `id_trailer` (UUID, FK → trailers.id)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `fecha_renta` (TIMESTAMP)
- `fecha_devolucion_estimada` (TIMESTAMP)
- `fecha_devolucion_real` (TIMESTAMP, nullable)
- `estado_renta` (ENUM: activa, devuelta, atrasada)

---

### 10. `2025_11_10_000010_create_pagos_table.php`

**Descripción:** Registro de pagos asociados a contrataciones.

**Campos:**

- `id` (UUID, PK)
- `id_contratacion` (UUID, FK → contrataciones.id)
- `fecha_pago` (TIMESTAMP)
- `monto_pagado` (DECIMAL 10,2)
- `tipo_pago` (ENUM: efectivo, tarjeta, linea)
- `estado_pago` (ENUM: pendiente, pagado, vencido)

---

## Seeders Creados

### 1. ServiciosSeeder

Genera **8 servicios** de prueba:

- 2 servicios tipo CURSO
- 2 servicios tipo LECCION
- 2 servicios tipo LICENCIA
- 2 servicios tipo RENTA_TRAILER

### 2. TrailersSeeder

Genera **6 tráileres** con diferentes modelos y estados (disponible, rentado, mantenimiento).

### 3. ContratacionesSeeder

Genera **10 contrataciones** asociando usuarios con servicios en diferentes estados (pendiente, activo, finalizado).

### 4. CursosSeeder

Genera **2 cursos** asociados a contrataciones activas con diferentes porcentajes de avance.

### 5. LeccionesSeeder

Genera **16 lecciones** (8 por curso) con diferentes estados de progreso.

### 6. AvanceLeccionSeeder

Genera registros de avance para todas las lecciones creadas, vinculando cada lección con su contratación.

### 7. LeccionesIndividualesSeeder

Genera lecciones individuales programadas para contrataciones de tipo lección.

### 8. TramitesLicenciaSeeder

Genera trámites de licencia para contrataciones de tipo licencia con diferentes tipos (A, B, C, D, E).

### 9. RentasTrailerSeeder

Genera **3 rentas** de tráileres con diferentes estados (activa, devuelta, atrasada).

### 10. PagosSeeder

Genera **14 pagos** con diferentes estados (pendiente, pagado, vencido) y métodos de pago.

---

## Orden de Ejecución

Los seeders se ejecutan en el siguiente orden (definido en `DatabaseSeeder.php`):

1. `RoleAndPermissionSeeder` - Sistema de roles y permisos
2. `ServiciosSeeder` - Catálogo de servicios
3. `TrailersSeeder` - Inventario de tráileres
4. `ContratacionesSeeder` - Contrataciones de usuarios
5. `CursosSeeder` - Cursos asociados a contrataciones
6. `LeccionesSeeder` - Lecciones de cada curso
7. `AvanceLeccionSeeder` - Avance de estudiantes en lecciones
8. `LeccionesIndividualesSeeder` - Lecciones individuales
9. `TramitesLicenciaSeeder` - Trámites de licencia
10. `RentasTrailerSeeder` - Rentas de tráileres
11. `PagosSeeder` - Registro de pagos

---

## Relaciones entre Tablas

```
users
  └── contrataciones
       ├── cursos
       │    └── lecciones
       │         └── avance_leccion
       ├── lecciones_individuales
       ├── tramites_licencia
       ├── rentas_trailer (+ trailers)
       └── pagos

servicios
  └── contrataciones

trailers
  └── rentas_trailer
```

---

## Comandos Útiles

### Ejecutar migraciones y seeders

```bash
php artisan migrate:fresh --seed
```

### Ejecutar solo seeders

```bash
php artisan db:seed
```

### Ejecutar un seeder específico

```bash
php artisan db:seed --class=ServiciosSeeder
```

### Verificar datos insertados

```bash
php artisan tinker
>>> DB::table('servicios')->count();
>>> DB::table('contrataciones')->count();
>>> DB::table('pagos')->get();
```

---

## Validación Final

✅ **Todas las migraciones ejecutan sin errores**  
✅ **Todos los seeders generan datos consistentes**  
✅ **Las relaciones de llaves foráneas funcionan correctamente**  
✅ **Los ENUMs están definidos correctamente**  
✅ **Los campos UUID funcionan como primary keys**  
✅ **Los valores default se aplican correctamente**

---

## Datos de Prueba Generados

- **Usuarios:** 8 (3 base + 5 adicionales con rol cliente)
- **Servicios:** 8 (2 de cada tipo)
- **Tráileres:** 6
- **Contrataciones:** 10
- **Cursos:** 2
- **Lecciones:** 16 (8 por curso)
- **Avances de lección:** 16
- **Lecciones individuales:** Variable según contrataciones
- **Trámites de licencia:** Variable según contrataciones
- **Rentas de tráiler:** 3
- **Pagos:** 14

---

## Notas Importantes

1. **UUIDs:** Todos los IDs utilizan UUID en lugar de integers incrementales.
2. **Cascade Delete:** Las llaves foráneas están configuradas con `onDelete('cascade')`.
3. **Timestamps:** Todas las tablas incluyen `created_at` y `updated_at`.
4. **Estados Consistentes:** Los seeders generan datos con estados coherentes entre tablas relacionadas.
5. **Datos Realistas:** Los montos, fechas y descripciones son realistas para un contexto de escuela de manejo.

---

## Autor

Sistema desarrollado para la Escuela de Manejo de Tráileres  
Fecha: Noviembre 10, 2025
