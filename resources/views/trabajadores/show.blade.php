@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <div class="flex justify-between items-start">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">{{ $trabajador->nombre_completo }}</h1>
                        <p class="text-gray-600 mt-1">DNI: <strong>{{ $trabajador->dni }}</strong></p>
                        <p class="text-gray-600">{{ $trabajador->cargo }} • {{ $trabajador->unidad }}</p>
                    </div>
                    <div class="text-right">
                        @php
                            $estadoActual = $trabajador->getEstadoCorrectoAttribute();
                        @endphp
                        @if ($estadoActual === 'Activo')
                        <span class="inline-block px-4 py-2 bg-green-50 text-green-700 rounded-lg text-sm font-semibold border border-green-200">Activo</span>
                        @elseif ($estadoActual === 'Inactivo')
                        <span class="inline-block px-4 py-2 bg-gray-50 text-gray-700 rounded-lg text-sm font-semibold border border-gray-200">Inactivo</span>
                        @elseif ($estadoActual === 'Suspendido')
                        <span class="inline-block px-4 py-2 bg-red-50 text-red-700 rounded-lg text-sm font-semibold border border-red-200">Suspendido</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Mensaje de éxito -->
        @if ($message = Session::get('success'))
        <div class="bg-green-50 border-l-4 border-green-500 text-green-700 px-4 py-4 rounded-r-lg mb-6" role="alert">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="font-medium">{{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

        <!-- ALERTA: Lista Negra -->
        @if ($trabajador->listaNegra)
        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-500" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium">Trabajador en Lista Negra</h3>
                    <div class="mt-2 text-sm">
                        <p><strong>Motivo:</strong> {{ $trabajador->listaNegra->motivo }}</p>
                        <p><strong>Fecha:</strong> {{ $trabajador->listaNegra->fecha_ingreso->format('d/m/Y') }}</p>
                        <p><strong>Autorizado por:</strong> {{ $trabajador->listaNegra->autorizado_por }}</p>
                    </div>
                    @can('edit.lista_negra')
                    <div class="mt-4">
                        <a href="{{ route('lista-negra.show', $trabajador->listaNegra->id) }}" class="text-red-700 hover:text-red-900 underline font-semibold text-sm">
                            Ver detalles →
                        </a>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
        @endif

        <!-- Botones de Acción -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 flex gap-3 flex-wrap">
                @can('edit.trabajadores')
                <a href="{{ route('trabajadores.edit', $trabajador->dni) }}" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                    Editar
                </a>
                @endcan

                @can('create.contratos')
                <a href="{{ route('contratos.create', ['trabajador_dni' => $trabajador->dni]) }}" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                    Nuevo Contrato
                </a>
                @endcan

                @can('view.lista_negra')
                @if (!$trabajador->listaNegra)
                <a href="{{ route('lista-negra.create', ['trabajador_dni' => $trabajador->dni]) }}" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">
                    Agregar a Lista Negra
                </a>
                @endif
                @endcan

                @can('delete.trabajadores')
                <form action="{{ route('trabajadores.destroy', $trabajador->dni) }}" method="POST" style="display:inline;"
                      onsubmit="return confirm('¿Estás seguro de que deseas eliminar este trabajador?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded transition">
                        Eliminar
                    </button>
                </form>
                @endcan

                <a href="{{ route('trabajadores.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white font-semibold py-2 px-4 rounded transition">
                    Volver
                </a>
            </div>
        </div>

        <!-- Grid: 2 columnas -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna Izquierda (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información Personal -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Información Personal</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">DNI</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->dni }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Nombre Completo</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->nombre_completo }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Fecha de Nacimiento</p>
                                @if($trabajador->fecha_nacimiento)
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->fecha_nacimiento->format('d/m/Y') }}</p>
                                <p class="text-gray-500 text-xs">{{ $trabajador->fecha_nacimiento->age }} años</p>
                                @else
                                <p class="text-gray-500 font-semibold mt-1">No registrado</p>
                                @endif
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Nacionalidad</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->nacionalidad }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información Laboral -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Información Laboral</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Cargo</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cargo }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Área/Departamento</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->area_departamento }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Unidad</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->unidad }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Fecha de Ingreso</p>
                                @if($trabajador->fecha_ingreso)
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->fecha_ingreso->format('d/m/Y') }}</p>
                                @else
                                <p class="text-gray-500 font-semibold mt-1">No registrado</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Información de Contacto</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Teléfono</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->telefono ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Email</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->email ?? '-' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <p class="text-gray-600 text-sm font-medium">Dirección Actual</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->direccion_actual ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Contacto de Emergencia</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->contacto_emergencia ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Teléfono de Emergencia</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->telefono_emergencia ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Datos Bancarios -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Datos Bancarios</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Cuenta Bancaria</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cuenta_bancaria ?? '-' }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 text-sm font-medium">CCI</p>
                                <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->cci ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Historial de Contratos -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Historial de Contratos</h2>
                        
                        @if ($trabajador->contratos->count() > 0)
                        <div class="space-y-4">
                            @foreach ($trabajador->contratos->sortByDesc('created_at') as $contrato)
                            <div class="border-l-4 {{ $contrato->estado === 'Activo' ? 'border-green-600' : 'border-gray-400' }} pl-4 py-3 bg-gray-50 rounded-r">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <p class="text-gray-900 font-semibold">{{ $contrato->numero_contrato }}</p>
                                        <p class="text-gray-600 text-sm">{{ $contrato->tipo_contrato }}</p>
                                        <p class="text-gray-600 text-sm">{{ $contrato->fecha_inicio->format('d/m/Y') }} - {{ $contrato->fecha_fin->format('d/m/Y') }}</p>
                                        
                                        @if ($contrato->adendas->count() > 0)
                                        <p class="text-blue-600 text-sm font-semibold mt-1">
                                            {{ $contrato->adendas->count() }} renovación(es)
                                        </p>
                                        @endif
                                    </div>
                                    <div class="text-right">
                                        @if ($contrato->estado === 'Activo')
                                        <span class="inline-block px-3 py-1 bg-green-50 text-green-700 rounded text-xs font-semibold border border-green-200">Activo</span>
                                        @elseif ($contrato->estado === 'Vencido')
                                        <span class="inline-block px-3 py-1 bg-red-50 text-red-700 rounded text-xs font-semibold border border-red-200">Vencido</span>
                                        @elseif ($contrato->estado === 'Firmado')
                                        <span class="inline-block px-3 py-1 bg-blue-50 text-blue-700 rounded text-xs font-semibold border border-blue-200">Firmado</span>
                                        @else
                                        <span class="inline-block px-3 py-1 bg-gray-50 text-gray-700 rounded text-xs font-semibold border border-gray-200">{{ $contrato->estado }}</span>
                                        @endif
                                        
                                        <div class="mt-2">
                                            <a href="{{ route('contratos.show', $contrato->id) }}" class="text-blue-600 hover:text-blue-800 text-sm">
                                                Ver detalles
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-8 text-gray-500">
                            <p class="mb-4">No hay contratos registrados</p>
                            @can('create.contratos')
                            <a href="{{ route('contratos.create', ['trabajador_dni' => $trabajador->dni]) }}" class="inline-block bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                                Crear Primer Contrato
                            </a>
                            @endcan
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Columna Derecha (1/3) -->
            <div class="space-y-6">
                <!-- Tiempo en la Empresa -->
               <!-- Tiempo en la Empresa -->
                @php
                    $ahora = \Carbon\Carbon::now();
                    $ingreso = $trabajador->fecha_ingreso;
                    
                    // Calcular años, meses y días de forma correcta
                    $anos = 0;
                    $meses = 0;
                    $dias = 0;
                    
                   if ($ingreso < $ahora) {
                        // Calcular años
                        $anos = intval($ingreso->diffInYears($ahora));
                        
                        // Calcular meses (después de restar los años)
                        $fechaTemp = $ingreso->copy()->addYears($anos);
                        $meses = intval($fechaTemp->diffInMonths($ahora));
                        
                        // Calcular días (después de restar años y meses)
                        $fechaTemp = $fechaTemp->addMonths($meses);
                        $dias = intval($fechaTemp->diffInDays($ahora));
                    }
                    $mesesTotales = $trabajador->contratos->sum(function($contrato) {
                        $mesesContrato = $contrato->fecha_inicio->diffInMonths($contrato->fecha_fin);
                        $mesesAdendas = $contrato->adendas->sum(function($adenda) {
                            return $adenda->fecha_inicio->diffInMonths($adenda->fecha_fin);
                        });
                        return $mesesContrato + $mesesAdendas;
                    });
                @endphp

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Tiempo en Empresa</h3>
                        
                        <div class="space-y-4">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-gray-600 text-sm font-medium">Años</p>
                                <p class="text-3xl font-bold text-blue-600">{{ $anos }}</p>
                            </div>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-gray-600 text-xs font-medium">Meses</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $meses }}</p>
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-gray-600 text-xs font-medium">Días</p>
                                    <p class="text-2xl font-bold text-blue-600">{{ $dias }}</p>
                                </div>
                            </div>

                            <!-- Indicador de estabilidad laboral -->
                            @if ($mesesTotales >= 57)
                            <div class="bg-red-50 border border-red-200 text-red-700 p-3 rounded">
                                <p class="font-bold text-sm">Alerta: Próximo a 5 años</p>
                                <p class="text-xs mt-1">Se requiere decisión urgente</p>
                            </div>
                            @elseif ($mesesTotales >= 48)
                            <div class="bg-yellow-50 border border-yellow-200 text-yellow-700 p-3 rounded">
                                <p class="font-bold text-sm">Precaución</p>
                                <p class="text-xs mt-1">4+ años de servicio</p>
                            </div>
                            @else
                            <div class="bg-green-50 border border-green-200 text-green-700 p-3 rounded">
                                <p class="font-bold text-sm">Normal</p>
                                <p class="text-xs mt-1">Menos de 4 años</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Cumpleaños -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Cumpleaños</h3>
                        
                        @if($trabajador->fecha_nacimiento)
                           @php
                                $proximoCumple = \Carbon\Carbon::create(now()->year, $trabajador->fecha_nacimiento->month, $trabajador->fecha_nacimiento->day);
                                if ($proximoCumple->isPast()) {
                                    $proximoCumple->addYear();
                                }
                                $diasFaltantes = ceil(now()->diffInDays($proximoCumple, false));
                                if ($diasFaltantes < 0) $diasFaltantes = 0;
                                $esHoy = now()->format('m-d') === $trabajador->fecha_nacimiento->format('m-d');
                            @endphp
                            
                            <div class="space-y-3">
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                    <p class="text-gray-600 text-sm font-medium">Fecha</p>
                                    <p class="text-gray-900 font-semibold mt-1">{{ $trabajador->fecha_nacimiento->format('d/m/Y') }}</p>
                                </div>

                                @if($esHoy)
                                <div class="bg-purple-50 border border-purple-200 text-purple-700 p-4 rounded-lg">
                                    <p class="font-bold text-sm">Hoy es su cumpleaños</p>
                                    <p class="text-xs mt-1">Felicidades por {{ $trabajador->fecha_nacimiento->age }} años</p>
                                </div>
                                @else
                                <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                                    <p class="text-gray-600 text-sm font-medium">Próximo cumpleaños</p>
                                    <p class="text-3xl font-bold text-purple-600 mt-1">{{ $diasFaltantes }}</p>
                                    <p class="text-gray-600 text-xs mt-2">{{ $diasFaltantes === 1 ? 'día' : 'días' }}</p>
                                </div>
                                @endif
                            </div>
                        @else
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <p class="text-gray-500 text-sm">Fecha de nacimiento no registrada</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Currículum Vitae -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Currículum Vitae</h3>
                        
                        @if ($trabajador->tieneCV())
                        <div class="space-y-3">
                            <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                                <p class="text-gray-600 text-xs font-medium mb-2">Estado: Cargado</p>
                                <p class="text-gray-900 text-sm truncate">{{ basename($trabajador->cv_path) }}</p>
                            </div>
                            
                            <a href="{{ route('trabajadores.descargar-cv', $trabajador->dni) }}" 
                               class="w-full block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-3 rounded text-center text-sm transition">
                                Descargar
                            </a>
                            
                            @can('edit.trabajadores')
                            <button type="button" class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-3 rounded text-sm transition"
                                    onclick="if(confirm('¿Estás seguro de que quieres eliminar el CV?')) { 
                                        fetch('{{ route('trabajadores.eliminar-cv', $trabajador->dni) }}', {
                                            method: 'DELETE',
                                            headers: {'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content}
                                        }).then(() => location.reload());
                                    }">
                                Eliminar
                            </button>
                            @endcan
                        </div>
                        @else
                        <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 text-center">
                            <p class="text-gray-500 text-sm mb-3">Sin CV cargado</p>
                            @can('edit.trabajadores')
                            <a href="{{ route('trabajadores.edit', $trabajador->dni) }}" class="text-blue-600 hover:text-blue-800 text-sm font-semibold">
                                Cargar CV
                            </a>
                            @endcan
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Auditoría -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-6">Auditoría</h3>
                        
                        <div class="space-y-3 text-sm">
                            <div>
                                <p class="text-gray-600 font-medium">Creado</p>
                                <p class="text-gray-900 mt-1">{{ $trabajador->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div>
                                <p class="text-gray-600 font-medium">Última Actualización</p>
                                <p class="text-gray-900 mt-1">{{ $trabajador->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection