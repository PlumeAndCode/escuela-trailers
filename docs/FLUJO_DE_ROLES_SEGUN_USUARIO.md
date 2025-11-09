# Sistema de Roles y Permisos - Escuela Trailers

## Descripción

Sistema de gestión de roles y permisos implementado con Spatie/laravel-permission para controlar el acceso de diferentes tipos de usuarios en la aplicación.

## Roles Disponibles

### 1. **Administrador**

- Acceso completo a todas las funcionalidades del sistema
- Gestión de usuarios, servicios, cursos, lecciones, etc.
- Visualización de reportes completos
- Permisos:
    - Crear, editar, eliminar y ver usuarios
    - Crear, editar, eliminar y ver servicios
    - Crear, editar, eliminar y ver contrataciones
    - Crear, editar, eliminar y ver cursos
    - Crear, editar, eliminar y ver lecciones
    - Crear, editar, eliminar y ver procedimientos de licencia
    - Crear, editar, eliminar y ver tráileres
    - Crear, editar, eliminar y ver rentas
    - Crear, editar, eliminar y ver pagos
    - Ver reportes
    - Ver dashboard

### 2. **Encargado**

- Gestión de contenido educativo y cursos
- Seguimiento de contrataciones y lecciones
- Gestión de rentas de tráileres
- Permisos restringidos para:
    - Ver usuarios (sin editar)
    - Ver servicios (sin editar)
    - Crear, editar y ver contrataciones
    - Crear, editar y ver cursos
    - Crear, editar y ver lecciones
    - Crear, editar y ver procedimientos de licencia
    - Ver tráileres (sin editar)
    - Crear, editar y ver rentas
    - Ver pagos (sin editar)
    - Ver reportes
    - Ver dashboard

### 3. **Cliente**

- Acceso limitado a sus propias contrataciones
- Visualización de servicios y cursos
- Seguimiento de progreso
- Permisos de solo lectura:
    - Ver servicios
    - Ver contrataciones
    - Ver cursos
    - Ver lecciones
    - Ver rentas
    - Ver pagos
    - Ver dashboard

## Estructura de Permisos

Los permisos disponibles están organizados por módulo:

### Gestión de Usuarios

- `create_users` - Crear nuevos usuarios
- `edit_users` - Editar usuarios existentes
- `delete_users` - Eliminar usuarios
- `view_users` - Ver listado de usuarios

### Gestión de Servicios

- `create_services` - Crear nuevos servicios
- `edit_services` - Editar servicios
- `delete_services` - Eliminar servicios
- `view_services` - Ver servicios

### Contrataciones

- `create_hierings` - Crear contrataciones
- `edit_hierings` - Editar contrataciones
- `delete_hierings` - Eliminar contrataciones
- `view_hierings` - Ver contrataciones

### Cursos

- `create_courses` - Crear cursos
- `edit_courses` - Editar cursos
- `delete_courses` - Eliminar cursos
- `view_courses` - Ver cursos

### Lecciones

- `create_lessons` - Crear lecciones
- `edit_lessons` - Editar lecciones
- `delete_lessons` - Eliminar lecciones
- `view_lessons` - Ver lecciones

### Procedimientos de Licencia

- `create_license_procedures` - Crear procedimientos
- `edit_license_procedures` - Editar procedimientos
- `delete_license_procedures` - Eliminar procedimientos
- `view_license_procedures` - Ver procedimientos

### Tráileres

- `create_trailers` - Crear tráileres
- `edit_trailers` - Editar tráileres
- `delete_trailers` - Eliminar tráileres
- `view_trailers` - Ver tráileres

### Rentas de Tráileres

- `create_rentals` - Crear rentas
- `edit_rentals` - Editar rentas
- `delete_rentals` - Eliminar rentas
- `view_rentals` - Ver rentas

### Pagos

- `create_payments` - Crear pagos
- `edit_payments` - Editar pagos
- `delete_payments` - Eliminar pagos
- `view_payments` - Ver pagos

### General

- `view_reports` - Ver reportes
- `view_dashboard` - Ver dashboard

## Middlewares Disponibles

### CheckRole

Verifica que el usuario tenga uno de los roles especificados.

**Uso:**

```php
Route::middleware('role:administrador,encargado')->group(function () {
    // Rutas protegidas por rol
});
```

**En controladores:**

```php
$this->middleware('role:administrador')->only(['store', 'update', 'destroy']);
```

### CheckPermission

Verifica que el usuario tenga uno de los permisos especificados.

**Uso:**

```php
Route::middleware('permission:create_users,edit_users')->group(function () {
    // Rutas protegidas por permiso
});
```

**En controladores:**

```php
$this->middleware('permission:view_courses')->only(['index', 'show']);
```

## Campos del Usuario

Los usuarios ahora incluyen los siguientes campos:

- `id` (UUID) - Identificador único
- `nombre_completo` - Nombre completo del usuario
- `telefono` - Número telefónico (opcional)
- `email` - Correo electrónico único
- `password` - Contraseña cifrada
- `rol` - ENUM: `administrador`, `encargado`, `cliente` (por defecto: `cliente`)
- `estado_usuario` - Booleano que indica si está activo (por defecto: `true`)
- `created_at` - Fecha de creación
- `updated_at` - Fecha de última actualización

## Proceso de Registro

Al registrarse, un nuevo usuario:

1. Se crea con rol por defecto: `cliente`
2. Se asigna el rol `cliente` automáticamente
3. Se establece `estado_usuario` en `true` (activo)
4. Solo puede acceder a funcionalidades de cliente

## Instalación y Configuración

### 1. El paquete ya está instalado

```bash
composer require spatie/laravel-permission
```

### 2. Publicar la configuración

```bash
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

### 3. Ejecutar las migraciones

```bash
php artisan migrate
```

### 4. Sembrar roles y permisos iniciales

```bash
php artisan db:seed --class=RoleAndPermissionSeeder
```

### 5. Sembrar datos de prueba (con usuarios de cada rol)

```bash
php artisan db:seed --class=DatabaseSeeder
```

## Verificación de Roles y Permisos en Vistas

### Verificar si el usuario tiene un rol

```blade
@if(auth()->user()->hasRole('administrador'))
    <!-- Solo para administradores -->
@endif

@role('encargado')
    <!-- Solo para encargados -->
@endrole

@if(auth()->user()->hasAnyRole(['administrador', 'encargado']))
    <!-- Para administradores o encargados -->
@endif
```

### Verificar si el usuario tiene un permiso

```blade
@if(auth()->user()->hasPermissionTo('create_users'))
    <!-- Botón para crear usuarios -->
@endif

@can('edit_courses')
    <!-- Solo si tiene permiso de editar cursos -->
@endcan
```

## Verificación en Controladores

```php
public function store(StoreUserRequest $request)
{
    // Verificar rol
    if (auth()->user()->hasRole('administrador')) {
        // Solo administrador puede crear usuarios
    }

    // Verificar permiso
    if (auth()->user()->hasPermissionTo('create_users')) {
        // Crear usuario
    }

    // Lanzar excepción si no tiene permiso
    $this->authorize('create_users');
}
```

## Estados del Usuario

- `estado_usuario = true` → Usuario activo, puede acceder al sistema
- `estado_usuario = false` → Usuario inactivo, no puede acceder

## Datos de Prueba Iniciales

Al ejecutar el seeder, se crean 3 usuarios de prueba:

1. **Administrador**
    - Email: `admin@escuela-trailers.com`
    - Nombre: `Administrador`
    - Contraseña: `password`
    - Rol: `administrador`

2. **Encargado**
    - Email: `manager@escuela-trailers.com`
    - Nombre: `Encargado`
    - Contraseña: `password`
    - Rol: `encargado`

3. **Cliente**
    - Email: `client@escuela-trailers.com`
    - Nombre: `Cliente`
    - Contraseña: `password`
    - Rol: `cliente`

## Ejemplos de Uso

### Proteger una ruta por rol

```php
Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware('role:administrador');
```

### Proteger una ruta por permiso

```php
Route::post('/users', [UserController::class, 'store'])->middleware('permission:create_users');
```

### Asignar rol a un usuario

```php
$user = User::find($userId);
$user->assignRole('encargado');
```

### Asignar permiso a un usuario

```php
$user = User::find($userId);
$user->givePermissionTo('create_courses');
```

### Remover rol de un usuario

```php
$user = User::find($userId);
$user->removeRole('cliente');
```

### Verificar acceso en tiempo real

```php
if (!auth()->user()->estado_usuario) {
    auth()->logout();
    return redirect('/login')->with('error', 'Tu cuenta ha sido desactivada');
}
```

## Notas Importantes

1. **UUID**: Los usuarios ahora usan UUID como identificador único en lugar de autoincrement.

2. **Estado del Usuario**: Siempre verificar el estado del usuario en operaciones críticas.

3. **Rol por Defecto**: Todos los usuarios registrados obtienen el rol `cliente` automáticamente.

4. **Cache de Permisos**: Spatie cachea los permisos. Después de crear o modificar permisos, ejecutar:

    ```bash
    php artisan cache:forget spatie.permission.cache
    ```

5. **Verificación de Actividad**: Las rutas protegidas verifican automáticamente si el usuario está activo.

## Próximos Pasos

1. Implementar las migraciones para las tablas adicionales (servicios, contrataciones, cursos, etc.)
2. Crear controladores con protecciones de rol y permiso
3. Actualizar vistas para mostrar/ocultar elementos según permisos
4. Implementar auditoría de acciones de usuarios administrativos
