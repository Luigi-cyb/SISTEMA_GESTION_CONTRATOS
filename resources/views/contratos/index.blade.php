@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div
                                style="background: #eff6ff; color: #3b82f6; padding: 12px; border-radius: 16px; margin-right: 20px; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Gestión de Contratos</h1>
                                <p class="text-sm font-semibold text-gray-500 mt-1">Total de registros: <span
                                        class="text-blue-600 bg-blue-50 px-2 py-0.5 rounded-md border border-blue-100 ml-1">{{ $contratos->total() }}</span>
                                </p>
                            </div>
                        </div>
                        @can('create.contratos')
                            <a href="{{ route('contratos.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Nuevo Contrato
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
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
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
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
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
                    <form method="GET" action="{{ route('contratos.index') }}" id="filtrosForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Búsqueda por DNI o Nombre -->
                            <div class="md:col-span-2">
                                <label for="search" class="block text-sm font-medium text-gray-700 mb-1">
                                    Buscar por DNI o Nombre
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                        </svg>
                                    </div>
                                    <input type="text" name="search" id="search" value="{{ $search }}"
                                        placeholder="Ingrese DNI o nombre del trabajador"
                                        class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:placeholder-gray-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                </div>
                            </div>

                            <!-- Filtro Estado -->
                            <div>
                                <label for="estado" class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado del Contrato
                                </label>
                                <select name="estado" id="estado"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Todos los estados</option>
                                    @foreach ($estados as $est)
                                        <option value="{{ $est }}" {{ $estado === $est ? 'selected' : '' }}>{{ $est }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Filtro Plantilla -->
                            <div>
                                <label for="plantilla_id" class="block text-sm font-medium text-gray-700 mb-1">
                                    Plantilla del Contrato *
                                </label>
                                <select name="plantilla_id" id="plantilla_id"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Todas las plantillas</option>
                                    @foreach ($plantillas as $plantilla)
                                        <option value="{{ $plantilla->id }}" {{ (isset($plantilla_id) && $plantilla_id == $plantilla->id) ? 'selected' : '' }}>
                                            {{ $plantilla->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Botón Limpiar -->
                        <div class="flex justify-end">
                            <a href="{{ route('contratos.index') }}"
                                class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                </svg>
                                Limpiar Filtros
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de Contratos -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    DNI
                                </th>
                                <th scope="col"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trabajador
                                </th>
                                <th scope="col"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Vigencia
                                </th>
                                <th scope="col"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    N° Contrato
                                </th>
                                <th scope="col"
                                    class="px-3 py-2 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($contratos as $contrato)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $contrato->dni }}</div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $contrato->trabajador->nombre_completo }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $contrato->trabajador->cargo ?? 'Sin cargo' }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $contrato->fecha_inicio->format('d/m/Y') }}</div>
                                        <div class="text-sm text-gray-500">hasta {{ $contrato->fecha_fin->format('d/m/Y') }}
                                        </div>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        @php
                                            $numeroAdendas = \App\Models\Adenda::where('contrato_id', $contrato->id)->count();
                                        @endphp

                                        @if ($numeroAdendas > 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800"
                                                title="Contrato con {{ $numeroAdendas }} adenda(s)">
                                                <svg class="mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Renovado
                                            </span>
                                        @elseif ($contrato->estado === 'Activo')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Activo
                                            </span>
                                        @elseif ($contrato->estado === 'Vencido')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800"
                                                title="Contrato finalizado sin renovación">
                                                <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Culminado
                                            </span>
                                        @elseif ($contrato->estado === 'Borrador')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Borrador
                                            </span>
                                        @elseif ($contrato->estado === 'Firmado')
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                <svg class="mr-1.5 h-2 w-2 text-blue-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Firmado
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                {{ $contrato->estado }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap">
                                        <span
                                            class="font-mono text-xs font-semibold text-gray-700 bg-gray-100 border border-gray-300 px-2 py-1 rounded shadow-sm">
                                            {{ $contrato->numero_contrato ?? '---' }}
                                        </span>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2 flex-wrap gap-2">
                                            <!-- Botón Ver -->
                                            <a href="{{ route('contratos.show', $contrato->id) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                                title="Ver detalles">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <!-- ✅ BOTÓN RENOVAR - SIEMPRE VISIBLE -->
                                            @php
                                                $numeroAdendas = \App\Models\Adenda::where('contrato_id', $contrato->id)->count();
                                            @endphp

                                            @if ($contrato->estado === 'Activo')
                                                <!-- Si está ACTIVO: Botón verde "Renovar" -->
                                                <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                                    class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold hover:bg-green-200 transition-colors"
                                                    title="Crear nueva adenda">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Renovar
                                                </a>
                                            @elseif ($contrato->estado === 'Vencido')
                                                <!-- Si está VENCIDO: Mostrar adendas + botón verde "Renovar otra vez" -->
                                                <span
                                                    class="inline-flex items-center px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-semibold">
                                                    <svg class="w-4 h-4 mr-1 text-green-600" fill="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" />
                                                    </svg>
                                                    {{ $numeroAdendas }} Adenda(s)
                                                </span>

                                                <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                                    class="inline-flex items-center px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold hover:bg-green-200 transition-colors"
                                                    title="Crear nueva adenda">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                                    </svg>
                                                    Renovar otra vez
                                                </a>
                                            @endif

                                            <!-- Botón Editar -->
                                            @can('edit.contratos')
                                                <a href="{{ route('contratos.edit', $contrato->id) }}"
                                                    class="text-yellow-600 hover:text-yellow-900 transition-colors duration-150"
                                                    title="Editar">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                    </svg>
                                                </a>
                                            @endcan

                                            <!-- Botón Eliminar -->
                                            @can('delete.contratos')
                                                <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('¿Está seguro de eliminar este contrato? Esta acción no se puede deshacer.');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-900 transition-colors duration-150"
                                                        title="Eliminar">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No hay contratos registrados</h3>
                                        <p class="mt-1 text-sm text-gray-500">Comience creando un nuevo contrato.</p>
                                        @can('create.contratos')
                                            <div class="mt-6">
                                                <a href="{{ route('contratos.create') }}"
                                                    class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 4v16m8-8H4" />
                                                    </svg>
                                                    Nuevo Contrato
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
                @if ($contratos->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                        {{ $contratos->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Script para búsqueda automática -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('search');
            const estadoSelect = document.getElementById('estado');
            const plantillaSelect = document.getElementById('plantilla_id');
            const form = document.getElementById('filtrosForm');

            let timeoutId;

            // Función para enviar el formulario con un pequeño delay
            function submitFormWithDelay() {
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    form.submit();
                }, 500); // Espera 500ms después de que el usuario deje de escribir
            }

            // Búsqueda automática al escribir
            if (searchInput) {
                searchInput.addEventListener('input', submitFormWithDelay);
            }

            // Búsqueda automática al cambiar filtros
            if (estadoSelect) {
                estadoSelect.addEventListener('change', function () {
                    form.submit();
                });
            }

            if (plantillaSelect) {
                plantillaSelect.addEventListener('change', function () {
                    form.submit();
                });
            }
        });
    </script>
@endsection