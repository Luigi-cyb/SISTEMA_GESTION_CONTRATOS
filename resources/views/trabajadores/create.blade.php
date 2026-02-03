@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800">➕ Crear Nuevo Trabajador</h1>
                <p class="text-gray-600 mt-1">Completa los datos del nuevo trabajador</p>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data">
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

                    <!-- SECCIÓN 1: Datos Básicos -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">📋 Datos Básicos</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- DNI -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">DNI *</label>
                                <input type="text" 
                                       name="dni" 
                                       id="dni"
                                       maxlength="8" 
                                       value="{{ old('dni') }}"
                                       placeholder="Ej: 12345678" 
                                       required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('dni') border-red-500 @enderror">
                                <p class="text-xs text-gray-500 mt-1">Debe tener exactamente 8 dígitos</p>
                                @error('dni')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre Completo (MAYÚSCULAS AUTOMÁTICAS) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nombre Completo *</label>
                                <input type="text" 
                                       name="nombre_completo" 
                                       id="nombre_completo"
                                       value="{{ old('nombre_completo') }}"
                                       placeholder="Ej: JUAN PÉREZ GARCÍA" 
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
                                       value="{{ old('fecha_nacimiento') }}"
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
                                       value="{{ old('nacionalidad', 'Peruana') }}"
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
                                       value="{{ old('cargo') }}"
                                       placeholder="Ej: INGENIERO" 
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
                                       value="{{ old('area_departamento') }}"
                                       placeholder="Ej: OPERACIONES"
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
                                    <option value="{{ $uni }}" {{ old('unidad') === $uni ? 'selected' : '' }}>{{ $uni }}</option>
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
                                       value="{{ old('fecha_ingreso') }}" 
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
                                       value="{{ old('telefono') }}"
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
                                       value="{{ old('email') }}"
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
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('direccion_actual') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Puede escribir con mayúsculas o minúsculas</p>
                            </div>

                            <!-- Contacto de Emergencia -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Contacto de Emergencia</label>
                                <input type="text" 
                                       name="contacto_emergencia" 
                                       value="{{ old('contacto_emergencia') }}"
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
                                       value="{{ old('telefono_emergencia') }}"
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
                        <p class="text-gray-600 text-sm mb-4">Estos datos son opcionales y pueden completarse posteriormente</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Cuenta Bancaria (OPCIONAL) -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Cuenta Bancaria</label>
                                <input type="text" 
                                       name="cuenta_bancaria" 
                                       id="cuenta_bancaria"
                                       maxlength="20"
                                       value="{{ old('cuenta_bancaria') }}"
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
                                       value="{{ old('cci') }}"
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
    <p class="text-gray-600 text-sm mb-4">Carga el CV en formato PDF (máximo 5MB)</p>
    
    <div class="grid grid-cols-1 gap-6">
        <!-- CV Upload -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Archivo CV (PDF)</label>
            <input type="file" 
                   name="cv" 
                   id="cv"
                   accept=".pdf"
                   class="block w-full text-sm text-gray-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-md file:border-0
                          file:text-sm file:font-semibold
                          file:bg-blue-50 file:text-blue-700
                          hover:file:bg-blue-100
                          border border-gray-300 rounded-lg p-2">
            <p class="text-xs text-gray-500 mt-2">Solo PDF, máximo 5MB</p>
            
            <!-- Nombre del archivo seleccionado -->
            <div id="cvFileName" class="mt-3 text-sm text-green-700 hidden">
                <p><strong>✓ Archivo seleccionado:</strong> <span id="cvName"></span></p>
            </div>
            
            @error('cv')
            <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
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
                                    <option value="Activo" {{ old('estado') === 'Activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="Inactivo" {{ old('estado') === 'Inactivo' ? 'selected' : '' }}>Inactivo</option>
                                    <option value="Suspendido" {{ old('estado') === 'Suspendido' ? 'selected' : '' }}>Suspendido</option>
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
                            ✅ Guardar
                        </button>
                        <a href="{{ route('trabajadores.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            ❌ Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript para validaciones en tiempo real -->
<!-- JavaScript para manejo de CV -->
<script>
document.addEventListener('DOMContentLoaded', function() {
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