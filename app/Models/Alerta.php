<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alerta extends Model
{
    protected $table = 'alertas';

    protected $fillable = [
        'dni',
        'contrato_id',
        'tipo',
        'destinatario',
        'titulo',
        'descripcion',
        'fecha_alerta',
        'fecha_vencimiento_evento',
        'prioridad',
        'color_indicador',
        'estado',
        'medio_notificacion',
    ];

    protected $casts = [
        'fecha_alerta' => 'date',
        'fecha_vencimiento_evento' => 'date',
    ];

    // Relaciones
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class, 'dni', 'dni');
    }

    public function contrato(): BelongsTo
    {
        return $this->belongsTo(Contrato::class, 'contrato_id', 'id');
    }

    // Métodos útiles
    public function marcarComoLeida(): bool
    {
        return $this->update(['estado' => 'Leída']);
    }

    public function marcarComoResuelta(): bool
    {
        return $this->update(['estado' => 'Resuelta']);
    }

    public function esCritica(): bool
    {
        return $this->prioridad === 'Crítica';
    }

    public function esEstabilidad(): bool
    {
        return $this->tipo === 'Estabilidad laboral (5 años)';
    }

    public function esCumpleaños(): bool
    {
        return $this->tipo === 'Cumpleaños';
    }

    public function esVencimiento(): bool
    {
        return $this->tipo === 'Vencimiento de contrato';
    }
}