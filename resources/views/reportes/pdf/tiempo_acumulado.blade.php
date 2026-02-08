<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reporte Tiempo Acumulado - EMICONSATH S.A.</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #1e40af;
            padding-bottom: 10px;
        }

        .header h1 {
            color: #1e40af;
            font-size: 16px;
            margin: 0;
        }

        .stats {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }

        .stat-item {
            display: table-cell;
            width: 25%;
            padding: 8px;
            text-align: center;
            background-color: #f3f4f6;
            border: 1px solid #d1d5db;
        }

        .stat-value {
            font-size: 18px;
            font-weight: bold;
            color: #1f2937;
        }

        .stat-label {
            font-size: 9px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #1e40af;
            color: white;
            padding: 8px;
            text-align: left;
            font-size: 9px;
        }

        td {
            padding: 6px;
            border: 1px solid #e5e7eb;
            font-size: 9px;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
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
            margin-top: 15px;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>REPORTE DE TIEMPO ACUMULADO</h1>
        <p>EMICONSATH S.A. | {{ date('d/m/Y H:i') }}</p>
    </div>

    @php
        $trabajadoresCol = collect($data);
    @endphp

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ $trabajadoresCol->count() }}</div>
            <div class="stat-label">Total Trabajadores</div>
        </div>
        <div class="stat-item" style="background-color: #dcfce7;">
            <div class="stat-value">{{ $trabajadoresCol->where('indicador_estabilidad', 'VERDE')->count() }}</div>
            <div class="stat-label">[SEGURO] (< 4 años)</div>
            </div>
            <div class="stat-item" style="background-color: #fef3c7;">
                <div class="stat-value">{{ $trabajadoresCol->where('indicador_estabilidad', 'AMARILLO')->count() }}
                </div>
                <div class="stat-label">[ADVERTENCIA] (4 años)</div>
            </div>
            <div class="stat-item" style="background-color: #fee2e2;">
                <div class="stat-value">{{ $trabajadoresCol->where('indicador_estabilidad', 'ROJO')->count() }}</div>
                <div class="stat-label">[CRÍTICO] (>= 4.5 años)</div>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">DNI</th>
                    <th style="width: 25%;">Nombre Completo</th>
                    <th style="width: 15%;">Cargo</th>
                    <th style="width: 12%;">Departamento</th>
                    <th style="width: 10%;">Inicio</th>
                    <th style="width: 12%;">Tiempo Acumulado</th>
                    <th style="width: 10%;">Total Meses</th>
                    <th style="width: 8%;">Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabajadoresCol as $trabajador)
                    <tr>
                        <td>{{ $trabajador['dni'] }}</td>
                        <td>{{ strtoupper($trabajador['nombre_completo']) }}</td>
                        <td>{{ $trabajador['cargo'] }}</td>
                        <td>{{ $trabajador['departamento'] }}</td>
                        <td>{{ $trabajador['fecha_inicio'] }}</td>
                        <td style="font-weight: bold;">{{ $trabajador['años_meses'] }}</td>
                        <td style="text-align: center;"><strong>{{ $trabajador['meses_acumulados'] }}</strong></td>
                        <td style="text-align: center;">
                            @php
                                $claseBadge = 'badge-verde';
                                if ($trabajador['indicador_estabilidad'] == 'AMARILLO')
                                    $claseBadge = 'badge-amarillo';
                                if ($trabajador['indicador_estabilidad'] == 'ROJO')
                                    $claseBadge = 'badge-rojo';
                            @endphp
                            <span class="badge {{ $claseBadge }}">{{ $trabajador['indicador_estabilidad'] }}</span>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="footer">
            <p><strong>DOCUMENTO CONFIDENCIAL</strong> - EMICONSATH S.A.</p>
            <p>Generado el {{ date('d/m/Y H:i') }}</p>
        </div>
</body>

</html>