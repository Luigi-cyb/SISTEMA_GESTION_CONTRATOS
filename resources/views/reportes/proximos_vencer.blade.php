<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte: Próximos a Vencer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg ">
                <div class="p-6 text-gray-900">

                    <!-- Encabezado con botones de exportación -->
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 bg-gray-50/80 p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="p-2.5 bg-amber-600 rounded-xl shadow-lg shadow-amber-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 tracking-tight">Próximos a Vencer</h3>
                            </div>
                            <p class="text-gray-500 text-sm flex items-center ml-1">
                                <span class="flex h-2 w-2 rounded-full bg-amber-500 mr-2 animate-pulse"></span>
                                Vencimientos en los próximos <span class="font-bold text-amber-600 mx-1">{{ $dias }}
                                    días</span> - <span class="font-bold text-gray-700 ml-1">{{ $contratos->count() }}
                                    contratos detectados</span>
                            </p>
                        </div>
                        <div class="flex space-x-3">
                            <a href="{{ route('reportes.proximos-vencer', ['formato' => 'excel', 'dias' => $dias]) }}"
                                style="background-color: #10b981; color: white; box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4);"
                                class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Excel
                            </a>
                            <a href="{{ route('reportes.proximos-vencer', ['formato' => 'pdf', 'dias' => $dias]) }}"
                                style="background-color: #e11d48; color: white; box-shadow: 0 4px 14px 0 rgba(225, 29, 72, 0.4);"
                                class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                PDF
                            </a>
                        </div>
                    </div>

                    <!-- Filtro de días -->
                    <div class="bg-yellow-50 p-4 rounded-lg mb-6 border border-yellow-200">
                        <form method="GET" action="{{ route('reportes.proximos-vencer') }}"
                            class="flex items-center space-x-4">
                            <label class="text-sm font-medium text-gray-700">Mostrar contratos que vencen en:</label>
                            <select name="dias"
                                class="rounded-lg border-gray-300 focus:border-yellow-500 focus:ring focus:ring-yellow-200"
                                onchange="this.form.submit()">
                                <option value="7" {{ $dias == 7 ? 'selected' : '' }}>7 días</option>
                                <option value="15" {{ $dias == 15 ? 'selected' : '' }}>15 días</option>
                                <option value="30" {{ $dias == 30 ? 'selected' : '' }}>30 días</option>
                                <option value="60" {{ $dias == 60 ? 'selected' : '' }}>60 días</option>
                                <option value="90" {{ $dias == 90 ? 'selected' : '' }}>90 días</option>
                            </select>
                        </form>
                    </div>

                    <!-- Alerta si hay contratos críticos -->
                    @if($contratos->where('dias_restantes', '<=', 7)->count() > 0)
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex items-center">
                                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                <div>
                                    <p class="font-bold text-red-800">¡ALERTA CRÍTICA!</p>
                                    <p class="text-red-700 text-sm">
                                        {{ $contratos->where('dias_restantes', '<=', 7)->count() }} contrato(s) vencen en 7
                                        días o menos
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Tabla de Contratos -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        DNI</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nombre Completo</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Cargo</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Departamento</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Unidad</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tipo</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Fecha Fin</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Días Restantes</th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Tiempo Acumulado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($contratos as $contrato)
                                    <tr
                                        class="hover:bg-gray-50 {{ $contrato['dias_restantes'] <= 7 ? 'bg-red-50' : ($contrato['dias_restantes'] <= 15 ? 'bg-yellow-50' : '') }}">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $contrato['dni'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $contrato['nombre_completo'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $contrato['cargo'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $contrato['departamento'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">
                                            {{ $contrato['unidad'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                        @if($contrato['tipo_contrato'] == 'TEMPORAL') bg-blue-100 text-blue-800
                                                        @elseif($contrato['tipo_contrato'] == 'INDEFINIDO') bg-green-100 text-green-800
                                                        @else bg-purple-100 text-purple-800
                                                        @endif">
                                                {{ $contrato['tipo_contrato'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">
                                            {{ $contrato['fecha_fin'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-3 py-1 text-xs font-bold rounded-full 
                                                        @if($contrato['dias_restantes'] <= 7) bg-red-100 text-red-800
                                                        @elseif($contrato['dias_restantes'] <= 15) bg-yellow-100 text-yellow-800
                                                        @else bg-green-100 text-green-800
                                                        @endif">
                                                {{ $contrato['dias_restantes'] }} días
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700 font-medium">
                                            {{ $contrato['tiempo_formateado'] }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="px-6 py-4 text-center text-gray-500">No hay contratos
                                            próximos a vencer en los próximos {{ $dias }} días</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Leyenda -->
                    <div class="mt-6 flex items-center space-x-6 text-sm">
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-red-100 border border-red-300 rounded mr-2"></span>
                            <span class="text-gray-700">≤ 7 días (Crítico)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-yellow-100 border border-yellow-300 rounded mr-2"></span>
                            <span class="text-gray-700">≤ 15 días (Advertencia)</span>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-white border border-gray-300 rounded mr-2"></span>
                            <span class="text-gray-700">> 15 días (Normal)</span>
                        </div>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-6">
                        <a href="{{ route('reportes.index') }}"
                            class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver a Reportes
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>