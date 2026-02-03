@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 sm:py-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-10 bg-blue-600 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-900">Editar Contrato</h1>
            </div>
            <p class="text-sm text-gray-600 ml-4">Contrato: <span class="font-medium text-gray-800">{{ $contrato->numero_contrato }}</span></p>
        </div>

        <!-- Contenedor Principal -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- Información General -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-gray-200 px-6 sm:px-8 py-8">
                <h2 class="text-xs font-bold text-gray-600 uppercase tracking-widest mb-8">Información General</h2>
                <div class="grid grid-cols-2 gap-8">
                    <!-- Columna 1 - Izquierda -->
                    <div>
                        <div class="mb-8">
                            <p class="text-xs font-medium text-gray-600 mb-2">Contrato</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $contrato->numero_contrato }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600 mb-2">Trabajador</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $contrato->trabajador->nombre_completo }}</p>
                            <p class="text-xs text-gray-500">{{ $contrato->dni }}</p>
                        </div>
                    </div>

                    <!-- Columna 2 - Derecha -->
                    <div>
                        <div class="mb-8">
                            <p class="text-xs font-medium text-gray-600 mb-2">Creado</p>
                            <p class="text-sm text-gray-700">{{ $contrato->created_at->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-600 mb-2">Actualizado</p>
                            <p class="text-sm text-gray-700">{{ $contrato->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <form action="{{ route('contratos.update', $contrato->id) }}" method="POST" class="divide-y divide-gray-200">
                @csrf
                @method('PATCH')

                <!-- Errores de Validación -->
                @if ($errors->any())
                <div class="px-6 sm:px-8 py-4 bg-red-50 border-l-4 border-red-500">
                    <p class="text-sm font-semibold text-red-900 mb-2">Se encontraron errores:</p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-800">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- SECCIÓN: Tipo y Duración -->
                <div class="px-6 sm:px-8 py-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6">Tipo y Duración</h3>
                    <div class="grid grid-cols-2 gap-8">
                        
                        <!-- Izquierda -->
                        <div class="space-y-6">
                            <!-- Tipo de Contrato -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Contrato *</label>
                                <select name="tipo_contrato" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('tipo_contrato') border-red-500 ring-red-500 @enderror">
                                    <option value="">Selecciona tipo</option>
                                    <option value="Para servicio específico" {{ old('tipo_contrato', $contrato->tipo_contrato) === 'Para servicio específico' ? 'selected' : '' }}>Para servicio específico</option>
                                    <option value="Por incremento de actividad" {{ old('tipo_contrato', $contrato->tipo_contrato) === 'Por incremento de actividad' ? 'selected' : '' }}>Por incremento de actividad</option>
                                    <option value="Otros" {{ old('tipo_contrato', $contrato->tipo_contrato) === 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('tipo_contrato')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Inicio -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Inicio *</label>
                                <input type="date" name="fecha_inicio" id="fecha_inicio" value="{{ old('fecha_inicio', $contrato->fecha_inicio?->format('Y-m-d')) }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fecha_inicio') border-red-500 ring-red-500 @enderror">
                                @error('fecha_inicio')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Firma (NUEVO) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Firma del Contrato</label>
                                <input type="date" name="fecha_firma_manual" id="fecha_firma_manual" value="{{ old('fecha_firma_manual', $contrato->fecha_firma_manual?->format('Y-m-d')) }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fecha_firma_manual') border-red-500 ring-red-500 @enderror">
                                <p class="mt-1 text-xs text-gray-500">Por defecto será 1 día antes de la fecha de inicio</p>
                                @error('fecha_firma_manual')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Derecha -->
                        <div class="space-y-6">
                            <!-- Horario -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Horario *</label>
                                <select name="horario" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('horario') border-red-500 ring-red-500 @enderror">
                                    <option value="">Selecciona horario</option>
                                    <option value="8 horas" {{ old('horario', $contrato->horario) === '8 horas' ? 'selected' : '' }}>8 horas</option>
                                    <option value="14x7" {{ old('horario', $contrato->horario) === '14x7' ? 'selected' : '' }}>14x7</option>
                                    <option value="5x2" {{ old('horario', $contrato->horario) === '5x2' ? 'selected' : '' }}>5x2</option>
                                    <option value="Otros" {{ old('horario', $contrato->horario) === 'Otros' ? 'selected' : '' }}>Otros</option>
                                </select>
                                @error('horario')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Fin *</label>
                                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $contrato->fecha_fin?->format('Y-m-d')) }}" required
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('fecha_fin') border-red-500 ring-red-500 @enderror">
                                @error('fecha_fin')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Remuneración -->
                <div class="px-6 sm:px-8 py-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6">Remuneración</h3>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <!-- Izquierda -->
                        <div class="space-y-6">
                            <!-- Modalidad de Pago -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Modalidad de Pago *</label>
                                <select name="tipo_salario" id="tipo_salario" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('tipo_salario') border-red-500 ring-red-500 @enderror">
                                    <option value="">Selecciona modalidad</option>
                                    <option value="Mensual" {{ old('tipo_salario', $contrato->tipo_salario) === 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                    <option value="Jornal" {{ old('tipo_salario', $contrato->tipo_salario) === 'Jornal' ? 'selected' : '' }}>Jornal</option>
                                    <option value="Ambos" {{ old('tipo_salario', $contrato->tipo_salario) === 'Ambos' ? 'selected' : '' }}>Ambos</option>
                                </select>
                                @error('tipo_salario')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salario Mensual -->
                            <div id="campo_mensual" style="display: none;">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Salario Mensual (S/.)</label>
                                <input type="number" name="salario_mensual" id="salario_mensual" value="{{ old('salario_mensual', $contrato->salario_mensual) }}" 
                                       step="0.01" min="0" placeholder="2,500.00"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>

                        <!-- Derecha -->
                        <div class="space-y-6">
                            <!-- Salario Jornal -->
                            <div id="campo_jornal" style="display: none;">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Salario Jornal (S/.)</label>
                                <input type="number" name="salario_jornal" id="salario_jornal" value="{{ old('salario_jornal', $contrato->salario_jornal) }}" 
                                       step="0.01" min="0" placeholder="120.00"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Plantilla y Estado -->
                <div class="px-6 sm:px-8 py-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6">Configuración</h3>
                    
                    <div class="grid grid-cols-2 gap-8">
                        <!-- Izquierda -->
                        <div class="space-y-6">
                            <!-- Plantilla -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Plantilla *</label>
                               <select name="plantilla_id" required
        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('plantilla_id') border-red-500 ring-red-500 @enderror">
    <option value="">Selecciona una plantilla</option>
    @foreach ($plantillas as $plantilla)
    <option value="{{ $plantilla->id }}" 
        {{ old('plantilla_id', $contrato->plantilla_id) == $plantilla->id ? 'selected' : '' }}
        title="{{ $plantilla->descripcion ?? '' }}">
        {{ $plantilla->codigo_prefijo ?? $plantilla->nombre }} - {{ $plantilla->nombre }}
    </option>
    @endforeach
</select>
                                @error('plantilla_id')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Derecha -->
                        <div class="space-y-6">
                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Estado del Contrato *</label>
                                <select name="estado" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('estado') border-red-500 ring-red-500 @enderror">
                                    <option value="">Selecciona estado</option>
                                    <option value="Borrador" {{ old('estado', $contrato->estado) === 'Borrador' ? 'selected' : '' }}>Borrador</option>
                                    <option value="Enviado a firmar" {{ old('estado', $contrato->estado) === 'Enviado a firmar' ? 'selected' : '' }}>Enviado a firmar</option>
                                    <option value="Firmado" {{ old('estado', $contrato->estado) === 'Firmado' ? 'selected' : '' }}>Firmado</option>
                                    <option value="Activo" {{ old('estado', $contrato->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Vencido" {{ old('estado', $contrato->estado) === 'Vencido' ? 'selected' : '' }}>Vencido</option>
                                    <option value="Cancelado" {{ old('estado', $contrato->estado) === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                </select>
                                @error('estado')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="px-6 sm:px-8 py-8 bg-gray-50 flex flex-col sm:flex-row gap-4 sm:gap-3">
                    <button type="submit" class="flex-1 sm:flex-none px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold text-sm rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                        Guardar Cambios
                    </button>
                    <a href="{{ route('contratos.show', $contrato->id) }}" class="flex-1 sm:flex-none px-8 py-3 bg-gray-300 hover:bg-gray-400 active:bg-gray-500 text-gray-900 font-semibold text-sm rounded-lg transition duration-200 text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript para mostrar/ocultar campos de salario y calcular fecha de firma -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tipoSalarioSelect = document.getElementById('tipo_salario');
    const campoMensual = document.getElementById('campo_mensual');
    const campoJornal = document.getElementById('campo_jornal');
    const inputMensual = document.getElementById('salario_mensual');
    const inputJornal = document.getElementById('salario_jornal');
    
    // NUEVO: Campos de fechas
    const fechaInicioInput = document.getElementById('fecha_inicio');
    const fechaFirmaInput = document.getElementById('fecha_firma_manual');
    
    function actualizarCamposSalario() {
        const tipoSeleccionado = tipoSalarioSelect.value;
        
        campoMensual.style.display = 'none';
        campoJornal.style.display = 'none';
        
        inputMensual.removeAttribute('required');
        inputJornal.removeAttribute('required');
        
        if (tipoSeleccionado === 'Mensual') {
            campoMensual.style.display = 'block';
            inputMensual.setAttribute('required', 'required');
        } else if (tipoSeleccionado === 'Jornal') {
            campoJornal.style.display = 'block';
            inputJornal.setAttribute('required', 'required');
        } else if (tipoSeleccionado === 'Ambos') {
            campoMensual.style.display = 'block';
            campoJornal.style.display = 'block';
            inputMensual.setAttribute('required', 'required');
            inputJornal.setAttribute('required', 'required');
        }
    }
    
    // NUEVO: Calcular fecha de firma automáticamente
    function calcularFechaFirma() {
        // Solo calcular si el campo de firma está vacío
        if (fechaInicioInput.value && !fechaFirmaInput.value) {
            const fechaInicio = new Date(fechaInicioInput.value + 'T00:00:00');
            fechaInicio.setDate(fechaInicio.getDate() - 1);
            
            const year = fechaInicio.getFullYear();
            const month = String(fechaInicio.getMonth() + 1).padStart(2, '0');
            const day = String(fechaInicio.getDate()).padStart(2, '0');
            
            fechaFirmaInput.value = `${year}-${month}-${day}`;
        }
    }
    
    // Ejecutar al cargar
    actualizarCamposSalario();
    
    // Ejecutar al cambiar
    tipoSalarioSelect.addEventListener('change', actualizarCamposSalario);
    fechaInicioInput.addEventListener('change', calcularFechaFirma);
});
</script>
@endsection