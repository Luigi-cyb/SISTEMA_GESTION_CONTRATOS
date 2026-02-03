<?php

namespace App\Services;

use App\Models\Contrato;
use App\Models\Trabajador;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Exception;

class GeneradorContratosPDF
{
    /**
     * Genera un PDF del contrato basado en la plantilla seleccionada
     * 
     * @param Contrato $contrato
     * @param Trabajador $trabajador
     * @param string $plantilla Nombre de la plantilla blade (ej: chungar_agua_mtp)
     * @return string Ruta del PDF generado en storage
     */
    public function generar(Contrato $contrato, Trabajador $trabajador, string $plantilla): string
    {
        try {
            // Validar que la plantilla existe
            $plantillaPath = "contratos.templates.{$plantilla}";
            if (!view()->exists($plantillaPath)) {
                throw new Exception("La plantilla '{$plantilla}' no existe.");
            }

            // Preparar datos para la plantilla
            $datos = [
                'contrato' => $contrato,
                'trabajador' => $trabajador,
                'meses' => [
                    1 => 'Enero',
                    2 => 'Febrero',
                    3 => 'Marzo',
                    4 => 'Abril',
                    5 => 'Mayo',
                    6 => 'Junio',
                    7 => 'Julio',
                    8 => 'Agosto',
                    9 => 'Septiembre',
                    10 => 'Octubre',
                    11 => 'Noviembre',
                    12 => 'Diciembre'
                ]
            ];

            // Generar HTML desde la plantilla Blade
            $html = view($plantillaPath, $datos)->render();

            // Crear PDF con DomPDF
            $pdf = Pdf::loadHTML($html);
            
            // Configurar opciones del PDF
            $pdf->setPaper('A4', 'portrait');
            $pdf->setOption('dpi', 150);
            $pdf->setOption('defaultMediaType', 'screen');

            // Crear ruta de almacenamiento
            $nombreArchivo = $this->generarNombreArchivo($contrato);
            $ruta = "contratos/firmados/{$nombreArchivo}";

            // Crear directorio si no existe
            if (!Storage::exists('contratos/firmados')) {
                Storage::makeDirectory('contratos/firmados', 0755, true);
            }

            // Guardar el PDF
            Storage::put($ruta, $pdf->output());

            // Actualizar el registro del contrato con la ruta del PDF
            $contrato->update([
                'url_documento_escaneado' => $ruta,
                'contrato_firmado' => $ruta,
                'estado' => 'Generado'
            ]);

            return $ruta;

        } catch (Exception $e) {
            \Log::error('Error generando PDF de contrato: ' . $e->getMessage(), [
                'contrato_id' => $contrato->id,
                'trabajador_id' => $trabajador->id,
                'plantilla' => $plantilla
            ]);
            throw $e;
        }
    }

    /**
     * Descargar el PDF generado
     * 
     * @param string $rutaPDF Ruta del archivo en storage
     * @return \Symfony\Component\HttpFoundation\StreamedResponse
     */
    public function descargar(string $rutaPDF)
    {
        if (!Storage::exists($rutaPDF)) {
            throw new Exception("El archivo PDF no existe: {$rutaPDF}");
        }

        return Storage::download($rutaPDF);
    }

    /**
     * Regenerar PDF de un contrato existente
     * 
     * @param Contrato $contrato
     * @param string $plantilla
     * @return string Ruta del nuevo PDF
     */
    public function regenerar(Contrato $contrato, string $plantilla): string
    {
        $trabajador = $contrato->trabajador;

        // Eliminar PDF anterior si existe
        if ($contrato->contrato_firmado && Storage::exists($contrato->contrato_firmado)) {
            Storage::delete($contrato->contrato_firmado);
        }

        // Generar nuevo PDF
        return $this->generar($contrato, $trabajador, $plantilla);
    }

    /**
     * Generar nombre único para el archivo PDF
     * 
     * @param Contrato $contrato
     * @return string
     */
    private function generarNombreArchivo(Contrato $contrato): string
    {
        $timestamp = now()->timestamp;
        $numeroContrato = str_replace('/', '-', $contrato->numero_contrato ?? 'CONT-' . $timestamp);
        return "contrato_{$numeroContrato}_{$timestamp}.pdf";
    }

    /**
     * Obtener lista de plantillas disponibles
     * 
     * @return array
     */
    public function obtenerPlantillasDisponibles(): array
    {
        return [
            'alpamarca_proyectos_cm' => 'Alpamarca - Proyectos CM',
            'central_administracion_14x7' => 'Central - Administración (14x7)',
            'central_administracion_8h' => 'Central - Administración (8h)',
            'central_cancha_pb' => 'Central - Cancha PB',
            'chungar_agua_mtp' => 'Chungar - Agua MTP',
            'chungar_agua_rr' => 'Chungar - Agua RR',
            'chungar_administracion' => 'Chungar - Administración',
            'chungar_cm' => 'Chungar - CM',
            'chungar_dc' => 'Chungar - DC',
            'chungar_la' => 'Chungar - LA',
            'chungar_pf' => 'Chungar - PF',
            'chungar_proyectos' => 'Chungar - Proyectos',
            'chungar_transporte' => 'Chungar - Transporte',
            'huaron_orden_trabajo' => 'Huarón - Orden de Trabajo',
            'romina_proyectos' => 'Romina - Proyectos'
        ];
    }

    /**
     * Validar que el contrato tenga todos los datos requeridos
     * 
     * @param Contrato $contrato
     * @param Trabajador $trabajador
     * @return array ['valido' => bool, 'errores' => array]
     */
    public function validarDatos(Contrato $contrato, Trabajador $trabajador): array
    {
        $errores = [];

        // Validar datos del trabajador
        if (empty($trabajador->nombre)) {
            $errores[] = 'El nombre del trabajador es requerido';
        }
        if (empty($trabajador->dni)) {
            $errores[] = 'El DNI del trabajador es requerido';
        }
        if (empty($trabajador->direccion)) {
            $errores[] = 'La dirección del trabajador es requerida';
        }

        // Validar datos del contrato
        if (empty($contrato->numero_contrato)) {
            $errores[] = 'El número de contrato es requerido';
        }
        if (empty($contrato->cargo)) {
            $errores[] = 'El cargo es requerido';
        }
        if (empty($contrato->fecha_inicio)) {
            $errores[] = 'La fecha de inicio es requerida';
        }
        if (empty($contrato->fecha_fin)) {
            $errores[] = 'La fecha de fin es requerida';
        }
        if (empty($contrato->salario)) {
            $errores[] = 'El salario es requerido';
        }

        return [
            'valido' => count($errores) === 0,
            'errores' => $errores
        ];
    }
}