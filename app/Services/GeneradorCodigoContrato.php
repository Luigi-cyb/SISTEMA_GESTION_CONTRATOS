<?php

namespace App\Services;

use App\Models\CodigoContrato;
use App\Models\Plantilla;

class GeneradorCodigoContrato
{
    /**
     * ✅ ARREGLADO: Usa la BD en lugar de mapeo hardcodeado
     * 
     * CAMBIO: Se eliminó MAPEO_PLANTILLAS hardcodeado
     * AHORA: Lee el codigo_prefijo directamente de la tabla plantillas
     */
    
    public static function generar(int $plantilla_id): string
    {
        $codigoBase = self::obtenerCodigoBase($plantilla_id);

        if (!$codigoBase) {
            throw new \Exception("Plantilla ID {$plantilla_id} no encontrada o sin código prefijo");
        }

        $secuencia = CodigoContrato::obtenerOCrear($codigoBase);
        return $secuencia->generarYGuardarProximoCodigo();
    }

    /**
     * ✅ ARREGLADO: Obtiene el codigo_prefijo DIRECTAMENTE de la tabla plantillas
     * En lugar de usar un mapeo hardcodeado
     */
    public static function obtenerCodigoBase(int $plantilla_id): ?string
    {
        // Buscar la plantilla en la BD
        $plantilla = Plantilla::find($plantilla_id);
        
        if (!$plantilla) {
            return null;
        }
        
        // Retornar el codigo_prefijo de la plantilla
        // Si no tiene codigo_prefijo, usar el nombre
        return $plantilla->codigo_prefijo ?? $plantilla->nombre;
    }

    public static function obtenerCodigoActual(int $plantilla_id): string
    {
        $codigoBase = self::obtenerCodigoBase($plantilla_id);
        $secuencia = CodigoContrato::obtenerOCrear($codigoBase);
        return $secuencia->getCodigoActual();
    }

    public static function obtenerProximoCorrelativo(int $plantilla_id): int
    {
        $codigoBase = self::obtenerCodigoBase($plantilla_id);
        $secuencia = CodigoContrato::obtenerOCrear($codigoBase);
        return $secuencia->getProximoCorrelativo();
    }

    public static function obtenerProximoCodigoPreview(int $plantilla_id): string
    {
        $codigoBase = self::obtenerCodigoBase($plantilla_id);
        $secuencia = CodigoContrato::obtenerOCrear($codigoBase);
        return $secuencia->getProximoCodigoPreview();
    }

    public static function obtenerTodosLosCodigos(): array
    {
        $codigos = CodigoContrato::all();
        $resultado = [];

        foreach ($codigos as $codigo) {
            $resultado[$codigo->codigo_base] = [
                'codigo_base' => $codigo->codigo_base,
                'correlativo_actual' => $codigo->correlativo,
                'proximo_codigo' => $codigo->getProximoCodigoPreview(),
            ];
        }

        return $resultado;
    }

    public static function resetearCorrelativo(int $plantilla_id, int $nuevoValor = 0): bool
    {
        $codigoBase = self::obtenerCodigoBase($plantilla_id);
        
        if (!$codigoBase) {
            return false;
        }

        $secuencia = CodigoContrato::obtenerOCrear($codigoBase);
        $secuencia->update(['correlativo' => $nuevoValor]);

        return true;
    }
}