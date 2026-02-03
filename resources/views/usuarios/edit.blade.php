@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <!-- Header -->
    <div class="mb-8">
        <a href="{{ route('usuarios.index') }}" class="text-blue-600 hover:text-blue-900 font-medium mb-4 inline-block">
            ← Volver a Usuarios
        </a>
        <h1 class="text-3xl font-bold text-gray-900">Editar Usuario</h1>
    </div>

    <!-- Formulario -->
    <div class="bg-white rounded-lg shadow p-8">
        <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Nombre -->
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre Completo</label>
                <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    value="{{ old('name', $usuario->name) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('name') border-red-500 @enderror"
                    placeholder="Juan García"
                >
                @error('name')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $usuario->email) }}"
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('email') border-red-500 @enderror"
                    placeholder="juan@example.com"
                >
                @error('email')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Contraseña (opcional) -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Nueva Contraseña (dejar vacío para no cambiar)</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent @error('password') border-red-500 @enderror"
                    placeholder="Mínimo 8 caracteres"
                >
                @error('password')
                <span class="text-red-600 text-sm mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Contraseña</label>
                <input 
                    type="password" 
                    id="password_confirmation" 
                    name="password_confirmation"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-600 focus:border-transparent"
                    placeholder="Confirma tu contraseña"
                >
            </div>

            <!-- Roles -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-3">Asignar Roles</label>
                <div class="space-y-3">
                    @foreach($roles as $role)
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="role_{{ $role->id }}" 
                            name="roles[]" 
                            value="{{ $role->id }}"
                            {{ in_array($role->id, old('roles', $usuarioRoles)) ? 'checked' : '' }}
                            class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-600"
                        >
                        <label for="role_{{ $role->id }}" class="ml-3 text-sm text-gray-700 cursor-pointer">
                            {{ $role->name }}
                        </label>
                    </div>
                    @endforeach
                </div>
                @error('roles')
                <span class="text-red-600 text-sm mt-2 block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Botones -->
            <div class="flex gap-4 pt-6">
                <button 
                    type="submit" 
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition flex-1"
                >
                    Actualizar Usuario
                </button>
                <a 
                    href="{{ route('usuarios.index') }}" 
                    class="px-6 py-3 bg-gray-300 text-gray-800 font-medium rounded-lg hover:bg-gray-400 transition"
                >
                    Cancelar
                </a>
            </div>
        </form>
    </div>
</div>
@endsection