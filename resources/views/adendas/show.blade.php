@extends('layouts.app')

@section('content')
    <div class="py-12 ">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                <!-- Header -->
                <div class="bg-white border-l-4 border-blue-600 shadow-lg sm:rounded-lg mb-6 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                    <div class="p-6 flex justify-between items-start">
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-3">
                                <span class="text-blue-600">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </span>
                                {{ $adenda->numero_adenda_contrato }}
                            </h1>
                            <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                                <span class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $adenda->trabajador->nombre_completo }}
                                </span>
                                <span class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                    <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"></path>
                                    </svg>
                                    {{ $adenda->trabajador->dni }}
                                </span>
                                <span class="flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full font-bold text-blue-700 border border-blue-200 shadow-sm uppercase tracking-wider text-xs">
                                    Adenda #{{ $adenda->numero_adenda }}
                                </span>
                            </div>
                        </div>

                        <div class="text-right flex flex-col items-end gap-3">
                            @php
                                $statusColors = [
                                    'Activo' => 'bg-green-100 text-green-700 border-green-200',
                                    'Vencida' => 'bg-red-100 text-red-700 border-red-200',
                                    'Borrador' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                    'Firmado' => 'bg-blue-100 text-blue-700 border-blue-200',
                                ];
                                $colorClass = $statusColors[$adenda->estado] ?? 'bg-gray-100 text-gray-700 border-gray-200';
                            @endphp
                            <span class="px-3 py-1 rounded-full {{ $colorClass }} font-bold text-xs border shadow-sm flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ str_replace(['bg-100', 'text-700'], ['bg-500', 'text-500'], $colorClass) }} animate-pulse"></span>
                                {{ strtoupper($adenda->estado) }}
                            </span>

                            <div class="hidden md:block opacity-20">
                                <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Mensajes de Estado -->
                @if ($message = Session::get('success'))
                    <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm" role="alert">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="font-medium">{{ $message }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Botones de Acción -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 flex flex-wrap items-center gap-4">
                        @can('edit.adendas')
                            <a href="{{ route('adendas.edit', $adenda->id) }}"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 focus:outline-none focus:border-amber-700 focus:ring focus:ring-amber-200 active:bg-amber-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                Editar
                            </a>
                        @endcan

                        @can('view.adendas')
                            <a href="{{ route('adendas.pdf', $adenda->id) }}"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 focus:outline-none focus:border-purple-700 focus:ring focus:ring-purple-200 active:bg-purple-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Descargar PDF
                            </a>
                        @endcan

                        <a href="{{ route('contratos.show', $adenda->contrato->id) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                            </svg>
                            Ver Contrato
                        </a>

                        <a href="{{ route('adendas.index') }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 ml-auto gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver
                        </a>
                    </div>
                </div>

                <!-- Grid Principal -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- Columna Izquierda (2/3) -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Datos de la Adenda -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Datos de la Adenda</h2>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Número de Adenda</p>
                                        <p class="text-gray-900 font-bold mt-1 text-lg">#{{ $adenda->numero_adenda }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Contrato Relacionado</p>
                                        <p class="text-gray-900 font-semibold mt-1">{{ $adenda->contrato->numero_contrato }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Vigencia Adenda</p>
                                        <p class="text-gray-900 font-semibold mt-1">
                                            {{ $adenda->fecha_inicio->format('d/m/Y') }} - {{ $adenda->fecha_fin->format('d/m/Y') }}
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Horario</p>
                                        <p class="text-gray-900 font-semibold mt-1">{{ $adenda->horario ?? 'No definido' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Fecha de Firma</p>
                                        <p class="text-gray-900 font-semibold mt-1">
                                            {{ $adenda->fecha_firma ? \Carbon\Carbon::parse($adenda->fecha_firma)->format('d/m/Y') : '—' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Remuneración -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-green-100 p-2 rounded-lg text-green-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Remuneración</h2>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Modalidad</p>
                                        <p class="text-gray-900 font-semibold mt-1">{{ $adenda->tipo_salario }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-sm font-medium">Monto</p>
                                        @if ($adenda->salario_mensual)
                                            <p class="text-green-700 font-bold mt-1 text-xl">S/. {{ number_format($adenda->salario_mensual, 2) }}</p>
                                        @elseif ($adenda->salario_jornal)
                                            <p class="text-green-700 font-bold mt-1 text-xl">S/. {{ number_format($adenda->salario_jornal, 2) }} <span class="text-sm font-normal text-gray-500">/ día</span></p>
                                        @else
                                            <p class="text-gray-500 italic mt-1">No especificado</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Gestión de Archivo -->
                        @can('edit.adendas')
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6">
                                    <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                        <div class="bg-gray-100 p-2 rounded-lg text-gray-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                        </div>
                                        <h2 class="text-xl font-bold text-gray-800">Documento Firmado</h2>
                                    </div>

                                    @if($adenda->url_documento_escaneado)
                                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                            <div class="flex items-center justify-between">
                                                <div class="flex items-center">
                                                    <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                    </svg>
                                                    <p class="text-sm font-semibold text-green-800">Adenda firmada cargada</p>
                                                </div>
                                                <a href="{{ route('adendas.descargar-firmada', $adenda->id) }}" class="text-blue-600 hover:text-blue-800 text-sm font-bold flex items-center gap-1">
                                                    Descargar
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endif

                                    <form action="{{ route('adendas.subir-firmada', $adenda->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="mb-4">
                                            <label class="block text-sm font-medium text-gray-700 mb-2">Archivo PDF de la adenda firmada</label>
                                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors bg-gray-50">
                                                <div class="space-y-1 text-center">
                                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                    </svg>
                                                    <div class="flex text-sm text-gray-600 justify-center">
                                                        <label class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                            <span>Seleccionar archivo</span>
                                                            <input type="file" name="adenda_firmada" accept=".pdf" required class="sr-only">
                                                        </label>
                                                        <p class="pl-1">o arrastrar aquí</p>
                                                    </div>
                                                    <p class="text-xs text-gray-500">PDF, hasta 10MB</p>
                                                </div>
                                            </div>
                                            @error('adenda_firmada')
                                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div class="text-right">
                                            <button type="submit" class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm text-sm">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                                Cargar Archivo
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endcan

                    </div>

                    <!-- Columna Derecha (1/3) -->
                    <div class="space-y-6">

                        <!-- Información del Trabajador -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-4 border-b pb-2">
                                    <div class="bg-purple-100 p-2 rounded-lg text-purple-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-800">Trabajador</h2>
                                </div>
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium">Nombre</p>
                                        <p class="text-gray-900 font-semibold">{{ $adenda->trabajador->nombre_completo }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium">Cargo</p>
                                        <p class="text-gray-900 font-semibold">{{ $adenda->trabajador->cargo }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 text-xs font-medium">Unidad</p>
                                        <p class="text-gray-900 font-semibold">{{ $adenda->trabajador->unidad }}</p>
                                    </div>
                                    <div class="pt-2">
                                        <a href="{{ route('trabajadores.show', $adenda->trabajador) }}"
                                            class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
                                            Ver perfil completo
                                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tiempo Acumulado -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-800">Antigüedad Total</h2>
                                </div>

                                <div class="space-y-4">
                                    <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                        <p class="text-gray-600 text-sm font-medium">Acumulado</p>
                                        <p class="text-xl font-bold text-blue-600">{{ $adenda->tiempo_acumulado_total_meses }} meses</p>
                                        <p class="text-xs text-gray-500 mt-1">Acumulado desde inicio del contrato</p>
                                    </div>

                                    <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                        <p class="text-gray-600 text-sm font-medium">Años Equivalentes</p>
                                        <p class="text-xl font-bold text-purple-600">{{ number_format($adenda->tiempo_acumulado_total_meses / 12, 2) }} años</p>
                                    </div>

                                    <!-- ALERTA CRÍTICA: Estabilidad Laboral -->
                                    @if ($adenda->tiempo_acumulado_total_meses >= 57)
                                        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded-r shadow-sm">
                                            <p class="font-bold text-red-900 text-sm mb-2">⚠ ALERTA: Límite de 5 años</p>
                                            <div class="space-y-2">
                                                <form action="{{ route('adendas.decision-estabilidad', $adenda->id) }}" method="POST" class="flex flex-col gap-2">
                                                    @csrf
                                                    <button type="submit" name="decision" value="indefinido" class="text-xs px-3 py-1.5 bg-green-600 text-white font-bold rounded hover:bg-green-700 transition">INDEFINIDO</button>
                                                    <button type="submit" name="decision" value="cese" class="text-xs px-3 py-1.5 bg-red-600 text-white font-bold rounded hover:bg-red-700 transition" onclick="return confirm('¿Confirmar cese?');">CESE</button>
                                                    <button type="submit" name="decision" value="prorroga" class="text-xs px-3 py-1.5 bg-blue-600 text-white font-bold rounded hover:bg-blue-700 transition">PRÓRROGA</button>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Auditoría -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-gray-200 p-2 rounded-lg text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-800">Auditoría</h2>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div>
                                        <p class="text-gray-600 font-medium">Creado</p>
                                        <p class="text-gray-900 mt-1">{{ $adenda->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 font-medium">Última Actualización</p>
                                        <p class="text-gray-900 mt-1">{{ $adenda->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection