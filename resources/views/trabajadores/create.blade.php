@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white border-l-4 border-blue-600 shadow-lg sm:rounded-lg mb-8 overflow-hidden">
                <div class="p-8 flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                            <span class="text-blue-600 mr-2">
                                <svg class="w-8 h-8 inline-block mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                                    </path>
                                </svg>
                            </span>
                            Nuevo Trabajador
                        </h1>
                        <p class="text-gray-500 mt-2 text-lg">Complete la información para dar de alta al personal en el
                            sistema.</p>
                    </div>
                </div>
            </div>

            <!-- Formulario -->
            <div class="bg-white shadow-xl sm:rounded-xl overflow-hidden">
                <form action="{{ route('trabajadores.store') }}" method="POST" enctype="multipart/form-data"
                    class="divide-y divide-gray-100">
                    @csrf

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                        <div class="bg-red-50 p-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Se encontraron errores de validación</h3>
                                    <div class="mt-2 text-sm text-red-700">
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

                    <div class="p-8 space-y-10">

                        <!-- SECCIÓN 1: Datos Básicos -->
                        <section>
                            <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                                <div class="p-2 bg-blue-100 rounded-lg text-blue-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .667.333 1 1 1v1m2-2h2">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Identificación y Datos Personales</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- DNI -->
                                <!-- DNI -->
                                <div class="relative">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">DNI <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm flex">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none z-10">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0c0 .667.333 1 1 1v1m2-2h2">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="text" name="dni" id="dni" maxlength="8"
                                            value="{{ old('dni') }}" placeholder="Ingrese DNI" required
                                            class="pl-10 block w-full rounded-l-lg rounded-r-none border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm @error('dni') border-red-500 @enderror">
                                        <button type="button" id="btn-buscar-dni"
                                            class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 shadow-sm text-sm font-medium rounded-r-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    <p id="dni-helper" class="text-xs text-gray-500 mt-1">Ingrese 8 dígitos y presione la lupa.</p>
                                    @error('dni')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Nombre Completo -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nombre Completo <span
                                            class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input type="text" name="nombre_completo" id="nombre_completo"
                                            value="{{ old('nombre_completo') }}" placeholder="APELLIDOS Y NOMBRES" required
                                            class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm uppercase @error('nombre_completo') border-red-500 @enderror">
                                    </div>
                                    <p class="text-xs text-gray-400 mt-1">Se convertirá a MAYÚSCULAS automáticamente</p>
                                    @error('nombre_completo')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Fecha de Nacimiento -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Fecha de
                                        Nacimiento <span class="text-red-500">*</span></label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}"
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
                                        <input type="text" name="nacionalidad" value="{{ old('nacionalidad', 'Peruana') }}"
                                            placeholder="Ej: Peruana"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 transition duration-150 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!-- SECCIÓN 2: Datos Laborales -->
                        <section>
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
                                    <input type="text" name="cargo" id="cargo" value="{{ old('cargo') }}"
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
                                        value="{{ old('area_departamento') }}" placeholder="Ej: OPERACIONES"
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
                                            @foreach($unidades as $u)
                                                <option value="{{ $u }}" {{ old('unidad') === $u ? 'selected' : '' }}>{{ $u }}</option>
                                            @endforeach
                                            <option value="Otra" {{ old('unidad') === 'Otra' ? 'selected' : '' }}>OTRA...</option>
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
                                        <input type="date" name="fecha_ingreso" value="{{ old('fecha_ingreso') }}"
                                            max="{{ date('Y-m-d') }}"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500 transition duration-150 sm:text-sm @error('fecha_ingreso') border-red-500 @enderror">
                                    </div>
                                    @error('fecha_ingreso')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <!-- SECCIÓN 3: Datos de Contacto -->
                        <section>
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
                                            value="{{ old('telefono') }}" placeholder="999888777"
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
                                        <input type="email" name="email" value="{{ old('email') }}"
                                            placeholder="ejemplo@correo.com"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm @error('email') border-red-500 @enderror">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Dirección -->
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Dirección de
                                        Domicilio <span class="text-red-500">*</span></label>
                                    <textarea name="direccion_actual" rows="2" required
                                        placeholder="Av. Principal 123, Urbanización, Ciudad"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm">{{ old('direccion_actual') }}</textarea>
                                </div>

                                <!-- Contacto de Emergencia -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Contacto de
                                        Emergencia</label>
                                    <input type="text" name="contacto_emergencia" value="{{ old('contacto_emergencia') }}"
                                        placeholder="Nombre del familiar"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm">
                                </div>

                                <!-- Teléfono de Emergencia -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Teléfono de
                                        Emergencia</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 sm:text-sm">🆘</span>
                                        </div>
                                        <input type="text" name="telefono_emergencia" id="telefono_emergencia" maxlength="9"
                                            value="{{ old('telefono_emergencia') }}" placeholder="999888777"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition duration-150 sm:text-sm @error('telefono_emergencia') border-red-500 @enderror">
                                    </div>
                                    @error('telefono_emergencia')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <!-- SECCIÓN 4: Datos Bancarios -->
                        <section>
                            <div class="flex items-center gap-3 mb-6 pb-2 border-b border-gray-100">
                                <div class="p-2 bg-yellow-100 rounded-lg text-yellow-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Datos Bancarios <span
                                        class="text-sm font-normal text-gray-500 ml-2">(Opcional)</span></h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Cuenta Bancaria -->
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
                                            value="{{ old('cuenta_bancaria') }}" placeholder="000-000000-00"
                                            class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 transition duration-150 sm:text-sm">
                                    </div>
                                </div>

                                <!-- CCI -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">CCI
                                        (Interbancario)</label>
                                    <input type="text" name="cci" id="cci" maxlength="20" value="{{ old('cci') }}"
                                        placeholder="002-000-00000000-00"
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 transition duration-150 sm:text-sm @error('cci') border-red-500 @enderror">
                                    @error('cci')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>

                        <!-- SECCIÓN 4.1: Currículum Vitae -->
                        <section class="bg-gray-50 p-6 rounded-xl border border-dashed border-gray-300">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="p-2 bg-red-100 rounded-lg text-red-600">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Currículum Vitae</h2>
                            </div>

                            <div class="mt-2">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Cargar PDF (Máx. 5MB)</label>
                                <div class="flex items-center justify-center w-full">
                                    <label for="cv"
                                        class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 hover:border-blue-400 transition">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <p class="mb-2 text-sm text-gray-500"><span
                                                    class="font-semibold text-blue-600">Haz clic para subir</span> o
                                                arrastra el archivo</p>
                                            <p class="text-xs text-gray-500">PDF (Max. 5MB)</p>
                                        </div>
                                        <input type="file" name="cv" id="cv" accept=".pdf" class="hidden" />
                                    </label>
                                </div>

                                <!-- Nombre del archivo seleccionado -->
                                <div id="cvFileName"
                                    class="mt-3 p-3 bg-green-50 border border-green-200 rounded-md text-sm text-green-700 hidden flex items-center">
                                    <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p><strong>Archivo seleccionado:</strong> <span id="cvName"></span></p>
                                </div>

                                @error('cv')
                                    <p class="text-red-500 text-xs mt-2 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </section>

                        <!-- SECCIÓN 5: Estado -->
                        <section class="bg-gray-100 p-6 rounded-xl">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                                <div>
                                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                                        <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        Estado Inicial
                                    </h2>
                                    <p class="text-sm text-gray-500 mt-1">Defina el estado con el que el trabajador
                                        ingresará al sistema.</p>
                                </div>
                                <div>
                                    <select name="estado" required
                                        class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-500 focus:ring-gray-500 py-3 sm:text-base @error('estado') border-red-500 @enderror">
                                        <option value="">-- Selecciona un estado --</option>
                                        <option value="Activo" {{ old('estado') === 'Activo' ? 'selected' : '' }}>Activo
                                        </option>
                                        <option value="Inactivo" {{ old('estado') === 'Inactivo' ? 'selected' : '' }}>Inactivo
                                        </option>
                                        <option value="Suspendido" {{ old('estado') === 'Suspendido' ? 'selected' : '' }}>
                                            Suspendido</option>
                                    </select>
                                    @error('estado')
                                        <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- Footer / Botones -->
                    <div class="px-8 py-6 bg-gray-50 border-t border-gray-100 flex justify-end gap-4">
                        <a href="{{ route('trabajadores.index') }}"
                            class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            Cancelar
                        </a>
                        <button type="submit"
                            class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
                            <svg class="h-5 w-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                                </path>
                            </svg>
                            Guardar Trabajador
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JavaScript para interactividad y validaciones UX -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // 1. Manejo de archivo CV
            const cvInput = document.getElementById('cv');
            const cvFileName = document.getElementById('cvFileName');
            const cvName = document.getElementById('cvName');

            if (cvInput) {
                cvInput.addEventListener('change', function () {
                    if (this.files && this.files[0]) {
                        cvName.textContent = this.files[0].name;
                        cvFileName.classList.remove('hidden');
                    } else {
                        cvFileName.classList.add('hidden');
                    }
                });
            }

            // 2. Manejo de Unidad Personalizada (Select -> Input)
            const unidadSelect = document.getElementById('unidad');
            const divPersonalizada = document.getElementById('div_unidad_personalizada');
            const inputPersonalizada = document.getElementById('unidad_personalizada');

            if (unidadSelect && divPersonalizada) {
                unidadSelect.addEventListener('change', function () {
                    if (this.value === 'Otra') {
                        divPersonalizada.classList.remove('hidden');
                        if (inputPersonalizada) inputPersonalizada.focus();
                    } else {
                        divPersonalizada.classList.add('hidden');
                        if (inputPersonalizada) inputPersonalizada.value = ''; // Limpiar si oculta
                    }
                });
                // Trigger inicial por si hay un error y vuelve con 'Otra' seleccionado
                if (unidadSelect.value === 'Otra') {
                    divPersonalizada.classList.remove('hidden');
                }
            }

            // 3. Conversión automática a Mayúsculas
            const camposMayusculas = ['nombre_completo', 'cargo', 'area_departamento', 'unidad_personalizada', 'direccion_actual'];
            camposMayusculas.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener('input', function () {
                        this.value = this.value.toUpperCase();
                    });
                }
            });

            // 4. Validación solo números para DNI y Teléfonos
            const camposNumeros = ['dni', 'telefono', 'telefono_emergencia', 'cuenta_bancaria', 'cci'];
            camposNumeros.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.addEventListener('input', function () {
                        this.value = this.value.replace(/[^0-9]/g, '');
                    });
                }
            });

            // 5. Búsqueda de DNI (Integración API)
            const btnBuscarDni = document.getElementById('btn-buscar-dni');
            const inputDni = document.getElementById('dni');
            const inputNombre = document.getElementById('nombre_completo');
            const inputNacionalidad = document.getElementsByName('nacionalidad')[0];
            const dniHelper = document.getElementById('dni-helper');

            if (btnBuscarDni) {
                btnBuscarDni.addEventListener('click', async function () {
                    const dni = inputDni.value;

                    if (dni.length !== 8) {
                        alert('Por favor ingrese un DNI válido de 8 dígitos.');
                        return;
                    }

                    // Estado Loading
                    const originalContent = btnBuscarDni.innerHTML;
                    btnBuscarDni.innerHTML = '<svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';
                    btnBuscarDni.disabled = true;

                    try {
                        const response = await fetch(`/api/consultar-dni/${dni}`);
                        const data = await response.json();
                        console.log('Datos API:', data); // DEBUG: Ver qué datos llegan realmente

                        if (data.success) {
                            // Éxito: Rellenar datos
                            inputNombre.value = data.data.nombre_completo;
                            if (inputNacionalidad) inputNacionalidad.value = data.data.nacionalidad;

                            // Intentar rellenar dirección si existe
                            const inputDireccion = document.getElementsByName('direccion_actual')[0];
                            if (inputDireccion && data.data.direccion) {
                                inputDireccion.value = data.data.direccion;
                            }

                            // Intentar rellenar Fecha de Nacimiento
                            const inputFechaNac = document.getElementsByName('fecha_nacimiento')[0];
                            if (inputFechaNac && data.data.fecha_nacimiento) {
                                inputFechaNac.value = data.data.fecha_nacimiento;
                            }

                            // Visual feedback
                            dniHelper.textContent = '✓ Datos encontrados';
                            dniHelper.classList.remove('text-gray-500', 'text-red-500');
                            dniHelper.classList.add('text-green-600', 'font-bold');
                        } else {
                            // Error o Mensaje Demo
                            alert(data.message || 'No se encontraron datos para este DNI.');
                            dniHelper.textContent = 'No se encontraron datos.';
                            dniHelper.classList.add('text-red-500');
                        }

                    } catch (error) {
                        console.error('Error:', error);
                        alert('Error al consultar el servicio. Verifique su conexión.');
                    } finally {
                        // Restaurar botón
                        btnBuscarDni.innerHTML = originalContent;
                        btnBuscarDni.disabled = false;
                    }
                });
            }
        });
    </script>
@endsection