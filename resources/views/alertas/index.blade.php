@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🔔 Alertas y Notificaciones</h1>
        <p class="text-gray-600 mt-1">Gestión centralizada de todas tus alertas</p>
    </div>

    <!-- Mensajes -->
    @if ($message = Session::get('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ $message }}
    </div>
    @endif

    <!-- Filtros -->
    <div class="bg-white rounded-lg shadow p-4 mb-6">
        <form method="GET" action="{{ route('alertas.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Estado -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                <select name="estado" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todos</option>
                    <option value="Pendiente" {{ request('estado') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Leída" {{ request('estado') === 'Leída' ? 'selected' : '' }}>Leída</option>
                    <option value="Resuelta" {{ request('estado') === 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
                </select>
            </div>

            <!-- Prioridad -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Prioridad</label>
                <select name="prioridad" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">Todas</option>
                    <option value="Crítica" {{ request('prioridad') === 'Crítica' ? 'selected' : '' }}>🔴 Crítica</option>
                    <option value="Alta" {{ request('prioridad') === 'Alta' ? 'selected' : '' }}>🟠 Alta</option>
                    <option value="Media" {{ request('prioridad') === 'Media' ? 'selected' : '' }}>🟡 Media</option>
                    <option value="Baja" {{ request('prioridad') === 'Baja' ? 'selected' : '' }}>🟢 Baja</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="flex items-end gap-2">
                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    🔍 Filtrar
                </button>
                <a href="{{ route('alertas.index') }}" class="w-full bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded text-center">
                    Limpiar
                </a>
            </div>
        </form>
    </div>

    <!-- Resumen rápido -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-red-50 border-l-4 border-red-600 p-4 rounded">
            <p class="text-red-600 text-sm font-semibold">Críticas</p>
            <p class="text-3xl font-bold text-red-600">{{ $alertas->where('prioridad', 'Crítica')->count() }}</p>
        </div>
        <div class="bg-orange-50 border-l-4 border-orange-600 p-4 rounded">
            <p class="text-orange-600 text-sm font-semibold">Altas</p>
            <p class="text-3xl font-bold text-orange-600">{{ $alertas->where('prioridad', 'Alta')->count() }}</p>
        </div>
        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 rounded">
            <p class="text-yellow-600 text-sm font-semibold">Pendientes</p>
            <p class="text-3xl font-bold text-yellow-600">{{ $alertas->where('estado', 'Pendiente')->count() }}</p>
        </div>
        <div class="bg-green-50 border-l-4 border-green-600 p-4 rounded">
            <p class="text-green-600 text-sm font-semibold">Resueltas</p>
            <p class="text-3xl font-bold text-green-600">{{ $alertas->where('estado', 'Resuelta')->count() }}</p>
        </div>
    </div>

    <!-- Lista de alertas -->
    <div class="space-y-4">
        @if($alertas->count() > 0)
            @foreach($alertas as $alerta)
            <div class="bg-white rounded-lg shadow hover:shadow-lg transition border-l-4 
                @if($alerta->prioridad === 'Crítica') border-red-600
                @elseif($alerta->prioridad === 'Alta') border-orange-600
                @elseif($alerta->prioridad === 'Media') border-yellow-600
                @else border-green-600 @endif
                p-4">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <!-- Encabezado de alerta -->
                        <div class="flex items-center gap-2 mb-2">
                            <!-- Icono según tipo -->
                            @if($alerta->tipo === 'Vencimiento de contrato')
                                <span class="text-2xl">⏰</span>
                            @elseif($alerta->tipo === 'Cumpleaños')
                                <span class="text-2xl">🎂</span>
                            @elseif($alerta->tipo === 'Estabilidad laboral (5 años)')
                                <span class="text-2xl">⚠️</span>
                            @else
                                <span class="text-2xl">ℹ️</span>
                            @endif

                            <!-- Título -->
                            <h3 class="font-bold text-gray-800">{{ $alerta->titulo }}</h3>

                            <!-- Badge de estado -->
                            @if($alerta->estado === 'Pendiente')
                                <span class="ml-auto bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-xs font-semibold">Pendiente</span>
                            @elseif($alerta->estado === 'Leída')
                                <span class="ml-auto bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-semibold">Leída</span>
                            @else
                                <span class="ml-auto bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-semibold">Resuelta</span>
                            @endif
                        </div>

                        <!-- Descripción -->
                        <p class="text-gray-700 text-sm mb-2">{{ $alerta->descripcion }}</p>

                        <!-- Información de fecha -->
                        <div class="flex items-center gap-4 text-xs text-gray-600">
                            <span>📅 {{ $alerta->fecha_alerta->format('d/m/Y H:i') }}</span>
                            <span>
                                @if($alerta->prioridad === 'Crítica')
                                    🔴 Crítica
                                @elseif($alerta->prioridad === 'Alta')
                                    🟠 Alta
                                @elseif($alerta->prioridad === 'Media')
                                    🟡 Media
                                @else
                                    🟢 Baja
                                @endif
                            </span>
                            @if($alerta->destinatario)
                            <span>👤 {{ $alerta->destinatario }}</span>
                            @endif
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="flex gap-2 ml-4">
                        <a href="{{ route('alertas.show', $alerta->id) }}" class="text-blue-600 hover:text-blue-900 text-sm bg-blue-100 px-2 py-1 rounded">
                            Ver
                        </a>

                        @if($alerta->estado !== 'Resuelta')
                        <form action="{{ route('alertas.resolver', $alerta->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="text-green-600 hover:text-green-900 text-sm bg-green-100 px-2 py-1 rounded">
                                ✓ Resolver
                            </button>
                        </form>
                        @endif

                        @can('delete.alertas')
                        <form action="{{ route('alertas.destroy', $alerta->id) }}" method="POST" class="inline"
                            onsubmit="return confirm('¿Eliminar esta alerta?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 text-sm bg-red-100 px-2 py-1 rounded">
                                🗑️
                            </button>
                        </form>
                        @endcan
                    </div>
                </div>
            </div>
            @endforeach

            <!-- Paginación -->
            <div class="mt-6">
                {{ $alertas->links() }}
            </div>
        @else
            <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
                <p class="text-lg mb-2">✨ No hay alertas</p>
                <p class="text-sm">Tu bandeja de alertas está al día</p>
            </div>
        @endif
    </div>
</div>
@endsection