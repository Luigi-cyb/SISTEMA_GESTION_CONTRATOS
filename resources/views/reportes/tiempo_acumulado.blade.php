<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte: Tiempo Acumulado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Encabezado con botones de exportación -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">📊 Tiempo Acumulado por Trabajador</h3>
                            <p class="text-gray-600 mt-1">Total de trabajadores: <span class="font-semibold">{{ $trabajadores->count() }}</span></p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('reportes.tiempo-acumulado', ['formato' => 'excel']) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Excel
                            </a>
                            <a href="{{ route('reportes.tiempo-acumulado', ['formato' => 'pdf']) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                PDF
                            </a>
                        </div>
                    </div>

                    <!-- Resumen de Indicadores -->
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <div class="flex items-center">
                                <div class="bg-green-500 w-3 h-3 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-600">Verde (1-3 años)</p>
                                    <p class="text-2xl font-bold text-green-600">{{ $trabajadores->where('indicador_estabilidad', 'VERDE')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-yellow-50 p-4 rounded-lg border border-yellow-200">
                            <div class="flex items-center">
                                <div class="bg-yellow-500 w-3 h-3 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-600">Amarillo (4 años)</p>
                                    <p class="text-2xl font-bold text-yellow-600">{{ $trabajadores->where('indicador_estabilidad', 'AMARILLO')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="bg-red-50 p-4 rounded-lg border border-red-200">
                            <div class="flex items-center">
                                <div class="bg-red-500 w-3 h-3 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-600">Rojo (4.5-5 años)</p>
                                    <p class="text-2xl font-bold text-red-600">{{ $trabajadores->where('indicador_estabilidad', 'ROJO')->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <div class="flex items-center">
                                <div class="bg-gray-500 w-3 h-3 rounded-full mr-3"></div>
                                <div>
                                    <p class="text-sm text-gray-600">Inactivos</p>
                                    <p class="text-2xl font-bold text-gray-600">{{ $trabajadores->where('estado', 'INACTIVO')->count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Indicadores -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-6">
                        <div class="flex">
                            <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-blue-800">Indicadores de Estabilidad Laboral</p>
                                <p class="text-blue-700 text-sm mt-1">
                                    <span class="font-semibold">Verde:</span> 1-3 años | 
                                    <span class="font-semibold">Amarillo:</span> 4 años | 
                                    <span class="font-semibold">Rojo:</span> 4.5-5 años (CRÍTICO)
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Tabla de Trabajadores -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departamento</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Contratos</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Adendas</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiempo Acumulado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Indicador</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($trabajadores as $trabajador)
                                <tr class="hover:bg-gray-50 {{ $trabajador['indicador_estabilidad'] == 'ROJO' ? 'bg-red-50' : '' }}">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trabajador['dni'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trabajador['nombre_completo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['cargo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['departamento'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['unidad'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                                            {{ $trabajador['total_contratos'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-900">
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                                            {{ $trabajador['total_adendas'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                        {{ $trabajador['años_meses'] }}
                                        <span class="text-xs text-gray-500">({{ $trabajador['meses_acumulados'] }} meses)</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-3 py-1 text-xs font-bold rounded-full 
                                            @if($trabajador['indicador_estabilidad'] == 'VERDE') bg-green-100 text-green-800
                                            @elseif($trabajador['indicador_estabilidad'] == 'AMARILLO') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $trabajador['indicador_estabilidad'] }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            @if($trabajador['estado'] == 'ACTIVO') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ $trabajador['estado'] }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500">No hay trabajadores registrados</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
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