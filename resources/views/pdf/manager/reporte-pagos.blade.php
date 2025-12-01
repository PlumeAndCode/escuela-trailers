<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Pagos Pendientes</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #FF7A00;
            padding-bottom: 15px;
        }
        .header h1 {
            color: #1b3346;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #666;
            margin: 5px 0 0 0;
            font-size: 11px;
        }
        .logo {
            font-size: 28px;
            font-weight: bold;
            color: #FF7A00;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #1b3346;
            color: white;
            padding: 10px 8px;
            text-align: center;
            font-size: 11px;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
        }
        .badge-pending {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-partial {
            background-color: #fed7aa;
            color: #9a3412;
        }
        .badge-overdue {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .footer {
            position: fixed;
            bottom: 20px;
            left: 0;
            right: 0;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
        .summary {
            background-color: #f3f4f6;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .summary-item {
            display: inline-block;
            margin-right: 30px;
        }
        .summary-value {
            font-size: 20px;
            font-weight: bold;
            color: #1b3346;
        }
        .summary-label {
            font-size: 10px;
            color: #666;
        }
        .total-row {
            font-weight: bold;
            background-color: #e5e7eb !important;
        }
        .amount {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🚛 ESCUELA DE TRAILERS</div>
        <h1>Reporte de Pagos Pendientes</h1>
        <p>Generado el {{ $fecha }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-value">{{ $pagosPendientes->count() }}</div>
            <div class="summary-label">Total Pagos Pendientes</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">${{ number_format($pagosPendientes->sum('monto_pagado'), 2) }}</div>
            <div class="summary-label">Monto Total Pendiente</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $pagosPendientes->where('estado_pago', 'vencido')->count() }}</div>
            <div class="summary-label">Pagos Vencidos</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Cliente</th>
                <th style="width: 30%;">Servicio</th>
                <th style="width: 15%;">Monto</th>
                <th style="width: 15%;">Fecha</th>
                <th style="width: 10%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pagosPendientes as $index => $pago)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align: left;">{{ $pago->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</td>
                    <td style="text-align: left;">{{ $pago->contratacion?->servicio?->nombre_servicio ?? 'N/A' }}</td>
                    <td class="amount">${{ number_format($pago->monto_pagado, 2) }}</td>
                    <td>{{ $pago->fecha_pago ? \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        @if($pago->estado_pago === 'vencido')
                            <span class="badge badge-overdue">Vencido</span>
                        @elseif($pago->estado_pago === 'parcial')
                            <span class="badge badge-partial">Parcial</span>
                        @else
                            <span class="badge badge-pending">Pendiente</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay pagos pendientes registrados</td>
                </tr>
            @endforelse
            @if($pagosPendientes->count() > 0)
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">TOTAL PENDIENTE:</td>
                    <td class="amount">${{ number_format($pagosPendientes->sum('monto_pagado'), 2) }}</td>
                    <td colspan="2"></td>
                </tr>
            @endif
        </tbody>
    </table>

    <div class="footer">
        Escuela de Trailers - Reporte Operativo | Página 1
    </div>
</body>
</html>
