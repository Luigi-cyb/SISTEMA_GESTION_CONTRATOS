<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Adenda extends Model
{
    protected $table = 'adendas';

    protected $fillable = [
        'contrato_id',
        'dni',
        'adenda_anterior_id',
        'fecha_inicio',
        'fecha_fin',
        'fecha_firma', // <-- AGREGADO
        'numero_adenda',
        'tipo_salario',
        'salario_mensual',
        'salario_jornal',
        'horario',
        'tiempo_acumulado_total_meses',
        'numero_adenda_contrato',
        'url_documento_escaneado',
        'estado',
        'created_by',
        'approved_by',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_firma' => 'date', // <-- AGREGADO
    ];

    // Relaciones
    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class, 'dni', 'dni');
    }

    public function adendaAnterior(): BelongsTo
    {
        return $this->belongsTo(Adenda::class, 'adenda_anterior_id', 'id');
    }

    public function adendasSiguientes(): HasMany
    {
        return $this->hasMany(Adenda::class, 'adenda_anterior_id', 'id');
    }

    // Métodos útiles
    public function diasParaVencimiento(): int
    {
        $hoy = now();
        return $this->fecha_fin->diffInDays($hoy);
    }

    public function estaProximoAVencer(): bool
    {
        return $this->diasParaVencimiento() <= 30 && $this->diasParaVencimiento() >= 0;
    }

    public function estaProximoAEstabilidad(): bool
    {
        return $this->tiempo_acumulado_total_meses >= 57 && $this->tiempo_acumulado_total_meses < 60;
    }
}