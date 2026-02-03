<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-semibold text-3xl text-gray-800 leading-tight">
                    🎁 Registrar Entrega de Regalo
                </h2>
                <p class="text-sm text-gray-600 mt-1">Completa el formulario para registrar la entrega</p>
            </div>
            <a href="{{ route('cumpleaños.index') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded-lg transition shadow-sm hover:shadow-md">
                ← Volver
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjeta de Información del Trabajador -->
            <div class="bg-gradient-to-r from-blue-50 to-blue-100 border border-blue-200 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 px-6 py-4">
                    <h3 class="text-lg font-bold text-white flex items-center gap-2">
                        👤 Datos del Trabajador
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-lg border border-blue-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">📋 DNI</label>
                            <p class="mt-2 text-xl font-bold text-gray-900">{{ $cumpleaños->trabajador->dni }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-blue-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">👤 Nombre Completo</label>
                            <p class="mt-2 text-lg font-bold text-gray-900">{{ $cumpleaños->trabajador->nombre_completo }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-blue-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">💼 Cargo</label>
                            <p class="mt-2 text-lg font-semibold text-gray-900">{{ $cumpleaños->trabajador->cargo }}</p>
                        </div>
                        <div class="bg-white p-4 rounded-lg border border-blue-200">
                            <label class="block text-xs font-bold text-gray-600 uppercase tracking-wide">🎂 Cumpleaños</label>
                            <p class="mt-2 text-lg font-bold text-purple-600">{{ \Carbon\Carbon::parse($cumpleaños->fecha_cumpleaños)->locale('es')->translatedFormat('d \d\e F') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Registro -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-gray-100">
                <div class="bg-gradient-to-r from-green-50 to-green-100 px-6 py-4 border-b border-green-200">
                    <h3 class="text-lg font-bold text-green-900 flex items-center gap-2">
                        📝 Información del Regalo
                    </h3>
                </div>

                <form method="POST" action="{{ route('cumpleaños.registrar-giftcard', $cumpleaños->id) }}" class="p-6">
                    @csrf

                    <!-- Fecha de Entrega -->
                    <div class="mb-6">
                        <label for="fecha_entrega_giftcard" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                            📅 Fecha de Entrega
                            <span class="text-red-500 text-lg">*</span>
                        </label>
                        <input type="date" 
                               id="fecha_entrega_giftcard" 
                               name="fecha_entrega_giftcard" 
                               value="{{ old('fecha_entrega_giftcard', now()->format('Y-m-d')) }}"
                               class="w-full px-4 py-3 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-transparent transition" 
                               required>
                        @error('fecha_entrega_giftcard')
                            <p class="mt-2 text-sm text-red-600 font-semibold">❌ {{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-600">Selecciona la fecha en que entregaste el regalo</p>
                    </div>

                    <!-- Monto de la Giftcard -->
                    <div class="mb-6">
                        <label for="monto_giftcard" class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                            💰 Monto del Regalo
                            <span class="text-red-500 text-lg">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-2xl text-gray-400">S/</span>
                            <input type="number" 
                                   id="monto_giftcard" 
                                   name="monto_giftcard" 
                                   value="{{ old('monto_giftcard', '100.00') }}"
                                   step="0.01"
                                   min="0"
                                   class="w-full pl-12 pr-4 py-3 rounded-lg border-gray-300 shadow-sm focus:ring-2 focus:ring-green-500 focus:border-transparent transition text-lg font-semibold" 
                                   required>
                        </div>
                        @error('monto_giftcard')
                            <p class="mt-2 text-sm text-red-600 font-semibold">❌ {{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-600">Ingresa el monto total del regalo entregado</p>
                    </div>

                    <!-- Información Adicional -->
                    <div class="mb-8 bg-gradient-to-r from-amber-50 to-amber-100 border border-amber-200 p-4 rounded-lg">
                        <div class="flex items-start gap-3">
                            <span class="text-2xl">ℹ️</span>
                            <div>
                                <p class="font-semibold text-amber-900">Información Importante</p>
                                <p class="text-sm text-amber-800 mt-2">
                                    Al registrar esta entrega, tu nombre de usuario quedará registrado como la persona responsable de la entrega. Asegúrate de que los datos sean precisos.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="flex justify-between items-center gap-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('cumpleaños.index') }}" 
                           class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-6 rounded-lg transition shadow-sm hover:shadow-md flex items-center gap-2">
                            ✕ Cancelar
                        </a>
                        <button type="submit" 
                                class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white font-bold py-3 px-8 rounded-lg transition shadow-sm hover:shadow-md flex items-center gap-2">
                            ✅ Registrar Entrega
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>