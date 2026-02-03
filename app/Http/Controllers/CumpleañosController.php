<?php

namespace App\Http\Controllers;

use App\Models\Cumpleaños;
use App\Models\Trabajador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CumpleañosController extends Controller
{
    /**
     * Mostrar lista de cumpleaños próximos
     */
    public function index(Request $request)
{
    // SINCRONIZAR AUTOMÁTICAMENTE (sin clic)
    $this->sincronizarAutomatico();

    // Filtros
    $dias = (int) $request->input('dias', 5);
    $mes = $request->input('mes', null);
    $giftcard = $request->input('giftcard', null);

    // Query base - AGREGAR whereHas PARA FILTRAR SOLO ACTIVOS
    $query = Cumpleaños::with(['trabajador', 'entregadoPor'])
        ->whereHas('trabajador', function($q) {
            $q->where('estado', 'Activo');  // ← AGREGAR ESTA LÍNEA
        });

    // Filtrar por próximos días (AUTOMÁTICO)
    if ($dias && !$mes) {
        $hoy = Carbon::now();
        $fechaLimite = Carbon::now()->addDays($dias);
        
        $query->whereRaw("
            DATE_FORMAT(fecha_cumpleaños, CONCAT(YEAR(NOW()), '-%m-%d')) 
            BETWEEN ? AND ?
        ", [
            $hoy->format('Y-m-d'),
            $fechaLimite->format('Y-m-d')
        ]);
    }

    // Filtrar por mes específico
    if ($mes) {
        $query->whereMonth('fecha_cumpleaños', $mes);
    }

    // Filtrar por estado de giftcard
    if ($giftcard === 'entregadas') {
        $query->where('giftcard_entregada', true);
    } elseif ($giftcard === 'pendientes') {
        $query->where('giftcard_entregada', false);
    }

    // Ordenar por fecha de cumpleaños
    $cumpleaños = $query->orderByRaw("
        DATE_FORMAT(fecha_cumpleaños, CONCAT(YEAR(NOW()), '-%m-%d'))
    ")->get();

    // Calcular días restantes para cada cumpleaños (REDONDEADO)
    foreach ($cumpleaños as $cumple) {
        $cumple->dias_restantes = (int) round($this->calcularDiasRestantes($cumple->fecha_cumpleaños));
    }

    return view('cumpleaños.index', compact('cumpleaños', 'dias', 'mes', 'giftcard'));
}

    /**
     * Mostrar formulario para registrar entrega de giftcard
     */
    public function registrarGiftcardForm($id)
    {
        $cumpleaños = Cumpleaños::with('trabajador')->findOrFail($id);

        // Verificar que no esté ya entregada
        if ($cumpleaños->giftcard_entregada) {
            return redirect()->route('cumpleaños.index')
                ->with('warning', 'La giftcard ya fue entregada anteriormente.');
        }

        return view('cumpleaños.registrar-giftcard', compact('cumpleaños'));
    }

    /**
     * Registrar entrega de giftcard
     */
    public function registrarGiftcard(Request $request, $id)
    {
        $request->validate([
            'monto_giftcard' => 'required|numeric|min:0',
            'fecha_entrega_giftcard' => 'required|date',
        ]);

        $cumpleaños = Cumpleaños::findOrFail($id);

        // Verificar que no esté ya entregada
        if ($cumpleaños->giftcard_entregada) {
            return redirect()->route('cumpleaños.index')
                ->with('warning', 'La giftcard ya fue entregada anteriormente.');
        }

        // Actualizar registro
        $cumpleaños->update([
            'giftcard_entregada' => true,
            'fecha_entrega_giftcard' => $request->fecha_entrega_giftcard,
            'monto_giftcard' => $request->monto_giftcard,
            'entregado_por' => Auth::id(),
        ]);

        return redirect()->route('cumpleaños.index')
            ->with('success', '¡Giftcard registrada exitosamente para ' . $cumpleaños->trabajador->nombre_completo . '!');
    }

    /**
     * API: Obtener cumpleaños próximos (para dashboard y alertas)
     */
    public function proximosCumpleaños(Request $request)
{
    $dias = $request->input('dias', 5);

    $hoy = Carbon::now();
    $fechaLimite = Carbon::now()->addDays($dias);

    $cumpleaños = Cumpleaños::with('trabajador')
        ->whereHas('trabajador', function($q) {
            $q->where('estado', 'Activo');  // ← AGREGAR ESTA LÍNEA
        })
        ->whereRaw("
            DATE_FORMAT(fecha_cumpleaños, CONCAT(YEAR(NOW()), '-%m-%d')) 
            BETWEEN ? AND ?
        ", [
            $hoy->format('Y-m-d'),
            $fechaLimite->format('Y-m-d')
        ])
        ->orderByRaw("
            DATE_FORMAT(fecha_cumpleaños, CONCAT(YEAR(NOW()), '-%m-%d'))
        ")
        ->get();

    foreach ($cumpleaños as $cumple) {
        $cumple->dias_restantes = (int) round($this->calcularDiasRestantes($cumple->fecha_cumpleaños));
    }

    return response()->json([
        'success' => true,
        'cumpleaños' => $cumpleaños,
        'total' => $cumpleaños->count(),
    ]);
}

    /**
     * Sincronización AUTOMÁTICA (sin clic del usuario)
     * Se ejecuta cada vez que se carga la página de cumpleaños
     */
    private function sincronizarAutomatico()
    {
        $trabajadores = Trabajador::whereNotNull('fecha_nacimiento')->get();

        foreach ($trabajadores as $trabajador) {
            // Buscar si existe registro
            $cumpleaños = Cumpleaños::where('dni', $trabajador->dni)->first();

            if (!$cumpleaños) {
                // CREAR nuevo registro
                Cumpleaños::create([
                    'dni' => $trabajador->dni,
                    'fecha_cumpleaños' => $trabajador->fecha_nacimiento,
                    'giftcard_entregada' => false,
                ]);
            } else {
                // ACTUALIZAR registro existente con la fecha más reciente
                if ($cumpleaños->fecha_cumpleaños !== $trabajador->fecha_nacimiento) {
                    $cumpleaños->update([
                        'fecha_cumpleaños' => $trabajador->fecha_nacimiento,
                    ]);
                }
            }
        }
    }

    /**
     * Sincronizar cumpleaños manualmente (para el botón si lo necesitas)
     * (Opcional: mantener para compatibilidad)
     */
    public function sincronizar()
    {
        $this->sincronizarAutomatico();

        return redirect()->route('cumpleaños.index')
            ->with('success', 'Cumpleaños sincronizados exitosamente.');
    }

    /**
     * Ver detalle de un cumpleaños
     */
    public function show($id)
    {
        $cumpleaños = Cumpleaños::with(['trabajador', 'entregadoPor'])->findOrFail($id);
        $cumpleaños->dias_restantes = (int) round($this->calcularDiasRestantes($cumpleaños->fecha_cumpleaños));

        return view('cumpleaños.show', compact('cumpleaños'));
    }

    /**
     * Cancelar/deshacer entrega de giftcard (solo Admin)
     */
    public function cancelarGiftcard($id)
    {
        $cumpleaños = Cumpleaños::findOrFail($id);

        $cumpleaños->update([
            'giftcard_entregada' => false,
            'fecha_entrega_giftcard' => null,
            'monto_giftcard' => null,
            'entregado_por' => null,
        ]);

        return redirect()->route('cumpleaños.index')
            ->with('success', 'Entrega de giftcard cancelada exitosamente.');
    }

    // ========== MÉTODOS AUXILIARES ==========

    /**
     * Calcular días restantes hasta el próximo cumpleaños
     * RETORNA: 0 si hoy es cumpleaños, N si faltan N días
     */
    private function calcularDiasRestantes($fechaNacimiento)
    {
        $hoy = Carbon::now();
        $mesYdiaNacimiento = Carbon::parse($fechaNacimiento)->format('m-d');
        $mesYdiaHoy = $hoy->format('m-d');

        // Si hoy es cumpleaños, retornar 0
        if ($mesYdiaNacimiento === $mesYdiaHoy) {
            return 0;
        }

        $cumpleañosEsteAño = Carbon::createFromFormat('Y-m-d', $hoy->year . '-' . $mesYdiaNacimiento);

        // Si el cumpleaños ya pasó este año, calcular para el próximo año
        if ($cumpleañosEsteAño->isPast()) {
            $cumpleañosEsteAño->addYear();
        }

        // Retorna un entero redondeado
        return (int) round($hoy->diffInDays($cumpleañosEsteAño));
    }

    /**
     * Enviar notificación de cumpleaños (Email + WhatsApp)
     * TODO: Implementar envío de notificaciones
     */
    private function enviarNotificacion($cumpleaños)
    {
        // TODO: Implementar envío de email
        // TODO: Implementar envío de WhatsApp (si es posible)
    }


    /**
 * API: Buscar cumpleaños por DNI del trabajador
 */
public function buscarPorDni($dni)
{
    $cumpleaños = Cumpleaños::whereHas('trabajador', function($query) use ($dni) {
        $query->where('dni', $dni)
              ->where('estado', 'Activo');  // ← AGREGAR ESTA LÍNEA
    })->first();

    if ($cumpleaños) {
        return response()->json([
            'success' => true,
            'cumpleaños_id' => $cumpleaños->id,
            'trabajador' => $cumpleaños->trabajador->nombre_completo ?? 'N/A'
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'No se encontró registro de cumpleaños para este trabajador'
    ], 404);
}

}