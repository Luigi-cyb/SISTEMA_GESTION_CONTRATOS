@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Encabezado -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-gray-800">🎉 Dashboard Bienestar</h1>
        <p class="text-gray-600 mt-2">Gestión de cumpleaños y giftcards</p>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-8">
        <!-- Total Trabajadores -->
        <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">Total Trabajadores</p>
            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalTrabajadores }}</p>
            <p class="text-xs text-gray-500 mt-1">Activos</p>
        </div>

        <!-- Próximos Cumpleaños -->
        <div class="bg-pink-50 border-l-4 border-pink-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">🎂 Próximos</p>
            <p class="text-4xl font-bold text-pink-600 mt-2">{{ $totalProximos }}</p>
            <p class="text-xs text-gray-500 mt-1">Próximos 30 días</p>
        </div>

        <!-- Alertas Cumpleaños -->
        <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">🔔 Alertas</p>
            <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $totalAlertas }}</p>
            <p class="text-xs text-gray-500 mt-1">Pendientes</p>
        </div>

        <!-- Giftcards Pendientes -->
        <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">🎁 Pendientes</p>
            <p class="text-4xl font-bold text-red-600 mt-2">{{ $giftcardsPendientes->count() }}</p>
            <p class="text-xs text-gray-500 mt-1">Por entregar</p>
        </div>

        <!-- Giftcards Este Mes -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4">
            <p class="text-gray-600 text-sm font-semibold">✅ Este Mes</p>
            <p class="text-4xl font-bold text-green-600 mt-2">{{ $giftcardsEntregadasMes }}</p>
            <p class="text-xs text-gray-500 mt-1">Entregadas</p>
        </div>
    </div>

    <!-- NUEVA SECCIÓN: GRÁFICOS -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Gráfico de Barras: Cumpleaños por Mes -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">📊 Cumpleaños por Mes</h2>
            <div style="position: relative; height: 300px;">
                <canvas id="cumpleanosPorMesChart"></canvas>
            </div>
            <p class="text-xs text-gray-500 mt-2">Total: <span id="totalCumpleaños">0</span> cumpleaños</p>
        </div>

        <!-- Gráfico de Pastel: Estado de Giftcards -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">🍰 Estado de Giftcards</h2>
            <div style="position: relative; height: 300px;">
                <canvas id="estadoGiftcardsChart"></canvas>
            </div>
            <p class="text-xs text-gray-500 mt-2">Total: <span id="totalGiftcards">0</span> giftcards</p>
        </div>
    </div>

    <!-- Grid Principal -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Próximos Cumpleaños -->
        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">🎂 Próximos Cumpleaños (30 días)</h2>
            @if($proximosCumpleaños->count() > 0)
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @foreach($proximosCumpleaños as $cumple)
                @php
                    $trabajador = $cumple->trabajador;
                    if (!$trabajador) continue;
                    
                    $proximoCumpleaños = \Carbon\Carbon::parse($cumple->fecha_cumpleaños)
                        ->setYear(\Carbon\Carbon::now()->year);
                    if ($proximoCumpleaños < \Carbon\Carbon::now()) {
                        $proximoCumpleaños->addYear();
                    }
                    $edad = $cumple->fecha_cumpleaños ? 
                        \Carbon\Carbon::parse($cumple->fecha_cumpleaños)->age : 0;
                    
                    // Calcular días restantes SIN decimales
                    $diasRestantes = (int) \Carbon\Carbon::now()->diffInDays($proximoCumpleaños, false);
                @endphp
                <div class="border-l-4 border-pink-500 bg-pink-50 p-4 rounded">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <p class="font-bold text-gray-900">🎂 {{ $trabajador->nombre_completo }}</p>
                                @if($cumple->giftcard_entregada)
                                <span class="px-2 py-1 text-xs font-bold rounded-full bg-green-100 text-green-800 border border-green-300">
                                    ✅ Entregado
                                </span>
                                @endif
                            </div>
                            <p class="text-sm text-gray-600">DNI: {{ $trabajador->dni }} | Edad: {{ $edad + 1 }} años</p>
                            <p class="text-xs text-pink-700 mt-1">
                                📅 {{ $proximoCumpleaños->format('d/m/Y') }} 
                                ({{ $diasRestantes }} días)
                            </p>
                            <p class="text-xs text-gray-600 mt-1">{{ $trabajador->cargo ?? 'N/A' }} | {{ $trabajador->area_departamento ?? 'N/A' }}</p>
                        </div>
                        @if(!$cumple->giftcard_entregada)
                        <button onclick="abrirFormularioGiftcard('{{ $trabajador->dni }}', '{{ $trabajador->nombre_completo }}', {{ $loop->index }})" 
                            class="bg-pink-600 hover:bg-pink-700 text-white font-bold px-3 py-1 rounded text-sm whitespace-nowrap ml-2">
                            🎁 Registrar
                        </button>
                        @else
                        <a href="{{ route('cumpleaños.show', $cumple->id) }}" 
                            class="bg-blue-50 hover:bg-blue-100 text-blue-700 font-bold px-3 py-1 rounded text-sm whitespace-nowrap ml-2 border border-blue-200">
                            👁️ Ver
                        </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">No hay cumpleaños próximos en los próximos 30 días</p>
            @endif
        </div>

        <!-- Giftcards Pendientes -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4">🎁 Giftcards Pendientes</h2>
            @if($giftcardsPendientes->count() > 0)
            <div class="space-y-2 max-h-96 overflow-y-auto">
                @foreach($giftcardsPendientes as $giftcard)
                <div class="bg-red-50 border border-red-200 p-3 rounded">
                    <p class="font-bold text-red-900 text-sm">{{ $giftcard->trabajador->nombre_completo }}</p>
                    <p class="text-xs text-red-700">{{ $giftcard->trabajador->dni }}</p>
                    <p class="text-xs text-gray-600 mt-1">
                        📅 {{ \Carbon\Carbon::parse($giftcard->fecha_cumpleaños)->format('d/m/Y') }}
                    </p>
                    <button onclick="marcarEntregado({{ $giftcard->id }})" 
                        class="mt-2 w-full bg-green-600 hover:bg-green-700 text-white font-bold px-2 py-1 rounded text-xs">
                        ✅ Marcar como Entregado
                    </button>
                </div>
                @endforeach
            </div>
            @else
            <p class="text-gray-500 text-center py-4">No hay giftcards pendientes</p>
            @endif
        </div>
    </div>

    <!-- Alertas de Cumpleaños -->
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-bold text-gray-800 mb-4">🔔 Alertas de Cumpleaños</h2>
        @if($alertasCumpleaños->count() > 0)
        <div class="space-y-3 max-h-64 overflow-y-auto">
            @foreach($alertasCumpleaños as $alerta)
            <div class="border-l-4 border-pink-500 bg-pink-50 p-4 rounded">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <p class="font-bold text-pink-900">{{ $alerta->titulo }}</p>
                        <p class="text-sm text-pink-800 mt-1">{{ $alerta->descripcion }}</p>
                    </div>
                    <a href="{{ route('alertas.show', $alerta->id) }}" class="text-pink-600 hover:text-pink-900 text-sm font-bold whitespace-nowrap ml-2">
                        Ver →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <p class="text-gray-500 text-center py-4">No hay alertas de cumpleaños</p>
        @endif
    </div>
</div>

<!-- Modal: Registrar Giftcard -->
<div id="giftcardModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h2 class="text-xl font-bold text-gray-800 mb-4">🎁 Registrar Giftcard</h2>
        <form id="giftcardForm" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" id="cumpleañosId" name="cumpleaños_id">
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Trabajador</label>
                <input type="text" id="trabajadorNombre" readonly class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-100">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Monto Giftcard</label>
                <input type="number" id="monto_giftcard" name="monto_giftcard" step="0.01" placeholder="50.00" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required>
            </div>
            
            <div>
                <label class="block text-sm font-bold text-gray-700 mb-1">Fecha de Entrega</label>
                <input type="date" id="fecha_entrega_giftcard" name="fecha_entrega_giftcard" value="{{ now()->format('Y-m-d') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500" required>
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 rounded">
                    ✅ Guardar
                </button>
                <button type="button" onclick="cerrarModal()" class="flex-1 bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 rounded">
                    ❌ Cancelar
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// ================================================================================
// VARIABLES GLOBALES PARA ALMACENAR LOS CHARTS
// ================================================================================
let chartBarras = null;
let chartPastel = null;

// ✓ EJECUTAR SOLO CUANDO EL DOM ESTÁ COMPLETAMENTE CARGADO
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado - Inicializando gráficos');
    inicializarGraficos();
});

// ================================================================================
// FUNCIÓN PARA VALIDAR FECHAS
// ================================================================================
function obtenerMesCumpleaños(fecha) {
    if (!fecha) return null;
    
    try {
        const date = new Date(fecha);
        
        // Validar que sea una fecha válida
        if (isNaN(date.getTime())) return null;
        
        // Validar que sea un año razonable
        const año = date.getFullYear();
        if (año < 1900 || año > new Date().getFullYear()) return null;
        
        return date.getMonth();
    } catch (e) {
        console.warn('Error procesando fecha:', fecha, e);
        return null;
    }
}

// ================================================================================
// FUNCIÓN PRINCIPAL: INICIALIZAR GRÁFICOS
// ================================================================================
function inicializarGraficos() {
    // ✓ PASO 1: Destruir gráficos anteriores si existen
    if (chartBarras !== null) {
        console.log('Destruyendo gráfico de barras anterior');
        chartBarras.destroy();
        chartBarras = null;
    }
    
    if (chartPastel !== null) {
        console.log('Destruyendo gráfico de pastel anterior');
        chartPastel.destroy();
        chartPastel = null;
    }

    // ✓ PASO 2: OBTENER DATOS SIN FILTROS RESTRICTIVOS
    const rawCumpleañosData = @json($proximosCumpleaños);
    
    console.log('=== DATOS ORIGINALES ===');
    console.log('Total registros:', rawCumpleañosData.length);
    console.log('Datos:', rawCumpleañosData);

    // ✓ PASO 3: PROCESAR DATOS PARA GRÁFICO DE BARRAS (SIN FILTRAR)
    const cumpleañosPorMes = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    let cumpleañosProcessados = 0;

    rawCumpleañosData.forEach((cumple, index) => {
        if (cumple && cumple.fecha_cumpleaños) {
            const mes = obtenerMesCumpleaños(cumple.fecha_cumpleaños);
            
            if (mes !== null && mes >= 0 && mes < 12) {
                cumpleañosPorMes[mes]++;
                cumpleañosProcessados++;
                console.log(`Cumpleaño ${index + 1}: ${cumple.fecha_cumpleaños} → Mes ${mes + 1}`);
            } else {
                console.warn(`Cumpleaño ${index + 1}: Fecha inválida - ${cumple.fecha_cumpleaños}`);
            }
        } else {
            console.warn(`Cumpleaño ${index + 1}: Sin fecha_cumpleaños`);
        }
    });

    console.log('=== RESUMEN GRÁFICO DE BARRAS ===');
    console.log('Cumpleaños procesados:', cumpleañosProcessados);
    console.log('Cumpleaños por mes:', cumpleañosPorMes);
    console.log('Enero (mes 0):', cumpleañosPorMes[0]);
    console.log('Febrero (mes 1):', cumpleañosPorMes[1]);

    // ✓ PASO 4: PROCESAR DATOS PARA GRÁFICO DE PASTEL (SIN FILTRAR)
    const totalGiftcards = rawCumpleañosData.length;
    const giftcardsEntregadas = rawCumpleañosData.filter(c => c && c.giftcard_entregada).length;
    const giftcardsPendientes = totalGiftcards - giftcardsEntregadas;

    console.log('=== RESUMEN GRÁFICO DE PASTEL ===');
    console.log('Total giftcards:', totalGiftcards);
    console.log('Entregadas:', giftcardsEntregadas);
    console.log('Pendientes:', giftcardsPendientes);

    // Actualizar totales en la UI
    document.getElementById('totalCumpleaños').textContent = cumpleañosProcessados;
    document.getElementById('totalGiftcards').textContent = totalGiftcards;

    // ✓ PASO 5: CREAR GRÁFICO DE BARRAS
    const ctxBarras = document.getElementById('cumpleanosPorMesChart');
    if (ctxBarras) {
        console.log('Creando gráfico de barras');
        chartBarras = new Chart(ctxBarras, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Cumpleaños',
                    data: cumpleañosPorMes,
                    backgroundColor: 'rgba(236, 72, 153, 0.8)',
                    borderColor: 'rgba(236, 72, 153, 1)',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    } else {
        console.error('Canvas cumpleanosPorMesChart no encontrado');
    }

    // ✓ PASO 6: CREAR GRÁFICO DE PASTEL
    const ctxPastel = document.getElementById('estadoGiftcardsChart');
    if (ctxPastel) {
        console.log('Creando gráfico de pastel');
        chartPastel = new Chart(ctxPastel, {
            type: 'doughnut',
            data: {
                labels: ['Entregadas (' + giftcardsEntregadas + ')', 'Pendientes (' + giftcardsPendientes + ')'],
                datasets: [{
                    data: [giftcardsEntregadas, giftcardsPendientes],
                    backgroundColor: [
                        'rgba(34, 197, 94, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgba(34, 197, 94, 1)',
                        'rgba(239, 68, 68, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    } else {
        console.error('Canvas estadoGiftcardsChart no encontrado');
    }
    
    console.log('Gráficos inicializados correctamente');
}

// ================================================================================
// FUNCIONES DEL MODAL
// ================================================================================
function abrirFormularioGiftcard(dni, nombre, index) {
    const rawCumpleañosData = @json($proximosCumpleaños);
    
    const cumpleañosData = rawCumpleañosData.filter(c => {
        return c && 
               c.fecha_cumpleaños && 
               c.trabajador &&
               obtenerMesCumpleaños(c.fecha_cumpleaños) !== null;
    });
    
    const cumpleaños = cumpleañosData[index];
    
    if (!cumpleaños) {
        alert('Error: No se encontró el registro de cumpleaños');
        return;
    }
    
    const form = document.getElementById('giftcardForm');
    form.action = `/cumpleaños/${cumpleaños.id}/registrar-giftcard`;
    
    document.getElementById('cumpleañosId').value = cumpleaños.id;
    document.getElementById('trabajadorNombre').value = nombre;
    document.getElementById('monto_giftcard').value = '';
    document.getElementById('fecha_entrega_giftcard').value = new Date().toISOString().split('T')[0];
    document.getElementById('giftcardModal').classList.remove('hidden');
}

function cerrarModal() {
    document.getElementById('giftcardModal').classList.add('hidden');
}

function marcarEntregado(id) {
    if (confirm('¿Marcar como entregado?')) {
        // Abre modal con formulario para ingresar monto y fecha
        const modal = document.getElementById('giftcardModal');
        const form = document.getElementById('giftcardForm');
        
        // Obtener el giftcard pendiente
        const rawGiftcardsData = @json($giftcardsPendientes);
        const giftcard = rawGiftcardsData.find(g => g.id === id);
        
        if (giftcard && giftcard.trabajador) {
            form.action = `/cumpleaños/${id}/registrar-giftcard`;
            document.getElementById('cumpleañosId').value = id;
            document.getElementById('trabajadorNombre').value = giftcard.trabajador.nombre_completo;
            document.getElementById('monto_giftcard').value = '';
            document.getElementById('fecha_entrega_giftcard').value = new Date().toISOString().split('T')[0];
            modal.classList.remove('hidden');
        } else {
            alert('Error: No se encontró el registro de giftcard');
        }
    }
}
</script>

@endsection