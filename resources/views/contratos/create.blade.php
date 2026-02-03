@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800">Crear Nuevo Contrato</h1>
                <p class="text-gray-600 mt-1">Completa los datos del nuevo contrato</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <!-- ALERTA: Trabajador en Lista Negra -->
                @if (session('trabajador_bloqueado'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-red-800">No se puede crear contrato</h3>
                            
                            <div class="mt-4 bg-white rounded p-4 border border-red-300">
                                <p class="text-sm text-gray-700 mb-3">
                                    <strong>El trabajador está en LISTA NEGRA</strong>
                                </p>
                                
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <strong class="text-gray-600">DNI:</strong>
                                        <span class="text-gray-900">{{ session('dni_bloqueado') }}</span>
                                    </div>
                                    <div>
                                        <strong class="text-gray-600">Tipo de Bloqueo:</strong>
                                        <span class="inline-block px-2 py-1 rounded text-xs font-semibold mt-1
                                            @if(session('tipo_bloqueo') === 'Leve')
                                                bg-yellow-100 text-yellow-800
                                            @else
                                                bg-red-100 text-red-800
                                            @endif
                                        ">
                                            {{ session('tipo_bloqueo') }}
                                        </span>
                                    </div>
                                    <div>
                                        <strong class="text-gray-600">Motivo:</strong>
                                        <p class="text-gray-800 mt-1 p-2 bg-gray-50 rounded border-l-2 border-red-500">
                                            {{ session('motivo_bloqueo') }}
                                        </p>
                                    </div>
                                </div>

                                @if(session('tipo_bloqueo') === 'Leve')
                                <div class="mt-4 pt-4 border-t border-red-300">
                                    <p class="text-sm text-gray-700 mb-3">
                                        Este bloqueo es <strong>LEVE</strong> y puede ser levantado.
                                    </p>
                                    <a href="{{ route('lista-negra.index') }}" 
                                        class="inline-block bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                                        Ir a Desbloquear Trabajador
                                    </a>
                                </div>
                                @else
                                <div class="mt-4 pt-4 border-t border-red-300">
                                    <p class="text-sm text-red-700">
                                        Este bloqueo es <strong>GRAVE</strong> y <strong>NO puede ser levantado</strong>.
                                    </p>
                                    <p class="text-xs text-red-600 mt-2">
                                        Contacte a RR.HH. para más información.
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('contratos.store') }}" method="POST" id="contratoForm">
                    @csrf

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>Error en la validación:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- SECCIÓN 1: Trabajador MEJORADA -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Trabajador</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-3">Selecciona Trabajador *</label>
                            <select name="dni" id="selector_trabajador" required
                                    style="border: 2px solid #d1d5db; padding: 10px 12px; border-radius: 6px; width: 100%; color: #111827; background-color: white;"
                                    class="focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 @error('dni') border-red-500 @enderror"
                                    onchange="mostrarAdvertenciaContrato()">
                                <option value="">-- Selecciona un trabajador --</option>
                                @foreach ($trabajadores as $trabajador)
                                <option value="{{ $trabajador->dni }}" 
                                        data-nombre="{{ $trabajador->nombre_completo }}"
                                        data-tiene-contrato="{{ $trabajador->contratos()->exists() ? 'true' : 'false' }}"
                                        {{ old('dni') === $trabajador->dni ? 'selected' : '' }}>
                                    {{ $trabajador->dni }} - {{ $trabajador->nombre_completo }}
                                    @if($trabajador->contratos()->exists())
                                        (⚠ Tiene contrato)
                                    @endif
                                </option>
                                @endforeach
                            </select>
                            @error('dni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <!-- Advertencia Dinámica de Contrato Existente -->
                            <div id="advertencia_contrato" style="display: none; margin-top: 16px;">
                                <div style="background-color: #fef3c7; border: 1px solid #fcd34d; border-left: 4px solid #f59e0b; border-radius: 6px; padding: 14px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; gap: 12px;">
                                        <div style="color: #f59e0b; font-size: 20px; flex-shrink: 0; line-height: 1;">⚠</div>
                                        <div>
                                            <p style="color: #92400e; font-weight: 600; font-size: 14px; margin: 0;">Advertencia: Contrato Existente</p>
                                            <p style="color: #b45309; font-size: 13px; margin: 6px 0 0 0;">Este trabajador ya tiene un contrato activo. Puedes continuar creando un nuevo contrato, pero se recomienda revisar el estado actual antes de proceder.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info del Trabajador Seleccionado -->
                            <div id="info_trabajador" style="display: none; margin-top: 16px;">
                                <div style="background-color: #dbeafe; border: 1px solid #7dd3fc; border-left: 4px solid #0284c7; border-radius: 6px; padding: 14px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                                    <div style="display: flex; gap: 12px;">
                                        <div style="color: #0284c7; font-size: 20px; flex-shrink: 0; line-height: 1;">ℹ</div>
                                        <div>
                                            <p style="color: #0c4a6e; font-weight: 600; font-size: 14px; margin: 0;">Trabajador Seleccionado</p>
                                            <p id="nombre_trabajador_display" style="color: #075985; font-size: 13px; margin: 4px 0 0 0;"></p>
                                            <p id="estado_contrato" style="color: #075985; font-size: 13px; margin: 4px 0 0 0;"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Tipo y Fechas -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Tipo y Fechas</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tipo de Contrato -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tipo de Contrato *</label>
                                <select name="tipo_contrato" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tipo_contrato') border-red-500 @enderror">
                                    <option value="">-- Selecciona un tipo --</option>
                                    <option value="Para servicio específico" {{ old('tipo_contrato') === 'Para servicio específico' ? 'selected' : '' }}>Para servicio específico</option>
                                    <option value="Por incremento de actividad" {{ old('tipo_contrato') === 'Por incremento de actividad' ? 'selected' : '' }}>Por incremento de actividad</option>
                                    <option value="Otros" {{ old('tipo_contrato') === 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('tipo_contrato')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Horario -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Horario *</label>
                                <select name="horario" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('horario') border-red-500 @enderror">
                                    <option value="">-- Selecciona horario --</option>
                                    <option value="8 horas" {{ old('horario') === '8 horas' ? 'selected' : '' }}>8 horas</option>
                                    <option value="14x7" {{ old('horario') === '14x7' ? 'selected' : '' }}>14x7</option>
                                    <option value="5x2" {{ old('horario') === '5x2' ? 'selected' : '' }}>5x2</option>
                                    <option value="Otros" {{ old('horario') === 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('horario')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Inicio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio *</label>
                                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_inicio') border-red-500 @enderror">
                                @error('fecha_inicio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Fin *</label>
                                <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_fin') border-red-500 @enderror">
                                @error('fecha_fin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Firma del Contrato -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Firma del Contrato</label>
                                <input type="date" name="fecha_firma_manual" id="fecha_firma_manual" value="{{ old('fecha_firma_manual') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_firma_manual') border-red-500 @enderror">
                                <p class="text-gray-500 text-xs mt-1">
                                    Por defecto será 1 día antes de la fecha de inicio
                                </p>
                                @error('fecha_firma_manual')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Remuneración -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Remuneración</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Tipo de Salario -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Modalidad de Pago *</label>
                                <select name="tipo_salario" id="tipo_salario" required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('tipo_salario') border-red-500 @enderror">
                                    <option value="">-- Selecciona modalidad --</option>
                                    <option value="Mensual" {{ old('tipo_salario') === 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                    <option value="Jornal" {{ old('tipo_salario') === 'Jornal' ? 'selected' : '' }}>Jornal</option>
                                </select>
                                @error('tipo_salario')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salario Mensual -->
                            <div id="campo_mensual" style="display: none;">
                                <label class="block text-sm font-medium text-gray-700">Salario Mensual (S/.) *</label>
                                <input type="number" name="salario_mensual" id="salario_mensual" value="{{ old('salario_mensual') }}" step="0.01" min="0"
                                       placeholder="Ej: 2500.00"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Salario Jornal -->
                            <div id="campo_jornal" style="display: none;">
                                <label class="block text-sm font-medium text-gray-700">Salario Jornal (S/.) *</label>
                                <input type="number" name="salario_jornal" id="salario_jornal" value="{{ old('salario_jornal') }}" step="0.01" min="0"
                                       placeholder="Ej: 120.00"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: Plantilla -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Plantilla</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Selecciona Plantilla *</label>
                            <select name="plantilla_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('plantilla_id') border-red-500 @enderror">
                                <option value="">-- Selecciona una plantilla --</option>
                                @foreach ($plantillas as $plantilla)
                                <option value="{{ $plantilla->id }}" 
                                    {{ old('plantilla_id') == $plantilla->id ? 'selected' : '' }}
                                    title="{{ $plantilla->descripcion ?? '' }}">
                                    {{ $plantilla->codigo_prefijo ?? $plantilla->nombre }} - {{ $plantilla->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('plantilla_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-gray-500 text-xs mt-1">Beneficios según Ley 728 se aplicarán automáticamente</p>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            Guardar
                        </button>
                        <a href="{{ route('contratos.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para mostrar/ocultar campos y advertencias -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSalarioSelect = document.getElementById('tipo_salario');
    const campoMensual = document.getElementById('campo_mensual');
    const campoJornal = document.getElementById('campo_jornal');
    const inputMensual = document.getElementById('salario_mensual');
    const inputJornal = document.getElementById('salario_jornal');
    
    const fechaInicioInput = document.querySelector('input[name="fecha_inicio"]');
    const fechaFirmaInput = document.getElementById('fecha_firma_manual');
    
    const selectorTrabajador = document.getElementById('selector_trabajador');
    const advertenciaContrato = document.getElementById('advertencia_contrato');
    const infoTrabajador = document.getElementById('info_trabajador');
    
    function actualizarCamposSalario() {
        const tipoSeleccionado = tipoSalarioSelect.value;
        
        campoMensual.style.display = 'none';
        campoJornal.style.display = 'none';
        
        inputMensual.value = '';
        inputJornal.value = '';
        
        inputMensual.removeAttribute('required');
        inputJornal.removeAttribute('required');
        
        if (tipoSeleccionado === 'Mensual') {
            campoMensual.style.display = 'block';
            inputMensual.setAttribute('required', 'required');
        } else if (tipoSeleccionado === 'Jornal') {
            campoJornal.style.display = 'block';
            inputJornal.setAttribute('required', 'required');
        }
    }
    
    function calcularFechaFirma() {
        if (fechaInicioInput.value && !fechaFirmaInput.value) {
            const fechaInicio = new Date(fechaInicioInput.value + 'T00:00:00');
            fechaInicio.setDate(fechaInicio.getDate() - 1);
            
            const year = fechaInicio.getFullYear();
            const month = String(fechaInicio.getMonth() + 1).padStart(2, '0');
            const day = String(fechaInicio.getDate()).padStart(2, '0');
            
            fechaFirmaInput.value = `${year}-${month}-${day}`;
        }
    }
    
    // ✅ NUEVA FUNCIÓN: Mostrar advertencia de contrato existente
    window.mostrarAdvertenciaContrato = function() {
        const opcionSeleccionada = selectorTrabajador.options[selectorTrabajador.selectedIndex];
        const tieneContrato = opcionSeleccionada.getAttribute('data-tiene-contrato');
        const nombre = opcionSeleccionada.getAttribute('data-nombre');
        
        if (!opcionSeleccionada.value) {
            advertenciaContrato.style.display = 'none';
            infoTrabajador.style.display = 'none';
            return;
        }
        
        // Mostrar info del trabajador
        infoTrabajador.style.display = 'block';
        document.getElementById('nombre_trabajador_display').textContent = 'Nombre: ' + nombre;
        
        if (tieneContrato === 'true') {
            advertenciaContrato.style.display = 'block';
            document.getElementById('estado_contrato').textContent = 'Estado: Tiene contrato activo';
        } else {
            advertenciaContrato.style.display = 'none';
            document.getElementById('estado_contrato').textContent = 'Estado: Sin contrato activo';
        }
    }
    
    // Ejecutar al cargar la página
    actualizarCamposSalario();
    calcularFechaFirma();
    mostrarAdvertenciaContrato();
    
    // Ejecutar al cambiar
    tipoSalarioSelect.addEventListener('change', actualizarCamposSalario);
    fechaInicioInput.addEventListener('change', calcularFechaFirma);
});
</script>

@endsection