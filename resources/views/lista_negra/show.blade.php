@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-6">
        <a href="{{ route('lista-negra.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">← Volver a Lista Negra</a>
        <h1 class="text-3xl font-bold text-gray-800 mt-3">📋 Detalles de Registro en Lista Negra</h1>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Panel principal (2 columnas) -->
        <div class="lg:col-span-2">
            <!-- Información del Trabajador -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">👤 Información del Trabajador</h2>
                
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">DNI</p>
                        <p class="text-gray-900 text-lg font-bold">{{ $listaNegra->dni }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Nombre Completo</p>
                        <p class="text-gray-900 text-lg font-bold">{{ $listaNegra->trabajador->nombre_completo ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Cargo</p>
                        <p class="text-gray-900">{{ $listaNegra->trabajador->cargo ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Departamento</p>
                        <p class="text-gray-900">{{ $listaNegra->trabajador->departamento ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Unidad</p>
                        <p class="text-gray-900">{{ $listaNegra->trabajador->unidad ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Teléfono</p>
                        <p class="text-gray-900">{{ $listaNegra->trabajador->telefono ?? 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded col-span-2">
                        <p class="text-gray-600 text-xs font-semibold uppercase">Email</p>
                        <p class="text-gray-900">{{ $listaNegra->trabajador->email ?? 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Información del Bloqueo -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">🚫 Información del Bloqueo</h2>
                
                <!-- Tipo de Bloqueo -->
                <div class="mb-6">
                    <p class="text-gray-600 text-sm font-semibold mb-2">Tipo de Bloqueo</p>
                    <div>
                        @if($listaNegra->motivo === 'Leve')
                            <div class="inline-block bg-yellow-100 border-2 border-yellow-400 text-yellow-800 px-4 py-2 rounded-full font-bold">
                                🟡 LEVE - Puede ser desbloqueado
                            </div>
                        @else
                            <div class="inline-block bg-red-100 border-2 border-red-400 text-red-800 px-4 py-2 rounded-full font-bold">
                                🔴 GRAVE - No puede ser desbloqueado
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Estado Actual -->
                <div class="mb-6">
                    <p class="text-gray-600 text-sm font-semibold mb-2">Estado Actual</p>
                    <div>
                        @if($listaNegra->estado === 'Bloqueado')
                            <div class="inline-block bg-red-100 border-2 border-red-400 text-red-800 px-4 py-2 rounded-full font-bold">
                                🔒 BLOQUEADO - ACTIVO
                            </div>
                        @else
                            <div class="inline-block bg-green-100 border-2 border-green-400 text-green-800 px-4 py-2 rounded-full font-bold">
                                ✅ DESBLOQUEADO
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Motivo del Bloqueo -->
                <div class="mb-6">
                    <p class="text-gray-600 text-sm font-semibold mb-2">Descripción del Motivo</p>
                    <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded">
                        <p class="text-gray-800 leading-relaxed">{{ $listaNegra->descripcion_motivo }}</p>
                    </div>
                </div>

                <!-- Información de Bloqueo -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Fecha de Bloqueo</p>
                        <p class="text-gray-900 font-bold">{{ $listaNegra->fecha_bloqueo->format('d/m/Y') }}</p>
                        <p class="text-gray-600 text-sm">{{ $listaNegra->fecha_bloqueo->format('H:i') }} hs</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Bloqueado por</p>
                        <p class="text-gray-900 font-bold">{{ $listaNegra->bloqueadoPor->name ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">{{ $listaNegra->bloqueadoPor->email ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Documento del Informe -->
                @if($listaNegra->url_informe_escaneado)
                <div class="bg-blue-50 border border-blue-200 p-4 rounded">
                    <p class="text-gray-600 text-sm font-semibold mb-2">📄 Documento del Informe</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h6a1 1 0 01.707.293l6 6a1 1 0 01.293.707v8a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                            </svg>
                            <span class="text-blue-600 font-semibold">{{ basename($listaNegra->url_informe_escaneado) }}</span>
                        </div>
                        <a href="{{ Storage::url($listaNegra->url_informe_escaneado) }}" target="_blank" class="text-blue-600 hover:text-blue-800 font-semibold text-sm bg-blue-100 px-3 py-1 rounded">
                            👁️ Ver
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Información de Desbloqueo (si aplica) -->
            @if($listaNegra->estado === 'Desbloqueado' && $listaNegra->motivo === 'Leve')
            <div class="bg-green-50 border-2 border-green-300 rounded-lg shadow p-6 mb-6">
                <h2 class="text-2xl font-bold text-green-800 mb-4">🔓 Información de Desbloqueo</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="bg-white p-4 rounded border border-green-200">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Fecha de Desbloqueo</p>
                        @if($listaNegra->fecha_desbloqueo)
                            <p class="text-gray-900 font-bold">{{ $listaNegra->fecha_desbloqueo->format('d/m/Y') }}</p>
                            <p class="text-gray-600 text-sm">{{ $listaNegra->fecha_desbloqueo->format('H:i') }} hs</p>
                        @else
                            <p class="text-gray-500">N/A</p>
                        @endif
                    </div>
                    <div class="bg-white p-4 rounded border border-green-200">
                        <p class="text-gray-600 text-xs font-semibold uppercase mb-1">Desbloqueado por</p>
                        <p class="text-gray-900 font-bold">{{ $listaNegra->desbloqueadoPor->name ?? 'N/A' }}</p>
                        <p class="text-gray-600 text-sm">{{ $listaNegra->desbloqueadoPor->email ?? 'N/A' }}</p>
                    </div>
                </div>

                <!-- Carta de Compromiso -->
                @if($listaNegra->url_carta_compromiso)
                <div class="bg-white p-4 rounded border border-green-200">
                    <p class="text-gray-600 text-sm font-semibold mb-2">📄 Carta de Compromiso</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M4 4a2 2 0 012-2h6a1 1 0 01.707.293l6 6a1 1 0 01.293.707v8a2 2 0 01-2 2H6a2 2 0 01-2-2V4z"></path>
                            </svg>
                            <span class="text-green-600 font-semibold">{{ basename($listaNegra->url_carta_compromiso) }}</span>
                        </div>
                        <a href="{{ Storage::url($listaNegra->url_carta_compromiso) }}" target="_blank" class="text-green-600 hover:text-green-800 font-semibold text-sm bg-green-100 px-3 py-1 rounded">
                            👁️ Ver
                        </a>
                    </div>
                </div>
                @endif
            </div>
            @endif
        </div>

        <!-- Sidebar (1 columna) -->
        <div class="lg:col-span-1">
            <!-- Estado Actual -->
            <div class="bg-white rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">⚙️ Acciones</h3>
                
                <div class="space-y-3">
                    <!-- Desbloquear (solo si LEVE y bloqueado) -->
                    @if($listaNegra->estado === 'Bloqueado' && $listaNegra->motivo === 'Leve' && Auth::user()->hasPermissionTo('desbloquear.lista_negra'))
                    <a href="{{ route('lista-negra.desbloquear-form', $listaNegra->id) }}" 
                        class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded text-center transition">
                        🔓 Desbloquear Trabajador
                    </a>
                    @elseif($listaNegra->estado === 'Bloqueado' && $listaNegra->motivo === 'Grave')
                    <div class="bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded text-sm">
                        <p class="font-semibold">⛔ No se puede desbloquear</p>
                        <p class="text-xs mt-1">Este bloqueo es GRAVE y permanente</p>
                    </div>
                    @elseif($listaNegra->estado === 'Desbloqueado')
                    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded text-sm">
                        <p class="font-semibold">✅ Ya desbloqueado</p>
                        <p class="text-xs mt-1">Este trabajador puede contratar nuevamente</p>
                    </div>
                    @endif

                    <!-- Eliminar (admin) -->
                    @can('delete.lista_negra')
                    <form action="{{ route('lista-negra.destroy', $listaNegra->id) }}" method="POST" 
                        onsubmit="return confirm('¿Estás seguro de eliminar este registro? Esta acción no se puede deshacer.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition">
                            🗑️ Eliminar Registro
                        </button>
                    </form>
                    @endcan

                    <!-- Volver -->
                    <a href="{{ route('lista-negra.index') }}" class="block w-full bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-center transition">
                        ← Volver
                    </a>
                </div>
            </div>

            <!-- Resumen -->
            <div class="bg-gray-50 rounded-lg shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">📊 Resumen</h3>
                
                <div class="space-y-3">
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">Tipo</p>
                        <p class="text-gray-900 font-bold">
                            @if($listaNegra->motivo === 'Leve')
                                🟡 LEVE
                            @else
                                🔴 GRAVE
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">Estado</p>
                        <p class="text-gray-900 font-bold">
                            @if($listaNegra->estado === 'Bloqueado')
                                🔒 BLOQUEADO
                            @else
                                ✅ DESBLOQUEADO
                            @endif
                        </p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">Días Bloqueado</p>
                        <p class="text-gray-900 font-bold">
                            @php
                                // CORRECCIÓN: usar floor() para redondear hacia abajo y eliminar decimales
                                $dias = floor($listaNegra->fecha_bloqueo->diffInDays(now()));
                            @endphp
                            @if($dias == 0)
                                Hoy
                            @else
                                {{ $dias }} {{ $dias == 1 ? 'día' : 'días' }}
                            @endif
                        </p>
                    </div>
                    @if($listaNegra->estado === 'Desbloqueado' && $listaNegra->fecha_desbloqueo)
                    <div>
                        <p class="text-gray-600 text-xs font-semibold uppercase">Duración del Bloqueo</p>
                        <p class="text-gray-900 font-bold">{{ floor($listaNegra->fecha_bloqueo->diffInDays($listaNegra->fecha_desbloqueo)) }} días</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Información de Seguridad -->
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                <p class="text-xs font-bold text-blue-800 mb-2">ℹ️ Información</p>
                <ul class="text-xs text-blue-700 space-y-2">
                    @if($listaNegra->estado === 'Bloqueado')
                        <li>✓ Trabajador actualmente bloqueado</li>
                        <li>✓ No se puede crear contrato nuevo</li>
                        @if($listaNegra->motivo === 'Leve')
                            <li>✓ Puede ser desbloqueado</li>
                        @else
                            <li>✓ Bloqueo permanente</li>
                        @endif
                    @else
                        <li>✓ Trabajador desbloqueado</li>
                        <li>✓ Puede contratar nuevamente</li>
                        @if($listaNegra->fecha_desbloqueo)
                            <li>✓ Desbloqueado el {{ $listaNegra->fecha_desbloqueo->format('d/m/Y') }}</li>
                        @endif
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection