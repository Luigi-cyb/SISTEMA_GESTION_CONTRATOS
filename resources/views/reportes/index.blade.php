@extends('layouts.app')

@section('content')
    <div class="mb-6">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">{{ __('Reportes') }}</h2>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <!-- Título -->
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800">📊 Centro de Reportes</h3>
                        <p class="text-gray-600 mt-2">Genere reportes en Excel o PDF según sus necesidades</p>
                    </div>

                    <!-- Grid de Reportes -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        <!-- REPORTE 1: Contratos Activos -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-blue-100 rounded-full p-3">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-lg font-bold text-gray-800">Contratos Activos</h4>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Lista de contratos activos con tiempo acumulado</p>
                                <a href="{{ route('reportes.contratos-activos') }}" class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Ver Reporte
                                </a>
                            </div>
                        </div>

                        <!-- REPORTE 2: Próximos a Vencer -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-yellow-100 rounded-full p-3">
                                        <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-lg font-bold text-gray-800">Próximos a Vencer</h4>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Contratos que vencen en los próximos 30 días</p>
                                <a href="{{ route('reportes.proximos-vencer') }}" class="block w-full text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Ver Reporte
                                </a>
                            </div>
                        </div>

                        <!-- REPORTE 3: Por Departamento -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 rounded-full p-3">
                                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-lg font-bold text-gray-800">Por Departamento</h4>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Reporte de trabajadores por departamento</p>
                                <a href="{{ route('reportes.por-departamento') }}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Ver Reporte
                                </a>
                            </div>
                        </div>

                        <!-- REPORTE 4: Tiempo Acumulado -->
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-purple-100 rounded-full p-3">
                                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-lg font-bold text-gray-800">Tiempo Acumulado</h4>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">Tiempo acumulado por trabajador</p>
                                <a href="{{ route('reportes.tiempo-acumulado') }}" class="block w-full text-center bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Ver Reporte
                                </a>
                            </div>
                        </div>

                        <!-- REPORTE 5: Próximos a ser Estables (CRÍTICO) -->
                        <div class="bg-white border border-red-300 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <div class="bg-red-100 rounded-full p-3">
                                        <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                        </svg>
                                    </div>
                                    <h4 class="ml-3 text-lg font-bold text-red-600">Próximos a ser Estables</h4>
                                </div>
                                <p class="text-gray-600 text-sm mb-4">⚠️ CRÍTICO: Trabajadores cerca de 5 años</p>
                                <a href="{{ route('reportes.proximos-estables') }}" class="block w-full text-center bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                                    Ver Reporte CRÍTICO
                                </a>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection