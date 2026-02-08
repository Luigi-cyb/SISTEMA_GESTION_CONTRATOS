<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte por Departamento - EMICONSATH S.A.</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #1e40af;
        }

        .header h1 {
            color: #1e40af;
            font-size: 18px;
            margin-bottom: 5px;
        }

        .header h2 {
            color: #64748b;
            font-size: 14px;
            font-weight: normal;
        }

        .header p {
            color: #64748b;
            font-size: 9px;
            margin-top: 5px;
        }

        .info-box {
            background-color: #f1f5f9;
            border: 1px solid #e2e8f0;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 15px;
        }

        .info-box h3 {
            color: #1e40af;
            font-size: 11px;
            margin-bottom: 8px;
        }

        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .stat-card {
            display: table-cell;
            width: 25%;
            padding: 8px;
            text-align: center;
            border: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }

        .stat-card.primary {
            background-color: #dbeafe;
            border-color: #93c5fd;
        }

        .stat-card.success {
            background-color: #dcfce7;
            border-color: #86efac;
        }

        .stat-card.warning {
            background-color: #fef3c7;
            border-color: #fcd34d;
        }

        .stat-card.danger {
            background-color: #fee2e2;
            border-color: #fca5a5;
        }

        .stat-value {
            font-size: 20px;
            font-weight: bold;
            color: #1f2937;
        }

        .stat-label {
            font-size: 9px;
            color: #6b7280;
            margin-top: 3px;
        }

        .filter-info {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 4px;
            padding: 8px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
            color: #92400e;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        thead {
            background-color: #1e40af;
            color: white;
        }

        th {
            padding: 8px 6px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            border: 1px solid #1e40af;
        }

        td {
            padding: 6px;
            border: 1px solid #e5e7eb;
            font-size: 9px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }

        .badge-temporal {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .badge-indefinido {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-activo {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-inactivo {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .badge-verde {
            background-color: #dcfce7;
            color: #166534;
        }

        .badge-amarillo {
            background-color: #fef3c7;
            color: #92400e;
        }

        .badge-rojo {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
        }

        .department-section {
            margin-bottom: 25px;
            page-break-inside: avoid;
        }

        .department-header {
            background-color: #1e40af;
            color: white;
            padding: 8px;
            margin-bottom: 10px;
            border-radius: 4px;
        }

        .department-header h3 {
            font-size: 12px;
            margin: 0;
        }

        .department-stats {
            display: table;
            width: 100%;
            margin-bottom: 10px;
        }

        .department-stat {
            display: table-cell;
            width: 33.33%;
            padding: 6px;
            text-align: center;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
        }
    </style>
</head>

<body>
    <!-- HEADER -->
    <div class="header">
        <h1>REPORTE POR DEPARTAMENTO</h1>
        <h2>Sistema de Gestión de Contratos</h2>
        <p>EMICONSATH S.A. | Generado: {{ date('d/m/Y H:i') }}</p>
    </div>

    @php
        $trabajadoresCol = collect($data);
    @endphp

    <!-- INFO BOX -->
    <div class="info-box">
        <h3>Resumen General</h3>
        <div class="stats-grid">
            <div class="stat-card primary">
                <div class="stat-value">{{ $trabajadoresCol->count() }}</div>
                <div class="stat-label">Total Trabajadores</div>
            </div>
            <div class="stat-card success">
                <div class="stat-value">{{ $trabajadoresCol->where('estado', 'Activo')->count() }}</div>
                <div class="stat-label">Activos</div>
            </div>
            <div class="stat-card warning">
                <div class="stat-value">{{ $trabajadoresCol->where('estado', 'Inactivo')->count() }}</div>
                <div class="stat-label">Inactivos</div>
            </div>
            <div class="stat-card danger">
                <div class="stat-value">{{ $trabajadoresCol->unique('departamento')->count() }}</div>
                <div class="stat-label">Departamentos</div>
            </div>
        </div>
    </div>

    <!-- TABLA PRINCIPAL -->
    @if($trabajadoresCol->isEmpty())
        <div style="text-align: center; padding: 30px; background-color: #fef3c7; border-radius: 4px;">
            <p style="font-size: 12px; color: #92400e;">No se encontraron trabajadores registrados.</p>
        </div>
    @else
        @php
            $departamentos = $trabajadoresCol->groupBy('departamento');
        @endphp

        @foreach($departamentos as $departamento => $trabajadoresDept)
            <div class="department-section">
                <div class="department-header">
                    <h3>{{ strtoupper($departamento) }}</h3>
                </div>

                <div class="department-stats">
                    <div class="department-stat"><strong>Total:</strong> {{ $trabajadoresDept->count() }}</div>
                    <div class="department-stat"><strong>Activos:</strong>
                        {{ $trabajadoresDept->where('estado', 'Activo')->count() }}</div>
                    <div class="department-stat"><strong>Inactivos:</strong>
                        {{ $trabajadoresDept->where('estado', 'Inactivo')->count() }}</div>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th style="width: 8%;">DNI</th>
                            <th style="width: 20%;">Nombre Completo</th>
                            <th style="width: 15%;">Cargo</th>
                            <th style="width: 12%;">Unidad</th>
                            <th style="width: 12%;">Tipo Contrato</th>
                            <th style="width: 10%;">Estado</th>
                            <th style="width: 10%;">Tiempo</th>
                            <th style="width: 8%;">Indicador</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trabajadoresDept as $trabajador)
                            <tr>
                                <td>{{ $trabajador['dni'] }}</td>
                                <td>{{ strtoupper($trabajador['nombre_completo']) }}</td>
                                <td>{{ $trabajador['cargo'] }}</td>
                                <td>{{ $trabajador['unidad'] ?? 'N/A' }}</td>
                                <td>
                                    @php
                                        $tipo = strtolower($trabajador['tipo_contrato']);
                                        $clase = str_contains($tipo, 'indefinido') ? 'badge-indefinido' : 'badge-temporal';
                                    @endphp
                                    <span class="badge {{ $clase }}">{{ strtoupper($trabajador['tipo_contrato']) }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ $trabajador['estado'] == 'Activo' ? 'badge-activo' : 'badge-inactivo' }}">
                                        {{ strtoupper($trabajador['estado']) }}
                                    </span>
                                </td>
                                <td style="font-weight: bold;">{{ $trabajador['tiempo_formateado'] }}</td>
                                <td>
                                    @php
                                        $claseInd = 'badge-verde';
                                        if ($trabajador['indicador_estabilidad'] == 'AMARILLO')
                                            $claseInd = 'badge-amarillo';
                                        if ($trabajador['indicador_estabilidad'] == 'ROJO')
                                            $claseInd = 'badge-rojo';
                                    @endphp
                                    <span class="badge {{ $claseInd }}">{{ $trabajador['indicador_estabilidad'] }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endforeach

        <div style="margin-top: 20px; padding: 10px; background-color: #f3f4f6; border-radius: 4px;">
            <h3 style="font-size: 11px; color: #1f2937; margin-bottom: 8px;">Resumen por Tipo de Contrato:</h3>
            <table style="width: 100%; margin-bottom: 0;">
                <thead>
                    <tr>
                        <th>Tipo de Contrato</th>
                        <th style="text-align: center;">Cantidad</th>
                        <th style="text-align: center;">Porcentaje</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tiposContratoCounts = $trabajadoresCol->countBy('tipo_contrato');
                        $totalCount = $trabajadoresCol->count();
                    @endphp
                    @foreach($tiposContratoCounts as $tipo => $cantidad)
                        <tr>
                            <td>{{ strtoupper($tipo) }}</td>
                            <td style="text-align: center;"><strong>{{ $cantidad }}</strong></td>
                            <td style="text-align: center;">{{ number_format(($cantidad / $totalCount) * 100, 1) }}%</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

    <div class="footer">
        <p><strong>DOCUMENTO CONFIDENCIAL</strong> - Sistema de Gestión de Contratos EMICONSATH S.A.</p>
        <p>Este documento contiene información confidencial. Su distribución está restringida al personal autorizado.
        </p>
        <p>Generado el {{ date('d/m/Y') }} a las {{ date('H:i') }}</p>
    </div>
</body>

</html>