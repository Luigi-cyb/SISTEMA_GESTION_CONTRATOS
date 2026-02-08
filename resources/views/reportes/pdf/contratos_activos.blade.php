<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte: Contratos Activos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
            font-size: 18px;
        }
        .header p {
            color: #64748b;
            margin: 5px 0;
            font-size: 11px;
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
            background-color: #2563eb;
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
        .badge {
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 8px;
            font-weight: bold;
            display: inline-block;
        }
        .badge-verde {
            background-color: #dcfce7;
            color: #166534;
        }
        .badge-amarillo {
            background-color: #fef3c7;
            color: #854d0e;
        }
        .badge-rojo {
            background-color: #fee2e2;
            color: #991b1b;
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
        .page-break {
            page-break-after: always;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>REPORTE: CONTRATOS ACTIVOS</h1>
        <p><strong>EMICONSATH S.A.</strong> - Sistema de Gestión de Contratos</p>
        <p>Generado el: {{ date('d/m/Y H:i:s') }}</p>
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <p><strong>Total de Contratos Activos:</strong> {{ count($data) }}</p>
        <p><strong>Descripción:</strong> Listado de todos los contratos activos con tiempo acumulado en la empresa</p>
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
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Tiempo Acumulado</th>
                <th>Indicador</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $contrato)
            <tr>
                <td>{{ $contrato['dni'] }}</td>
                <td><strong>{{ $contrato['nombre_completo'] }}</strong></td>
                <td>{{ $contrato['cargo'] }}</td>
                <td>{{ $contrato['departamento'] }}</td>
                <td>
                    <span class="badge badge-{{ strtolower($contrato['tipo_contrato']) }}">
                        {{ $contrato['tipo_contrato'] }}
                    </span>
                </td>
                <td>{{ $contrato['fecha_inicio'] }}</td>
                <td>{{ $contrato['fecha_fin'] }}</td>
                <td><strong>{{ $contrato['años_meses'] }}</strong></td>
                <td>
                    <span class="badge badge-{{ strtolower($contrato['indicador_estabilidad']) }}">
                        {{ $contrato['indicador_estabilidad'] }}
                    </span>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        <p><strong>EMICONSATH S.A.</strong> - Confidencial</p>
        <p>Este documento contiene información sensible y debe ser tratado con confidencialidad</p>
    </div>
</body>
</html>