<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
* { margin: 0; padding: 0; }
body { margin: 0; background: white; }

.page-wrapper {
    width: 21cm;
    height: 29.7cm;
    margin: 0;
    position: relative;
    page-break-after: always;
}

.page-wrapper:last-child {
    page-break-after: avoid;
}

.page-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 21cm;
    height: 29.7cm;
    z-index: 1;
}

.page-content {
    position: absolute;
    top: 4cm;
    left: 2.5cm;
    right: 2.5cm;
    width: auto;
    height: calc(29.7cm - 8cm);
    z-index: 2;
    overflow: visible;
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 10.5pt;
    line-height: 1.35;
}

.codigo-adenda {
    font-family: 'Lucida Fax', serif;
    font-size: 13pt;
    font-weight: bold;
    text-align: right;
    margin-bottom: 0.3cm;
}

.titulo-adenda {
    font-family: 'Century Gothic', sans-serif;
    font-size: 13pt;
    font-weight: bold;
    text-align: center;
    text-decoration: underline;
    margin-bottom: 0.6cm;
    line-height: 1.2;
}

.texto-introductorio {
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 9.5pt;
    font-weight: normal;
    text-align: justify;
    margin-bottom: 0.4cm;
    line-height: 1.35;
}

.clausula-titulo {
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 10pt;
    font-weight: bold;
    text-decoration: underline;
    margin: 0.5cm 0 0.3cm 0;
    page-break-inside: avoid;
    page-break-after: avoid;
}

.clausula-contenido {
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 9.5pt;
    font-weight: normal;
    text-align: justify;
    margin-bottom: 0.3cm;
    line-height: 1.35;
}

.firmas {
    margin-top: 1.5cm;
    display: table;
    width: 100%;
    table-layout: fixed;
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 9.5pt;
}

.firma-bloque {
    display: table-cell;
    width: 50%;
    text-align: center;
    vertical-align: bottom;
    padding: 0 1cm;
}

.linea-firma {
    border-top: 1px solid #000;
    width: 100%;
    margin-bottom: 0.05cm;
}

strong { font-weight: bold; }

@page { size: A4; margin: 0; }
</style>
</head>
<body>

<?php
// ✅ CORREGIDO: Calcular el periodo entre fecha_inicio y fecha_fin (NORMALIZADO)
$inicio = \Carbon\Carbon::parse($adenda->fecha_inicio);
$fin = \Carbon\Carbon::parse($adenda->fecha_fin);

// Calcular meses y días exactos
$diffMesesExacto = $inicio->diffInMonths($fin);
$diasDespuesDeMeses = $inicio->copy()->addMonths($diffMesesExacto)->diffInDays($fin) + 1;

// ✅ NORMALIZACIÓN: Si días >= 30, convertir a mes adicional
if ($diasDespuesDeMeses >= 30) {
    $diffMesesExacto += 1;
    $diasDespuesDeMeses = 0;
}

// Construir texto del periodo
if ($diasDespuesDeMeses > 0) {
    $textoPeriodo = sprintf('%02d meses y %02d días', $diffMesesExacto, $diasDespuesDeMeses);
} else {
    $textoPeriodo = sprintf('%02d meses', $diffMesesExacto);
}

// Formatear fechas en formato "01 de Enero del 2026"
$fechaInicioTexto = $inicio->format('d') . ' de ' . $meses[(int)$inicio->format('m')] . ' del ' . $inicio->format('Y');
$fechaFinTexto = $fin->format('d') . ' de ' . $meses[(int)$fin->format('m')] . ' del ' . $fin->format('Y');
$fechaOrigenTexto = $contrato->fecha_inicio->format('d') . ' de ' . $meses[(int)$contrato->fecha_inicio->format('m')] . ' del ' . $contrato->fecha_inicio->format('Y');
?>

<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{!! $bgData !!}" class="page-bg">
    <div class="page-content">
        <div class="codigo-adenda">{{ $codigoAdenda }}</div>
        
        <div class="titulo-adenda">ADENDA DE PRÓRROGA Y MODIFICACIÓN AL CONTRATO<br>INDIVIDUAL DE TRABAJO PARA SERVICIO ESPECÍFICO</div>
        
        <div class="texto-introductorio">
Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, <strong>{{ $configuracion->razon_social }}</strong> con <strong>RUC Nº {{ $configuracion->ruc }}</strong>, y domicilio en <strong>{{ $configuracion->direccion }}</strong>, debidamente representada por su Gerente General <strong>{{ $configuracion->gerenteNombreCompleto() }}</strong> con D.N.I N° <strong>{{ $configuracion->gerente_dni }}</strong>, a quien en adelante se le denominará <strong>LA EMPRESA</strong>; y de otra parte Don (ña) <strong>{{ $trabajador->nombre_completo ?? 'APELLIDOS_Y_NOMBRES' }}</strong>, identificado con D.N.I. N° <strong>{{ $trabajador->dni ?? 'N_DNI' }}</strong>, domiciliado en el <strong>{{ $trabajador->direccion_actual ?? 'DIRECCIÓN' }}</strong>, a quien en lo sucesivo se le denominará <strong>EL TRABAJADOR</strong>; en los términos y condiciones siguientes:
        </div>

        <div class="clausula-titulo">CLÁUSULA PRIMERA: ANTECEDENTES</div>
        <div class="clausula-contenido">
Con fecha <strong>{{ $fechaOrigenTexto }}</strong>, <strong>LA EMPRESA</strong> y <strong>EL TRABAJADOR</strong> suscribieron un CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO, mediante el cual se contrató a <strong>EL TRABAJADOR</strong> para que preste sus servicios como <strong>"{{ $trabajador->cargo ?? 'CARGO' }}"</strong>.
        </div>

        <div class="clausula-titulo">CLÁUSULA SEGUNDA: PRÓRROGA DEL PLAZO</div>
        <div class="clausula-contenido">
<strong>LA EMPRESA</strong> y <strong>EL TRABAJADOR</strong> acuerdan prorrogar por <strong>({{ $textoPeriodo }})</strong> la vigencia del Contrato de Trabajo antes reseñado, es decir, desde el <strong>{{ $fechaInicioTexto }}</strong> hasta el <strong>{{ $fechaFinTexto }}</strong>.
        </div>

        <div class="clausula-titulo">CLÁUSULA TERCERA: MODIFICACIÓN DE CONTRATO</div>
        <div class="clausula-contenido">
<strong>LA EMPRESA</strong> y <strong>EL TRABAJADOR</strong> acuerdan mantener la cláusula correspondiente al cargo y remuneración.
        </div>

        <div class="clausula-titulo">CLÁUSULA CUARTA: INALTERABILIDAD DE ACUERDOS</div>
        <div class="clausula-contenido">
Las partes acuerdan que los términos y condiciones del contrato que no hayan sido expresamente prorrogados o modificados por la presente adenda, permanecerán vigentes y con plenos efectos jurídicos.
        </div>

        <div class="clausula-titulo">CLÁUSULA QUINTA: CONFORMIDAD</div>
        <div class="clausula-contenido">
<!-- ✅ CORREGIDO: Ahora usa las variables $dia_numero, $mes, $year que vienen del controlador -->
Las partes ratifican su voluntad conforme lo expresado en la presente adenda la misma que firman en señal de conformidad en Dos ejemplares originales de igual tenor y valor, en el Distrito de Huayllay, Provincia y Departamento de Pasco, a los <strong>{{ $dia_numero }} días del mes de {{ $mes }} del {{ $year }}</strong>.
        </div>

        <div class="firmas">
            <div class="firma-bloque">
                <div class="linea-firma"></div>
                <p><strong>LA EMPRESA</strong></p>
            </div>
            <div class="firma-bloque">
                <div class="linea-firma"></div>
                <p><strong>EL TRABAJADOR</strong></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>