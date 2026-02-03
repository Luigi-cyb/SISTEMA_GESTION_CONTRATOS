@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        
        <!-- ========== HEADER PRINCIPAL ========== -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 rounded-lg shadow-lg mb-6 overflow-hidden">
            <div class="p-8">
                <div class="flex justify-between items-start">
                    <div class="text-white">
                        <div class="flex items-center gap-3 mb-2">
                            <svg class="w-10 h-10" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"/>
                            </svg>
                            <h1 class="text-4xl font-bold">{{ $contrato->numero_contrato }}</h1>
                        </div>
                        <div class="space-y-1 text-blue-100">
                            <p class="text-xl">{{ $contrato->trabajador->nombre_completo }}</p>
                            <p class="text-sm flex items-center gap-2">
                                <span class="bg-blue-500/30 px-3 py-1 rounded-full">{{ $contrato->trabajador->dni }}</span>
                                <span class="bg-blue-500/30 px-3 py-1 rounded-full">{{ $contrato->tipo_contrato }}</span>
                            </p>
                        </div>
                    </div>
                    <div>
                        {!! $contrato->estado_badge !!}
                    </div>
                </div>
            </div>
        </div>

        <!-- ========== MENSAJES ========== -->
        @if ($message = Session::get('success'))
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg shadow-sm p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-green-800">Éxito</p>
                    <p class="text-green-700 text-sm">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        @if ($message = Session::get('error'))
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg shadow-sm p-4 mb-6">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-red-800">Error</p>
                    <p class="text-red-700 text-sm">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- ========== ALERTA: CONTRATO SIN FIRMAR ========== -->
        @if ($contrato->estado === 'Borrador' && !$contrato->tieneContratoFirmado())
        <div class="bg-amber-50 border-l-4 border-amber-500 rounded-lg shadow-sm p-4 mb-6">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-amber-500 mr-3 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                </svg>
                <div>
                    <p class="font-semibold text-amber-800 mb-1">Contrato pendiente de firma</p>
                    <p class="text-amber-700 text-sm">Descarga el PDF, imprímelo, fírmalo y luego súbelo escaneado para activar el contrato.</p>
                </div>
            </div>
        </div>
        @endif

        <!-- ========== BOTONES DE ACCIÓN ========== -->
        <div class="bg-white rounded-lg shadow-sm mb-6 overflow-hidden">
            <div class="bg-gray-50 px-6 py-3 border-b border-gray-200">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider">Acciones</h3>
            </div>
            <div class="p-6">
                <div class="flex flex-wrap gap-3">
                    @can('edit.contratos')
                    <a href="{{ route('contratos.edit', $contrato->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-amber-600 hover:bg-amber-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Editar Contrato
                    </a>
                    @endcan

                    @can('view.contratos')
                    <a href="{{ route('contratos.pdf', $contrato->id) }}" 
                       class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        Descargar PDF
                    </a>
                    @endcan

                    @can('edit.contratos')
                        @if($contrato->tieneContratoFirmado())
                        <a href="{{ route('contratos.descargar-firmado', $contrato->id) }}" 
                           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Contrato Firmado
                        </a>
                        @endif
                    @endcan

                    <!-- ✅ BOTÓN RENOVAR - MEJORADO: BLOQUEAR SI ALCANZA 59 MESES -->
                    @can('create.adendas')
                        @php
                            $numeroAdendas = \App\Models\Adenda::where('contrato_id', $contrato->id)->count();
                            // ✅ CRÍTICO: Bloquear si alcanza 59 meses
                            $puedeRenovar = $meses_acumulados < 59;
                        @endphp
                        
                        @if ($contrato->estado === 'Activo' && $puedeRenovar)
                            <!-- Si está ACTIVO y NO alcanza 59 meses: Botón azul "Renovar" -->
                            <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Renovar (Adenda)
                            </a>
                        @elseif ($contrato->estado === 'Vencido' && $puedeRenovar)
                            <!-- Si está VENCIDO y NO alcanza 59 meses: Mostrar contador + botón verde "Renovar otra vez" -->
                            <div class="inline-flex items-center gap-2">
                                <span class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                    </svg>
                                    {{ $numeroAdendas }} Adenda(s)
                                </span>
                                
                                <a href="{{ route('adendas.create', ['contrato_id' => $contrato->id]) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                    </svg>
                                    Renovar otra vez
                                </a>
                            </div>
                        @elseif (!$puedeRenovar)
                            <!-- ✅ SI ALCANZA 59 MESES: Botón BLOQUEADO EN ROJO -->
                            <div class="inline-flex items-center gap-2">
                                <span class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-800 font-medium rounded-lg">
                                    <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z"/>
                                    </svg>
                                    {{ $numeroAdendas }} Adenda(s)
                                </span>
                                
                                <button disabled 
                                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white font-medium rounded-lg cursor-not-allowed opacity-75 shadow-sm"
                                        title="Renovación bloqueada: Trabajador alcanzó límite de 4 años 11 meses (59 meses). Requiere decisión urgente (Indefinido, Cese o Prórroga)">
                                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 9a3 3 0 100 6 3 3 0 000-6zm0-2a5 5 0 110 10 5 5 0 010-10zm0 10a2 2 0 100-4 2 2 0 000 4z" opacity="0.5"/>
                                    </svg>
                                    Renovación Bloqueada
                                </button>
                            </div>
                        @endif
                    @endcan

                    @can('delete.contratos')
                    <form action="{{ route('contratos.destroy', $contrato->id) }}" method="POST" class="inline"
                          onsubmit="return confirm('¿Estás seguro de eliminar este contrato?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                            Eliminar
                        </button>
                    </form>
                    @endcan

                    <a href="{{ route('contratos.index') }}" 
                       class="inline-flex items-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Volver
                    </a>
                </div>
            </div>
        </div>

        <!-- ========== GRID PRINCIPAL ========== -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            
            <!-- COLUMNA IZQUIERDA (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- SUBIR CONTRATO FIRMADO -->
                @can('edit.contratos')
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                            Subir Contrato Firmado
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        @if($contrato->tieneContratoFirmado())
                        <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="text-sm font-semibold text-green-800">Contrato firmado subido exitosamente</p>
                                    @if($contrato->fecha_firma)
                                    <p class="text-xs text-green-600 mt-1">{{ $contrato->fecha_firma->format('d/m/Y H:i') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <form action="{{ route('contratos.subir-firmado', $contrato->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                    Archivo PDF del contrato firmado *
                                </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500">
                                                <span>Seleccionar archivo</span>
                                                <input type="file" name="contrato_firmado" accept=".pdf" required class="sr-only">
                                            </label>
                                            <p class="pl-1">o arrastra y suelta</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PDF hasta 10MB</p>
                                    </div>
                                </div>
                                @error('contrato_firmado')
                                <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" 
                                    class="w-full inline-flex justify-center items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $contrato->tieneContratoFirmado() ? 'Reemplazar Contrato Firmado' : 'Subir Contrato Firmado' }}
                            </button>
                        </form>
                    </div>
                </div>
                @endcan

                <!-- INFORMACIÓN DEL TRABAJADOR -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Información del Trabajador
                        </h3>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">DNI</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->trabajador->dni }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre Completo</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->trabajador->nombre_completo }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Cargo</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->trabajador->cargo }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Unidad</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->trabajador->unidad }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- DATOS DEL CONTRATO -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Datos del Contrato
                        </h3>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-blue-50 px-4 py-3 rounded-lg border border-blue-100">
                                <dt class="text-xs font-medium text-blue-700 uppercase tracking-wider">Número de Contrato</dt>
                                <dd class="mt-1 text-lg font-bold text-blue-900">{{ $contrato->numero_contrato }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Contrato</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->tipo_contrato }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Inicio</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->fecha_inicio->format('d/m/Y') }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Fin</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->fecha_fin->format('d/m/Y') }}</dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha de Firma</dt>
                                <dd class="mt-1 text-sm font-semibold text-gray-900">
                                    @if($contrato->fecha_firma_manual)
                                        {{ $contrato->fecha_firma_manual->format('d/m/Y') }}
                                    @else
                                        {{ $contrato->fecha_inicio->copy()->subDay()->format('d/m/Y') }}
                                        <span class="text-xs text-gray-500 block">(auto-calculado)</span>
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Horario</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->horario }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- REMUNERACIÓN -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Remuneración
                        </h3>
                    </div>
                    <div class="p-6">
                        <dl class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo de Salario</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">{{ $contrato->tipo_salario }}</dd>
                            </div>
                            @if ($contrato->salario_mensual)
                            <div class="bg-green-50 px-4 py-3 rounded-lg border border-green-100">
                                <dt class="text-xs font-medium text-green-700 uppercase tracking-wider">Salario Mensual</dt>
                                <dd class="mt-1 text-2xl font-bold text-green-900">S/. {{ number_format($contrato->salario_mensual, 2) }}</dd>
                            </div>
                            @endif
                            @if ($contrato->salario_jornal)
                            <div class="bg-green-50 px-4 py-3 rounded-lg border border-green-100">
                                <dt class="text-xs font-medium text-green-700 uppercase tracking-wider">Salario Jornal</dt>
                                <dd class="mt-1 text-2xl font-bold text-green-900">S/. {{ number_format($contrato->salario_jornal, 2) }}</dd>
                            </div>
                            @endif
                            <div class="bg-gray-50 px-4 py-3 rounded-lg">
                                <dt class="text-xs font-medium text-gray-500 uppercase tracking-wider">Beneficios Ley 728</dt>
                                <dd class="mt-1 text-lg font-semibold text-gray-900">
                                    @if($contrato->beneficios_ley_728)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Sí
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                            </svg>
                                            No
                                        </span>
                                    @endif
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- RENOVACIONES (ADENDAS) -->
                @if ($contrato->adendas->count() > 0)
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Renovaciones (Adendas)
                        </h3>
                    </div>
                    <div class="p-6">
                        <div class="space-y-3">
                            @foreach ($contrato->adendas as $index => $adenda)
                            <div class="border-l-4 border-blue-500 bg-blue-50 pl-4 pr-4 py-3 rounded-r-lg">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="font-semibold text-gray-900 text-sm">Adenda #{{ $adenda->numero_adenda }}</p>
                                        <p class="text-gray-600 text-xs mt-1">
                                            <span class="font-medium">Periodo:</span> {{ $adenda->fecha_inicio->format('d/m/Y') }} - {{ $adenda->fecha_fin->format('d/m/Y') }}
                                        </p>
                                        <p class="text-gray-600 text-xs">
                                            <span class="font-medium">Acumulado:</span> {{ $adenda->tiempo_acumulado_total_meses }} meses
                                        </p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        Adenda {{ $index + 1 }}
                                    </span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

            </div>

            <!-- COLUMNA DERECHA (1/3) -->
            <div class="space-y-6">
                
                <!-- TIEMPO ACUMULADO -->
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
                        <h3 class="text-lg font-semibold text-white flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Tiempo Acumulado
                        </h3>
                    </div>
                    
                    <div class="p-6 space-y-4">
                        
                        <!-- ✅ COLUMNA 1: TIEMPO TOTAL ACUMULADO (Años + Meses + Días) -->
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-lg p-4 border-l-4 border-blue-500">
                            <p class="text-xs font-medium text-gray-600 uppercase tracking-wider mb-2">Tiempo Total Acumulado</p>
                            <p class="text-3xl font-bold text-blue-700">
                                {{ $texto_tiempo_completo }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">desde inicio del contrato</p>
                        </div>

                        <!-- ✅ COLUMNA 2: MESES Y DÍAS (Solo lo que sobra después de años) -->
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 rounded-lg p-4 border-l-4 border-purple-500">
                            <p class="text-xs font-medium text-gray-600 uppercase tracking-wider mb-2">Meses y Días</p>
                            <p class="text-3xl font-bold text-purple-700">
                                {{ $texto_meses_dias }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                después de {{ $años_completos }} año{{ $años_completos != 1 ? 's' : '' }} completo{{ $años_completos != 1 ? 's' : '' }}
                            </p>
                        </div>

                        <!-- ✅ COLUMNA 3: AÑOS ACUMULADOS (Decimal) -->
                        <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-lg p-4 border-l-4 border-green-500">
                            <p class="text-xs font-medium text-gray-600 uppercase tracking-wider mb-2">Años Acumulados</p>
                            <p class="text-4xl font-bold text-green-700">
                                {{ number_format($meses_acumulados / 12, 2) }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">años totales ({{ $meses_acumulados }} meses)</p>
                        </div>

                        <!-- ✅ TIEMPO PARA VENCIMIENTO -->
                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-lg p-4 border-l-4 border-orange-500">
                            <p class="text-xs font-medium text-gray-600 uppercase tracking-wider mb-2">Tiempo Para Vencimiento</p>
                            <p class="text-2xl font-bold text-orange-700">
                                {{ $texto_dias_restantes }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">restantes hasta {{ $contrato->fecha_fin->format('d/m/Y') }}</p>
                        </div>

                    </div>
                </div>

                <!-- ALERTAS -->
                @if ($meses_acumulados >= 56)
                <div class="bg-red-100 border-l-4 border-red-500 rounded-lg shadow-sm p-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-bold text-red-800 text-sm">⚠️ ALERTA CRÍTICA: ESTABILIDAD LABORAL</p>
                            <p class="text-red-700 text-xs mt-1">
                                Trabajador con {{ number_format($meses_acumulados / 12, 1) }} años de antigüedad.
                                <br><strong>Próximo al límite de 4 años 11 meses (59 meses).</strong>
                                <br>Decisión urgente requerida: Renovar como Indefinido, Cese o Prórroga.
                            </p>
                        </div>
                    </div>
                </div>
                @elseif ($meses_acumulados >= 48)
                <div class="bg-yellow-100 border-l-4 border-yellow-500 rounded-lg shadow-sm p-4">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-yellow-500 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                        </svg>
                        <div>
                            <p class="font-bold text-yellow-800 text-sm">⚠️ ADVERTENCIA</p>
                            <p class="text-yellow-700 text-xs mt-1">
                                {{ number_format($meses_acumulados / 12, 1) }} años de antigüedad. 
                                Prepararse para tomar decisión en los próximos meses.
                            </p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- AUDITORÍA -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Auditoría
                        </h3>
                    </div>
                    <div class="p-6 space-y-4">
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Creado</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $contrato->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Última Actualización</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $contrato->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                        @if($contrato->fecha_firma)
                        <div>
                            <p class="text-xs font-medium text-gray-500 uppercase tracking-wider">Contrato Firmado</p>
                            <p class="text-sm font-semibold text-gray-900 mt-1">{{ $contrato->fecha_firma->format('d/m/Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection