<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $titulo }} - Escuela de Trailers</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        .header {
            background-color: #1b3346;
            color: white;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 12px;
            opacity: 0.8;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            background-color: #FF7A00;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        .stat-box {
            display: table-cell;
            width: 25%;
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
        }
        .stat-box .label {
            font-size: 10px;
            color: #666;
            margin-bottom: 5px;
        }
        .stat-box .value {
            font-size: 18px;
            font-weight: bold;
            color: #1b3346;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th {
            background-color: #1b3346;
            color: white;
            padding: 10px 8px;
            text-align: center;
            font-size: 11px;
            font-weight: bold;
        }
        td {
            padding: 8px;
            text-align: center;
            border-bottom: 1px solid #ddd;
            font-size: 10px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 9px;
            font-weight: bold;
        }
        .badge-green {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-red {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-blue {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-yellow {
            background-color: #fef3c7;
            color: #92400e;
        }
        .position-badge {
            display: inline-block;
            width: 24px;
            height: 24px;
            line-height: 24px;
            border-radius: 50%;
            text-align: center;
            font-weight: bold;
            font-size: 11px;
            color: white;
        }
        .position-1 { background-color: #f59e0b; }
        .position-2 { background-color: #9ca3af; }
        .position-3 { background-color: #ea580c; }
        .money {
            color: #059669;
            font-weight: bold;
        }
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 10px 20px;
            background-color: #f3f4f6;
            border-top: 1px solid #ddd;
            font-size: 9px;
            color: #666;
        }
        .footer-content {
            display: table;
            width: 100%;
        }
        .footer-left {
            display: table-cell;
            text-align: left;
        }
        .footer-right {
            display: table-cell;
            text-align: right;
        }
        .page-break {
            page-break-after: always;
        }
        .totals-row {
            background-color: #e5e7eb !important;
            font-weight: bold;
        }
        .totals-row td {
            border-top: 2px solid #1b3346;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>ESCUELA DE TRAILERS</h1>
        <p>{{ $titulo }}</p>
        <p>Generado el: {{ $fecha }}</p>
    </div>

    <!-- Resumen General -->
    <div class="section">
        <div class="section-title">RESUMEN GENERAL</div>
        <div class="stats-grid">
            <div class="stat-box">
                <div class="label">Total Servicios</div>
                <div class="value">{{ $totales['total_servicios'] }}</div>
            </div>
            <div class="stat-box">
                <div class="label">Total Contrataciones</div>
                <div class="value">{{ $totales['total_contrataciones'] }}</div>
            </div>
            <div class="stat-box">
                <div class="label">Total Clientes</div>
                <div class="value">{{ $totales['total_clientes'] }}</div>
            </div>
            <div class="stat-box">
                <div class="label">Ingresos Totales</div>
                <div class="value" style="color: #059669;">${{ number_format($totales['total_ingresos'], 2) }}</div>
            </div>
        </div>
    </div>

    <!-- Servicios Más Contratados -->
    <div class="section">
        <div class="section-title">SERVICIOS MÁS CONTRATADOS</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 15%;">Posición</th>
                    <th style="width: 55%;">Servicio</th>
                    <th style="width: 30%;">Contrataciones</th>
                </tr>
            </thead>
            <tbody>
                @php $totalContrataciones = 0; @endphp
                @forelse($serviciosMasContratados as $index => $servicio)
                    @php $totalContrataciones += $servicio->total_contrataciones; @endphp
                    <tr>
                        <td>
                            @if($index < 3)
                                <span class="position-badge position-{{ $index + 1 }}">{{ $index + 1 }}</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td style="text-align: left; padding-left: 15px;">{{ $servicio->nombre_servicio }}</td>
                        <td><strong>{{ $servicio->total_contrataciones }}</strong></td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No hay servicios registrados</td>
                    </tr>
                @endforelse
                @if(count($serviciosMasContratados) > 0)
                    <tr class="totals-row">
                        <td colspan="2" style="text-align: right; padding-right: 15px;">TOTAL:</td>
                        <td><strong>{{ $totalContrataciones }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <!-- Ingresos por Servicio -->
    <div class="section">
        <div class="section-title">INGRESOS POR SERVICIO</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 10%;">Pos.</th>
                    <th style="width: 45%;">Servicio</th>
                    <th style="width: 20%;">Pagos</th>
                    <th style="width: 25%;">Ingreso Total</th>
                </tr>
            </thead>
            <tbody>
                @php $totalIngresos = 0; $totalPagos = 0; @endphp
                @forelse($ingresosPorServicio as $index => $servicio)
                    @php 
                        $totalIngresos += $servicio->total_ingresos; 
                        $totalPagos += $servicio->num_pagos;
                    @endphp
                    <tr>
                        <td>
                            @if($index < 3)
                                <span class="position-badge position-{{ $index + 1 }}">{{ $index + 1 }}</span>
                            @else
                                {{ $index + 1 }}
                            @endif
                        </td>
                        <td style="text-align: left; padding-left: 15px;">{{ $servicio->nombre_servicio }}</td>
                        <td>{{ $servicio->num_pagos }}</td>
                        <td class="money">${{ number_format($servicio->total_ingresos, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay ingresos registrados</td>
                    </tr>
                @endforelse
                @if(count($ingresosPorServicio) > 0)
                    <tr class="totals-row">
                        <td colspan="2" style="text-align: right; padding-right: 15px;">TOTAL:</td>
                        <td><strong>{{ $totalPagos }}</strong></td>
                        <td class="money"><strong>${{ number_format($totalIngresos, 2) }}</strong></td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>

    <div class="page-break"></div>

    <!-- Listado de Clientes -->
    <div class="section">
        <div class="section-title">LISTADO DE CLIENTES ({{ count($clientes) }} registros)</div>
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">#</th>
                    <th style="width: 25%;">Nombre</th>
                    <th style="width: 25%;">Email</th>
                    <th style="width: 15%;">Teléfono</th>
                    <th style="width: 10%;">Contrat.</th>
                    <th style="width: 10%;">Registro</th>
                    <th style="width: 10%;">Estado</th>
                </tr>
            </thead>
            <tbody>
                @forelse($clientes as $index => $cliente)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td style="text-align: left; padding-left: 10px;">{{ $cliente->nombre_completo }}</td>
                        <td style="text-align: left; font-size: 9px;">{{ $cliente->email }}</td>
                        <td>{{ $cliente->telefono ?? 'N/A' }}</td>
                        <td>
                            <span class="badge badge-blue">{{ $cliente->contrataciones_count }}</span>
                        </td>
                        <td>{{ $cliente->created_at?->format('d/m/Y') ?? 'N/A' }}</td>
                        <td>
                            @if($cliente->estado_usuario)
                                <span class="badge badge-green">Activo</span>
                            @else
                                <span class="badge badge-red">Inactivo</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">No hay clientes registrados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Resumen de clientes -->
        <div class="stats-grid" style="margin-top: 15px;">
            <div class="stat-box">
                <div class="label">Total Clientes</div>
                <div class="value">{{ $totales['total_clientes'] }}</div>
            </div>
            <div class="stat-box">
                <div class="label">Clientes Activos</div>
                <div class="value" style="color: #059669;">{{ $totales['clientes_activos'] }}</div>
            </div>
            <div class="stat-box">
                <div class="label">Clientes Inactivos</div>
                <div class="value" style="color: #dc2626;">{{ $totales['total_clientes'] - $totales['clientes_activos'] }}</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="footer-content">
            <div class="footer-left">
                Escuela de Trailers - Sistema de Gestión
            </div>
            <div class="footer-right">
                Reporte generado automáticamente el {{ $fecha }}
            </div>
        </div>
    </div>
</body>
</html>
