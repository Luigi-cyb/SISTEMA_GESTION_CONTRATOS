@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8 max-w-7xl">
        <!-- Encabezado -->
        <!-- Header -->
        <div class="bg-white shadow-sm sm:rounded-lg mb-6 ">
            <div class="p-6">
                <div class="flex items-center gap-4">
                    <div class="p-3 bg-pink-50 rounded-xl flex-shrink-0">
                        <svg class="w-8 h-8 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-semibold text-gray-900">Bienestar Corporativo</h1>
                        <p class="text-sm text-gray-600 mt-1">Gestión de cumpleaños y beneficios para los colaboradores</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjetas de Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-8">
            <!-- Total Trabajadores -->
            <div
                class="bg-white border-l-4 border-blue-500 rounded-xl shadow-sm p-5 transform hover:scale-105 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Total Personal</p>
                    <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $totalTrabajadores }}</p>
                <div class="flex items-center mt-2 text-xs font-bold text-blue-600">
                    <span class="px-2 py-0.5 bg-blue-50 rounded-full text-[10px]">COLABORADORES ACTIVOS</span>
                </div>
            </div>

            <!-- Próximos Cumpleaños -->
            <div
                class="bg-white border-l-4 border-pink-500 rounded-xl shadow-sm p-5 transform hover:scale-105 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Próximos</p>
                    <svg class="w-5 h-5 text-pink-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 15.546c.533.283.533 1.054 0 1.338L12 21.43l-9-4.546c-.533-.284-.533-1.054 0-1.338L12 11l9 4.546zM21 11l-9 4.546L3 11l9-4.546L21 11zM21 6.5l-9 4.546L3 6.5l9-4.546L21 6.5z">
                        </path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $totalProximos }}</p>
                <div class="flex items-center mt-2 text-xs font-bold text-pink-600">
                    <span class="px-2 py-0.5 bg-pink-50 rounded-full text-[10px]">SIGUIENTES 30 DÍAS</span>
                </div>
            </div>

            <!-- Alertas Cumpleaños -->
            <div
                class="bg-white border-l-4 border-yellow-500 rounded-xl shadow-sm p-5 transform hover:scale-105 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Alertas</p>
                    <svg class="w-5 h-5 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $totalAlertas }}</p>
                <div class="flex items-center mt-2 text-xs font-bold text-yellow-600">
                    <span class="px-2 py-0.5 bg-yellow-50 rounded-full text-[10px]">ACCIONES PENDIENTES</span>
                </div>
            </div>

            <!-- Giftcards Pendientes -->
            <div
                class="bg-white border-l-4 border-red-500 rounded-xl shadow-sm p-5 transform hover:scale-105 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Por Entregar</p>
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                        </path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $giftcardsPendientes->count() }}</p>
                <div class="flex items-center mt-2 text-xs font-bold text-red-600">
                    <span class="px-2 py-0.5 bg-red-50 rounded-full text-[10px]">FECHAS PASADAS</span>
                </div>
            </div>

            <!-- Giftcards Este Mes -->
            <div
                class="bg-white border-l-4 border-green-500 rounded-xl shadow-sm p-5 transform hover:scale-105 transition-all">
                <div class="flex items-center justify-between mb-2">
                    <p class="text-gray-500 text-xs font-black uppercase tracking-widest">Este Mes</p>
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-3xl font-black text-gray-800">{{ $giftcardsEntregadasMes }}</p>
                <div class="flex items-center mt-2 text-xs font-bold text-green-600">
                    <span class="px-2 py-0.5 bg-green-50 rounded-full text-[10px]">METAS LOGRADAS</span>
                </div>
            </div>
        </div>

        <!-- NUEVA SECCIÓN: GRÁFICOS -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- Gráfico de Barras: Cumpleaños por Mes -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-6">
                <div class="flex items-center gap-3 mb-6">
                    <div class="p-2 bg-pink-50 rounded-lg">
                        <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">Distribución Anual de Cumpleaños</h2>
                </div>
                <div style="position: relative; height: 300px;">
                    <canvas id="cumpleanosPorMesChart"></canvas>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-between">
                    <p class="text-sm font-bold text-gray-400">Población Total Analizada</p>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-xs font-black text-gray-600"><span
                            id="totalCumpleaños">0</span> COLABORADORES</span>
                </div>
            </div>

            <!-- Gráfico de Pastel: Estado de Beneficios -->
            <div
                class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 group">
                <div class="flex items-center justify-between mb-8">
                    <div class="flex items-center gap-3">
                        <div
                            class="p-2.5 bg-emerald-50 rounded-xl text-emerald-600 transition-colors group-hover:bg-emerald-600 group-hover:text-white">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-black text-gray-800 tracking-tight">Estado de Beneficios</h2>
                    </div>
                    <span
                        class="px-3 py-1 bg-gray-50 text-[10px] font-black text-gray-400 uppercase tracking-widest rounded-lg border border-gray-100">Global</span>
                </div>

                <div style="position: relative; height: 280px;" class="mb-4">
                    <canvas id="estadoGiftcardsChart"></canvas>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-50 flex items-center justify-between">
                    <div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Gestionado</p>
                        <p class="text-xs font-bold text-gray-500">Beneficios del Período</p>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="text-2xl font-black text-gray-900 leading-none"><span
                                id="totalGiftcards">0</span></span>
                        <span class="text-[9px] font-black text-emerald-600 uppercase tracking-tighter mt-1">Beneficios
                            Registrados</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grid Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
            <!-- Próximos Cumpleaños -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center justify-between bg-white">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-pink-100 rounded-lg text-pink-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-800 tracking-tight">Agenda de Cumpleaños (30 días)</h2>
                    </div>
                    <span
                        class="px-3 py-1 bg-pink-50 text-pink-600 rounded-full text-xs font-black uppercase tracking-widest">En
                        ventana</span>
                </div>

                <div class="p-6">
                    @if($proximosCumpleaños->count() > 0)
                        <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($proximosCumpleaños as $cumple)
                                @php
                                    $trabajador = $cumple->trabajador;
                                    if (!$trabajador)
                                        continue;

                                    $hoy = \Carbon\Carbon::now()->startOfDay();
                                    $fechaBase = \Carbon\Carbon::parse($cumple->fecha_cumpleaños);
                                    $proximoCumpleaños = $fechaBase->copy()->setYear($hoy->year)->startOfDay();

                                    if ($proximoCumpleaños->lt($hoy)) {
                                        $proximoCumpleaños->addYear();
                                    }

                                    $diasRestantes = (int) $hoy->diffInDays($proximoCumpleaños);
                                @endphp
                                <div
                                    class="group bg-white border border-gray-100 hover:border-pink-200 rounded-2xl p-5 shadow-sm hover:shadow-md transition-all duration-300">
                                    <div class="flex justify-between items-start">
                                        <div class="flex items-start gap-4">
                                            <div class="relative">
                                                <div
                                                    class="w-14 h-14 rounded-2xl bg-gradient-to-br from-pink-50 to-pink-100 flex items-center justify-center text-pink-600">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                        </path>
                                                    </svg>
                                                </div>
                                                @if($cumple->giftcard_entregada)
                                                    <div
                                                        class="absolute -bottom-2 -right-2 bg-green-500 text-white rounded-full p-1 border-2 border-white">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M5 13l4 4L19 7"></path>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                                            <div>
                                                <div class="flex items-center gap-2 mb-1">
                                                    <h3
                                                        class="font-black text-gray-800 text-lg uppercase tracking-tight group-hover:text-pink-600 transition-colors">
                                                        {{ $trabajador->nombre_completo }}</h3>
                                                </div>
                                                <div class="flex flex-wrap gap-y-1 gap-x-4 text-sm font-medium text-gray-500">
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm5 3a2 2 0 100-4 2 2 0 000 4z">
                                                            </path>
                                                        </svg>
                                                        DNI: {{ $trabajador->dni }}
                                                    </span>
                                                    <span class="flex items-center gap-1">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                        </svg>
                                                        Cumple {{ $proximoCumpleaños->year - $fechaBase->year }} años
                                                    </span>
                                                </div>

                                                <div class="mt-3">
                                                    @if($diasRestantes === 0)
                                                        <span
                                                            class="inline-flex items-center px-4 py-1.5 rounded-xl bg-pink-100 text-pink-700 text-xs font-black uppercase tracking-widest ring-1 ring-pink-200">
                                                            🌟 HOY ES SU DÍA 🌟
                                                        </span>
                                                    @elseif($diasRestantes === 1)
                                                        <span
                                                            class="inline-flex items-center px-4 py-1.5 rounded-xl bg-blue-100 text-blue-700 text-xs font-black uppercase tracking-widest ring-1 ring-blue-200">
                                                            🎉 MAÑANA
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-4 py-1.5 rounded-xl bg-gray-100 text-gray-700 text-xs font-black uppercase tracking-widest ring-1 ring-gray-200">
                                                            📅 {{ $proximoCumpleaños->format('d/m/Y') }} ({{ $diasRestantes }} DÍAS)
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="flex flex-col gap-2">
                                            @if(!$cumple->giftcard_entregada)
                                                <button
                                                    onclick="abrirFormularioGiftcard('{{ $trabajador->dni }}', '{{ $trabajador->nombre_completo }}', {{ $loop->index }})"
                                                    class="inline-flex items-center justify-center px-4 py-2.5 bg-pink-600 text-white rounded-xl text-sm font-black uppercase tracking-widest shadow-lg shadow-pink-100 hover:bg-pink-700 hover:scale-105 transition-all">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Registrar
                                                </button>
                                            @else
                                                <a href="{{ route('cumpleaños.show', $cumple->id) }}"
                                                    class="inline-flex items-center justify-center px-4 py-2.5 bg-blue-50 text-blue-700 border border-blue-200 rounded-xl text-sm font-black uppercase tracking-widest hover:bg-blue-100 transition-all">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                        </path>
                                                    </svg>
                                                    Detalles
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-16 h-16 mb-4 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            <p class="font-bold text-lg uppercase tracking-widest">Sin cumpleaños próximos</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Giftcards Pendientes -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex items-center gap-3 bg-white">
                    <div class="p-2 bg-red-100 rounded-lg text-red-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-800 tracking-tight">Giftcards Pendientes</h2>
                </div>

                <div class="p-6">
                    @if($giftcardsPendientes->count() > 0)
                        <div class="space-y-4 max-h-[500px] overflow-y-auto pr-2 custom-scrollbar">
                            @foreach($giftcardsPendientes as $giftcard)
                                <div class="bg-red-50/50 border border-red-100 p-5 rounded-2xl">
                                    <div class="flex items-start gap-3 mb-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-red-100 flex items-center justify-center text-red-600 font-bold text-lg uppercase">
                                            {{ substr($giftcard->trabajador->nombre_completo, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-black text-gray-800 uppercase text-sm leading-tight">
                                                {{ $giftcard->trabajador->nombre_completo }}</p>
                                            <p class="text-xs font-bold text-red-600 mt-0.5 tracking-tight">FECHA:
                                                {{ \Carbon\Carbon::parse($giftcard->fecha_cumpleaños)->format('d/m/Y') }}</p>
                                        </div>
                                    </div>

                                    <button onclick="marcarEntregado({{ $giftcard->id }})"
                                        class="w-full bg-white border-2 border-red-200 hover:bg-red-600 hover:border-red-600 hover:text-white text-red-600 font-black py-2 rounded-xl text-xs uppercase tracking-widest transition-all duration-300 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Marcar Entrega
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="py-12 flex flex-col items-center justify-center text-gray-300">
                            <svg class="w-12 h-12 mb-3 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="font-bold text-xs uppercase tracking-widest text-center">Todo al día</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Alertas de Cumpleaños -->
        <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-50 flex items-center gap-3 bg-white">
                <div class="p-2 bg-yellow-100 rounded-lg text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-gray-800 tracking-tight">Notificaciones Críticas</h2>
            </div>

            <div class="p-6">
                @if($alertasCumpleaños->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($alertasCumpleaños as $alerta)
                            <div
                                class="bg-gradient-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-5 rounded-2xl shadow-sm group">
                                <div class="flex flex-col h-full">
                                    <div class="flex-1 mb-4">
                                        <p class="font-black text-yellow-900 uppercase text-xs tracking-widest mb-1">
                                            {{ $alerta->titulo }}</p>
                                        <p class="text-sm text-yellow-800 font-medium leading-relaxed opacity-80">
                                            {{ $alerta->descripcion }}</p>
                                    </div>
                                    <div class="flex justify-end pt-3 border-t border-yellow-100/50">
                                        <a href="{{ route('alertas.show', $alerta->id) }}"
                                            class="inline-flex items-center text-yellow-700 hover:text-yellow-900 font-black text-xs uppercase tracking-widest transition-all">
                                            Gestionar Caso
                                            <svg class="w-4 h-4 ml-1 group-hover:translate-x-1 transition-transform" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-10 text-center text-gray-400">
                        <p class="font-black text-sm uppercase tracking-[0.2em]">Bandeja de entrada vacía</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal: Registrar Giftcard -->
    <div id="giftcardModal"
        class="hidden fixed inset-0 bg-gray-900/60 backdrop-blur-sm flex items-center justify-center z-50">
        <div
            class="bg-white rounded-3xl p-8 max-w-md w-full mx-4 shadow-2xl transform transition-all duration-300 scale-95 opacity-0 modal-animate-in">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-600">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                        </path>
                    </svg>
                </div>
                <h2 class="text-2xl font-black text-gray-800 tracking-tight uppercase">Registrar Entrega</h2>
            </div>

            <form id="giftcardForm" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" id="cumpleañosId" name="cumpleaños_id">

                <div class="space-y-1.5">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Colaborador
                        Beneficiario</label>
                    <input type="text" id="trabajadorNombre" readonly
                        class="w-full px-4 py-3 bg-gray-50 border-0 rounded-2xl text-gray-800 font-bold focus:ring-0">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Inversión Giftcard
                        (S/)</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-black">S/</span>
                        <input type="number" id="monto_giftcard" name="monto_giftcard" step="0.01" placeholder="0.00"
                            class="w-full pl-10 pr-4 py-3 bg-white border-2 border-gray-100 rounded-2xl text-gray-800 font-black focus:border-pink-500 transition-all outline-none"
                            required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-xs font-black text-gray-400 uppercase tracking-widest">Fecha Oficial de
                        Entrega</label>
                    <input type="date" id="fecha_entrega_giftcard" name="fecha_entrega_giftcard"
                        value="{{ now()->format('Y-m-d') }}"
                        class="w-full px-4 py-3 bg-white border-2 border-gray-100 rounded-2xl text-gray-800 font-bold focus:border-pink-500 transition-all outline-none"
                        required>
                </div>

                <div class="flex gap-4 pt-4">
                    <button type="submit"
                        class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-black py-4 rounded-2xl uppercase tracking-widest shadow-xl shadow-pink-100 transition-all active:scale-95">
                        Confirmar
                    </button>
                    <button type="button" onclick="cerrarModal()"
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-600 font-black py-4 rounded-2xl uppercase tracking-widest transition-all">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #fee2e2;
            border-radius: 10px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #fecaca;
        }

        .modal-animate-in {
            opacity: 1 !important;
            transform: scale(1) !important;
        }
    </style>

    <script>
        let chartBarras = null;
        let chartPastel = null;

        document.addEventListener('DOMContentLoaded', function () {
            inicializarGraficos();
        });

        function obtenerMesCumpleaños(fecha) {
            if (!fecha) return null;
            try {
                const date = new Date(fecha);
                if (isNaN(date.getTime())) return null;
                const año = date.getFullYear();
                if (año < 1900 || año > new Date().getFullYear()) return null;
                return date.getMonth();
            } catch (e) {
                return null;
            }
        }

        function inicializarGraficos() {
            if (chartBarras) chartBarras.destroy();
            if (chartPastel) chartPastel.destroy();

            const rawCumpleañosData = @json($todosCumpleaños);

            const cumpleañosPorMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            let cumpleañosProcessados = 0;

            rawCumpleañosData.forEach((cumple) => {
                if (cumple && cumple.fecha_cumpleaños) {
                    const mes = obtenerMesCumpleaños(cumple.fecha_cumpleaños);
                    if (mes !== null && mes >= 0 && mes < 12) {
                        cumpleañosPorMes[mes]++;
                        cumpleañosProcessados++;
                    }
                }
            });

            const totalGiftcards = rawCumpleañosData.length;
            const giftcardsEntregadas = rawCumpleañosData.filter(c => c && c.giftcard_entregada).length;
            const giftcardsPendientes = totalGiftcards - giftcardsEntregadas;

            document.getElementById('totalCumpleaños').textContent = cumpleañosProcessados;
            document.getElementById('totalGiftcards').textContent = totalGiftcards;

            const ctxBarras = document.getElementById('cumpleanosPorMesChart');
            if (ctxBarras) {
                chartBarras = new Chart(ctxBarras, {
                    type: 'bar',
                    data: {
                        labels: ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SEP', 'OCT', 'NOV', 'DIC'],
                        datasets: [{
                            label: 'COLABORADORES',
                            data: cumpleañosPorMes,
                            backgroundColor: '#db2777',
                            borderRadius: 8,
                            barThickness: 12
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: {
                            y: { beginAtZero: true, grid: { display: false }, ticks: { font: { weight: 'bold' } } },
                            x: { grid: { display: false }, ticks: { font: { weight: 'bold', size: 10 } } }
                        }
                    }
                });
            }

            const ctxPastel = document.getElementById('estadoGiftcardsChart');
            if (ctxPastel) {
                chartPastel = new Chart(ctxPastel, {
                    type: 'doughnut',
                    data: {
                        labels: ['ENTREGADAS', 'PENDIENTES'],
                        datasets: [{
                            data: [giftcardsEntregadas, giftcardsPendientes],
                            backgroundColor: ['#10b981', '#f43f5e'],
                            hoverBackgroundColor: ['#059669', '#e11d48'],
                            borderWidth: 4,
                            borderColor: '#ffffff',
                            borderRadius: 10,
                            cutout: '83%',
                            spacing: 2
                        }]
                    },
                    plugins: [{
                        id: 'centerText',
                        afterDraw(chart) {
                            const { ctx, chartArea: { left, right, top, bottom, width, height } } = chart;
                            const total = chart.data.datasets[0].data.reduce((a, b) => a + b, 0);
                            const delivered = chart.data.datasets[0].data[0];
                            const percentage = total > 0 ? Math.round((delivered / total) * 100) : 0;

                            ctx.save();
                            ctx.textAlign = 'center';
                            ctx.textBaseline = 'middle';

                            // Dibujar porcentaje
                            ctx.font = 'black 36px Outfit, sans-serif';
                            ctx.fillStyle = '#111827';
                            ctx.fillText(percentage + '%', left + width / 2, top + height / 2 - 5);

                            // Dibujar etiqueta
                            ctx.font = '900 10px Outfit, sans-serif';
                            ctx.fillStyle = '#9ca3af';
                            ctx.fillText('ENTREGADAS', left + width / 2, top + height / 2 + 25);
                            ctx.restore();
                        }
                    }],
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        layout: { padding: 10 },
                        plugins: {
                            legend: { display: false },
                            tooltip: {
                                enabled: true,
                                backgroundColor: '#111827',
                                titleFont: { family: 'Outfit', weight: 'bold', size: 12 },
                                bodyFont: { family: 'Outfit', size: 12 },
                                padding: 12,
                                cornerRadius: 12,
                                displayColors: false
                            }
                        },
                        animation: {
                            animateScale: true,
                            animateRotate: true,
                            duration: 2000,
                            easing: 'easeOutQuart'
                        }
                    }
                });
            }
        }

        function abrirFormularioGiftcard(dni, nombre, index) {
            const rawCumpleañosData = @json($proximosCumpleaños);
            const cumpleañosData = rawCumpleañosData.filter(c => c && c.fecha_cumpleaños && c.trabajador);
            const cumpleaños = cumpleañosData[index];

            if (!cumpleaños) return;

            const form = document.getElementById('giftcardForm');
            form.action = `/cumpleaños/${cumpleaños.id}/registrar-giftcard`;
            document.getElementById('cumpleañosId').value = cumpleaños.id;
            document.getElementById('trabajadorNombre').value = nombre;

            const modal = document.getElementById('giftcardModal');
            modal.classList.remove('hidden');
            setTimeout(() => { modal.querySelector('.modal-animate-in').style.opacity = '1'; }, 10);
        }

        function cerrarModal() {
            document.getElementById('giftcardModal').classList.add('hidden');
        }

        function marcarEntregado(id) {
            if (confirm('¿CONFIRMAR ENTREGA FÍSICA?')) {
                const rawGiftcardsData = @json($giftcardsPendientes);
                const giftcard = rawGiftcardsData.find(g => g.id === id);
                if (giftcard && giftcard.trabajador) {
                    const form = document.getElementById('giftcardForm');
                    form.action = `/cumpleaños/${id}/registrar-giftcard`;
                    document.getElementById('cumpleañosId').value = id;
                    document.getElementById('trabajadorNombre').value = giftcard.trabajador.nombre_completo;
                    document.getElementById('giftcardModal').classList.remove('hidden');
                }
            }
        }
    </script>
@endsection