@extends('layouts.app')

@section('content')
    <div class="py-12 bg-gray-50">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <!-- Header -->
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-2xl mb-8 border-l-8 border-blue-600">
                <div class="p-8">
                    <div class="flex items-center gap-6">
                        <div class="p-4 bg-blue-50 rounded-full text-blue-600">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-extrabold text-gray-800">Renovar Contrato</h1>
                            <p class="text-gray-600 mt-1 flex items-center gap-2 text-lg">
                                Creación de Adenda para el contrato
                                <span
                                    class="font-mono bg-gray-100 px-3 py-0.5 rounded text-gray-800 font-bold border border-gray-200">{{ $contrato->numero_contrato }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <!-- Información del Contrato -->
                <div
                    class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded shadow-sm">
                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-gray-700">Datos del Trabajador</h2>
                    </div>
                    <div class="p-6 space-y-5">
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Trabajador</p>
                            <p class="text-gray-900 font-bold text-lg">{{ $contrato->trabajador->nombre_completo }}</p>
                            <p class="text-sm text-gray-500">{{ $contrato->trabajador->tipo_documento }}:
                                {{ $contrato->trabajador->dni }}</p>
                        </div>
                        <div class="grid grid-cols-2 gap-4 pt-2 border-t border-gray-100">
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Tipo Contrato</p>
                                <p class="text-gray-800 font-medium">{{ $contrato->tipo_contrato }}</p>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Vencimiento</p>
                                <p class="text-red-600 font-bold">{{ $contrato->fecha_fin->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Disponibilidad de Tiempo -->
                <div
                    class="bg-white shadow-md rounded-2xl overflow-hidden hover:shadow-xl transition-shadow duration-300 relative border border-purple-100">
                    <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
                        <svg class="w-32 h-32 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div class="bg-purple-50 px-6 py-4 border-b border-purple-100 flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded shadow-sm text-purple-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h2 class="font-bold text-purple-900">Tiempo Restante (Límite 5 años)</h2>
                    </div>
                    <div class="p-6 relative z-10">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <p class="text-3xl font-extrabold text-purple-700" id="tiempoDisponibleTexto">--</p>
                                <p class="text-sm text-purple-600 font-medium mt-1">Saldo Disponible</p>
                            </div>
                            <div class="text-right bg-gray-50 px-3 py-2 rounded-lg border border-gray-100">
                                <p class="text-lg font-bold text-gray-600" id="tiempoAcumuladoTexto">--</p>
                                <p class="text-xs text-gray-500 font-medium">Acumulado</p>
                            </div>
                        </div>

                        <div class="w-full bg-gray-200 rounded-full h-3 mb-3 shadow-inner">
                            @php $porcentaje = ($tiempoActual / 59) * 100; @endphp
                            <div class="bg-purple-600 h-3 rounded-full transition-all duration-1000 ease-out"
                                style="width: {{ min($porcentaje, 100) }}%"></div>
                        </div>
                        <p class="text-xs text-center text-gray-500 font-medium">
                            Límite seguro: <strong>4 años 11 meses</strong> (para evitar estabilidad automática)
                        </p>
                    </div>
                </div>
            </div>

            @if ($ultimaAdenda)
                <!-- Última Adenda -->
                <div
                    class="bg-white shadow-md rounded-2xl overflow-hidden mb-8 border border-green-100 hover:shadow-lg transition-all">
                    <div class="bg-green-50 px-6 py-4 flex items-center justify-between border-b border-green-100">
                        <div class="flex items-center gap-3">
                            <div class="bg-white p-1.5 rounded-full shadow-sm text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="font-bold text-green-800">Última Adenda Registrada (#{{ $ultimaAdenda->numero_adenda }})
                            </h2>
                        </div>
                        <span
                            class="text-xs text-green-700 bg-green-200 px-3 py-1 rounded-full font-bold shadow-sm">ACTIVA</span>
                    </div>
                    <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="border-r border-gray-100 last:border-0">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Período</p>
                            <p class="font-medium text-gray-800 text-lg">
                                {{ $ultimaAdenda->fecha_inicio->format('d/m/Y') }} — <span
                                    class="text-gray-500">{{ $ultimaAdenda->fecha_fin->format('d/m/Y') }}</span>
                            </p>
                        </div>
                        <div class="border-r border-gray-100 last:border-0 pl-4">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Duración</p>
                            <p class="font-medium text-gray-800 text-lg">
                                {{ number_format($ultimaAdenda->tiempo_acumulado_total_meses - ($ultimaAdenda->id > 1 ? \App\Models\Adenda::find($ultimaAdenda->id - 1)->tiempo_acumulado_total_meses ?? 0 : 0), 2) }}
                                meses
                            </p>
                        </div>
                        <div class="pl-4">
                            <p class="text-xs text-gray-400 font-bold uppercase mb-1">Nueva Fecha Inicio</p>
                            <p class="font-bold text-blue-600 text-lg">
                                {{ $fechaInicioDefault->format('d/m/Y') }} <span
                                    class="text-xs font-normal text-gray-400 ml-1">(Calculado)</span>
                            </p>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-amber-50 border border-amber-200 rounded-2xl p-6 mb-8 flex items-center gap-5 shadow-sm">
                    <div class="bg-amber-100 p-3 rounded-full text-amber-600 shrink-0 shadow-sm border border-amber-200">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-amber-900">Primera Adenda</h3>
                        <p class="text-amber-800 mt-1">
                            Esta será la primera adenda para este contrato. Se basará en los datos originales y comenzará el
                            <strong>{{ $fechaInicioDefault->format('d/m/Y') }}</strong>.
                        </p>
                    </div>
                </div>
            @endif

            <!-- ALERTA CRÍTICA -->
            @if ($tiempoActual >= 56)
                <div
                    class="bg-red-50 border-l-8 border-red-500 rounded-r-xl shadow-md p-6 mb-8 flex items-start gap-4 animate-pulse">
                    <div class="text-red-500 shrink-0 mt-1">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-red-800">⚠️ ALERTA DE ESTABILIDAD LABORAL</h3>
                        <p class="text-red-700 mt-1 font-medium">
                            El trabajador está próximo al límite de 5 años. Esta adenda es crucial.
                        </p>
                    </div>
                </div>
            @endif

            <!-- Formulario Principal -->
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
                <div class="bg-gray-800 px-8 py-5 border-b border-gray-700 flex items-center justify-between">
                    <h2 class="text-xl font-bold text-white flex items-center gap-3">
                        <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Configurar Vigencia
                    </h2>
                    <span class="text-gray-400 text-sm font-medium">Paso Final</span>
                </div>

                <div class="p-8">
                    <form action="{{ route('adendas.store') }}" method="POST" id="formAdenda" class="space-y-8">
                        @csrf
                        <input type="hidden" name="contrato_id" value="{{ $contrato->id }}">

                        @if ($errors->any())
                            <div class="bg-red-50 text-red-700 p-4 rounded-lg flex items-start gap-3 border border-red-200">
                                <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <div>
                                    <p class="font-bold">Corrija los siguientes errores:</p>
                                    <ul class="list-disc list-inside mt-1 text-sm">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Inicio <span
                                        class="text-blue-500 font-normal text-xs ml-1">(Automático)</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" name="fecha_inicio" id="fecha_inicio"
                                        value="{{ old('fecha_inicio', $fechaInicioDefault->format('Y-m-d')) }}" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm font-semibold">
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Firma <span
                                        class="text-blue-500 font-normal text-xs ml-1">(Automático)</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <input type="date" name="fecha_firma" id="fecha_firma"
                                        value="{{ old('fecha_firma', $fechaFirmaDefault->format('Y-m-d')) }}" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 bg-white text-gray-900 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm font-semibold">
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="block text-sm font-bold text-gray-700 mb-2">Fecha de Fin <span
                                        class="text-red-500">*</span></label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="date" name="fecha_fin" id="fecha_fin"
                                        value="{{ old('fecha_fin', $fechaFinDefault->format('Y-m-d')) }}"
                                        min="{{ $fechaInicioDefault->format('Y-m-d') }}"
                                        max="{{ $fechaFinMaxima->format('Y-m-d') }}" required
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 text-lg py-3 font-semibold text-gray-900 transition-colors">
                                </div>
                                <div class="mt-2 flex justify-between items-center text-xs">
                                    <p class="text-gray-500">Máximo permitido: <strong
                                            id="fechaFinMaximaTexto">{{ $fechaFinMaxima->format('d/m/Y') }}</strong></p>
                                    <p id="diasRestantes" class="font-medium text-blue-600 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Seleccione una fecha
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Panel de Resumen Dinámico -->
                        <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                            <h3 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                </svg>
                                Impacto de la Renovación
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Duración Adenda
                                    </p>
                                    <p class="text-2xl font-bold text-blue-600" id="duracionAdenda">--</p>
                                </div>
                                <div class="bg-white p-4 rounded-lg border border-gray-100 shadow-sm">
                                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Total Final
                                        Acumulado</p>
                                    <p class="text-2xl font-bold text-gray-800" id="tiempoTotalNuevo">--</p>
                                </div>
                            </div>
                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm font-medium flex items-center justify-end gap-2" id="estadoValidacion">
                                    <span class="w-2 h-2 rounded-full bg-gray-400"></span>
                                    Pendiente de selección
                                </p>
                            </div>
                        </div>

                        <div class="pt-4 flex items-center justify-end gap-4 border-t border-gray-100">
                            <a href="{{ route('contratos.show', $contrato->id) }}"
                                class="px-6 py-2.5 rounded-lg border border-gray-300 text-gray-700 font-bold hover:bg-gray-50 transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" id="btnSubmit"
                                class="px-6 py-2.5 rounded-lg bg-blue-600 text-white font-bold hover:bg-blue-700 shadow-lg shadow-blue-500/30 transition-all disabled:opacity-50 disabled:cursor-not-allowed flex items-center gap-2 transform active:scale-95">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Crear Adenda
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // --- LÓGICA DE NEGOCIO ---

        // Elementos del DOM
        const fechaInicioInput = document.getElementById('fecha_inicio');
        const fechaFinInput = document.getElementById('fecha_fin');
        const btnSubmit = document.getElementById('btnSubmit');
        const duracionAdendaElem = document.getElementById('duracionAdenda');
        const tiempoTotalNuevoElem = document.getElementById('tiempoTotalNuevo');
        const diasRestantesElem = document.getElementById('diasRestantes');
        const estadoValidacionElem = document.getElementById('estadoValidacion');
        const tiempoAcumuladoTexto = document.getElementById('tiempoAcumuladoTexto');
        const tiempoDisponibleTexto = document.getElementById('tiempoDisponibleTexto');

        // Datos del Servidor (Floats)
        const floatTiempoActual = {{ $tiempoActual }};
        const floatMesesDisponibles = {{ $mesesDisponibles }};

        // UTILIDAD: Convertir float de meses a "X años, Y meses, Z días" (Aprox 30 días)
        function formatFloatToText(totalMonths) {
            const years = Math.floor(totalMonths / 12);
            const months = Math.floor(totalMonths % 12);
            const decimalPart = totalMonths - Math.floor(totalMonths);
            const days = Math.round(decimalPart * 30);

            let parts = [];
            if (years > 0) parts.push(`${years} año${years !== 1 ? 's' : ''}`);
            if (months > 0) parts.push(`${months} mes${months !== 1 ? 'es' : ''}`);
            if (days > 0) parts.push(`${days} día${days !== 1 ? 's' : ''}`);

            if (parts.length === 0) return '0 días';
            return parts.join(', ');
        }

        // UTILIDAD: Diferencia exacta de fechas
        function dateDiff(start, end) {
            let s = new Date(start);
            let e = new Date(end);
            
            // Ajustar zona horaria
            s.setMinutes(s.getMinutes() + s.getTimezoneOffset());
            e.setMinutes(e.getMinutes() + e.getTimezoneOffset());

            // HACER CÁLCULO INCLUSIVO: Se suma 1 día a la fecha final
            // para que cuente el primer día de trabajo (ej: 02/04 al 01/07 = 3 meses exactos)
            e.setDate(e.getDate() + 1);

            let years = e.getFullYear() - s.getFullYear();
            let months = e.getMonth() - s.getMonth();
            let days = e.getDate() - s.getDate();

            // Ajuste de días negativos
            if (days < 0) {
                months--;
                // Obtener último día del mes anterior
                let prevMonthDate = new Date(e.getFullYear(), e.getMonth(), 0);
                days += prevMonthDate.getDate();
            }

            // Ajuste de meses negativos
            if (months < 0) {
                years--;
                months += 12;
            }

            const totalAdendaMonthsFloat = (years * 12) + months + (days / 30.44);

            return {
                years,
                months,
                days,
                formatted: `${years > 0 ? years + ' años, ' : ''}${months} meses, ${days} días`,
                floatVal: totalAdendaMonthsFloat
            };
        }

        function actualizarCalculos() {
            // 1. Mostrar Textos Estáticos
            if (tiempoAcumuladoTexto) tiempoAcumuladoTexto.innerText = formatFloatToText(floatTiempoActual);
            if (tiempoDisponibleTexto) tiempoDisponibleTexto.innerText = formatFloatToText(floatMesesDisponibles);

            // 2. Cálculos Dinámicos
            if (!fechaInicioInput.value || !fechaFinInput.value) return;

            const start = new Date(fechaInicioInput.value);
            const end = new Date(fechaFinInput.value);

            if (end < start) {
                duracionAdendaElem.innerText = "Fecha inválida";
                duracionAdendaElem.classList.add('text-red-500');
                return;
            } else {
                duracionAdendaElem.classList.remove('text-red-500');
            }

            const diff = dateDiff(fechaInicioInput.value, fechaFinInput.value);
            duracionAdendaElem.innerText = diff.formatted;

            const nuevoTotalFloat = floatTiempoActual + diff.floatVal;
            tiempoTotalNuevoElem.innerText = formatFloatToText(nuevoTotalFloat);

            if (nuevoTotalFloat > 59.0) {
                fechaFinInput.classList.add('border-red-500', 'bg-red-50', 'text-red-900');
                fechaFinInput.classList.remove('border-gray-300');

                diasRestantesElem.className = 'font-bold text-red-600 flex items-center gap-1';
                diasRestantesElem.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    EXCEDE LÍMITE (Total: ${nuevoTotalFloat.toFixed(1)} meses)
                `;

                estadoValidacionElem.className = 'text-sm font-bold text-red-600 flex items-center justify-end gap-2';
                estadoValidacionElem.innerHTML = '<span class="w-2 h-2 rounded-full bg-red-600 animate-pulse"></span> BLOQUEADO: Supera límite legal';

                btnSubmit.disabled = true;
                btnSubmit.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                fechaFinInput.classList.remove('border-red-500', 'bg-red-50', 'text-red-900');
                fechaFinInput.classList.add('border-gray-300');

                diasRestantesElem.className = 'font-medium text-green-600 flex items-center gap-1';
                diasRestantesElem.innerHTML = `
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    Fecha válida
                `;

                estadoValidacionElem.className = 'text-sm font-bold text-green-600 flex items-center justify-end gap-2';
                estadoValidacionElem.innerHTML = '<span class="w-2 h-2 rounded-full bg-green-500"></span> PERMITIDO';

                btnSubmit.disabled = false;
                btnSubmit.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        }

        fechaFinInput.addEventListener('change', actualizarCalculos);
        fechaFinInput.addEventListener('input', actualizarCalculos);
        fechaInicioInput.addEventListener('change', actualizarCalculos);
        fechaInicioInput.addEventListener('input', actualizarCalculos);
        window.addEventListener('load', actualizarCalculos);
    </script>
@endsection