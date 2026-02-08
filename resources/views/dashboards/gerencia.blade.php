@extends('layouts.app')

@section('content')
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Header Estratégico Premium -->
            <div class="animate-fade-in"
                style="background: linear-gradient(135deg, #1e293b 0%, #334155 100%); color: white; border-radius: 20px; padding: 40px; margin-bottom: 40px; box-shadow: 0 20px 25px -5px rgba(30, 41, 59, 0.2); display: flex; align-items: center; gap: 32px; position: relative; overflow: hidden;">
                <div
                    style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(40px);">
                </div>

                <div class="animate-float"
                    style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px); padding: 24px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                    <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                        </path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h1 style="font-size: 42px; font-weight: 800; margin: 0; letter-spacing: -0.025em; line-height: 1.1;">
                        Panel de <span
                            style="background: linear-gradient(to right, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Alta
                            Gerencia</span>
                    </h1>
                    <p style="color: #94a3b8; margin: 12px 0 0 0; font-size: 18px; font-weight: 500;">Inteligencia de
                        negocios y supervisión de riesgos críticos</p>
                    <div style="display: flex; align-items: center; margin-top: 20px;">
                        <div class="pulse-green"
                            style="width: 10px; height: 10px; background: #4df1a1; border-radius: 50%; margin-right: 12px;">
                        </div>
                        <p
                            style="color: #64748b; font-size: 14px; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
                            Monitor Ejecutivo • {{ now()->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Métricas Clave de Decisión -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-16">
                <!-- Total Trabajadores -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Fuerza Laboral</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalTrabajadores }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Contratos Activos -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #10b981 0%, #065f46 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Contratos</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalContratos }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Practicantes -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #8b5cf6 0%, #5b21b6 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Practicantes</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalPracticantes }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5S19.832 5.477 21 6.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Indefinidos -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #0ea5e9 0%, #0369a1 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Indefinidos</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalIndefinidos }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Alertas Críticas -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #ef4444 0%, #b91c1c 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Críticas</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalAlertasCriticas }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inteligencia de Negocio y Visualizaciones -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
                <!-- Gráfica de Contratos por Tipo -->
                <div class="executive-panel slide-up"
                    style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center;">
                            <div
                                style="background: #eff6ff; color: #3b82f6; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                            </div>
                            Composición de Contratos
                        </h2>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="chartContractComposition"></canvas>
                    </div>
                </div>

                <!-- Ratio y Salud Contractual -->
                <div class="executive-panel slide-up"
                    style="background: #0f172a; border-radius: 20px; padding: 32px; color: white; position: relative; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4);">
                    <div
                        style="position: absolute; bottom: -50px; left: -50px; width: 200px; height: 200px; background: rgba(59, 130, 246, 0.05); border-radius: 50%; filter: blur(50px);">
                    </div>

                    <div
                        style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 16px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: white; display: flex; align-items: center;">
                            <div
                                style="background: rgba(59, 130, 246, 0.2); color: #60a5fa; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            Resumen Ejecutivo BI
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div
                            style="background: rgba(255,255,255,0.03); padding: 24px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08);">
                            <p
                                style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                                Ratio Contractual</p>
                            <div style="font-size: 32px; font-weight: 900; color: #3b82f6;">
                                {{ $totalTrabajadores > 0 ? number_format($totalContratos / $totalTrabajadores, 2) : 0 }}
                            </div>
                            <p style="color: #64748b; font-size: 11px; margin-top: 8px; font-weight: 500;">Contratos por
                                Persona</p>
                        </div>

                        <div
                            style="background: rgba(255,255,255,0.03); padding: 24px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08);">
                            <p
                                style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                                Tasa de Estabilidad</p>
                            <div style="font-size: 32px; font-weight: 900; color: #10b981;">
                                {{ $totalContratos > 0 ? number_format(($totalIndefinidos / $totalContratos * 100), 1) : 0 }}%
                            </div>
                            <p style="color: #64748b; font-size: 11px; margin-top: 8px; font-weight: 500;">Personal
                                Indefinido</p>
                        </div>
                    </div>

                    <div
                        style="margin-top: 24px; background: rgba(239, 68, 68, 0.1); padding: 16px; border-radius: 12px; border: 1px solid rgba(239, 68, 68, 0.2); display: flex; align-items: center; justify-content: space-between;">
                        <div style="display: flex; align-items: center;">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            <span style="font-size: 13px; font-weight: 700;">Alertas Críticas Pendientes</span>
                        </div>
                        <span style="font-size: 20px; font-weight: 900; color: #ef4444;">{{ $totalAlertasCriticas }}</span>
                    </div>
                </div>
            </div>

            <!-- Alertas y Monitoreo de Riesgos -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-8 mb-12">
                <!-- Alertas Críticas -->
                <div class="slide-up"
                    style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <h2
                        style="font-size: 18px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center;">
                        <div
                            style="background: #fef2f2; color: #ef4444; padding: 8px; border-radius: 12px; margin-right: 14px;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Monitor de Alertas Críticas
                    </h2>

                    @if($alertasCriticas->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($alertasCriticas->take(6) as $alerta)
                                <div
                                    style="background: #f8fafc; border-radius: 16px; padding: 20px; border: 1px solid #f1f5f9; position: relative; overflow: hidden;">
                                    <div style="position: absolute; left: 0; top: 0; bottom: 0; width: 4px; background: #ef4444;">
                                    </div>
                                    <h4 style="font-size: 14px; font-weight: 800; color: #0f172a; margin-bottom: 8px;">
                                        {{ $alerta->titulo }}</h4>
                                    <p style="font-size: 12px; color: #64748b; line-height: 1.5; margin-bottom: 16px;">
                                        {{ $alerta->descripcion }}</p>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span
                                            style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">{{ $alerta->trabajador->nombre_completo ?? 'N/A' }}</span>
                                        <a href="{{ route('alertas.show', $alerta->id) }}"
                                            style="color: #ef4444; font-size: 11px; font-weight: 800; text-decoration: none;">Revisar
                                            →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px;">
                            <p style="color: #94a3b8; font-weight: 600;">Sin incidentes críticos reportados</p>
                        </div>
                    @endif
                </div>

                <!-- Monitoreo de Estabilidad (ACCIÓN REQUERIDA) -->
                <div class="slide-up"
                    style="background: white; border-radius: 20px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center;">
                            <div
                                style="background: #fff7ed; color: #f59e0b; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            Riesgo de Estabilidad (Umbral 5 Años)
                        </h2>
                        <span
                            style="background: #fef2f2; color: #dc2626; padding: 6px 14px; border-radius: 99px; font-size: 11px; font-weight: 800;">ALERTA
                            DE ACCIÓN REQUERIDA</span>
                    </div>

                    @if(count($proximosEstables) > 0)
                        <div class="overflow-x-auto">
                            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                <thead>
                                    <tr>
                                        <th
                                            style="padding: 12px 20px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">
                                            Colaborador</th>
                                        <th
                                            style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">
                                            Meses Acum.</th>
                                        <th
                                            style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">
                                            Tiempo Restante</th>
                                        <th
                                            style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">
                                            Nivel de Riesgo</th>
                                        <th
                                            style="padding: 12px 20px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; border-bottom: 2px solid #f1f5f9;">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($proximosEstables as $contrato)
                                        <tr style="transition: all 0.2s; cursor: pointer;">
                                            <td style="padding: 16px 20px; border-bottom: 1px solid #f8fafc;">
                                                <div style="font-size: 14px; font-weight: 800; color: #1e293b;">
                                                    {{ $contrato->trabajador->nombre_completo }}</div>
                                                <div style="font-size: 11px; color: #94a3b8;">DNI: {{ $contrato->dni }}</div>
                                            </td>
                                            <td style="padding: 16px 20px; text-align: center; border-bottom: 1px solid #f8fafc;">
                                                <span style="font-size: 13px; font-weight: 700;">{{ $contrato->meses_acumulados }}
                                                    m</span>
                                            </td>
                                            <td style="padding: 16px 20px; text-align: center; border-bottom: 1px solid #f8fafc;">
                                                <span
                                                    style="font-size: 14px; font-weight: 900; color: #ef4444;">{{ $contrato->meses_restantes }}
                                                    meses</span>
                                            </td>
                                            <td style="padding: 16px 20px; text-align: center; border-bottom: 1px solid #f8fafc;">
                                                <span
                                                    style="background: #fef2f2; color: #dc2626; padding: 4px 10px; border-radius: 6px; font-size: 10px; font-weight: 900;">CRÍTICO</span>
                                            </td>
                                            <td style="padding: 16px 20px; text-align: center; border-bottom: 1px solid #f8fafc;">
                                                <a href="{{ route('contratos.show', $contrato->id) }}"
                                                    style="background: #1e293b; color: white; padding: 8px 16px; border-radius: 8px; font-size: 11px; font-weight: 800; text-decoration: none;">Decidir
                                                    →</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px;">
                            <p style="color: #94a3b8; font-weight: 600;">Sin trabajadores próximos a estabilidad</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.85;
            }
        }

        .animate-fade-in {
            animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .animate-float {
            animation: floating 4s ease-in-out infinite;
        }

        .slide-up {
            animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .pulse-green {
            animation: pulse 2s infinite;
        }

        .stat-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            cursor: pointer;
        }

        .stat-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important;
        }

        .executive-panel {
            transition: all 0.4s ease;
        }

        .executive-panel:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Grafica de Composición
            const ctxComposition = document.getElementById('chartContractComposition').getContext('2d');
            const dataComp = {!! json_encode($contratosPorTipo->pluck('cantidad')) !!};
            const labelsComp = {!! json_encode($contratosPorTipo->pluck('tipo_contrato')) !!};

            new Chart(ctxComposition, {
                type: 'doughnut',
                data: {
                    labels: labelsComp,
                    datasets: [{
                        data: dataComp,
                        backgroundColor: ['#3b82f6', '#10b981', '#f59e0b', '#8b5cf6', '#ef4444', '#64748b'],
                        borderWidth: 0,
                        hoverOffset: 20
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'right',
                            labels: {
                                padding: 20,
                                usePointStyle: true,
                                font: { size: 12, weight: '600', family: "'Inter', sans-serif" },
                                color: '#64748b'
                            }
                        },
                        tooltip: {
                            backgroundColor: '#0f172a',
                            padding: 12,
                            cornerRadius: 10,
                            titleFont: { size: 13, weight: '800' }
                        }
                    },
                    cutout: '70%',
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                }
            });
        });
    </script>
@endsection