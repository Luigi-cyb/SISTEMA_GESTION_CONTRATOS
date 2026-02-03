<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cumpleaños extends Model
{
    protected $table = 'cumpleaños';

    protected $fillable = [
        'dni',
        'fecha_cumpleaños',
        'giftcard_entregada',
        'fecha_entrega_giftcard',
        'monto_giftcard',
        'entregado_por',
    ];

    protected $casts = [
        'fecha_cumpleaños' => 'date',
        'giftcard_entregada' => 'boolean',
        'fecha_entrega_giftcard' => 'date',
    ];

    // Relaciones
    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class, 'dni', 'dni');
    }

    public function entregadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'entregado_por', 'id');
    }

    // Métodos útiles
    public function diasParaCumpleaños(): int
    {
        $hoy = now();
        $cumpleaños = $this->fecha_cumpleaños->setYear(now()->year);

        if ($cumpleaños < $hoy) {
            $cumpleaños = $cumpleaños->addYear();
        }

        return $hoy->diffInDays($cumpleaños);
    }

    public function esProximoCumpleaños(): bool
    {
        return $this->diasParaCumpleaños() <= 5 && $this->diasParaCumpleaños() >= 0;
    }

    public function esHoyCumpleaños(): bool
    {
        $hoy = now();
        return $this->fecha_cumpleaños->format('m-d') === $hoy->format('m-d');
    }

    public function marcarGiftcardEntregada($montoGiftcard, $entregadoPor): bool
    {
        return $this->update([
            'giftcard_entregada' => true,
            'fecha_entrega_giftcard' => now(),
            'monto_giftcard' => $montoGiftcard,
            'entregado_por' => $entregadoPor,
        ]);
    }
}