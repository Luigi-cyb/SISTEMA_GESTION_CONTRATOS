@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="bg-white border-l-4 border-blue-600 shadow-lg sm:rounded-lg mb-6 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-3">
                            <span class="text-blue-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </span>
                            {{ $contrato->numero_contrato }}
                        </h1>
                        <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $contrato->trabajador->nombre_completo }}
                            </span>
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                    </path>
                                </svg>
                                {{ $contrato->trabajador->dni }}
                            </span>
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $contrato->tipo_contrato }}
                            </span>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end gap-3">
                        {!! $contrato->estado_badge !!}

                        <!-- Icono Decorativo -->
                        <div class="hidden md:block opacity-20">
                            <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mensajes de Estado -->
            @if ($message = Session::get('success'))
                <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm"
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

            <!-- ALERTA: CONTRATO SIN FIRMAR -->
            @if ($contrato->estado === 'Borrador' && !$contrato->tieneContratoFirmado())
                <div class="bg-amber-50 border-l-4 border-amber-500 text-amber-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm"
                    role="alert">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium">Contrato pendiente de firma</h3>
                            <div class="mt-2 text-sm">
                                <p>Descarga el PDF, imprímelo, fírmalo y luego súbelo escaneado para activar el contrato.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Botones de Acción -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 flex flex-wrap items-center gap-4">
                    @can('edit.contratos')
                        <a href="{{ route('contratos.edit', $contrato->id) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-amber-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-amber-500 focus:outline-none focus:border-amber-700 focus:ring focus:ring-amber-200 active:bg-amber-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                            Editar
                        </a>
                    @endcan

                    @can('view.contratos')
                        <a href="{{ route('contratos.pdf', $contrato->id) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-500 focus:outline-none focus:border-purple-700 focus:ring focus:ring-purple-200 active:bg-purple-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Descargar PDF
                        </a>
                    @endcan

                    @can('edit.contratos')
                        @if ($contrato->tieneContratoFirmado())
                            <a href="{{ route('contratos.descargar-firmado', $contrato->id) }}"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Contrato Firmado
                            </a>
                        @endif
                    @endcan

                    <!-- Lógica de Renovación -->
                    @can('create.adendas')
                        @php
                            $numeroAdendas = \App\Models\Adenda::where('contrato_id', $contrato->id)->count();
                            $puedeRenovar = $meses_acumulados < 59;
                        @endphp

                        @if ($contrato->estado === 'Activo' && $puedeRenovar)
                            <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 disabled:opacity-25 shadow-md gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Renovar
                            </a>
                        @elseif ($contrato->estado === 'Vencido' && $puedeRenovar)
                            <div class="inline-flex items-center gap-2">
                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded text-xs font-semibold">
                                    {{ $numeroAdendas }} Adendas
                                </span>
                                <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                    class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 shadow-md gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                        </path>
                                    </svg>
                                    Renovar otra vez
                                </a>
                            </div>
                        @elseif (!$puedeRenovar)
                            <button disabled
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest opacity-75 cursor-not-allowed gap-2">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 9a3 3 0 100 6 3 3 0 000-6zm0-2a5 5 0 110 10 5 5 0 010-10zm0 10a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                                Renovación Bloqueada
                            </button>
                        @endif
                    @endcan

                    @can('delete.contratos')
                        <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" style="display:inline;"
                            onsubmit="return confirm('¿Estás seguro de eliminar este contrato?');">
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

                    <a href="{{ route('contratos.index') }}"
                        class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-md hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:ring focus:ring-blue-200 active:text-gray-800 active:bg-gray-50 disabled:opacity-25 ml-auto gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>

            <!-- Grid Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Columna Izquierda (2/3) -->
                <div class="lg:col-span-2 space-y-6">

                    <!-- Datos del Contrato -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Datos del Contrato</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Número de Contrato</p>
                                    <p class="text-gray-900 font-bold mt-1 text-lg">{{ $contrato->numero_contrato }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Tipo de Contrato</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $contrato->tipo_contrato }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Periodo</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        {{ $contrato->fecha_inicio->format('d/m/Y') }} -
                                        {{ $contrato->fecha_fin->format('d/m/Y') }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Horario</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $contrato->horario }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Fecha de Firma</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        @if ($contrato->fecha_firma_manual)
                                            {{ $contrato->fecha_firma_manual->format('d/m/Y') }}
                                        @else
                                            {{ $contrato->fecha_inicio->copy()->subDay()->format('d/m/Y') }}
                                            <span class="text-xs text-gray-400">(Auto)</span>
                                        @endif
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Remuneración</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Modalidad</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $contrato->tipo_salario }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Monto</p>
                                    @if ($contrato->salario_mensual)
                                        <p class="text-green-700 font-bold mt-1 text-xl">S/.
                                            {{ number_format($contrato->salario_mensual, 2) }}
                                        </p>
                                    @elseif ($contrato->salario_jornal)
                                        <p class="text-green-700 font-bold mt-1 text-xl">S/.
                                            {{ number_format($contrato->salario_jornal, 2) }} <span
                                                class="text-sm font-normal text-gray-500">/ día</span>
                                        </p>
                                    @else
                                        <p class="text-gray-500 italic mt-1">No especificado</p>
                                    @endif
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Beneficios Ley 728</p>
                                    <div class="mt-1">
                                        @if ($contrato->beneficios_ley_728)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Sí, Incluidos
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                No aplica
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Renovaciones (Adendas) -->
                    @if ($contrato->adendas->count() > 0)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-indigo-100 p-2 rounded-lg text-indigo-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Renovaciones (Adendas)</h2>
                                </div>
                                <div class="space-y-3">
                                    @foreach ($contrato->adendas as $index => $adenda)
                                        <div class="border-l-4 border-indigo-500 bg-indigo-50 pl-4 pr-4 py-3 rounded-r-lg">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    <p class="font-semibold text-gray-900 text-sm">Adenda
                                                        #{{ $adenda->numero_adenda }}</p>
                                                    <p class="text-gray-600 text-xs mt-1">
                                                        <span class="font-medium">Periodo:</span>
                                                        {{ $adenda->fecha_inicio->format('d/m/Y') }} -
                                                        {{ $adenda->fecha_fin->format('d/m/Y') }}
                                                    </p>
                                                    <p class="text-gray-600 text-xs">
                                                        <span class="font-medium">Acumulado:</span>
                                                        {{ $adenda->tiempo_acumulado_total_meses }} meses
                                                    </p>
                                                </div>
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    Adenda {{ $index + 1 }}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Subir Contrato Firmado -->
                    @can('edit.contratos')
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-gray-100 p-2 rounded-lg text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Contrato Firmado</h2>
                                </div>

                                @if ($contrato->tieneContratoFirmado())
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <div>
                                                <p class="text-sm font-semibold text-green-800">Documento cargado exitosamente</p>
                                                @if ($contrato->fecha_firma)
                                                    <p class="text-xs text-green-600 mt-1">Registrado el:
                                                        {{ $contrato->fecha_firma->format('d/m/Y H:i') }}
                                                    </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('contratos.subir-firmado', $contrato->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-3">
                                            Archivo PDF del contrato firmado
                                        </label>
                                        <div class="mt-1 flex justify-center px-6 pt-8 pb-8 border-2 border-gray-300 border-dashed rounded-xl hover:border-blue-500 hover:bg-blue-50 transition-all cursor-pointer group"
                                            id="drop-zone">
                                            <div class="space-y-2 text-center">
                                                <div class="flex justify-center">
                                                    <div
                                                        class="p-3 bg-gray-100 rounded-full group-hover:bg-blue-100 transition-colors">
                                                        <svg class="h-10 w-10 text-gray-400 group-hover:text-blue-600 transition-colors"
                                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="flex text-sm text-gray-600 justify-center pt-2">
                                                    <label
                                                        class="relative cursor-pointer rounded-md font-bold text-blue-600 hover:text-blue-700 focus-within:outline-none">
                                                        <span class="text-base">Seleccionar archivo</span> <span
                                                            class="font-medium text-gray-500">o arrastrar aquí</span>
                                                        <input type="file" name="contrato_firmado" id="contrato_firmado"
                                                            accept=".pdf" required class="sr-only">
                                                    </label>
                                                </div>
                                                <p class="text-xs text-gray-500">PDF, hasta 10MB</p>

                                                <!-- Visualizador de nombre de archivo -->
                                                <div id="file-name-display"
                                                    class="mt-4 px-4 py-2 bg-white border border-blue-200 rounded-lg text-sm text-blue-700 font-bold hidden shadow-sm flex items-center justify-center gap-2 animate-bounce">
                                                    <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414 1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                    <span id="file-name-text" class="truncate max-w-[200px]"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @error('contrato_firmado')
                                            <p class="text-red-500 text-xs mt-2 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="text-right">
                                        <button type="submit"
                                            class="inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm text-sm">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{ $contrato->tieneContratoFirmado() ? 'Actualizar Archivo' : 'Subir Archivo' }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endcan

                </div>

                <!-- Columna Derecha (1/3) -->
                <div class="space-y-6">

                    <!-- Información del Trabajador (Resumen) -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4 border-b pb-2">
                                <div class="bg-purple-100 p-2 rounded-lg text-purple-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800">Trabajador</h2>
                            </div>
                            <div class="space-y-3">
                                <div>
                                    <p class="text-gray-600 text-xs font-medium">Nombre</p>
                                    <p class="text-gray-900 font-semibold">{{ $contrato->trabajador->nombre_completo }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium">Cargo</p>
                                    <p class="text-gray-900 font-semibold">{{ $contrato->trabajador->cargo }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-xs font-medium">Unidad</p>
                                    <p class="text-gray-900 font-semibold">{{ $contrato->trabajador->unidad }}</p>
                                </div>
                                <div class="pt-2">
                                    <a href="{{ route('trabajadores.show', $contrato->trabajador->dni) }}"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-semibold flex items-center">
                                        Ver perfil completo
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tiempo Acumulado del Contrato -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800">Tiempo Acumulado</h2>
                            </div>

                            <div class="space-y-4">
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-gray-600 text-sm font-medium">Total</p>
                                    <p class="text-xl font-bold text-blue-600">{{ $texto_tiempo_completo }}</p>
                                    <p class="text-xs text-gray-500 mt-1">Acumulado desde inicio</p>
                                </div>

                                <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                    <p class="text-gray-600 text-sm font-medium">Restante</p>
                                    <p class="text-xl font-bold text-purple-600">{{ $texto_meses_dias }}</p>
                                    <p class="text-xs text-gray-500 mt-1">después de {{ $años_completos }} año(s)</p>
                                </div>

                                <!-- Alertas de Estabilidad -->
                                @if ($meses_acumulados >= 56)
                                    <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                                        <p class="font-bold text-sm">⚠️ CRÍTICO: {{ number_format($meses_acumulados / 12, 1) }}
                                            años</p>
                                        <p class="text-xs mt-1">Próximo a 5 años (59 meses). Decisión urgente requerida.</p>
                                    </div>
                                @elseif ($meses_acumulados >= 48)
                                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-3 rounded">
                                        <p class="font-bold text-sm">⚠️ PRECAUCIÓN:
                                            {{ number_format($meses_acumulados / 12, 1) }}
                                            años</p>
                                        <p class="text-xs mt-1">Prepararse para tomar decisión.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Vencimiento -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-orange-100 p-2 rounded-lg text-orange-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800">Vencimiento</h2>
                            </div>
                            <div class="bg-orange-50 p-4 rounded-lg border border-orange-200 text-center">
                                <p class="text-gray-600 text-sm font-medium mb-1">Días Restantes</p>
                                <p class="text-3xl font-bold text-orange-600">{{ $texto_dias_restantes }}</p>
                                <p class="text-xs text-orange-800 mt-2 font-medium">Vence:
                                    {{ $contrato->fecha_fin->format('d/m/Y') }}
                                </p>
                            </div>
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
                                <h2 class="text-lg font-bold text-gray-800">Auditoría</h2>
                            </div>
                            <div class="space-y-3 text-sm">
                                <div>
                                    <p class="text-gray-600 font-medium">Creado</p>
                                    <p class="text-gray-900 mt-1">{{ $contrato->created_at->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 font-medium">Última Actualización</p>
                                    <p class="text-gray-900 mt-1">{{ $contrato->updated_at->format('d/m/Y H:i') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fileInput = document.getElementById('contrato_firmado');
            const dropZone = document.getElementById('drop-zone');
            const fileNameDisplay = document.getElementById('file-name-display');
            const fileNameText = document.getElementById('file-name-text');

            // Abrir selector al hacer clic en zona de drop
            dropZone.addEventListener('click', () => fileInput.click());

            // Mostrar nombre de archivo al seleccionar
            fileInput.addEventListener('change', function () {
                if (this.files.length) {
                    fileNameText.textContent = this.files[0].name;
                    fileNameDisplay.classList.remove('hidden');
                    fileNameDisplay.classList.add('flex');

                    // Efecto visual de éxito en el dropzone
                    dropZone.classList.remove('border-gray-300');
                    dropZone.classList.add('border-blue-500', 'bg-blue-50');
                } else {
                    fileNameDisplay.classList.add('hidden');
                    fileNameDisplay.classList.remove('flex');
                    dropZone.classList.add('border-gray-300');
                    dropZone.classList.remove('border-blue-500', 'bg-blue-50');
                }
            });

            // Arrastrar y soltar
            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    dropZone.classList.add('border-blue-500', 'bg-blue-50');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    if (eventName === 'dragleave' && !fileInput.files.length) {
                        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
                    }

                    if (eventName === 'drop') {
                        const dt = e.dataTransfer;
                        const files = dt.files;
                        fileInput.files = files;

                        // Disparar evento change manualmente
                        const event = new Event('change');
                        fileInput.dispatchEvent(event);
                    }
                }, false);
            });
        });
    </script>
@endsection