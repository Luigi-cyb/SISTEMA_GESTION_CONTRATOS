<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte CRÍTICO: Próximos a ser Estables') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border-4 border-red-500">
                <div class="p-6 text-gray-900">
                    
                    <!-- Encabezado con botones de exportación -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-red-600">⚠️ REPORTE CRÍTICO: Próximos a ser Estables</h3>
                            <p class="text-gray-600 mt-1">Trabajadores cerca de cumplir 5 años - Total: <span class="font-semibold text-red-600">{{ $trabajadores->count() }}</span></p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('reportes.proximos-estables', ['formato' => 'excel']) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Excel
                            </a>
                            <a href="{{ route('reportes.proximos-estables', ['formato' => 'pdf']) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                PDF
                            </a>
                        </div>
                    </div>

                    <!-- Alerta Crítica Principal -->
                    <div class="bg-red-100 border-l-4 border-red-600 p-6 mb-6">
                        <div class="flex items-start">
                            <svg class="w-8 h-8 text-red-600 mr-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-red-800 text-lg">¡ATENCIÓN GERENCIA Y RRHH!</p>
                                <p class="text-red-700 mt-2">
                                    Los siguientes trabajadores están próximos a cumplir <span class="font-bold">5 AÑOS</span> de tiempo acumulado en la empresa. 
                                    Según política de EMICONSATH, se debe tomar una decisión URGENTE para evitar estabilidad laboral involuntaria.
                                </p>
                                <div class="mt-4 bg-white p-4 rounded-lg border border-red-300">
                                    <p class="text-red-800 font-semibold mb-2">Opciones disponibles:</p>
                                    <ul class="text-red-700 text-sm space-y-1">
                                        <li>✓ <span class="font-semibold">Opción A:</span> Renovar como INDEFINIDO (se vuelve estable)</li>
                                        <li>✓ <span class="font-semibold">Opción B:</span> NO renovar + liquidación + brecha 1-2 meses</li>
                                        <li>✓ <span class="font-semibold">Opción C:</span> Prórroga (extender plazo para decidir)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen por nivel de criticidad -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="bg-red-50 p-4 rounded-lg border-2 border-red-400">
                            <div class="flex items-center mb-2">
                                <div class="bg-red-600 w-4 h-4 rounded-full mr-3"></div>
                                <p class="font-bold text-red-800">CRÍTICA - Menos de 3 meses para 5 años</p>
                            </div>
                            <p class="text-3xl font-bold text-red-600">
                                {{ $trabajadores->where('meses_restantes', '<=', 3)->count() }}
                            </p>
                            <p class="text-sm text-red-700">Requiere decisión inmediata</p>
                        </div>

                        <div class="bg-orange-50 p-4 rounded-lg border-2 border-orange-400">
                            <div class="flex items-center mb-2">
                                <div class="bg-orange-500 w-4 h-4 rounded-full mr-3"></div>
                                <p class="font-bold text-orange-800">ADVERTENCIA - 3 a 6 meses restantes</p>
                            </div>
                            <p class="text-3xl font-bold text-orange-600">
                                {{ $trabajadores->whereBetween('meses_restantes', [3, 6])->count() }}
                            </p>
                            <p class="text-sm text-orange-700">Preparar decisión</p>
                        </div>
                    </div>

                    <!-- Tabla de Trabajadores -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-red-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">DNI</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Nombre Completo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Cargo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Departamento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Unidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Tipo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Fecha Fin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Tiempo Acumulado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Meses Restantes</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-red-800 uppercase tracking-wider">Alerta</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($trabajadores as $trabajador)
                                <tr class="hover:bg-red-50 {{ $trabajador['meses_restantes'] <= 3 ? 'bg-red-100' : 'bg-orange-50' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $trabajador['dni'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">{{ $trabajador['nombre_completo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['cargo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['departamento'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['unidad'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($trabajador['tipo_contrato'] == 'TEMPORAL') bg-blue-100 text-blue-800
                                            @elseif($trabajador['tipo_contrato'] == 'INDEFINIDO') bg-green-100 text-green-800
                                            @else bg-purple-100 text-purple-800
                                            @endif">
                                            {{ $trabajador['tipo_contrato'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $trabajador['fecha_fin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-red-700">
                                        {{ $trabajador['años_meses'] }}
                                        <span class="text-xs text-gray-600">({{ $trabajador['meses_acumulados'] }} meses)</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full 
                                            @if($trabajador['meses_restantes'] <= 2) bg-red-200 text-red-900
                                            @elseif($trabajador['meses_restantes'] <= 3) bg-red-100 text-red-800
                                            @else bg-orange-100 text-orange-800
                                            @endif">
                                            {{ $trabajador['meses_restantes'] }} mes(es)
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full bg-red-600 text-white animate-pulse">
                                            {{ $trabajador['alerta'] }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center py-8">
                                            <svg class="w-16 h-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            <p class="text-lg font-semibold text-gray-700">¡Excelente! No hay trabajadores próximos a ser estables</p>
                                            <p class="text-sm text-gray-500 mt-2">Todos los trabajadores están bajo el umbral crítico de 4 años 9 meses</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Leyenda -->
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg">
                        <p class="font-semibold text-gray-800 mb-3">📌 Leyenda de Criticidad:</p>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 text-sm">
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-red-200 border border-red-400 rounded mr-2"></span>
                                <span class="text-gray-700"><span class="font-semibold">≤ 2 meses:</span> Extremadamente crítico - Acción inmediata</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-red-100 border border-red-300 rounded mr-2"></span>
                                <span class="text-gray-700"><span class="font-semibold">≤ 3 meses:</span> Muy crítico - Preparar decisión</span>
                            </div>
                            <div class="flex items-center">
                                <span class="w-4 h-4 bg-orange-100 border border-orange-300 rounded mr-2"></span>
                                <span class="text-gray-700"><span class="font-semibold">3-6 meses:</span> Advertencia - Planificar estrategia</span>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-6">
                        <a href="{{ route('reportes.index') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver a Reportes
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>