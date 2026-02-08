@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="bg-white border-l-4 border-rose-600 shadow-lg sm:rounded-lg mb-6 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight flex items-center gap-3">
                            <span class="text-rose-600">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 16v5h6v-5M11 11l4 2m0-5l-4 2m3.333-3c.552 0 1 .448 1 1v1c0 .552-.448 1-1 1s-1-.448-1-1v-1c0-.552.448-1 1-1z">
                                    </path>
                                </svg>
                            </span>
                            Detalle de Cumpleaños
                        </h1>
                        <div class="mt-2 flex flex-wrap items-center gap-3 text-sm text-gray-600">
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                {{ $cumpleaños->trabajador->nombre_completo }}
                            </span>
                            <span
                                class="flex items-center gap-2 bg-gray-100 px-3 py-1 rounded-full font-medium text-gray-700 border border-gray-200 shadow-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0h4m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                    </path>
                                </svg>
                                {{ $cumpleaños->trabajador->dni }}
                            </span>
                        </div>
                    </div>

                    <div class="text-right flex flex-col items-end gap-3">
                        @if($cumpleaños->giftcard_entregada)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200 shadow-sm uppercase">
                                Regalo Entregado
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200 shadow-sm uppercase">
                                Pendiente
                            </span>
                        @endif

                        <!-- Icono Decorativo -->
                        <div class="hidden md:block opacity-20">
                            <svg class="h-12 w-12 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
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

            <!-- ALERTA: CUMPLEAÑOS PRÓXIMO -->
            @if($cumpleaños->dias_restantes == 0)
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm animate-pulse"
                    role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl">🎉</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold uppercase">¡Hoy es su cumpleaños!</h3>
                            <p class="text-xs">Asegúrate de entregarle su regalo especial y felicitarlo.</p>
                        </div>
                    </div>
                </div>
            @elseif($cumpleaños->dias_restantes <= 5)
                <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-700 px-4 py-4 rounded-r-lg mb-6 shadow-sm"
                    role="alert">
                    <div class="flex items-center">
                        <div class="flex-shrink-0">
                            <span class="text-2xl text-rose-500">🔔</span>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-bold uppercase">Cumpleaños Próximo</h3>
                            <p class="text-xs">Faltan solo <strong>{{ $cumpleaños->dias_restantes }}
                                    día{{ $cumpleaños->dias_restantes != 1 ? 's' : '' }}</strong> para el cumpleaños.</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Botones de Acción -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 flex flex-wrap items-center gap-4">
                    @if(!$cumpleaños->giftcard_entregada)
                        @can('registrar.giftcard')
                            <a href="{{ route('cumpleaños.registrar-giftcard-form', $cumpleaños->id) }}"
                                class="transform hover:scale-105 hover:shadow-xl transition-all duration-200 inline-flex items-center justify-center px-6 py-2.5 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-600 shadow-md gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                                    </path>
                                </svg>
                                Registrar Entrega
                            </a>
                        @endcan
                    @else
                        @can('edit.cumpleaños')
                            <form action="{{ route('cumpleaños.cancelar-giftcard', $cumpleaños->id) }}" method="POST"
                                style="display:inline;" onsubmit="return confirm('¿Estás seguro de cancelar esta entrega?');">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                    class="transform hover:scale-105 hover:shadow-lg transition-all duration-200 inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 shadow-md gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Cancelar Entrega
                                </button>
                            </form>
                        @endcan
                    @endif

                    <a href="{{ route('cumpleaños.index') }}"
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

                    <!-- Perfil del Colaborador -->
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                <div class="bg-blue-100 p-2 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Datos del Colaborador</h2>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Nombre Completo</p>
                                    <p class="text-gray-900 font-bold mt-1 text-lg">
                                        {{ $cumpleaños->trabajador->nombre_completo }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">DNI / Documento</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $cumpleaños->trabajador->dni }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Cargo / Función</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $cumpleaños->trabajador->cargo }}</p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Área / Departamento</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        {{ $cumpleaños->trabajador->area_departamento ?? 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Correo Electrónico</p>
                                    <p class="text-gray-900 font-semibold mt-1 truncate">
                                        {{ $cumpleaños->trabajador->email ?? 'N/A' }}
                                    </p>
                                </div>
                                <div>
                                    <p class="text-gray-600 text-sm font-medium">Teléfono</p>
                                    <p class="text-gray-900 font-semibold mt-1">
                                        {{ $cumpleaños->trabajador->telefono ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-6 pt-4 border-t">
                                <a href="{{ route('trabajadores.show', $cumpleaños->trabajador->dni) }}"
                                    class="text-blue-600 hover:text-blue-800 font-semibold flex items-center gap-2">
                                    Ver perfil completo de recursos humanos
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Detalle de la Entrega (Solo si está entregado) -->
                    @if($cumpleaños->giftcard_entregada)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-emerald-100 p-2 rounded-lg text-emerald-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Detalle de la Entrega</h2>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <div class="bg-emerald-50 rounded-xl p-6 border border-emerald-100 text-center">
                                        <p class="text-gray-600 text-xs font-bold uppercase tracking-widest mb-2">Monto del
                                            Regalo</p>
                                        <p class="text-4xl font-black text-emerald-900">S/
                                            {{ number_format($cumpleaños->monto_giftcard, 2) }}
                                        </p>
                                    </div>
                                    <div class="space-y-4">
                                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border">
                                            <span class="text-xs font-bold text-gray-500 uppercase">Fecha Entrega</span>
                                            <span
                                                class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($cumpleaños->fecha_entrega_giftcard)->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg border">
                                            <span class="text-xs font-bold text-gray-500 uppercase">Entregado Por</span>
                                            <span
                                                class="text-sm font-bold text-gray-900">{{ $cumpleaños->entregadoPor->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-12 text-center">
                                <div
                                    class="w-16 h-16 bg-amber-100 text-amber-500 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800">Entrega Pendiente</h3>
                                <p class="text-gray-500 text-sm mt-1">Aún no se ha registrado la entrega del presente para este
                                    colaborador.</p>
                            </div>
                        </div>
                    @endif

                </div>

                <!-- Columna Derecha (1/3) -->
                <div class="space-y-6">

                    <!-- Resumen del Cumpleaños: Diseño Calendario Prolijo -->
                        <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 overflow-hidden">
                            <!-- Cabecera de la Tarjeta -->
                            <div class="bg-rose-600 px-4 py-3 text-center">
                                <h3 class="text-xs font-black text-white uppercase tracking-[0.2em]">Día de Celebración</h3>
                            </div>

                            <div class="p-8 space-y-8">
                                <!-- Bloque de Fecha Central -->
                                <div class="text-center py-6 border-b border-gray-100">
                                    <p class="text-7xl font-black text-gray-900 leading-none">
                                        {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('d') }}
                                    </p>
                                    <p class="text-3xl font-black text-rose-500 uppercase tracking-widest mt-3">
                                        {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('F') }}
                                    </p>
                                </div>

                                <!-- Bloque de Estadísticas en Cuadros Limpios -->
                                <div class="grid grid-cols-2 gap-4">
                                    <!-- Edad Actual -->
                                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 flex flex-col items-center text-center">
                                        <div class="p-3 bg-blue-100/50 text-blue-600 rounded-xl mb-4">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"></path>
                                            </svg>
                                        </div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 leading-tight">Edad Actual</p>
                                        <div class="flex flex-col items-center">
                                            <p class="text-4xl font-black text-gray-900 leading-none">
                                                {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->age }}
                                            </p>
                                            <p class="text-[10px] font-black text-gray-400 uppercase mt-1">Años</p>
                                        </div>
                                    </div>

                                    <!-- Días Faltantes -->
                                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 flex flex-col items-center text-center">
                                        <div class="p-3 bg-emerald-100/50 text-emerald-600 rounded-xl mb-4">
                                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                        </div>
                                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1 leading-tight">Días Faltantes</p>
                                        <div class="flex flex-col items-center">
                                            @if($cumpleaños->dias_restantes == 0)
                                                <p class="text-2xl font-black text-emerald-600 uppercase italic">¡Hoy!</p>
                                            @else
                                                <p class="text-4xl font-black text-gray-900 leading-none">
                                                    {{ $cumpleaños->dias_restantes }}
                                                </p>
                                                <p class="text-[10px] font-black text-gray-400 uppercase mt-1">Días</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Auditoría -->
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6">
                                <div class="flex items-center gap-2 mb-6 border-b pb-2">
                                    <div class="bg-gray-100 p-2 rounded-lg text-gray-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-lg font-bold text-gray-800">Auditoría</h2>
                                </div>
                                <div class="space-y-3 text-sm">
                                    <div>
                                        <p class="text-gray-600 font-medium">Creado en Sistema</p>
                                        <p class="text-gray-900 mt-1 font-semibold">
                                            {{ $cumpleaños->created_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                    <div>
                                        <p class="text-gray-600 font-medium">Última Actualización</p>
                                        <p class="text-gray-900 mt-1 font-semibold">
                                            {{ $cumpleaños->updated_at->format('d/m/Y H:i') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
@endsection