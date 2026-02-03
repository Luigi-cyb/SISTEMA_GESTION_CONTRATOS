@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-6">
        <a href="{{ route('alertas.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">← Volver a Alertas</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-3">📋 Detalles de Alerta</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Panel principal (2 columnas) -->
        <div class="lg:col-span-2">
            <!-- Información de la Alerta -->
            <div class="bg-white rounded-lg shadow p-6 mb-6
                @if($alerta->prioridad === 'Crítica') border-t-4 border-red-500
                @elseif($alerta->prioridad === 'Alta') border-t-4 border-orange-500
                @elseif($alerta->prioridad === 'Media') border-t-4 border-yellow-500
                @else border-t-4 border-green-500 @endif">
                
                <!-- Encabezado de Alerta -->
                <div class="mb-6 pb-4 border-b border-gray-200">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $alerta->titulo }}</h2>
                            <p class="text-gray-600 mt-2">{{ $alerta->descripcion }}</p>
                        </div>
                        <div class="ml-4 text-right">
                            <!-- Tipo de Alerta -->
                            @if($alerta->tipo === 'Vencimiento de contrato')
                                <div class="text-4xl mb-2">📅</div>
                                <span class="inline-block bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Vencimiento de Contrato
                                </span>
                            @elseif($alerta->tipo === 'Cumpleaños')
                                <div class="text-4xl mb-2">🎂</div>
                                <span class="inline-block bg-pink-100 text-pink-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Cumpleaños
                                </span>
                            @elseif($alerta->tipo === 'Estabilidad laboral (5 años)')
                                <div class="text-4xl mb-2">⚠️</div>
                                <span class="inline-block bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Estabilidad Laboral
                                </span>
                            @else
                                <div class="text-4xl mb-2">ℹ️</div>
                                <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-semibold">
                                    Otra
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Estado y Prioridad -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- Estado -->
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Estado</p>
                        <div class="flex items-center gap-2">
                            @if($alerta->estado === 'Pendiente')
                                <span class="text-2xl">⏳</span>
                                <span class="text-lg font-bold text-red-600">PENDIENTE</span>
                            @elseif($alerta->estado === 'Leída')
                                <span class="text-2xl">👁️</span>
                                <span class="text-lg font-bold text-blue-600">LEÍDA</span>
                            @elseif($alerta->estado === 'Resuelta')
                                <span class="text-2xl">✅</span>
                                <span class="text-lg font-bold text-green-600">RESUELTA</span>
                            @else
                                <span class="text-2xl">📧</span>
                                <span class="text-lg font-bold text-purple-600">ENVIADA</span>
                            @endif
                        </div>
                    </div>

                    <!-- Prioridad -->
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Prioridad</p>
                        <div class="flex items-center gap-2">
                            @if($alerta->prioridad === 'Crítica')
                                <span class="text-2xl">🔴</span>
                                <span class="text-lg font-bold text-red-600">CRÍTICA</span>
                            @elseif($alerta->prioridad === 'Alta')
                                <span class="text-2xl">🟠</span>
                                <span class="text-lg font-bold text-orange-600">ALTA</span>
                            @elseif($alerta->prioridad === 'Media')
                                <span class="text-2xl">🟡</span>
                                <span class="text-lg font-bold text-yellow-600">MEDIA</span>
                            @else
                                <span class="text-2xl">🟢</span>
                                <span class="text-lg font-bold text-green-600">BAJA</span>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Información Detallada -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <!-- DNI del Trabajador -->
                    <div class="bg-blue-50 border border-blue-200 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">DNI del Trabajador</p>
                        <p class="text-2xl font-bold text-blue-600">{{ $alerta->dni }}</p>
                        @if($alerta->trabajador)
                        <p class="text-sm text-gray-700 mt-1">{{ $alerta->trabajador->nombre_completo }}</p>
                        @endif
                    </div>

                    <!-- Fecha de Alerta -->
                    <div class="bg-purple-50 border border-purple-200 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Fecha de Alerta</p>
                        <p class="text-lg font-bold text-purple-600">{{ $alerta->fecha_alerta->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-700 mt-1">{{ $alerta->fecha_alerta->format('H:i:s') }}</p>
                    </div>

                    <!-- Fecha del Evento -->
                    @if($alerta->fecha_vencimiento_evento)
                    <div class="bg-green-50 border border-green-200 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Fecha del Evento</p>
                        <p class="text-lg font-bold text-green-600">{{ Carbon\Carbon::parse($alerta->fecha_vencimiento_evento)->format('d/m/Y') }}</p>
                        <p class="text-sm text-gray-700 mt-1">
                            {{ Carbon\Carbon::parse($alerta->fecha_vencimiento_evento)->diffForHumans() }}
                        </p>
                    </div>
                    @endif

                    <!-- Destinatario -->
                    <div class="bg-gray-50 border border-gray-200 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Destinatario</p>
                        <p class="text-lg font-bold text-gray-900">
                            @if($alerta->destinatario === 'RRHH')
                                👔 RRHH
                            @elseif($alerta->destinatario === 'Bienestar')
                                ❤️ Bienestar
                            @elseif($alerta->destinatario === 'Gerencia')
                                👨‍💼 Gerencia
                            @else
                                👥 {{ $alerta->destinatario }}
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Medios de Notificación -->
                <div class="bg-gray-50 p-4 rounded mb-6">
                    <p class="text-gray-600 text-xs font-semibold uppercase mb-2">Medios de Notificación</p>
                    <div class="flex gap-2 flex-wrap">
                        @php
                            $medios = explode(',', $alerta->medio_notificacion);
                        @endphp
                        @foreach($medios as $medio)
                            @if(trim($medio) === 'Email')
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">📧 Email</span>
                            @elseif(trim($medio) === 'Sistema')
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-sm font-semibold">🔔 Sistema</span>
                            @elseif(trim($medio) === 'WhatsApp')
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">💬 WhatsApp</span>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Información del Contrato (si existe) -->
                @if($alerta->contrato)
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <h3 class="text-lg font-bold text-yellow-900 mb-3">📄 Información del Contrato Relacionado</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Número de Contrato</p>
                            <p class="text-gray-900 font-bold">{{ $alerta->contrato->numero_contrato }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Tipo de Contrato</p>
                            <p class="text-gray-900 font-bold">{{ $alerta->contrato->tipo_contrato }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Fecha Inicio</p>
                            <p class="text-gray-900 font-bold">{{ $alerta->contrato->fecha_inicio->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Fecha Fin</p>
                            <p class="text-gray-900 font-bold">{{ $alerta->contrato->fecha_fin->format('d/m/Y') }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Estado</p>
                            <p class="text-gray-900 font-bold">{{ $alerta->contrato->estado }}</p>
                        </div>
                        <div>
                            <p class="text-gray-600 text-xs font-semibold uppercase">Salario</p>
                            <p class="text-gray-900 font-bold">
                                @if($alerta->contrato->tipo_salario === 'Mensual')
                                    S/. {{ number_format($alerta->contrato->salario_mensual, 2) }}/mes
                                @elseif($alerta->contrato->tipo_salario === 'Jornal')
                                    S/. {{ number_format($alerta->contrato->salario_jornal, 2) }}/día
                                @else
                                    S/. {{ number_format($alerta->contrato->salario_mensual, 2) }}/mes
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Sidebar (1 columna) -->
        <div class="lg:col-span-1">
            <!-- Acciones -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">⚙️ Acciones</h3>
                
                <div class="space-y-3">
                    <!-- Resolver (si está pendiente) -->
                    @if($alerta->estado === 'Pendiente' && Auth::user()->hasPermissionTo('edit.alertas'))
                    <form action="{{ route('alertas.resolver', $alerta->id) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition">
                            ✅ Marcar como Resuelta
                        </button>
                    </form>
                    @elseif($alerta->estado === 'Resuelta')
                    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded text-sm">
                        <p class="font-semibold">✅ Alerta Resuelta</p>
                        <p class="text-xs mt-1">Esta alerta ya ha sido procesada</p>
                    </div>
                    @endif

                    <!-- Ver Contrato (si existe) -->
                    @if($alerta->contrato)
                    <a href="{{ route('contratos.show', $alerta->contrato->id) }}" 
                        class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded text-center transition">
                        📄 Ver Contrato
                    </a>
                    @endif

                    <!-- Ver Trabajador -->
                    @if($alerta->trabajador)
                    <a href="{{ route('trabajadores.show', $alerta->trabajador->dni) }}" 
                        class="block w-full bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded text-center transition">
                        👤 Ver Trabajador
                    </a>
                    @endif

                    <!-- Eliminar (admin) -->
                    @can('delete.alertas')
                    <form action="{{ route('alertas.destroy', $alerta->id) }}" method="POST" 
                        onsubmit="return confirm('¿Estás seguro de eliminar esta alerta?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            🗑️ Eliminar Alerta
                        </button>
                    </form>
                    @endcan

                    <!-- Volver -->
                    <a href="{{ route('alertas.index') }}" 
                        class="block w-full bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-center transition">
                        ← Volver
                    </a>
                </div>
            </div>

            <!-- Información de Estado -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="text-sm font-bold text-blue-900 mb-3">ℹ️ Información</h3>
                <ul class="text-xs text-blue-700 space-y-2">
                    <li>
                        <strong>ID de Alerta:</strong><br/>
                        <code class="text-xs bg-blue-100 px-1 rounded">{{ $alerta->id }}</code>
                    </li>
                    <li>
                        <strong>Creada:</strong><br/>
                        {{ $alerta->created_at->format('d/m/Y H:i:s') }}
                    </li>
                    <li>
                        <strong>Actualizada:</strong><br/>
                        {{ $alerta->updated_at->format('d/m/Y H:i:s') }}
                    </li>
                </ul>
            </div>

            <!-- Color Indicador -->
            <div class="bg-white rounded-lg shadow p-4 mt-6">
                <h3 class="text-sm font-bold text-gray-800 mb-3">🎨 Indicador Visual</h3>
                <div class="flex items-center gap-2">
                    @if($alerta->color_indicador === 'Rojo')
                        <div class="w-8 h-8 rounded-full bg-red-500"></div>
                        <span class="font-bold text-red-600">Rojo - Crítico</span>
                    @elseif($alerta->color_indicador === 'Amarillo')
                        <div class="w-8 h-8 rounded-full bg-yellow-500"></div>
                        <span class="font-bold text-yellow-600">Amarillo - Alerta</span>
                    @else
                        <div class="w-8 h-8 rounded-full bg-green-500"></div>
                        <span class="font-bold text-green-600">Verde - OK</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection