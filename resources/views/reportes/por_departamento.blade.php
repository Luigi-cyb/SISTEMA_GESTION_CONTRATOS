<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte: Por Departamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Encabezado con botones de exportación -->
                    <div class="flex justify-between items-center mb-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-800">🏢 Trabajadores por Departamento</h3>
                            <p class="text-gray-600 mt-1">Total de trabajadores: <span class="font-semibold">{{ $trabajadores->count() }}</span></p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('reportes.por-departamento', ['formato' => 'excel', 'departamento' => $departamento]) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Excel
                            </a>
                            <a href="{{ route('reportes.por-departamento', ['formato' => 'pdf', 'departamento' => $departamento]) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg inline-flex items-center transition-colors">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                PDF
                            </a>
                        </div>
                    </div>

                    <!-- Estadísticas por Departamento -->
                    <div class="bg-gray-50 p-4 rounded-lg mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3">📊 Estadísticas por Departamento</h4>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($estadisticas as $stat)
                            <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
                                <p class="text-sm text-gray-600">{{ $stat->departamento }}</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $stat->total }}</p>
                                <p class="text-xs text-gray-500">trabajadores</p>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Filtro de Departamento -->
                    <div class="bg-green-50 p-4 rounded-lg mb-6 border border-green-200">
                        <form method="GET" action="{{ route('reportes.por-departamento') }}" class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700">Filtrar por departamento:</label>
                            <select name="departamento" class="rounded-lg border-gray-300 focus:border-green-500 focus:ring focus:ring-green-200" onchange="this.form.submit()">
                                <option value="">Todos los departamentos</option>
                                <option value="Administración" {{ $departamento == 'Administración' ? 'selected' : '' }}>Administración</option>
                                <option value="Operaciones" {{ $departamento == 'Operaciones' ? 'selected' : '' }}>Operaciones</option>
                                <option value="Mantenimiento" {{ $departamento == 'Mantenimiento' ? 'selected' : '' }}>Mantenimiento</option>
                                <option value="Logística" {{ $departamento == 'Logística' ? 'selected' : '' }}>Logística</option>
                                <option value="Seguridad" {{ $departamento == 'Seguridad' ? 'selected' : '' }}>Seguridad</option>
                                <option value="Recursos Humanos" {{ $departamento == 'Recursos Humanos' ? 'selected' : '' }}>Recursos Humanos</option>
                            </select>
                            @if($departamento)
                            <a href="{{ route('reportes.por-departamento') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                                Limpiar filtro
                            </a>
                            @endif
                        </form>
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
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo Contrato</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Inicio</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Fin</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tiempo Acumulado</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($trabajadores as $trabajador)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $trabajador['dni'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $trabajador['nombre_completo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['cargo'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $trabajador['departamento'] }}
                                        </span>
                                    </td>
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
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['fecha_inicio'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $trabajador['fecha_fin'] }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $trabajador['meses_acumulados'] }} meses</td>
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
                                    <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                        @if($departamento)
                                            No hay trabajadores en el departamento seleccionado
                                        @else
                                            No hay trabajadores registrados
                                        @endif
                                    </td>
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