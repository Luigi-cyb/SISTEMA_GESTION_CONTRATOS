@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <div>
                    <h1 class="text-2xl font-semibold text-gray-900">Dashboard Administrativo</h1>
                    <p class="text-sm text-gray-600 mt-1">Vista general del sistema de contratos</p>
                </div>
            </div>
        </div>

        <!-- Tarjetas de Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-6">
            <!-- Total Trabajadores -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Total Trabajadores</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalTrabajadores }}</p>
                        <p class="text-xs text-gray-500 mt-1">Activos en el sistema</p>
                    </div>
                    <div class="bg-blue-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total Contratos -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Contratos Activos</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalContratos }}</p>
                        <p class="text-xs text-gray-500 mt-1">En vigencia</p>
                    </div>
                    <div class="bg-green-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alertas Pendientes -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Alertas Pendientes</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalAlertasPendientes }}</p>
                        <p class="text-xs text-gray-500 mt-1">Requieren atención</p>
                    </div>
                    <div class="bg-yellow-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alertas Críticas -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Alertas Críticas</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalAlertasCriticas }}</p>
                        <p class="text-xs text-gray-500 mt-1">Acción inmediata</p>
                    </div>
                    <div class="bg-red-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- En Lista Negra -->
            <div class="bg-white shadow-sm sm:rounded-lg border border-gray-200 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Lista Negra</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalEnListaNegra }}</p>
                        <p class="text-xs text-gray-500 mt-1">Bloqueados</p>
                    </div>
                    <div class="bg-purple-100 rounded-full p-3">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Contratos por Tipo -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Contratos por Tipo</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($contratosPorTipo as $tipo)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">{{ $tipo->tipo_contrato }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                {{ $tipo->cantidad }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Trabajadores por Unidad -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Trabajadores por Unidad</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        @foreach($trabajadoresPorUnidad as $unidad)
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">{{ $unidad->unidad ?? 'Sin unidad' }}</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                {{ $unidad->cantidad }}
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Resumen Rápido -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Resumen Rápido</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Promedio contratos/trabajador</span>
                            <span class="text-sm font-semibold text-gray-900">{{ $totalContratos > 0 ? number_format($totalContratos / $totalTrabajadores, 2) : 0 }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Alertas por resolver</span>
                            <span class="text-sm font-semibold text-red-600">{{ $totalAlertasPendientes }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-700">Próximos estables</span>
                            <span class="text-sm font-semibold text-yellow-600">{{ count($proximosEstables) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Próximos Vencimientos -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Próximos Vencimientos (30 días)</h2>
            </div>
            @if($proximosVencimientos->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trabajador</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contrato</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Fin</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Días</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($proximosVencimientos->take(10) as $contrato)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $contrato->dni }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contrato->trabajador->nombre_completo }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contrato->numero_contrato }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contrato->fecha_fin->format('d/m/Y') }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $dias = now()->diffInDays($contrato->fecha_fin);
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $dias <= 7 ? 'bg-red-100 text-red-800' : ($dias <= 14 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800') }}">
                                    {{ $dias }} días
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 text-center">
                <p class="text-sm text-gray-500">No hay vencimientos próximos</p>
            </div>
            @endif
        </div>

        <!-- Alertas Críticas -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden mb-6">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Alertas Críticas Pendientes</h2>
            </div>
            @if($alertasCriticas->count() > 0)
            <div class="p-6">
                <div class="space-y-4">
                    @foreach($alertasCriticas->take(10) as $alerta)
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-r-md">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h3 class="text-sm font-medium text-red-900">{{ $alerta->titulo }}</h3>
                                <p class="text-sm text-red-800 mt-1">{{ $alerta->descripcion }}</p>
                                <p class="text-xs text-red-600 mt-2">
                                    {{ $alerta->dni }} - {{ $alerta->trabajador->nombre_completo ?? 'N/A' }}
                                </p>
                            </div>
                            <a href="{{ route('alertas.show', $alerta->id) }}" 
                               class="text-red-600 hover:text-red-900 text-sm font-medium transition-colors duration-150">
                                Ver →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @else
            <div class="p-8 text-center">
                <p class="text-sm text-gray-500">No hay alertas críticas</p>
            </div>
            @endif
        </div>

        <!-- Próximos a ser Estables -->
        <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Próximos a ser Estables (5 años)</h2>
            </div>
            @if(count($proximosEstables) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trabajador</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meses Acumulados</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Meses Restantes</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($proximosEstables as $contrato)
                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $contrato->dni }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contrato->trabajador->nombre_completo }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $contrato->meses_acumulados }} meses</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="text-sm font-semibold text-red-600">{{ $contrato->meses_restantes }} meses</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <svg class="mr-1.5 h-2 w-2 text-red-400" fill="currentColor" viewBox="0 0 8 8">
                                        <circle cx="4" cy="4" r="3"/>
                                    </svg>
                                    Crítico
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="p-8 text-center">
                <p class="text-sm text-gray-500">No hay trabajadores próximos a ser estables</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection