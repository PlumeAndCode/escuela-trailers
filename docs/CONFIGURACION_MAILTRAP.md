# Configuración de Mailtrap para Envío de Correos

## ¿Qué es Mailtrap?

Mailtrap es un servicio de pruebas de email que permite capturar correos enviados desde tu aplicación en un entorno de desarrollo sin enviarlos a destinatarios reales.

---

## Pasos para Configurar Mailtrap

### 1. Crear una cuenta en Mailtrap

1. Ve a [https://mailtrap.io](https://mailtrap.io)
2. Regístrate con tu correo o usando Google/GitHub
3. Confirma tu cuenta

### 2. Obtener las credenciales SMTP

1. Una vez dentro, ve a **Email Testing** → **Inboxes**
2. Selecciona tu inbox (o crea uno nuevo)
3. En la sección **SMTP Settings**, selecciona **Laravel 9+** en el dropdown de integraciones
4. Copia las credenciales que aparecen

---

## Variables de Entorno (.env)

Agrega o modifica las siguientes variables en tu archivo `.env`:

```env
# ============================================
# CONFIGURACIÓN DE CORREO - MAILTRAP
# ============================================

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=tu_username_aqui
MAIL_PASSWORD=tu_password_aqui
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@drivemaster.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### Descripción de cada variable:

| Variable            | Descripción                           | Ejemplo                                  |
| ------------------- | ------------------------------------- | ---------------------------------------- |
| `MAIL_MAILER`       | Driver de correo a usar               | `smtp`                                   |
| `MAIL_HOST`         | Servidor SMTP de Mailtrap             | `sandbox.smtp.mailtrap.io`               |
| `MAIL_PORT`         | Puerto SMTP                           | `2525` (también puede ser `587` o `465`) |
| `MAIL_USERNAME`     | Usuario proporcionado por Mailtrap    | `abc123def456`                           |
| `MAIL_PASSWORD`     | Contraseña proporcionada por Mailtrap | `xyz789ghi012`                           |
| `MAIL_ENCRYPTION`   | Tipo de encriptación                  | `tls`                                    |
| `MAIL_FROM_ADDRESS` | Correo remitente por defecto          | `noreply@drivemaster.com`                |
| `MAIL_FROM_NAME`    | Nombre del remitente                  | `DriveMaster Pro`                        |

---

## Ejemplo Completo de .env

```env
APP_NAME="DriveMaster Pro"
APP_ENV=local
APP_DEBUG=true

# ... otras variables ...

# Correo con Mailtrap
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=a1b2c3d4e5f6g7
MAIL_PASSWORD=h8i9j0k1l2m3n4
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@drivemaster.com"
MAIL_FROM_NAME="DriveMaster Pro"
```

---

## Limpiar Caché de Configuración

Después de modificar el archivo `.env`, ejecuta:

```bash
php artisan config:clear
php artisan cache:clear
```

---

## Probar el Envío de Correos

Puedes probar que funciona con Tinker:

```bash
php artisan tinker
```

```php
Mail::raw('Correo de prueba desde DriveMaster Pro', function ($message) {
    $message->to('test@example.com')->subject('Prueba Mailtrap');
});
```

O crear una ruta de prueba temporal:

```php
// routes/web.php (solo para pruebas, eliminar después)
Route::get('/test-mail', function () {
    Mail::raw('¡Hola! Este es un correo de prueba.', function ($message) {
        $message->to('usuario@ejemplo.com')
                ->subject('Prueba de correo - DriveMaster Pro');
    });
    return '¡Correo enviado! Revisa tu inbox en Mailtrap.';
});
```

---

## Verificar en Mailtrap

1. Ve a tu inbox en [Mailtrap](https://mailtrap.io/inboxes)
2. Los correos enviados aparecerán ahí
3. Puedes ver el contenido HTML, texto plano, headers, etc.

---

## Notas Importantes

⚠️ **Mailtrap es solo para desarrollo/pruebas**. Los correos NO se envían a destinatarios reales.

🔄 **Para producción**, usa un servicio real como:

- Amazon SES
- Mailgun
- SendGrid
- Postmark

📧 **Funcionalidades que usan correo en este proyecto**:

- Verificación de email al registrarse
- Restablecimiento de contraseña
- Notificaciones de pagos (futuro)

---

## Troubleshooting

### Error: "Connection could not be established"

- Verifica que `MAIL_HOST` y `MAIL_PORT` sean correctos
- Asegúrate de que tu firewall permita conexiones salientes al puerto 2525

### Error: "Authentication failed"

- Verifica que `MAIL_USERNAME` y `MAIL_PASSWORD` sean los correctos de Mailtrap
- Regenera las credenciales en Mailtrap si es necesario

### Los correos no aparecen en Mailtrap

- Ejecuta `php artisan config:clear`
- Verifica que estés viendo el inbox correcto en Mailtrap
