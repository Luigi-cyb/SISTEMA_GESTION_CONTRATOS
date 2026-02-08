<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte: Tiempo Acumulado') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 p-8">

                <!-- Encabezado con botones de exportación -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
                    <div>
                        <div class="flex items-center space-x-3 mb-1">
                            <div class="p-2 bg-indigo-600 rounded-lg shadow-md">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900">Tiempo Acumulado</h3>
                        </div>
                        <p class="text-gray-500 text-sm">Personal activo: <span
                                class="font-bold text-indigo-600">{{ $trabajadores->count() }} colaboradores</span></p>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('reportes.tiempo-acumulado', ['formato' => 'excel']) }}"
                           style="background-color: #10b981; color: white; box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4);"
                           class="group font-bold py-2 px-5 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                            <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Exportar Excel
                        </a>
                        <a href="{{ route('reportes.tiempo-acumulado', ['formato' => 'pdf']) }}"
                           style="background-color: #e11d48; color: white; box-shadow: 0 4px 14px 0 rgba(225, 29, 72, 0.4);"
                           class="group font-bold py-2 px-5 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                            <svg class="w-4 h-4 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                            Generar PDF
                        </a>
                    </div>
                </div>

                <!-- Tarjetas de Resumen (Semáforo Premium) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-10">
                    <!-- Preventivo -->
                    <div class="bg-gradient-to-br from-emerald-50/50 to-white border border-emerald-100 p-6 rounded-3xl shadow-sm relative group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-black text-emerald-600 uppercase mb-2 tracking-widest">Preventivo</p>
                                <div class="flex flex-col">
                                    <p class="text-4xl font-black text-gray-900 leading-none">{{ $trabajadores->where('indicador_estabilidad', 'VERDE')->count() }}</p>
                                    <p class="text-[10px] font-bold text-emerald-500 mt-1 uppercase">colaboradores</p>
                                </div>
                                <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Rango: 1 - 3 Años</p>
                            </div>
                            <div class="p-2.5 bg-white rounded-xl shadow-sm text-emerald-500 border border-emerald-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Alerta -->
                    <div class="bg-gradient-to-br from-amber-50/50 to-white border border-amber-100 p-6 rounded-3xl shadow-sm relative group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-black text-amber-600 uppercase mb-2 tracking-widest">Alerta</p>
                                <div class="flex flex-col">
                                    <p class="text-4xl font-black text-gray-900 leading-none">{{ $trabajadores->where('indicador_estabilidad', 'AMARILLO')->count() }}</p>
                                    <p class="text-[10px] font-bold text-amber-500 mt-1 uppercase">colaboradores</p>
                                </div>
                                <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Rango: 4 Años</p>
                            </div>
                            <div class="p-2.5 bg-white rounded-xl shadow-sm text-amber-500 border border-amber-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Crítico -->
                    <div class="bg-gradient-to-br from-rose-50/50 to-white border border-rose-100 p-6 rounded-3xl shadow-sm relative group">
                        <div class="flex justify-between items-start">
                            <div>
                                <p class="text-xs font-black text-rose-600 uppercase mb-2 tracking-widest">Crítico</p>
                                <div class="flex flex-col">
                                    <p class="text-4xl font-black text-gray-900 leading-none">{{ $trabajadores->where('indicador_estabilidad', 'ROJO')->count() }}</p>
                                    <p class="text-[10px] font-bold text-rose-500 mt-1 uppercase">colaboradores</p>
                                </div>
                                <p class="mt-4 text-[10px] font-bold text-gray-400 uppercase tracking-tighter">Rango: 4.5+ Años</p>
                            </div>
                            <div class="p-3 bg-white rounded-xl shadow-sm text-rose-500 border border-rose-50">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tabla Principal -->
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">
                                        Colaborador</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Área /
                                        Cargo</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">
                                        Historial</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Tiempo
                                        Total</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase">Alerta
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase">Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($trabajadores as $trabajador)
                                    <tr class="hover:bg-gray-50/50 transition-colors">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">
                                                {{ $trabajador['nombre_completo'] }}</div>
                                            <div class="text-[10px] font-bold text-gray-400 uppercase">DNI:
                                                {{ $trabajador['dni'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs font-bold text-gray-800">{{ $trabajador['cargo'] }}</div>
                                            <div class="text-[10px] font-bold text-indigo-600 uppercase">
                                                {{ $trabajador['departamento'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-xs">
                                            <span
                                                class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded-md font-bold">{{ $trabajador['total_contratos'] }}C
                                                / {{ $trabajador['total_adendas'] }}A</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-xs font-black text-gray-900">{{ $trabajador['años_meses'] }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-1 text-[10px] font-bold rounded-full uppercase
                                                @if($trabajador['indicador_estabilidad'] == 'VERDE') bg-emerald-100 text-emerald-800
                                                @elseif($trabajador['indicador_estabilidad'] == 'AMARILLO') bg-amber-100 text-amber-800
                                                @else bg-rose-100 text-rose-800
                                                @endif">
                                                {{ $trabajador['indicador_estabilidad'] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div
                                                    class="h-2 w-2 rounded-full mr-2 @if($trabajador['estado'] == 'Activo') bg-emerald-500 @else bg-amber-500 @endif animate-pulse">
                                                </div>
                                                <span
                                                    class="text-[10px] font-black uppercase text-gray-600">{{ $trabajador['estado'] }}</span>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">No se
                                            encontraron datos</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Botón Volver -->
                <div class="mt-8">
                    <a href="{{ route('reportes.index') }}"
                        class="inline-flex items-center text-sm font-bold text-gray-400 hover:text-indigo-600 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver a Reportes
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>