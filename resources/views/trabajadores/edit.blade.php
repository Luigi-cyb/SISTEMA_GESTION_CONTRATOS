@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="bg-white border-l-4 border-blue-600 shadow-lg sm:rounded-lg mb-8 overflow-hidden transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                            ✏️ Editar Trabajador
                        </h1>
                        <p class="mt-2 text-sm text-gray-600">
                            Modifique la información del trabajador con DNI: <span
                                class="font-bold text-blue-600">{{ $trabajador->dni }}</span>
                        </p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="h-16 w-16 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                            </path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <div class="bg-white shadow-xl sm:rounded-xl overflow-hidden">
                <form action="{{ route('trabajadores.update', $trabajador->dni) }}" method="POST"
                    enctype="multipart/form-data" class="divide-y divide-gray-100">
                    @csrf
                    @method('PATCH')

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                        <div class="p-6 bg-red-50 border-l-4 border-red-500">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm leading-5 font-medium text-red-800">
                                        Se encontraron errores de validación:
                                    </h3>
                                    <div class="mt-2 text-sm leading-5 text-red-700">
                                        <ul class="list-disc pl-5 space-y-1">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- SECCIÓN 1: Datos Personales -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Datos Personales</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- DNI (Solo lectura) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">DNI</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" value="{{ $trabajador->dni }}" disabled
                                        class="pl-10 block w-full rounded-lg border-gray-300 bg-gray-100 text-gray-500 shadow-sm sm:text-sm cursor-not-allowed">
                                </div>
                                <p class="text-xs text-gray-400 mt-1">El documento de identidad no se puede modificar.</p>
                            </div>

                            <!-- Nombre Completo -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo <span
                                        class="text-red-500">*</span></label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="nombre_completo" id="nombre_completo"
                                        value="{{ old('nombre_completo', $trabajador->nombre_completo) }}" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm uppercase @error('nombre_completo') border-red-500 @enderror">
                                </div>
                                <p class="text-xs text-blue-500 mt-1">Se convertirá a MAYÚSCULAS automáticamente</p>
                                @error('nombre_completo')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha de Nacimiento -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Nacimiento <span
                                        class="text-red-500">*</span></label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="date" name="fecha_nacimiento"
                                        value="{{ old('fecha_nacimiento', $trabajador->fecha_nacimiento?->format('Y-m-d')) }}"
                                        max="{{ date('Y-m-d') }}" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm @error('fecha_nacimiento') border-red-500 @enderror">
                                </div>
                                @error('fecha_nacimiento')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nacionalidad -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Nacionalidad</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="nacionalidad"
                                        value="{{ old('nacionalidad', $trabajador->nacionalidad) }}"
                                        placeholder="Ej: Peruana"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 2: Datos Laborales -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-green-100 rounded-lg text-green-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Información Laboral</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Cargo -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Cargo <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="cargo" id="cargo" value="{{ old('cargo', $trabajador->cargo) }}"
                                    placeholder="Ej: INGENIERO RESIDENTE" required
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 sm:text-sm uppercase @error('cargo') border-red-500 @enderror">
                                <p class="text-xs text-gray-400 mt-1">Sólo mayúsculas</p>
                                @error('cargo')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Área/Departamento -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Área /
                                    Departamento <span class="text-red-500">*</span></label>
                                <input type="text" name="area_departamento" id="area_departamento" required
                                    value="{{ old('area_departamento', $trabajador->area_departamento) }}"
                                    placeholder="Ej: OPERACIONES"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 sm:text-sm uppercase">
                            </div>

                            <!-- Unidad -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Unidad Minera <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <select name="unidad" id="unidad" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-green-500 focus:border-green-500 sm:text-sm rounded-lg shadow-sm transition duration-150 @error('unidad') border-red-500 @enderror">
                                        <option value="">-- Seleccione Unidad --</option>
                                        @foreach ($unidades as $uni)
                                            <option value="{{ $uni }}" {{ old('unidad', $trabajador->unidad) === $uni ? 'selected' : '' }}>
                                                {{ $uni }}
                                            </option>
                                        @endforeach
                                        <option value="Otra" {{ old('unidad') === 'Otra' ? 'selected' : '' }}>
                                            OTRA...
                                        </option>
                                    </select>
                                </div>
                                @error('unidad')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror

                                <!-- Input para 'Otra' unidad -->
                                <div id="div_unidad_personalizada"
                                    class="mt-3 {{ old('unidad') === 'Otra' ? '' : 'hidden' }} animate-fade-in-down">
                                    <label class="block text-xs font-semibold text-green-600 mb-1">Especifique la nueva
                                        unidad:</label>
                                    <div class="flex rounded-md shadow-sm">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-green-300 bg-green-50 text-gray-500 text-sm">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="unidad_personalizada" id="unidad_personalizada"
                                            value="{{ old('unidad_personalizada') }}" placeholder="Nombre de la unidad"
                                            class="flex-1 min-w-0 block w-full px-3 py-2 rounded-none rounded-r-md focus:ring-green-500 focus:border-green-500 sm:text-sm border-gray-300 uppercase">
                                    </div>
                                    @error('unidad_personalizada')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Fecha de Ingreso -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de Ingreso</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="date" name="fecha_ingreso"
                                        value="{{ old('fecha_ingreso', $trabajador->fecha_ingreso?->format('Y-m-d')) }}"
                                        max="{{ date('Y-m-d') }}"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 sm:text-sm @error('fecha_ingreso') border-red-500 @enderror">
                                </div>
                                @error('fecha_ingreso')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 3: Datos de Contacto -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-indigo-100 rounded-lg text-indigo-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Contacto y Residencia</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Teléfono -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono Personal</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">📞</span>
                                    </div>
                                    <input type="text" name="telefono" id="telefono" maxlength="9"
                                        value="{{ old('telefono', $trabajador->telefono) }}" placeholder="999888777"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm @error('telefono') border-red-500 @enderror">
                                </div>
                                @error('telefono')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Correo Electrónico</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email', $trabajador->email) }}"
                                        placeholder="ejemplo@correo.com"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm @error('email') border-red-500 @enderror">
                                </div>
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección de Domicilio <span
                                        class="text-red-500">*</span></label>
                                <textarea name="direccion_actual" rows="2" required
                                    placeholder="Av. Principal 123, Urbanización, Ciudad"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm">{{ old('direccion_actual', $trabajador->direccion_actual) }}</textarea>
                            </div>

                            <!-- Contacto de Emergencia -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Contacto de
                                    Emergencia</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="contacto_emergencia"
                                        value="{{ old('contacto_emergencia', $trabajador->contacto_emergencia) }}"
                                        placeholder="Nombre del familiar"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm">
                                </div>
                            </div>

                            <!-- Teléfono de Emergencia -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono de Emergencia</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">🆘</span>
                                    </div>
                                    <input type="text" name="telefono_emergencia" id="telefono_emergencia" maxlength="9"
                                        value="{{ old('telefono_emergencia', $trabajador->telefono_emergencia) }}"
                                        placeholder="999888777"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm @error('telefono_emergencia') border-red-500 @enderror">
                                </div>
                                @error('telefono_emergencia')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 4: Datos Bancarios -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-yellow-100 rounded-lg text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Datos Bancarios (Opcional)</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Número de Cuenta -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Número de Cuenta</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                            </path>
                                        </svg>
                                    </div>
                                    <input type="text" name="cuenta_bancaria" id="cuenta_bancaria" maxlength="20"
                                        value="{{ old('cuenta_bancaria', $trabajador->cuenta_bancaria) }}"
                                        placeholder="000-000000-00"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 transition duration-150 sm:text-sm">
                                </div>
                            </div>

                            <!-- CCI -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">CCI (Interbancario)</label>
                                <div class="relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                                        </svg>
                                    </div>
                                    <input type="text" name="cci" id="cci" maxlength="20"
                                        value="{{ old('cci', $trabajador->cci) }}" placeholder="002-000-00000000-00"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 transition duration-150 sm:text-sm @error('cci') border-red-500 @enderror">
                                </div>
                                @error('cci')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 5: Currículum Vitae -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-red-100 rounded-lg text-red-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Currículum Vitae</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                            <!-- Visualizador / Estado Actual -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Estado del CV</label>
                                @if ($trabajador->tieneCV())
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3 flex-1">
                                            <h3 class="text-sm font-medium text-blue-800">CV Cargado</h3>
                                            <div class="mt-2 text-sm text-blue-700">
                                                <p>{{ basename($trabajador->cv_path) }}</p>
                                            </div>
                                            <div class="mt-4 flex gap-2">
                                                <a href="{{ route('trabajadores.descargar-cv', $trabajador->dni) }}"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    Descargar
                                                </a>
                                                <button type="button" onclick="if(confirm('¿Estás seguro de que quieres eliminar este CV?')) { 
                                                                            fetch('{{ route('trabajadores.eliminar-cv', $trabajador->dni) }}', {
                                                                                method: 'DELETE',
                                                                                headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                                                                            }).then(response => {
                                                                                if(response.ok) location.reload();
                                                                                else alert('Error al eliminar');
                                                                            });
                                                                        }"
                                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                                    Eliminar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 flex items-center">
                                        <div class="flex-shrink-0">
                                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                            </svg>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-gray-800">No hay CV cargado</h3>
                                            <p class="text-xs text-gray-500 mt-1">Puede subir uno nuevo a la derecha.</p>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <!-- Cargador -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">
                                    {{ $trabajador->tieneCV() ? 'Actualizar Archivo' : 'Cargar PDF (Máx. 5MB)' }}
                                </label>
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 hover:bg-blue-50 transition-colors duration-200 group">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-blue-500 transition-colors duration-200"
                                            stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20m-8-8l-4-4m0 0l-4 4m4-4v12"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600 justify-center">
                                            <label for="cv"
                                                class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Haz clic para subir</span>
                                                <input id="cv" name="cv" type="file" accept=".pdf" class="sr-only"
                                                    @change="fileName = $event.target.files[0]?.name">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">o arrastra el archivo aquí</p>
                                    </div>
                                </div>
                                <div id="cvFileName" class="mt-2 text-sm text-gray-700 hidden text-center font-medium">
                                    📄 Archivo: <span id="cvName" class="text-blue-600"></span>
                                </div>
                                @error('cv')
                                    <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN 6: Estado -->
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                            <div class="p-2 bg-gray-200 rounded-lg text-gray-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4">
                                    </path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Estado del Trabajador</h2>
                        </div>

                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Defina el estado actual en el
                                sistema:</label>
                            <div class="max-w-xs">
                                <select name="estado" required
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm">
                                    <option value="Activo" {{ old('estado', $trabajador->estado) === 'Activo' ? 'selected' : '' }}>🟢 Activo
                                    </option>
                                    <option value="Inactivo" {{ old('estado', $trabajador->estado) === 'Inactivo' ? 'selected' : '' }}>🔴
                                        Inactivo</option>
                                    <option value="Suspendido" {{ old('estado', $trabajador->estado) === 'Suspendido' ? 'selected' : '' }}>🟠
                                        Suspendido</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-4">
                        <a href="{{ route('trabajadores.index') }}"
                            class="px-6 py-2.5 bg-white border border-gray-300 text-gray-700 font-medium rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="px-6 py-2.5 bg-gradient-to-r from-blue-600 to-blue-700 text-white font-bold rounded-lg shadow-md hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transform hover:scale-105 transition-all duration-200">
                            Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Script para validaciones y UI -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Conversión a Mayúsculas
            ['nombre_completo', 'cargo', 'area_departamento', 'unidad_personalizada'].forEach(id => {
                const el = document.getElementById(id);
                if (el) el.addEventListener('input', e => e.target.value = e.target.value.toUpperCase());
            });

            // Validación de Números (Teléfonos)
            ['telefono', 'telefono_emergencia'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', e => {
                        e.target.value = e.target.value.replace(/\D/g, '').slice(0, 9);
                    });
                }
            });

            // Validación de Cuentas (Solo números y guiones opcionales)
            ['cuenta_bancaria', 'cci'].forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    el.addEventListener('input', e => {
                        e.target.value = e.target.value.replace(/[^0-9-]/g, '').slice(0, 20);
                    });
                }
            });

            // Lógica de Unidad Personalizada
            const unidadSelect = document.getElementsByName('unidad')[0];
            const divPersonalizada = document.getElementById('div_unidad_personalizada');
            const inputPersonalizada = document.getElementById('unidad_personalizada');

            if (unidadSelect && divPersonalizada) {
                unidadSelect.addEventListener('change', function () {
                    if (this.value === 'Otra') {
                        divPersonalizada.classList.remove('hidden');
                        if (inputPersonalizada) inputPersonalizada.focus();
                    } else {
                        divPersonalizada.classList.add('hidden');
                    }
                });
            }

            // Mostrar nombre de archivo CV
            const cvInput = document.getElementById('cv');
            const cvInfo = document.getElementById('cvFileName');
            const cvName = document.getElementById('cvName');

            if (cvInput) {
                cvInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        cvName.textContent = this.files[0].name;
                        cvInfo.classList.remove('hidden');
                    } else {
                        cvInfo.classList.add('hidden');
                    }
                });
            }
        });
    </script>
@endsection