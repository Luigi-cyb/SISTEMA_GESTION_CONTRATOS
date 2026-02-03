<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auditoria extends Model
{
    protected $table = 'auditoria';

    protected $fillable = [
        'user_id',
        'accion',
        'modelo',
        'modelo_id',
        'detalles',
        'ip_address',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'detalles' => 'array',
    ];

    // Relación con User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Método auxiliar para registrar auditoria
    public static function registrar($accion, $modelo = null, $modelo_id = null, $detalles = null)
    {
        return self::create([
            'user_id' => auth()->id(),
            'accion' => $accion,
            'modelo' => $modelo,
            'modelo_id' => $modelo_id,
            'detalles' => $detalles,
            'ip_address' => request()->ip(),
            'fecha' => now(),
        ]);
    }
}