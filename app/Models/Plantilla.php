<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plantilla extends Model
{
    protected $table = 'plantillas';

    protected $fillable = [
        'nombre',
        'codigo_prefijo',
        'descripcion',
        'tipo_contrato',
        'patron_tipo',
        'unidad',
        'empresa_principal',
        'ubicacion',
        'contenido_html',
        'blade_template',
        'orden',
        'clausulas_aplicables',
        'es_predeterminada',
        'activa',
        'created_by',
        'updated_by',
    ];

    protected $casts = [
        'clausulas_aplicables' => 'array',
        'es_predeterminada' => 'boolean',
        'activa' => 'boolean',
    ];

    // Relaciones
    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'plantilla_id', 'id');
    }

    public function creadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function actualizadoPor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    // Métodos útiles
    public function esPredeterminada(): bool
    {
        return $this->es_predeterminada === true;
    }

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

    public function obtenerClausulas(): array
    {
        return $this->clausulas_aplicables ?? [];
    }

    public function actualizarClausulas(array $clausulas): bool
    {
        return $this->update(['clausulas_aplicables' => $clausulas]);
    }
}