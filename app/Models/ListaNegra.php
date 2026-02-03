<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ListaNegra extends Model
{
    protected $table = 'lista_negra';

    protected $fillable = [
        'dni',
        'motivo',
        'descripcion_motivo',
        'url_informe_escaneado',
        'puede_desbloquear',
        'url_carta_compromiso',
        'url_autorizacion',
        'estado',
        'fecha_bloqueo',
        'fecha_desbloqueo',
        'bloqueado_por',
        'desbloqueado_por',
    ];

    protected $casts = [
        'puede_desbloquear' => 'boolean',
        'fecha_bloqueo' => 'date',
        'fecha_desbloqueo' => 'date',
    ];

    // Relaciones
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class, 'dni', 'dni');
    }

    public function bloqueadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'bloqueado_por', 'id');
    }

    public function desbloqueadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'desbloqueado_por', 'id');
    }

    // Métodos útiles
    public function esMotivGrave(): bool
    {
        return $this->motivo === 'Grave';
    }

    public function esMotivLeve(): bool
    {
        return $this->motivo === 'Leve';
    }

    public function estaBloqueado(): bool
    {
        return $this->estado === 'Bloqueado';
    }

    public function desbloquear(): bool
    {
        if (!$this->puede_desbloquear) {
            return false;
        }

        return $this->update([
            'estado' => 'Desbloqueado',
            'fecha_desbloqueo' => now(),
        ]);
    }
}