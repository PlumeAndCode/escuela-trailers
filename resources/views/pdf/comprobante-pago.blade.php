<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprobante de Pago</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Helvetica', 'Arial', sans-serif;
            font-size: 14px;
            line-height: 1.6;
            color: #333;
            padding: 40px;
        }
        
        .header {
            text-align: center;
            border-bottom: 3px solid #f59e0b;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .logo span {
            color: #f59e0b;
        }
        
        .subtitle {
            color: #6b7280;
            font-size: 12px;
            margin-top: 5px;
        }
        
        .comprobante-title {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            color: #1f2937;
            margin-bottom: 30px;
        }
        
        .success-badge {
            display: inline-block;
            background-color: #10b981;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .info-section {
            margin-bottom: 25px;
        }
        
        .info-section h3 {
            font-size: 16px;
            color: #1f2937;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
            margin-bottom: 15px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px dashed #e5e7eb;
        }
        
        .info-label {
            color: #6b7280;
            font-weight: 500;
        }
        
        .info-value {
            color: #1f2937;
            font-weight: 600;
            text-align: right;
        }
        
        .total-section {
            background-color: #fef3c7;
            border: 2px solid #f59e0b;
            border-radius: 10px;
            padding: 20px;
            margin: 30px 0;
        }
        
        .total-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-label {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .total-value {
            font-size: 24px;
            font-weight: bold;
            color: #f59e0b;
        }
        
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #9ca3af;
            font-size: 11px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        
        .referencia-box {
            background-color: #f3f4f6;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            margin: 20px 0;
        }
        
        .referencia-label {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 5px;
        }
        
        .referencia-value {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
            letter-spacing: 2px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        table td {
            padding: 8px 0;
        }
        
        table td:last-child {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">DriveMaster <span>Pro</span></div>
        <div class="subtitle">Escuela de Manejo Profesional</div>
    </div>

    <div class="comprobante-title">COMPROBANTE DE PAGO</div>

    <div style="text-align: center;">
        <span class="success-badge">✓ PAGO EXITOSO</span>
    </div>

    <div class="referencia-box">
        <div class="referencia-label">Número de Referencia</div>
        <div class="referencia-value">{{ $referencia }}</div>
    </div>

    <div class="info-section">
        <h3>Datos del Cliente</h3>
        <table>
            <tr>
                <td class="info-label">Nombre:</td>
                <td class="info-value">{{ $usuario->nombre_completo }}</td>
            </tr>
            <tr>
                <td class="info-label">Email:</td>
                <td class="info-value">{{ $usuario->email }}</td>
            </tr>
            @if($usuario->telefono)
            <tr>
                <td class="info-label">Teléfono:</td>
                <td class="info-value">{{ $usuario->telefono }}</td>
            </tr>
            @endif
        </table>
    </div>

    <div class="info-section">
        <h3>Detalles del Servicio</h3>
        <table>
            <tr>
                <td class="info-label">Servicio:</td>
                <td class="info-value">{{ $pago->contratacion->servicio->nombre_servicio ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td class="info-label">Tipo:</td>
                <td class="info-value">{{ ucfirst($pago->contratacion->servicio->tipo_servicio ?? 'N/A') }}</td>
            </tr>
            <tr>
                <td class="info-label">Descripción:</td>
                <td class="info-value">{{ $pago->contratacion->servicio->descripcion ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>

    <div class="info-section">
        <h3>Información del Pago</h3>
        <table>
            <tr>
                <td class="info-label">Fecha de Pago:</td>
                <td class="info-value">{{ $fecha }}</td>
            </tr>
            <tr>
                <td class="info-label">Método de Pago:</td>
                <td class="info-value">{{ ucfirst($pago->tipo_pago) }}</td>
            </tr>
            <tr>
                <td class="info-label">Estado:</td>
                <td class="info-value" style="color: #10b981;">{{ ucfirst($pago->estado_pago) }}</td>
            </tr>
        </table>
    </div>

    <div class="total-section">
        <div class="total-row">
            <span class="total-label">TOTAL PAGADO</span>
            <span class="total-value">${{ number_format($pago->monto_pagado, 2) }} MXN</span>
        </div>
    </div>

    <div class="footer">
        <p><strong>DriveMaster Pro</strong> - Escuela de Manejo Profesional</p>
        <p>Este documento es un comprobante oficial de pago.</p>
        <p>Generado el {{ now()->format('d/m/Y H:i:s') }}</p>
        <p style="margin-top: 10px;">¿Dudas? Contáctanos: soporte@drivemasterpro.com</p>
    </div>
</body>
</html>
