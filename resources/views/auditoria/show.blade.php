@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('auditoria.index') }}" class="text-blue-600 hover:text-blue-900 font-medium mb-4 inline-block">
            ← Volver a Auditoría
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Detalle de Acción</h1>
    </div>

    <!-- Información Principal -->
    <div class="bg-white rounded-lg shadow p-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Columna Izquierda -->
            <div>
                <h2 class="text-sm font-semibold text-gray-600 uppercase mb-4">Información General</h2>
                
                <div class="space-y-4">
                    <!-- Fecha -->
                    <div>
                        <p class="text-sm text-gray-600">Fecha y Hora</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $auditoria->fecha->format('d/m/Y H:i:s') }}
                        </p>
                    </div>

                    <!-- Usuario -->
                    <div>
                        <p class="text-sm text-gray-600">Usuario</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $auditoria->user->name ?? 'Sistema' }}
                        </p>
                        <p class="text-sm text-gray-500">
                            Email: {{ $auditoria->user->email ?? '-' }}
                        </p>
                    </div>

                    <!-- Acción -->
                    <div>
                        <p class="text-sm text-gray-600">Acción</p>
                        <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium text-sm mt-1">
                            {{ $auditoria->accion }}
                        </span>
                    </div>

                    <!-- IP Address -->
                    <div>
                        <p class="text-sm text-gray-600">Dirección IP</p>
                        <p class="text-lg font-medium text-gray-900 font-mono">
                            {{ $auditoria->ip_address ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div>
                <h2 class="text-sm font-semibold text-gray-600 uppercase mb-4">Objeto Afectado</h2>
                
                <div class="space-y-4">
                    <!-- Modelo -->
                    <div>
                        <p class="text-sm text-gray-600">Módulo</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $auditoria->modelo ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- ID del Objeto -->
                    <div>
                        <p class="text-sm text-gray-600">ID del Registro</p>
                        <p class="text-lg font-medium text-gray-900 font-mono">
                            {{ $auditoria->modelo_id ?? 'N/A' }}
                        </p>
                    </div>

                    <!-- Referencia -->
                    <div>
                        <p class="text-sm text-gray-600">Referencia</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $auditoria->modelo }} #{{ $auditoria->modelo_id ?? '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detalles de Cambios -->
    @if($auditoria->detalles)
    <div class="bg-white rounded-lg shadow p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Detalles del Cambio</h2>
        
        <div class="bg-gray-50 rounded-lg p-6 font-mono text-sm overflow-x-auto">
            <pre class="whitespace-pre-wrap break-words text-gray-800">{{ json_encode($auditoria->detalles, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
    </div>
    @else
    <div class="bg-white rounded-lg shadow p-8">
        <p class="text-gray-500 text-center">No hay detalles disponibles para esta acción</p>
    </div>
    @endif

    <!-- Botón Volver -->
    <div class="mt-8">
        <a 
            href="{{ route('auditoria.index') }}" 
            class="px-6 py-3 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition inline-block"
        >
            ← Volver
        </a>
    </div>
</div>
@endsection