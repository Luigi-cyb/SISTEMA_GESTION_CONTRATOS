@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800">🔄 Renovar Contrato (Crear Adenda)</h1>
                <p class="text-gray-600 mt-1">Crea una adenda para renovar el contrato respetando el límite de 5 años</p>
            </div>
        </div>

        <!-- Información del Contrato Original -->
        <div class="bg-blue-50 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">📋 Información del Contrato Original</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-600 text-sm">Número de Contrato</p>
                        <p class="text-gray-900 font-semibold">{{ $contrato->numero_contrato }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Trabajador</p>
                        <p class="text-gray-900 font-semibold">{{ $contrato->trabajador->nombre_completo }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Fecha de Fin del Contrato Original</p>
                        <p class="text-gray-900 font-semibold">{{ $contrato->fecha_fin->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tipo de Contrato</p>
                        <p class="text-gray-900 font-semibold">{{ $contrato->tipo_contrato }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tiempo Acumulado Actual</p>
                        <p class="text-gray-900 font-semibold">{{ number_format($tiempoActual, 2) }} meses ({{ number_format($tiempoActual / 12, 2) }} años)</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Salario</p>
                        <p class="text-gray-900 font-semibold">
                            @if ($contrato->tipo_salario === 'Mensual')
                                S/. {{ number_format($contrato->salario_mensual, 2) }}/mes
                            @elseif ($contrato->tipo_salario === 'Jornal')
                                S/. {{ number_format($contrato->salario_jornal, 2) }}/día
                            @else
                                S/. {{ number_format($contrato->salario_mensual, 2) }}/mes o S/. {{ number_format($contrato->salario_jornal, 2) }}/día
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- ✅ NUEVO: Información de disponibilidad de tiempo -->
        <div class="bg-purple-50 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">⏱️ Disponibilidad de Tiempo Restante</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <p class="text-gray-600 text-sm">Límite Máximo (4 años 11 meses)</p>
                        <p class="text-gray-900 font-bold text-lg">59 meses</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tiempo Acumulado</p>
                        <p class="text-red-600 font-bold text-lg">{{ number_format($tiempoActual, 2) }} meses</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tiempo Disponible</p>
                        <p class="text-green-600 font-bold text-lg">{{ number_format($mesesDisponibles, 2) }} meses</p>
                    </div>
                </div>
                <p class="text-purple-700 text-sm mt-4">
                    ⚠️ <strong>IMPORTANTE:</strong> Máximo permitido = <strong>4 años 11 meses (59 meses)</strong>
                    <br>Esto deja <strong>1 mes de diferencia</strong> antes de completar 5 años
                    <br>Máximo a añadir en esta adenda: <strong>{{ number_format($mesesDisponibles, 2) }} meses</strong>
                    <br><strong>Fecha máxima permitida:</strong> {{ $fechaFinMaxima->format('d/m/Y') }}
                </p>
            </div>
        </div>

        <!-- ✅ NUEVO: Información de la Última Adenda (si existe) -->
        @if ($ultimaAdenda)
        <div class="bg-green-50 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">📌 Última Adenda (Datos Base para la Nueva)</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-600 text-sm">Número de Adenda</p>
                        <p class="text-gray-900 font-semibold">#{{ $ultimaAdenda->numero_adenda }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Fecha de Inicio</p>
                        <p class="text-gray-900 font-semibold">{{ $ultimaAdenda->fecha_inicio->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Fecha de Fin</p>
                        <p class="text-gray-900 font-semibold">{{ $ultimaAdenda->fecha_fin->format('d/m/Y') }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tiempo Acumulado</p>
                        <p class="text-gray-900 font-semibold">{{ number_format($ultimaAdenda->tiempo_acumulado_total_meses, 2) }} meses</p>
                    </div>
                </div>
                <p class="text-green-700 text-sm mt-4">
                    ✅ La nueva adenda iniciará automáticamente el <strong>{{ $fechaInicioDefault->format('d/m/Y') }}</strong> 
                    (un día después del vencimiento de la adenda anterior)
                </p>
            </div>
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-300 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <p class="text-yellow-800 text-sm">
                    ℹ️ Esta es la primera adenda. Se creará basada en el contrato original.
                    <br>Iniciará el <strong>{{ $fechaInicioDefault->format('d/m/Y') }}</strong> 
                    (un día después del vencimiento del contrato original)
                </p>
            </div>
        </div>
        @endif

        <!-- Advertencia de Estabilidad -->
        @php
            $tiempo_nuevo = $tiempoActual + $mesesDisponibles;
        @endphp
        
        @if ($tiempoActual >= 56)
        <div class="bg-red-50 border-l-4 border-red-600 p-6 mb-6 rounded">
            <h3 class="text-lg font-bold text-red-800 mb-2">⚠️ ALERTA CRÍTICA: ESTABILIDAD LABORAL</h3>
            <p class="text-red-700">
                El trabajador está <strong>muy próximo al límite de 4 años 11 meses (59 meses)</strong> de antigüedad.
                <br><br>
                <strong>Tiempo acumulado actual:</strong> {{ number_format($tiempoActual, 2) }} meses
                <br><strong>Límite máximo permitido:</strong> 59 meses (4 años 11 meses)
                <br><strong>Tiempo disponible:</strong> {{ number_format($mesesDisponibles, 2) }} meses
                <br><strong>Límite legal (5 años):</strong> 60 meses
            </p>
            <p class="text-red-700 mt-3">
                <strong>⚡ IMPORTANTE:</strong> Esta es la ÚLTIMA adenda permitida antes de alcanzar los 5 años.
                <br>Al crear esta adenda, deberá tomar una decisión inmediata:
                <br>✅ Renovar como Indefinido (trabajador se vuelve estable)
                <br>❌ No renovar (cese con liquidación)
                <br>⏸️ Prórroga (extender plazo de decisión)
            </p>
        </div>
        @endif

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('adendas.store') }}" method="POST" id="formAdenda">
                    @csrf

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>❌ Error en la validación:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- Campo oculto: Contrato ID -->
                    <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">

                    <!-- SECCIÓN: Fechas de la Adenda -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">📅 Vigencia de la Adenda</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fecha Inicio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio *</label>
                                <p class="text-gray-600 text-xs mb-2">
                                    @if ($ultimaAdenda)
                                        (Por defecto: 1 día después de la adenda anterior)
                                    @else
                                        (Por defecto: 1 día después del contrato original)
                                    @endif
                                </p>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" 
                                       value="{{ old('fecha_inicio', $fechaInicioDefault->format('Y-m-d')) }}" required
                                       readonly
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 @error('fecha_inicio') border-red-500 @enderror">
                                @error('fecha_inicio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-blue-600 text-xs mt-1">🔒 Campo no editable (determinado automáticamente)</p>
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Fin *</label>
                                <p class="text-gray-600 text-xs mb-2">
                                    Máximo: <strong id="fechaFinMaximaTexto">{{ $fechaFinMaxima->format('d/m/Y') }}</strong>
                                </p>
                                <input type="date" name="fecha_fin" id="fecha_fin"
                                       value="{{ old('fecha_fin', $fechaFinDefault->format('Y-m-d')) }}" 
                                       min="{{ $fechaInicioDefault->format('Y-m-d') }}"
                                       max="{{ $fechaFinMaxima->format('Y-m-d') }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_fin') border-red-500 @enderror">
                                @error('fecha_fin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-green-600 text-xs mt-1" id="diasRestantes">
                                    ✅ Seleccione una fecha
                                </p>
                            </div>

                            <!-- Fecha de Firma -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Fecha de Firma *</label>
                                <p class="text-gray-600 text-xs mb-2">(Por defecto: 1 día antes de la fecha de inicio)</p>
                                <input type="date" name="fecha_firma" id="fecha_firma" 
                                       value="{{ old('fecha_firma', $fechaFirmaDefault->format('Y-m-d')) }}" required
                                       readonly
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 @error('fecha_firma') border-red-500 @enderror">
                                @error('fecha_firma')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-blue-600 text-xs mt-1">🔒 Campo no editable (determinado automáticamente)</p>
                            </div>
                        </div>

                        <div class="mt-6 p-4 bg-gray-100 rounded">
                            <p class="text-sm text-gray-700">
                                <strong>ℹ️ Nota:</strong> 
                                <br>• Los datos del trabajador, salario, horario y beneficios se copiarán automáticamente del contrato original.
                                <br>• La <strong>Fecha de Inicio</strong> y <strong>Fecha de Firma</strong> se calculan automáticamente.
                                <br>• La <strong>Fecha de Fin</strong> está limitada a <strong>{{ $fechaFinMaxima->format('d/m/Y') }}</strong> (máximo permitido).
                                <br>• Si intenta seleccionar una fecha posterior al máximo, será bloqueada automáticamente.
                            </p>
                        </div>
                    </div>

                    <!-- Indicador visual de duración -->
                    <div class="mb-8 p-4 bg-blue-50 border border-blue-300 rounded">
                        <h3 class="font-bold text-blue-800 mb-2">📊 Duración de esta Adenda</h3>
                        <p class="text-sm text-blue-700">
                            Duración: <strong id="duracionAdenda">0 días (0.00 meses)</strong>
                        </p>
                        <p class="text-sm text-blue-700 mt-2">
                            Tiempo total acumulado después de esta adenda: <strong id="tiempoTotalNuevo">{{ number_format($tiempoActual, 2) }}</strong> meses
                        </p>
                        <p class="text-sm text-blue-700 mt-2">
                            Estado: <strong id="estadoValidacion">✅ Pendiente de seleccionar fecha</strong>
                        </p>
                    </div>

                    <!-- Resumen -->
                    <div class="mb-8 p-4 bg-green-50 border border-green-300 rounded">
                        <h3 class="font-bold text-green-800 mb-2">✅ Resumen de la Renovación</h3>
                        <ul class="text-sm text-green-700 space-y-1">
                            <li>✓ Se creará una Adenda #{{ ($ultimaAdenda ? $ultimaAdenda->numero_adenda : 0) + 1 }}</li>
                            <li>✓ Se copiarán todos los datos del contrato original</li>
                            <li>✓ Se actualizará el tiempo acumulado a <strong id="resumenTiempo">{{ number_format($tiempoActual, 2) }}</strong> meses</li>
                            <li>✓ El contrato permanecerá vinculado al mismo trabajador</li>
                            <li>✓ Se podrá descargar un PDF de la adenda para firma</li>
                            <li>✓ La fecha de fin <strong>no podrá exceder {{ $fechaFinMaxima->format('d/m/Y') }}</strong></li>
                        </ul>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" id="btnSubmit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-6 rounded disabled:bg-gray-400 disabled:cursor-not-allowed">
                            ✅ Crear Adenda y Renovar
                        </button>
                        <a href="{{ route('contratos.show', $contrato->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            ❌ Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // ✅ VALIDACIÓN Y CÁLCULOS EN TIEMPO REAL
    const fechaInicioInput = document.getElementById('fecha_inicio');
    const fechaFinInput = document.getElementById('fecha_fin');
    const fechaFirmaInput = document.getElementById('fecha_firma');
    const btnSubmit = document.getElementById('btnSubmit');
    const duracionAdendaElem = document.getElementById('duracionAdenda');
    const tiempoTotalNuevoElem = document.getElementById('tiempoTotalNuevo');
    const resumenTiempoElem = document.getElementById('resumenTiempo');
    const diasRestantesElem = document.getElementById('diasRestantes');
    const estadoValidacionElem = document.getElementById('estadoValidacion');
    const fechaFinMaximaTextoElem = document.getElementById('fechaFinMaximaTexto');
    
    // Datos del servidor
    const tiempoActual = {{ $tiempoActual }};
    const mesesDisponibles = {{ $mesesDisponibles }};
    const fechaInicioDefault = '{{ $fechaInicioDefault->format('Y-m-d') }}';
    const fechaFinMaximaStr = '{{ $fechaFinMaxima->format('Y-m-d') }}';
    const fechaFinMaximaObj = new Date('{{ $fechaFinMaxima->format('Y-m-d') }}');
    
    console.log('🔍 Valores de control:');
    console.log('  Tiempo actual:', tiempoActual);
    console.log('  Meses disponibles:', mesesDisponibles);
    console.log('  Fecha máxima:', fechaFinMaximaStr);
    
    // ✅ Función: Calcular duración en días y meses
    function calcularDuracion() {
        const fechaInicio = new Date(fechaInicioInput.value);
        const fechaFin = new Date(fechaFinInput.value);
        
        if (!fechaInicioInput.value || !fechaFinInput.value) {
            duracionAdendaElem.textContent = '0 días (0.00 meses)';
            return 0;
        }
        
        const diasDiferencia = Math.floor((fechaFin - fechaInicio) / (1000 * 60 * 60 * 24));
        const mesesDiferencia = (diasDiferencia / 30.44).toFixed(2);
        
        duracionAdendaElem.textContent = diasDiferencia + ' días (' + mesesDiferencia + ' meses)';
        
        return parseFloat(mesesDiferencia);
    }
    
    // ✅ Función: Actualizar tiempo total
    function actualizarTiempoTotal() {
        const mesesAdenda = calcularDuracion();
        const tiempoTotal = tiempoActual + mesesAdenda;
        
        tiempoTotalNuevoElem.textContent = tiempoTotal.toFixed(2);
        resumenTiempoElem.textContent = tiempoTotal.toFixed(2);
        
        console.log('📊 Validación de tiempo:');
        console.log('  Meses en adenda:', mesesAdenda);
        console.log('  Tiempo total:', tiempoTotal.toFixed(2));
        console.log('  Límite máximo:', 59.0);
        
        // ✅ VALIDACIÓN: Si supera 59 meses, marcar error
        if (tiempoTotal > 59.0) {
            console.log('❌ BLOQUEADO: Supera 59 meses');
            fechaFinInput.classList.add('border-red-500', 'bg-red-50');
            diasRestantesElem.classList.remove('text-green-600');
            diasRestantesElem.classList.add('text-red-600');
            diasRestantesElem.innerHTML = '❌ <strong>ERROR:</strong> Esta fecha supera los 4 años 11 meses (59 meses). Tiempo total sería: ' + tiempoTotal.toFixed(2) + ' meses.';
            estadoValidacionElem.innerHTML = '❌ <strong>BLOQUEADO:</strong> Supera límite de 59 meses (4 años 11 meses)';
            estadoValidacionElem.classList.add('text-red-600');
            btnSubmit.disabled = true;
        } else {
            console.log('✅ PERMITIDO: Dentro del límite');
            fechaFinInput.classList.remove('border-red-500', 'bg-red-50');
            diasRestantesElem.classList.remove('text-red-600');
            diasRestantesElem.classList.add('text-green-600');
            diasRestantesElem.innerHTML = '✅ Válido. Tiempo total: ' + tiempoTotal.toFixed(2) + ' meses (' + (tiempoTotal / 12).toFixed(2) + ' años)';
            estadoValidacionElem.innerHTML = '✅ <strong>VÁLIDO:</strong> Dentro del límite de 59 meses (4 años 11 meses)';
            estadoValidacionElem.classList.remove('text-red-600');
            btnSubmit.disabled = false;
        }
    }
    
    // ✅ Event Listeners
    fechaFinInput.addEventListener('change', actualizarTiempoTotal);
    fechaFinInput.addEventListener('input', actualizarTiempoTotal);
    
    // ✅ Inicializar cálculos al cargar la página
    window.addEventListener('load', function() {
        console.log('✅ Página cargada');
        actualizarTiempoTotal();
    });
</script>
@endsection