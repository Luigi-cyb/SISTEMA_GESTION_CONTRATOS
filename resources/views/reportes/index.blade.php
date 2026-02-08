@extends('layouts.app')

@section('content')
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Profesional -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="p-8">
                    <div class="flex items-center">
                        <div style="background: #eff6ff; color: #3b82f6; padding: 12px; border-radius: 16px; margin-right: 20px; box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 13v-1m4 1v-3m4 3V8M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">Centro de Reportes Inteligentes</h1>
                            <p class="text-lg font-semibold text-gray-500 mt-1">Genere análisis detallados en formatos compatibles para la toma de decisiones estratégicas.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Grid de Reportes -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- REPORTE 1: Contratos Activos -->
                <div class="report-card animate-slide-up" style="--delay: 0.1s;">
                    <div class="p-8">
                        <div class="icon-container bg-blue-50 text-blue-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Contratos Activos</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Consolidado general de personal vigente con
                            cálculo automático de antigüedad y remuneración.</p>
                        <a href="{{ route('reportes.contratos-activos') }}"
                            class="btn-report bg-blue-600 hover:bg-blue-700 shadow-blue-200">
                            Descargar Excel
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- REPORTE 2: Próximos a Vencer -->
                <div class="report-card animate-slide-up" style="--delay: 0.2s;">
                    <div class="p-8">
                        <div class="icon-container bg-amber-50 text-amber-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Próximos a Vencer</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Proyección de vencimientos a 30 días para
                            anticipar renovaciones o términos de contrato.</p>
                        <a href="{{ route('reportes.proximos-vencer') }}"
                            class="btn-report bg-amber-600 hover:bg-amber-700 shadow-amber-200">
                            Descargar Reporte
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- REPORTE 3: Por Departamento/Unidad -->
                <div class="report-card animate-slide-up" style="--delay: 0.3s;">
                    <div class="p-8">
                        <div class="icon-container bg-emerald-50 text-emerald-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Distribución Operativa</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Desglose de fuerza laboral agrupado por
                            Unidades, Áreas y Departamentos operativos.</p>
                        <a href="{{ route('reportes.por-departamento') }}" class="btn-report"
                            style="background-color: #10b981; box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.4);">
                            Generar Reporte
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- REPORTE 4: Tiempo Acumulado -->
                <div class="report-card animate-slide-up" style="--delay: 0.4s;">
                    <div class="p-8">
                        <div class="icon-container bg-violet-50 text-violet-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tiempo Acumulado</h3>
                        <p class="text-gray-500 text-sm leading-relaxed mb-8">Reporte histórico de meses laborados por
                            trabajador, considerando todas sus adendas.</p>
                        <a href="{{ route('reportes.tiempo-acumulado') }}" class="btn-report"
                            style="background-color: #8b5cf6; box-shadow: 0 4px 14px 0 rgba(139, 92, 246, 0.4);">
                            Descargar Datos
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>

                <!-- REPORTE 5: Próximos a ser Estables (CRÍTICO) -->
                <div class="report-card animate-slide-up" style="--delay: 0.5s; border: 2px solid #fee2e2;">
                    <div class="p-8">
                        <div class="icon-container bg-red-50 text-red-600">
                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-red-700 mb-3">Estabilidad Lab. (5 Años)</h3>
                        <p class="text-red-500 text-sm font-bold leading-relaxed mb-8">⚠️ ALERTA CRÍTICA: Trabajadores que
                            superan los 48 meses de servicio acumulado.</p>
                        <a href="{{ route('reportes.proximos-estables') }}"
                            class="btn-report bg-red-600 hover:bg-red-700 shadow-red-200">
                            Reporte Crítico
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                            </svg>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-slide-up {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
            animation-delay: var(--delay);
        }

        .report-card {
            background: white;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .report-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            border-color: #e2e8f0;
        }

        .icon-container {
            width: 56px;
            height: 56px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 24px;
        }

        .btn-report {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 12px 24px;
            color: white;
            font-weight: 700;
            border-radius: 12px;
            transition: all 0.3s ease;
            text-decoration: none;
            box-shadow: 0 4px 14px 0 rgba(0, 0, 0, 0.1);
        }

        .btn-report:hover {
            transform: scale(1.02);
            filter: brightness(1.1);
        }
    </style>
@endsection