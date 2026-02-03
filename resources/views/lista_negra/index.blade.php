@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Lista Negra</h1>
                        <p class="text-sm text-gray-600 mt-1">Total de registros: <span class="font-medium">{{ $listaNegra->total() }}</span></p>
                    </div>
                    @can('create.lista_negra')
                    <a href="{{ route('lista-negra.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                        </svg>
                        Agregar a Lista Negra
                    </a>
                    @endcan
                </div>
            </div>
        </div>

        <!-- Mensaje de éxito/error -->
        @if ($message = Session::get('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-md" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-md" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-red-800">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- Filtros y Búsqueda -->
        <div class="bg-white shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <form method="GET" action="{{ route('lista-negra.index') }}" id="filtrosForm" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Búsqueda por DNI -->
                        <div>
                            <label for="dni" class="block text-sm font-medium text-gray-700 mb-1">
                                DNI
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                    </svg>
                                </div>
                                <input type="text" 
                                       name="dni" 
                                       id="dni"
                                       value="{{ request('dni') }}" 
                                       placeholder="Buscar por DNI"
                                       class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            </div>
                        </div>

                        <!-- Búsqueda por Nombre -->
                        <div>
                            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">
                                Nombre
                            </label>
                            <input type="text" 
                                   name="nombre" 
                                   id="nombre"
                                   value="{{ request('nombre') }}" 
                                   placeholder="Buscar por nombre"
                                   class="block w-full px-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                        </div>

                        <!-- Filtro Tipo de Bloqueo -->
                        <div>
                            <label for="motivo" class="block text-sm font-medium text-gray-700 mb-1">
                                Tipo de Bloqueo
                            </label>
                            <select name="motivo" 
                                    id="motivo"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Todos los tipos</option>
                                <option value="Leve" {{ request('motivo') === 'Leve' ? 'selected' : '' }}>Leve</option>
                                <option value="Grave" {{ request('motivo') === 'Grave' ? 'selected' : '' }}>Grave</option>
                            </select>
                        </div>

                        <!-- Filtro Estado -->
                        <div>
                            <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">
                                Estado
                            </label>
                            <select name="estado" 
                                    id="estado"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Todos los estados</option>
                                <option value="Bloqueado" {{ request('estado') === 'Bloqueado' ? 'selected' : '' }}>Bloqueado</option>
                                <option value="Desbloqueado" {{ request('estado') === 'Desbloqueado' ? 'selected' : '' }}>Desbloqueado</option>
                                <option value="Resuelto" {{ request('estado') === 'Resuelto' ? 'selected' : '' }}>Resuelto</option>
                            </select>
                        </div>
                    </div>

                    <!-- Botón Limpiar -->
                    <div class="flex justify-end">
                        <a href="{{ route('lista-negra.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Limpiar Filtros
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabla de Lista Negra -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                DNI
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Trabajador
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tipo Bloqueo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Motivo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Fecha Bloqueo
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Estado
                            </th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($listaNegra as $registro)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $registro->dni }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $registro->trabajador->nombre_completo ?? 'N/A' }}</div>
                                <div class="text-sm text-gray-500">{{ $registro->trabajador->cargo ?? 'Sin cargo' }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($registro->motivo === 'Leve')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Leve
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Grave
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 max-w-xs truncate" title="{{ $registro->descripcion_motivo }}">
                                    {{ Str::limit($registro->descripcion_motivo, 50) }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $registro->fecha_bloqueo->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($registro->estado === 'Bloqueado')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Bloqueado
                                </span>
                                @elseif($registro->estado === 'Desbloqueado')
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Desbloqueado
                                </span>
                                @else
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    <svg class="mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Resuelto
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-3">
                                    <!-- Ver detalles -->
                                    <a href="{{ route('lista-negra.show', $registro->id) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                       title="Ver detalles">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </a>
                                    
                                    <!-- Desbloquear -->
                                    @if($registro->estado === 'Bloqueado' && $registro->motivo === 'Leve' && Auth::user()->hasPermissionTo('desbloquear.lista_negra'))
                                    <a href="{{ route('lista-negra.desbloquear-form', $registro->id) }}" 
                                       class="text-green-600 hover:text-green-900 transition-colors duration-150"
                                       title="Desbloquear">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"/>
                                        </svg>
                                    </a>
                                    @endif
                                    
                                    <!-- Eliminar -->
                                    @can('delete.lista_negra')
                                    <form action="{{ route('lista-negra.destroy', $registro->id) }}" 
                                          method="POST" 
                                          class="inline-block"
                                          onsubmit="return confirm('¿Está seguro de eliminar este registro? Esta acción no se puede deshacer.');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-900 transition-colors duration-150"
                                                title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">No hay trabajadores en lista negra</h3>
                                <p class="mt-1 text-sm text-gray-500">Cuando agregues trabajadores a la lista negra, aparecerán aquí.</p>
                                @can('create.lista_negra')
                                <div class="mt-6">
                                    <a href="{{ route('lista-negra.create') }}" 
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                        Agregar a Lista Negra
                                    </a>
                                </div>
                                @endcan
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($listaNegra->hasPages())
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $listaNegra->links() }}
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Script para búsqueda automática -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dniInput = document.getElementById('dni');
    const nombreInput = document.getElementById('nombre');
    const motivoSelect = document.getElementById('motivo');
    const estadoSelect = document.getElementById('estado');
    const form = document.getElementById('filtrosForm');
    
    let timeoutId;
    
    // Función para enviar el formulario con un pequeño delay
    function submitFormWithDelay() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(function() {
            form.submit();
        }, 500); // Espera 500ms después de que el usuario deje de escribir
    }
    
    // Búsqueda automática al escribir
    if (dniInput) {
        dniInput.addEventListener('input', submitFormWithDelay);
    }
    
    if (nombreInput) {
        nombreInput.addEventListener('input', submitFormWithDelay);
    }
    
    // Búsqueda automática al cambiar filtros
    if (motivoSelect) {
        motivoSelect.addEventListener('change', function() {
            form.submit();
        });
    }
    
    if (estadoSelect) {
        estadoSelect.addEventListener('change', function() {
            form.submit();
        });
    }
});
</script>
@endsection