@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div
                class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6 border-l-4 border-emerald-600 transform hover:scale-[1.01] transition-transform duration-300">
                <div class="p-6 flex items-center">
                    <div class="p-3 rounded-full bg-emerald-50 mr-4">
                        <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800 tracking-tight">Regalo por Cumpleaños</h1>
                        <p class="text-gray-600 text-sm mt-1">Registrar la entrega de la giftcard o presente para el
                            colaborador</p>
                    </div>
                </div>
            </div>

            <!-- Formulario Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">

                    <!-- Sección 1: Datos del Trabajador (Lectura) -->
                    <div class="mb-10 pb-8 border-b border-gray-100">
                        <div class="flex items-center mb-6">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-800">Datos del Beneficiario</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-100">
                            <div>
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Nombre Completo
                                </p>
                                <p class="text-lg font-bold text-gray-900">{{ $cumpleaños->trabajador->nombre_completo }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">DNI</p>
                                <p class="text-lg font-bold text-gray-900 tracking-tighter">
                                    {{ $cumpleaños->trabajador->dni }}
                                </p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Cargo</p>
                                <p class="text-md font-semibold text-gray-700">{{ $cumpleaños->trabajador->cargo }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-black text-gray-400 uppercase tracking-widest mb-1">Fecha de
                                    Cumpleaños</p>
                                <p class="text-md font-bold text-emerald-600">
                                    {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('d \d\e F') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario de Registro -->
                    <form action="{{ route('cumpleaños.registrar-giftcard', $cumpleaños->id) }}" method="POST">
                        @csrf

                        <div class="space-y-8">
                            <div class="flex items-center">
                                <div
                                    class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-600 mr-3">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-xl font-bold text-gray-800">Detalles de la Entrega</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Fecha de Entrega -->
                                <div class="space-y-2">
                                    <label for="fecha_entrega_giftcard" class="block text-sm font-bold text-gray-700">
                                        Fecha de Entrega <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                        </div>
                                        <input type="date" name="fecha_entrega_giftcard" id="fecha_entrega_giftcard"
                                            value="{{ old('fecha_entrega_giftcard', now()->format('Y-m-d')) }}"
                                            class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 py-2.5 font-semibold text-gray-700"
                                            required>
                                    </div>
                                    @error('fecha_entrega_giftcard')
                                        <p class="text-red-500 text-xs mt-1 italic font-medium">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Monto -->
                                <div class="space-y-2">
                                    <label for="monto_giftcard" class="block text-sm font-bold text-gray-700">
                                        Monto del Regalo (S/) <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500 font-bold text-lg">S/</span>
                                        </div>
                                        <input type="number" name="monto_giftcard" id="monto_giftcard" step="0.01" min="0"
                                            value="{{ old('monto_giftcard', '100.00') }}"
                                            class="pl-10 w-full rounded-lg border-gray-300 shadow-sm focus:ring-emerald-500 focus:border-emerald-500 transition-all duration-200 py-2.5 font-bold text-gray-800 text-lg"
                                            required>
                                    </div>
                                    @error('monto_giftcard')
                                        <p class="text-red-500 text-xs mt-1 italic font-medium">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Nota Informativa Estilo Contratos -->
                            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-md shadow-sm mt-6">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <svg class="h-5 w-5 text-amber-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <div class="ml-3">
                                        <h3 class="text-sm font-bold text-amber-800 tracking-tight">Información de Auditoría
                                        </h3>
                                        <div class="mt-1 text-sm text-amber-700 font-medium">
                                            <p>Esta acción registrará su usuario
                                                <strong>({{ auth()->user()->name }})</strong> como el responsable de la
                                                entrega física del presente.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="flex items-center justify-end gap-4 pt-8 border-t border-gray-100 mt-10">
                                <a href="{{ route('cumpleaños.show', $cumpleaños->id) }}"
                                    class="inline-flex items-center px-6 py-3 border border-gray-300 shadow-sm text-sm font-bold rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-all duration-200 uppercase tracking-widest">
                                    Cancelar
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-3 border border-transparent shadow-lg text-sm font-bold rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105 uppercase tracking-widest">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Registrar Entrega
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection