@extends('layouts.app')

@section('content')
    <div class="py-10 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Header Profesional Premium -->
            <div class="animate-fade-in"
                style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; border-radius: 20px; padding: 40px; margin-bottom: 40px; box-shadow: 0 20px 25px -5px rgba(30, 64, 175, 0.2); display: flex; align-items: center; gap: 32px; position: relative; overflow: hidden;">
                <div
                    style="position: absolute; top: -20px; right: -20px; width: 150px; height: 150px; background: rgba(255,255,255,0.05); border-radius: 50%; filter: blur(40px);">
                </div>
                <div class="animate-float"
                    style="background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(12px); padding: 24px; border-radius: 24px; border: 1px solid rgba(255, 255, 255, 0.2); box-shadow: 0 8px 32px rgba(0,0,0,0.15);">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                </div>
                <div class="relative z-10">
                    <h1 style="font-size: 42px; font-weight: 800; margin: 0; letter-spacing: -0.025em; line-height: 1.1;">
                        Gestión de <span style="color: #93c5fd;">Talento Humano</span></h1>
                    <p style="color: #dbeafe; margin: 12px 0 0 0; font-size: 18px; font-weight: 500;">Gestión integral de
                        contratos, alertas y trabajadores</p>
                    <div style="display: flex; align-items: center; margin-top: 20px;">
                        <div class="pulse-green"
                            style="width: 10px; height: 10px; background: #4df1a1; border-radius: 50%; margin-right: 12px;">
                        </div>
                        <p
                            style="color: #bfdbfe; font-size: 14px; margin: 0; font-weight: 600; text-transform: uppercase; letter-spacing: 0.05em;">
                            Sistema Activo • {{ now()->format('d/m/Y H:i:s') }}</p>
                    </div>
                </div>
            </div>

            <!-- Tarjetas de Estadísticas Principales (4 Cards) Dinámicas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-16">
                <!-- Card 1: Total Contratos Activos y Renovados -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(59, 130, 246, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Plantilla Total</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $totalContratos ?? 0 }}</p>
                            <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">
                                Incluye {{ $totalRenovados ?? 0 }} Renovados</p>
                        </div>
                        <div
                            style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Contratos Temporales (Servicio Específico + Inc. Actividad) -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(245, 158, 11, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Contratos Temporales</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $contratosTemporales ?? 0 }}</p>
                            <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">
                                S. Específico / Incremento</p>
                        </div>
                        <div
                            style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Trabajadores Activos -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(6, 182, 212, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Activos</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $trabajadoresActivos ?? 0 }}</p>
                            <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">
                                Efectivo actual</p>
                        </div>
                        <div
                            style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Trabajadores Inactivos -->
                <div class="stat-card"
                    style="background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white; border-radius: 16px; padding: 28px; box-shadow: 0 10px 15px -3px rgba(100, 116, 139, 0.3);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div>
                            <p
                                style="color: rgba(255,255,255,0.7); font-size: 11px; margin: 0; text-transform: uppercase; letter-spacing: 0.1em; font-weight: 800;">
                                Inactivos</p>
                            <p style="font-size: 40px; font-weight: 900; margin: 12px 0 0 0; letter-spacing: -0.05em;">
                                {{ $trabajadoresInactivos ?? 0 }}</p>
                            <p style="color: rgba(255,255,255,0.8); font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">
                                Bajas registradas</p>
                        </div>
                        <div
                            style="background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(4px); padding: 12px; border-radius: 14px; border: 1px solid rgba(255,255,255,0.1);">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dashboard Charts Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-32">
                <!-- Contratos por Tipo -->
                <div class="slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9;">
                    <h2
                        style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center;">
                        <div
                            style="background: #3b82f6; color: white; padding: 8px; border-radius: 10px; display: flex; margin-right: 14px; box-shadow: 0 4px 10px rgba(59, 130, 246, 0.2);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        Frecuencia por Tipo de Contrato
                    </h2>
                    <div style="height: 350px; position: relative;">
                        <canvas id="chartContratos"></canvas>
                    </div>
                </div>

                <!-- Distribución por Unidad -->
                <div class="slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9;">
                    <h2
                        style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center;">
                        <div
                            style="background: #10b981; color: white; padding: 8px; border-radius: 10px; display: flex; margin-right: 14px; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.2);">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                </path>
                            </svg>
                        </div>
                        Distribución por Unidad Operativa
                    </h2>
                    <div style="height: 350px; position: relative;">
                        <canvas id="chartTrabajadores"></canvas>
                    </div>
                </div>
            </div>

            <!-- List Section -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-48">
                <!-- Próximos Vencimientos -->
                <div class="lg:col-span-2 slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9;">
                    <h2
                        style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center; border-bottom: 2px solid #f8fafc; padding-bottom: 16px;">
                        <div
                            style="background: #f59e0b; color: white; padding: 8px; border-radius: 10px; display: flex; margin-right: 14px;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        Próximos Vencimientos (30 días)
                    </h2>
                    @if(isset($proximosVencimientos) && $proximosVencimientos->count() > 0)
                        <div style="max-height: 400px; overflow-y: auto;">
                            @foreach($proximosVencimientos as $contrato)
                                <div
                                    style="border-left: 5px solid #f59e0b; background: #fffbeb; border-radius: 12px; padding: 20px; margin-bottom: 16px; display: flex; justify-content: space-between; align-items: center;">
                                    <div style="flex: 1;">
                                        <p style="font-weight: 800; color: #0f172a; margin: 0; font-size: 16px;">
                                            {{ $contrato->trabajador->nombre_completo ?? 'N/A' }}</p>
                                        <p style="font-size: 12px; color: #64748b; margin: 6px 0 0 0; font-weight: 600;">DNI:
                                            {{ $contrato->dni ?? 'N/A' }} | {{ $contrato->numero_contrato ?? 'N/A' }}</p>
                                        <p
                                            style="font-size: 12px; font-weight: 800; color: #b45309; margin-top: 8px; display: flex; align-items: center; gap: 6px;">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Vence: {{ $contrato->fecha_fin ? $contrato->fecha_fin->format('d/m/Y') : 'N/A' }}
                                            @if($contrato->fecha_fin)
                                                ({{ ceil(now()->diffInDays($contrato->fecha_fin)) }} días)
                                            @endif
                                        </p>
                                    </div>
                                    <div style="display: flex; gap: 8px;">
                                        <a href="{{ route('contratos.show', $contrato->id) }}"
                                            style="background: #3b82f6; color: white; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 700; text-decoration: none;">Detalles</a>
                                        <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                            style="background: #10b981; color: white; padding: 8px 16px; border-radius: 8px; font-size: 12px; font-weight: 700; text-decoration: none;">Renovar</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p style="color: #64748b; text-align: center; padding: 40px 0;">No hay vencimientos próximos.</p>
                    @endif
                </div>

                <!-- Lista Negra Side -->
                <div class="slide-up"
                    style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9;">
                    <h2
                        style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center;">
                        <div
                            style="background: #ef4444; color: white; padding: 8px; border-radius: 10px; display: flex; margin-right: 14px;">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                </path>
                            </svg>
                        </div>
                        En Lista Negra
                    </h2>
                    <p style="font-size: 48px; font-weight: 900; color: #ef4444; margin: 0;">{{ $totalEnListaNegra ?? 0 }}
                    </p>
                    <p
                        style="color: #64748b; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.1em; margin-top: 4px;">
                        Bloqueados</p>
                    @if(isset($enListaNegra) && $enListaNegra->count() > 0)
                        <div style="max-height: 300px; overflow-y: auto; margin-top: 20px;">
                            @foreach($enListaNegra as $registro)
                                <div
                                    style="background: #fef2f2; border: 1px solid #fee2e2; padding: 12px; border-radius: 10px; margin-bottom: 8px; border-left: 4px solid #ef4444;">
                                    <p style="font-weight: 700; color: #1e293b; margin: 0; font-size: 14px;">
                                        {{ $registro->trabajador->nombre_completo ?? 'N/A' }}</p>
                                    <p style="font-size: 11px; color: #ef4444; font-weight: 600; margin-top: 2px;">DNI:
                                        {{ $registro->dni ?? 'N/A' }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Proyección de Estabilidad -->
            <div class="slide-up"
                style="background: white; border-radius: 24px; padding: 32px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); border: 1px solid #f1f5f9; margin-bottom: 40px;">
                <h2
                    style="font-size: 20px; font-weight: 800; color: #1e293b; margin-bottom: 24px; display: flex; align-items: center; border-bottom: 2px solid #f8fafc; padding-bottom: 16px;">
                    <div
                        style="background: #ec4899; color: white; padding: 8px; border-radius: 10px; display: flex; margin-right: 14px;">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path>
                        </svg>
                    </div>
                    Proyección de Estabilidad (5 Años)
                </h2>
                @if(isset($proximosEstables) && count($proximosEstables) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr style="background: #f8fafc;">
                                    <th
                                        style="padding: 16px; text-align: left; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                        Colaborador</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                        Meses Acum.</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                        Progreso</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 11px; font-weight: 800; color: #64748b; text-transform: uppercase;">
                                        Gestión</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">
                                @foreach($proximosEstables as $contrato)
                                    <tr class="hover:bg-slate-50 transition-all">
                                        <td style="padding: 16px;">
                                            <p style="font-size: 14px; font-weight: 700; color: #1e293b; margin: 0;">
                                                {{ $contrato->trabajador->nombre_completo }}</p>
                                        </td>
                                        <td style="padding: 16px; text-align: center;">
                                            <span
                                                style="font-size: 14px; font-weight: 800; color: #475569;">{{ $contrato->meses_acumulados }}
                                                Meses</span>
                                        </td>
                                        <td style="padding: 16px; text-align: center; min-width: 150px;">
                                            @php $pct = ($contrato->meses_acumulados / 60) * 100; @endphp
                                            <div
                                                style="width: 100%; background: #f1f5f9; height: 8px; border-radius: 10px; overflow: hidden;">
                                                <div
                                                    style="width: {{ $pct }}%; height: 100%; background: #ec4899; border-radius: 10px;">
                                                </div>
                                            </div>
                                            <p style="font-size: 10px; font-weight: 800; color: #64748b; margin-top: 4px;">
                                                {{ round($pct) }}%</p>
                                        </td>
                                        <td style="padding: 16px; text-align: center;">
                                            <a href="{{ route('contratos.show', $contrato->id) }}"
                                                style="padding: 8px 16px; background: #ec4899; color: white; border-radius: 8px; font-size: 12px; font-weight: 700; text-decoration: none;">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p style="text-align: center; padding: 40px 0; color: #64748b;">No hay registros próximos a estabilidad.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Styles -->
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

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(77, 241, 161, 0.4);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(77, 241, 161, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(77, 241, 161, 0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        .animate-float {
            animation: floating 3s ease-in-out infinite;
        }

        .slide-up {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
            opacity: 0;
        }

        .pulse-green {
            animation: pulse 2s infinite;
        }

        .stat-card {
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }
    </style>

    <!-- Script Chart.js Dinámico Premium -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración base refinada
            const baseConfig = {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 13, weight: '700', family: "'Inter', sans-serif" },
                            color: '#475569'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.9)',
                        titleFont: { size: 14, weight: '800' },
                        bodyFont: { size: 13, weight: '500' },
                        padding: 16,
                        cornerRadius: 12,
                        displayColors: true
                    }
                },
                animation: {
                    duration: 2500,
                    easing: 'easeOutQuart'
                }
            };

            // 1. Gráfica de Contratos (Barra Horizontal)
            const ctxContratos = document.getElementById('chartContratos').getContext('2d');

            const gradientBlue = ctxContratos.createLinearGradient(0, 0, 400, 0);
            gradientBlue.addColorStop(0, '#3b82f6');
            gradientBlue.addColorStop(1, '#60a5fa');

            // Normalizar nombres largos para mejor visualización
            const nameMap = {
                'Para servicio específico': 'S. Específico',
                'Por incremento de actividad': 'Inc. Actividad',
                'Indefinido': 'Indefinido',
                'Practicante': 'Practicante'
            };

            const labelsContratosRaw = {!! json_encode($contratosPorTipo->pluck('nombre')) !!};
            const labelsContratos = labelsContratosRaw.map(name => nameMap[name] || name);
            const dataContratos = {!! json_encode($contratosPorTipo->pluck('cantidad')) !!};

            new Chart(ctxContratos, {
                type: 'bar',
                data: {
                    labels: labelsContratos,
                    datasets: [{
                        label: 'Cant. Contratos',
                        data: dataContratos,
                        backgroundColor: gradientBlue,
                        borderRadius: 8,
                        maxBarThickness: 40
                    }]
                },
                options: {
                    ...baseConfig,
                    indexAxis: 'y',
                    scales: {
                        x: { grid: { display: false }, ticks: { font: { weight: '600' } } },
                        y: { grid: { display: false }, ticks: { font: { weight: '700' } } }
                    }
                }
            });

            // 2. Gráfica de Trabajadores POR UNIDAD (Pastel Dinámico)
            const ctxPie = document.getElementById('chartTrabajadores').getContext('2d');

            const labelsUnidades = {!! json_encode($trabajadoresPorUnidad->pluck('nombre')) !!};
            const dataUnidades = {!! json_encode($trabajadoresPorUnidad->pluck('cantidad')) !!};
            const colors = ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6', '#ec4899', '#64748b'];

            new Chart(ctxPie, {
                type: 'pie',
                data: {
                    labels: labelsUnidades,
                    datasets: [{
                        data: dataUnidades,
                        backgroundColor: colors.slice(0, dataUnidades.length),
                        borderWidth: 6,
                        borderColor: '#ffffff',
                        hoverOffset: 30,
                    }]
                },
                options: {
                    ...baseConfig,
                    layout: { padding: 25 },
                    plugins: {
                        ...baseConfig.plugins,
                        legend: {
                            ...baseConfig.plugins.legend,
                            position: 'right',
                            align: 'center'
                        }
                    }
                }
            });
        });
    </script>
    @endsection