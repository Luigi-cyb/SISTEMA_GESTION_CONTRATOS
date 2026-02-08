<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Contrato extends Model
{
    protected $table = 'contratos';

    protected $fillable = [
        'dni',
        'tipo_contrato',
        'fecha_inicio',
        'fecha_fin',
        'tipo_salario',
        'salario_mensual',
        'salario_jornal',
        'horario',
        'beneficios_ley_728',
        'beneficios_descripcion',
        'plantilla_id',
        'numero_contrato',
        'url_documento_escaneado',
        'contrato_firmado',
        'estado',
        'tiempo_acumulado_meses',
        'alerta_estabilidad_enviada',
        'fecha_alerta_estabilidad',
        'fecha_firma',
        'fecha_firma_manual',
        'codigo_base_id',
        'created_by',
        'approved_by',
        'cargo',
        'area_departamento',
        'unidad',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'fecha_firma' => 'datetime',
        'fecha_firma_manual' => 'date',
        'beneficios_ley_728' => 'boolean',
        'alerta_estabilidad_enviada' => 'boolean',
        'fecha_alerta_estabilidad' => 'date',
    ];

    public function trabajador(): BelongsTo
    {
        return $this->belongsTo(Trabajador::class, 'dni', 'dni');
    }

    public function plantilla(): BelongsTo
    {
        return $this->belongsTo(Plantilla::class, 'plantilla_id', 'id');
    }

    public function codigoBase(): BelongsTo
    {
        return $this->belongsTo(CodigoContrato::class, 'codigo_base_id', 'id');
    }

    public function adendas(): HasMany
    {
        return $this->hasMany(Adenda::class, 'contrato_id', 'id');
    }

    public function alertas(): HasMany
    {
        return $this->hasMany(Alerta::class, 'contrato_id', 'id');
    }

    public function getCodigoContratoAttribute(): string
    {
        if ($this->codigoBase) {
            return $this->codigoBase->generarCodigoCompleto();
        }
        return $this->numero_contrato;
    }

    public function getFechaFirmaRealAttribute()
    {
        if ($this->fecha_firma_manual) {
            return $this->fecha_firma_manual;
        }

        return Carbon::parse($this->fecha_inicio)->subDay();
    }

    /**
     * ✅ NUEVO: Calcular tiempo acumulado REAL
     * Calcula desde fecha_inicio del contrato hasta fecha_fin de la última adenda (o del contrato si no hay adendas)
     * 
     * @return float Meses acumulados (puede tener decimales)
     */
    public function calcularTiempoAcumuladoReal(): float
    {
        // Fecha de inicio: siempre del contrato original
        $fechaInicio = Carbon::parse($this->fecha_inicio);

        // Obtener última adenda válida (no cancelada)
        $ultimaAdenda = $this->adendas()
            ->where('estado', '!=', 'Cancelada')
            ->orderBy('numero_adenda', 'desc')
            ->first();

        // Fecha de fin: de la última adenda o del contrato
        $fechaFin = $ultimaAdenda
            ? Carbon::parse($ultimaAdenda->fecha_fin)
            : Carbon::parse($this->fecha_fin);

        // Calcular diferencia en meses (con decimales)
        return $fechaInicio->floatDiffInMonths($fechaFin);
    }

    /**
     * ✅ NUEVO: Alias para calcularTiempoAcumuladoReal por compatibilidad con reportes
     */
    public function calcularMesesAcumulados(): float
    {
        return $this->calcularTiempoAcumuladoReal();
    }

    /**
     * ✅ NUEVO: Calcular tiempo exacto en meses y días (Sin decimales)
     */
    public function calcularTiempoExacto(): string
    {
        $fechaInicio = Carbon::parse($this->fecha_inicio);
        $ultimaAdenda = $this->adendas()
            ->where('estado', '!=', 'Cancelada')
            ->orderBy('numero_adenda', 'desc')
            ->first();
        $fechaFin = $ultimaAdenda
            ? Carbon::parse($ultimaAdenda->fecha_fin)
            : Carbon::parse($this->fecha_fin);

        $diff = $fechaInicio->diff($fechaFin);

        $mesesTotales = ($diff->y * 12) + $diff->m;

        $resultado = "{$mesesTotales} mes(es)";
        if ($diff->d > 0) {
            $resultado .= " y {$diff->d} día(s)";
        }

        return $resultado;
    }

    /**
     * ✅ DEPRECATED: Mantener por compatibilidad pero ya no es preciso
     * @deprecated Use calcularTiempoAcumuladoReal() instead
     */
    public function calcularTiempoAcumulado(): int
    {
        $meses = $this->adendas()->count() * 3;
        return $meses + 3;
    }

    public function diasParaVencimiento(): int
    {
        // Obtener la fecha_fin correcta (de última adenda o contrato)
        $ultimaAdenda = $this->adendas()
            ->where('estado', '!=', 'Cancelada')
            ->orderBy('numero_adenda', 'desc')
            ->first();

        $fechaFin = $ultimaAdenda
            ? Carbon::parse($ultimaAdenda->fecha_fin)
            : Carbon::parse($this->fecha_fin);

        $hoy = now();
        return $hoy->diffInDays($fechaFin, false);
    }

    public function estaProximoAVencer(): bool
    {
        $dias = $this->diasParaVencimiento();
        return $dias <= 30 && $dias >= 0;
    }

    /**
     * ✅ ACTUALIZADO: Días para estabilidad basado en 59 meses (no 60)
     */
    public function diasParaEstabilidad(): int
    {
        $tiempoAcumulado = $this->calcularTiempoAcumuladoReal();
        // Límite máximo permitido: 59 meses (4 años 11 meses)
        $mesesFaltantes = 59 - $tiempoAcumulado;
        return max(0, $mesesFaltantes * 30); // No puede ser negativo
    }

    /**
     * ✅ ACTUALIZADO: Próximo a estabilidad basado en 56+ meses
     * Alerta crítica desde 56 meses (3 meses antes del límite de 59)
     */
    public function estaProximoAEstabilidad(): bool
    {
        $tiempoAcumulado = $this->calcularTiempoAcumuladoReal();
        // Alerta crítica desde 4 años 8 meses (56 meses) hasta 4 años 11 meses (59 meses)
        return $tiempoAcumulado >= 56 && $tiempoAcumulado < 59;
    }

    public function tieneContratoFirmado(): bool
    {
        return !empty($this->url_documento_escaneado);
    }

    /**
     * ✅ ACTUALIZADO: Color de alerta basado en 59 meses
     */
    public function getColorAlertaEstabilidad(): string
    {
        $meses = $this->calcularTiempoAcumuladoReal();

        // Límite: 59 meses (4 años 11 meses)
        // Alerta crítica desde 56 meses (3 meses antes)
        if ($meses >= 56) {
            // Rojo: 4 años 8 meses o más (alerta crítica)
            return 'red';
        } elseif ($meses >= 48) {
            // Amarillo: 4 años o más (advertencia)
            return 'yellow';
        } else {
            // Verde: menos de 4 años
            return 'green';
        }
    }

    public function obtenerIndicadorEstabilidad(): string
    {
        return match ($this->getColorAlertaEstabilidad()) {
            'green' => 'VERDE',
            'yellow' => 'AMARILLO',
            'red' => 'ROJO',
            default => 'VERDE'
        };
    }

    public function getEstadoBadgeAttribute(): string
    {
        return match ($this->estado) {
            'Activo' => '<span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold">🟢 Activo</span>',
            'Borrador' => '<span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-xs font-semibold">🟡 Borrador</span>',
            'Firmado' => '<span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-semibold">🔵 Firmado</span>',
            'Vencido' => '<span class="bg-red-100 text-red-800 px-3 py-1 rounded-full text-xs font-semibold">🔴 Vencido</span>',
            'Cancelado' => '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">⚫ Cancelado</span>',
            'Enviado a firmar' => '<span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-semibold">🟣 Enviado a firmar</span>',
            default => '<span class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold">' . $this->estado . '</span>',
        };
    }
}