@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">👀 Vista Previa</h1>
                        <p class="text-gray-600 mt-1">{{ $plantilla->nombre }}</p>
                    </div>
                    <a href="{{ route('plantillas.show', $plantilla->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ↩️ Volver
                    </a>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <p class="text-sm text-gray-600 mb-4">Datos de ejemplo para la vista previa:</p>
                <div class="bg-blue-50 border border-blue-200 p-4 rounded mb-6 text-sm">
                    <p><strong>Trabajador:</strong> Juan Pérez García</p>
                    <p><strong>DNI:</strong> 12345678</p>
                    <p><strong>Cargo:</strong> Ingeniero de Sistemas</p>
                    <p><strong>Salario:</strong> S/. 3500.00</p>
                    <p><strong>Fecha Inicio:</strong> 01/02/2026</p>
                    <p><strong>Fecha Fin:</strong> 01/05/2026</p>
                </div>

                <!-- Contenido HTML procesado -->
                <div class="border-t pt-6">
                    <div class="prose prose-sm max-w-none">
                        {!! $contenido !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
            <div class="p-6">
                <div class="flex gap-3">
                    <a href="{{ route('plantillas.show', $plantilla->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                        ↩️ Volver
                    </a>
                    @can('edit.plantillas')
                    <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        ✏️ Editar Plantilla
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection