@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        
        <!-- Header Profesional -->
        <div style="background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; border-radius: 8px; padding: 32px; margin-bottom: 32px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);">
            <h1 style="font-size: 36px; font-weight: bold; margin: 0;">Dashboard de Recursos Humanos</h1>
            <p style="color: #dbeafe; margin-top: 8px; font-size: 16px;">Gestión integral de contratos, alertas y trabajadores</p>
            <p style="color: #bfdbfe; font-size: 13px; margin-top: 8px;">Actualizado: {{ now()->format('d/m/Y H:i:s') }}</p>
        </div>

        <!-- Tarjetas de Estadísticas Principales (5 Cards) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 32px;">
            
            <!-- Card 1: Total Contratos -->
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; border-radius: 8px; padding: 24px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); transition: transform 0.3s;">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="color: #dbeafe; font-size: 12px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Total Contratos</p>
                        <p style="font-size: 42px; font-weight: bold; margin: 8px 0 0 0;">{{ $totalContratos ?? 0 }}</p>
                        <p style="color: #dbeafe; font-size: 12px; margin: 8px 0 0 0;">Activos en vigencia</p>
                    </div>
                    <div style="font-size: 40px;">📄</div>
                </div>
            </div>

            <!-- Card 2: Temporales (3 Meses) -->
            <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); color: white; border-radius: 8px; padding: 24px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="color: #fef3c7; font-size: 12px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Temporales (3M)</p>
                        <p style="font-size: 42px; font-weight: bold; margin: 8px 0 0 0;">{{ $contratosPor3Meses ?? 0 }}</p>
                        <p style="color: #fef3c7; font-size: 12px; margin: 8px 0 0 0;">Para renovar</p>
                    </div>
                    <div style="font-size: 40px;">🔄</div>
                </div>
            </div>

            <!-- Card 3: Indefinidos -->
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; border-radius: 8px; padding: 24px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="color: #d1fae5; font-size: 12px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Indefinidos</p>
                        <p style="font-size: 42px; font-weight: bold; margin: 8px 0 0 0;">{{ $contratosIndefinidos ?? 0 }}</p>
                        <p style="color: #d1fae5; font-size: 12px; margin: 8px 0 0 0;">Trabajadores estables</p>
                    </div>
                    <div style="font-size: 40px;">✓</div>
                </div>
            </div>

            <!-- Card 4: Practicantes -->
            <div style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); color: white; border-radius: 8px; padding: 24px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="color: #ede9fe; font-size: 12px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Practicantes</p>
                        <p style="font-size: 42px; font-weight: bold; margin: 8px 0 0 0;">{{ $practicantes ?? 0 }}</p>
                        <p style="color: #ede9fe; font-size: 12px; margin: 8px 0 0 0;">En formación</p>
                    </div>
                    <div style="font-size: 40px;">👨‍🎓</div>
                </div>
            </div>

            <!-- Card 5: Alertas Pendientes -->
            <div style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border-radius: 8px; padding: 24px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <div>
                        <p style="color: #fee2e2; font-size: 12px; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600;">Alertas Pendientes</p>
                        <p style="font-size: 42px; font-weight: bold; margin: 8px 0 0 0;">{{ $totalAlertas ?? 0 }}</p>
                        <p style="color: #fee2e2; font-size: 12px; margin: 8px 0 0 0;">Requieren atención</p>
                    </div>
                    <div style="font-size: 40px;">⚠️</div>
                </div>
            </div>
        </div>

        <!-- Grid: Próximos Vencimientos + Lista Negra -->
        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 24px; margin-bottom: 32px;">
            
            <!-- Próximos Vencimientos -->
            <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                <h2 style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #f59e0b; padding-bottom: 12px;">📅 Próximos Vencimientos (30 días)</h2>
                
                @if(isset($proximosVencimientos) && $proximosVencimientos->count() > 0)
                <div style="max-height: 400px; overflow-y: auto;">
                    @foreach($proximosVencimientos as $contrato)
                    <div style="border-left: 4px solid #f59e0b; background-color: #fffbeb; padding: 12px; border-radius: 6px; margin-bottom: 12px;">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                            <div style="flex: 1;">
                                <p style="font-weight: 600; color: #111827; margin: 0;">{{ $contrato->trabajador->nombre_completo ?? 'N/A' }}</p>
                                <p style="font-size: 12px; color: #6b7280; margin: 4px 0 0 0;">DNI: {{ $contrato->dni ?? 'N/A' }} | {{ $contrato->numero_contrato ?? 'N/A' }}</p>
                                <p style="font-size: 12px; color: #b45309; margin: 4px 0 0 0; font-weight: 500;">
                                    📅 Vence: {{ $contrato->fecha_fin ? $contrato->fecha_fin->format('d/m/Y') : 'N/A' }}
                                    @if($contrato->fecha_fin)
                                        ({{ now()->diffInDays($contrato->fecha_fin) }} días)
                                    @endif
                                </p>
                            </div>
                            <a href="{{ route('contratos.show', $contrato->id) }}" style="background-color: #f59e0b; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none; white-space: nowrap; margin-left: 8px;">
                                Ver →
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p style="color: #9ca3af; text-align: center; padding: 24px; margin: 0;">No hay vencimientos próximos</p>
                @endif
            </div>

            <!-- Lista Negra -->
            <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
                <h2 style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #ef4444; padding-bottom: 12px;">🚫 En Lista Negra</h2>
                
                <p style="font-size: 36px; font-weight: bold; color: #ef4444; margin: 0 0 16px 0;">{{ $totalEnListaNegra ?? 0 }}</p>
                
                @if(isset($enListaNegra) && $enListaNegra->count() > 0)
                <div style="max-height: 300px; overflow-y: auto;">
                    @foreach($enListaNegra as $registro)
                    <div style="background-color: #fee2e2; padding: 10px; border-radius: 6px; margin-bottom: 8px; border-left: 3px solid #ef4444;">
                        <p style="font-weight: 600; color: #991b1b; margin: 0;">{{ $registro->trabajador->nombre_completo ?? 'N/A' }}</p>
                        <p style="font-size: 12px; color: #7f1d1d; margin: 4px 0 0 0;">{{ $registro->dni ?? 'N/A' }}</p>
                    </div>
                    @endforeach
                </div>
                <a href="{{ route('lista-negra.index') }}" style="display: block; margin-top: 12px; background-color: #ef4444; color: white; padding: 10px; border-radius: 6px; text-align: center; font-weight: 600; font-size: 13px; text-decoration: none;">
                    Ver Lista Completa →
                </a>
                @else
                <p style="color: #9ca3af; text-align: center; padding: 24px; margin: 0;">No hay trabajadores en lista negra</p>
                @endif
            </div>
        </div>

        <!-- Alertas de Vencimiento -->
        <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
            <h2 style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #3b82f6; padding-bottom: 12px;">📋 Alertas de Vencimiento</h2>
            
            @if(isset($alertasVencimiento) && $alertasVencimiento->count() > 0)
            <div style="max-height: 300px; overflow-y: auto;">
                @foreach($alertasVencimiento as $alerta)
                <div style="border-left: 4px solid #3b82f6; background-color: #eff6ff; padding: 12px; border-radius: 6px; margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="flex: 1;">
                            <p style="font-weight: 600; color: #1e40af; margin: 0;">{{ $alerta->titulo ?? 'Alerta' }}</p>
                            <p style="font-size: 12px; color: #1e40af; margin: 4px 0 0 0;">{{ $alerta->descripcion ?? '' }}</p>
                        </div>
                        <a href="{{ route('alertas.show', $alerta->id) }}" style="background-color: #3b82f6; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none; white-space: nowrap; margin-left: 8px;">
                            Ver →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p style="color: #9ca3af; text-align: center; padding: 24px; margin: 0;">No hay alertas de vencimiento</p>
            @endif
        </div>

        <!-- Alertas de Estabilidad -->
        <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1); margin-bottom: 24px;">
            <h2 style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #ef4444; padding-bottom: 12px;">⚠️ Alertas de Estabilidad Laboral (5 años)</h2>
            
            @if(isset($alertasEstabilidad) && $alertasEstabilidad->count() > 0)
            <div style="max-height: 300px; overflow-y: auto;">
                @foreach($alertasEstabilidad as $alerta)
                <div style="border-left: 4px solid #ef4444; background-color: #fee2e2; padding: 12px; border-radius: 6px; margin-bottom: 12px;">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <div style="flex: 1;">
                            <p style="font-weight: 600; color: #7f1d1d; margin: 0;">{{ $alerta->titulo ?? 'Alerta' }}</p>
                            <p style="font-size: 12px; color: #991b1b; margin: 4px 0 0 0;">{{ $alerta->descripcion ?? '' }}</p>
                        </div>
                        <a href="{{ route('alertas.show', $alerta->id) }}" style="background-color: #ef4444; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none; white-space: nowrap; margin-left: 8px;">
                            Resolver →
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p style="color: #9ca3af; text-align: center; padding: 24px; margin: 0;">No hay alertas de estabilidad</p>
            @endif
        </div>

        <!-- Próximos a ser Estables -->
        <div style="background: white; border-radius: 8px; padding: 24px; box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);">
            <h2 style="font-size: 18px; font-weight: bold; color: #111827; margin: 0 0 16px 0; border-bottom: 2px solid #ec4899; padding-bottom: 12px;">⚠️ Próximos a ser Estables (5 años)</h2>
            
            @if(isset($proximosEstables) && count($proximosEstables) > 0)
            <div style="overflow-x: auto;">
                <table style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background-color: #f3f4f6;">
                            <th style="padding: 12px; text-align: left; font-weight: 600; color: #111827; border-bottom: 2px solid #d1d5db;">Trabajador</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #111827; border-bottom: 2px solid #d1d5db;">Meses Acum.</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #111827; border-bottom: 2px solid #d1d5db;">Meses Rest.</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #111827; border-bottom: 2px solid #d1d5db;">Porcentaje</th>
                            <th style="padding: 12px; text-align: center; font-weight: 600; color: #111827; border-bottom: 2px solid #d1d5db;">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($proximosEstables as $contrato)
                        <tr style="border-bottom: 1px solid #e5e7eb; background-color: {{ ($contrato->meses_restantes ?? 999) <= 6 ? '#fee2e2' : '#fef3c7' }};" onmouseover="this.style.backgroundColor='{{ ($contrato->meses_restantes ?? 999) <= 6 ? '#fecaca' : '#fde68a' }}';" onmouseout="this.style.backgroundColor='{{ ($contrato->meses_restantes ?? 999) <= 6 ? '#fee2e2' : '#fef3c7' }}';">
                            <td style="padding: 12px; color: #111827; font-weight: 500;">{{ $contrato->trabajador->nombre_completo ?? 'N/A' }}</td>
                            <td style="padding: 12px; text-align: center; color: #4b5563; font-weight: 600;">{{ $contrato->meses_acumulados ?? 0 }} m</td>
                            <td style="padding: 12px; text-align: center; color: #dc2626; font-weight: bold;">{{ $contrato->meses_restantes ?? 0 }} m</td>
                            <td style="padding: 12px; text-align: center;">
                                <div style="width: 80px; background-color: #e5e7eb; border-radius: 10px; height: 6px; overflow: hidden; margin: 0 auto;">
                                    @php
                                        $porcentaje = $contrato->meses_acumulados ? (($contrato->meses_acumulados / 60) * 100) : 0;
                                    @endphp
                                    <div style="background-color: #ec4899; height: 100%; width: {{ $porcentaje }}%;"></div>
                                </div>
                                <span style="font-size: 11px; color: #4b5563; display: block; margin-top: 4px;">{{ round($porcentaje) }}%</span>
                            </td>
                            <td style="padding: 12px; text-align: center;">
                                <a href="{{ route('contratos.show', $contrato->id) }}" style="background-color: #ec4899; color: white; padding: 6px 12px; border-radius: 4px; font-size: 12px; font-weight: 600; text-decoration: none;">
                                    Decidir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <p style="color: #9ca3af; text-align: center; padding: 24px; margin: 0;">No hay trabajadores próximos a ser estables</p>
            @endif
        </div>
    </div>
</div>
@endsection