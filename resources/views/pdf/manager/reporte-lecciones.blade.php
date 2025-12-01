<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de Progreso de Lecciones</title>
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
        .section-title {
            background-color: #1b3346;
            color: white;
            padding: 10px 15px;
            font-size: 14px;
            font-weight: bold;
            margin: 25px 0 10px 0;
            border-radius: 4px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
        }
        th {
            background-color: #1b3346;
            color: white;
            padding: 10px 8px;
            text-align: center;
            font-size: 11px;
        }
        td {
            padding: 10px 8px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 11px;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .progress-container {
            width: 100%;
            background-color: #e5e7eb;
            border-radius: 6px;
            height: 16px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            border-radius: 6px;
            text-align: center;
            line-height: 16px;
            color: white;
            font-weight: bold;
            font-size: 10px;
        }
        .progress-green { background-color: #10b981; }
        .progress-orange { background-color: #f59e0b; }
        .progress-blue { background-color: #3b82f6; }
        .progress-red { background-color: #ef4444; }
        .badge {
            padding: 4px 10px;
            border-radius: 4px;
            font-weight: bold;
            font-size: 10px;
            color: white;
        }
        .badge-complete { background-color: #10b981; }
        .badge-high { background-color: #f59e0b; }
        .badge-low { background-color: #3b82f6; }
        .badge-blocked { background-color: #ef4444; }
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
            margin-right: 25px;
        }
        .summary-value {
            font-size: 18px;
            font-weight: bold;
            color: #1b3346;
        }
        .summary-label {
            font-size: 9px;
            color: #666;
        }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .font-bold { font-weight: bold; }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">ESCUELA DE TRAILERS</div>
        <h1>Reporte de Progreso de Cursos y Lecciones</h1>
        <p>Generado el {{ $fecha }}</p>
    </div>

    <!-- Resumen General -->
    <div class="summary">
        <div class="summary-item">
            <div class="summary-value">{{ $progresoLecciones->count() }}</div>
            <div class="summary-label">Alumnos en Cursos</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $progresoLecciones->where('porcentaje', '>=', 100)->count() }}</div>
            <div class="summary-label">Cursos Completados</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $leccionesIndividuales->count() }}</div>
            <div class="summary-label">Lecciones Individuales</div>
        </div>
        <div class="summary-item">
            <div class="summary-value">{{ $leccionesIndividuales->where('estado_leccion', 'completada')->count() }}</div>
            <div class="summary-label">Individuales Completadas</div>
        </div>
    </div>

    <!-- SECCIÓN: Progreso de Cursos -->
    <div class="section-title">📚 Progreso de Cursos</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 25%;">Alumno</th>
                <th style="width: 25%;">Curso</th>
                <th style="width: 12%;">Lecciones</th>
                <th style="width: 20%;">Progreso</th>
                <th style="width: 13%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($progresoLecciones as $index => $progreso)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $progreso->alumno }}</td>
                    <td class="text-left">{{ Str::limit($progreso->servicio, 28) }}</td>
                    <td>{{ $progreso->completadas }}/{{ $progreso->total_lecciones }}</td>
                    <td>
                        <div class="progress-container">
                            <div class="progress-bar {{ $progreso->porcentaje >= 75 ? 'progress-green' : ($progreso->porcentaje >= 50 ? 'progress-orange' : 'progress-blue') }}" 
                                style="width: {{ max($progreso->porcentaje, 15) }}%;">
                                {{ $progreso->porcentaje }}%
                            </div>
                        </div>
                    </td>
                    <td>
                        @if($progreso->porcentaje >= 100)
                            <span class="badge badge-complete">Completado</span>
                        @elseif($progreso->porcentaje >= 50)
                            <span class="badge badge-high">En Progreso</span>
                        @else
                            <span class="badge badge-low">Iniciando</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No hay cursos activos registrados</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- SECCIÓN: Lecciones Individuales -->
    <div class="section-title">📝 Lecciones Individuales</div>
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 30%;">Alumno</th>
                <th style="width: 25%;">Fecha Programada</th>
                <th style="width: 25%;">Observaciones</th>
                <th style="width: 15%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($leccionesIndividuales as $index => $leccion)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td class="text-left">{{ $leccion->contratacion?->usuario?->nombre_completo ?? 'N/A' }}</td>
                    <td>{{ $leccion->fecha_programada ? $leccion->fecha_programada->format('d/m/Y H:i') : 'Sin programar' }}</td>
                    <td class="text-left">{{ Str::limit($leccion->observaciones ?? '-', 30) }}</td>
                    <td>
                        @if($leccion->estado_leccion === 'completada')
                            <span class="badge badge-complete">Completada</span>
                        @elseif($leccion->estado_leccion === 'en_progreso')
                            <span class="badge badge-low">En Progreso</span>
                        @elseif($leccion->estado_leccion === 'bloqueada')
                            <span class="badge badge-blocked">Bloqueada</span>
                        @else
                            <span class="badge badge-high">No Iniciada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay lecciones individuales registradas</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        Escuela de Trailers - Reporte de Progreso de Cursos y Lecciones | Página 1
    </div>
</body>
</html>
