# Ejemplos de Uso - Sistema de Roles y Permisos

## Comandos Útiles

### Verificar Estado de Roles y Permisos
```bash
php artisan verify:roles
```

### Sembrar Datos Iniciales
```bash
# Crear roles y permisos
php artisan db:seed --class=RoleAndPermissionSeeder

# Crear usuarios de prueba
php artisan db:seed --class=DatabaseSeeder

# Sembrar todo
php artisan migrate --seed
```

### Limpiar Cache de Permisos (Después de cambios)
```bash
php artisan cache:forget spatie.permission.cache
```

---

## Ejemplos en Controladores

### Proteger un Controlador Completo por Rol

```php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        // Proteger todas las acciones por rol
        $this->middleware('role:administrador');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
```

### Proteger Acciones Específicas por Rol

```php
public function __construct()
{
    // Solo administrador puede crear y eliminar
    $this->middleware('role:administrador')->only(['create', 'store', 'destroy']);
    
    // Administrador y encargado pueden ver
    $this->middleware('role:administrador,encargado')->only(['index', 'show']);
}
```

### Proteger por Permiso

```php
public function __construct()
{
    $this->middleware('permission:create_users')->only(['create', 'store']);
    $this->middleware('permission:edit_users')->only(['edit', 'update']);
    $this->middleware('permission:delete_users')->only(['destroy']);
    $this->middleware('permission:view_users')->only(['index', 'show']);
}
```

### Verificar Permisos en Métodos

```php
public function store(Request $request)
{
    // Verificar permiso
    if (!auth()->user()->hasPermissionTo('create_users')) {
        abort(403, 'No tienes permiso para crear usuarios');
    }

    // O usar authorize
    $this->authorize('create_users');

    // Lógica del controlador...
}
```

---

## Ejemplos en Vistas Blade

### Mostrar Contenido Según Rol

```blade
@if(auth()->user()->hasRole('administrador'))
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Panel Administrador</a>
@elseif(auth()->user()->hasRole('encargado'))
    <a href="{{ route('manager.dashboard') }}" class="btn btn-info">Panel Encargado</a>
@else
    <a href="{{ route('client.dashboard') }}" class="btn btn-secondary">Mi Cuenta</a>
@endif
```

### Usar Directivas de Rol

```blade
@role('administrador')
    <div class="admin-section">
        <h2>Sección de Administración</h2>
        <!-- Contenido solo para administradores -->
    </div>
@endrole

@hasrole('encargado|administrador')
    <button class="btn btn-warning">Gestionar Cursos</button>
@endhasrole
```

### Verificar Permisos

```blade
@can('create_users')
    <a href="{{ route('users.create') }}" class="btn btn-success">Crear Usuario</a>
@endcan

@if(auth()->user()->hasPermissionTo('edit_courses'))
    <a href="{{ route('courses.edit', $course) }}" class="btn btn-primary">Editar</a>
@endif
```

### Verificar Estado del Usuario

```blade
@if(auth()->check())
    @if(!auth()->user()->estado_usuario)
        <div class="alert alert-danger">
            Tu cuenta ha sido desactivada. Contacta al administrador.
        </div>
    @else
        <!-- Contenido disponible -->
    @endif
@endif
```

---

## Ejemplos en Rutas

### Proteger Grupo de Rutas por Rol

```php
// routes/web.php

// Rutas de administración
Route::middleware(['auth', 'role:administrador'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('services', ServiceController::class);
    Route::get('/reports', [ReportController::class, 'index']);
});

// Rutas de encargado
Route::middleware(['auth', 'role:encargado'])->group(function () {
    Route::resource('courses', CourseController::class);
    Route::resource('lessons', LessonController::class);
    Route::get('/enrollments', [EnrollmentController::class, 'index']);
});

// Rutas de cliente
Route::middleware(['auth', 'role:cliente'])->group(function () {
    Route::get('/my-courses', [StudentController::class, 'courses']);
    Route::get('/my-lessons', [StudentController::class, 'lessons']);
    Route::get('/my-payments', [StudentController::class, 'payments']);
});
```

### Proteger Rutas por Permiso

```php
Route::post('/users', [UserController::class, 'store'])
    ->middleware('permission:create_users');

Route::put('/users/{user}', [UserController::class, 'update'])
    ->middleware('permission:edit_users');

Route::delete('/users/{user}', [UserController::class, 'destroy'])
    ->middleware('permission:delete_users');
```

---

## Ejemplos Programáticos

### Crear Rol y Asignar Permisos

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Crear nuevo rol
$role = Role::create(['name' => 'supervisor']);

// Asignar permisos al rol
$role->givePermissionTo(['view_courses', 'edit_courses', 'view_reports']);

// O sincronizar permisos (reemplaza los existentes)
$role->syncPermissions(['view_courses', 'edit_courses']);
```

### Asignar Rol a Usuario

```php
use App\Models\User;

$user = User::find(1);

// Asignar un rol
$user->assignRole('encargado');

// Asignar múltiples roles
$user->assignRole(['administrador', 'encargado']);

// Sincronizar roles (reemplaza los existentes)
$user->syncRoles('cliente');

// Remover un rol
$user->removeRole('cliente');
```

### Asignar Permiso Directo a Usuario

```php
$user = User::find(1);

// Dar un permiso
$user->givePermissionTo('create_users');

// Dar múltiples permisos
$user->givePermissionTo(['create_users', 'edit_users', 'delete_users']);

// Verificar si tiene permiso
if ($user->hasPermissionTo('create_users')) {
    // Puede crear usuarios
}

// Revocar permiso
$user->revokePermissionTo('create_users');
```

### Verificaciones Comunes

```php
// Verificar un rol
if (auth()->user()->hasRole('administrador')) {
    // Es administrador
}

// Verificar múltiples roles
if (auth()->user()->hasAnyRole(['administrador', 'encargado'])) {
    // Es administrador o encargado
}

// Verificar un permiso
if (auth()->user()->hasPermissionTo('create_users')) {
    // Puede crear usuarios
}

// Verificar múltiples permisos
if (auth()->user()->hasAnyPermission(['create_users', 'edit_users'])) {
    // Tiene al menos uno de estos permisos
}

// Verificar estado del usuario
if (auth()->user()->estado_usuario) {
    // Usuario está activo
} else {
    auth()->logout();
    // Usuario está inactivo
}
```

---

## Modificar Estados de Usuarios

### Cambiar Rol de Usuario

```php
$user = User::find($userId);

// Cambiar a encargado
$user->update(['rol' => 'encargado']);
$user->syncRoles('encargado');

// Cambiar a cliente
$user->update(['rol' => 'cliente']);
$user->syncRoles('cliente');
```

### Desactivar Usuario

```php
$user = User::find($userId);
$user->update(['estado_usuario' => false]);

// Reactivar
$user->update(['estado_usuario' => true]);
```

### Cambiar Permisos de un Usuario

```php
$user = User::find($userId);

// Agregar permisos directos (sin rol)
$user->givePermissionTo(['view_reports', 'view_payments']);

// Verificar permisos directos
$permissions = $user->getDirectPermissions();

// Remover permisos directos
$user->revokePermissionTo('view_reports');
```

---

## Casos de Uso Reales

### Login: Verificar Estado y Rol

```php
// En el controlador de login
public function authenticate(LoginRequest $request)
{
    $request->authenticate();

    $user = Auth::user();

    // Verificar si el usuario está activo
    if (!$user->estado_usuario) {
        Auth::logout();
        return redirect('/login')->with('error', 'Tu cuenta ha sido desactivada');
    }

    // Redirigir según rol
    switch ($user->rol) {
        case 'administrador':
            return redirect('/admin/dashboard');
        case 'encargado':
            return redirect('/manager/dashboard');
        case 'cliente':
            return redirect('/client/dashboard');
        default:
            return redirect('/dashboard');
    }
}
```

### Crear Usuario con Rol

```php
use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::create([
    'nombre_completo' => 'Juan Pérez',
    'telefono' => '1234567890',
    'email' => 'juan@example.com',
    'password' => Hash::make('password123'),
    'rol' => 'encargado',
    'estado_usuario' => true,
]);

// Asignar el rol de Spatie
$user->assignRole('encargado');
```

### Auditoría de Cambios de Rol

```php
// Registrar cambios de rol en un log
public function updateUserRole(User $user, string $newRole)
{
    $oldRole = $user->rol;
    
    $user->update(['rol' => $newRole]);
    $user->syncRoles($newRole);

    // Registrar en log
    \Log::info("Role changed for {$user->email}: {$oldRole} -> {$newRole}");
}
```

---

## API con Autenticación de Roles

### Ejemplo de Ruta API Protegida

```php
// routes/api.php

Route::middleware(['auth:sanctum', 'role:administrador'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
    Route::post('/admin/users', [UserController::class, 'store']);
});

Route::middleware(['auth:sanctum', 'permission:view_courses'])->group(function () {
    Route::get('/courses', [CourseController::class, 'index']);
    Route::get('/courses/{course}', [CourseController::class, 'show']);
});
```

### Respuesta API Denegada

```php
// Respuesta automática en JSON si no tiene permisos
{
    "message": "Forbidden - insufficient permissions",
    "status": 403
}
```
