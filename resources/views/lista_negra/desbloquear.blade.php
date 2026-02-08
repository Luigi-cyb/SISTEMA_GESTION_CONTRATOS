@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-green-600">
                <div class="p-6 flex items-center">
                    <div class="p-3 rounded-full bg-green-50 mr-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Rehabilitar Trabajador</h1>
                        <p class="text-gray-600 text-sm mt-1">Autorizar el levantamiento del bloqueo para permitir nuevas
                            contrataciones</p>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-8">
                    <form action="{{ route('lista-negra.desbloquear', $listaNegra->id) }}" method="POST"
                        enctype="multipart/form-data" id="desbloquearForm">
                        @csrf

                        <!-- Errores de Validación -->
                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-400 p-4 mb-6 rounded shadow-sm">
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

                        <!-- SECCIÓN 1: Antecedentes -->
                        <div class="mb-10 pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center text-amber-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Detalles del Bloqueo Actual</h2>
                            </div>

                            <div class="bg-gray-50 border-l-4 border-amber-500 p-5 rounded-md shadow-inner">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <p
                                            class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">
                                            Nombre del Trabajador</p>
                                        <p class="text-lg font-bold text-gray-800">
                                            {{ $listaNegra->trabajador->nombre_completo ?? 'N/A' }}</p>
                                    </div>
                                    <div class="text-right">
                                        <p
                                            class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-1">
                                            DNI</p>
                                        <p class="text-lg font-bold text-gray-800">{{ $listaNegra->dni }}</p>
                                    </div>
                                </div>
                                <div class="border-t border-gray-200 pt-4 mt-2">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest leading-none mb-2">
                                        Motivo de Bloqueo:</p>
                                    <p class="text-gray-700 italic">"{{ $listaNegra->descripcion_motivo }}"</p>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 2: Justificación -->
                        <div class="mb-10 pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Sustento de Rehabilitación</h2>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Motivo del Desbloqueo *</label>
                                <textarea name="motivo_desbloqueo" id="motivo_desbloqueo" rows="4"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-600 focus:ring-green-600 sm:text-sm transition-all"
                                    placeholder="Describa los acuerdos, compromisos o justificación para levantar el bloqueo..."
                                    required>{{ old('motivo_desbloqueo') }}</textarea>
                                <div class="mt-1 text-right">
                                    <span class="text-xs font-mono text-gray-400"><span id="charCount">0</span>/500</span>
                                </div>
                            </div>
                        </div>

                        <!-- SECCIÓN 3: Archivo Adjunto -->
                        <div class="mb-10 pb-8 border-b border-gray-100">
                            <div class="flex items-center mb-6">
                                <div
                                    class="w-10 h-10 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Carta de Compromiso</h2>
                            </div>

                            <div class="bg-gray-50 p-6 rounded-lg border-2 border-dashed border-gray-300 hover:border-green-600 transition-colors"
                                id="drop-zone">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-400 mb-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                    </svg>
                                    <p class="text-sm text-gray-600 font-medium">Arrastra el archivo aquí o haz clic para
                                        subir</p>
                                    <p class="text-xs text-gray-500 mt-1">PDF, JPG o PNG (Máx. 5MB)</p>
                                    <input type="file" name="documento_carta" id="documento_carta" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png" required>
                                    <div id="file-name-display"
                                        class="mt-4 text-xs font-bold text-green-600 bg-white px-3 py-1 rounded-full border border-green-100 hidden truncate max-w-xs">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botones -->
                        <div class="flex gap-4 justify-end pt-4">
                            <a href="{{ route('lista-negra.show', $listaNegra->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Confirmar Rehabilitación
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('motivo_desbloqueo');
            const charCount = document.getElementById('charCount');
            const fileInput = document.getElementById('documento_carta');
            const dropZone = document.getElementById('drop-zone');
            const fileNameDisplay = document.getElementById('file-name-display');

            // Contador
            textarea.addEventListener('input', () => {
                charCount.textContent = textarea.value.length;
                if (textarea.value.length > 500) textarea.value = textarea.value.substring(0, 500);
            });

            // Drop Zone
            dropZone.addEventListener('click', () => fileInput.click());

            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) {
                    fileNameDisplay.textContent = '✅ ' + fileInput.files[0].name;
                    fileNameDisplay.classList.remove('hidden');
                }
            });

            ['dragenter', 'dragover'].forEach(name => dropZone.addEventListener(name, (e) => {
                e.preventDefault();
                dropZone.classList.add('border-green-600', 'bg-green-50');
            }));

            ['dragleave', 'drop'].forEach(name => dropZone.addEventListener(name, (e) => {
                e.preventDefault();
                dropZone.classList.remove('border-green-600', 'bg-green-50');
                if (name === 'drop') {
                    fileInput.files = e.dataTransfer.files;
                    fileInput.dispatchEvent(new Event('change'));
                }
            }));
        });
    </script>

    <style>
        .fade-in {
            animation: fadeIn 0.3s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
@endsection