@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">📊 Dashboard Gerencia</h1>
        <p class="text-gray-600 mt-2">Reportes y alertas críticas</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <!-- Total Trabajadores -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">Total Trabajadores</p>
            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalTrabajadores }}</p>
            <p class="text-xs text-gray-500 mt-1">Activos</p>
        </div>

        <!-- Total Contratos -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">Contratos Activos</p>
            <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalContratos }}</p>
            <p class="text-xs text-gray-500 mt-1">En vigencia</p>
        </div>

        <!-- Practicantes -->
        <div class="bg-purple-50 border-l-4 border-purple-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">Practicantes</p>
            <p class="text-4xl font-bold text-purple-600 mt-2">{{ $totalPracticantes }}</p>
            <p class="text-xs text-gray-500 mt-1">En formación</p>
        </div>

        <!-- Indefinidos -->
        <div class="bg-cyan-50 border-l-4 border-cyan-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">Indefinidos</p>
            <p class="text-4xl font-bold text-cyan-600 mt-2">{{ $totalIndefinidos }}</p>
            <p class="text-xs text-gray-500 mt-1">Estables</p>
        </div>

        <!-- Alertas Críticas -->
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">🔴 Críticas</p>
            <p class="text-4xl font-bold text-red-600 mt-2">{{ $totalAlertasCriticas }}</p>
            <p class="text-xs text-gray-500 mt-1">Acción inmediata</p>
        </div>
    </div>

    <!-- Grid Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Contratos por Tipo -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">📋 Contratos por Tipo</h2>
            <div class="space-y-4">
                @foreach($contratosPorTipo as $tipo)
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-700 font-semibold">{{ $tipo->tipo_contrato }}</span>
                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-bold text-sm">{{ $tipo->cantidad }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-blue-600 h-2 rounded-full" style="width: {{ ($tipo->cantidad / $totalContratos * 100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Trabajadores por Departamento -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">🏢 Trabajadores por Departamento</h2>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @foreach($trabajadoresPorDepartamento as $dept)
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded">
                    <span class="text-gray-700">{{ $dept->departamento ?? 'Sin departamento' }}</span>
                    <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full font-bold text-sm">{{ $dept->cantidad }}</span>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Resumen Ejecutivo -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">📈 Resumen Ejecutivo</h2>
            <div class="space-y-4">
                <div>
                    <p class="text-gray-600 text-sm">Ratio Contratos/Trabajadores</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $totalTrabajadores > 0 ? number_format($totalContratos / $totalTrabajadores, 2) : 0 }}</p>
                </div>
                <div>
                    <p class="text-gray-600 text-sm">Indefinidos</p>
<p class="text-3xl font-bold text-green-600">{{ $totalContratos > 0 ? number_format(($totalIndefinidos / $totalContratos * 100), 1) : 0 }}%</p>                </div>
                <div>
                    <p class="text-gray-600 text-sm">🔴 Alertas Críticas</p>
                    <p class="text-3xl font-bold text-red-600">{{ $totalAlertasCriticas }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Alertas Críticas Pendientes -->
    <div class="bg-white rounded-lg shadow p-6 mb-8">
        <h2 class="text-xl font-bold text-gray-800 mb-4">🔴 Alertas Críticas Pendientes</h2>
        @if($alertasCriticas->count() > 0)
        <div class="space-y-4">
            @foreach($alertasCriticas->take(15) as $alerta)
            <div class="border-l-4 border-red-500 bg-red-50 p-4 rounded">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-bold text-red-900">{{ $alerta->titulo }}</p>
                        <p class="text-sm text-red-800 mt-1">{{ $alerta->descripcion }}</p>
                        <div class="flex gap-4 mt-2 text-xs text-red-700">
                            <span>📌 {{ $alerta->dni }}</span>
                            <span>👤 {{ $alerta->trabajador->nombre_completo ?? 'N/A' }}</span>
                            <span>📅 {{ $alerta->fecha_alerta->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('alertas.show', $alerta->id) }}" class="text-red-600 hover:text-red-900 font-bold text-sm whitespace-nowrap ml-2">
                        Revisar →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-center py-4">No hay alertas críticas pendientes</p>
        @endif
    </div>

    <!-- Próximos a ser Estables (CRÍTICO) -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">⚠️ Próximos a ser Estables (5 años) - ACCIÓN REQUERIDA</h2>
        @if(count($proximosEstables) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-red-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">DNI</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Trabajador</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Cargo</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Meses Acumulados</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Meses Restantes</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Estado</th>
                        <th class="px-4 py-2 text-left text-sm font-bold text-red-900">Acción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($proximosEstables as $contrato)
                    <tr class="hover:bg-red-50">
                        <td class="px-4 py-2 text-sm font-bold">{{ $contrato->dni }}</td>
                        <td class="px-4 py-2 text-sm">{{ $contrato->trabajador->nombre_completo }}</td>
                        <td class="px-4 py-2 text-sm">{{ $contrato->trabajador->cargo ?? 'N/A' }}</td>
                        <td class="px-4 py-2 text-sm font-bold">{{ $contrato->meses_acumulados }} meses</td>
                        <td class="px-4 py-2 text-sm">
                            <span class="font-bold text-red-600 text-lg">{{ $contrato->meses_restantes }} 🔴</span>
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-bold">
                                CRÍTICO
                            </span>
                        </td>
                        <td class="px-4 py-2 text-sm">
                            <a href="{{ route('contratos.show', $contrato->id) }}" class="text-red-600 hover:text-red-900 font-bold">
                                Decidir →
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <p class="text-gray-500 text-center py-4">No hay trabajadores próximos a ser estables</p>
        @endif
    </div>
</div>
@endsection