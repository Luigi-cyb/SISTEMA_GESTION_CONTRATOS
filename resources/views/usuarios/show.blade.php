@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('usuarios.index') }}" class="text-blue-600 hover:text-blue-900 font-medium mb-4 inline-block">
            ← Volver a Usuarios
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Detalle de Usuario</h1>
    </div>

    <!-- Información Principal -->
    <div class="bg-white rounded-lg shadow p-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <!-- Columna Izquierda -->
            <div>
                <h2 class="text-sm font-semibold text-gray-600 uppercase mb-4">Información Personal</h2>
                
                <div class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <p class="text-sm text-gray-600">Nombre Completo</p>
                        <p class="text-lg font-medium text-gray-900">{{ $usuario->name }}</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p class="text-lg font-medium text-gray-900">{{ $usuario->email }}</p>
                    </div>

                    <!-- ID -->
                    <div>
                        <p class="text-sm text-gray-600">ID de Usuario</p>
                        <p class="text-lg font-medium text-gray-900 font-mono">{{ $usuario->id }}</p>
                    </div>
                </div>
            </div>

            <!-- Columna Derecha -->
            <div>
                <h2 class="text-sm font-semibold text-gray-600 uppercase mb-4">Información del Sistema</h2>
                
                <div class="space-y-6">
                    <!-- Roles -->
                    <div>
                        <p class="text-sm text-gray-600 mb-3">Roles Asignados</p>
                        <div class="flex flex-wrap gap-2">
                            @forelse($usuario->roles as $role)
                                <span class="px-4 py-2 bg-blue-100 text-blue-800 rounded-full font-medium text-sm">
                                    {{ $role->name }}
                                </span>
                            @empty
                                <span class="text-gray-500">Sin roles asignados</span>
                            @endforelse
                        </div>
                    </div>

                    <!-- Fecha Creación -->
                    <div>
                        <p class="text-sm text-gray-600">Fecha de Creación</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $usuario->created_at->format('d/m/Y H:i:s') }}
                        </p>
                    </div>

                    <!-- Última Actualización -->
                    <div>
                        <p class="text-sm text-gray-600">Última Actualización</p>
                        <p class="text-lg font-medium text-gray-900">
                            {{ $usuario->updated_at->format('d/m/Y H:i:s') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Botones de Acción -->
    <div class="flex gap-4">
        @can('edit.usuarios')
        <a 
            href="{{ route('usuarios.edit', $usuario->id) }}" 
            class="px-6 py-3 bg-yellow-600 text-white font-medium rounded-lg hover:bg-yellow-700 transition"
        >
            ✏️ Editar
        </a>
        @endcan

        @can('delete.usuarios')
        @if($usuario->id !== auth()->id())
        <form 
            action="{{ route('usuarios.destroy', $usuario->id) }}" 
            method="POST" 
            class="inline"
            onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');"
        >
            @csrf
            @method('DELETE')
            <button 
                type="submit" 
                class="px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition"
            >
                🗑️ Eliminar
            </button>
        </form>
        @endif
        @endcan

        <a 
            href="{{ route('usuarios.index') }}" 
            class="px-6 py-3 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition"
        >
            ← Volver
        </a>
    </div>
</div>
@endsection