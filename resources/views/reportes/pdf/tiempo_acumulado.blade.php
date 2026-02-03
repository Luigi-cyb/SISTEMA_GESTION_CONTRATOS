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
            border-bottom: 2px solid #2563eb;
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
        <p>EMICONSATH S.A. | {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <div class="stats">
        <div class="stat-item">
            <div class="stat-value">{{ $trabajadores->count() }}</div>
            <div class="stat-label">Total Trabajadores</div>
        </div>
        <div class="stat-item" style="background-color: #dcfce7;">
            <div class="stat-value">{{ $trabajadores->filter(function($t) { return ($t->contratoActivo->tiempo_acumulado_meses ?? 0) < 48; })->count() }}</div>
            <div class="stat-label">🟢 Seguros (< 4 años)</div>
        </div>
        <div class="stat-item" style="background-color: #fef3c7;">
            <div class="stat-value">{{ $trabajadores->filter(function($t) { $m = $t->contratoActivo->tiempo_acumulado_meses ?? 0; return $m >= 48 && $m < 54; })->count() }}</div>
            <div class="stat-label">🟡 Advertencia (4 años)</div>
        </div>
        <div class="stat-item" style="background-color: #fee2e2;">
            <div class="stat-value">{{ $trabajadores->filter(function($t) { return ($t->contratoActivo->tiempo_acumulado_meses ?? 0) >= 54; })->count() }}</div>
            <div class="stat-label">🔴 Críticos (≥ 4.5 años)</div>
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
            @foreach($trabajadores as $trabajador)
            <tr>
                <td>{{ $trabajador->dni }}</td>
                <td>{{ strtoupper($trabajador->nombre_completo) }}</td>
                <td>{{ $trabajador->cargo }}</td>
                <td>{{ $trabajador->departamento }}</td>
                <td>
                    @if($trabajador->contratoActivo)
                        {{ \Carbon\Carbon::parse($trabajador->contratoActivo->fecha_inicio)->format('d/m/Y') }}
                    @else
                        N/A
                    @endif
                </td>
                <td>
                    @if($trabajador->contratoActivo)
                        @php
                            $meses = $trabajador->contratoActivo->tiempo_acumulado_meses ?? 0;
                            $años = floor($meses / 12);
                            $mesesRestantes = $meses % 12;
                            
                            if($años > 0 && $mesesRestantes > 0) {
                                echo $años . ' año' . ($años > 1 ? 's' : '') . ', ' . $mesesRestantes . ' mes' . ($mesesRestantes != 1 ? 'es' : '');
                            } elseif($años > 0) {
                                echo $años . ' año' . ($años > 1 ? 's' : '');
                            } else {
                                echo $meses . ' mes' . ($meses != 1 ? 'es' : '');
                            }
                        @endphp
                    @else
                        N/A
                    @endif
                </td>
                <td style="text-align: center;">
                    <strong>{{ $trabajador->contratoActivo->tiempo_acumulado_meses ?? 0 }}</strong>
                </td>
                <td style="text-align: center;">
                    @if($trabajador->contratoActivo)
                        @php
                            $meses = $trabajador->contratoActivo->tiempo_acumulado_meses ?? 0;
                            if($meses >= 54) {
                                echo '<span class="badge badge-rojo">CRÍTICO</span>';
                            } elseif($meses >= 48) {
                                echo '<span class="badge badge-amarillo">ALERTA</span>';
                            } else {
                                echo '<span class="badge badge-verde">SEGURO</span>';
                            }
                        @endphp
                    @else
                        <span class="badge" style="background-color: #e5e7eb; color: #6b7280;">N/A</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p><strong>DOCUMENTO CONFIDENCIAL</strong> - EMICONSATH S.A.</p>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>