@extends('layouts.app')

@section('content')
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Centro de Control Maestro - Header Dinámico Premium -->
            <div class="animate-fade-in"
                style="background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%); color: white; border-radius: 20px; padding: 40px; margin-bottom: 40px; box-shadow: 0 20px 25px -5px rgba(15, 23, 42, 0.3); display: flex; align-items: center; gap: 32px; position: relative; overflow: hidden;">
                <div
                    style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(40px);">
                </div>

                <div class="animate-float"
                    style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(12px); padding: 24px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.1); box-shadow: 0 8px 32px rgba(0,0,0,0.2);">
                    <svg class="w-16 h-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                        </path>
                    </svg>
                </div>

                <div class="relative z-10">
                    <h1 style="font-size: 42px; font-weight: 800; margin: 0; letter-spacing: -0.025em; line-height: 1.1;">
                        Centro de <span
                            style="background: linear-gradient(to right, #60a5fa, #3b82f6); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Control
                            Maestro</span>
                    </h1>
                    <p style="color: #94a3b8; margin: 12px 0 0 0; font-size: 18px; font-weight: 500;">Gestión estratégica y
                        supervisión administrativa global de alto nivel</p>
                    <div style="display: flex; align-items: center; margin-top: 20px;">
                        <div class="pulse-green"
                            style="width: 10px; height: 10px; background: #4df1a1; border-radius: 50%; margin-right: 12px;">
                        </div>
                        <p
                            style="color: #64748b; font-size: 14px; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
                            Sistema Operativo Activo • {{ now()->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de Alto Rendimiento - Cards Dinámicas -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-16">

                <!-- Card 1: Total Trabajadores -->
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

                <!-- Card 2: Contratos Activos -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #10b981 0%, #065f46 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(16, 185, 129, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Contratos Activos</p>
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

                <!-- Card 3: Pendientes -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #92400e 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Pendientes</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalAlertasPendientes }}</p>
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

                <!-- Card 4: Alertas Críticas -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #ef4444 0%, #991b1b 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.3);">
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
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 5: Lista Negra -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #8b5cf6 0%, #4c1d95 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(139, 92, 246, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Bloqueados</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalEnListaNegra }}</p>
                        </div>
                        <div
                            style="background: rgba(255,255,255,0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inteligencia de Negocio y Resumen Ejecutivo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <!-- Gráfica de Distribución de Contratos -->
                <div class="executive-panel slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center;">
                            <div
                                style="background: #eff6ff; color: #3b82f6; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                    </path>
                                </svg>
                            </div>
                            Tipos de Contrato Vigentes
                        </h2>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="chartContratosAdmin"></canvas>
                    </div>
                </div>

                <!-- Gráfica de Distribución por Unidad -->
                <div class="executive-panel slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 24px;">
                        <h2 style="font-size: 18px; font-weight: 800; color: #1e293b; display: flex; align-items: center;">
                            <div
                                style="background: #ecfdf5; color: #10b981; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                                </svg>
                            </div>
                            Distribución por Unidades
                        </h2>
                    </div>
                    <div style="height: 300px; position: relative;">
                        <canvas id="chartUnidadesAdmin"></canvas>
                    </div>
                </div>
            </div>

            <!-- Inteligencia Operativa Premium y Resumen Rápido -->
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mb-12">
                <!-- Panel BI Mejorado -->
                <div class="lg:col-span-3 executive-panel slide-up"
                    style="background: #0f172a; border-radius: 24px; padding: 32px; color: white; position: relative; overflow: hidden; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4);">
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
                            Inteligencia Operativa Global
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div
                            style="background: rgba(255,255,255,0.03); padding: 24px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); text-align: center;">
                            <p
                                style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                                Ratio Contractual</p>
                            <div style="font-size: 36px; font-weight: 900; color: #3b82f6;">
                                {{ $totalTrabajadores > 0 ? number_format($totalContratos / $totalTrabajadores, 2) : 0 }}
                            </div>
                            <p style="color: #64748b; font-size: 11px; margin-top: 8px; font-weight: 500;">Contratos por
                                Persona</p>
                        </div>

                        <div
                            style="background: rgba(255,255,255,0.03); padding: 24px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); text-align: center;">
                            <p
                                style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                                Carga de Alertas</p>
                            <div style="font-size: 36px; font-weight: 900; color: #f59e0b;">{{ $totalAlertasPendientes }}
                            </div>
                            <p style="color: #64748b; font-size: 11px; margin-top: 8px; font-weight: 500;">Pendientes de
                                Resolución</p>
                        </div>

                        <div
                            style="background: rgba(255,255,255,0.03); padding: 24px; border-radius: 20px; border: 1px solid rgba(255,255,255,0.08); text-align: center;">
                            <p
                                style="color: #94a3b8; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.15em; margin-bottom: 12px;">
                                Riesgo de Seguridad</p>
                            <div style="font-size: 36px; font-weight: 900; color: #ef4444;">{{ $totalAlertasCriticas }}
                            </div>
                            <p style="color: #64748b; font-size: 11px; margin-top: 8px; font-weight: 500;">Casos Críticos
                                Activos</p>
                        </div>
                    </div>
                </div>

                <!-- Resumen por Unidad (Lista Estilizada) -->
                <div class="executive-panel slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9;">
                    <h3
                        style="font-size: 16px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center;">
                        <svg class="w-5 h-5 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        Unidades Activas
                    </h3>
                    <div class="space-y-4">
                        @foreach($trabajadoresPorUnidad->take(4) as $unidad)
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center;">
                                    <div
                                        style="width: 8px; height: 8px; background: #3b82f6; border-radius: 50%; margin-right: 12px;">
                                    </div>
                                    <span
                                        style="font-size: 13px; font-weight: 700; color: #475569;">{{ $unidad->unidad ?? 'CENTRAL' }}</span>
                                </div>
                                <span
                                    style="font-size: 13px; font-weight: 800; color: #1e293b; background: #f1f5f9; padding: 2px 8px; border-radius: 6px;">{{ $unidad->cantidad }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div style="margin-top: 24px; padding-top: 16px; border-top: 1px dashed #e2e8f0; text-align: center;">
                        <span
                            style="font-size: 11px; font-weight: 600; color: #94a3b8; text-transform: uppercase;">Monitoreo
                            Global de Sedes</span>
                    </div>
                </div>
            </div>

            <!-- Monitoreo de Vencimientos y Alertas Críticas -->
            <div class="grid grid-cols-1 lg:grid-cols-1 gap-10 mb-12">

                <!-- Próximos Vencimientos (Tabla de Alto Perfil) -->
                <div class="slide-up"
                    style="background: white; border-radius: 28px; padding: 0; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05); border: 1px solid #f1f5f9; overflow: hidden;">
                    <div
                        style="padding: 32px; border-bottom: 2px solid #f8fafc; display: flex; justify-content: space-between; align-items: center; background: #fafafa;">
                        <h2 style="font-size: 20px; font-weight: 800; color: #1e293b; display: flex; align-items: center;">
                            <div
                                style="background: #fef3c7; color: #d97706; padding: 8px; border-radius: 12px; margin-right: 14px;">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            Monitoreo de Vencimientos (Próximos 30 Días)
                        </h2>
                        <span
                            style="background: #fff7ed; color: #c2410c; padding: 8px 16px; border-radius: 99px; font-size: 12px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #ffedd5;">{{ $proximosVencimientos->count() }}
                            Casos Prioritarios</span>
                    </div>

                    @if($proximosVencimientos->count() > 0)
                        <div class="overflow-x-auto">
                            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                <thead style="background: #f8fafc;">
                                    <tr>
                                        <th
                                            style="padding: 20px 32px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid #f1f5f9;">
                                            Colaborador</th>
                                        <th
                                            style="padding: 20px 32px; text-align: left; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid #f1f5f9;">
                                            ID Contrato</th>
                                        <th
                                            style="padding: 20px 32px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid #f1f5f9;">
                                            Fecha Vencimiento</th>
                                        <th
                                            style="padding: 20px 32px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid #f1f5f9;">
                                            Status Urgencia</th>
                                        <th
                                            style="padding: 20px 32px; text-align: center; font-size: 11px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 0.1em; border-bottom: 2px solid #f1f5f9;">
                                            Acción</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-50">
                                    @foreach($proximosVencimientos->take(8) as $contrato)
                                        <tr class="table-row-hover transition-all">
                                            <td style="padding: 24px 32px;">
                                                <div style="display: flex; align-items: center;">
                                                    <div class="avatar-dynamic"
                                                        style="width: 44px; height: 44px; border-radius: 14px; background: #f1f5f9; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #1e293b; margin-right: 16px; border: 2px solid white; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                                        {{ substr($contrato->trabajador->nombre_completo, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p style="font-size: 14px; font-weight: 800; color: #0f172a; margin: 0;">
                                                            {{ $contrato->trabajador->nombre_completo }}</p>
                                                        <p
                                                            style="font-size: 11px; font-weight: 700; color: #94a3b8; margin-top: 2px; text-transform: uppercase;">
                                                            {{ $contrato->dni }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="padding: 24px 32px;">
                                                <span
                                                    style="font-family: 'JetBrains Mono', monospace; font-size: 13px; font-weight: 700; color: #475569; background: #f8fafc; padding: 4px 10px; border-radius: 8px; border: 1px solid #f1f5f9;">{{ $contrato->numero_contrato }}</span>
                                            </td>
                                            <td style="padding: 24px 32px; text-align: center;">
                                                <p style="font-size: 14px; font-weight: 800; color: #1e293b; margin: 0;">
                                                    {{ $contrato->fecha_fin->format('d/m/Y') }}</p>
                                            </td>
                                            <td style="padding: 24px 32px; text-align: center;">
                                                @php $dias = ceil(now()->diffInDays($contrato->fecha_fin)); @endphp
                                                <span
                                                    style="padding: 6px 16px; border-radius: 99px; font-size: 10px; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; {{ $dias <= 7 ? 'background: #fef2f2; color: #dc2626; border: 1px solid #fee2e2;' : ($dias <= 14 ? 'background: #fffbeb; color: #b45309; border: 1px solid #fef3c7;' : 'background: #f0fdf4; color: #166534; border: 1px solid #dcfce7;') }}">
                                                    {{ $dias }} Días Restantes
                                                </span>
                                            </td>
                                            <td style="padding: 24px 32px; text-align: center;">
                                                <a href="{{ route('contratos.show', $contrato->id) }}" class="btn-manage"
                                                    style="padding: 10px 20px; background: #1e293b; color: white; border-radius: 12px; font-size: 12px; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 8px; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                                    Gestionar <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div style="padding: 80px 0; text-align: center;">
                            <div
                                style="width: 100px; height: 100px; background: #f8fafc; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <p
                                style="color: #94a3b8; font-weight: 700; text-transform: uppercase; letter-spacing: 0.2em; font-size: 12px;">
                                Operación Estable: Sin Vencimientos Críticos</p>
                        </div>
                    @endif
                </div>

                <!-- Notificaciones Críticas (Estilo Real-Time) -->
                @if($totalAlertasCriticas > 0)
                    <div class="animate-pulse-slow" style="margin-top: 20px;">
                        <h3
                            style="font-size: 14px; font-weight: 900; color: #dc2626; text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 20px; display: flex; align-items: center;">
                            <span
                                style="width: 8px; height: 8px; background: #dc2626; border-radius: 50%; margin-right: 10px;"></span>
                            Últimas Alertas Criticas de Seguridad
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach($alertasCriticas->take(2) as $alerta)
                                <div class="critical-alert-card"
                                    style="background: white; border-left: 6px solid #ef4444; border-radius: 20px; padding: 24px; box-shadow: 0 10px 15px -3px rgba(239, 68, 68, 0.1); border: 1px solid #fee2e2; display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <h4 style="font-size: 16px; font-weight: 800; color: #0f172a; margin: 0;">
                                            {{ $alerta->titulo }}</h4>
                                        <p style="font-size: 13px; color: #64748b; margin: 8px 0 0 0; line-height: 1.5;">
                                            {{ $alerta->descripcion }}</p>
                                        <div style="display: flex; align-items: center; margin-top: 16px; gap: 12px;">
                                            <span
                                                style="font-size: 11px; font-weight: 800; background: #fef2f2; color: #b91c1c; padding: 4px 10px; border-radius: 6px;">{{ $alerta->trabajador->nombre_completo ?? 'N/A' }}</span>
                                            <span
                                                style="font-size: 10px; font-weight: 700; color: #94a3b8; text-transform: uppercase;">{{ now()->diffForHumans($alerta->created_at) }}</span>
                                        </div>
                                    </div>
                                    <a href="{{ route('alertas.show', $alerta->id) }}" class="btn-resolver"
                                        style="background: #ef4444; color: white; padding: 12px; border-radius: 14px; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.2);">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Designer Styles & Animations -->
        <style>
            @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes slideUp { from { opacity: 0; transform: translateY(40px); } to { opacity: 1; transform: translateY(0); } }
            @keyframes floating { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-15px); } }
            @keyframes pulseEmerald { 0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); } 70% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); } 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); } }
            @keyframes pulse { 0%, 100% { opacity: 1; } 50% { opacity: 0.85; } }

            .animate-fade-in { animation: fadeIn 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
            .animate-float { animation: floating 4s ease-in-out infinite; }
            .slide-up { animation: slideUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
            .pulse-emerald { animation: pulseEmerald 2.5s infinite; }
            .pulse-green { animation: pulse 2s infinite; }

            .stat-card { transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); cursor: pointer; }
            .stat-card:hover { transform: translateY(-12px) scale(1.02); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1) !important; }

            .executive-panel { transition: all 0.4s ease; border: 1px solid #f1f5f9; }
            .executive-panel:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05) !important; border-color: #e2e8f0; }

            .table-row-hover:hover { background: #f8fafc !important; }
            .table-row-hover:hover .avatar-dynamic { background: #1e40af !important; color: white !important; transform: scale(1.1); }

            .btn-manage { transition: all 0.3s ease; }
            .btn-manage:hover { background: #334155; transform: translateX(5px); }

            .critical-alert-card { transition: all 0.3s ease; cursor: pointer; }
            .critical-alert-card:hover { transform: scale(1.02); box-shadow: 0 15px 30px rgba(239, 68, 68, 0.1) !important; }

            .animate-pulse-slow { animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite; }
        </style>

        <!-- Graficos y Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Configuración Base de Charts
                const chartBaseConfig = {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
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
                    animation: { duration: 2000, easing: 'easeOutQuart' }
                };

                // 1. Gráfica de Contratos por Tipo (Barras Horizontales)
                const ctxContratos = document.getElementById('chartContratosAdmin').getContext('2d');
                const dataContratos = {!! json_encode($contratosPorTipo->pluck('cantidad')) !!};
                const labelsContratos = {!! json_encode($contratosPorTipo->pluck('tipo_contrato')) !!};

                new Chart(ctxContratos, {
                    type: 'bar',
                    data: {
                        labels: labelsContratos,
                        datasets: [{
                            label: 'Número de Contratos',
                            data: dataContratos,
                            backgroundColor: '#3b82f6',
                            borderRadius: 8,
                            hoverBackgroundColor: '#1d4ed8'
                        }]
                    },
                    options: {
                        ...chartBaseConfig,
                        indexAxis: 'y',
                        scales: {
                            x: { grid: { display: false }, ticks: { font: { weight: '600' } } },
                            y: { grid: { display: false }, ticks: { font: { weight: '600' } } }
                        }
                    }
                });

                // 2. Gráfica de Unidades (Pie Chart)
                const ctxUnidades = document.getElementById('chartUnidadesAdmin').getContext('2d');
                const dataUnidades = {!! json_encode($trabajadoresPorUnidad->pluck('cantidad')) !!};
                const labelsUnidades = {!! json_encode($trabajadoresPorUnidad->pluck('unidad')) !!};

                new Chart(ctxUnidades, {
                    type: 'doughnut',
                    data: {
                        labels: labelsUnidades,
                        datasets: [{
                            data: dataUnidades,
                            backgroundColor: ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ef4444', '#64748b'],
                            borderWidth: 0,
                            hoverOffset: 20
                        }]
                    },
                    options: {
                        ...chartBaseConfig,
                        cutout: '70%',
                        plugins: {
                            ...chartBaseConfig.plugins,
                            legend: {
                                ...chartBaseConfig.plugins.legend,
                                position: 'right'
                            }
                        }
                    }
                });
            });
        </script>
@endsection