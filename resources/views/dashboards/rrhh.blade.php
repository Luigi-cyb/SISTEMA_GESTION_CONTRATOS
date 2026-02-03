@extends('layouts.app')

@section('content')
    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4">

            <!-- Header Profesional -->
            <div
                style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; border-radius: 8px; padding: 32px; margin-bottom: 32px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: start;">
                    <div>
                        <h1 style="font-size: 36px; font-weight: bold; margin: 0;">Dashboard de Recursos Humanos</h1>
                        <p style="color: #dbeafe; margin-top: 8px; font-size: 16px;">Gestión integral de contratos, alertas
                            y trabajadores</p>
                        <p style="color: #bfdbfe; font-size: 13px; margin-top: 8px;">Actualizado:
                            {{ now()->format('d/m/Y H:i:s') }}</p>
                    </div>

                    @if(auth()->user()->hasRole('Admin') || auth()->user()->hasRole('RRHH'))
                        <form action="{{ route('alertas.generar') }}" method="POST" style="margin-left: 20px;">
                            @csrf
                            <button type="submit"
                                style="background-color: rgba(255, 255, 255, 0.2); border: 1px solid rgba(255,255,255,0.4); color: white; padding: 10px 16px; border-radius: 6px; font-weight: 600; font-size: 14px; cursor: pointer; display: flex; align-items: center; transition: background-color 0.2s;"
                                onmouseover="this.style.backgroundColor='rgba(255, 255, 255, 0.3)'"
                                onmouseout="this.style.backgroundColor='rgba(255, 255, 255, 0.2)'">
                                <svg style="width: 20px; height: 20px; margin-right: 8px;" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                                    </path>
                                </svg>
                                Actualizar Alertas Ahora
                            </button>
                        </form>
                    @endif
                </div>
            </div>

            <!-- Tarjetas de Estadísticas Principales (4 Cards) -->
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 32px;">

                <!-- Card 1: Total Contratos Activos -->
                <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="color: #dbeafe; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Total Contratos</p>
                            <p style="font-size: 36px; font-weight: 800; margin: 4px 0 0 0; line-height: 1;">{{ $totalContratos ?? 0 }}</p>
                            <p style="color: #bfdbfe; font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">Activos en vigencia</p>
                        </div>
                        <div style="background-color: rgba(255,255,255,0.2); padding: 10px; border-radius: 10px;">
                            <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Contratos Para Servicio Específico -->
                <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="color: #fef3c7; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Servicio Específico</p>
                            <p style="font-size: 36px; font-weight: 800; margin: 4px 0 0 0; line-height: 1;">{{ $contratosPor3Meses ?? 0 }}</p>
                            <p style="color: #fde68a; font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">Temporales</p>
                        </div>
                        <div style="background-color: rgba(255,255,255,0.2); padding: 10px; border-radius: 10px;">
                            <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Trabajadores Activos -->
                <div style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="color: #cffafe; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Trabajadores Activos</p>
                            <p style="font-size: 36px; font-weight: 800; margin: 4px 0 0 0; line-height: 1;">{{ $trabajadoresActivos ?? 0 }}</p>
                            <p style="color: #a5f3fc; font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">En el sistema</p>
                        </div>
                        <div style="background-color: rgba(255,255,255,0.2); padding: 10px; border-radius: 10px;">
                            <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Trabajadores Inactivos -->
                <div style="background: linear-gradient(135deg, #6b7280 0%, #4b5563 100%); color: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div style="display: flex; justify-content: space-between; align-items: start;">
                        <div>
                            <p style="color: #e5e7eb; font-size: 13px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Trabajadores Inactivos</p>
                            <p style="font-size: 36px; font-weight: 800; margin: 4px 0 0 0; line-height: 1;">{{ $trabajadoresInactivos ?? 0 }}</p>
                            <p style="color: #d1d5db; font-size: 13px; margin: 8px 0 0 0; font-weight: 500;">Desvinculados</p>
                        </div>
                        <div style="background-color: rgba(255,255,255,0.2); padding: 10px; border-radius: 10px;">
                            <svg style="width: 32px; height: 32px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRÁFICAS - CONTRATOS Y TRABAJADORES -->
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-bottom: 32px;">

                <!-- Gráfica: Contratos por Tipo -->
                <div
                    style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    <h2
                        style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #3b82f6; padding-bottom: 12px;">
                        📊 Contratos por Tipo</h2>
                    <canvas id="chartContratos" style="max-height: 300px;"></canvas>
                </div>

                <!-- Gráfica: Trabajadores Activos/Inactivos -->
                <div
                    style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                    <h2
                        style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #10b981; padding-bottom: 12px;">
                        👥 Estado de Trabajadores</h2>
                    <canvas id="chartTrabajadores" style="max-height: 300px;"></canvas>
                </div>
            </div>

            <!-- Grid: Próximos Vencimientos + Lista Negra -->
            <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 32px;">

                <!-- Próximos Vencimientos -->
                <div
                    style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 2px solid #f59e0b; padding-bottom: 12px;">
                        <h2 style="font-size: 18px; font-weight: 700; color: #111827; margin: 0;">📅 Próximos Vencimientos
                        </h2>
                        <span
                            style="background-color: #fffbeb; color: #b45309; font-size: 12px; font-weight: 600; padding: 4px 10px; border-radius: 9999px;">Próximos
                            30 días</span>
                    </div>

                    @if(isset($proximosVencimientos) && $proximosVencimientos->count() > 0)
                        <div style="max-height: 400px; overflow-y: auto; padding-right: 4px;">
                            @foreach($proximosVencimientos as $contrato)
                                @php
                                    $diasRestantes = $contrato->fecha_fin ? ceil(now()->diffInDays($contrato->fecha_fin, false)) : 0;
                                    $colorClass = $diasRestantes <= 7 ? '#ef4444' : ($diasRestantes <= 15 ? '#f59e0b' : '#3b82f6');
                                    $bgClass = $diasRestantes <= 7 ? '#fef2f2' : ($diasRestantes <= 15 ? '#fffbeb' : '#eff6ff');
                                @endphp
                                <div
                                    style="background-color: {{ $bgClass }}; border-left: 4px solid {{ $colorClass }}; padding: 16px; border-radius: 8px; margin-bottom: 12px; transition: transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                                        <div style="flex: 1;">
                                            <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                                <h3 style="font-size: 15px; font-weight: 600; color: #1f2937; margin: 0;">
                                                    {{ $contrato->trabajador->nombre_completo ?? 'N/A' }}</h3>
                                                @if($diasRestantes <= 7)
                                                    <span
                                                        style="background-color: #fee2e2; color: #991b1b; font-size: 10px; font-weight: 700; padding: 2px 6px; border-radius: 4px; margin-left: 8px; text-transform: uppercase;">Crítico</span>
                                                @endif
                                            </div>
                                            <p style="font-size: 13px; color: #4b5563; margin: 0 0 6px 0;">
                                                <span style="font-weight: 500;">DNI:</span> {{ $contrato->dni ?? 'N/A' }} • <span
                                                    style="font-weight: 500;">Contrato:</span>
                                                {{ $contrato->numero_contrato ?? 'N/A' }}
                                            </p>
                                            <div
                                                style="display: flex; align-items: center; font-size: 13px; font-weight: 500; color: {{ $colorClass }};">
                                                <svg style="width: 16px; height: 16px; margin-right: 6px;" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                Vence: {{ $contrato->fecha_fin ? $contrato->fecha_fin->format('d/m/Y') : 'N/A' }}
                                                <span style="margin-left: 6px; font-weight: 700;">({{ $diasRestantes }} días)</span>
                                            </div>
                                        </div>
                                        <div style="display: flex; flex-direction: column; gap: 8px; margin-left: 12px;">
                                            <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}"
                                                style="background-color: #10b981; color: white; padding: 6px 12px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; text-align: center; box-shadow: 0 1px 2px rgba(0,0,0,0.1); transition: background-color 0.2s;">
                                                🔄 Renovar
                                            </a>
                                            <a href="{{ route('contratos.show', $contrato->id) }}"
                                                style="background-color: white; color: #3b82f6; border: 1px solid #bfdbfe; padding: 5px 11px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; text-align: center; transition: all 0.2s;">
                                                Ver detalle
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div style="text-align: center; padding: 40px 0;">
                            <div
                                style="background-color: #ecfdf5; color: #059669; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                                <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                    </path>
                                </svg>
                            </div>
                            <p style="color: #6b7280; font-weight: 500; margin: 0;">¡Todo en orden!</p>
                            <p style="color: #9ca3af; font-size: 13px; margin: 4px 0 0 0;">No hay contratos próximos a vencer
                            </p>
                        </div>
                    @endif
                </div>

                <!-- Lista Negra -->
                <div
                    style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); height: fit-content;">
                    <h2
                        style="font-size: 18px; font-weight: 700; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #ef4444; padding-bottom: 12px; display: flex; align-items: center;">
                        <svg style="width: 20px; height: 20px; color: #ef4444; margin-right: 8px;" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        Lista Negra
                    </h2>

                    <div style="text-align: center; margin-bottom: 20px;">
                        <span
                            style="font-size: 48px; font-weight: 800; color: #ef4444; line-height: 1;">{{ $totalEnListaNegra ?? 0 }}</span>
                        <p
                            style="color: #9ca3af; font-size: 13px; margin: 4px 0 0 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">
                            Bloqueados</p>
                    </div>

                    @if(isset($enListaNegra) && $enListaNegra->count() > 0)
                        <div style="max-height: 300px; overflow-y: auto; margin-bottom: 16px;">
                            @foreach($enListaNegra as $registro)
                                <div
                                    style="background-color: #fef2f2; padding: 12px; border-radius: 8px; margin-bottom: 8px; border: 1px solid #fecaca; display: flex; align-items: center;">
                                    <div
                                        style="background-color: #fee2e2; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px; flex-shrink: 0;">
                                        <svg style="width: 16px; height: 16px; color: #ef4444;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <p style="font-weight: 600; color: #991b1b; margin: 0; font-size: 14px;">
                                            {{ $registro->trabajador->nombre_completo ?? 'N/A' }}</p>
                                        <p style="font-size: 11px; color: #7f1d1d; margin: 2px 0 0 0; font-family: monospace;">
                                            {{ $registro->dni ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <a href="{{ route('lista-negra.index') }}"
                            style="display: block; background-color: white; color: #ef4444; padding: 10px; border-radius: 6px; text-align: center; font-weight: 600; font-size: 13px; text-decoration: none; border: 1px solid #ef4444; transition: all 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            Ver Lista Completa
                        </a>
                    @else
                        <div style="text-align: center; padding: 12px; background-color: #f9fafb; border-radius: 8px;">
                            <p style="color: #6b7280; font-size: 13px; margin: 0;">No hay registros activos</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Alertas de Vencimiento -->
            <div
                style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); margin-bottom: 24px;">
                <h2
                    style="font-size: 18px; font-weight: 700; color: #111827; margin: 0 0 20px 0; border-bottom: 2px solid #3b82f6; padding-bottom: 12px; display: flex; align-items: center;">
                    <span style="background-color: #eff6ff; padding: 6px; border-radius: 6px; margin-right: 12px;">
                        <svg style="width: 24px; height: 24px; color: #3b82f6;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                            </path>
                        </svg>
                    </span>
                    Alertas de Vencimiento
                </h2>

                @if(isset($alertasVencimiento) && $alertasVencimiento->count() > 0)
                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 16px;">
                        @foreach($alertasVencimiento as $alerta)
                            <div
                                style="border: 1px solid #bfdbfe; background-color: #eff6ff; padding: 16px; border-radius: 8px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); display: flex; flex-direction: column;">
                                <div style="display: flex; align-items: start; margin-bottom: 12px;">
                                    <div style="background-color: #dbeafe; padding: 8px; border-radius: 50%; margin-right: 12px;">
                                        <svg style="width: 20px; height: 20px; color: #2563eb;" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 style="font-weight: 600; color: #1e40af; margin: 0 0 4px 0; font-size: 15px;">
                                            {{ $alerta->titulo ?? 'Alerta' }}</h4>
                                        <p style="font-size: 13px; color: #3b82f6; margin: 0; line-height: 1.4;">
                                            {{ Str::limit($alerta->descripcion, 100) }}</p>
                                    </div>
                                </div>
                                <div style="margin-top: auto; text-align: right;">
                                    <a href="{{ route('alertas.show', $alerta->id) }}"
                                        style="display: inline-flex; align-items: center; background-color: white; color: #2563eb; border: 1px solid #2563eb; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s;">
                                        Ver detalles <svg style="width: 12px; height: 12px; margin-left: 4px;" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        style="text-align: center; padding: 32px; background-color: #f9fafb; border-radius: 8px; border: 1px dashed #d1d5db;">
                        <p style="color: #6b7280; margin: 0;">No hay alertas de vencimiento pendientes</p>
                    </div>
                @endif
            </div>

            <!-- Alertas de Estabilidad -->
            <div
                style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); margin-bottom: 24px; border: 1px solid #fee2e2;">
                <h2
                    style="font-size: 18px; font-weight: 700; color: #991b1b; margin: 0 0 20px 0; border-bottom: 2px solid #ef4444; padding-bottom: 12px; display: flex; align-items: center;">
                    <span style="background-color: #fee2e2; padding: 6px; border-radius: 6px; margin-right: 12px;">
                        <svg style="width: 24px; height: 24px; color: #ef4444;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                    </span>
                    ⚠️ Alertas de Estabilidad Laboral (5 años)
                </h2>

                @if(isset($alertasEstabilidad) && $alertasEstabilidad->count() > 0)
                    <div style="display: flex; flex-direction: column; gap: 12px;">
                        @foreach($alertasEstabilidad as $alerta)
                            <div
                                style="border-left: 4px solid #ef4444; background-color: #fff1f2; padding: 16px; border-radius: 8px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                <div style="flex: 1; padding-right: 16px;">
                                    <div style="display: flex; align-items: center; margin-bottom: 4px;">
                                        <h4 style="font-weight: 700; color: #991b1b; margin: 0; font-size: 16px;">
                                            {{ $alerta->titulo ?? 'Alerta Crítica' }}</h4>
                                        <span
                                            style="background-color: #ef4444; color: white; font-size: 10px; font-weight: bold; padding: 2px 6px; border-radius: 4px; margin-left: 8px;">ACCIÓN
                                            REQUERIDA</span>
                                    </div>
                                    <p style="font-size: 14px; color: #7f1d1d; margin: 0;">{{ $alerta->descripcion ?? '' }}</p>
                                </div>
                                <a href="{{ route('alertas.show', $alerta->id) }}"
                                    style="background-color: #ef4444; color: white; padding: 8px 16px; border-radius: 6px; font-size: 13px; font-weight: 600; text-decoration: none; white-space: nowrap; box-shadow: 0 2px 4px rgba(239, 68, 68, 0.3); transition: background-color 0.2s;">
                                    Resolver Ahora
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div
                        style="text-align: center; padding: 32px; background-color: #fff1f2; border-radius: 8px; border: 1px dashed #fecaca;">
                        <p style="color: #991b1b; margin: 0; font-weight: 500;">Excelente: No hay alertas de estabilidad laboral
                            pendientes</p>
                    </div>
                @endif
            </div>

            <!-- Próximos a ser Estables -->
            <div
                style="background: white; border-radius: 12px; padding: 24px; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                <div
                    style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; border-bottom: 2px solid #ec4899; padding-bottom: 12px;">
                    <h2
                        style="font-size: 18px; font-weight: 700; color: #831843; margin: 0; display: flex; align-items: center;">
                        <span style="background-color: #fce7f3; padding: 6px; border-radius: 6px; margin-right: 12px;">
                            <svg style="width: 24px; height: 24px; color: #db2777;" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </span>
                        ⚠️ Próximos a ser Estables (5 años)
                    </h2>
                    <span
                        style="background-color: #fce7f3; color: #be185d; font-size: 12px; font-weight: 700; padding: 4px 10px; border-radius: 9999px;">
                        Acción Urgente
                    </span>
                </div>

                @if(isset($proximosEstables) && count($proximosEstables) > 0)
                    <div style="overflow-x: auto; border-radius: 8px; border: 1px solid #e5e7eb;">
                        <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                            <thead style="background-color: #f9fafb;">
                                <tr>
                                    <th
                                        style="padding: 16px; text-align: left; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                                        Trabajador</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                                        Meses Acum.</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                                        Meses Rest.</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                                        Progreso</th>
                                    <th
                                        style="padding: 16px; text-align: center; font-size: 12px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 1px solid #e5e7eb;">
                                        Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($proximosEstables as $contrato)
                                        @php
                                            $mesesRestantes = $contrato->meses_restantes ?? 999;
                                            $esCritico = $mesesRestantes <= 3;
                                            $bgClass = $esCritico ? '#fff1f2' : '#ffffff';
                                            $borderClass = $esCritico ? '#fecaca' : '#f3f4f6';
                                        @endphp
                                        <tr style="background-color: {{ $bgClass }}; transition: background-color 0.2s;">
                                            <td style="padding: 16px; border-bottom: 1px solid {{ $borderClass }};">
                                                <div style="font-weight: 600; color: #111827; font-size: 14px;">
                                                    {{ $contrato->trabajador->nombre_completo ?? 'N/A' }}</div>
                                                <div style="font-size: 12px; color: #6b7280; margin-top: 2px;">DNI:
                                                    {{ $contrato->dni ?? '-' }}</div>
                                            </td>
                                            <td style="padding: 16px; text-align: center; border-bottom: 1px solid {{ $borderClass }};">
                                                <span
                                                    style="background-color: #f3f4f6; color: #374151; padding: 4px 8px; border-radius: 4px; font-weight: 600; font-size: 13px;">
                                                    {{ $contrato->meses_acumulados ?? 0 }} m
                                                </span>
                                            </td>
                                            <td style="padding: 16px; text-align: center; border-bottom: 1px solid {{ $borderClass }};">
                                                <span
                                                    style="background-color: {{ $esCritico ? '#fee2e2' : '#fef3c7' }}; color: {{ $esCritico ? '#991b1b' : '#92400e' }}; padding: 4px 8px; border-radius: 4px; font-weight: 700; font-size: 13px;">
                                                    {{ $mesesRestantes }} m
                                                </span>
                                            </td>
                                            <td
                                                style="padding: 16px; text-align: center; border-bottom: 1px solid {{ $borderClass }}; width: 150px;">
                                                <div
                                                    style="width: 100%; background-color: #e5e7eb; border-radius: 9999px; height: 8px; overflow: hidden; box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);">
                                                    @php
                                                        $porcentaje = $contrato->meses_acumulados ? (($contrato->meses_acumulados / 60) * 100) : 0;
                                                        $colorBarra = $porcentaje > 90 ? '#db2777' : '#ec4899';
                                                    @endphp
                                    <div
                                                        style="background-color: {{ $colorBarra }}; height: 100%; width: {{ $porcentaje }}%; border-radius: 9999px;">
                                                    </div>
                                                </div>
                                                <span
                                                    style="font-size: 11px; color: #4b5563; font-weight: 600; display: block; margin-top: 6px;">
                                                    {{ round($porcentaje) }}% Estabilidad
                                                </span>
                                            </td>
                                            <td style="padding: 16px; text-align: center; border-bottom: 1px solid {{ $borderClass }};">
                                                <a href="{{ route('contratos.show', $contrato->id) }}"
                                                    style="background-color: #db2777; color: white; padding: 8px 16px; border-radius: 6px; font-size: 12px; font-weight: 600; text-decoration: none; box-shadow: 0 1px 2px rgba(0,0,0,0.1); transition: background-color 0.2s; white-space: nowrap;">
                                                    Ver / Decidir
                                                </a>
                                            </td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div
                        style="text-align: center; padding: 40px 0; background-color: #fdf2f8; border-radius: 8px; border: 1px dashed #fbcfe8;">
                        <div
                            style="background-color: #fce7f3; color: #db2777; width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px;">
                            <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <p style="color: #9d174d; font-weight: 600; margin: 0;">Excelente</p>
                        <p style="color: #be185d; font-size: 13px; margin: 4px 0 0 0;">No hay trabajadores próximos a cumplir 5
                            años</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Script Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Datos para gráfica de Contratos por tipo
        const datosContratos = {
            labels: ['Para servicio específico', 'Indefinido', 'Practicante', 'Otros'],
            datasets: [{
                label: 'Cantidad de Contratos',
                data: [
                            {{ Illuminate\Support\Facades\DB::table('contratos')->where('estado', 'Activo')->where('tipo_contrato', 'Para servicio específico')->count() }},
                            {{ Illuminate\Support\Facades\DB::table('contratos')->where('estado', 'Activo')->where('tipo_contrato', 'Indefinido')->count() }},
                            {{ Illuminate\Support\Facades\DB::table('contratos')->where('estado', 'Activo')->where('tipo_contrato', 'Practicante')->count() }},
                    {{ Illuminate\Support\Facades\DB::table('contratos')->where('estado', 'Activo')->whereNotIn('tipo_contrato', ['Para servicio específico', 'Indefinido', 'Practicante'])->count() }}
                ],
                backgroundColor: [
                    '#f59e0b', // Amber (Servicio Específico)
                    '#10b981', // Emerald (Indefinido - Estable)
                    '#8b5cf6', // Violet (Practicante)
                    '#3b82f6'  // Blue (Otros)
                ],
                borderWidth: 0,
                hoverOffset: 15
            }]
        };

        // Datos para gráfica de Trabajadores
        const datosTrabajadores = {
            labels: ['Activos', 'Inactivos'],
            datasets: [{
                label: 'Cantidad de Trabajadores',
                data: [{{ $trabajadoresActivos ?? 0 }}, {{ $trabajadoresInactivos ?? 0 }}],
                backgroundColor: [
                    '#06b6d4', // Cyan (Activos)
                    '#6b7280'  // Gray (Inactivos)
                ],
                borderWidth: 0,
                hoverOffset: 15
            }]
        };

        // Configuración para ambas gráficas
        const opciones = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'right', // Leyenda a la derecha para mejor uso del espacio
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: {
                            size: 13,
                            family: "'Inter', sans-serif"
                        }
                    }
                },
                tooltip: {
                    backgroundColor: 'rgba(17, 24, 39, 0.9)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    }
                }
            },
            layout: {
                padding: 20
            },
            cutout: '70%', // Dona más fina
            animation: {
                animateScale: true,
                animateRotate: true
            }
        };

        // Crear gráfica de Contratos
        const ctxContratos = document.getElementById('chartContratos').getContext('2d');
        new Chart(ctxContratos, {
            type: 'doughnut',
            data: datosContratos,
            options: opciones
        });

        // Crear gráfica de Trabajadores
        const ctxTrabajadores = document.getElementById('chartTrabajadores').getContext('2d');
        new Chart(ctxTrabajadores, {
            type: 'doughnut',
            data: datosTrabajadores,
            options: opciones
        });
    </script>

@endsection