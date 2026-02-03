@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800">✏️ Editar Plantilla</h1>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('plantillas.update', $plantilla->id) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Plantilla *</label>
                        <input type="text" name="nombre" value="{{ old('nombre', $plantilla->nombre) }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @error('nombre')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('descripcion', $plantilla->descripcion) }}</textarea>
                    </div>

                    <!-- Tipo de Contrato -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Contrato *</label>
                        <select name="tipo_contrato" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Selecciona tipo</option>
                            <option value="Para servicio específico" {{ old('tipo_contrato', $plantilla->tipo_contrato) === 'Para servicio específico' ? 'selected' : '' }}>Para servicio específico</option>
                            <option value="Por incremento de actividad" {{ old('tipo_contrato', $plantilla->tipo_contrato) === 'Por incremento de actividad' ? 'selected' : '' }}>Por incremento de actividad</option>
                        </select>
                        @error('tipo_contrato')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contenido HTML -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contenido HTML *</label>
                        <p class="text-gray-600 text-xs mb-2 bg-blue-50 p-3 rounded border border-blue-200">
                            <strong>Variables disponibles:</strong><br>
                            <code>@{{ nombre_completo }}</code> - Nombre completo del trabajador<br>
                            <code>@{{ dni }}</code> - DNI del trabajador<br>
                            <code>@{{ cargo }}</code> - Cargo/Puesto<br>
                            <code>@{{ salario_mensual }}</code> - Salario mensual<br>
                            <code>@{{ fecha_inicio }}</code> - Fecha de inicio<br>
                            <code>@{{ fecha_fin }}</code> - Fecha de fin<br>
                            <code>@{{ horario }}</code> - Horario de trabajo
                        </p>
                        <textarea name="contenido_html" required rows="12"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-mono text-sm">{{ old('contenido_html', $plantilla->contenido_html) }}</textarea>
                        @error('contenido_html')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Activa -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="activa" {{ old('activa', $plantilla->activa) ? 'checked' : '' }} class="rounded border-gray-300">
                            <span class="ml-2 text-sm text-gray-700">Plantilla activa</span>
                        </label>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-4 border-t">
                        <a href="{{ route('plantillas.show', $plantilla->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            ❌ Cancelar
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            ✅ Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection