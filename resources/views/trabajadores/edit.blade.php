@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800">✏️ Editar Trabajador</h1>
                <p class="text-gray-600 mt-1">DNI: <strong>{{ $trabajador->dni }}</strong></p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
<form action="{{ route('trabajadores.update', $trabajador->dni) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

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

                    <!-- SECCIÓN 1: Datos Básicos -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">📋 Datos Básicos</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- DNI (No editable) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">DNI (No editable)</label>
                                <input type="text" value="{{ $trabajador->dni }}" disabled
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm bg-gray-100 cursor-not-allowed">
                                <p class="text-xs text-gray-500 mt-1">El DNI no puede modificarse</p>
                            </div>

                            <!-- Nombre Completo (MAYÚSCULAS AUTOMÁTICAS) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre Completo *</label>
                                <input type="text" 
                                       name="nombre_completo" 
                                       id="nombre_completo"
                                       value="{{ old('nombre_completo', $trabajador->nombre_completo) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('nombre_completo') border-red-500 @enderror uppercase">
                                <p class="text-xs text-gray-500 mt-1">Se convertirá automáticamente a MAYÚSCULAS</p>
                                @error('nombre_completo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Nacimiento</label>
                                <input type="date" 
                                       name="fecha_nacimiento" 
                                       value="{{ old('fecha_nacimiento', $trabajador->fecha_nacimiento?->format('Y-m-d')) }}"
                                       max="{{ date('Y-m-d') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_nacimiento') border-red-500 @enderror">
                                @error('fecha_nacimiento')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nacionalidad -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nacionalidad</label>
                                <input type="text" 
                                       name="nacionalidad" 
                                       value="{{ old('nacionalidad', $trabajador->nacionalidad) }}"
                                       placeholder="Ej: Peruana"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Datos Laborales -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">💼 Datos Laborales</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cargo (MAYÚSCULAS AUTOMÁTICAS) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cargo *</label>
                                <input type="text" 
                                       name="cargo" 
                                       id="cargo"
                                       value="{{ old('cargo', $trabajador->cargo) }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('cargo') border-red-500 @enderror uppercase">
                                <p class="text-xs text-gray-500 mt-1">Se convertirá automáticamente a MAYÚSCULAS</p>
                                @error('cargo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Área/Departamento (MAYÚSCULAS AUTOMÁTICAS) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Área/Departamento</label>
                                <input type="text" 
                                       name="area_departamento" 
                                       id="area_departamento"
                                       value="{{ old('area_departamento', $trabajador->area_departamento) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 uppercase">
                                <p class="text-xs text-gray-500 mt-1">Se convertirá automáticamente a MAYÚSCULAS</p>
                            </div>

                            <!-- Unidad (ACTUALIZADO: Incluye Central) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Unidad *</label>
                                <select name="unidad" 
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('unidad') border-red-500 @enderror">
                                    <option value="">-- Selecciona una unidad --</option>
                                    @foreach ($unidades as $uni)
                                    <option value="{{ $uni }}" {{ old('unidad', $trabajador->unidad) === $uni ? 'selected' : '' }}>{{ $uni }}</option>
                                    @endforeach
                                </select>
                                @error('unidad')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Ingreso -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Ingreso *</label>
                                <input type="date" 
                                       name="fecha_ingreso" 
                                       value="{{ old('fecha_ingreso', $trabajador->fecha_ingreso?->format('Y-m-d')) }}" 
                                       max="{{ date('Y-m-d') }}"
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_ingreso') border-red-500 @enderror">
                                @error('fecha_ingreso')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Datos de Contacto -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">📞 Datos de Contacto</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Teléfono (VALIDACIÓN: 9 dígitos) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Teléfono (Celular)</label>
                                <input type="text" 
                                       name="telefono" 
                                       id="telefono"
                                       maxlength="9"
                                       value="{{ old('telefono', $trabajador->telefono) }}"
                                       placeholder="Ej: 987654321"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('telefono') border-red-500 @enderror">
                                <p class="text-xs text-gray-500 mt-1">Debe tener exactamente 9 dígitos</p>
                                @error('telefono')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" 
                                       name="email" 
                                       value="{{ old('email', $trabajador->email) }}"
                                       placeholder="Ej: juan@example.com"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('email') border-red-500 @enderror">
                                @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección (NORMAL - No mayúsculas forzadas) -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Dirección Actual</label>
                                <textarea name="direccion_actual" 
                                          rows="2"
                                          placeholder="Ej: Av. Principal 123, Lima"
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('direccion_actual', $trabajador->direccion_actual) }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Puede escribir con mayúsculas o minúsculas</p>
                            </div>

                            <!-- Contacto de Emergencia -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contacto de Emergencia</label>
                                <input type="text" 
                                       name="contacto_emergencia" 
                                       value="{{ old('contacto_emergencia', $trabajador->contacto_emergencia) }}"
                                       placeholder="Ej: María Pérez (Madre)"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Teléfono de Emergencia (VALIDACIÓN: 9 dígitos) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Teléfono de Emergencia</label>
                                <input type="text" 
                                       name="telefono_emergencia" 
                                       id="telefono_emergencia"
                                       maxlength="9"
                                       value="{{ old('telefono_emergencia', $trabajador->telefono_emergencia) }}"
                                       placeholder="Ej: 987654321"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('telefono_emergencia') border-red-500 @enderror">
                                <p class="text-xs text-gray-500 mt-1">Debe tener exactamente 9 dígitos</p>
                                @error('telefono_emergencia')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: Datos Bancarios (OPCIONAL) -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">🏦 Datos Bancarios (Opcional)</h2>
                        <p class="text-gray-600 text-sm mb-4">Estos datos son opcionales</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cuenta Bancaria (OPCIONAL) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cuenta Bancaria</label>
                                <input type="text" 
                                       name="cuenta_bancaria" 
                                       id="cuenta_bancaria"
                                       maxlength="20"
                                       value="{{ old('cuenta_bancaria', $trabajador->cuenta_bancaria) }}"
                                       placeholder="Ej: 1234567890"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <p class="text-xs text-gray-500 mt-1">Máximo 20 caracteres</p>
                            </div>

                            <!-- CCI (OPCIONAL - VALIDACIÓN: 20 dígitos) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">CCI (Código Interbancario)</label>
                                <input type="text" 
                                       name="cci" 
                                       id="cci"
                                       maxlength="20"
                                       value="{{ old('cci', $trabajador->cci) }}"
                                       placeholder="Ej: 00112345678901234567"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('cci') border-red-500 @enderror">
                                <p class="text-xs text-gray-500 mt-1">Debe tener exactamente 20 dígitos (si lo completa)</p>
                                @error('cci')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
<!-- SECCIÓN 4.1: Currículum Vitae (NUEVO) -->
<div class="mb-8 pb-8 border-b border-gray-200">
    <h2 class="text-xl font-bold text-gray-800 mb-6">📄 Currículum Vitae (Opcional)</h2>
    <p class="text-gray-600 text-sm mb-4">Carga o actualiza el CV en formato PDF (máximo 5MB)</p>
    
    <div class="grid grid-cols-1 gap-6">
        <!-- CV Actual (si existe) -->
        @if ($trabajador->tieneCV())
        <div class="bg-blue-50 border border-blue-200 p-4 rounded-lg">
            <p class="text-sm text-gray-700"><strong>✅ CV Actual Cargado</strong></p>
            <p class="text-sm text-gray-600 mt-1">{{ basename($trabajador->cv_path) }}</p>
            <div class="flex gap-2 mt-3">
                <a href="{{ route('trabajadores.descargar-cv', $trabajador->dni) }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-sm">
                    📥 Descargar CV
                </a>
            <button type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded text-sm"
                        onclick="if(confirm('¿Estás seguro de que quieres eliminar el CV?')) { 
                            fetch('{{ route('trabajadores.eliminar-cv', $trabajador->dni) }}', {
                                method: 'DELETE',
                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                            }).then(() => location.reload());
                        }">
                    🗑️ Eliminar CV
                </button>
            </div>
        </div>
        @else
        <div class="bg-yellow-50 border border-yellow-200 p-4 rounded-lg">
            <p class="text-sm text-gray-700"><strong>⚠️ Sin CV</strong></p>
            <p class="text-sm text-gray-600 mt-1">Este trabajador aún no tiene un CV cargado.</p>
        </div>
        @endif

        <!-- CV Upload/Update -->
        <div>
            <label class="block text-sm font-medium text-gray-700">{{ $trabajador->tieneCV() ? 'Actualizar' : 'Cargar' }} CV (PDF)</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-8l-4-4m0 0l-4 4m4-4v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="cv" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                            <span>Haz clic para seleccionar</span>
                            <input id="cv" name="cv" type="file" accept=".pdf" class="sr-only" @change="fileName = $event.target.files[0]?.name">
                        </label>
                        <p class="pl-1">o arrastra un archivo</p>
                    </div>
                    <p class="text-xs text-gray-500">PDF hasta 5MB</p>
                </div>
            </div>
            
            <!-- Nombre del archivo seleccionado -->
            <div id="cvFileName" class="mt-2 text-sm text-gray-700 hidden">
                <p><strong>Archivo seleccionado:</strong> <span id="cvName"></span></p>
            </div>
            
            @error('cv')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
                    <!-- SECCIÓN 5: Estado -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">⚙️ Estado</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estado -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Estado *</label>
                                <select name="estado" 
                                        required
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('estado') border-red-500 @enderror">
                                    <option value="">-- Selecciona un estado --</option>
                                    <option value="Activo" {{ old('estado', $trabajador->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado', $trabajador->estado) === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Suspendido" {{ old('estado', $trabajador->estado) === 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
                                </select>
                                @error('estado')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            ✅ Guardar Cambios
                        </button>
                        <a href="{{ route('trabajadores.show', $trabajador->dni) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            ❌ Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para validaciones en tiempo real -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ========== CONVERSIÓN AUTOMÁTICA A MAYÚSCULAS ==========
    const camposMayusculas = ['nombre_completo', 'cargo', 'area_departamento'];
    
    camposMayusculas.forEach(fieldId => {
        const campo = document.getElementById(fieldId);
        if (campo) {
            campo.addEventListener('input', function() {
                this.value = this.value.toUpperCase();
            });
        }
    });

    // ========== VALIDACIÓN TELÉFONO: Solo números, máximo 9 ==========
    const telefonoInputs = ['telefono', 'telefono_emergencia'];
    
    telefonoInputs.forEach(inputId => {
        const input = document.getElementById(inputId);
        if (input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\D/g, '');
                if (this.value.length > 9) {
                    this.value = this.value.slice(0, 9);
                }
            });
        }
    });

    // ========== VALIDACIÓN CCI: Solo números, máximo 20 ==========
    const cciInput = document.getElementById('cci');
    if (cciInput) {
        cciInput.addEventListener('input', function() {
            this.value = this.value.replace(/\D/g, '');
            if (this.value.length > 20) {
                this.value = this.value.slice(0, 20);
            }
        });
    }

    // ========== VALIDACIÓN CUENTA BANCARIA: Máximo 20 caracteres ==========
    const cuentaInput = document.getElementById('cuenta_bancaria');
    if (cuentaInput) {
        cuentaInput.addEventListener('input', function() {
            if (this.value.length > 20) {
                this.value = this.value.slice(0, 20);
            }
        });
    }

    // ========== MANEJO DE CV: Mostrar nombre del archivo ==========
    const cvInput = document.getElementById('cv');
    const cvFileName = document.getElementById('cvFileName');
    const cvName = document.getElementById('cvName');

    if (cvInput) {
        cvInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                cvName.textContent = this.files[0].name;
                cvFileName.classList.remove('hidden');
            } else {
                cvFileName.classList.add('hidden');
            }
        });
    }
});
</script>
@endsection