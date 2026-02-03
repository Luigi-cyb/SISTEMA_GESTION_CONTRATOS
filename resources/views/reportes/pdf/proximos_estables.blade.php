<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>⚠️ REPORTE CRÍTICO - Próximos a Estabilidad - EMICONSATH S.A.</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            border: 4px solid #dc2626;
            padding: 15px;
            background-color: #fee2e2;
        }
        
        .header h1 {
            color: #991b1b;
            font-size: 18px;
            margin: 0;
        }
        
        .header p {
            color: #7f1d1d;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .alert-box {
            background-color: #fef2f2;
            border: 2px solid #dc2626;
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 15px;
            text-align: center;
        }
        
        .alert-box h2 {
            color: #991b1b;
            font-size: 14px;
            margin: 0 0 8px 0;
        }
        
        .alert-box p {
            color: #7f1d1d;
            font-size: 10px;
            margin: 5px 0;
            line-height: 1.5;
        }
        
        .stats {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .stat-item {
            display: table-cell;
            width: 33.33%;
            padding: 10px;
            text-align: center;
            border: 1px solid #d1d5db;
        }
        
        .stat-item.critico {
            background-color: #fee2e2;
            border-color: #dc2626;
        }
        
        .stat-item.alto {
            background-color: #fed7aa;
            border-color: #ea580c;
        }
        
        .stat-item.medio {
            background-color: #fef3c7;
            border-color: #f59e0b;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        
        .stat-label {
            font-size: 9px;
            color: #374151;
            margin-top: 3px;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        th {
            background-color: #991b1b;
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
        
        .row-critico {
            background-color: #fee2e2 !important;
        }
        
        .row-alto {
            background-color: #fed7aa !important;
        }
        
        .row-medio {
            background-color: #fef3c7 !important;
        }
        
        .badge {
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
        
        .badge-critico {
            background-color: #dc2626;
            color: white;
        }
        
        .badge-alto {
            background-color: #ea580c;
            color: white;
        }
        
        .badge-medio {
            background-color: #f59e0b;
            color: white;
        }
        
        .decision-box {
            background-color: #eff6ff;
            border: 2px solid #2563eb;
            border-radius: 4px;
            padding: 10px;
            margin-top: 15px;
        }
        
        .decision-box h3 {
            color: #1e40af;
            font-size: 11px;
            margin: 0 0 8px 0;
        }
        
        .decision-box ul {
            margin: 5px 0 5px 15px;
            padding: 0;
        }
        
        .decision-box li {
            margin: 3px 0;
            color: #1f2937;
        }
        
        .footer {
            margin-top: 15px;
            text-align: center;
            font-size: 8px;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        
        .no-data {
            text-align: center;
            padding: 30px;
            background-color: #dcfce7;
            border: 2px solid #16a34a;
            border-radius: 4px;
            margin: 20px 0;
        }
        
        .no-data h2 {
            color: #166534;
            font-size: 14px;
            margin: 0 0 8px 0;
        }
        
        .no-data p {
            color: #166534;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- HEADER CRÍTICO -->
    <div class="header">
        <h1>⚠️ REPORTE CRÍTICO - PRÓXIMOS A ESTABILIDAD LABORAL</h1>
        <p>TRABAJADORES PRÓXIMOS A CUMPLIR 5 AÑOS</p>
        <p>EMICONSATH S.A. | {{ now()->format('d/m/Y H:i') }}</p>
    </div>

    <!-- ALERTA PRINCIPAL -->
    <div class="alert-box">
        <h2>🚨 ALERTA CRÍTICA DE ESTABILIDAD LABORAL</h2>
        <p><strong>ATENCIÓN:</strong> Los trabajadores listados están próximos a cumplir 5 años de contrato acumulado.</p>
        <p>Es necesario tomar una decisión URGENTE antes de que alcancen este límite.</p>
    </div>

    @if($trabajadores->isEmpty())
        <!-- SIN TRABAJADORES CRÍTICOS -->
        <div class="no-data">
            <h2>✅ NO HAY TRABAJADORES EN SITUACIÓN CRÍTICA</h2>
            <p>Actualmente no existen trabajadores próximos a cumplir 5 años de estabilidad laboral.</p>
            <p>El sistema está bajo control.</p>
        </div>
    @else
        <!-- ESTADÍSTICAS DE CRITICIDAD -->
        <div class="stats">
            <div class="stat-item critico">
                <div class="stat-value">{{ $trabajadores->filter(function($t) { return ($t->contratoActivo->tiempo_acumulado_meses ?? 0) >= 57; })->count() }}</div>
                <div class="stat-label">🔴 CRÍTICO (< 3 meses)</div>
            </div>
            <div class="stat-item alto">
                <div class="stat-value">{{ $trabajadores->filter(function($t) { $m = $t->contratoActivo->tiempo_acumulado_meses ?? 0; return $m >= 54 && $m < 57; })->count() }}</div>
                <div class="stat-label">🟠 ALTO (3-6 meses)</div>
            </div>
            <div class="stat-item medio">
                <div class="stat-value">{{ $trabajadores->filter(function($t) { $m = $t->contratoActivo->tiempo_acumulado_meses ?? 0; return $m >= 48 && $m < 54; })->count() }}</div>
                <div class="stat-label">🟡 MEDIO (6-12 meses)</div>
            </div>
        </div>

        <!-- TABLA DE TRABAJADORES CRÍTICOS -->
        <table>
            <thead>
                <tr>
                    <th style="width: 8%;">DNI</th>
                    <th style="width: 25%;">Nombre Completo</th>
                    <th style="width: 15%;">Cargo</th>
                    <th style="width: 12%;">Departamento</th>
                    <th style="width: 12%;">Tiempo Acumulado</th>
                    <th style="width: 10%;">Meses Restantes</th>
                    <th style="width: 10%;">Vencimiento</th>
                    <th style="width: 8%;">Nivel</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trabajadores as $trabajador)
                @php
                    $meses = $trabajador->contratoActivo->tiempo_acumulado_meses ?? 0;
                    $mesesRestantes = 60 - $meses;
                    
                    // Determinar nivel de criticidad
                    if($mesesRestantes <= 3) {
                        $rowClass = 'row-critico';
                        $badgeClass = 'badge-critico';
                        $nivel = 'CRÍTICO';
                    } elseif($mesesRestantes <= 6) {
                        $rowClass = 'row-alto';
                        $badgeClass = 'badge-alto';
                        $nivel = 'ALTO';
                    } else {
                        $rowClass = 'row-medio';
                        $badgeClass = 'badge-medio';
                        $nivel = 'MEDIO';
                    }
                    
                    // Formatear tiempo acumulado
                    $años = floor($meses / 12);
                    $mesesRestantesFormato = $meses % 12;
                    
                    if($años > 0 && $mesesRestantesFormato > 0) {
                        $tiempoTexto = $años . 'a ' . $mesesRestantesFormato . 'm';
                    } elseif($años > 0) {
                        $tiempoTexto = $años . ' año' . ($años > 1 ? 's' : '');
                    } else {
                        $tiempoTexto = $meses . ' meses';
                    }
                @endphp
                <tr class="{{ $rowClass }}">
                    <td>{{ $trabajador->dni }}</td>
                    <td><strong>{{ strtoupper($trabajador->nombre_completo) }}</strong></td>
                    <td>{{ $trabajador->cargo }}</td>
                    <td>{{ $trabajador->departamento }}</td>
                    <td><strong>{{ $tiempoTexto }}</strong></td>
                    <td style="text-align: center;"><strong>{{ $mesesRestantes }} meses</strong></td>
                    <td style="text-align: center;">
                        @if($trabajador->contratoActivo)
                            {{ \Carbon\Carbon::parse($trabajador->contratoActivo->fecha_fin)->format('d/m/Y') }}
                        @else
                            N/A
                        @endif
                    </td>
                    <td style="text-align: center;">
                        <span class="badge {{ $badgeClass }}">{{ $nivel }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- OPCIONES DE DECISIÓN -->
        <div class="decision-box">
            <h3>📋 OPCIONES DE DECISIÓN PARA RRHH Y GERENCIA:</h3>
            <ul>
                <li><strong>OPCIÓN A:</strong> Renovar como CONTRATO INDEFINIDO → El trabajador se vuelve permanente/estable</li>
                <li><strong>OPCIÓN B:</strong> NO RENOVAR → Liquidación + Brecha de 1-3 meses sin contrato (si regresa, contador reinicia a 0)</li>
                <li><strong>OPCIÓN C:</strong> PRÓRROGA → Extender el plazo temporal para decidir después (máximo hasta 5 años)</li>
            </ul>
            <p style="margin-top: 10px; color: #991b1b; font-weight: bold;">
                ⚠️ IMPORTANTE: La decisión debe tomarse ANTES de que el trabajador cumpla 5 años acumulados para evitar estabilidad laboral involuntaria.
            </p>
        </div>

        <!-- LEYENDA -->
        <div style="margin-top: 15px; padding: 10px; background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 4px;">
            <h3 style="font-size: 10px; margin: 0 0 8px 0;">📌 Leyenda de Niveles de Criticidad:</h3>
            <p style="margin: 3px 0; font-size: 9px;">🔴 <strong>CRÍTICO:</strong> Faltan 3 meses o menos para cumplir 5 años (Acción inmediata requerida)</p>
            <p style="margin: 3px 0; font-size: 9px;">🟠 <strong>ALTO:</strong> Faltan entre 3 y 6 meses (Planificar decisión pronto)</p>
            <p style="margin: 3px 0; font-size: 9px;">🟡 <strong>MEDIO:</strong> Faltan entre 6 y 12 meses (Monitorear y preparar)</p>
        </div>
    @endif

    <!-- FOOTER -->
    <div class="footer">
        <p><strong>DOCUMENTO CONFIDENCIAL Y CRÍTICO</strong> - EMICONSATH S.A.</p>
        <p>Este reporte requiere atención prioritaria de RRHH y Gerencia</p>
        <p>Generado el {{ now()->format('d/m/Y H:i') }}</p>
    </div>
</body>
</html>