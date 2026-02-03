<?php

namespace App\Http\Controllers;

use App\Models\ConfiguracionEmpresa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class ConfiguracionEmpresaController extends Controller
{
    /**
     * Mostrar formulario de configuración
     */
    public function index(): View
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.configuracion')) {
            abort(403, 'No tienes permiso para ver la configuración de la empresa.');
        }

        $configuracion = ConfiguracionEmpresa::obtener();

        return view('configuracion-empresa.index', compact('configuracion'));
    }

    /**
     * Actualizar configuración de la empresa
     */
    public function update(Request $request): RedirectResponse
    {
        // Verificar permiso
        if (!auth()->user()->can('edit.configuracion')) {
            abort(403, 'No tienes permiso para editar la configuración de la empresa.');
        }

        // Validar datos
        $validated = $request->validate([
            'razon_social' => 'required|string|max:255',
            'ruc' => 'required|string|size:11',
            'direccion' => 'required|string',
            'gerente_nombre' => 'required|string|max:255',
            'gerente_titulo' => 'nullable|string|max:50',
            'gerente_dni' => 'required|string|size:8',
        ], [
            'razon_social.required' => 'La razón social es obligatoria',
            'ruc.required' => 'El RUC es obligatorio',
            'ruc.size' => 'El RUC debe tener exactamente 11 dígitos',
            'direccion.required' => 'La dirección es obligatoria',
            'gerente_nombre.required' => 'El nombre del gerente es obligatorio',
            'gerente_dni.required' => 'El DNI del gerente es obligatorio',
            'gerente_dni.size' => 'El DNI debe tener exactamente 8 dígitos',
        ]);

        // Obtener configuración actual
        $configuracion = ConfiguracionEmpresa::obtener();

        // Actualizar datos
        $validated['updated_by'] = auth()->id();
        $configuracion->update($validated);

        // Registrar en auditoría
        \App\Models\Auditoria::create([
            'usuario_id' => auth()->id(),
            'accion' => 'Actualizar Configuración Empresa',
            'tabla' => 'configuracion_empresa',
            'registro_id' => $configuracion->id,
            'descripcion' => 'Actualizó la configuración de la empresa',
            'datos_nuevos' => json_encode($validated),
        ]);

        return redirect()->route('configuracion-empresa.index')
            ->with('success', '✅ Configuración de la empresa actualizada correctamente.');
    }
}