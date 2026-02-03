@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Auditoría del Sistema</h1>
        <p class="text-gray-600 mt-2">Registro de todas las acciones realizadas en el sistema</p>
    </div>

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <form method="GET" action="{{ route('auditoria.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                
                <!-- Usuario -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Usuario</label>
                    <input 
                        type="text" 
                        name="user_id" 
                        value="{{ request('user_id') }}"
                        placeholder="ID o nombre"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    >
                </div>

                <!-- Acción -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Acción</label>
                    <input 
                        type="text" 
                        name="accion" 
                        value="{{ request('accion') }}"
                        placeholder="Ej: Crear, Editar"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    >
                </div>

                <!-- Modelo -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Módulo</label>
                    <input 
                        type="text" 
                        name="modelo" 
                        value="{{ request('modelo') }}"
                        placeholder="Ej: Trabajador"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    >
                </div>

                <!-- Fecha Desde -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Desde</label>
                    <input 
                        type="date" 
                        name="fecha_desde" 
                        value="{{ request('fecha_desde') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    >
                </div>

                <!-- Fecha Hasta -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Hasta</label>
                    <input 
                        type="date" 
                        name="fecha_hasta" 
                        value="{{ request('fecha_hasta') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    >
                </div>
            </div>

            <!-- Botones -->
            <div class="flex gap-3">
                <button 
                    type="submit" 
                    class="px-6 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition"
                >
                    🔍 Buscar
                </button>
                <a 
                    href="{{ route('auditoria.index') }}" 
                    class="px-6 py-2 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition"
                >
                    ✕ Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Tabla de Auditoría -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Fecha</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Usuario</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Acción</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Módulo</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">IP</th>
                    <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Acción</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($auditoria as $registro)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-900">
                            {{ $registro->fecha->format('d/m/Y H:i:s') }}
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                {{ $registro->user->name ?? 'Sistema' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                            {{ $registro->accion }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $registro->modelo ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $registro->ip_address ?? '-' }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a 
                                href="{{ route('auditoria.show', $registro->id) }}" 
                                class="text-blue-600 hover:text-blue-900 text-sm font-medium"
                            >
                                Ver
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            No hay registros de auditoría
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Paginación -->
    <div class="mt-8">
        {{ $auditoria->links() }}
    </div>
</div>
@endsection