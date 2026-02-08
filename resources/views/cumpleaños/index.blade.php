@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                    <div class="flex items-center">
                        <div style="background: #fdf2f8; color: #db2777; padding: 12px; border-radius: 16px; margin-right: 20px; box-shadow: 0 4px 6px -1px rgba(219, 39, 119, 0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900">Gestión de Cumpleaños</h1>
                            <p class="text-sm font-semibold text-gray-500 mt-1">Seguimiento y entrega de regalos a colaboradores</p>
                        </div>
                    </div>
                        <div class="text-xs text-gray-600 bg-blue-50 px-3 py-2 rounded-md border border-blue-200">
                            Sincronización automática activada
                        </div>
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

            @if ($message = Session::get('warning'))
                <div class="bg-yellow-50 border-l-4 border-yellow-500 p-4 mb-6 rounded-r-md" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium text-yellow-800">{{ $message }}</p>
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

            <!-- Estadísticas rápidas: Diseño Corporativo en 1 Fila -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <!-- Total Registrados -->
                <div
                    class="bg-white rounded-xl border-l-4 border-l-blue-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Total Registrados</p>
                            <p class="text-3xl font-black text-blue-900 mt-2 tracking-tight">{{ $cumpleaños->count() }}</p>
                        </div>
                        <div class="bg-blue-50 p-3 rounded-lg border border-blue-100">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Próximos 5 Días -->
                <div
                    class="bg-white rounded-xl border-l-4 border-l-rose-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Próximos 5 Días</p>
                            <p class="text-3xl font-black text-rose-700 mt-2 tracking-tight">
                                {{ $cumpleaños->where('dias_restantes', '<=', 5)->count() }}
                            </p>
                        </div>
                        <div class="bg-rose-50 p-3 rounded-lg border border-rose-100">
                            <svg class="w-6 h-6 text-rose-600 animate-pulse" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Regalos Entregados -->
                <div
                    class="bg-white rounded-xl border-l-4 border-l-emerald-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Regalos Entregados</p>
                            <p class="text-3xl font-black text-emerald-700 mt-2 tracking-tight">
                                {{ $cumpleaños->where('giftcard_entregada', true)->count() }}
                            </p>
                        </div>
                        <div class="bg-emerald-50 p-3 rounded-lg border border-emerald-100">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Regalos Pendientes -->
                <div
                    class="bg-white rounded-xl border-l-4 border-l-amber-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Regalos Pendientes</p>
                            <p class="text-3xl font-black text-amber-700 mt-2 tracking-tight">
                                {{ $cumpleaños->where('giftcard_entregada', false)->count() }}
                            </p>
                        </div>
                        <div class="bg-amber-50 p-3 rounded-lg border border-amber-100">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Filtros y Búsqueda -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6 mt-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('cumpleaños.index') }}" id="filtrosForm" class="space-y-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <!-- Filtro por días próximos -->
                            <div>
                                <label for="dias" class="block text-sm font-medium text-gray-700 mb-1">
                                    Próximos días
                                </label>
                                <select name="dias" id="dias"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="5" {{ request('dias', 5) == 5 ? 'selected' : '' }}>5 días</option>
                                    <option value="7" {{ request('dias') == 7 ? 'selected' : '' }}>7 días (1 semana)
                                    </option>
                                    <option value="15" {{ request('dias') == 15 ? 'selected' : '' }}>15 días</option>
                                    <option value="30" {{ request('dias') == 30 ? 'selected' : '' }}>30 días (1 mes)
                                    </option>
                                    <option value="60" {{ request('dias') == 60 ? 'selected' : '' }}>60 días</option>
                                    <option value="90" {{ request('dias') == 90 ? 'selected' : '' }}>90 días</option>
                                </select>
                            </div>

                            <!-- Filtro por mes -->
                            <div>
                                <label for="mes" class="block text-sm font-medium text-gray-700 mb-1">
                                    Mes específico
                                </label>
                                <select name="mes" id="mes"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Todos los meses</option>
                                    @for($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}" {{ request('mes') == $i ? 'selected' : '' }}>
                                            {{ \Carbon\Carbon::create()->month($i)->locale('es')->translatedFormat('F') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            <!-- Filtro por estado de giftcard -->
                            <div>
                                <label for="giftcard" class="block text-sm font-medium text-gray-700 mb-1">
                                    Estado Regalo
                                </label>
                                <select name="giftcard" id="giftcard"
                                    class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                    <option value="">Todos</option>
                                    <option value="entregadas" {{ request('giftcard') == 'entregadas' ? 'selected' : '' }}>
                                        Entregadas</option>
                                    <option value="pendientes" {{ request('giftcard') == 'pendientes' ? 'selected' : '' }}>
                                        Pendientes</option>
                                </select>
                            </div>

                            <!-- Botón Limpiar -->
                            <div class="flex items-end">
                                <a href="{{ route('cumpleaños.index') }}"
                                    class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                                    Limpiar
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabla de Cumpleaños -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    DNI
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Trabajador
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Fecha Cumpleaños
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Estado
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Regalo
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($cumpleaños as $cumple)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $cumple->dni }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $cumple->trabajador->nombre_completo }}
                                        </div>
                                        <div class="text-sm text-gray-500">{{ $cumple->trabajador->cargo ?? 'Sin cargo' }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">
                                            {{ \Carbon\Carbon::parse($cumple->fecha_cumpleaños)->locale('es')->translatedFormat('d \d\e F') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($cumple->dias_restantes == 0)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 animate-pulse">
                                                <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                ¡HOY!
                                            </span>
                                        @elseif($cumple->dias_restantes == 1)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Mañana
                                            </span>
                                        @elseif($cumple->dias_restantes <= 5)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                {{ $cumple->dias_restantes }} días
                                            </span>
                                        @elseif($cumple->dias_restantes <= 15)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                {{ $cumple->dias_restantes }} días
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                <svg class="mr-1.5 h-2 w-2 text-gray-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                {{ $cumple->dias_restantes }} días
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($cumple->giftcard_entregada)
                                            <div class="flex flex-col">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <svg class="mr-1.5 h-2 w-2 text-green-400" fill="currentColor"
                                                        viewBox="0 0 8 8">
                                                        <circle cx="4" cy="4" r="3" />
                                                    </svg>
                                                    Entregado
                                                </span>
                                                <div class="text-xs text-gray-500 mt-1">
                                                    {{ \Carbon\Carbon::parse($cumple->fecha_entrega_giftcard)->format('d/m/Y') }}
                                                </div>
                                            </div>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <svg class="mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                                                    <circle cx="4" cy="4" r="3" />
                                                </svg>
                                                Pendiente
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-3">
                                            <!-- Ver -->
                                            <a href="{{ route('cumpleaños.show', $cumple->id) }}"
                                                class="text-blue-600 hover:text-blue-900 transition-colors duration-150"
                                                title="Ver detalles">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>

                                            <!-- Registrar Regalo -->
                                            @can('registrar.giftcard')
                                                @if(!$cumple->giftcard_entregada)
                                                    <a href="{{ route('cumpleaños.registrar-giftcard-form', $cumple->id) }}"
                                                        class="text-green-600 hover:text-green-900 transition-colors duration-150"
                                                        title="Registrar regalo">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                                        </svg>
                                                    </a>
                                                @endif
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
                                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">No se encontraron cumpleaños</h3>
                                        <p class="mt-1 text-sm text-gray-500">Intenta cambiar los filtros para ver más
                                            resultados.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para filtros automáticos -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const diasSelect = document.getElementById('dias');
            const mesSelect = document.getElementById('mes');
            const giftcardSelect = document.getElementById('giftcard');
            const form = document.getElementById('filtrosForm');

            // Cambio automático al seleccionar filtros
            if (diasSelect) {
                diasSelect.addEventListener('change', function () {
                    form.submit();
                });
            }

            if (mesSelect) {
                mesSelect.addEventListener('change', function () {
                    form.submit();
                });
            }

            if (giftcardSelect) {
                giftcardSelect.addEventListener('change', function () {
                    form.submit();
                });
            }
        });
    </script>
@endsection