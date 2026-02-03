@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $plantilla->nombre }}</h1>
                        <p class="text-gray-600 mt-1">{{ $plantilla->descripcion }}</p>
                    </div>
                    @can('edit.plantillas')
                    <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        ✏️ Editar
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Información -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Tipo de Contrato</label>
                    <p class="mt-1 text-lg font-semibold text-gray-900">{{ $plantilla->tipo_contrato }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Predeterminada</label>
                    <p class="mt-1">
                        @if ($plantilla->es_predeterminada)
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm">⭐ Sí</span>
                        @else
                            <span class="px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm">No</span>
                        @endif
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <p class="mt-1">
                        @if ($plantilla->activa)
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm">🟢 Activa</span>
                        @else
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm">🔴 Inactiva</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <!-- Contenido -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">📝 Contenido HTML</h2>
                <div class="bg-gray-50 p-4 rounded border border-gray-200 overflow-x-auto">
                    <pre class="text-xs text-gray-700 whitespace-pre-wrap">{{ $plantilla->contenido_html }}</pre>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex gap-3">
                    <a href="{{ route('plantillas.preview', $plantilla->id) }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        👀 Ver Preview
                    </a>
                    @can('edit.plantillas')
                    <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        ✏️ Editar
                    </a>
                    @endcan
                    <a href="{{ route('plantillas.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ↩️ Volver
                    </a>
                    <a href="{{ route('plantillas.pdf', $plantilla->id) }}" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
    📥 Descargar PDF
</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection