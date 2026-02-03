<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConfiguracionEmpresa extends Model
{
    use HasFactory;

    protected $table = 'configuracion_empresa';

    protected $fillable = [
        'razon_social',
        'ruc',
        'direccion',
        'gerente_nombre',
        'gerente_titulo',
        'gerente_dni',
        'logo_path',
        'firma_digital_path',
        'updated_by',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación con el usuario que actualizó
     */
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    /**
     * Obtener la configuración actual (siempre hay 1 sola fila)
     */
    public static function obtener()
    {
        return self::first() ?? self::create([
            'razon_social' => 'EMICONSATH S.A.',
            'ruc' => '20489418691',
            'direccion' => 'Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima',
            'gerente_nombre' => 'CRUZ CARHUAZ NELSON JOVINO',
            'gerente_titulo' => 'Ing.',
            'gerente_dni' => '10158128',
        ]);
    }

    /**
     * Obtener nombre completo del gerente con título
     */
    public function gerenteNombreCompleto(): string
    {
        if ($this->gerente_titulo) {
            return $this->gerente_titulo . ' ' . $this->gerente_nombre;
        }
        return $this->gerente_nombre;
    }
}