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
    column-count: 1;
    column-gap: 0;
    page-break-inside: avoid;
}

.codigo-contrato {
    font-family: 'Lucida Fax', serif;
    font-size: 13pt;
    font-weight: bold;
    text-align: right;
    margin-bottom: 0cm;
}

.titulo-contrato {
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

.clausula-texto {
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 9.5pt;
    font-weight: normal;
    text-align: justify;
    margin-bottom: 0.3cm;
    line-height: 1.35;
}

.lista-contenido {
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-size: 9.5pt;
    text-align: justify;
    margin-left: 0.5cm;
    margin-bottom: 0.2cm;
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
    margin-bottom: 0.05cm;   /* Solo este espaciado */
}

strong { font-weight: bold; }

@page { size: A4; margin: 0; }
</style>
</head>
<body>

<?php
// Helper para formatear fecha en español
function fechaEnEspanol($fecha) {
    $meses = [
        1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
        5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
        9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
    ];
    
    $dia = $fecha->format('d');
    $mes = $meses[(int)$fecha->format('m')];
    $anio = $fecha->format('Y');
    
    return "$dia de $mes del $anio";
}

function calcularDuracion($fechaInicio, $fechaFin) {
    $diff = $fechaInicio->diff($fechaFin);
    
    // Obtener años, meses y días
    $anios = $diff->y;
    $meses = $diff->m;
    $dias = $diff->d;
    
    // SUMAR 1 DÍA para contar el día inicial Y final
    $dias += 1;
    
    // Convertir años a meses
    $mesesTotales = ($anios * 12) + $meses;
    
    // Si los días llegan a 30+, sumar un mes
    if ($dias >= 30) {
        $mesesTotales += 1;
        $dias = 0;
    }
    
    // Formato de salida
    
    // Si solo hay días (menos de 1 mes)
    if ($mesesTotales == 0 && $dias > 0) {
        return $dias . ' día' . ($dias > 1 ? 's' : '');
    }
    
    // Si solo hay meses (sin días)
    if ($mesesTotales > 0 && $dias == 0) {
        if ($mesesTotales < 10) {
            return '0' . $mesesTotales . ' mes' . ($mesesTotales > 1 ? 'es' : '');
        }
        return $mesesTotales . ' mes' . ($mesesTotales > 1 ? 'es' : '');
    }
    
    // Si hay meses Y días (MOSTRAR AMBOS)
    if ($mesesTotales > 0 && $dias > 0) {
        $textoMeses = ($mesesTotales < 10 ? '0' . $mesesTotales : $mesesTotales) . ' mes' . ($mesesTotales > 1 ? 'es' : '');
        $textoDias = $dias . ' día' . ($dias > 1 ? 's' : '');
        return $textoMeses . ' y ' . $textoDias;
    }
    
    return '0 días';
}

$fechaInicioFormateada = fechaEnEspanol($contrato->fecha_inicio);
$fechaFinFormateada = fechaEnEspanol($contrato->fecha_fin);
$duracionContrato = calcularDuracion($contrato->fecha_inicio, $contrato->fecha_fin);
?>

<!-- PÁGINA 1 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">
        <div class="codigo-contrato">{{ $codigoContrato }}</div>
        
        <div class="titulo-contrato">CONTRATO DE TRABAJO SUJETO A MODALIDAD PARA SERVICIO ESPECÍFICO</div>
        
        <div class="texto-introductorio">
            Conste por el presente documento, el Contrato de Trabajo Sujeto a Modalidad para Servicio Específico, que celebran de conformidad con el Artículo 63° del Texto Único Ordenado (TUO) del Decreto Legislativo N° 728, Ley de Productividad y Competitividad Laboral (LPCL), aprobado por Decreto Supremo N° 003-97-TR, de una parte, <strong>EMICONSATH S.A.</strong> con <strong>RUC Nº 20489418691</strong>, y domicilio en <strong>Mza. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima</strong>, debidamente representada por su Gerente General <strong>Ing. CRUZ CARHUAZ NELSON JOVINO</strong> con D.N.I N° <strong>10158128</strong>, a quien en adelante se le denominará <strong>LA EMPRESA</strong>; y de otra parte Don (ña) <strong>{{ $trabajador->nombre_completo ?? 'APELLIDOS_Y_NOMBRES' }}</strong> con D.N.I. N° <strong>{{ $trabajador->dni ?? 'N_DNI' }}</strong>, domiciliado en <strong>{{ $trabajador->direccion_actual ?? 'DIRECCIÓN' }}</strong>, a quien en lo sucesivo se le denominará <strong>EL TRABAJADOR</strong>; en los términos y condiciones siguientes:
        </div>

        <div class="clausula-titulo">CLAUSULA PRIMERA. – ANTECEDENTES DE LA EMPRESA</div>
        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> es una persona jurídica cuyo objeto social es prestar servicios de diversa índole, dedicada a brindar un servicio integral en minería superficial y subterránea tales como: obras civiles, gestión ambiental, transporte y servicios generales, de acuerdo a la necesidad de nuestros clientes.
        </div>

        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> ha recibido una Orden de Servicio de "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA" (en adelante, Contrato Principal) con COMPAÑÍA MINERA CHUNGAR SAC, con el objeto de ejecutar los servicios en la UEA Alpamarca de la cual es titular, y que se encuentra ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín.
        </div>

        <div class="clausula-titulo">CLAUSULA SEGUNDA. – CAUSA OBJETIVA Y NATURALEZA DE CONTRATACIÓN</div>
        <div class="clausula-contenido">
            A fin de cumplir con los servicios materia del Contrato Principal, <strong>LA EMPRESA</strong> requiere cubrir temporalmente el puesto de <strong>"{{ $trabajador->cargo ?? 'CARGO' }}"</strong>, para lo cual requiere contratar los servicios de una persona que labore temporalmente bajo la modalidad denominada de Servicio Específico a fin de efectuar los trabajos de "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA".
        </div>

        <div class="clausula-contenido">
            Las partes dejan constancia que, durante la vigencia del presente Contrato de Trabajo, <strong>EL TRABAJADOR</strong> se encontrará subordinado de manera exclusiva a <strong>LA EMPRESA</strong>, no manteniendo ningún tipo de vínculo laboral con la Empresa Principal a la cual será desplazado.
        </div>

        <div class="clausula-contenido">
            En tal virtud el presente Contrato se celebra de conformidad con los artículos 53°,54°,57 y siguientes del Texto Único Ordenado del Decreto Legislativo N° 728, aprobado por Decreto Supremo N° 003-97-TR, Ley de Productividad y Competitividad Laboral (en adelante) LA LEY.
        </div>

        <div class="clausula-titulo">CLAUSULA TERCERA. – OBJETO DEL CONTRATO</div>
        <div class="clausula-contenido">
            En razón de la causa objetiva señalada en la Cláusula Segunda, por el presente documento <strong>LA EMPRESA</strong> contrata a plazo determinado bajo la modalidad de Servicio Específico para que <strong>EL TRABAJADOR</strong> realice las labores de <strong>"{{ $trabajador->cargo ?? 'OBJETO_CARGO' }}"</strong>, según perfil de puesto. Se deja
        </div>

        
    </div>
</div>

<!-- PÁGINA 2 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">
        <div class="clausula-contenido">
            constancia que <strong>EL TRABAJADOR</strong> cumplirá las labores materia del presente Contrato en el Centro de Operaciones de la Empresa Principal, concretamente en la Unidad Alpamarca, ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín.
        </div>

        <div class="clausula-contenido">
            Tratándose de un contrato de trabajo sujeto a modalidad por servicio específico, se deja constancia que el presente está sujeto a la temporalidad y contingencias que deriven de la ejecución del "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA". Para los cuales <strong>LA EMPRESA</strong> fue contratada en virtud al Contrato Principal suscrito con COMPAÑÍA MINERA CHUNGAR SAC., situación que <strong>EL TRABAJADOR</strong> declara conocer plenamente, aceptando a través de la suscripción del presente cualquier cambio que se produzca en la relación contractual entre <strong>LA EMPRESA</strong> y COMPAÑÍA MINERA CHUNGAR SAC (Empresa Principal), y que incida en la relación laboral que por este acto se formaliza entre <strong>LA EMPRESA</strong> y <strong>EL TRABAJADOR</strong>.
        </div>

        <div class="clausula-contenido">
            Se deja constancia que las funciones que desempeñara <strong>EL TRABAJADOR</strong> podrán ser modificadas en el futuro por <strong>LA EMPRESA</strong>, en ejercicio de sus facultades de dirección y administración de sus recursos humanos y materiales que legalmente le corresponden, pudiendo incluso disponer que <strong>EL TRABAJADOR</strong> desempeñe otras labores en adición o en sustitución de las originalmente asignadas, siempre que resulten compatibles con la naturaleza del presente contrato.
        </div>

        <div class="clausula-titulo">CLAUSULA CUARTA. - PLAZO DE VIGENCIA</div>
        <div class="clausula-contenido">
            El inicio del acuerdo contractual es: <strong>{{ $fechaInicioFormateada }}</strong>. El plazo de Vigencia del presente contrato entre <strong>EL TRABAJADOR</strong> y <strong>LA EMPRESA</strong> es por el periodo de <strong>({{ $duracionContrato }})</strong> del <strong>{{ $fechaInicioFormateada }}</strong> al <strong>{{ $fechaFinFormateada }}</strong>.
        </div>

        <div class="clausula-contenido">
            Las partes acuerdan que la suspensión del contrato de trabajo por alguna de las causas previstas en el artículo 12° de <strong>LA LEY</strong> no interrumpirá el plazo de duración del Contrato.
        </div>

        <div class="clausula-titulo">CLAUSULA QUINTA. – JORNADA Y HORARIO DE TRABAJO</div>
        <div class="clausula-contenido">
            Ambas partes convienen que los servicios a ser prestados conforme el presente contrato se sujetaran a la jornada y horario de trabajo que establezca <strong>LA EMPRESA</strong> en el área en que <strong>EL TRABAJADOR</strong> prestara sus servicios. Las partes dejan expresa constancia que la jornada de trabajo, horario de trabajo y día o días de descanso de <strong>EL TRABAJADOR</strong> no serán fijos, sino más bien flexibles. En consecuencia, ambas partes convienen en que <strong>EL EMPLEADOR</strong>, de acuerdo a sus necesidades operativas, productivas y administrativas, tendrán la facultad de determinar y variar los días de trabajo, el día de descanso semanal obligatorio, los horarios y jornada de trabajos, pudiendo incluso modificar, suprimir o implantar turnos rotativos y establecer jornadas atípicas, concentradas o compensatorias de trabajo y descanso. En tal sentido en razón al sistema de Operaciones de <strong>LA EMPRESA</strong> y en propio beneficio del trabajador, ambas partes acuerdan que <strong>EL TRABAJADOR</strong>, deberá prestar sus servicios en el siguiente horario Sistema <strong>(14*7)</strong>, de <strong>08:00 am a 07:37 pm</strong>. Teniendo un refrigerio de <strong>(80 minutos)</strong>, que será de <strong>12:30 pm a 1:50 pm</strong>. De igual manera queda establecido que los turnos de trabajo serán rotativos, según la programación y necesidades de <strong>LA EMPRESA</strong>, queda expresamente establecido que la modalidad de horario de trabajo puede ser modificado de acuerdo a las necesidades de la empresa. El control de los periodos de trabajo, de descanso y horario de trabajo, estará a cargo de <strong>LA EMPRESA</strong>, la cual entregará al TRABAJADOR una tarjeta de tarea diario y una papeleta de movimiento de personal para su periodo de descanso para su control.
        </div>

    </div>
</div>

<!-- PÁGINA 3 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">

    
        <div class="clausula-contenido">
            En caso de faltas injustificadas, suspensiones, permisos y en general cualquier otra ausencia o circunstancia que a criterio de la empresa no sea justificada de <strong>EL TRABAJADOR</strong> implicarán la pérdida de la remuneración de manera proporcional a la duración de dicha ausencia, sin perjuicio del ejercicio de las facultades disciplinarias que <strong>LA EMPRESA</strong> podrá ejecutar de conformidad con la legislación laboral vigente y las normas internas de <strong>LA EMPRESA</strong>.
        </div>

        <div class="clausula-titulo">CLAUSULA SEXTA. - RETRIBUCIÓN</div>
        <div class="clausula-contenido">
            @if($tipoSalario === 'Mensual')
                El trabajador percibirá como contraprestación por los servicios prestados un Sueldo Mensual de S/. {{ number_format($contrato->salario_mensual ?? 0, 2) }} (<strong>{{ strtoupper(numeroEnLetras(intval($contrato->salario_mensual ?? 0))) }} con 00/100</strong> soles), monto que le será abonado en forma mensual.
            @elseif($tipoSalario === 'Jornal')
                El trabajador percibirá como contraprestación por los servicios prestados un Jornal diario de S/. {{ number_format($contrato->salario_jornal ?? 0, 2) }} (<strong>{{ strtoupper(numeroEnLetras(intval($contrato->salario_jornal ?? 0))) }} con 00/100</strong> soles), monto que le será abonado en forma mensual.
            @else
                El trabajador percibirá como contraprestación por los servicios prestados una remuneración que será determinada según lo pactado, monto que le será abonado en forma mensual.
            @endif
        </div>

        <div class="clausula-contenido">
            Las ausencias injustificadas por parte de <strong>EL TRABAJADOR</strong> implicarán la pérdida de la remuneración de manera proporcional a la duración de dicha ausencia, sin perjuicio del ejercicio de las facultades disciplinarias que <strong>LA EMPRESA</strong> podrá ejecutar de conformidad con la legislación laboral vigente y las normas internas de <strong>LA EMPRESA</strong>.
        </div>

        <div class="clausula-titulo">CLÁUSALA SÉPTIMA. - INFORMACIÓN DE LA EMPRESA PRINCIPAL</div>
        <div class="clausula-contenido">
            De conformidad con los Artículos 4° y 6° de la Ley N° 29245, Ley que Regula los Servicios de Tercerización, así como de conformidad con el Artículo 8° del Decreto Supremo N° 006-2008-TR, Reglamento de la Ley que regulan los Servicios de Tercerización, <strong>LA EMPRESA</strong> informara al trabajador acerca de la identidad de la empresa principal cuando lo solicite.
        </div>

        <div class="clausula-titulo">ACTIVIDADES A EJECUTARSE CONFORME AL OBJETO DEL CONTRATO PRINCIPAL</div>

        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> ha recibido una Orden de Servicio de "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA", en adelante denominado Contrato Principal, con la COMPAÑÍA MINERA CHUNGAR SAC., con el objeto de ejecutar el "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA", en la Unidad Alpamarca, ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín.
        </div>

        <div class="clausula-contenido">
            Conforme a lo establecido en el Contrato Principal, la obra denominada Unidad Alpamarca es donde se ejecutarán labores de "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA", servicios contratados con <strong>LA EMPRESA</strong> por COMPAÑÍA MINERA CHUNGAR SAC., se vienen ejecutando y continuarán ejecutándose en la Unidad Alpamarca, ubicada en el Distrito de Santa Barbara de Carhuacayan, Provincia de Yauli y Departamento de Junín.
        </div>

        <div class="clausula-titulo">CLAUSULA OCTAVA. - DEBERES DEL TRABAJADOR</div>
        <div class="clausula-contenido">
            <strong>EL TRABAJADOR</strong> se obliga a cumplir con lealtad y eficiencia sus obligaciones y las funciones propias de su puesto de trabajo, así como las demás que le sean encomendadas. De igual manera, <strong>EL TRABAJADOR</strong> se compromete a cumplir las órdenes e instrucciones que le imparta <strong>LA EMPRESA</strong> o sus representantes, así como las normas propias del centro de trabajo y las demás normas que se impartan por necesidades de la obra o del servicio. Asimismo, <strong>EL TRABAJADOR</strong> se compromete a aplicar en el desempeño de sus labores toda su experiencia y capacidad de trabajo, así como a cumplir con las normas contenidas en el Reglamento Interno de Trabajo de <strong>LA EMPRESA</strong>, el Reglamento de Seguridad e Higiene Ocupacional, el Reglamento de Seguridad y Salud en el Trabajo, así como también las órdenes, normas y disposiciones que la Empresa cree conveniente del Centro de Trabajo y que imparta <strong>LA EMPRESA</strong> en ejercicio de las facultades conferidas en el art. 9° de la LPCL.
        </div>

    </div>
</div>

<!-- PÁGINA 4 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">

    
        <div class="clausula-contenido">
            Finalmente, <strong>EL TRABAJADOR</strong> se compromete a guardar total y absoluta reserva respecto de toda la información a la que pudiera haber tenido acceso directa o indirectamente, en relación a los negocios de <strong>LA EMPRESA</strong>, sus asociados y/o clientes. Esta obligación subsistirá aún después de terminada la relación laboral y su incumplimiento generará la correspondiente responsabilidad por los daños y perjuicios que su accionar pudiera ocasionar a <strong>LA EMPRESA</strong>.
        </div>

        <div class="clausula-titulo">CLAUSULA NOVENA. - DEBERES DE LA EMPRESA</div>
        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> se obliga a abonar puntualmente a <strong>EL TRABAJADOR</strong> las remuneraciones y beneficios que le correspondan por Ley y en virtud a lo pactado en el presente Contrato, así como a cumplir con las demás obligaciones que señale la Ley.
        </div>

        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> entregara los documentos de índole legal para su buen desempeño en sus trabajos referentes a temas laborales y de seguridad y salud en el trabajo:
        </div>

        <div class="lista-contenido">
            <strong>a.</strong> RIT – Reglamento Interno De Trabajo<br>
            <strong>b.</strong> RISST – Reglamento De Seguridad Y Salud En El Trabajo<br>
            <strong>c.</strong> REGLAMENTO DE SEGURIDAD Y SALUD EN EL TRABAJO – D.S. N° 024-2016-EM y su modificatoria D.S. N° 023-2017-EM<br>
            <strong>d.</strong> Otros, dependiendo del SGSST de la UM y/o cliente.
        </div>

        <div class="clausula-contenido">
            Así mismo <strong>LA EMPRESA</strong> hará entrega los siguientes documentos:
        </div>

        <div class="lista-contenido">
            <strong>a.</strong> Certificado de trabajo que especifique el tiempo de servicios y la naturaleza de las labores desempeñadas por el extrabajador (El trabajador se encuentra obligado a acercarse a recabar dicho certificado).<br>
            <strong>b.</strong> Hoja de liquidación de beneficios sociales incluyendo; Compensación por tiempo de servicio trunca (CTS), vacaciones truncas y gratificaciones truncas (el trabajador se encuentra obligado a acercarse a recabar dicho documento).
        </div>

        <div class="clausula-titulo">CLAUSULA DÉCIMA. - DEL CUMPLIMIENTO DEL CÓDIGO DE ÉTICA Y CONFLICTOS DE INTERESES</div>
        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> tiene políticas y regulaciones para los trabajadores, en relación a temas vinculados al empleo y la conducta que <strong>EL TRABAJADOR</strong> debe acatar o cumplir en razón de su vínculo laboral con <strong>LA EMPRESA</strong>. Dentro de esas políticas destaca el Sistema Integrado de Gestión en Medio Ambiente, Seguridad y Salud Ocupacional, Reglamento Interno de Trabajo, Reglamento de Seguridad y Salud en el trabajo, las que norman el uso adecuado de recursos informáticos y de tecnología de información en general, las que regulan el uso de todo tipo y de bienes de propiedad de <strong>LA EMPRESA</strong>, etc., que <strong>EL TRABAJADOR</strong> deberá cerciorarse de conocer y de observar estrictamente. <strong>LA EMPRESA</strong> se reserva el derecho de modificar todas o algunas de dichas regulaciones, de tiempo en tiempo, de acuerdo a su criterio y cumplirá con ponerlas en conocimiento a todos los trabajadores para que sean debidamente acatadas.
        </div>

        <div class="clausula-contenido">
            <strong>EL TRABAJADOR</strong> evitará cualquier acción que tenga o pueda tener como resultado un conflicto real o aparente de intereses con <strong>LA EMPRESA</strong>, sin perjuicio de poner en conocimiento de su Gerencia y de la Administración General, cualquier caso que <strong>EL TRABAJADOR</strong> tenga la duda que pudiese representar un conflicto de intereses con <strong>LA EMPRESA</strong>. En estos casos, el uso del sentido común y criterio son básicos por parte de <strong>EL TRABAJADOR</strong>.
        </div>

    </div>
</div>

<!-- PÁGINA 5 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">

    
        <div class="clausula-titulo">CLÁUSULA DÉCIMO PRIMERA. -NORMAS DE SEGURIDAD EN EL PUESTO DE TRABAJO</div>
        <div class="clausula-contenido">
            <strong>EL TRABAJADOR</strong> dará cumplimiento a las normas legales de prevención de accidentes vigentes y a las políticas establecidas por <strong>LA EMPRESA</strong> en materia de Seguridad y Salud en el trabajo, así como lo dispuesto por las normas de Seguridad e Higiene en la Minería.
        </div>

        <div class="clausula-contenido">
            Conforme a lo establecido en el Art. 35 inciso c) de la Ley N° 29783, ley de Seguridad y Salud en el Trabajo y Art. 30 de su Reglamento aprobado por el Decreto Supremo N° 005-2012-TR, se adjunta las RECOMENDACIONES DE SEGURDAD OCUPACIONAL Y MEDIO AMBIENTE (SSOMA) de <strong>LA EMPRESA</strong> es la encargada de IDENTIFICAR, EVALUAR Y CONTROLAR LOS PELIGROS Y RIESGOS relacionados con la seguridad y salud en el trabajo.
        </div>

        <div class="clausula-contenido">
            Así mismo, de conformidad con el Art. 26 inciso b) el Reglamento de la Ley de Seguridad y Salud en el Trabajo, aprobado por Decreto Supremo N°005-2012-TR, mediante el presente documento se informa a <strong>EL TRABAJADOR</strong> que el ÁREA DE SEGURIDAD Y SALUD OCUPACIONAL Y MEDIO AMBIENTE (SSOMA) de <strong>LA EMPRESA</strong> es la encargada de IDENTIFICAR, EVALUAR Y CONTROLAR LOS PELIGROS Y RIESGOS relacionados con la seguridad y salud en el trabajo.
        </div>

        <div class="clausula-contenido">
            Adicionalmente a las ya señaladas en el presente contrato, <strong>EL TRABAJADOR</strong> deberá seguir las siguientes recomendaciones DE MANERA OBLIGATORIA en materia de seguridad y salud en el trabajo:
        </div>

        <div class="lista-contenido">
            <strong>a.</strong> Cumplir con los procedimientos de inducción en seguridad y salud en el trabajo antes de ingreso a la obra/proyecto que ejecuta <strong>LA EMPRESA</strong>.<br>
            <strong>b.</strong> Participar de las capacitaciones y entrenamientos en los procedimientos que tiene que realizar para el cumplimiento de sus funciones y responsabilidades<br>
            <strong>c.</strong> Informarse sobre la conformación del COMITÉ DE SEGURIDAD Y SALUD EN EL TRABAJO de su unidad o proyecto, quiénes son sus representantes y cuáles son sus funciones y responsabilidades<br>
            <strong>d.</strong> Utilizar el equipo de protección personal EPP para protección de la integridad y salud durante la ejecución de trabajos bajo su responsabilidad.
        </div>

        <div class="clausula-titulo">CLAUSULA DÉCIMA SEGUNDA. - SOBRE LAS ENFERMEDADES PROFESIONALES</div>
        <div class="clausula-contenido">
            <strong>EL TRABAJADOR</strong> reconoce que la hipoacusia, silicosis y/o neumoconiosis son algunas de las enfermedades propias de la actividad minera, por lo que el presente contrato cubre dicho riesgo a través de la contratación por parte de <strong>LA EMPRESA</strong> del seguro complementario de trabajo de riesgo. En tal sentido, <strong>EL TRABAJADOR</strong> siempre y cuando se acredite la vigencia de seguro complementario de trabajo de riesgo durante la prestación de los servicios, exonera desde ya de toda responsabilidad a <strong>LA EMPRESA</strong> y renuncia expresamente a iniciar cualquier tipo de acción indemnizatoria por daños y perjuicios derivados de enfermedad profesional y/o accidente de trabajo, sea por responsabilidad contractual o extracontractual, incluyendo el lucro cesante, daño emergente y/o daño moral.
        </div>

        <div class="clausula-contenido">
            Sin perjuicio de lo antes expuesto, <strong>EL TRABAJADOR</strong> reconoce que la pensión que le pudiera corresponder en virtud del seguro complementario de trabajo de riesgo como consecuencia de cualquier enfermedad profesional y/o accidente de trabajo que pudiera tener su origen en la relación laboral con <strong>LA EMPRESA</strong>, sustituyo y/o compensa en su integridad cualquier monto que se pudiera demandar vía acción de indemnización por daños y perjuicios por responsabilidad contractual o extracontractual, incluyendo el lucro cesante, el daño emergente y/o el daño moral.
        </div>

    </div>
</div>
<!-- PÁGINA 6 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">
    
        <div class="clausula-contenido">
            Por otro lado, en la presente clausula, <strong>LA EMPRESA</strong> se encuentra obligada a proporcionar los implementos de Seguridad a <strong>EL TRABAJADOR</strong> con la finalidad de reducir los riesgos de contraer enfermedad profesional. En caso que <strong>LA EMPRESA</strong> no cumpla con proporcionar dichos implementos de seguridad o los que proporcione no sean suficientes, <strong>EL TRABAJADOR</strong> se obliga a presentar una queja escrita ante su Supervisor o a su elección una queja ante la Autoridad de Trabajo, en el plazo de 24 horas de ocurrido el hecho. En caso no presentar dicha queja, se entiende que <strong>EL TRABAJADOR</strong> ha recibido a su satisfacción y de acuerdo con los dispositivos legales vigentes para el tipo de actividad que desarrolla.
        </div>

        <div class="clausula-titulo">CLAUSULA DÉCIMO TERCERA. - CONDICIONES DE TRABAJO</div>
        <div class="clausula-contenido">
            Para el cabal cumplimiento de sus obligaciones laborales, <strong>LA EMPRESA</strong> determinará los implementos, sistemas, equipos, materiales, herramientas y demás condiciones de trabajo que considere sean requeridos para el cabal desempeño de las labores encomendadas a <strong>EL TRABAJADOR</strong>. Por su parte, <strong>EL TRABAJADOR</strong> reconoce expresamente que le está terminantemente prohibido emplear dichos elementos de trabajo para fines personales o ajenos al cumplimiento del presente contrato de trabajo. El incumplimiento de esta prohibición por parte de <strong>EL TRABAJADOR</strong> facultará a <strong>LA EMPRESA</strong> a adoptar las medidas disciplinarias que resulten pertinentes.
        </div>

        <div class="clausula-contenido">
            Al momento de producirse el cese de <strong>EL TRABAJADOR</strong>, sea por cualquier causa, se encontrará obligado a devolver a <strong>LA EMPRESA</strong> todos los implementos, sistemas, equipos, fotocheck, materiales, herramientas y demás condiciones de trabajo otorgados por este para el debido cumplimiento de las obligaciones laborales.
        </div>

        <div class="clausula-titulo">CLÁUSULA DÉCIMO CUARTA. – SUSPENSIÓN DEL CONTRATO</div>
        <div class="clausula-contenido">
            Se deja constancia que la suspensión del presente contrato de trabajo procederá cuando se produzca alguna de las causas previstas en el art. 12° de la LPCL.
        </div>

        <div class="clausula-titulo">CLAUSULA DÉCIMO QUINTA. - CAUSAS DE EXTINCIÓN</div>
        <div class="clausula-contenido">
            Son causas de extinción del presente contrato de trabajo al producirse una de las causales de los siguientes artículos. 16°, 23°, 24°, 25° del TUO D. Leg. N° 728° LEY DE PRODUCTIVIDAD Y COMPETITIVIDAD LABORAL
        </div>

        <div class="lista-contenido">
            <strong>a.</strong> Fallecimiento del trabajador<br>
            <strong>b.</strong> Renuncia o retiro voluntario documentado.<br>
            <strong>c.</strong> El vencimiento del plazo establecido en la cláusula tercera del presente contrato.<br>
            <strong>d.</strong> El Rendimiento deficiente en relación con la capacidad de <strong>EL TRABAJADOR</strong>.<br>
            <strong>e.</strong> La negativa injustificada de someterse al examen médico ocupacional periódico anual, etc.<br>
            <strong>f.</strong> La falta grave ante un suceso y/o evento en la labor.<br>
            <strong>g.</strong> Faltas injustificadas continúas.<br>
            <strong>h.</strong> Apropiación de bienes de la empresa.<br>
            <strong>i.</strong> Paralización de Labores por el Área a quien presta el servicio.
        </div>

        <div class="clausula-titulo">CLÁUSULA DÉCIMO SEXTA. - CONDICIÓN RESOLUTORIA</div>
        <div class="clausula-contenido">
            Atendiendo a que la causa objetiva que justifica la contratación temporal materia del presente es el cumplimiento de "CIERRE DE LA RELAVERA AGUASCOCHA (PRIMERA ETAPA)- UNIDAD ALPAMARCA" materia del Contrato Principal suscrito entre <strong>LA EMPRESA</strong> y COMPAÑÍA MINERA CHUNGAR SAC. (Empresa Principal), las partes acuerdan que, de conformidad con lo establecido por el 
        </div>
    </div>
</div>


<!-- PÁGINA 7 -->
<div class="page-wrapper">
    <img src="data:image/jpeg;base64,{{ $bgData }}" class="page-bg">
    <div class="page-content">
  <div class="clausula-contenido">
 art. 16°, inc. c) de la LPCL, el presente Contrato quedará resuelto y se extinguirá por tanto la relación laboral existente entre <strong>LA EMPRESA</strong> y <strong>EL TRABAJADOR</strong>, en caso el Contrato Principal antes reseñado sea resuelto y quede sin efecto, situación que <strong>EL TRABAJADOR</strong> declara conocer con la suscripción del presente.
        </div>
        <div class="clausula-titulo">CLAUSULA DÉCIMO SÉPTIMA. - TERMINO DEL CONTRATO</div>
        <div class="clausula-contenido">
            <strong>LA EMPRESA</strong> NO estará obligada a otorgar PRE. AVISO alguno a <strong>EL TRABAJADOR</strong> para efectos de la terminación del presente contrato, operando su extinción de modo automático al vencimiento del plazo convenido en la cláusula cuarta precedente (terminación del contrato y/o de su renovación por conclusión natural de su plazo de duración)
        </div>

        <div class="clausula-titulo">CLAUSALA DÉCIMO OCTAVA. -  NORMAS APLICABLES</div>
        <div class="clausula-contenido">
            Las partes dejan expresa constancia que el presente Contrato se celebra al amparo de lo establecido en el art. 63° de la LPCL, que regula el Contrato de Trabajo Sujeto a Modalidad por Servicio Específico, así como en virtud a lo establecido por Ley N° 29245, Ley que Regula los Servicios de Tercerización, y el Decreto Supremo N° 006-2008-TR, Reglamento de la Ley que regula los Servicios de Tercerización.
        </div>

        <div class="clausula-titulo">CLAUSULA DÉCIMO NOVENA. - DE LA VALIDEZ DEL CONTRATO</div>
        <div class="clausula-contenido">
            Las partes reconocen que el presente contrato es un acto jurídico válido que no implica renuncia de derechos de ningún tipo, razón por la cual se ratifican en cada una de sus cláusulas, por ser esa la voluntad expresa de las partes. Además, <strong>EL TRABAJADOR</strong> deja expresa constancia que en la celebración del presente contrato no ha mediado error, dolo, violencia, presión, intimidación, coacción o cualquier vicio que afectase su voluntad, manifestando que actúa libremente y por propia decisión en su calidad de ciudadano en pleno uso de sus facultades.
        </div>

        <div class="clausula-titulo">CLÁUSULA VIGÉSIMO. – JURISDICCIÓN</div>
        <div class="clausula-contenido">
            Ambas partes renuncian expresamente al fuero de sus respectivos domicilios y se someten, para todos los efectos relativos a la validez, interpretación y/o ejecución de los términos del presente Contrato, a los Juzgados y Salas Laborales de Pasco.
        </div>

        <div class="clausula-titulo">CLÁUSULA VIGÉSIMO PRIMERA. - DOMICILIO DE LAS PARTES</div>
        <div class="clausula-contenido">
            Las partes fijan como sus domicilios los indicados en la parte introductoria de este documento para cualquier comunicación sucesiva relacionada con el mismo o con la relación laboral que mantienen, teniéndose por bien efectuadas las notificaciones o comunicaciones cursadas a los mismos. Cualquier variación del domicilio sólo surtirá efecto si es previamente comunicada a la otra parte por vía notarial con diez (10) días de anticipación y el nuevo domicilio se encuentra localizado en el Perú.
        </div>

        <p class="clausula-contenido" style="text-align: left; margin-top: 0.5cm;">En señal de plena conformidad, ambas partes suscriben el presente documento, que se extiende en dos (02) ejemplares de idéntico tenor, en Huayllay, a {{ $dia_numero }} días del mes de {{ $mes }} del {{ $year }}.</p>

        <div class="firmas">
            <div class="firma-bloque">
                <div class="linea-firma"></div>
                <p><strong>EL TRABAJADOR</strong></p>
            </div>
            <div class="firma-bloque">
                <div class="linea-firma"></div>
                <p><strong>LA EMPRESA</strong></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>