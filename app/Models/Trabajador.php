<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Trabajador extends Model
{
    protected $table = 'trabajadores';
    protected $primaryKey = 'dni';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'dni',
        'nombre_completo',
        'fecha_nacimiento',
        'nacionalidad',
        'cargo',
        'area_departamento',
        'unidad',
        'telefono',
        'email',
        'direccion_actual',
        'contacto_emergencia',
        'telefono_emergencia',
        'cuenta_bancaria',
        'cci',
        'cv_path',
        'estado',
        'fecha_ingreso',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'fecha_ingreso' => 'date',
    ];

    // ========== RELACIONES ==========
    
    public function contratos(): HasMany
    {
        return $this->hasMany(Contrato::class, 'dni', 'dni');
    }

    public function adendas(): HasMany
    {
        return $this->hasMany(Adenda::class, 'dni', 'dni');
    }

    public function alertas(): HasMany
    {
        return $this->hasMany(Alerta::class, 'dni', 'dni');
    }

    public function listaNegra(): HasOne
    {
        return $this->hasOne(ListaNegra::class, 'dni', 'dni');
    }

    public function cumpleaños(): HasOne
    {
        return $this->hasOne(Cumpleaños::class, 'dni', 'dni');
    }

    // ========== MÉTODOS PERSONALIZADOS ==========

    /**
     * Verificar si el trabajador está en lista negra (bloqueado)
     * 
     * NUEVO: Método para verificar si está bloqueado
     */
    public function estaEnListaNegra(): bool
    {
        return ListaNegra::where('dni', $this->dni)
            ->where('estado', 'Bloqueado')
            ->exists();
    }

    /**
     * Obtener el estado correcto del trabajador
     * 
     * NUEVO: Si está inactivo + en lista negra → "Suspendido"
     *        Si está inactivo + no en lista negra → "Inactivo"
     *        Si está activo → "Activo"
     */
    public function getEstadoCorrectoAttribute(): string
    {
        // Si está activo, devolver "Activo"
        if ($this->estado === 'Activo') {
            return 'Activo';
        }

        // Si está inactivo, verificar si está en lista negra
        if ($this->estado === 'Inactivo') {
            if ($this->estaEnListaNegra()) {
                return 'Suspendido';
            }
            return 'Inactivo';
        }

        // Para cualquier otro estado, devolverlo tal cual
        return $this->estado;
    }

    /**
     * Método para marcar como inactivo
     * 
     * NUEVO: Al marcar como inactivo, se actualiza automáticamente el estado
     * a "Suspendido" si está en lista negra
     */
    public function marcarInactivo(): void
    {
        $this->estado = 'Inactivo';

        // Si está en lista negra, cambiar a "Suspendido"
        if ($this->estaEnListaNegra()) {
            $this->estado = 'Suspendido';
        }

        $this->save();
    }

    /**
     * Método para reactivar un trabajador
     * 
     * NUEVO: Al reactivar, cambiar estado a "Activo"
     */
    public function marcarActivo(): void
    {
        $this->estado = 'Activo';
        $this->save();
    }

    /**
     * Boot del modelo
     * 
     * NUEVO: Al guardar, si está bloqueado en lista negra y es inactivo,
     * cambiar a "Suspendido"
     */
    protected static function boot()
    {
        parent::boot();

        // Cuando se actualiza el trabajador
        static::updating(function ($trabajador) {
            // Si el estado se cambió a "Inactivo"
            if ($trabajador->isDirty('estado') && $trabajador->estado === 'Inactivo') {
                // Verificar si está en lista negra
                if ($trabajador->estaEnListaNegra()) {
                    $trabajador->estado = 'Suspendido';
                }
            }
        });

        // Cuando se crea el trabajador
        static::creating(function ($trabajador) {
            // Si se crea como "Inactivo" y está en lista negra
            if ($trabajador->estado === 'Inactivo' && $trabajador->estaEnListaNegra()) {
                $trabajador->estado = 'Suspendido';
            }
        });
    }

    /**
     * Obtener el badge de estado para la vista
     * 
     * NUEVO: Devuelve HTML con el color correcto según el estado
     */
    public function getEstadoBadgeAttribute(): string
    {
        $estado = $this->getEstadoCorrectoAttribute();

        return match($estado) {
            'Activo' => '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">🟢 Activo</span>',
            'Inactivo' => '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">⚫ Inactivo</span>',
            'Suspendido' => '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">🔴 Suspendido</span>',
            default => '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">🟡 ' . $estado . '</span>',
        };
    }

    // ========== MÉTODOS PARA MANEJO DE CV ==========

    /**
     * Verificar si el trabajador tiene CV cargado
     */
    public function tieneCV(): bool
    {
        return !empty($this->cv_path) && file_exists(storage_path('app/public/' . $this->cv_path));
    }

    /**
     * Obtener la ruta pública del CV
     */
    public function getUrlCV(): ?string
    {
        if ($this->tieneCV()) {
            return asset('storage/' . $this->cv_path);
        }
        return null;
    }

    /**
     * Eliminar el CV anterior (útil al actualizar)
     */
    public function eliminarCVAnterior(): void
    {
        if ($this->cv_path && file_exists(storage_path('app/public/' . $this->cv_path))) {
            unlink(storage_path('app/public/' . $this->cv_path));
        }
    }
}