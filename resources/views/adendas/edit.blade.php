@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold text-gray-800">✏️ Editar Adenda</h1>
                <p class="text-gray-600 mt-1">Adenda #{{ $adenda->numero_adenda }} - {{ $adenda->numero_adenda_contrato }}</p>
            </div>
        </div>

        <!-- Información de la Adenda (No editable) -->
        <div class="bg-gray-50 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-6">📋 Información de la Adenda</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="text-gray-600 text-sm">Número de Adenda</p>
                        <p class="text-gray-900 font-semibold">#{{ $adenda->numero_adenda }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Contrato Original</p>
                        <p class="text-gray-900 font-semibold">{{ $adenda->contrato->numero_contrato }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Trabajador</p>
                        <p class="text-gray-900 font-semibold">{{ $adenda->trabajador->nombre_completo }}</p>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm">Tiempo Acumulado Total</p>
                        <p class="text-gray-900 font-semibold">{{ $adenda->tiempo_acumulado_total_meses }} meses ({{ number_format($adenda->tiempo_acumulado_total_meses / 12, 1) }} años)</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Formulario -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <form action="{{ route('adendas.update', $adenda->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Errores de Validación -->
                    @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                        <strong>❌ Error en la validación:</strong>
                        <ul class="mt-2 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <!-- SECCIÓN: Fechas de la Adenda -->
                    <div class="mb-8 pb-8 border-b border-gray-200">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">📅 Vigencia de la Adenda</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Fecha Inicio -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Inicio *</label>
                                <input type="date" name="fecha_inicio" value="{{ old('fecha_inicio', $adenda->fecha_inicio?->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_inicio') border-red-500 @enderror">
                                @error('fecha_inicio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Fin -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Fin *</label>
                                <input type="date" name="fecha_fin" value="{{ old('fecha_fin', $adenda->fecha_fin?->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_fin') border-red-500 @enderror">
                                @error('fecha_fin')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- ✅ NUEVO: Fecha de Firma -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700">Fecha de Firma *</label>
                                <p class="text-gray-600 text-xs mb-2">(Por defecto: un día antes de la fecha de inicio)</p>
                                <input type="date" name="fecha_firma" id="fecha_firma" 
                                       value="{{ old('fecha_firma', $adenda->fecha_firma?->format('Y-m-d')) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('fecha_firma') border-red-500 @enderror">
                                @error('fecha_firma')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- SECCIÓN: Remuneración (No editable) -->
                    <div class="mb-8 pb-8 border-b border-gray-200 bg-gray-50 p-4 rounded">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">💰 Remuneración (Copiada del Contrato Original)</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-gray-600 text-sm">Tipo de Salario</p>
                                <p class="text-gray-900 font-semibold">{{ $adenda->tipo_salario }}</p>
                            </div>
                            @if ($adenda->salario_mensual)
                            <div>
                                <p class="text-gray-600 text-sm">Salario Mensual</p>
                                <p class="text-gray-900 font-semibold">S/. {{ number_format($adenda->salario_mensual, 2) }}</p>
                            </div>
                            @endif
                            @if ($adenda->salario_jornal)
                            <div>
                                <p class="text-gray-600 text-sm">Salario Jornal</p>
                                <p class="text-gray-900 font-semibold">S/. {{ number_format($adenda->salario_jornal, 2) }}</p>
                            </div>
                            @endif
                            <div>
                                <p class="text-gray-600 text-sm">Horario</p>
                                <p class="text-gray-900 font-semibold">{{ $adenda->horario }}</p>
                            </div>
                        </div>
                        <p class="text-gray-600 text-xs mt-4">
                            ℹ️ Para cambiar la remuneración, edita el contrato original.
                        </p>
                    </div>

                    <!-- SECCIÓN: Estado -->
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">⚙️ Estado de la Adenda</h2>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Estado *</label>
                            <select name="estado" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('estado') border-red-500 @enderror">
                                <option value="">-- Selecciona estado --</option>
                                <option value="Borrador" {{ old('estado', $adenda->estado) === 'Borrador' ? 'selected' : '' }}>Borrador</option>
                                <option value="Enviado a firmar" {{ old('estado', $adenda->estado) === 'Enviado a firmar' ? 'selected' : '' }}>Enviado a firmar</option>
                                <option value="Firmado" {{ old('estado', $adenda->estado) === 'Firmado' ? 'selected' : '' }}>Firmado</option>
                                <option value="Activo" {{ old('estado', $adenda->estado) === 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Vencida" {{ old('estado', $adenda->estado) === 'Vencida' ? 'selected' : '' }}>Vencida</option>
                                <option value="Cancelada" {{ old('estado', $adenda->estado) === 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('estado')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex gap-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded">
                            ✅ Guardar Cambios
                        </button>
                        <a href="{{ route('adendas.show', $adenda->id) }}" class="bg-gray-600 hover:bg-gray-700 text-white font-bold py-2 px-6 rounded">
                            ❌ Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// ✅ Script mejorado para actualizar automáticamente fecha de firma cuando cambia fecha de inicio
document.querySelector('input[name="fecha_inicio"]').addEventListener('change', function() {
    const fechaInicio = new Date(this.value);
    if (!isNaN(fechaInicio.getTime())) {
        // Restar un día para fecha de firma
        fechaInicio.setDate(fechaInicio.getDate() - 1);
        
        // Formatear como YYYY-MM-DD
        const year = fechaInicio.getFullYear();
        const month = String(fechaInicio.getMonth() + 1).padStart(2, '0');
        const day = String(fechaInicio.getDate()).padStart(2, '0');
        
        document.getElementById('fecha_firma').value = `${year}-${month}-${day}`;
    }
});
</script>
@endsection