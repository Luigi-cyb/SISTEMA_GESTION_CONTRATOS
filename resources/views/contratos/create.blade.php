@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-blue-600">
            <div class="p-6 flex items-center">
                <div class="p-3 rounded-full bg-blue-50 mr-4">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Crear Nuevo Contrato</h1>
                    <p class="text-gray-600 text-sm mt-1">Completa los datos del nuevo contrato para el trabajador</p>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-8">
                <!-- ALERTA: Trabajador en Lista Negra (Mantenemos lógica existente) -->
                @if (session('trabajador_bloqueado'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-8 rounded shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-6 w-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-lg font-medium text-red-800">No se puede crear contrato</h3>
                            
                            <div class="mt-4 bg-white rounded-md p-4 border border-red-200 shadow-sm">
                                <p class="text-sm text-gray-700 mb-3">
                                    <strong>El trabajador está en LISTA NEGRA</strong>
                                </p>
                                
                                <div class="space-y-2 text-sm">
                                    <div>
                                        <strong class="text-gray-600">DNI:</strong>
                                        <span class="text-gray-900 font-mono bg-gray-100 px-2 py-0.5 rounded">{{ session('dni_bloqueado') }}</span>
                                    </div>
                                    <div>
                                        <strong class="text-gray-600">Tipo de Bloqueo:</strong>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium mt-1
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
                                        <p class="text-gray-800 mt-2 p-3 bg-red-50 rounded border-l-4 border-red-500 italic">
                                            "{{ session('motivo_bloqueo') }}"
                                        </p>
                                    </div>
                                </div>

                                @if(session('tipo_bloqueo') === 'Leve')
                                <div class="mt-4 pt-4 border-t border-red-100">
                                    <p class="text-sm text-gray-700 mb-3">
                                        Este bloqueo es <strong>LEVE</strong> y puede ser levantado.
                                    </p>
                                    <a href="{{ route('lista-negra.index') }}" 
                                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition">
                                        Ir a Desbloquear Trabajador
                                    </a>
                                </div>
                                @else
                                <div class="mt-4 pt-4 border-t border-red-100">
                                    <p class="text-sm text-red-700 font-semibold">
                                        Este bloqueo es GRAVE y NO puede ser levantado.
                                    </p>
                                    <p class="text-xs text-red-500 mt-1">
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
                    <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Se encontraron errores de validación</h3>
                                <ul class="mt-2 list-disc list-inside text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- SECCIÓN 1: Trabajador -->
                    <div class="mb-10 pb-8 border-b border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Datos del Trabajador</h2>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona Trabajador *</label>

                            <div class="relative w-full">
                                <!-- Input Visual de Búsqueda -->
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                    
                                    <input type="text" id="buscador_visual" 
                                           placeholder="Buscar por DNI o Nombre..." 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 pl-10 pr-10 py-2.5 text-gray-900 placeholder-gray-400 transition-all duration-200"
                                           autocomplete="off">

                                    <!-- Botón para limpiar (X) -->
                                    <button type="button" id="btn_limpiar_busqueda" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500 cursor-pointer hidden transition-colors"
                                            title="Limpiar búsqueda">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>

                                <!-- Lista Flotante de Resultados -->
                                <ul id="lista_resultados" 
                                    class="absolute z-50 w-full bg-white border border-gray-300 rounded-lg shadow-xl mt-1 max-h-60 overflow-y-auto hidden">
                                    <!-- Se llena con JS -->
                                </ul>

                                <!-- Select Oculto (Mantiene la funcionalidad original del form) -->
                                <select name="dni" id="selector_trabajador" class="hidden" required>
                                    <option value="">-- Selecciona un trabajador --</option>
                                    @foreach ($trabajadores as $trabajador)
                                    <option value="{{ $trabajador->dni }}" 
                                            data-nombre="{{ $trabajador->nombre_completo }}"
                                            data-unidad="{{ $trabajador->unidad ?? '' }}"
                                            data-tiene-contrato="{{ $trabajador->contratos()->exists() ? 'true' : 'false' }}"
                                            {{ (old('dni') ?? $trabajador_dni ?? '') == $trabajador->dni ? 'selected' : '' }}>
                                        {{ $trabajador->dni }} - {{ $trabajador->nombre_completo }}
                                        @if($trabajador->contratos()->exists())
                                            (⚠ Tiene contrato)
                                        @endif
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            @error('dni')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror

                            <!-- Advertencia Dinámica de Contrato Existente -->
                            <div id="advertencia_contrato" style="display: none; margin-top: 16px;">
                                <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-md shadow-sm">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-amber-800">Advertencia: Contrato Existente</h3>
                                            <div class="mt-2 text-sm text-amber-700">
                                                <p>Este trabajador ya tiene un contrato activo. Revisa su estado antes de continuar.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Info del Trabajador Seleccionado -->
                            <div id="info_trabajador" style="display: none; margin-top: 16px;">
                                <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-md shadow-sm">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800">Trabajador Seleccionado</h3>
                                            <div class="mt-2 text-sm text-blue-700">
                                                <p id="nombre_trabajador_display" class="font-semibold"></p>
                                                <p id="estado_contrato" class="mt-1"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Lógica del Autocomplete -->
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const buscadorInput = document.getElementById('buscador_visual');
                            const listaResultados = document.getElementById('lista_resultados');
                            const selectorOculto = document.getElementById('selector_trabajador');
                            const btnLimpiar = document.getElementById('btn_limpiar_busqueda');
                            const opcionesOriginales = Array.from(selectorOculto.options).filter(opt => opt.value !== ""); // Ignorar placeholder

                            // Función para mostrar resultados
                            function filtrarResultados(filtro = '') {
                                listaResultados.innerHTML = '';
                                const term = filtro.toLowerCase().trim();
                                
                                const resultados = opcionesOriginales.filter(opt => {
                                    return opt.textContent.toLowerCase().includes(term);
                                });

                                if (resultados.length === 0) {
                                    listaResultados.innerHTML = '<li class="px-4 py-2 text-gray-500 italic text-sm">No se encontraron resultados</li>';
                                } else {
                                    resultados.forEach(opt => {
                                        const li = document.createElement('li');
                                        li.className = 'px-4 py-2 hover:bg-blue-50 cursor-pointer text-gray-700 text-sm border-b border-gray-100 last:border-0 transition-colors';
                                        
                                        // Resaltar coincidencia
                                        if(term) {
                                            const regex = new RegExp(`(${term})`, 'gi');
                                            li.innerHTML = opt.textContent.replace(regex, '<span class="bg-yellow-200 font-semibold">$1</span>');
                                        } else {
                                            li.textContent = opt.textContent;
                                        }

                                        li.onclick = () => seleccionarTrabajador(opt.value, opt.textContent);
                                        listaResultados.appendChild(li);
                                    });
                                }
                                
                                listaResultados.classList.remove('hidden');
                            }

                            // Selección
                            function seleccionarTrabajador(valor, texto) {
                                selectorOculto.value = valor;
                                buscadorInput.value = texto.trim(); // Mostrar nombre seleccionado
                                listaResultados.classList.add('hidden');
                                btnLimpiar.classList.remove('hidden');
                                
                                // Disparar eventos manualmente
                                selectorOculto.dispatchEvent(new Event('change'));
                                window.mostrarAdvertenciaContrato(); // Llamar a tu función existente
                            }

                            // Eventos Input
                            buscadorInput.addEventListener('input', function() {
                                if (this.value.length > 0) {
                                    btnLimpiar.classList.remove('hidden');
                                    filtrarResultados(this.value);
                                } else {
                                    btnLimpiar.classList.add('hidden');
                                    listaResultados.classList.add('hidden');
                                }
                            });

                            // Mostrar todo al hacer click (si está vacío)
                            buscadorInput.addEventListener('focus', function() {
                                if (this.value.trim() === '') {
                                    filtrarResultados('');
                                }
                            });

                            // Cerrar al hacer click fuera
                            document.addEventListener('click', function(e) {
                                if (!buscadorInput.contains(e.target) && !listaResultados.contains(e.target)) {
                                    listaResultados.classList.add('hidden');
                                }
                            });

                            // Limpiar
                            btnLimpiar.addEventListener('click', function() {
                                buscadorInput.value = '';
                                selectorOculto.value = '';
                                listaResultados.classList.add('hidden');
                                this.classList.add('hidden');
                                selectorOculto.dispatchEvent(new Event('change'));
                                window.mostrarAdvertenciaContrato();
                            });

                            // Preselección inicial (si viene del controlador)
                            if (selectorOculto.value) {
                                const opcionSeleccionada = opcionesOriginales.find(opt => opt.value === selectorOculto.value);
                                if (opcionSeleccionada) {
                                    buscadorInput.value = opcionSeleccionada.textContent.trim();
                                    btnLimpiar.classList.remove('hidden');
                                    window.mostrarAdvertenciaContrato();
                                }
                            }
                        });
                    </script>

                    <!-- SECCIÓN 2: Tipo y Fechas -->
                    <div class="mb-10 pb-8 border-b border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Tipo de Contrato y Vigencia</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Tipo de Contrato -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tipo de Contrato *</label>
                                <div class="relative">
                                    <select name="tipo_contrato_select" id="tipo_contrato_select" required autocomplete="off"
                                            class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150 @error('tipo_contrato') border-red-500 @enderror">
                                        <option value="">-- Selecciona un tipo --</option>
                                        @foreach($tipos as $tipoOption)
                                            @if($tipoOption !== 'Otros')
                                            <option value="{{ $tipoOption }}" {{ old('tipo_contrato') === $tipoOption ? 'selected' : '' }}>{{ $tipoOption }}</option>
                                            @endif
                                        @endforeach
                                        <option value="Otros" {{ old('tipo_contrato') === 'Otros' ? 'selected' : '' }}>Otros (Especificar)</option>
                                    </select>
                                </div>
                                
                                <!-- Campo oculto para especificar "Otros" -->
                                <div id="div_tipo_contrato_otro" class="mt-3 hidden transition-all duration-300 ease-in-out">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Especifique el Tipo de Contrato *</label>
                                    <input type="text" name="tipo_contrato_otro" id="tipo_contrato_otro"
                                           class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm"
                                           placeholder="Ingrese el tipo de contrato manualmente">
                                </div>

                                @error('tipo_contrato')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Horario -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Horario *</label>
                                <select name="horario_select" id="horario_select" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150 @error('horario') border-red-500 @enderror">
                                    <option value="">-- Selecciona horario --</option>
                                    @foreach($horarios as $horarioOption)
                                        @if($horarioOption !== 'Otros')
                                        <option value="{{ $horarioOption }}" {{ old('horario') === $horarioOption ? 'selected' : '' }}>{{ $horarioOption }}</option>
                                        @endif
                                    @endforeach
                                    <option value="Otros" {{ old('horario') === 'Otros' ? 'selected' : '' }}>Otros (Especificar)</option>
                                </select>

                                <!-- Campo oculto para especificar "Otros" -->
                                <div id="div_horario_otro" class="mt-3 hidden transition-all duration-300 ease-in-out">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Especifique el Horario *</label>
                                    <input type="text" name="horario_otro" id="horario_otro"
                                           class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm"
                                           placeholder="Ingrese el horario manualmente">
                                </div>

                                @error('horario')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Inicio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio *</label>
                                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio') }}" required
                                       class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm @error('fecha_inicio') border-red-500 @enderror">
                                @error('fecha_inicio')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Fin *</label>
                                <input type="date" name="fecha_fin" value="{{ old('fecha_fin') }}" required
                                       class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm @error('fecha_fin') border-red-500 @enderror">
                                @error('fecha_fin')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Firma del Contrato -->
                            <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Firma del Contrato</label>
                                <div class="flex items-center gap-4">
                                    <div class="flex-grow">
                                        <input type="date" name="fecha_firma_manual" id="fecha_firma_manual" value="{{ old('fecha_firma_manual') }}"
                                            class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm @error('fecha_firma_manual') border-red-500 @enderror">
                                    </div>
                                    <div class="flex-shrink-0 text-gray-500 text-sm italic">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Info
                                        </span>
                                        Automáticamente: 1 día antes del inicio
                                    </div>
                                </div>
                                @error('fecha_firma_manual')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Remuneración -->
                    <div class="mb-10 pb-8 border-b border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Detalles de Remuneración</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Tipo de Salario -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Modalidad de Pago *</label>
                                <select name="tipo_salario" id="tipo_salario" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-yellow-500 focus:border-yellow-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150 @error('tipo_salario') border-red-500 @enderror">
                                    <option value="">-- Selecciona modalidad --</option>
                                    <option value="Mensual" {{ old('tipo_salario') === 'Mensual' ? 'selected' : '' }}>Mensual</option>
                                    <option value="Jornal" {{ old('tipo_salario') === 'Jornal' ? 'selected' : '' }}>Jornal</option>
                                </select>
                                @error('tipo_salario')
                                <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salario Mensual -->
                            <div id="campo_mensual" style="display: none;" class="md:col-span-1 fade-in">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Salario Mensual (S/.) *</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">S/.</span>
                                    </div>
                                    <input type="number" name="salario_mensual" id="salario_mensual" value="{{ old('salario_mensual') }}" step="0.01" min="0"
                                           placeholder="Ej: 2500.00"
                                           class="focus:ring-yellow-500 focus:border-yellow-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5">
                                </div>
                            </div>

                            <!-- Salario Jornal -->
                            <div id="campo_jornal" style="display: none;" class="md:col-span-1 fade-in">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Salario Jornal (S/.) *</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">S/.</span>
                                    </div>
                                    <input type="number" name="salario_jornal" id="salario_jornal" value="{{ old('salario_jornal') }}" step="0.01" min="0"
                                           placeholder="Ej: 120.00"
                                           class="focus:ring-yellow-500 focus:border-yellow-500 block w-full pl-10 sm:text-sm border-gray-300 rounded-lg py-2.5">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: Plantilla -->
                    <div class="mb-10 pb-8 border-b border-gray-100">
                        <div class="flex items-center mb-6">
                            <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Selección de Plantilla</h2>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Plantilla del Contrato *</label>
                            <select name="plantilla_id" id="plantilla_select" required
                                    class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-purple-500 focus:border-purple-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150 @error('plantilla_id') border-red-500 @enderror">
                                <option value="">-- Selecciona una plantilla --</option>
                                @foreach ($plantillas as $plantilla)
                                <option value="{{ $plantilla->id }}" 
                                    data-nombre="{{ $plantilla->nombre }}"
                                    data-prefijo="{{ $plantilla->codigo_prefijo ?? '' }}"
                                    {{ old('plantilla_id') == $plantilla->id ? 'selected' : '' }}
                                    title="{{ $plantilla->descripcion ?? '' }}">
                                    {{ $plantilla->codigo_prefijo ?? $plantilla->nombre }} - {{ $plantilla->nombre }}
                                </option>
                                @endforeach
                            </select>
                            @error('plantilla_id')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                            @enderror
                            <div class="mt-2 flex items-center text-purple-700 text-xs bg-purple-50 p-2 rounded w-fit">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Los beneficios de ley (728) se aplicarán automáticamente según la plantilla
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4 justify-end">
                        <a href="{{ route('contratos.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                            <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Guardar Contrato
                        </button>
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
    
    // --- LÓGICA PARA TIPO DE CONTRATO (MANUAL) ---
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
            // No limpiamos el valor por si el usuario se equivocó y quiere volver a ponerlo
        }
    }
    
    selectTipoContrato.addEventListener('change', actualizarTipoContrato);
    actualizarTipoContrato(); // Ejecutar al inicio por si hay old('tipo_contrato') == 'Otros'

    // --- LÓGICA PARA HORARIO (MANUAL) ---
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
    actualizarHorario(); // Ejecutar al inicio por si hay old('horario') == 'Otros'

    // --- LÓGICA PARA FILTRADO DE PLANTILLAS POR UNIDAD ---
    const selectorOculto = document.getElementById('selector_trabajador');
    const plantillaSelect = document.getElementById('plantilla_select');

    function filtrarPlantillasPorUnidad() {
        if (!selectorOculto || !plantillaSelect) return;

        const dni = selectorOculto.value;
        if (!dni) return;

        // Buscar opción seleccionada en el select oculto
        const opcionTrabajador = Array.from(selectorOculto.options).find(opt => opt.value === dni);
        if (!opcionTrabajador) return;

        const unidad = opcionTrabajador.getAttribute('data-unidad');
        
        // Resetear visibilidad (mostrar todo por defecto)
        Array.from(plantillaSelect.options).forEach(opt => opt.style.display = '');
        
        if (!unidad) return;
        
        const u = unidad.toUpperCase().trim();
        let filtro = null;

        // Reglas de Negocio definidas por el usuario
        if (u === 'CHUNGAR') filtro = 'EMI-CHUN';
        else if (u === 'CENTRAL') filtro = ['EMI-CEN', 'EMI-CANCHA'];
        else if (u === 'HUARÓN' || u === 'HUARON') filtro = 'EMI-HUA';
        else if (u === 'ALPAMARCA') filtro = 'EMI-ALP';
        else if (u === 'ROMINA') filtro = 'EMI-ROM';

        if (filtro) {
            // Ocultar las que no coinciden
            Array.from(plantillaSelect.options).forEach(opt => {
                if (opt.value === '') return; // Placeholder siempre visible

                const nombre = (opt.getAttribute('data-nombre') || '').toUpperCase();
                const prefijo = (opt.getAttribute('data-prefijo') || '').toUpperCase();
                const texto = opt.text.toUpperCase();
                
                let coincide = false;
                if (Array.isArray(filtro)) {
                    coincide = filtro.some(f => nombre.includes(f) || prefijo.includes(f) || texto.includes(f));
                } else {
                    coincide = nombre.includes(filtro) || prefijo.includes(filtro) || texto.includes(filtro);
                }

                if (coincide) {
                    opt.style.display = '';
                } else {
                    opt.style.display = 'none';
                }
            });

            // Si la opción actualmente seleccionada se ocultó, resetear
            const seleccionada = plantillaSelect.selectedOptions[0];
            if (seleccionada && seleccionada.value !== '' && seleccionada.style.display === 'none') {
                plantillaSelect.value = '';
            }
        }
    }

    // Escuchar cambios en selector_trabajador
    if (selectorOculto) {
        selectorOculto.addEventListener('change', filtrarPlantillasPorUnidad);
        // Ejecutar al inicio si ya hay trabajador seleccionado (re-carga por validación)
        filtrarPlantillasPorUnidad();
    }
});
</script>

@endsection