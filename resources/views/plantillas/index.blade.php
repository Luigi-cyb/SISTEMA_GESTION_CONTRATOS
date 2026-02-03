@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 sm:py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Plantillas de Contratos</h1>
                    <p class="text-gray-600 mt-2">Gestión de plantillas EMI</p>
                </div>
                @can('create.plantillas')
                <a href="{{ route('plantillas.create') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    + Nueva Plantilla
                </a>
                @endcan
            </div>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <form method="GET" action="{{ route('plantillas.index') }}" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tipo de Contrato</label>
                    <select name="tipo" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">Todos</option>
                        <option value="Para servicio específico" {{ $tipo === 'Para servicio específico' ? 'selected' : '' }}>Para servicio específico</option>
                        <option value="Por incremento de actividad" {{ $tipo === 'Por incremento de actividad' ? 'selected' : '' }}>Por incremento de actividad</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-semibold text-sm rounded-lg transition">
                        Filtrar
                    </button>
                    <a href="{{ route('plantillas.index') }}" class="flex-1 px-4 py-2.5 bg-gray-300 hover:bg-gray-400 text-gray-900 font-semibold text-sm rounded-lg transition text-center">
                        Limpiar
                    </a>
                </div>
            </form>
        </div>

        <!-- Mensajes -->
        @if ($message = Session::get('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
            <p class="text-sm font-semibold text-green-900">✓ {{ $message }}</p>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
            <p class="text-sm font-semibold text-red-900">✕ {{ $message }}</p>
        </div>
        @endif

        <!-- Tabla -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wide">Plantilla</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wide">Tipo</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wide">Predeterminada</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wide">Estado</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-gray-600 uppercase tracking-wide">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($plantillas as $plantilla)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-semibold text-gray-900">{{ $plantilla->nombre }}</p>
                                    <p class="text-xs text-gray-500">ID: {{ $plantilla->id }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-sm text-gray-700">{{ $plantilla->tipo_contrato }}</span>
                            </td>
                            <td class="px-6 py-4">
                                @if ($plantilla->es_predeterminada)
                                    <span class="inline-flex items-center px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full">★ Sí</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full">No</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if ($plantilla->activa)
                                    <span class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 text-xs font-semibold rounded-full">● Activa</span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">● Inactiva</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-3">
                                    <a href="{{ route('plantillas.show', $plantilla->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">Ver</a>
                                    <a href="{{ route('plantillas.preview', $plantilla->id) }}" class="text-purple-600 hover:text-purple-800 text-sm font-medium">Preview</a>
                                    @can('edit.plantillas')
                                    <a href="{{ route('plantillas.edit', $plantilla->id) }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium">Editar</a>
                                    @endcan
                                    @can('delete.plantillas')
                                    @if (!$plantilla->es_predeterminada)
                                    <form action="{{ route('plantillas.destroy', $plantilla->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Eliminar esta plantilla?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Eliminar</button>
                                    </form>
                                    @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <p class="text-gray-500 text-sm">No hay plantillas registradas</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($plantillas->count() > 0)
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $plantillas->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

        <!-- Info de Plantillas EMI -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-sm font-bold text-blue-900 uppercase tracking-wide mb-3">Plantillas EMI Disponibles</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 text-sm text-blue-800">
                <div>• EMI-ALP-PROY-CM</div>
                <div>• EMI-CEN-ADM-14X7</div>
                <div>• EMI-CEN-ADM-8HORAS</div>
                <div>• EMI-CEN-CANCHA-PB</div>
                <div>• EMI-CHUN-AA-MTP</div>
                <div>• EMI-CHUN-AA-RR</div>
                <div>• EMI-CHUN-ADM</div>
                <div>• EMI-CHUN-CM</div>
                <div>• EMI-CHUN-DC</div>
                <div>• EMI-CHUN-LA</div>
                <div>• EMI-CHUN-PF</div>
                <div>• EMI-CHUN-PROY</div>
                <div>• EMI-CHUN-TRNS</div>
                <div>• EMI-HUA-HH-ORDEN</div>
                <div>• EMI-ROM-PROY</div>
            </div>
        </div>
    </div>
</div>
@endsection