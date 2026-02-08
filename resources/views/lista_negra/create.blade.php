@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-red-600">
                <div class="p-6 flex items-center">
                    <div class="p-3 rounded-full bg-red-50 mr-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Agregar a Lista Negra</h1>
                        <p class="text-gray-600 text-sm mt-1">Registra una incidencia para bloquear la contratación de un trabajador</p>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <form action="{{ route('lista-negra.store') }}" method="POST" enctype="multipart/form-data" id="listaNegraForm">
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
                                <h2 class="text-xl font-bold text-gray-800">Identificación del Trabajador</h2>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Selecciona Trabajador a Bloquear *</label>

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

                                        <button type="button" id="btn_limpiar_busqueda" 
                                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-red-500 cursor-pointer hidden transition-colors">
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

                                    <!-- Select Oculto -->
                                    <select name="dni" id="selector_trabajador" class="hidden" required>
                                        <option value="">-- Selecciona un trabajador --</option>
                                        @foreach ($trabajadores as $trabajador)
                                            <option value="{{ $trabajador->dni }}" 
                                                    data-nombre="{{ $trabajador->nombre_completo }}"
                                                    data-cargo="{{ $trabajador->cargo ?? 'Sin cargo' }}"
                                                    {{ (old('dni') ?? $trabajador_dni ?? '') == $trabajador->dni ? 'selected' : '' }}>
                                                {{ $trabajador->dni }} - {{ $trabajador->nombre_completo }}
                                            </option>
                                        @endforeach
                                    </select>
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
                                                    <p id="cargo_trabajador_display" class="mt-1 text-xs"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 2: Detalles del Bloqueo -->
                        <div class="mb-10 pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Detalles de la Incidencia</h2>
                            </div>

                            <div class="grid grid-cols-1 gap-8">
                                <!-- Tipo de Bloqueo -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Gravedad del Bloqueo *</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all hover:bg-gray-50 border-gray-200" id="label-leve">
                                            <input type="radio" name="motivo" value="Leve" class="sr-only" required {{ old('motivo') == 'Leve' ? 'checked' : '' }}>
                                            <span class="flex flex-1">
                                                <span class="flex flex-col">
                                                    <span id="label-leve-text" class="block text-sm font-bold text-gray-900 uppercase">BLOQUEO LEVE</span>
                                                    <span class="mt-1 flex items-center text-xs text-gray-500 italic">
                                                        Suspensión temporal habilitable.
                                                    </span>
                                                </span>
                                            </span>
                                            <svg class="h-5 w-5 text-amber-500 opacity-0 transition-opacity peer-checked:opacity-100 check-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </label>

                                        <label class="relative flex cursor-pointer rounded-lg border bg-white p-4 shadow-sm focus:outline-none transition-all hover:bg-gray-50 border-gray-200" id="label-grave">
                                            <input type="radio" name="motivo" value="Grave" class="sr-only" required {{ old('motivo') == 'Grave' ? 'checked' : '' }}>
                                            <span class="flex flex-1">
                                                <span class="flex flex-col">
                                                    <span id="label-grave-text" class="block text-sm font-bold text-gray-900 uppercase">BLOQUEO GRAVE</span>
                                                    <span class="mt-1 flex items-center text-xs text-gray-500 italic">
                                                        Expulsión permanente del sistema.
                                                    </span>
                                                </span>
                                            </span>
                                            <svg class="h-5 w-5 text-red-600 opacity-0 transition-opacity peer-checked:opacity-100 check-icon" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        </label>
                                    </div>
                                </div>

                                <!-- Descripción -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Descripción del Motivo *</label>
                                    <textarea name="descripcion_motivo" id="descripcion_motivo" rows="4" 
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm transition-all"
                                        placeholder="Especifique detalladamente los actos o conductas que originan este reporte..."
                                        required>{{ old('descripcion_motivo') }}</textarea>
                                    <div class="mt-1 text-right">
                                        <span class="text-xs font-mono text-gray-400"><span id="charCount">0</span>/1000</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 3: Archivo Adjunto -->
                        <div class="mb-10 pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Sustento Documental</h2>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-red-500 transition-colors" id="drop-zone">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                    <p class="text-sm text-gray-600 font-medium">Arrastra el archivo aquí o haz clic para subir</p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG o PNG (Máx. 5MB)</p>
                                    <input type="file" name="documento_informe" id="documento_informe" class="hidden" accept=".pdf,.jpg,.jpeg,.png">
                                    <div id="file-name-display" class="mt-4 text-xs font-bold text-red-600 bg-white px-3 py-1 rounded-full border border-red-100 hidden truncate max-w-xs"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4 justify-end pt-4">
                            <a href="{{ route('lista-negra.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                Cancelar
                            </a>
                            <button type="submit" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Confirmar Bloqueo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buscadorInput = document.getElementById('buscador_visual');
        const listaResultados = document.getElementById('lista_resultados');
        const selectorOculto = document.getElementById('selector_trabajador');
        const btnLimpiar = document.getElementById('btn_limpiar_busqueda');
        const infoTrabajador = document.getElementById('info_trabajador');
        const opcionesOriginales = Array.from(selectorOculto.options).filter(opt => opt.value !== "");

        function mostrarInfo() {
            const option = selectorOculto.options[selectorOculto.selectedIndex];
            if (option && option.value) {
                infoTrabajador.style.display = 'block';
                document.getElementById('nombre_trabajador_display').textContent = 'Nombre: ' + option.getAttribute('data-nombre');
                document.getElementById('cargo_trabajador_display').textContent = 'Cargo: ' + option.getAttribute('data-cargo');
            } else {
                infoTrabajador.style.display = 'none';
            }
        }

        function filtrarResultados(filtro = '') {
            listaResultados.innerHTML = '';
            const term = filtro.toLowerCase().trim();
            const resultados = opcionesOriginales.filter(opt => opt.textContent.toLowerCase().includes(term));

            if (resultados.length === 0) {
                listaResultados.innerHTML = '<li class="px-4 py-2 text-gray-500 italic text-sm">No se encontraron resultados</li>';
            } else {
                resultados.forEach(opt => {
                    const li = document.createElement('li');
                    li.className = 'px-4 py-2 hover:bg-red-50 cursor-pointer text-gray-700 text-sm border-b border-gray-100 last:border-0 hover:text-red-700';
                    li.textContent = opt.textContent;
                    li.onclick = () => {
                        selectorOculto.value = opt.value;
                        buscadorInput.value = opt.textContent.trim();
                        listaResultados.classList.add('hidden');
                        btnLimpiar.classList.remove('hidden');
                        mostrarInfo();
                    };
                    listaResultados.appendChild(li);
                });
            }
            listaResultados.classList.remove('hidden');
        }

        buscadorInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                btnLimpiar.classList.remove('hidden');
                filtrarResultados(this.value);
            } else {
                btnLimpiar.classList.add('hidden');
                listaResultados.classList.add('hidden');
            }
        });

        buscadorInput.addEventListener('focus', () => { if(buscadorInput.value === '') filtrarResultados(''); });

        document.addEventListener('click', (e) => {
            if (!buscadorInput.contains(e.target) && !listaResultados.contains(e.target)) listaResultados.classList.add('hidden');
        });

        btnLimpiar.addEventListener('click', () => {
            buscadorInput.value = '';
            selectorOculto.value = '';
            btnLimpiar.classList.add('hidden');
            listaResultados.classList.add('hidden');
            mostrarInfo();
        });

        // Manejo de Radio Buttons Estilo Laravel
        const radios = document.querySelectorAll('input[name="motivo"]');
        function updateRadioStyles() {
            radios.forEach(radio => {
                const label = radio.closest('label');
                const icon = label.querySelector('.check-icon');
                if (radio.checked) {
                    label.classList.add('ring-2', 'ring-offset-1', 'border-transparent');
                    icon.classList.remove('opacity-0');
                    if (radio.value === 'Leve') {
                        label.classList.add('ring-amber-500', 'bg-amber-50');
                        label.querySelector('#label-leve-text').classList.add('text-amber-800');
                    } else {
                        label.classList.add('ring-red-600', 'bg-red-50');
                        label.querySelector('#label-grave-text').classList.add('text-red-800');
                    }
                } else {
                    label.classList.remove('ring-2', 'ring-offset-1', 'border-transparent', 'ring-amber-500', 'bg-amber-50', 'ring-red-600', 'bg-red-50');
                    label.querySelector('.uppercase').classList.remove('text-amber-800', 'text-red-800');
                    icon.classList.add('opacity-0');
                }
            });
        }
        radios.forEach(r => r.addEventListener('change', updateRadioStyles));
        updateRadioStyles();

        // Contador Caracteres
        const txtArea = document.getElementById('descripcion_motivo');
        const cnt = document.getElementById('charCount');
        txtArea.addEventListener('input', () => cnt.textContent = txtArea.value.length);

        // Drop Zone
        const dropZone = document.getElementById('drop-zone');
        const fileInput = document.getElementById('documento_informe');
        const fileNameDisplay = document.getElementById('file-name-display');

        dropZone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', () => {
            if (fileInput.files.length) {
                fileNameDisplay.textContent = '✅ ' + fileInput.files[0].name;
                fileNameDisplay.classList.remove('hidden');
            }
        });

        ['dragenter', 'dragover'].forEach(name => dropZone.addEventListener(name, (e) => {
            e.preventDefault();
            dropZone.classList.add('border-red-500', 'bg-red-50');
        }));
        ['dragleave', 'drop'].forEach(name => dropZone.addEventListener(name, (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-red-500', 'bg-red-50');
            if (name === 'drop') {
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            }
        }));

        if (selectorOculto.value) {
            const sel = opcionesOriginales.find(o => o.value === selectorOculto.value);
            if (sel) {
                buscadorInput.value = sel.textContent.trim();
                btnLimpiar.classList.remove('hidden');
                mostrarInfo();
            }
        }
    });
    </script>

    <style>
        .fade-in { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
@endsection