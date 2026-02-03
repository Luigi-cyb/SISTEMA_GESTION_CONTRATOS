@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-4">
        
        <!-- Header Formal -->
        <div class="bg-white border-b-4 border-blue-900 shadow-sm mb-8">
            <div class="p-8">
                <div class="grid grid-cols-3 gap-8 items-start">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">{{ $adenda->numero_adenda_contrato }}</h1>
                        <p class="text-sm text-gray-600">Adenda #{{ $adenda->numero_adenda }}</p>
                        <p class="text-sm text-gray-600">Contrato: {{ $adenda->contrato->numero_contrato }}</p>
                    </div>
                    <div class="col-span-1 text-center">
                        <p class="text-xs text-gray-500 mb-2">ESTADO ACTUAL</p>
                        @if ($adenda->estado === 'Activo')
                        <span class="inline-block px-4 py-2 bg-green-50 border border-green-300 text-green-700 rounded text-sm font-semibold">● Activo</span>
                        @elseif ($adenda->estado === 'Vencida')
                        <span class="inline-block px-4 py-2 bg-red-50 border border-red-300 text-red-700 rounded text-sm font-semibold">● Vencida</span>
                        @elseif ($adenda->estado === 'Borrador')
                        <span class="inline-block px-4 py-2 bg-yellow-50 border border-yellow-300 text-yellow-700 rounded text-sm font-semibold">● Borrador</span>
                        @elseif ($adenda->estado === 'Firmado')
                        <span class="inline-block px-4 py-2 bg-blue-50 border border-blue-300 text-blue-700 rounded text-sm font-semibold">● Firmado</span>
                        @else
                        <span class="inline-block px-4 py-2 bg-gray-50 border border-gray-300 text-gray-700 rounded text-sm font-semibold">● {{ $adenda->estado }}</span>
                        @endif
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-500 mb-1">TRABAJADOR</p>
                        <p class="text-sm font-semibold text-gray-900">{{ $adenda->trabajador->nombre_completo }}</p>
                        <p class="text-xs text-gray-600 mt-2">DNI: {{ $adenda->trabajador->dni }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if ($message = Session::get('success'))
        <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-8 rounded">
            <p class="text-green-800 text-sm"><strong>✓</strong> {{ $message }}</p>
        </div>
        @endif

        <!-- Botones de Acción - Estilo Formal -->
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="p-6 flex gap-3 flex-wrap">
                @can('edit.adendas')
                <a href="{{ route('adendas.edit', $adenda->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded transition-colors">
                    ✎ Editar
                </a>
                @endcan

                @can('view.adendas')
                <a href="{{ route('adendas.pdf', $adenda->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white text-sm font-semibold rounded transition-colors">
                    ↓ Descargar PDF
                </a>
                @endcan

                <a href="{{ route('contratos.show', $adenda->contrato->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-500 hover:bg-gray-600 text-white text-sm font-semibold rounded transition-colors">
                    ⟶ Ver Contrato
                </a>

                <a href="{{ route('adendas.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-400 hover:bg-gray-500 text-white text-sm font-semibold rounded transition-colors">
                    ← Volver
                </a>
            </div>
        </div>

        <!-- ALERTA CRÍTICA: Estabilidad Laboral -->
        @if ($adenda->tiempo_acumulado_total_meses >= 57)
        <div class="bg-red-50 border-l-4 border-red-900 p-6 mb-8 rounded">
            <h3 class="text-lg font-bold text-red-900 mb-3">⚠ ALERTA CRÍTICA - ESTABILIDAD LABORAL (5 AÑOS)</h3>
            <p class="text-red-800 text-sm mb-4">
                Antigüedad acumulada: <strong>{{ $adenda->tiempo_acumulado_total_meses }} meses ({{ number_format($adenda->tiempo_acumulado_total_meses / 12, 1) }} años)</strong>
            </p>
            
            @if ($adenda->tiempo_acumulado_total_meses >= 60)
            <div class="bg-red-100 p-3 rounded mb-4 border border-red-300">
                <p class="font-bold text-red-900 text-sm">Se ha cumplido 5 años - Decisión urgente requerida</p>
            </div>
            @else
            <div class="bg-orange-100 p-3 rounded mb-4 border border-orange-300">
                <p class="font-bold text-orange-900 text-sm">Faltan {{ 60 - $adenda->tiempo_acumulado_total_meses }} meses para completar 5 años</p>
            </div>
            @endif

            <div class="bg-white p-4 rounded border border-gray-200">
                <p class="font-semibold text-gray-900 text-sm mb-3">Opciones disponibles:</p>
                <form action="{{ route('adendas.decision-estabilidad', $adenda->id) }}" method="POST" class="space-y-2">
                    @csrf
                    <button type="submit" name="decision" value="indefinido" class="block w-full text-left px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded transition-colors">
                        ✓ Renovar como Indefinido (Trabajador Estable)
                    </button>
                    <button type="submit" name="decision" value="cese" class="block w-full text-left px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-semibold rounded transition-colors"
                            onclick="return confirm('¿Confirmar cese del trabajador?');">
                        ✗ No Renovar (Cese)
                    </button>
                    <button type="submit" name="decision" value="prorroga" class="block w-full text-left px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded transition-colors">
                        ⟳ Prórroga (Diferir Decisión)
                    </button>
                </form>
            </div>
        </div>
        @endif

        <!-- SUBIR ADENDA FIRMADA -->
        @can('edit.adendas')
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Gestión de Documento Firmado</h3>
            </div>
            
            <div class="p-6">
                @if($adenda->url_documento_escaneado)
                <div class="bg-green-50 border border-green-300 rounded p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-semibold text-green-900">✓ Documento firmado registrado en el sistema</p>
                        </div>
                        <a href="{{ route('adendas.descargar-firmada', $adenda->id) }}" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-semibold rounded transition-colors">
                            ↓ Descargar
                        </a>
                    </div>
                </div>
                @endif

                <form action="{{ route('adendas.subir-firmada', $adenda->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-900 mb-3">
                            Cargar documento PDF firmado
                        </label>
                        <div class="flex justify-center px-6 pt-8 pb-8 border-2 border-dashed border-gray-300 rounded bg-gray-50 hover:bg-gray-100 hover:border-blue-400 transition-colors">
                            <div class="text-center">
                                <p class="text-sm text-gray-600 mb-2">Seleccionar archivo o arrastrar y soltar</p>
                                <input type="file" name="adenda_firmada" accept=".pdf" required class="hidden" id="fileInput" onchange="document.getElementById('fileName').innerText = this.files[0]?.name || ''">
                                <label for="fileInput" class="inline-block px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded cursor-pointer transition-colors">
                                    Elegir archivo
                                </label>
                                <p class="text-xs text-gray-500 mt-2">Formato PDF, máximo 10MB</p>
                                <p id="fileName" class="text-sm text-blue-600 font-semibold mt-3"></p>
                            </div>
                        </div>
                        @error('adenda_firmada')
                        <p class="text-red-600 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded transition-colors">
                        CARGAR DOCUMENTO
                    </button>
                </form>
            </div>
        </div>
        @endcan

        <!-- Datos de la Adenda -->
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Datos de la Adenda</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-8">
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Número</p>
                        <p class="text-lg font-semibold text-gray-900">#{{ $adenda->numero_adenda }}</p>
                    </div>
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Fecha de Inicio</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $adenda->fecha_inicio->format('d/m/Y') }}</p>
                    </div>
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Fecha de Fin</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $adenda->fecha_fin->format('d/m/Y') }}</p>
                    </div>
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Fecha de Firma</p>
                        <p class="text-lg font-semibold text-gray-900">
                            @if ($adenda->fecha_firma)
                                {{ \Carbon\Carbon::parse($adenda->fecha_firma)->format('d/m/Y') }}
                            @else
                                <span class="text-gray-400 text-sm">—</span>
                            @endif
                        </p>
                    </div>
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Horario</p>
                        <p class="text-lg font-semibold text-gray-900">{{ $adenda->horario }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Estado</p>
                        @if ($adenda->estado === 'Activo')
                        <p class="text-lg font-semibold text-green-700">Activo</p>
                        @elseif ($adenda->estado === 'Vencida')
                        <p class="text-lg font-semibold text-red-700">Vencida</p>
                        @elseif ($adenda->estado === 'Firmado')
                        <p class="text-lg font-semibold text-blue-700">Firmado</p>
                        @else
                        <p class="text-lg font-semibold text-gray-700">{{ $adenda->estado }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Remuneración -->
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Remuneración</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Tipo de Salario</p>
                        <p class="text-base font-semibold text-gray-900">{{ $adenda->tipo_salario }}</p>
                    </div>
                    @if ($adenda->salario_mensual)
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Salario Mensual</p>
                        <p class="text-base font-semibold text-gray-900">S/. {{ number_format($adenda->salario_mensual, 2) }}</p>
                    </div>
                    @endif
                    @if ($adenda->salario_jornal)
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Salario Diario</p>
                        <p class="text-base font-semibold text-gray-900">S/. {{ number_format($adenda->salario_jornal, 2) }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tiempo Acumulado -->
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Antigüedad Acumulada</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Meses Acumulados</p>
                        <p class="text-3xl font-bold text-blue-900">{{ $adenda->tiempo_acumulado_total_meses }}</p>
                    </div>
                    <div class="border-r border-gray-200 pr-6">
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Años Acumulados</p>
                        <p class="text-3xl font-bold text-blue-900">{{ number_format($adenda->tiempo_acumulado_total_meses / 12, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Para 5 Años Faltan</p>
                        <p class="text-3xl font-bold {{ 60 - $adenda->tiempo_acumulado_total_meses <= 0 ? 'text-red-600' : 'text-orange-600' }}">
                            {{ max(0, 60 - $adenda->tiempo_acumulado_total_meses) }}
                        </p>
                        <p class="text-xs text-gray-600 mt-1">meses</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información del Trabajador -->
        <div class="bg-white shadow-sm border border-gray-200 rounded mb-8">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Datos del Trabajador</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">DNI</p>
                        <p class="text-base font-semibold text-gray-900">{{ $adenda->trabajador->dni }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Nombre</p>
                        <p class="text-base font-semibold text-gray-900">{{ $adenda->trabajador->nombre_completo }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Cargo</p>
                        <p class="text-base font-semibold text-gray-900">{{ $adenda->trabajador->cargo }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Unidad</p>
                        <p class="text-base font-semibold text-gray-900">{{ $adenda->trabajador->unidad }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Información de Auditoría -->
        <div class="bg-white shadow-sm border border-gray-200 rounded">
            <div class="bg-gray-100 border-b border-gray-300 px-6 py-4">
                <h2 class="text-sm font-bold text-gray-900 uppercase tracking-wide">Registro de Auditoría</h2>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-2 gap-8">
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Creado</p>
                        <p class="text-sm text-gray-900">{{ $adenda->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 mb-2 uppercase tracking-wide">Última Actualización</p>
                        <p class="text-sm text-gray-900">{{ $adenda->updated_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection