<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: Próximos a Vencer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #eab308;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #ca8a04;
            margin: 0;
            font-size: 18px;
        }
        .header p {
            color: #64748b;
            margin: 5px 0;
            font-size: 11px;
        }
        .alert-box {
            background-color: #fef3c7;
            border-left: 4px solid #eab308;
            padding: 10px;
            margin-bottom: 15px;
        }
        .alert-box p {
            margin: 3px 0;
            font-size: 10px;
            color: #92400e;
        }
        .info-box {
            background-color: #f1f5f9;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .info-box p {
            margin: 3px 0;
            font-size: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        thead {
            background-color: #eab308;
            color: white;
        }
        thead th {
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
        }
        tbody td {
            padding: 6px 5px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 9px;
        }
        tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        tbody tr.critico {
            background-color: #fee2e2 !important;
        }
        tbody tr.advertencia {
            background-color: #fef3c7 !important;
        }
        .badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-critico {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .badge-advertencia {
            background-color: #fef3c7;
            color: #854d0e;
        }
        .badge-normal {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-temporal {
            background-color: #dbeafe;
            color: #1e40af;
        }
        .badge-indefinido {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-practicante {
            background-color: #f3e8ff;
            color: #6b21a8;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 9px;
            color: #64748b;
            border-top: 1px solid #e2e8f0;
            padding-top: 10px;
        }
        .leyenda {
            margin-top: 15px;
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 5px;
        }
        .leyenda p {
            margin: 5px 0;
            font-size: 9px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>⏰ REPORTE: CONTRATOS PRÓXIMOS A VENCER</h1>
        <p><strong>EMICONSATH S.A.</strong> - Sistema de Gestión de Contratos</p>
        <p>Generado el: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Alert Box -->
    @php
        $criticos = collect($data)->where('dias_restantes', '<=', 7)->count();
    @endphp
    
    @if($criticos > 0)
    <div class="alert-box">
        <p><strong>⚠️ ALERTA CRÍTICA:</strong> {{ $criticos }} contrato(s) vencen en 7 días o menos</p>
        <p>Se requiere acción inmediata para renovar o cesar estos contratos</p>
    </div>
    @endif

    <!-- Info Box -->
    <div class="info-box">
        <p><strong>Total de Contratos Próximos a Vencer:</strong> {{ count($data) }}</p>
        <p><strong>Descripción:</strong> Contratos que vencen en los próximos días</p>
    </div>

    <!-- Tabla -->
    <table>
        <thead>
            <tr>
                <th>DNI</th>
                <th>Nombre Completo</th>
                <th>Cargo</th>
                <th>Departamento</th>
                <th>Tipo</th>
                <th>Fecha Fin</th>
                <th>Días Restantes</th>
                <th>Meses Acum.</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $contrato)
            <tr class="{{ $contrato['dias_restantes'] <= 7 ? 'critico' : ($contrato['dias_restantes'] <= 15 ? 'advertencia' : '') }}">
                <td>{{ $contrato['dni'] }}</td>
                <td><strong>{{ $contrato['nombre_completo'] }}</strong></td>
                <td>{{ $contrato['cargo'] }}</td>
                <td>{{ $contrato['departamento'] }}</td>
                <td>
                    <span class="badge badge-{{ strtolower($contrato['tipo_contrato']) }}">
                        {{ $contrato['tipo_contrato'] }}
                    </span>
                </td>
                <td><strong>{{ $contrato['fecha_fin'] }}</strong></td>
                <td>
                    <span class="badge badge-{{ $contrato['dias_restantes'] <= 7 ? 'critico' : ($contrato['dias_restantes'] <= 15 ? 'advertencia' : 'normal') }}">
                        {{ $contrato['dias_restantes'] }} días
                    </span>
                </td>
                <td>{{ $contrato['meses_acumulados'] }} meses</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Leyenda -->
    <div class="leyenda">
        <p><strong>Leyenda de Criticidad:</strong></p>
        <p>🔴 <strong>≤ 7 días:</strong> Crítico - Acción inmediata requerida</p>
        <p>🟡 <strong>≤ 15 días:</strong> Advertencia - Preparar renovación</p>
        <p>🟢 <strong>> 15 días:</strong> Normal - Monitoreo regular</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>EMICONSATH S.A.</strong> - Confidencial</p>
        <p>Este documento contiene información sensible y debe ser tratado con confidencialidad</p>
    </div>
</body>
</html>
