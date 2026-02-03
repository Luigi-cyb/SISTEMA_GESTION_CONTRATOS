@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-8 sm:py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-1 h-10 bg-blue-600 rounded-full"></div>
                <h1 class="text-3xl font-bold text-gray-900">Configuración de la Empresa</h1>
            </div>
            <p class="text-sm text-gray-600 ml-4">Configura los datos que aparecerán en los contratos generados</p>
        </div>

        <!-- Mensajes de éxito/error -->
        @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded">
            <p class="font-medium">{{ session('success') }}</p>
        </div>
        @endif

        @if (session('error'))
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded">
            <p class="font-medium">{{ session('error') }}</p>
        </div>
        @endif

        <!-- Contenedor Principal -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            
            <!-- Información Actual -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 border-b border-gray-200 px-6 sm:px-8 py-6">
                <h2 class="text-xs font-bold text-gray-600 uppercase tracking-widest mb-4">Información Actual</h2>
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Razón Social</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $configuracion->razon_social }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-medium text-gray-600 mb-1">Gerente General</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $configuracion->gerenteNombreCompleto() }}</p>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <form action="{{ route('configuracion-empresa.update') }}" method="POST" class="divide-y divide-gray-200">
                @csrf
                @method('PUT')

                <!-- Errores de Validación -->
                @if ($errors->any())
                <div class="px-6 sm:px-8 py-4 bg-red-50 border-l-4 border-red-500">
                    <p class="text-sm font-semibold text-red-900 mb-2">Se encontraron errores:</p>
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-800">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- SECCIÓN: Datos de la Empresa -->
                <div class="px-6 sm:px-8 py-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6">Datos de la Empresa</h3>
                    <div class="space-y-6">
                        
                        <!-- Razón Social -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Razón Social *</label>
                            <input type="text" name="razon_social" value="{{ old('razon_social', $configuracion->razon_social) }}" required
                                   maxlength="255"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('razon_social') border-red-500 ring-red-500 @enderror">
                            @error('razon_social')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- RUC y Dirección -->
                        <div class="grid grid-cols-2 gap-6">
                            <!-- RUC -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">RUC *</label>
                                <input type="text" name="ruc" value="{{ old('ruc', $configuracion->ruc) }}" required
                                       maxlength="11" pattern="[0-9]{11}"
                                       placeholder="20489418691"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('ruc') border-red-500 ring-red-500 @enderror">
                                @error('ruc')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Debe tener 11 dígitos</p>
                            </div>
                        </div>

                        <!-- Dirección -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección Completa *</label>
                            <textarea name="direccion" required rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('direccion') border-red-500 ring-red-500 @enderror">{{ old('direccion', $configuracion->direccion) }}</textarea>
                            @error('direccion')
                            <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN: Datos del Gerente General -->
                <div class="px-6 sm:px-8 py-8">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide mb-6">Datos del Gerente General</h3>
                    <div class="space-y-6">
                        
                        <!-- Título y Nombre -->
                        <div class="grid grid-cols-4 gap-6">
                            <!-- Título -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Título</label>
                                <input type="text" name="gerente_titulo" value="{{ old('gerente_titulo', $configuracion->gerente_titulo) }}"
                                       maxlength="50" placeholder="Ing."
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                                <p class="mt-1 text-xs text-gray-500">Opcional</p>
                            </div>

                            <!-- Nombre Completo -->
                            <div class="col-span-3">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo *</label>
                                <input type="text" name="gerente_nombre" value="{{ old('gerente_nombre', $configuracion->gerente_nombre) }}" required
                                       maxlength="255"
                                       placeholder="APELLIDOS Y NOMBRES"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('gerente_nombre') border-red-500 ring-red-500 @enderror">
                                @error('gerente_nombre')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- DNI -->
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">DNI *</label>
                                <input type="text" name="gerente_dni" value="{{ old('gerente_dni', $configuracion->gerente_dni) }}" required
                                       maxlength="8" pattern="[0-9]{8}"
                                       placeholder="10158128"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-white text-gray-900 text-sm font-medium focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition @error('gerente_dni') border-red-500 ring-red-500 @enderror">
                                @error('gerente_dni')
                                <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">Debe tener 8 dígitos</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de Auditoría -->
                @if($configuracion->updated_at)
                <div class="px-6 sm:px-8 py-6 bg-gray-50 border-t border-gray-200">
                    <p class="text-xs text-gray-600">
                        <strong>Última actualización:</strong> 
                        {{ $configuracion->updated_at->format('d/m/Y H:i') }}
                        @if($configuracion->updatedBy)
                            por <strong>{{ $configuracion->updatedBy->name }}</strong>
                        @endif
                    </p>
                </div>
                @endif

                <!-- Botones -->
                <div class="px-6 sm:px-8 py-8 bg-gray-50 flex flex-col sm:flex-row gap-4 sm:gap-3">
                    <button type="submit" class="flex-1 sm:flex-none px-8 py-3 bg-blue-600 hover:bg-blue-700 active:bg-blue-800 text-white font-semibold text-sm rounded-lg transition duration-200 shadow-sm hover:shadow-md">
                        💾 Guardar Cambios
                    </button>
                    <a href="{{ route('dashboard') }}" class="flex-1 sm:flex-none px-8 py-3 bg-gray-300 hover:bg-gray-400 active:bg-gray-500 text-gray-900 font-semibold text-sm rounded-lg transition duration-200 text-center">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>

        <!-- Advertencia -->
        <div class="mt-6 bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        <strong>Importante:</strong> Los cambios se aplicarán automáticamente a todos los contratos nuevos que se generen. Los contratos ya generados no se verán afectados.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection