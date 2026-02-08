<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte: Por Departamento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8 text-gray-900">

                    <!-- Encabezado con botones de exportación -->
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 bg-gray-50/80 p-6 rounded-2xl border border-gray-100 shadow-sm">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="p-2.5 bg-blue-600 rounded-xl shadow-lg shadow-blue-200">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 tracking-tight">Personal por Departamento
                                </h3>
                            </div>
                            <p class="text-gray-500 text-sm flex items-center ml-1">
                                <span class="flex h-2 w-2 rounded-full bg-emerald-500 mr-2 animate-pulse"></span>
                                Total de personal activo: <span
                                    class="font-bold text-blue-600 ml-1">{{ $trabajadores->count() }}
                                    colaboradores</span>
                            </p>
                        </div>
                        <div class="flex space-x-4 mt-5 md:mt-0">
                            <a href="{{ route('reportes.por-departamento', ['formato' => 'excel', 'departamento' => $departamentoFiltro]) }}"
                                style="background-color: #10b981; color: white; box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4);"
                                class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                                Exportar Excel
                            </a>
                            <a href="{{ route('reportes.por-departamento', ['formato' => 'pdf', 'departamento' => $departamentoFiltro]) }}"
                                style="background-color: #e11d48; color: white; box-shadow: 0 4px 14px 0 rgba(225, 29, 72, 0.4);"
                                class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                    </path>
                                </svg>
                                Generar PDF
                            </a>
                        </div>
                    </div>

                    <!-- Estadísticas por Departamento -->
                    <div class="mb-10">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            <h4 class="font-bold text-gray-700 uppercase tracking-wider text-sm">Resumen por área</h4>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach($estadisticas as $stat)
                                <div
                                    class="group bg-white p-5 rounded-2xl shadow-sm border border-gray-100 hover:border-blue-200 transition-all hover:shadow-md">
                                    <p class="text-xs font-bold text-gray-400 uppercase mb-1 truncate">
                                        {{ $stat->departamento }}</p>
                                    <div class="flex items-end space-x-2">
                                        <p
                                            class="text-3xl font-black text-gray-900 group-hover:text-blue-600 transition-colors">
                                            {{ $stat->total }}</p>
                                        <p class="text-xs font-bold text-gray-400 mb-1.5 px-2 py-0.5 bg-gray-50 rounded-md">
                                            activos</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Filtro de Departamento -->
                    <div class="bg-white p-6 rounded-2xl mb-8 border border-gray-100 shadow-sm">
                        <form method="GET" action="{{ route('reportes.por-departamento') }}"
                            class="flex flex-col md:flex-row items-start md:items-center space-y-4 md:space-y-0 md:space-x-6">
                            <div class="flex items-center space-x-3">
                                <div class="p-2 bg-gray-100 rounded-lg text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z">
                                        </path>
                                    </svg>
                                </div>
                                <label class="text-sm font-bold text-gray-700">Filtrar por departamento:</label>
                            </div>
                            <div class="flex-1 w-full md:w-auto flex items-center space-x-4">
                                <select name="departamento"
                                    class="w-full md:w-80 rounded-xl border-gray-200 focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all font-medium py-2.5 shadow-sm"
                                    onchange="this.form.submit()">
                                    <option value="">Todos los departamentos</option>
                                    @foreach($departamentos as $dep)
                                        <option value="{{ $dep }}" {{ $departamentoFiltro == $dep ? 'selected' : '' }}>
                                            {{ $dep }}</option>
                                    @endforeach
                                </select>
                                @if($departamentoFiltro)
                                    <a href="{{ route('reportes.por-departamento') }}"
                                        class="text-sm font-bold text-blue-600 hover:text-blue-800 flex items-center space-x-1 group">
                                        <svg class="w-4 h-4 group-hover:rotate-180 transition-transform" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                        <span>Limpiar</span>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>

                    <!-- Tabla de Trabajadores -->
                    <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 012-2h2a2 2 0 012 2v1m-4 0h4">
                                                </path>
                                            </svg>
                                            <span>DNI</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>Colaborador</span>
                                        </div>
                                    </th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Cargo / Área</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Tipo Contrato</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Vigencia</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider text-center">
                                        Tiempo Acumulado</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">
                                        Estado</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($trabajadores as $trabajador)
                                    <tr class="hover:bg-gray-50/80 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-medium">
                                            {{ $trabajador['dni'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">
                                            {{ $trabajador['nombre_completo'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $trabajador['cargo'] }}</div>
                                            <div class="text-xs font-medium text-blue-600 uppercase">
                                                {{ $trabajador['departamento'] }} - {{ $trabajador['unidad'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="px-2.5 py-1 text-xs font-bold rounded-full uppercase tracking-tighter
                                                    @if($trabajador['tipo_contrato'] == 'Indefinido') bg-emerald-100 text-emerald-800
                                                    @elseif($trabajador['tipo_contrato'] == 'Practicante') bg-violet-100 text-violet-800
                                                    @else bg-blue-100 text-blue-800
                                                    @endif">
                                                {{ $trabajador['tipo_contrato'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-black text-gray-900">
                                                {{ $trabajador['fecha_inicio'] != 'N/A' ? \Carbon\Carbon::parse($trabajador['fecha_inicio'])->format('d/m/Y') : 'N/A' }}
                                            </div>
                                            <div class="text-xs font-bold text-gray-400">hasta
                                                {{ $trabajador['fecha_fin'] != 'N/A' ? \Carbon\Carbon::parse($trabajador['fecha_fin'])->format('d/m/Y') : 'N/A' }}
                                            </div>
                                        </td>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-center text-sm font-black text-blue-700">
                                            {{ $trabajador['tiempo_formateado'] }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="flex items-center text-xs font-black uppercase tracking-widest
                                                @if($trabajador['estado'] == 'Activo') text-emerald-600
                                                @elseif($trabajador['estado'] == 'Vencido') text-rose-600
                                                @else text-gray-600
                                                @endif">
                                                <span class="h-1.5 w-1.5 rounded-full mr-2 animate-pulse
                                                    @if($trabajador['estado'] == 'Activo') bg-emerald-500
                                                    @elseif($trabajador['estado'] == 'Vencido') bg-rose-500
                                                    @else bg-gray-500
                                                    @endif"></span>
                                                {{ strtoupper($trabajador['estado']) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <p class="text-gray-400 font-medium text-lg">
                                                    @if($departamentoFiltro)
                                                        No hay trabajadores activos en el departamento de
                                                        {{ $departamentoFiltro }}
                                                    @else
                                                        No se encontraron trabajadores activos en el sistema
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-10 flex justify-start">
                        <a href="{{ route('reportes.index') }}"
                            class="group flex items-center space-x-2 text-gray-400 hover:text-blue-600 font-bold transition-all transform hover:-translate-x-2">
                            <div class="p-2 bg-gray-100 group-hover:bg-blue-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                            </div>
                            <span>Regresar al Centro de Reportes</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>