<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CodigoContrato extends Model
{
    protected $table = 'codigo_contratos';

    protected $fillable = [
        'codigo_base',
        'correlativo',
    ];

    protected $casts = [
        'correlativo' => 'integer',
    ];

    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'codigo_base_id', 'id');
    }

    public static function obtenerOCrear(string $codigoBase): self
    {
        return self::firstOrCreate(
            ['codigo_base' => $codigoBase],
            ['correlativo' => 0]
        );
    }

    public function obtenerProximoCorrelativo(): int
    {
        $this->increment('correlativo');
        return $this->correlativo;
    }

    public function generarCodigoCompleto(): string
    {
        // CAMBIO: padding de 2 a 3 dígitos (001 en lugar de 01)
        $correlativoFormateado = str_pad($this->correlativo, 3, '0', STR_PAD_LEFT);
        return "{$this->codigo_base}-{$correlativoFormateado}";
    }

    public function getCodigoActual(): string
    {
        // CAMBIO: padding de 2 a 3 dígitos (001 en lugar de 01)
        $correlativoFormateado = str_pad($this->correlativo, 3, '0', STR_PAD_LEFT);
        return "{$this->codigo_base}-{$correlativoFormateado}";
    }

    public function generarYGuardarProximoCodigo(): string
    {
        $this->obtenerProximoCorrelativo();
        return $this->generarCodigoCompleto();
    }

    public function getProximoCorrelativo(): int
    {
        return $this->correlativo + 1;
    }

    public function getProximoCodigoPreview(): string
    {
        $proximoCorrelativo = $this->getProximoCorrelativo();
        // CAMBIO: padding de 2 a 3 dígitos (001 en lugar de 01)
        $correlativoFormateado = str_pad($proximoCorrelativo, 3, '0', STR_PAD_LEFT);
        return "{$this->codigo_base}-{$correlativoFormateado}";
    }
}