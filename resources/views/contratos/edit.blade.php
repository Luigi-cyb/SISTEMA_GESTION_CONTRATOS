@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-indigo-600">
                <div class="p-6 flex items-center">
                    <div class="p-3 rounded-full bg-indigo-50 mr-4">
                        <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Editar Contrato</h1>
                        <p class="text-gray-600 text-sm mt-1">
                            Contrato: <span
                                class="font-mono font-medium text-gray-900 bg-gray-100 px-2 py-0.5 rounded">{{ $contrato->numero_contrato }}</span>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Contenedor Principal -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">

                <!-- Información General (Solo lectura) -->
                <div class="bg-gray-50 border-b border-gray-100 p-6 sm:px-8">
                    <div class="flex items-center mb-4">
                        <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 mr-3">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h2 class="text-lg font-bold text-gray-700">Información General</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Trabajador</p>
                            <div class="flex items-center">
                                <div
                                    class="bg-blue-100 text-blue-800 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3 text-xs">
                                    {{ substr($contrato->trabajador->nombres, 0, 1) }}{{ substr($contrato->trabajador->apellidos, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $contrato->trabajador->nombre_completo }}
                                    </p>
                                    <p class="text-xs text-gray-500">DNI: {{ $contrato->dni }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Creado</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $contrato->created_at->format('d/m/Y') }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Actualizado</p>
                                <p class="text-sm font-semibold text-gray-700">{{ $contrato->updated_at->format('d/m/Y') }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulario -->
                <form action="{{ route('contratos.update', $contrato->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    @php
                        // Lógica para detectar si es "Otros" (Manual)
                        // Como $tipos y $horarios incluyen los valores de la BD, normalmente el valor
                        // del contrato actual estará en el array.
                        // Solo sería "Otros" si por alguna razón no está en la lista cargada.
                        $esTipoOtro = !in_array($contrato->tipo_contrato, $tipos) && !empty($contrato->tipo_contrato);
                        $esHorarioOtro = !in_array($contrato->horario, $horarios) && !empty($contrato->horario);
                    @endphp

                    <div class="p-8 space-y-10">

                        <!-- Errores de Validación -->
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded shadow-sm">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-medium text-red-800">Se encontraron errores</h3>
                                        <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- SECCIÓN: Tipo y Duración -->
                        <div class="pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Tipo de Contrato y Vigencia</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Tipo de Contrato -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Contrato *</label>
                                    <div class="relative">
                                        <select name="tipo_contrato_select" id="tipo_contrato_select" required
                                            class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                            <option value="">Selecciona tipo</option>
                                            @foreach($tipos as $tipoOption)
                                                @if($tipoOption !== 'Otros')
                                                <option value="{{ $tipoOption }}" {{ (old('tipo_contrato_select') == $tipoOption || ($contrato->tipo_contrato == $tipoOption && !$esTipoOtro)) ? 'selected' : '' }}>
                                                    {{ $tipoOption }}
                                                </option>
                                                @endif
                                            @endforeach
                                            <option value="Otros" {{ (old('tipo_contrato_select') == 'Otros' || $esTipoOtro) ? 'selected' : '' }}>Otros (Especificar)</option>
                                        </select>
                                    </div>

                                    <!-- Campo oculto para especificar (MANUAL) -->
                                    <div id="div_tipo_contrato_otro"
                                        class="mt-3 {{ (old('tipo_contrato_select') == 'Otros' || $esTipoOtro) ? '' : 'hidden' }} transition-all duration-300 ease-in-out">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Especifique el Tipo de
                                            Contrato *</label>
                                        <input type="text" name="tipo_contrato_otro" id="tipo_contrato_otro"
                                            value="{{ old('tipo_contrato_otro', $esTipoOtro ? $contrato->tipo_contrato : '') }}"
                                            class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm"
                                            placeholder="Ingrese el tipo de contrato manualmente">
                                    </div>
                                </div>

                                <!-- Horario -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Horario *</label>
                                    <select name="horario_select" id="horario_select" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                        <option value="">Selecciona horario</option>
                                        @foreach($horarios as $horarioOption)
                                            @if($horarioOption !== 'Otros')
                                            <option value="{{ $horarioOption }}" {{ (old('horario_select') == $horarioOption || ($contrato->horario == $horarioOption && !$esHorarioOtro)) ? 'selected' : '' }}>
                                                {{ $horarioOption }}
                                            </option>
                                            @endif
                                        @endforeach
                                        <option value="Otros" {{ (old('horario_select') == 'Otros' || $esHorarioOtro) ? 'selected' : '' }}>Otros (Especificar)</option>
                                    </select>

                                    <!-- Campo oculto para especificar (MANUAL) -->
                                    <div id="div_horario_otro"
                                        class="mt-3 {{ (old('horario_select') == 'Otros' || $esHorarioOtro) ? '' : 'hidden' }} transition-all duration-300 ease-in-out">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Especifique el Horario
                                            *</label>
                                        <input type="text" name="horario_otro" id="horario_otro"
                                            value="{{ old('horario_otro', $esHorarioOtro ? $contrato->horario : '') }}"
                                            class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm"
                                            placeholder="Ingrese el horario manualmente">
                                    </div>
                                </div>

                                <!-- Fecha Inicio -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio *</label>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio"
                                        value="{{ old('fecha_inicio', $contrato->fecha_inicio?->format('Y-m-d')) }}"
                                        required
                                        class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                </div>

                                <!-- Fecha Fin -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Fin *</label>
                                    <input type="date" name="fecha_fin"
                                        value="{{ old('fecha_fin', $contrato->fecha_fin?->format('Y-m-d')) }}" required
                                        class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                </div>

                                <!-- Fecha de Firma -->
                                <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Firma del
                                        Contrato</label>
                                    <div class="flex items-center gap-4">
                                        <div class="flex-grow">
                                            <input type="date" name="fecha_firma_manual" id="fecha_firma_manual"
                                                value="{{ old('fecha_firma_manual', $contrato->fecha_firma_manual?->format('Y-m-d')) }}"
                                                class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                        </div>
                                        <div class="flex-shrink-0 text-gray-500 text-sm italic">
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Info</span>
                                            Automáticamente: 1 día antes del inicio
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN: Remuneración -->
                        <div class="pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Detalles de Remuneración</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Modalidad -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Modalidad de Pago *</label>
                                    <select name="tipo_salario" id="tipo_salario" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                        <option value="">Selecciona modalidad</option>
                                        <option value="Mensual" {{ old('tipo_salario', $contrato->tipo_salario) === 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                        <option value="Jornal" {{ old('tipo_salario', $contrato->tipo_salario) === 'Jornal' ? 'selected' : '' }}>Jornal</option>
                                        <option value="Ambos" {{ old('tipo_salario', $contrato->tipo_salario) === 'Ambos' ? 'selected' : '' }}>Ambos (Mensual + Jornal)</option>
                                    </select>
                                </div>

                                <!-- Salario Mensual -->
                                <div id="campo_mensual" style="display: none;" class="md:col-span-1">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Salario Mensual (S/.)</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">S/.</span>
                                        </div>
                                        <input type="number" name="salario_mensual" id="salario_mensual"
                                            value="{{ old('salario_mensual', $contrato->salario_mensual) }}" step="0.01"
                                            min="0" placeholder="2,500.00"
                                            class="focus:ring-yellow-500 focus:border-yellow-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5">
                                    </div>
                                </div>

                                <!-- Salario Jornal -->
                                <div id="campo_jornal" style="display: none;" class="md:col-span-1">
                                    <label class="block text-sm font-bold text-gray-700 mb-2">Salario Jornal (S/.)</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">S/.</span>
                                        </div>
                                        <input type="number" name="salario_jornal" id="salario_jornal"
                                            value="{{ old('salario_jornal', $contrato->salario_jornal) }}" step="0.01"
                                            min="0" placeholder="120.00"
                                            class="focus:ring-yellow-500 focus:border-yellow-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN: Plantilla y Estado -->
                        <div class="pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                        </path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Configuración</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Plantilla -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Plantilla *</label>
                                    <select name="plantilla_id" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                        <option value="">Selecciona una plantilla</option>
                                        @foreach ($plantillas as $plantilla)
                                            <option value="{{ $plantilla->id }}" {{ old('plantilla_id', $contrato->plantilla_id) == $plantilla->id ? 'selected' : '' }}
                                                title="{{ $plantilla->descripcion ?? '' }}">
                                                {{ $plantilla->codigo_prefijo ?? $plantilla->nombre }} -
                                                {{ $plantilla->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Estado -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado del Contrato
                                        *</label>
                                    <select name="estado" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                        <option value="">Selecciona estado</option>
                                        <option value="Borrador" {{ old('estado', $contrato->estado) === 'Borrador' ? 'selected' : '' }}>Borrador</option>
                                        <option value="Enviado a firmar" {{ old('estado', $contrato->estado) === 'Enviado a firmar' ? 'selected' : '' }}>Enviado a firmar</option>
                                        <option value="Firmado" {{ old('estado', $contrato->estado) === 'Firmado' ? 'selected' : '' }}>Firmado</option>
                                        <option value="Activo" {{ old('estado', $contrato->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Vencido" {{ old('estado', $contrato->estado) === 'Vencido' ? 'selected' : '' }}>Vencido</option>
                                        <option value="Cancelado" {{ old('estado', $contrato->estado) === 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Botones -->
                    <div class="px-8 py-5 bg-gray-50 flex justify-end gap-4 rounded-b-lg">
                        <a href="{{ route('contratos.index') }}"
                            class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                                </path>
                            </svg>
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- JavaScript para mostrar/ocultar campos de salario y calcular fecha de firma -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            // --- LÓGICA PARA TIPO CONTRATO Y HORARIO (MANUAL) ---
            const selectTipoContrato = document.getElementById('tipo_contrato_select');
            const divTipoContratoOtro = document.getElementById('div_tipo_contrato_otro');
            const inputTipoContratoOtro = document.getElementById('tipo_contrato_otro');

            function actualizarTipoContrato() {
                if (selectTipoContrato.value === 'Otros') {
                    divTipoContratoOtro.classList.remove('hidden');
                    inputTipoContratoOtro.setAttribute('required', 'required');
                } else {
                    divTipoContratoOtro.classList.add('hidden');
                    inputTipoContratoOtro.removeAttribute('required');
                }
            }

            selectTipoContrato.addEventListener('change', actualizarTipoContrato);
            actualizarTipoContrato(); // Ejecutar al inicio

            const selectHorario = document.getElementById('horario_select');
            const divHorarioOtro = document.getElementById('div_horario_otro');
            const inputHorarioOtro = document.getElementById('horario_otro');

            function actualizarHorario() {
                if (selectHorario.value === 'Otros') {
                    divHorarioOtro.classList.remove('hidden');
                    inputHorarioOtro.setAttribute('required', 'required');
                } else {
                    divHorarioOtro.classList.add('hidden');
                    inputHorarioOtro.removeAttribute('required');
                }
            }

            selectHorario.addEventListener('change', actualizarHorario);
            actualizarHorario(); // Ejecutar al inicio
        });
    </script>
@endsection