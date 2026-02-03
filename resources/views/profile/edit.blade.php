<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">Configuración de Cuenta</h2>
    </x-slot>

    <div class="max-w-4xl mx-auto">
        
        <!-- Tabs de navegación -->
        <div class="bg-white border-b border-gray-200 mb-6 rounded-t-lg">
            <nav class="flex space-x-8 px-6" aria-label="Tabs">
                <a href="#informacion" class="py-4 px-1 border-b-2 border-blue-500 font-medium text-sm text-blue-600 hover:text-blue-700 hover:border-blue-600 active-tab" data-tab="informacion">
                    Información Personal
                </a>
                <a href="#seguridad" class="py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 inactive-tab" data-tab="seguridad">
                    Seguridad
                </a>
                <a href="#peligro" class="py-4 px-1 border-b-2 border-transparent font-medium text-sm text-gray-500 hover:text-gray-700 hover:border-gray-300 inactive-tab" data-tab="peligro">
                    Zona de Peligro
                </a>
            </nav>
        </div>

        <!-- TAB 1: Información Personal -->
        <div id="informacion" class="tab-content bg-white shadow-sm rounded-b-lg p-8 mb-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Información Personal</h3>
                <p class="text-sm text-gray-500">Actualiza tu información de perfil y correo electrónico.</p>
            </div>
            <div class="border-t border-gray-200 pt-6">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- TAB 2: Seguridad -->
        <div id="seguridad" class="tab-content hidden bg-white shadow-sm rounded-lg p-8 mb-6">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-1">Seguridad de Cuenta</h3>
                <p class="text-sm text-gray-500">Gestiona la seguridad de tu cuenta y acceso.</p>
            </div>
            <div class="border-t border-gray-200 pt-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- TAB 3: Zona de Peligro -->
        <div id="peligro" class="tab-content hidden bg-white shadow-sm rounded-lg p-8 mb-6 border-t-4 border-red-500">
            <div class="mb-6">
                <h3 class="text-lg font-semibold text-red-900 mb-1">Zona de Peligro</h3>
                <p class="text-sm text-red-700">Acciones irreversibles. Procede con cuidado.</p>
            </div>
            <div class="border-t border-red-200 pt-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

    <script>
        document.querySelectorAll('[data-tab]').forEach(tab => {
            tab.addEventListener('click', (e) => {
                e.preventDefault();
                
                // Ocultar todos los tabs
                document.querySelectorAll('.tab-content').forEach(content => {
                    content.classList.add('hidden');
                });
                
                // Remover bordes activos
                document.querySelectorAll('[data-tab]').forEach(t => {
                    t.classList.remove('border-blue-500', 'text-blue-600');
                    t.classList.add('border-transparent', 'text-gray-500');
                });
                
                // Activar tab clickeado
                const tabName = tab.getAttribute('data-tab');
                document.getElementById(tabName).classList.remove('hidden');
                tab.classList.remove('border-transparent', 'text-gray-500');
                tab.classList.add('border-blue-500', 'text-blue-600');
            });
        });
    </script>
</x-app-layout>