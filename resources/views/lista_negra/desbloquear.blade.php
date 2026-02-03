@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-6">
        <a href="{{ route('lista-negra.show', $listaNegra->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">← Volver a Detalles</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-3">🔓 Desbloquear Trabajador de Lista Negra</h1>
        <p class="text-gray-600 mt-1">Autorizar nuevamente la contratación de este trabajador</p>
    </div>

    <!-- Mensajes de alerta -->
    @if ($message = Session::get('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        {{ $message }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Formulario Principal -->
        <div class="lg:col-span-2">
            <!-- Información del Trabajador Bloqueado -->
            <div class="bg-yellow-50 border-2 border-yellow-300 rounded-lg shadow p-6 mb-6">
                <h2 class="text-xl font-bold text-yellow-800 mb-4">⚠️ Trabajador en Bloqueo LEVE</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">DNI</p>
                        <p class="text-gray-900 text-lg font-bold">{{ $listaNegra->dni }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">Nombre</p>
                        <p class="text-gray-900 text-lg font-bold">{{ $listaNegra->trabajador->nombre_completo ?? 'N/A' }}</p>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Motivo del Bloqueo</p>
                        <div class="bg-red-50 border-l-4 border-red-600 p-3 rounded">
                            <p class="text-gray-800 text-sm">{{ $listaNegra->motivo }}</p>
                        </div>
                    </div>
                    <div class="col-span-2">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Bloqueado hace</p>
                        <p class="text-gray-900 font-bold">{{ $listaNegra->fecha_bloqueo->diffForHumans() }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulario de Desbloqueo -->
            <form action="{{ route('lista-negra.desbloquear', $listaNegra->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow p-6">
                @csrf

                <!-- Motivo del Desbloqueo -->
                <div class="mb-6">
                    <label for="motivo_desbloqueo" class="block text-sm font-bold text-gray-700 mb-2">
                        Motivo del Desbloqueo <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-600 mb-3">Explica por qué se autoriza el desbloqueo de este trabajador</p>
                    <textarea name="motivo_desbloqueo" id="motivo_desbloqueo" rows="4" 
                        placeholder="Ejemplo: Trabajador presentó carta de compromiso y ha demostrado enmienda de conducta..." 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 @error('motivo_desbloqueo') border-red-500 @enderror"
                        required>{{ old('motivo_desbloqueo') }}</textarea>
                    <div class="flex justify-between items-center mt-1">
                        <p class="text-gray-500 text-sm">Máximo 500 caracteres</p>
                        <p class="text-gray-500 text-sm"><span id="charCount">0</span>/500</p>
                    </div>
                    @error('motivo_desbloqueo')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Carta de Compromiso -->
                <div class="mb-6">
                    <label for="documento_carta" class="block text-sm font-bold text-gray-700 mb-2">
                        Carta de Compromiso Firmada <span class="text-red-600">*</span>
                    </label>
                    <p class="text-sm text-gray-600 mb-3">Sube la carta de compromiso firmada por el trabajador (PDF, JPG, PNG)</p>
                    
                    <div class="border-2 border-dashed border-green-300 rounded-lg p-8 text-center cursor-pointer hover:border-green-400 hover:bg-green-50 transition"
                        id="drop-zone">
                        <input type="file" name="documento_carta" id="documento_carta" 
                            accept=".pdf,.jpg,.jpeg,.png" 
                            class="hidden"
                            required>
                        
                        <svg class="mx-auto h-12 w-12 text-green-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                            <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-12l-8 8m0 0l-8-8m8 8v20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        
                        <p class="mt-3 font-semibold text-gray-700">Haz clic para cargar o arrastra un archivo aquí</p>
                        <p class="text-sm text-gray-500 mt-1">PDF, JPG, PNG (máximo 5MB)</p>
                        <p class="text-sm text-gray-400 mt-3 font-mono" id="file-name"></p>
                    </div>
                    @error('documento_carta')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Información de Alerta -->
                <div class="bg-green-50 border-2 border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-sm font-bold text-green-800 mb-2">✅ Importante</p>
                    <ul class="text-sm text-green-700 space-y-1">
                        <li>✓ El trabajador será desbloqueado inmediatamente</li>
                        <li>✓ Podrá crear nuevos contratos</li>
                        <li>✓ Se guardará un registro de este desbloqueo</li>
                        <li>✓ Si reincide, será bloqueado nuevamente (esta vez como GRAVE)</li>
                    </ul>
                </div>

                <!-- Botones -->
                <div class="flex gap-4 pt-4 border-t border-gray-200">
                    <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-lg transition">
                        ✅ Confirmar Desbloqueo
                    </button>
                    <a href="{{ route('lista-negra.show', $listaNegra->id) }}" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-3 px-4 rounded-lg text-center transition">
                        ❌ Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Sidebar Informativo -->
        <div class="lg:col-span-1">
            <!-- Información de la Carta de Compromiso -->
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-4 mb-6">
                <p class="text-sm font-bold text-blue-800 mb-3">📋 Qué es una Carta de Compromiso</p>
                <p class="text-xs text-blue-700 leading-relaxed mb-3">
                    Es un documento firmado por el trabajador donde se compromete a:
                </p>
                <ul class="text-xs text-blue-700 space-y-1 ml-2">
                    <li>✓ Cumplir con las normas de la empresa</li>
                    <li>✓ Mantener buen comportamiento</li>
                    <li>✓ Enmendar la conducta que causó el bloqueo</li>
                    <li>✓ Aceptar las consecuencias si reincide</li>
                </ul>
            </div>

            <!-- Condiciones del Desbloqueo -->
            <div class="bg-purple-50 border-2 border-purple-200 rounded-lg p-4 mb-6">
                <p class="text-sm font-bold text-purple-800 mb-3">⚡ Condiciones</p>
                <ul class="text-xs text-purple-700 space-y-2">
                    <li>
                        <strong>Tipo:</strong><br/>
                        <span class="inline-block bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold mt-1">🟡 LEVE</span>
                    </li>
                    <li class="mt-2">
                        <strong>Requiere:</strong><br/>
                        • Motivo de desbloqueo<br/>
                        • Carta de compromiso
                    </li>
                    <li class="mt-2">
                        <strong>Después:</strong><br/>
                        El trabajador podrá contratar nuevamente
                    </li>
                </ul>
            </div>

            <!-- Advertencia -->
            <div class="bg-red-50 border-2 border-red-200 rounded-lg p-4">
                <p class="text-sm font-bold text-red-800 mb-2">⚠️ Advertencia</p>
                <p class="text-xs text-red-700 leading-relaxed">
                    Si este trabajador reincide en la falta, será bloqueado nuevamente pero esta vez como <strong>GRAVE</strong> (bloqueo permanente, sin posibilidad de desbloqueo).
                </p>
            </div>
        </div>
    </div>
</div>

<script>
// Contador de caracteres
const motivoTextarea = document.getElementById('motivo_desbloqueo');
const charCountSpan = document.getElementById('charCount');

motivoTextarea.addEventListener('input', function() {
    charCountSpan.textContent = this.value.length;
    if (this.value.length >= 500) {
        this.value = this.value.substring(0, 500);
    }
});

// Drag and drop para archivo
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('documento_carta');
const fileName = document.getElementById('file-name');

['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, preventDefaults, false);
});

function preventDefaults(e) {
    e.preventDefault();
    e.stopPropagation();
}

['dragenter', 'dragover'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.add('border-green-400', 'bg-green-50');
    });
});

['dragleave', 'drop'].forEach(eventName => {
    dropZone.addEventListener(eventName, () => {
        dropZone.classList.remove('border-green-400', 'bg-green-50');
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
</script>
@endsection