<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                    🎂 Detalle de Cumpleaños
                </h2>
                <p class="text-sm text-gray-600 mt-1">Información y registro de entregas de regalos</p>
            </div>
            <a href="{{ route('cumpleaños.index') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm hover:shadow-md flex items-center gap-2">
                ← Volver a Lista
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Alerta si es próximo -->
            @if($cumpleaños->dias_restantes <= 5 && $cumpleaños->dias_restantes != 0)
            <div class="mb-6 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 p-4 rounded-r-lg">
                <div class="flex items-center gap-3">
                    <span class="text-3xl">🔔</span>
                    <div>
                        <p class="font-bold text-red-800 text-lg">Cumpleaños Próximo</p>
                        <p class="text-red-700 text-sm mt-1">Faltan <strong>{{ $cumpleaños->dias_restantes }} día{{ $cumpleaños->dias_restantes != 1 ? 's' : '' }}</strong> para el cumpleaños.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Alerta HOY ES CUMPLEAÑOS -->
            @if($cumpleaños->dias_restantes == 0)
            <div class="mb-6 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 p-4 rounded-r-lg animate-pulse">
                <div class="flex items-center gap-3">
                    <span class="text-4xl">🎉</span>
                    <div>
                        <p class="font-bold text-green-800 text-lg">¡Hoy es su cumpleaños!</p>
                        <p class="text-green-700 text-sm mt-1">Asegúrate de entregarle su regalo especial.</p>
                    </div>
                </div>
            </div>
            @endif

            <!-- Tarjeta de Trabajador -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 mb-6">
                <div class="bg-gradient-to-r from-blue-50 to-blue-100 px-6 py-4 border-b border-blue-200">
                    <h3 class="text-lg font-bold text-blue-900 flex items-center gap-2">
                        👤 Información del Trabajador
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">📋 DNI</label>
                            <p class="mt-2 text-2xl font-bold text-gray-900">{{ $cumpleaños->trabajador->dni }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">👤 Nombre Completo</label>
                            <p class="mt-2 text-xl font-bold text-gray-900">{{ $cumpleaños->trabajador->nombre_completo }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">💼 Cargo</label>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cumpleaños->trabajador->cargo }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">🏢 Departamento</label>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cumpleaños->trabajador->area_departamento ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">📧 Email</label>
                            <p class="mt-2 text-sm text-gray-900 font-medium break-all">{{ $cumpleaños->trabajador->email ?? 'N/A' }}</p>
                        </div>
                        <div class="bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">📱 Teléfono</label>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cumpleaños->trabajador->telefono ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Cumpleaños -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100 mb-6">
                <div class="bg-gradient-to-r from-purple-50 to-purple-100 px-6 py-4 border-b border-purple-200">
                    <h3 class="text-lg font-bold text-purple-900 flex items-center gap-2">
                        🎂 Información del Cumpleaños
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200 text-center">
                            <label class="block text-xs font-bold text-purple-600 uppercase tracking-wide">📅 Fecha</label>
                            <p class="mt-3 text-2xl font-bold text-purple-900">
                                {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('d') }}
                            </p>
                            <p class="text-sm font-semibold text-purple-700 mt-1">
                                {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('F') }}
                            </p>
                        </div>

                        <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg border border-orange-200 text-center">
                            <label class="block text-xs font-bold text-orange-600 uppercase tracking-wide">📊 Edad</label>
                            <p class="mt-3 text-4xl font-bold text-orange-900">
                                {{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->age }}
                            </p>
                            <p class="text-sm font-semibold text-orange-700 mt-1">años</p>
                        </div>

                        <div class="bg-gradient-to-br from-pink-50 to-pink-100 p-6 rounded-lg border border-pink-200 text-center">
                            <label class="block text-xs font-bold text-pink-600 uppercase tracking-wide">⏱️ Faltan</label>
                            <p class="mt-3">
                                @if($cumpleaños->dias_restantes == 0)
                                    <span class="text-4xl font-bold text-pink-900">¡HOY!</span>
                                @else
                                    <span class="text-4xl font-bold text-pink-900">{{ $cumpleaños->dias_restantes }}</span>
                                    <p class="text-sm font-semibold text-pink-700 mt-1">día{{ $cumpleaños->dias_restantes != 1 ? 's' : '' }}</p>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tarjeta de Giftcard -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-6 py-4 border-b border-amber-200">
                    <h3 class="text-lg font-bold text-amber-900 flex items-center gap-2">
                        🎁 Estado del Regalo
                    </h3>
                </div>
                <div class="p-6">
                    
                    @if($cumpleaños->giftcard_entregada)
                        <!-- Giftcard entregada -->
                        <div class="bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg p-6 mb-6">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="text-4xl">✅</span>
                                <div>
                                    <span class="text-lg font-bold text-green-800">Regalo Entregado</span>
                                    <p class="text-sm text-green-700">El regalo ha sido entregado al trabajador</p>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 bg-white p-4 rounded-lg border border-green-200">
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">📅 Fecha Entrega</label>
                                    <p class="mt-2 text-lg font-bold text-gray-900">{{ \Carbon\Carbon::parse($cumpleaños->fecha_entrega_giftcard)->format('d/m/Y') }}</p>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">💰 Monto</label>
                                    <p class="mt-2 text-xl font-bold text-green-600">S/ {{ number_format($cumpleaños->monto_giftcard, 2) }}</p>
                                </div>
                                @if($cumpleaños->entregadoPor)
                                <div>
                                    <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">👤 Entregado Por</label>
                                    <p class="mt-2 text-sm font-semibold text-gray-900">{{ $cumpleaños->entregadoPor->name }}</p>
                                </div>
                                @endif
                            </div>
                        </div>

                        @can('edit.cumpleaños')
                        <form action="{{ route('cumpleaños.cancelar-giftcard', $cumpleaños->id) }}" method="POST" 
                              onsubmit="return confirm('¿Está seguro de cancelar esta entrega de regalo?')" class="mt-4">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white font-bold py-3 px-4 rounded-lg transition shadow-sm hover:shadow-md flex items-center justify-center gap-2">
                                ❌ Cancelar Entrega
                            </button>
                        </form>
                        @endcan
                    @else
                        <!-- Giftcard pendiente -->
                        <div class="bg-gradient-to-r from-amber-50 to-amber-100 border border-amber-200 rounded-lg p-6 mb-6">
                            <div class="flex items-center gap-3 mb-4">
                                <span class="text-4xl">⏳</span>
                                <div>
                                    <span class="text-lg font-bold text-amber-800">Regalo Pendiente</span>
                                    <p class="text-sm text-amber-700">Aún no se ha entregado el regalo al trabajador</p>
                                </div>
                            </div>
                            
                            @can('registrar.giftcard')
                            <a href="{{ route('cumpleaños.registrar-giftcard-form', $cumpleaños->id) }}" 
                               class="inline-block w-full bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-4 rounded-lg transition shadow-sm hover:shadow-md text-center">
                                🎁 Registrar Entrega de Regalo
                            </a>
                            @endcan
                        </div>
                    @endif
                </div>
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-center mt-8">
                <a href="{{ route('cumpleaños.index') }}" 
                   class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition shadow-sm hover:shadow-md flex items-center gap-2">
                    ← Volver a la Lista
                </a>
            </div>

        </div>
    </div>
</x-app-layout>