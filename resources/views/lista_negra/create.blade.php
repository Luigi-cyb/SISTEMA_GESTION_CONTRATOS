@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-6">
        <a href="{{ route('lista-negra.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">← Volver a Lista Negra</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-3">➕ Agregar Trabajador a Lista Negra</h1>
        <p class="text-gray-600 mt-1">Bloquea un trabajador para prevenir nuevos contratos</p>
    </div>

    <!-- Formulario -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Formulario Principal -->
        <div class="lg:col-span-2">
            <form action="{{ route('lista-negra.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
                @csrf

                <!-- DNI del Trabajador -->
                <div class="mb-6">
                    <label for="dni" class="block text-sm font-bold text-gray-700 mb-2">
                        Seleccionar Trabajador <span class="text-red-600">*</span>
                    </label>
                    <select name="dni" id="dni" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('dni') border-red-500 @enderror" required>
                        <option value="">-- Seleccionar un Trabajador --</option>
                        @foreach($trabajadores as $trabajador)
                            <option value="{{ $trabajador->dni }}" {{ old('dni') == $trabajador->dni ? 'selected' : '' }}>
                                {{ $trabajador->dni }} - {{ $trabajador->nombre_completo }} ({{ $trabajador->cargo ?? 'N/A' }})
                            </option>
                        @endforeach
                    </select>
                    @error('dni')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tipo de Bloqueo - CORREGIDO: name="motivo" con valores "Leve" y "Grave" -->
                <div class="mb-6">
                    <label class="block text-sm font-bold text-gray-700 mb-3">
                        Tipo de Bloqueo <span class="text-red-600">*</span>
                    </label>
                    <div class="space-y-3">
                        <!-- LEVE -->
                        <label class="flex items-start p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-yellow-400 hover:bg-yellow-50 transition @error('motivo') border-red-500 @enderror"
                            id="label-leve">
                            <input type="radio" id="leve" name="motivo" value="Leve" 
                                class="mt-1 cursor-pointer" 
                                {{ old('motivo') == 'Leve' ? 'checked' : '' }}
                                required>
                            <div class="ml-4 flex-1">
                                <p class="font-bold text-yellow-700">🟡 LEVE - Puede ser desbloqueado</p>
                                <p class="text-sm text-gray-600 mt-1">Infracciones menores que pueden ser solucionadas con una carta de compromiso firmada por el trabajador.</p>
                                <p class="text-xs text-gray-500 mt-2">Ejemplo: Faltas reiteradas, mal comportamiento menor, incumplimiento de normas</p>
                            </div>
                        </label>

                        <!-- GRAVE -->
                        <label class="flex items-start p-4 border-2 border-gray-300 rounded-lg cursor-pointer hover:border-red-400 hover:bg-red-50 transition @error('motivo') border-red-500 @enderror"
                            id="label-grave">
                            <input type="radio" id="grave" name="motivo" value="Grave" 
                                class="mt-1 cursor-pointer" 
                                {{ old('motivo') == 'Grave' ? 'checked' : '' }}
                                required>
                            <div class="ml-4 flex-1">
                                <p class="font-bold text-red-700">🔴 GRAVE - Bloqueo permanente</p>
                                <p class="text-sm text-gray-600 mt-1">Faltas graves que resultan en bloqueo permanente. NO se puede desbloquear bajo ninguna circunstancia.</p>
                                <p class="text-xs text-gray-500 mt-2">Ejemplo: Conducta deshonesta, robo, agresión, violación grave de contrato</p>
                            </div>
                        </label>
                    </div>
                    @error('motivo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Descripción del Motivo - CORREGIDO: name="descripcion_motivo" -->
                <div class="mb-6">
                    <label for="descripcion_motivo" class="block text-sm font-bold text-gray-700 mb-2">
                        Descripción del Motivo <span class="text-red-600">*</span>
                    </label>
                    <textarea name="descripcion_motivo" id="descripcion_motivo" rows="5" 
                        placeholder="Describe detalladamente el motivo por el cual este trabajador debe ser bloqueado..." 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 @error('descripcion_motivo') border-red-500 @enderror"
                        required>{{ old('descripcion_motivo') }}</textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-gray-500 text-sm">Máximo 1000 caracteres</p>
                        <p class="text-gray-500 text-sm"><span id="charCount">0</span>/1000</p>
                    </div>
                    @error('descripcion_motivo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Documento del Informe -->
                <div class="mb-6">
                    <label for="documento_informe" class="block text-sm font-bold text-gray-700 mb-2">
                        Documento del Informe <span class="text-gray-400">(Opcional)</span>
                    </label>
                    <p class="text-sm text-gray-600 mb-3">Sube el informe o documentación que respalda el bloqueo (PDF, JPG, PNG)</p>
                    
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-red-400 hover:bg-red-50 transition"
                        id="drop-zone">
                        <input type="file" name="documento_informe" id="documento_informe" 
                            accept=".pdf,.jpg,.jpeg,.png" 
                            class="hidden">
                        
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-12l-8 8m0 0l-8-8m8 8v20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        
                        <p class="mt-3 font-semibold text-gray-700">Haz clic para cargar o arrastra un archivo aquí</p>
                        <p class="text-sm text-gray-500 mt-1">PDF, JPG, PNG (máximo 5MB)</p>
                        <p class="text-sm text-gray-400 mt-3 font-mono" id="file-name"></p>
                    </div>
                    @error('documento_informe')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="flex gap-4 pt-4 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-red-600 hover:bg-red-700 text-white font-bold py-3 px-4 rounded-lg transition">
                        ✅ Agregar a Lista Negra
                    </button>
                    <a href="{{ route('lista-negra.index') }}" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Panel de Información (Sidebar) -->
        <div class="lg:col-span-1">
            <!-- Información de Alerta -->
            <div class="bg-yellow-50 border-2 border-yellow-200 rounded-lg p-4 mb-6">
                <p class="text-sm font-bold text-yellow-800 mb-2">⚠️ Importante</p>
                <ul class="text-sm text-yellow-700 space-y-2">
                    <li>✓ El trabajador será bloqueado inmediatamente</li>
                    <li>✓ No se podrá crear nuevo contrato para este trabajador</li>
                    <li>✓ Si es LEVE, puede ser desbloqueado con carta de compromiso</li>
                    <li>✓ Si es GRAVE, bloqueo permanente</li>
                </ul>
            </div>

            <!-- Diferencia LEVE vs GRAVE -->
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm font-bold text-blue-800 mb-3">📋 Tipos de Bloqueo</p>
                
                <div class="mb-4 pb-4 border-b border-blue-200">
                    <p class="text-xs font-bold text-yellow-700">🟡 LEVE</p>
                    <ul class="text-xs text-blue-700 mt-1 space-y-1">
                        <li>• Faltas reiteradas</li>
                        <li>• Mal comportamiento</li>
                        <li>• Incumplimiento de normas</li>
                        <li>• Puede desbloquearse ✓</li>
                    </ul>
                </div>

                <div>
                    <p class="text-xs font-bold text-red-700">🔴 GRAVE</p>
                    <ul class="text-xs text-blue-700 mt-1 space-y-1">
                        <li>• Conducta deshonesta</li>
                        <li>• Robo o fraude</li>
                        <li>• Agresión física</li>
                        <li>• NO puede desbloquearse ✗</li>
                    </ul>
                </div>
            </div>

            <!-- Requisitos -->
            <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4">
                <p class="text-sm font-bold text-green-800 mb-2">✅ Requisitos</p>
                <ul class="text-xs text-green-700 space-y-2">
                    <li>✓ Trabajador seleccionado</li>
                    <li>✓ Tipo de bloqueo elegido</li>
                    <li>✓ Descripción detallada</li>
                    <li>✓ Documento escaneado (opcional)</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
// Contador de caracteres
const motivoTextarea = document.getElementById('descripcion_motivo');
const charCountSpan = document.getElementById('charCount');

if (motivoTextarea && charCountSpan) {
    motivoTextarea.addEventListener('input', function() {
        charCountSpan.textContent = this.value.length;
        if (this.value.length >= 1000) {
            this.value = this.value.substring(0, 1000);
        }
    });
}

// Drag and drop para archivo
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('documento_informe');
const fileName = document.getElementById('file-name');

if (dropZone && fileInput) {
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('border-red-400', 'bg-red-50');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('border-red-400', 'bg-red-50');
        });
    });

    dropZone.addEventListener('drop', (e) => {
        const dt = e.dataTransfer;
        const files = dt.files;
        fileInput.files = files;
        updateFileName();
    });

    dropZone.addEventListener('click', () => fileInput.click());

    fileInput.addEventListener('change', updateFileName);

    function updateFileName() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            const sizeMB = (file.size / 1024 / 1024).toFixed(2);
            fileName.textContent = `✅ ${file.name} (${sizeMB} MB)`;
        } else {
            fileName.textContent = '';
        }
    }
}

// Estilo dinámico para radio buttons
const leveRadio = document.getElementById('leve');
const graveRadio = document.getElementById('grave');
const labelLeve = document.getElementById('label-leve');
const labelGrave = document.getElementById('label-grave');

if (leveRadio && graveRadio) {
    leveRadio.addEventListener('change', function() {
        labelLeve.classList.add('border-yellow-400', 'bg-yellow-50');
        labelGrave.classList.remove('border-red-400', 'bg-red-50');
    });

    graveRadio.addEventListener('change', function() {
        labelGrave.classList.add('border-red-400', 'bg-red-50');
        labelLeve.classList.remove('border-yellow-400', 'bg-yellow-50');
    });
}
</script>
@endsection