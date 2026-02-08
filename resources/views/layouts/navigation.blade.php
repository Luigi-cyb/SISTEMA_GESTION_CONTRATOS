<nav class="bg-gray-900 text-white h-full flex flex-col">
    <!-- Logo -->
    <div class="p-4 border-b border-gray-700 flex-shrink-0 flex items-center justify-center">
        <a href="{{ route('dashboard') }}" class="flex items-center">
            <img src="https://www.emiconsath.com/assets/images/logo/logoblanco.png" alt="EMICONSATH"
                class="h-10 w-auto object-contain">
        </a>
    </div>

    <!-- Usuario Info -->
    <div class="px-4 py-2 border-b border-gray-700 flex-shrink-0">
        <p class="text-sm text-gray-300 font-medium truncate">{{ Auth::user()->name }}</p>
        <p class="text-xs text-gray-600 mt-1">{{ Auth::user()->getRoleNames()->first() ?? 'Usuario' }}</p>
    </div>

    <!-- Menú Principal (scrolleable) -->
    <div class="flex-1 overflow-y-auto px-2 py-2 space-y-1">


        <!-- Dashboard -->
        <a href="{{ route('dashboard') }}"
            class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M3 12l2-3m2 3l2-3m2 3l2-3m2-4a3 3 0 00-6 0 3 3 0 006 0zM3 20h18a2 2 0 002-2V4a2 2 0 00-2-2H5a2 2 0 00-2 2v14a2 2 0 002 2z">
                </path>
            </svg>
            <span class="truncate">Dashboard</span>
        </a>

        <!-- Trabajadores -->
        @can('view.trabajadores')
            <a href="{{ route('trabajadores.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('trabajadores.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 4.354a4 4 0 110 5.292M15 12H9m4 5h-4m7-11a4 4 0 110 5.292M19 12a7 7 0 11-14 0 7 7 0 0114 0z">
                    </path>
                </svg>
                <span class="truncate">Trabajadores</span>
            </a>
        @endcan

        <!-- Contratos -->
        @can('view.contratos')
            <a href="{{ route('contratos.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('contratos.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <span class="truncate">Contratos</span>
            </a>
        @endcan

        <!-- Adendas -->
        @can('view.adendas')
            <a href="{{ route('adendas.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('adendas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                <span class="truncate">Adendas</span>
            </a>
        @endcan

        <!-- Lista Negra -->
        @can('view.lista_negra')
            <a href="{{ route('lista-negra.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('lista-negra.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4v2m0 4v2M7.5 8.5a2.5 2.5 0 110 5 2.5 2.5 0 010-5zm0 10a2.5 2.5 0 110 5 2.5 2.5 0 010-5zm7.5-10a2.5 2.5 0 110 5 2.5 2.5 0 010-5zm0 10a2.5 2.5 0 110 5 2.5 2.5 0 010-5z">
                    </path>
                </svg>
                <span class="truncate">Lista Negra</span>
            </a>
        @endcan

        <!-- Reportes -->
        @can('view.reportes')
            <a href="{{ route('reportes.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('reportes.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                    </path>
                </svg>
                <span class="truncate">Reportes</span>
            </a>
        @endcan

        <!-- Plantillas -->
        @can('view.plantillas')
            <a href="{{ route('plantillas.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('plantillas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                    </path>
                </svg>
                <span class="truncate">Plantillas</span>
            </a>
        @endcan

        <!-- Cumpleaños -->
        @can('view.cumpleaños')
            <a href="{{ route('cumpleaños.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('cumpleaños.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <span class="truncate">Cumpleaños</span>
            </a>
        @endcan

        <!-- Alertas (solo Admin) -->
        @if(Auth::user()->hasRole('Admin'))
            @can('view.alertas')
                <a href="{{ route('alertas.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('alertas.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9">
                        </path>
                    </svg>
                    <span class="truncate">Alertas</span>
                </a>
            @endcan
        @endif

        <!-- Configuración Empresa -->
        @can('edit.configuracion')
            <a href="{{ route('configuracion-empresa.index') }}"
                class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('configuracion-empresa.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                    </path>
                </svg>
                <span class="truncate">Configuración Empresa</span>
            </a>
        @endcan

        <!-- Usuarios (solo Admin) -->
        @if(Auth::user()->hasRole('Admin'))
            @can('view.usuarios')
                <a href="{{ route('usuarios.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('usuarios.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.856-1.487M7 20H2v-2a3 3 0 015.856-1.487M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 0a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                        </path>
                    </svg>
                    <span class="truncate">Usuarios</span>
                </a>
            @endcan
        @endif

        <!-- Auditoría (solo Admin) -->
        @if(Auth::user()->hasRole('Admin'))
            @can('view.auditoria')
                <a href="{{ route('auditoria.index') }}"
                    class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs {{ request()->routeIs('auditoria.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-800' }} transition">
                    <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    <span class="truncate">Auditoría</span>
                </a>
            @endcan
        @endif
    </div>
    <!-- Menú Inferior - Esquina inferior izquierda -->
    <!-- Menú Inferior - Esquina inferior izquierda -->
    <!-- Menú Inferior - Esquina inferior izquierda -->
    <!-- Separador -->
    <div class="mt-auto border-t border-gray-700 flex-shrink-0"></div>

    <!-- Menú Inferior - Esquina inferior izquierda -->
    <div class="px-2 py-8 space-y-1 flex-shrink-0">
        <a href="{{ route('profile.edit') }}"
            class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-gray-300 hover:bg-gray-800 transition">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                </path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="truncate">Perfil</span>
        </a>

        <!-- Logout -->
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit"
                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-lg text-xs text-gray-300 hover:bg-red-600/20 hover:text-red-300 transition">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span class="truncate">Cerrar sesión</span>
            </button>
        </form>
    </div>

</nav>
</nav>