<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Rentas Activas</title>
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
        .badge-active {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-warning {
            background-color: #fed7aa;
            color: #92400e;
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
        .alert-row {
            background-color: #fef3c7 !important;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">🚛 ESCUELA DE TRAILERS</div>
        <h1>Reporte de Rentas de Tráileres Activas</h1>
        <p>Generado el {{ $fecha }}</p>
    </div>

    <div class="summary">
        <div class="summary-item">
            <div class="summary-value">{{ $rentasActivas->count() }}</div>
            <div class="summary-label">Rentas Activas</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $rentasActivas->where('proximo_vencer', true)->count() }}</div>
            <div class="summary-label">Próximas a Vencer (3 días)</div>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 20%;">Tráiler</th>
                <th style="width: 15%;">Placa</th>
                <th style="width: 25%;">Cliente</th>
                <th style="width: 15%;">Fecha Renta</th>
                <th style="width: 15%;">Devolución Est.</th>
                <th style="width: 10%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rentasActivas as $index => $renta)
                <tr class="{{ $renta->proximo_vencer ? 'alert-row' : '' }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $renta->trailer?->modelo ?? 'N/A' }}</td>
                    <td>{{ $renta->trailer?->placa ?? 'N/A' }}</td>
                    <td style="text-align: left;">{{ $renta->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</td>
                    <td>{{ $renta->fecha_renta ? $renta->fecha_renta->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $renta->fecha_devolucion_estimada ? $renta->fecha_devolucion_estimada->format('d/m/Y') : 'N/A' }}</td>
                    <td>
                        @if($renta->proximo_vencer)
                            <span class="badge badge-warning">⚠️ {{ $renta->dias_restantes }} días</span>
                        @else
                            <span class="badge badge-active">Activa</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">No hay rentas activas registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Escuela de Trailers - Reporte Operativo | Página 1
    </div>
</body>
</html>
