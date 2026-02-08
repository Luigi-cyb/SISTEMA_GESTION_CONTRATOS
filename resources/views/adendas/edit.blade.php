@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6border-l-4 border-amber-600">
                    <div class="p-6 flex items-center">
                        <div class="p-3 rounded-full bg-amber-50 mr-4">
                            <svg class="w-8 h-8 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Editar Adenda</h1>
                            <p class="text-gray-600 text-sm mt-1">
                                Adenda: <span
                                    class="font-mono font-medium text-gray-900 bg-gray-100 px-2 py-0.5 rounded">{{ $adenda->numero_adenda_contrato }}</span>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contenedor Principal -->
                <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">

                    <!-- Información General (Solo lectura) -->
                    <div class="bg-gray-50 border-b border-gray-100 p-6 sm:px-8">
                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 mr-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h2 class="text-lg font-bold text-gray-700">Información de Referencia</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Trabajador</p>
                                <div class="flex items-center">
                                    <div
                                        class="bg-blue-100 text-blue-800 font-bold rounded-full w-8 h-8 flex items-center justify-center mr-3 text-xs">
                                        {{ substr($adenda->trabajador->nombres ?? 'T', 0, 1) }}{{ substr($adenda->trabajador->apellidos ?? 'W', 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-gray-900">{{ $adenda->trabajador->nombre_completo }}</p>
                                        <p class="text-xs text-gray-500">DNI: {{ $adenda->trabajador->dni }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Contrato N°</p>
                                    <p class="text-sm font-semibold text-gray-700">{{ $adenda->contrato->numero_contrato }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Antigüedad</p>
                                    <p class="text-sm font-semibold text-gray-700">{{ $adenda->tiempo_acumulado_total_meses }} meses</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Formulario -->
                    <form action="{{ route('adendas.update', $adenda->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="p-8 space-y-10">

                            <!-- Errores de Validación -->
                            @if ($errors->any())
                                <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded shadow-sm">
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
                                            <h3 class="text-sm font-medium text-red-800">Se encontraron errores</h3>
                                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- SECCIÓN: Vigencia -->
                            <div class="pb-8 border-b border-gray-100">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600 mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Vigencia de la Adenda</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                    <!-- Fecha Inicio -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Inicio *</label>
                                        <input type="date" name="fecha_inicio" id="fecha_inicio"
                                            value="{{ old('fecha_inicio', $adenda->fecha_inicio?->format('Y-m-d')) }}"
                                            required
                                            class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                    </div>

                                    <!-- Fecha Fin -->
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Fin *</label>
                                        <input type="date" name="fecha_fin"
                                            value="{{ old('fecha_fin', $adenda->fecha_fin?->format('Y-m-d')) }}" required
                                            class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                    </div>

                                    <!-- Fecha de Firma -->
                                    <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de Firma *</label>
                                        <div class="flex items-center gap-4">
                                            <div class="flex-grow">
                                                <input type="date" name="fecha_firma" id="fecha_firma"
                                                    value="{{ old('fecha_firma', $adenda->fecha_firma?->format('Y-m-d')) }}"
                                                    required
                                                    class="block w-full pl-3 pr-3 py-2.5 border-gray-300 focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm">
                                            </div>
                                            <div class="flex-shrink-0 text-gray-500 text-sm italic">
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Cálculo</span>
                                                Auto-sugerido: 1 día antes del inicio
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- SECCIÓN: Remuneración (Solo lectura informativa) -->
                            <div class="pb-8 border-b border-gray-100">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-full bg-yellow-100 flex items-center justify-center text-yellow-600 mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Detalles de Remuneración</h2>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 bg-gray-50 p-6 rounded-xl border border-gray-200 shadow-inner">
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Modalidad</p>
                                        <p class="text-sm font-bold text-gray-900">{{ $adenda->tipo_salario }}</p>
                                    </div>
                                    @if ($adenda->salario_mensual)
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Monto Mensual</p>
                                            <p class="text-sm font-bold text-green-700">S/. {{ number_format($adenda->salario_mensual, 2) }}</p>
                                        </div>
                                    @endif
                                    @if ($adenda->salario_jornal)
                                        <div>
                                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Jornal Diario</p>
                                            <p class="text-sm font-bold text-green-700">S/. {{ number_format($adenda->salario_jornal, 2) }}</p>
                                        </div>
                                    @endif
                                    <div>
                                        <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Horario</p>
                                        <p class="text-sm font-bold text-gray-900">{{ $adenda->horario ?? 'No definido' }}</p>
                                    </div>
                                </div>
                                <p class="text-xs text-gray-500 mt-3 flex items-center gap-1 italic">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    Para modificar los montos, edite el contrato original.
                                </p>
                            </div>

                            <!-- SECCIÓN: Estado -->
                            <div class="pb-8">
                                <div class="flex items-center mb-6">
                                    <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 mr-3">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                    <h2 class="text-xl font-bold text-gray-800">Estado de la Adenda</h2>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Estado Actual *</label>
                                    <select name="estado" required
                                        class="block w-full pl-3 pr-10 py-2.5 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-lg shadow-sm transition ease-in-out duration-150">
                                        <option value="Borrador" {{ old('estado', $adenda->estado) === 'Borrador' ? 'selected' : '' }}>Borrador</option>
                                        <option value="Enviado a firmar" {{ old('estado', $adenda->estado) === 'Enviado a firmar' ? 'selected' : '' }}>Enviado a firmar</option>
                                        <option value="Firmado" {{ old('estado', $adenda->estado) === 'Firmado' ? 'selected' : '' }}>Firmado</option>
                                        <option value="Activo" {{ old('estado', $adenda->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                        <option value="Vencida" {{ old('estado', $adenda->estado) === 'Vencida' ? 'selected' : '' }}>Vencida</option>
                                        <option value="Cancelada" {{ old('estado', $adenda->estado) === 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <!-- Botones -->
                        <div class="px-8 py-5 bg-gray-50 flex justify-end gap-4 rounded-b-lg">
                            <a href="{{ route('adendas.show', $adenda->id) }}"
                                class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                <svg class="w-5 h-5 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Cancelar
                            </a>
                            <button type="submit"
                                class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-lg transform hover:-translate-y-0.5">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const fechaInicioInput = document.getElementById('fecha_inicio');
                const fechaFirmaInput = document.getElementById('fecha_firma');

                function calcularFechaFirma() {
                    if (fechaInicioInput.value) {
                        const fechaInicio = new Date(fechaInicioInput.value + 'T00:00:00');
                        fechaInicio.setDate(fechaInicio.getDate() - 1);

                        const year = fechaInicio.getFullYear();
                        const month = String(fechaInicio.getMonth() + 1).padStart(2, '0');
                        const day = String(fechaInicio.getDate()).padStart(2, '0');

                        fechaFirmaInput.value = `${year}-${month}-${day}`;
                    }
                }

                fechaInicioInput.addEventListener('change', calcularFechaFirma);
            });
        </script>
@endsection