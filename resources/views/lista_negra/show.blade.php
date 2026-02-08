@extends('layouts.app')

@section('content')
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div
                class="bg-white border-l-4 {{ $listaNegra->estado === 'Bloqueado' ? 'border-red-600' : 'border-green-600' }} shadow-lg sm:rounded-lg mb-6 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-3">
                            <span class="{{ $listaNegra->estado === 'Bloqueado' ? 'text-red-600' : 'text-green-600' }}">
                                @if($listaNegra->estado === 'Bloqueado')
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                        </path>
                                    </svg>
                                @else
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                @endif
                            </span>
                            Registro: Lista Negra
                        </h1>
                        <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $listaNegra->trabajador->nombre_completo ?? 'N/A' }}
                            </span>
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                    </path>
                                </svg>
                                {{ $listaNegra->trabajador->dni ?? 'N/A' }}
                            </span>
                            <span
                                class="flex items-center gap-2 {{ $listaNegra->motivo === 'Leve' ? 'bg-amber-50 text-amber-700 border-amber-200' : 'bg-red-50 text-red-700 border-red-200' }} px-3 py-1 rounded-full font-bold border shadow-sm uppercase tracking-wider text-xs">
                                {{ $listaNegra->motivo }}
                            </span>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end gap-3">
                        <span
                            class="px-3 py-1 rounded-full {{ $listaNegra->estado === 'Bloqueado' ? 'bg-red-100 text-red-700 border-red-200' : 'bg-green-100 text-green-700 border-green-200' }} font-bold text-xs border shadow-sm flex items-center gap-2">
                            <span
                                class="w-2 h-2 rounded-full {{ $listaNegra->estado === 'Bloqueado' ? 'bg-red-500' : 'bg-green-500' }} animate-pulse"></span>
                            {{ strtoupper($listaNegra->estado) }}
                        </span>

                        <div class="hidden md:block opacity-20">
                            <svg class="h-12 w-12 {{ $listaNegra->estado === 'Bloqueado' ? 'text-red-600' : 'text-green-600' }}"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                @if($listaNegra->estado === 'Bloqueado')
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                    </path>
                                @else
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                @endif
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botones de Acción -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 flex flex-wrap items-center gap-4">
                    @if($listaNegra->estado === 'Bloqueado' && $listaNegra->motivo === 'Leve' && Auth::user()->hasPermissionTo('desbloquear.lista_negra'))
                        <a href="{{ route('lista-negra.desbloquear-form', $listaNegra->id) }}"
                            class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-500 focus:outline-none focus:border-green-700 focus:ring focus:ring-green-200 active:bg-green-600 disabled:opacity-25 shadow-md gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                </path>
                            </svg>
                            Rehabilitar
                        </a>
                    @endif

                    @can('delete.lista_negra')
                        <form action="{{ route('lista-negra.destroy', $listaNegra->id) }}" method="POST"
                            onsubmit="return confirm('¿Estás seguro de eliminar este registro? Esta acción no se puede deshacer.');"
                            class="inline-block">
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

                    <a href="{{ route('lista-negra.index') }}"
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

                    <!-- Información del Bloqueo -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-red-100 p-2 rounded-lg text-red-600 border border-red-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Causas del Registro</h2>
                            </div>
                            <div class="mb-6">
                                <p class="text-gray-600 text-xs font-black uppercase tracking-widest mb-3">Justificación de
                                    la Medida</p>
                                <div
                                    class="bg-gray-50 border-l-4 border-red-600 p-6 rounded-r-2xl italic text-gray-700 text-sm leading-relaxed shadow-inner">
                                    "{{ $listaNegra->descripcion_motivo }}"
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest">Fecha de
                                        Incidencia</p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-900 font-bold uppercase text-sm">
                                            {{ $listaNegra->fecha_bloqueo->translatedFormat('d M Y') }}</p>
                                    </div>
                                    <p class="text-[10px] text-gray-500 font-bold mt-1 ml-6">
                                        {{ $listaNegra->fecha_bloqueo->translatedFormat('H:i') }} horas</p>
                                </div>
                                <div class="p-4 bg-gray-50 rounded-xl border border-gray-100">
                                    <p class="text-gray-600 text-[10px] font-black uppercase tracking-widest">Registrado por
                                    </p>
                                    <div class="flex items-center gap-2 mt-1">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                        <p class="text-gray-900 font-bold uppercase text-sm">
                                            {{ $listaNegra->bloqueadoPor->name ?? 'N/A' }}</p>
                                    </div>
                                    <p class="text-[10px] text-gray-500 font-bold mt-1 ml-6">
                                        {{ $listaNegra->bloqueadoPor->email ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Archivos y Evidencias -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600 border border-blue-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Sustento Documental</h2>
                            </div>

                            @if($listaNegra->url_informe_escaneado)
                                <div
                                    class="bg-blue-50 border border-blue-200 rounded-2xl p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div class="bg-white p-3 rounded-xl shadow-sm">
                                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p
                                                class="text-xs font-black text-blue-400 uppercase tracking-widest leading-none mb-1">
                                                Informe Identificado</p>
                                            <p class="text-sm font-bold text-blue-900 break-all">
                                                {{ basename($listaNegra->url_informe_escaneado) }}</p>
                                        </div>
                                    </div>
                                    <a href="{{ Storage::url($listaNegra->url_informe_escaneado) }}" target="_blank"
                                        class="w-full md:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 text-white font-black rounded-xl hover:bg-black transition-all shadow-lg text-xs uppercase tracking-widest">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                        Visualizar PDF
                                    </a>
                                </div>
                            @else
                                <div class="bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl p-10 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    <p class="mt-4 text-sm font-bold text-gray-500 italic lowercase tracking-tight">No se ha
                                        adjuntado documentación de sustento para este registro.</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Información de Desbloqueo (Solo si aplica) -->
                    @if($listaNegra->estado === 'Desbloqueado')
                        <div
                            class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-2 border-green-200 animate-fade-in transition-all hover:shadow-md">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-green-100 p-2 rounded-lg text-green-600 border border-green-200">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Historial de Rehabilitación</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                                    <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                                        <p class="text-green-600 text-[10px] font-black uppercase tracking-widest">Fecha de Alta
                                        </p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <p class="text-green-900 font-bold uppercase text-sm">
                                                {{ $listaNegra->fecha_desbloqueo ? $listaNegra->fecha_desbloqueo->translatedFormat('d M Y') : 'N/A' }}
                                            </p>
                                        </div>
                                        <p class="text-[10px] text-green-600 font-bold mt-1 ml-6">
                                            {{ $listaNegra->fecha_desbloqueo ? $listaNegra->fecha_desbloqueo->translatedFormat('H:i') . ' horas' : '' }}
                                        </p>
                                    </div>
                                    <div class="p-4 bg-green-50 rounded-xl border border-green-100">
                                        <p class="text-green-600 text-[10px] font-black uppercase tracking-widest">Autorizado
                                            por</p>
                                        <div class="flex items-center gap-2 mt-1">
                                            <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                                </path>
                                            </svg>
                                            <p class="text-green-900 font-bold uppercase text-sm">
                                                {{ $listaNegra->desbloqueadoPor->name ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>

                                @if($listaNegra->url_carta_compromiso)
                                    <div
                                        class="bg-green-100/50 p-6 rounded-2xl border-2 border-dashed border-green-200 flex items-center justify-between">
                                        <div class="flex items-center gap-3">
                                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                                </path>
                                            </svg>
                                            <p class="text-sm font-black text-green-800 uppercase tracking-tight">Acta de Compromiso
                                                Firmada</p>
                                        </div>
                                        <a href="{{ Storage::url($listaNegra->url_carta_compromiso) }}" target="_blank"
                                            class="px-5 py-2 bg-green-600 text-white text-[10px] font-black rounded-lg hover:bg-black transition-all uppercase tracking-[0.2em] shadow-lg">
                                            Descargar
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Columna Derecha (1/3) -->
                <div class="space-y-6">

                    <!-- Información del Trabajador -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4 border-b pb-2">
                                <div class="bg-purple-100 p-2 rounded-lg text-purple-600 border border-purple-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800">Persona Evaluada</h2>
                            </div>
                            <div class="space-y-4 pt-2">
                                <div>
                                    <p
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1.5">
                                        Nombre Completo</p>
                                    <p class="text-gray-900 font-bold break-words uppercase text-sm leading-tight">
                                        {{ $listaNegra->trabajador->nombre_completo ?? 'N/A' }}</p>
                                </div>
                                <div class="grid grid-cols-2 gap-4 pt-2">
                                    <div>
                                        <p
                                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1.5">
                                            DNI / ID</p>
                                        <p class="text-gray-900 font-bold text-sm tracking-tighter">
                                            {{ $listaNegra->trabajador->dni ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p
                                            class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1.5">
                                            Unidad</p>
                                        <p class="text-gray-900 font-bold text-sm">
                                            {{ $listaNegra->trabajador->unidad ?? 'N/A' }}</p>
                                    </div>
                                </div>
                                <div>
                                    <p
                                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest leading-none mb-1.5">
                                        Cargo Registrado</p>
                                    <p class="text-blue-600 font-bold text-xs uppercase">
                                        {{ $listaNegra->trabajador->cargo ?? 'SIN CARGO ASIGNADO' }}</p>
                                </div>
                                <div class="pt-4 border-t border-gray-100">
                                    <a href="{{ route('trabajadores.show', $listaNegra->trabajador) }}"
                                        class="text-blue-600 hover:text-blue-800 text-[10px] font-black uppercase tracking-[0.2em] flex items-center group">
                                        Ver perfil del sistema
                                        <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tiempo del Bloqueo -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transition-all hover:shadow-md">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-amber-100 p-2 rounded-lg text-amber-600 border border-amber-200">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-lg font-bold text-gray-800">Estado de Exclusión</h2>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="{{ $listaNegra->estado === 'Bloqueado' ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200' }} p-5 rounded-2xl border-2">
                                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Días de
                                        Bloqueo Activo</p>
                                    @php $dias = floor($listaNegra->fecha_bloqueo->diffInDays(now())); @endphp
                                    <p
                                        class="text-2xl font-black {{ $listaNegra->estado === 'Bloqueado' ? 'text-red-700' : 'text-green-700' }} tracking-tighter">
                                        {{ $dias == 0 ? 'Hoy' : $dias . ($dias == 1 ? ' día' : ' días') }}
                                    </p>
                                    <p class="text-[10px] text-gray-400 font-bold mt-1">Calculado automáticamente por el
                                        servidor</p>
                                </div>

                                <div
                                    class="bg-gray-900 p-6 rounded-[2rem] text-white relative overflow-hidden group border border-white/10">
                                    <div
                                        class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-125 transition-transform duration-500">
                                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M2.166 4.9L10 1.55l7.834 3.35a1 1 0 01.666.945V14a2 2 0 01-1.115 1.78l-7 3.5a1 1 0 01-.89 0l-7-3.5A2 2 0 011 14V5.845a1 1 0 01.666-.945z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-[10px] font-black text-red-500 uppercase tracking-[0.3em] mb-3">Protocolo
                                        Aplicado</p>
                                    <p class="text-sm font-bold leading-relaxed relative z-10 transition-colors">
                                        @if($listaNegra->motivo === 'Grave')
                                            Exclusión permanente y bloqueo irreversible en todas las unidades operativas. No
                                            registra fecha de caducidad.
                                        @else
                                            Bloqueo preventivo sujeto a revisión tras 06 meses mínimo o mediante Acta de
                                            Compromiso Gerencial.
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Auditoría de Transacción -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-4 border-b pb-2">
                                <div class="bg-gray-100 p-2 rounded-lg text-gray-500 border border-gray-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xs font-black text-gray-400 uppercase tracking-widest">Trazabilidad</h2>
                            </div>
                            <div class="space-y-4 text-[10px]">
                                <div class="flex justify-between items-center border-b border-gray-50 pb-2">
                                    <span class="text-gray-500 font-bold uppercase tracking-tighter">Primer Registro</span>
                                    <span
                                        class="text-gray-900 font-black">{{ $listaNegra->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-bold uppercase tracking-tighter">Última
                                        Modificación</span>
                                    <span
                                        class="text-gray-900 font-black">{{ $listaNegra->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shadow-inner {
            box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        }
    </style>
@endsection