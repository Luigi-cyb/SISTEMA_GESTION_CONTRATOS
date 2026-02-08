<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reporte CRÍTICO: Estabilidad Laboral') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="p-8 text-gray-900">
                    
                    <!-- Encabezado con botones de exportación -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 bg-gray-50/80 p-6 rounded-2xl border border-gray-100 shadow-sm gap-6">
                        <div>
                            <div class="flex items-center space-x-3 mb-2">
                                <div class="p-2.5 bg-rose-600 rounded-xl shadow-lg shadow-rose-200 animate-pulse">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-black text-gray-900 tracking-tight">Próximos a Estabilidad</h3>
                            </div>
                            <p class="text-gray-500 text-sm flex items-center ml-1">
                                <span class="flex h-2 w-2 rounded-full bg-rose-500 mr-2 animate-ping"></span>
                                Casos críticos detectados: <span class="font-bold text-rose-600 ml-1">{{ $trabajadores->count() }} colaboradores</span>
                            </p>
                        </div>
                        <div class="flex space-x-4">
                            <a href="{{ route('reportes.proximos-estables', ['formato' => 'excel']) }}" 
                               style="background-color: #10b981; color: white; box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4);"
                               class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Exportar Excel
                            </a>
                            <a href="{{ route('reportes.proximos-estables', ['formato' => 'pdf']) }}" 
                               style="background-color: #e11d48; color: white; box-shadow: 0 4px 14px 0 rgba(225, 29, 72, 0.4);"
                               class="group font-bold py-2.5 px-6 rounded-xl inline-flex items-center transition-all duration-300 hover:brightness-110 active:scale-95 shadow-lg">
                                <svg class="w-5 h-5 mr-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                </svg>
                                Generar PDF
                            </a>
                        </div>
                    </div>

                    <!-- Alerta Crítica Principal (Alto Contraste) -->
                    <div class="bg-rose-50 border-l-8 border-rose-600 rounded-2xl p-8 mb-10 shadow-sm relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center space-x-4 mb-5">
                                <div class="p-3 bg-rose-600 rounded-xl shadow-lg shadow-rose-200 animate-pulse">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-2xl font-black text-rose-900 uppercase tracking-tighter">Comunicado Urgente: Gerencia y RRHH</h4>
                            </div>
                            
                            <p class="text-rose-800 text-lg leading-relaxed mb-8 font-bold max-w-4xl">
                                Los siguientes colaboradores están por alcanzar el límite de <span class="bg-rose-600 text-white px-2 py-0.5 rounded ml-1 mr-1">5 AÑOS</span> de tiempo acumulado.
                                Se requiere una decisión inmediata para cumplir con las políticas de estabilidad laboral de <span class="text-rose-600 font-black">EMICONSATH</span>.
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div class="bg-white p-5 rounded-2xl border border-rose-200 shadow-sm border-t-4 border-t-rose-600">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-rose-500 mb-2">Opción A</p>
                                    <p class="font-black text-gray-900 text-base mb-1">Contrato Indefinido</p>
                                    <p class="text-[11px] font-bold text-gray-500 leading-tight">El colaborador adquiere estabilidad laboral total.</p>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-rose-200 shadow-sm border-t-4 border-t-rose-600">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-rose-500 mb-2">Opción B</p>
                                    <p class="font-black text-gray-900 text-base mb-1">Cese de Actividades</p>
                                    <p class="text-[11px] font-bold text-gray-500 leading-tight">Liquidación de beneficios + brecha de ley obligatoria.</p>
                                </div>
                                <div class="bg-white p-5 rounded-2xl border border-rose-200 shadow-sm border-t-4 border-t-rose-600">
                                    <p class="text-[10px] font-black uppercase tracking-widest text-rose-500 mb-2">Opción C</p>
                                    <p class="font-black text-gray-900 text-base mb-1">Adenda de Prórroga</p>
                                    <p class="text-[11px] font-bold text-gray-500 leading-tight">Solo aplicable si aún existe margen legal permitido.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Resumen por nivel de criticidad -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                        <div class="bg-white p-6 rounded-3xl border border-rose-100 shadow-sm border-l-8 border-l-rose-600 group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs font-black text-rose-600 uppercase tracking-widest">Alerta Inmediata</p>
                                <svg class="w-5 h-5 text-rose-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex items-baseline space-x-2">
                                <p class="text-4xl font-black text-gray-900">{{ $trabajadores->where('meses_restantes', '<=', 3)->count() }}</p>
                                <p class="text-xs font-bold text-gray-400 uppercase">Colaboradores</p>
                            </div>
                            <p class="text-[10px] font-black text-rose-500 uppercase mt-2">Menos de 3 meses para el límite</p>
                        </div>

                        <div class="bg-white p-6 rounded-3xl border border-amber-100 shadow-sm border-l-8 border-l-amber-500 group hover:shadow-md transition-all">
                            <div class="flex items-center justify-between mb-2">
                                <p class="text-xs font-black text-amber-600 uppercase tracking-widest">Alerta Preventiva</p>
                                <svg class="w-5 h-5 text-amber-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div class="flex items-baseline space-x-2">
                                <p class="text-4xl font-black text-gray-900">{{ $trabajadores->whereBetween('meses_restantes', [3.01, 6])->count() }}</p>
                                <p class="text-xs font-bold text-gray-400 uppercase">Colaboradores</p>
                            </div>
                            <p class="text-[10px] font-black text-amber-600 uppercase mt-2">Entre 3 y 6 meses para evaluar</p>
                        </div>
                    </div>

                    <!-- Tabla de Trabajadores -->
                    <div class="overflow-x-auto rounded-2xl border border-gray-100 shadow-sm mb-8">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50/50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Colaborador</th>
                                    <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Área / Cargo</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Contrato Actual</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Tiempo Acumulado</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Meses Restantes</th>
                                    <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider border-l border-rose-100">Alerta</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @forelse($trabajadores as $trabajador)
                                    <tr class="hover:bg-rose-50/30 transition-colors @if($trabajador['meses_restantes'] <= 3) bg-rose-50/10 @endif">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-bold text-gray-900">{{ $trabajador['nombre_completo'] }}</div>
                                            <div class="text-[10px] font-bold text-gray-400 uppercase">DNI: {{ $trabajador['dni'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-xs font-bold text-gray-800">{{ $trabajador['cargo'] }}</div>
                                            <div class="text-[10px] font-bold text-indigo-600 uppercase">{{ $trabajador['departamento'] }} - {{ $trabajador['unidad'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-xs">
                                            <div class="mb-1">
                                                <span class="px-2 py-0.5 rounded-md font-bold text-[10px] uppercase
                                                    @if($trabajador['tipo_contrato'] == 'TEMPORAL') bg-blue-100 text-blue-800
                                                    @elseif($trabajador['tipo_contrato'] == 'INDEFINIDO') bg-emerald-100 text-emerald-800
                                                    @else bg-purple-100 text-purple-800
                                                    @endif">
                                                    {{ $trabajador['tipo_contrato'] }}
                                                </span>
                                            </div>
                                            <div class="text-[9px] font-black text-gray-400 uppercase">Vence: {{ $trabajador['fecha_fin'] }}</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="text-xs font-black text-rose-700 uppercase tracking-tighter">{{ $trabajador['años_meses'] }}</div>
                                            <div class="text-[9px] font-bold text-gray-400">Total: {{ round($trabajador['meses_acumulados'], 1) }} meses</div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1.5 text-xs font-black rounded-xl uppercase tracking-widest shadow-sm
                                                @if($trabajador['meses_restantes'] <= 2) bg-rose-200 text-rose-900 animate-pulse
                                                @elseif($trabajador['meses_restantes'] <= 3) bg-rose-100 text-rose-800
                                                @else bg-amber-100 text-amber-800
                                                @endif">
                                                {{ round($trabajador['meses_restantes'], 1) }} meses
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center border-l border-rose-100">
                                            <span class="px-4 py-1.5 bg-rose-600 text-white text-[10px] font-black rounded-lg shadow-lg shadow-rose-200 uppercase tracking-widest ring-2 ring-rose-300 ring-offset-2 animate-bounce">
                                                CRÍTICO
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center">
                                            <div class="flex flex-col items-center justify-center">
                                                <div class="p-4 bg-emerald-50 rounded-full mb-4">
                                                    <svg class="w-12 h-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-xl font-black text-gray-900 tracking-tight">¡Operación bajo control!</p>
                                                <p class="text-sm text-gray-500 mt-1 max-w-xs mx-auto">
                                                    No hemos detectado colaboradores próximos al umbral crítico de estabilidad laboral (4 años 9 meses).
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Leyenda de Criticidad -->
                    <div class="bg-gray-50 p-6 rounded-3xl border border-gray-100">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h5 class="text-xs font-black text-gray-500 uppercase tracking-widest">Protocolo de Criticidad</h5>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="flex items-start">
                                <span class="w-3 h-3 bg-red-600 rounded-full mt-1 mr-3 flex-shrink-0"></span>
                                <p class="text-xs font-bold text-gray-600 leading-tight">≤ 2 meses: <span class="text-red-700 block mt-1 uppercase">Extremadamente crítico - Acción inmediata</span></p>
                            </div>
                            <div class="flex items-start">
                                <span class="w-3 h-3 bg-rose-400 rounded-full mt-1 mr-3 flex-shrink-0"></span>
                                <p class="text-xs font-bold text-gray-600 leading-tight">≤ 3 meses: <span class="text-rose-600 block mt-1 uppercase">Muy crítico - Preparar decisión final</span></p>
                            </div>
                            <div class="flex items-start">
                                <span class="w-3 h-3 bg-amber-500 rounded-full mt-1 mr-3 flex-shrink-0"></span>
                                <p class="text-xs font-bold text-gray-600 leading-tight">3-6 meses: <span class="text-amber-600 block mt-1 uppercase">Advertencia - Planificar estrategia legal</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- Botón Volver -->
                    <div class="mt-10 flex justify-start">
                        <a href="{{ route('reportes.index') }}" class="group flex items-center space-x-2 text-gray-400 hover:text-rose-600 font-bold transition-all transform hover:-translate-x-2">
                            <div class="p-2 bg-gray-100 group-hover:bg-rose-50 rounded-lg transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
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