<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clausula extends Model
{
    protected $table = 'clausulas';

    protected $fillable = [
        'nombre',
        'contenido',
        'tipo_aplicable',
        'activa',
        'orden',
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    // Métodos útiles
    public function estaActiva(): bool
    {
        return $this->activa === true;
    }

    public function activar(): bool
    {
        return $this->update(['activa' => true]);
    }

    public function desactivar(): bool
    {
        return $this->update(['activa' => false]);
    }

    public function esAplicableA($tipoContrato): bool
    {
        return $this->tipo_aplicable === 'Todas' || $this->tipo_aplicable === $tipoContrato;
    }

    public static function porTipoContrato($tipoContrato)
    {
        return self::where('activa', true)
            ->where(function ($query) use ($tipoContrato) {
                $query->where('tipo_aplicable', 'Todas')
                    ->orWhere('tipo_aplicable', $tipoContrato);
            })
            ->orderBy('orden')
            ->get();
    }
}