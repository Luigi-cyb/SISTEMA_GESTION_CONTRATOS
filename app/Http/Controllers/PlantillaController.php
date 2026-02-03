<?php

namespace App\Http\Controllers;

use App\Models\Plantilla;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class PlantillaController extends Controller
{
    // Listar plantillas
    public function index(Request $request)
    {
        $tipo = $request->input('tipo');
        $query = Plantilla::where('activa', true);
        
        if ($tipo) {
            $query->where('tipo_contrato', $tipo);
        }
        
        $plantillas = $query->orderBy('es_predeterminada', 'desc')->paginate(10);
        return view('plantillas.index', compact('plantillas', 'tipo'));
    }

    // Crear plantilla
    public function create()
    {
        $tipos = ['Para servicio específico', 'Por incremento de actividad', 'Indefinido', 'Practicante'];
        return view('plantillas.create', compact('tipos'));
    }

    // Guardar plantilla
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:plantillas|max:150',
            'tipo_contrato' => 'required|in:Para servicio específico,Por incremento de actividad,Indefinido,Practicante',
            'contenido_html' => 'required',
        ]);

        Plantilla::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo_contrato' => $request->tipo_contrato,
            'contenido_html' => $request->contenido_html,
            'es_predeterminada' => false,
            'activa' => true,
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('plantillas.index')->with('success', 'Plantilla creada');
    }

    // Ver plantilla
    public function show(Plantilla $plantilla)
    {
        return view('plantillas.show', compact('plantilla'));
    }

    // Editar plantilla
    public function edit(Plantilla $plantilla)
    {
        $tipos = ['Para servicio específico', 'Por incremento de actividad', 'Indefinido', 'Practicante'];
        return view('plantillas.edit', compact('plantilla', 'tipos'));
    }

    // Actualizar plantilla
    public function update(Request $request, Plantilla $plantilla)
    {
        $request->validate([
            'nombre' => 'required|max:150|unique:plantillas,nombre,' . $plantilla->id,
            'tipo_contrato' => 'required|in:Para servicio específico,Por incremento de actividad,Indefinido,Practicante',
            'contenido_html' => 'required',
        ]);

        $plantilla->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'tipo_contrato' => $request->tipo_contrato,
            'contenido_html' => $request->contenido_html,
            'activa' => $request->boolean('activa', true),
            'updated_by' => Auth::id(),
        ]);

        return redirect()->route('plantillas.show', $plantilla)->with('success', 'Plantilla actualizada');
    }

    // Eliminar plantilla
    public function destroy(Plantilla $plantilla)
    {
        if ($plantilla->es_predeterminada) {
            return redirect()->back()->with('error', 'No se puede eliminar plantilla predeterminada');
        }
        
        $plantilla->delete();
        return redirect()->route('plantillas.index')->with('success', 'Plantilla eliminada');
    }

    // Vista previa con datos de ejemplo
    public function preview(Plantilla $plantilla)
    {
        $contenido = $this->reemplazarVariables($plantilla->contenido_html, [
            'nombre_completo' => 'Juan Pérez García',
            'dni' => '12345678',
            'cargo' => 'Ingeniero de Sistemas',
            'area' => 'TI',
            'unidad' => 'Chungar',
            'salario_mensual' => '3500.00',
            'horario' => '8 horas',
            'fecha_inicio' => '01/02/2026',
            'fecha_fin' => '01/05/2026',
            'beneficios_ley_728' => 'Sí',
        ]);
        
        return view('plantillas.preview', compact('plantilla', 'contenido'));
    }

    // Reemplazar variables
    private function reemplazarVariables($contenido, $datos)
    {
        foreach ($datos as $clave => $valor) {
            $contenido = str_replace('{{' . $clave . '}}', $valor, $contenido);
        }
        return $contenido;
    }

    /**
     * Generar PDF de la plantilla
     */
    public function generarPDF(Plantilla $plantilla, Request $request)
    {
        $datos = [
            'nombre_completo' => 'Juan Pérez García',
            'dni' => '12345678',
            'cargo' => 'Ingeniero de Sistemas',
            'area' => 'TI',
            'unidad' => 'Chungar',
            'salario_mensual' => '3500.00',
            'horario' => '8 horas',
            'fecha_inicio' => '01/02/2026',
            'fecha_fin' => '01/05/2026',
            'beneficios_ley_728' => 'Sí',
        ];

        $contenido = $this->reemplazarVariables($plantilla->contenido_html, $datos);
        
        $pdf = Pdf::loadHTML($contenido);
        
        return $pdf->download('plantilla_' . $plantilla->nombre . '.pdf');
    }
}