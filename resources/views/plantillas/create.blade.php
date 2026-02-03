@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800">➕ Nueva Plantilla</h1>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('plantillas.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nombre -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre de la Plantilla *</label>
                        <input type="text" name="nombre" value="{{ old('nombre') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Ej: Contrato Temporal - 3 Meses">
                        @error('nombre')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Descripción</label>
                        <textarea name="descripcion" rows="3"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Descripción breve de la plantilla">{{ old('descripcion') }}</textarea>
                    </div>

                    <!-- Tipo de Contrato -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipo de Contrato *</label>
                        <select name="tipo_contrato" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">-- Selecciona --</option>
                            <option value="Temporal" {{ old('tipo_contrato') === 'Temporal' ? 'selected' : '' }}>Temporal</option>
                            <option value="Indefinido" {{ old('tipo_contrato') === 'Indefinido' ? 'selected' : '' }}>Indefinido</option>
                            <option value="Practicante" {{ old('tipo_contrato') === 'Practicante' ? 'selected' : '' }}>Practicante</option>
                            <option value="Por incremento de actividad" {{ old('tipo_contrato') === 'Por incremento de actividad' ? 'selected' : '' }}>Por Incremento de Actividad</option>
                        </select>
                        @error('tipo_contrato')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contenido HTML -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Contenido HTML *</label>
                        <p class="text-gray-600 text-xs mb-2">Variables disponibles: {{nombre_completo}}, {{dni}}, {{cargo}}, {{salario_mensual}}, {{fecha_inicio}}, {{fecha_fin}}, {{horario}}</p>
                        <textarea name="contenido_html" required rows="12"
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 font-mono text-sm"
                                  placeholder="<h2>CONTRATO</h2>&#10;<p><strong>Trabajador:</strong> {{nombre_completo}}</p>&#10;<p><strong>DNI:</strong> {{dni}}</p>">{{ old('contenido_html') }}</textarea>
                        @error('contenido_html')
                        <span class="text-red-600 text-sm mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-3 justify-end pt-4 border-t">
                        <a href="{{ route('plantillas.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            ❌ Cancelar
                        </a>
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                            ✅ Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection