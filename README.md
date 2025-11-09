# Escuela Trailers

Proyecto base desarrollado con Laravel 12, Jetstream (Livewire) y PostgreSQL. El repositorio está preparado para uso local en XAMPP y sirve como base para el desarrollo colaborativo del equipo.

## Requisitos previos

Antes de clonar el proyecto, instala las siguientes herramientas:

- PHP 8.2 o superior
- Composer 2.x
- Node.js y npm
- PostgreSQL (local o remoto)
  -- Git
- XAMPP (recomendado)

## Uso recomendado: XAMPP

### A. Actualizar PHP en XAMPP (Windows)

1. Cierra Apache y MySQL desde XAMPP.
2. En el Explorador, copia `C:\xampp\php` y pega la copia junto a la original; renómbrala `php_old`.
3. Descarga la versión "Thread Safe" de PHP desde https://windows.php.net/download/ y extrae el ZIP en una carpeta temporal.
4. Copia todo desde la carpeta temporal y pégalo en `C:\xampp\php`, elige "Sobrescribir" cuando Windows lo pida.
5. Si tenías ajustes personalizados, copia `php_old\php.ini` a `C:\xampp\php\php.ini`.
6. Reinicia Apache y verifica:

```powershell
& C:\xampp\php\php.exe -v
```

Si Apache no arranca, restaura renombrando `php_old` a `php` y reinicia Apache.

### B. Habilitar extensiones de PostgreSQL (pgsql / pdo_pgsql) en XAMPP

1. Abre `C:\xampp\php\php.ini` con tu editor favorito (Notepad++/VS Code).
2. Busca las líneas relacionadas con `pgsql` y `pdo_pgsql` y quita el `;` al inicio para descomentarlas. Ejemplos (pueden variar ligeramente según la versión):

```ini
;extension=pgsql
;extension=pdo_pgsql
```

deben quedar así:

```ini
extension=pgsql
extension=pdo_pgsql
```

3. Reinicia Apache desde el panel de control de XAMPP.

## Instalación (entorno local)

1. Clona el repositorio:

```bash
git clone https://github.com/PlumeAndCode/escuela-trailers.git
cd escuela-trailers
```

2. Instala dependencias PHP:

```bash
composer install
```

3. Instala dependencias frontend:

```bash
npm install
```

4. Copia el archivo de entorno y genera la clave de la aplicación:

```bash
cp .env.example .env
php artisan key:generate
```

## Configuración de la base de datos

Edita el archivo `.env` y configura la conexión a PostgreSQL. Un ejemplo:

```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=escuela_trailers
DB_USERNAME=postgres
DB_PASSWORD=TU_PASSWORD
```

Crea la base de datos (por ejemplo desde psql o pgAdmin):

```sql
CREATE DATABASE escuela_trailers;
```

Ejecuta migraciones:

```bash
php artisan migrate
```

## Compilar assets

Para desarrollo:

```bash
npm run dev
```

Para producción:

```bash
npm run build
```

## Ejecutar la aplicación

A continuación se explica cómo acceder al proyecto en el servidor local.

Si usas XAMPP, coloca el proyecto en `C:\xampp\htdocs\escuela-trailers` y accede a:

```
http://localhost/escuela-trailers/public
```

## Flujo de ramas (Git)

- `main`: Versión estable (producción / demo final)
- `team/odin`, `team/juanpablo`, `team/fernanda`, `team/monica`: ramas personales del equipo

Reglas básicas:

1. No hacer commits directos en `main`.
2. Cada integrante trabaja en su rama `team/<usuario>`.
3. Para una nueva funcionalidad:
    - Hacer PR `team/<usuario>` → `main`.

Ejemplo de flujo local:

```bash
git checkout team/juanpablo
git pull
```

## Estilo de código y formato

El proyecto utiliza Prettier para mantener un formato consistente. La configuración está en la rama `dev`.

Instala dependencias frontend si no lo has hecho:

```bash
npm install
```

En VS Code se recomienda activar "Format on Save" y usar "Prettier - Code formatter" como formateador por defecto.

Los archivos relevantes son:

- `.prettierrc` — reglas de Prettier
- `.prettierignore` — rutas ignoradas

## Comandos útiles

- Generar clave de la app: `php artisan key:generate`
- Ejecutar migraciones: `php artisan migrate`
- Ejecutar seeders: `php artisan db:seed`
- Compilar en desarrollo: `npm run dev`
- Compilar para producción: `npm run build`

## Equipo de desarrollo

- Odín — `team/odin`
- Juan Pablo — `team/juanpablo`
- Fernanda — `team/fernanda`
- Mónica — `team/monica`

## Estado actual (base)

- Laravel 12 instalado
- Jetstream (Livewire) configurado
- PostgreSQL preparado
- Migraciones disponibles
- Prettier configurado
