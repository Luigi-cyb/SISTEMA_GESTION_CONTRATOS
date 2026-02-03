@php
    // Obtener el patrón de la plantilla
    $patron = $plantilla->patron_tipo ?? 'a';
    $rutaTemplate = 'contratos.templates.patron-' . strtolower($patron);
@endphp

@include($rutaTemplate)