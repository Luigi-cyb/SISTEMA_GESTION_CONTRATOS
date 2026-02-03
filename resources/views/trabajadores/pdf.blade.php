<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contrato {{ $contrato->numero_contrato }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            color: #333;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 15px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
        }
        .header p {
            margin: 5px 0;
            font-size: 12px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            background-color: #f0f0f0;
            padding: 8px 12px;
            font-weight: bold;
            margin-bottom: 10px;
            border-left: 4px solid #333;
        }
        .row {
            display: flex;
            margin-bottom: 10px;
        }
        .col {
            flex: 1;
            margin-right: 20px;
        }
        .col-label {
            font-weight: bold;
            font-size: 12px;
            color: #666;
        }
        .col-value {
            font-size: 13px;
            margin-top: 3px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 10px 0;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 12px;
        }
        th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 11px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }
        .signature {
            width: 40%;
            text-align: center;
            border-top: 1px solid #333;
            margin-top: 40px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>CONTRATO DE TRABAJO</h1>
        <p><strong>Número de Contrato:</strong> {{ $contrato->numero_contrato }}</p>
        <p><strong>Fecha de Generación:</strong> {{ $fecha_actual }}</p>
    </div>

    <!-- INFORMACIÓN DEL TRABAJADOR -->
    <div class="section">
        <div class="section-title">INFORMACIÓN DEL TRABAJADOR</div>
        <div class="row">
            <div class="col">
                <div class="col-label">DNI</div>
                <div class="col-value">{{ $contrato->trabajador->dni }}</div>
            </div>
            <div class="col">
                <div class="col-label">Nombre Completo</div>
                <div class="col-value">{{ $contrato->trabajador->nombre_completo }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="col-label">Cargo</div>
                <div class="col-value">{{ $contrato->trabajador->cargo }}</div>
            </div>
            <div class="col">
                <div class="col-label">Unidad</div>
                <div class="col-value">{{ $contrato->trabajador->unidad }}</div>
            </div>
        </div>
    </div>

    <!-- DATOS DEL CONTRATO -->
    <div class="section">
        <div class="section-title">DATOS DEL CONTRATO</div>
        <div class="row">
            <div class="col">
                <div class="col-label">Tipo de Contrato</div>
                <div class="col-value">{{ $contrato->tipo_contrato }}</div>
            </div>
            <div class="col">
                <div class="col-label">Horario</div>
                <div class="col-value">{{ $contrato->horario }}</div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="col-label">Fecha de Inicio</div>
                <div class="col-value">{{ $contrato->fecha_inicio->format('d/m/Y') }}</div>
            </div>
            <div class="col">
                <div class="col-label">Fecha de Fin</div>
                <div class="col-value">{{ $contrato->fecha_fin->format('d/m/Y') }}</div>
            </div>
        </div>
    </div>

    <!-- REMUNERACIÓN -->
    <div class="section">
        <div class="section-title">REMUNERACIÓN</div>
        <div class="row">
            <div class="col">
                <div class="col-label">Tipo de Salario</div>
                <div class="col-value">{{ $contrato->tipo_salario }}</div>
            </div>
        </div>
        @if ($contrato->salario_mensual)
        <div class="row">
            <div class="col">
                <div class="col-label">Salario Mensual</div>
                <div class="col-value">S/. {{ number_format($contrato->salario_mensual, 2) }}</div>
            </div>
        </div>
        @endif
        @if ($contrato->salario_jornal)
        <div class="row">
            <div class="col">
                <div class="col-label">Salario Jornal</div>
                <div class="col-value">S/. {{ number_format($contrato->salario_jornal, 2) }}</div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col">
                <div class="col-label">Beneficios Ley 728</div>
                <div class="col-value">{{ $contrato->beneficios_ley_728 ? 'SÍ' : 'NO' }}</div>
            </div>
        </div>
    </div>

    <!-- BENEFICIOS -->
    @if ($contrato->beneficios_descripcion)
    <div class="section">
        <div class="section-title">BENEFICIOS ADICIONALES</div>
        <div class="col-value">{{ $contrato->beneficios_descripcion }}</div>
    </div>
    @endif

    <!-- FIRMAS -->
    <div class="signature-area">
        <div class="signature">
            ___________________________
            <br>
            Firma del Trabajador
            <br>
            DNI: {{ $contrato->trabajador->dni }}
            <br>
            Fecha: ________________
        </div>
        <div class="signature">
            ___________________________
            <br>
            Firma del Representante
            <br>
            Empresa: EMICONSATH S.A.
            <br>
            Fecha: ________________
        </div>
    </div>

    <div class="footer">
        <p>Este documento fue generado automáticamente por el Sistema de Gestión de Contratos</p>
        <p>Fecha de generación: {{ $fecha_actual }}</p>
    </div>
</body>
</html>