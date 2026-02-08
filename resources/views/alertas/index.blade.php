@extends('layouts.app')

@section('content')
    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Profesional -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <div style="background: #fffbeb; color: #d97706; padding: 12px; border-radius: 16px; margin-right: 20px; box-shadow: 0 4px 6px -1px rgba(217, 119, 6, 0.1);">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold text-gray-900">Centro de Alertas</h1>
                                <p class="text-sm font-semibold text-gray-500 mt-1">Gestión centralizada de notificaciones del sistema</p>
                            </div>
                        </div>
                        <div class="text-xs font-bold text-amber-600 bg-amber-50 px-3 py-2 rounded-md border border-amber-200 uppercase tracking-wider">
                            Monitoreo en tiempo real
                        </div>
                    </div>
                </div>
            </div>

            <!-- Estadísticas de Alertas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl border-l-4 border-red-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Críticas</p>
                    <p class="text-3xl font-black text-red-700 mt-2">{{ $totalCriticas }}</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-orange-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Altas</p>
                    <p class="text-3xl font-black text-orange-700 mt-2">{{ $totalAltas }}</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-yellow-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Pendientes</p>
                    <p class="text-3xl font-black text-yellow-700 mt-2">{{ $totalPendientes }}</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-green-600 shadow-sm border border-gray-100 p-6 hover:shadow-md transition-all duration-300">
                    <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">Resueltas</p>
                    <p class="text-3xl font-black text-green-700 mt-2">{{ $totalResueltas }}</p>
                </div>
            </div>

            <!-- Filtros Modernos -->
            <div class="bg-white shadow-sm sm:rounded-lg mb-8">
                <div class="p-6">
                    <form method="GET" action="{{ route('alertas.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Estado</label>
                            <select name="estado" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Todos los estados</option>
                                <option value="Pendiente" {{ request('estado') === 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                <option value="Leída" {{ request('estado') === 'Leída' ? 'selected' : '' }}>Leída</option>
                                <option value="Resuelta" {{ request('estado') === 'Resuelta' ? 'selected' : '' }}>Resuelta</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Prioridad</label>
                            <select name="prioridad" class="block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                                <option value="">Todas las prioridades</option>
                                <option value="Crítica" {{ request('prioridad') === 'Crítica' ? 'selected' : '' }}>Crítica</option>
                                <option value="Alta" {{ request('prioridad') === 'Alta' ? 'selected' : '' }}>Alta</option>
                                <option value="Media" {{ request('prioridad') === 'Media' ? 'selected' : '' }}>Media</option>
                                <option value="Baja" {{ request('prioridad') === 'Baja' ? 'selected' : '' }}>Baja</option>
                            </select>
                        </div>
                        <div class="md:col-span-2 flex items-end gap-3">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-blue-700 transition ease-in-out duration-150 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 8.293A1 1 0 013 7.586V4z"></path>
                                </svg>
                                Aplicar Filtros
                            </button>
                            <a href="{{ route('alertas.index') }}" class="flex-1 inline-flex items-center justify-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-bold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition ease-in-out duration-150 shadow-sm">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Lista de alertas -->
            <div class="space-y-4 mb-8">
                @forelse($alertas as $alerta)
                    <div class="group bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition-all duration-300 overflow-hidden border-l-4 
                        @if($alerta->prioridad === 'Crítica') border-l-red-600 
                        @elseif($alerta->prioridad === 'Alta') border-l-orange-500 
                        @elseif($alerta->prioridad === 'Media') border-l-yellow-400 
                        @else border-l-green-500 @endif">

                        <div class="p-5 flex items-start gap-5">
                            <!-- Icono Dinámico -->
                            <div class="flex-shrink-0">
                                <div class="p-3 rounded-xl 
                                    @if($alerta->prioridad === 'Crítica') bg-red-50 text-red-600 
                                    @elseif($alerta->prioridad === 'Alta') bg-orange-50 text-orange-600 
                                    @elseif($alerta->prioridad === 'Media') bg-yellow-50 text-yellow-600 
                                    @else bg-green-50 text-green-600 @endif transition-colors duration-300">

                                    @if($alerta->tipo === 'Vencimiento de contrato')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @elseif($alerta->tipo === 'Cumpleaños')
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-1.5-.454M21 12.742c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-1.5-.454M21 9.938c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-3 0 2.703 2.703 0 00-3 0 2.704 2.704 0 01-1.5-.454M16 5h1a1 1 0 011 1v3a1 1 0 01-1 1h-1a1 1 0 01-1-1V6a1 1 0 011-1zM8 5H7a1 1 0 00-1 1v3a1 1 0 001 1h1a1 1 0 001-1V6a1 1 0 00-1-1z"></path>
                                        </svg>
                                    @else
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    @endif
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between gap-4 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 truncate">{{ $alerta->titulo }}</h3>
                                    <div class="flex items-center gap-2">
                                        <!-- Estado Badge -->
                                        @if($alerta->estado === 'Pendiente')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200 uppercase tracking-tighter">
                                                Pendiente
                                            </span>
                                        @elseif($alerta->estado === 'Leída')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200 uppercase tracking-tighter">
                                                Leída
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200 uppercase tracking-tighter">
                                                Resuelta
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-600 text-sm leading-relaxed mb-4">{{ $alerta->descripcion }}</p>

                                <div class="flex flex-wrap items-center gap-y-2 gap-x-6">
                                    <div class="flex items-center text-xs font-semibold text-gray-500">
                                        <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $alerta->fecha_alerta->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="flex items-center text-xs font-semibold 
                                        @if($alerta->prioridad === 'Crítica') text-red-600 
                                        @elseif($alerta->prioridad === 'Alta') text-orange-600 
                                        @else text-gray-500 @endif">
                                        <span class="w-2 h-2 rounded-full mr-2 
                                            @if($alerta->prioridad === 'Crítica') bg-red-600 
                                            @elseif($alerta->prioridad === 'Alta') bg-orange-600 
                                            @elseif($alerta->prioridad === 'Media') bg-yellow-400 
                                            @else bg-green-500 @endif"></span>
                                        Prioridad {{ $alerta->prioridad }}
                                    </div>
                                    @if($alerta->destinatario)
                                        <div class="flex items-center text-xs font-semibold text-gray-500">
                                            <svg class="w-4 h-4 mr-1.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                            </svg>
                                            {{ $alerta->destinatario }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Acciones -->
                            <div class="flex flex-col gap-2">
                                <a href="{{ route('alertas.show', $alerta->id) }}" 
                                   class="inline-flex items-center justify-center p-2 text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-600 hover:text-white transition-all duration-200"
                                   title="Ver detalles">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                </a>

                                @if($alerta->estado !== 'Resuelta')
                                    <form action="{{ route('alertas.resolver', $alerta->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center p-2 text-green-600 bg-green-50 rounded-lg hover:bg-green-600 hover:text-white transition-all duration-200"
                                                title="Marcar como resuelta">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </form>
                                @endif

                                @can('delete.alertas')
                                    <form action="{{ route('alertas.destroy', $alerta->id) }}" method="POST"
                                        onsubmit="return confirm('¿Está seguro de eliminar esta alerta?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="inline-flex items-center justify-center p-2 text-red-600 bg-red-50 rounded-lg hover:bg-red-600 hover:text-white transition-all duration-200"
                                                title="Eliminar alerta">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-16 text-center">
                        <div class="inline-flex items-center justify-center p-4 bg-blue-50 text-blue-600 rounded-full mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">¡Todo al día!</h3>
                        <p class="text-gray-500">No tienes alertas pendientes de revisión en este momento.</p>
                    </div>
                @endforelse
            </div>

            <!-- Paginación -->
            @if($alertas->hasPages())
                <div class="bg-white px-4 py-3 border border-gray-100 rounded-xl shadow-sm sm:px-6">
                    {{ $alertas->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
