@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="bg-white border-l-4 border-blue-600 shadow-lg sm:rounded-lg mb-6 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">{{ $trabajador->nombre_completo }}
                        </h1>
                        <div class="mt-2 flex items-center gap-3 text-sm text-gray-600">
                            <span class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                </svg>
                                {{ $trabajador->dni }}
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{ $trabajador->cargo }}
                            </span>
                            <span class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $trabajador->unidad }}
                            </span>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end gap-3">
                        @php
                            $estadoActual = $trabajador->getEstadoCorrectoAttribute();
                        @endphp
                        @if ($estadoActual === 'Activo')
                            <span
                                class="inline-flex items-center px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-bold border border-green-200">
                                <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span> Activo
                            </span>
                        @elseif ($estadoActual === 'Inactivo')
                            <span
                                class="inline-flex items-center px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-sm font-bold border border-gray-200">
                                <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span> Inactivo
                            </span>
                        @elseif ($estadoActual === 'Suspendido')
                            <span
                                class="inline-flex items-center px-3 py-1 bg-red-100 text-red-800 rounded-full text-sm font-bold border border-red-200">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span> Suspendido
                            </span>
                        @endif

                        <!-- Icono Decorativo -->
                        <div class="hidden md:block opacity-20">
                            <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensaje de éxito -->
            @if ($message = Session::get('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-4 rounded-r-lg mb-6"
                    role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="font-medium">{{ $message }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- ALERTA: Lista Negra -->
            @if ($trabajador->listaNegra)
                <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium">Trabajador en Lista Negra</h3>
                            <div class="mt-2 text-sm">
                                <p><strong>Motivo:</strong> {{ $trabajador->listaNegra->motivo }}</p>
                                <p><strong>Fecha:</strong>
                                    {{ optional($trabajador->listaNegra->fecha_bloqueo)->format('d/m/Y') ?? 'No registrada' }}</p>
                                <p><strong>Autorizado por:</strong> {{ $trabajador->listaNegra->bloqueadoPor->name ?? 'Administración' }}</p>
                            </div>
                            @can('edit.lista_negra')
                                <div class="mt-4">
                                    <a href="{{ route('lista-negra.show', $trabajador->listaNegra->id) }}"
                                        class="text-red-700 hover:text-red-900 underline font-semibold text-sm">
                                        Ver detalles →
                                    </a>
                                </div>
                            @endcan
                        </div>
                    </div>
                </div>
            @endif

            <!-- Botones de Acción -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 flex flex-wrap items-center gap-4">
                    @can('edit.trabajadores')
                        <a href="{{ route('trabajadores.edit', $trabajador->dni) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Editar
                        </a>
                    @endcan

                    @can('create.contratos')
                        <a href="{{ route('contratos.create', ['trabajador_dni' => $trabajador->dni]) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Nuevo Contrato
                        </a>
                    @endcan

                    @can('view.lista_negra')
                        @if (!$trabajador->listaNegra)
                            <a href="{{ route('lista-negra.create', ['trabajador_dni' => $trabajador->dni]) }}"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-500 focus:outline-none focus:border-yellow-700 focus:ring focus:ring-yellow-200 active:bg-yellow-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Agregar a Lista Negra
                            </a>
                        @endif
                    @endcan

                    @can('delete.trabajadores')
                        <form action="{{ route('trabajadores.destroy', $trabajador->dni) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('¿Estás seguro de que deseas eliminar este trabajador?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    @endcan

                    <a href="{{ route('trabajadores.index') }}"
                        class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 ml-auto gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <!-- Grid: 2 columnas -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Columna Izquierda (2/3) -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Información Personal -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Información Personal</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">DNI</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->dni }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Nombre Completo</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->nombre_completo }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Fecha de Nacimiento</p>
                                    @if ($trabajador->fecha_nacimiento)
                                        <p class="text-gray-900 font-semibold mt-1">
                                            {{ $trabajador->fecha_nacimiento->format('d/m/Y') }}</p>
                                        <p class="text-gray-500 text-xs">{{ $trabajador->fecha_nacimiento->age }} años</p>
                                    @else
                                        <p class="text-gray-500 font-semibold mt-1">No registrado</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Nacionalidad</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->nacionalidad }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Laboral -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-green-100 p-2 rounded-lg text-green-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Información Laboral</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Cargo</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cargo }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Área/Departamento</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->area_departamento }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Unidad</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->unidad }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Fecha de Ingreso</p>
                                    @if ($trabajador->fecha_ingreso)
                                        <p class="text-gray-900 font-semibold mt-1">
                                            {{ $trabajador->fecha_ingreso->format('d/m/Y') }}</p>
                                    @else
                                        <p class="text-gray-500 font-semibold mt-1">No registrado</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Información de Contacto</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Teléfono</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->telefono ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Email</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->email ?? '-' }}</p>
                                </div>
                                <div class="md:col-span-2">
                                    <p class="text-gray-600 text-sm font-medium">Dirección Actual</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->direccion_actual ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Contacto de Emergencia</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        {{ $trabajador->contacto_emergencia ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Teléfono de Emergencia</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        {{ $trabajador->telefono_emergencia ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos Bancarios -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-yellow-100 p-2 rounded-lg text-yellow-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Datos Bancarios</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Cuenta Bancaria</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cuenta_bancaria ?? '-' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">CCI</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cci ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historial de Contratos -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-gray-100 p-2 rounded-lg text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Historial de Contratos</h2>
                            </div>

                            @if ($trabajador->contratos->count() > 0)
                                <div class="space-y-4">
                                    @foreach ($trabajador->contratos->sortByDesc('created_at') as $contrato)
                                        <div
                                            class="border-l-4 {{ $contrato->estado === 'Activo' ? 'border-green-600' : 'border-gray-400' }} pl-4 py-3 bg-gray-50 rounded-r shadow-sm">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="text-gray-900 font-semibold">
                                                        {{ $contrato->numero_contrato }}</p>
                                                    <p class="text-gray-600 text-sm">{{ $contrato->tipo_contrato }}</p>
                                                    <p class="text-gray-600 text-sm">
                                                        {{ $contrato->fecha_inicio->format('d/m/Y') }}
                                                        - {{ $contrato->fecha_fin->format('d/m/Y') }}</p>

                                                    @if ($contrato->adendas->count() > 0)
                                                        <p class="text-blue-600 text-sm font-semibold mt-1">
                                                            {{ $contrato->adendas->count() }} renovación(es)
                                                        </p>
                                                    @endif
                                                </div>
                                                <div class="text-right">
                                                    @if ($contrato->estado === 'Activo')
                                                        <span
                                                            class="inline-block px-3 py-1 bg-green-50 text-green-700 rounded text-xs font-semibold border border-green-200">Activo</span>
                                                    @elseif ($contrato->estado === 'Vencido')
                                                        <span
                                                            class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded text-xs font-semibold border border-red-200">Vencido</span>
                                                    @elseif ($contrato->estado === 'Firmado')
                                                        <span
                                                            class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded text-xs font-semibold border border-blue-200">Firmado</span>
                                                    @else
                                                        <span
                                                            class="inline-block px-3 py-1 bg-gray-50 text-gray-700 rounded text-xs font-semibold border border-gray-200">{{ $contrato->estado }}</span>
                                                    @endif

                                                    <div class="mt-2">
                                                        <a href="{{ route('contratos.show', $contrato->id) }}"
                                                            class="text-blue-600 hover:text-blue-800 text-sm">
                                                            Ver detalles
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-8 text-gray-500">
                                    <p class="mb-4">No hay contratos registrados</p>
                                    @can('create.contratos')
                                        <a href="{{ route('contratos.create', ['trabajador_dni' => $trabajador->dni]) }}"
                                            class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition shadow-sm">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            Crear Primer Contrato
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Columna Derecha (1/3) -->
                <div class="space-y-6">
                    <!-- Tiempo en la Empresa -->
                    <!-- Tiempo en la Empresa -->
                    @php
                        $ahora = \Carbon\Carbon::now();
                        $ingreso = $trabajador->fecha_ingreso;

                        // Calcular años, meses y días de forma correcta
                        $anos = 0;
                        $meses = 0;
                        $dias = 0;

                        if ($ingreso && $ingreso < $ahora) {
                            // Calcular años
                            $anos = intval($ingreso->diffInYears($ahora));

                            // Calcular meses (después de restar los años)
                            $fechaTemp = $ingreso->copy()->addYears($anos);
                            $meses = intval($fechaTemp->diffInMonths($ahora));

                            // Calcular días (después de restar años y meses)
                            $fechaTemp = $fechaTemp->addMonths($meses);
                            $dias = intval($fechaTemp->diffInDays($ahora));
                        }
                        $mesesTotales = $trabajador->contratos->sum(function ($contrato) {
                            $mesesContrato = $contrato->fecha_inicio->diffInMonths($contrato->fecha_fin);
                            $mesesAdendas = $contrato->adendas->sum(function ($adenda) {
                                return $adenda->fecha_inicio->diffInMonths($adenda->fecha_fin);
                            });
                            return $mesesContrato + $mesesAdendas;
                        });
                    @endphp

                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Tiempo en Empresa</h3>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-gray-600 text-sm font-medium">Años</p>
                                    <p class="text-3xl font-bold text-blue-600">{{ $anos }}</p>
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-gray-600 text-xs font-medium">Meses</p>
                                        <p class="text-2xl font-bold text-blue-600">{{ $meses }}</p>
                                    </div>
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-gray-600 text-xs font-medium">Días</p>
                                        <p class="text-2xl font-bold text-blue-600">{{ $dias }}</p>
                                    </div>
                                </div>

                                <!-- Indicador de estabilidad laboral -->
                                @if ($mesesTotales >= 57)
                                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                                        <p class="font-bold text-sm">Alerta: Próximo a 5 años</p>
                                        <p class="text-xs mt-1">Se requiere decisión urgente</p>
                                    </div>
                                @elseif ($mesesTotales >= 48)
                                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-3 rounded">
                                        <p class="font-bold text-sm">Precaución</p>
                                        <p class="text-xs mt-1">4+ años de servicio</p>
                                    </div>
                                @else
                                    <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded">
                                        <p class="font-bold text-sm">Normal</p>
                                        <p class="text-xs mt-1">Menos de 4 años</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Cumpleaños -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-purple-100 p-2 rounded-lg text-purple-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Cumpleaños</h3>
                            </div>

                            @if ($trabajador->fecha_nacimiento)
                                @php
                                    $proximoCumple = \Carbon\Carbon::create(
                                        now()->year,
                                        $trabajador->fecha_nacimiento->month,
                                        $trabajador->fecha_nacimiento->day,
                                    );
                                    if ($proximoCumple->isPast()) {
                                        $proximoCumple->addYear();
                                    }
                                    $diasFaltantes = ceil(now()->diffInDays($proximoCumple, false));
                                    if ($diasFaltantes < 0) {
                                        $diasFaltantes = 0;
                                    }
                                    $esHoy = now()->format('m-d') === $trabajador->fecha_nacimiento->format('m-d');
                                @endphp

                                <div class="space-y-3">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-gray-600 text-sm font-medium">Fecha</p>
                                        <p class="text-gray-900 font-semibold mt-1">
                                            {{ $trabajador->fecha_nacimiento->format('d/m/Y') }}</p>
                                    </div>

                                    @if ($esHoy)
                                        <div class="bg-purple-50 border border-purple-200 text-purple-700 p-4 rounded-lg">
                                            <p class="font-bold text-sm">Hoy es su cumpleaños</p>
                                            <p class="text-xs mt-1">Felicidades por
                                                {{ $trabajador->fecha_nacimiento->age }} años
                                            </p>
                                        </div>
                                    @else
                                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                            <p class="text-gray-600 text-sm font-medium">Próximo cumpleaños</p>
                                            <p class="text-3xl font-bold text-purple-600 mt-1">{{ $diasFaltantes }}</p>
                                            <p class="text-gray-600 text-xs mt-2">
                                                {{ $diasFaltantes === 1 ? 'día' : 'días' }}</p>
                                        </div>
                                    @endif
                                </div>
                            @else
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <p class="text-gray-500 text-sm">Fecha de nacimiento no registrada</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Currículum Vitae -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-red-100 p-2 rounded-lg text-red-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Currículum Vitae</h3>
                            </div>

                            @if ($trabajador->tieneCV())
                                <div class="space-y-3">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-gray-600 text-xs font-medium mb-2">Estado: Cargado</p>
                                        <p class="text-gray-900 text-sm truncate">{{ basename($trabajador->cv_path) }}
                                        </p>
                                    </div>

                                    <a href="{{ route('trabajadores.descargar-cv', $trabajador->dni) }}"
                                        class="inline-flex justify-center items-center w-full gap-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded text-sm transition">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                        </svg>
                                        Descargar
                                    </a>

                                    @can('edit.trabajadores')
                                        <button type="button"
                                            class="inline-flex justify-center items-center w-full gap-2 bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-3 rounded text-sm transition"
                                            onclick="if(confirm('¿Estás seguro de que quieres eliminar el CV?')) { 
                                                    fetch('{{ route('trabajadores.eliminar-cv', $trabajador->dni) }}', {
                                                        method: 'DELETE',
                                                        headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                                                    }).then(() => location.reload());
                                                }">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Eliminar
                                        </button>
                                    @endcan
                                </div>
                            @else
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-center">
                                    <p class="text-gray-500 text-sm mb-3">Sin CV cargado</p>
                                    @can('edit.trabajadores')
                                        <a href="{{ route('trabajadores.edit', $trabajador->dni) }}"
                                            class="inline-flex items-center gap-1 text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            Cargar CV
                                        </a>
                                    @endcan
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Auditoría -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-gray-200 p-2 rounded-lg text-gray-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Auditoría</h3>
                            </div>

                            <div class="space-y-3 text-sm">
                                <div>
                                    <p class="text-gray-600 font-medium">Creado</p>
                                    <p class="text-gray-900 mt-1">{{ $trabajador->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Última Actualización</p>
                                    <p class="text-gray-900 mt-1">{{ $trabajador->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection