<?php

namespace App\Imports;

use App\Models\Trabajador;
use App\Models\Auditoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TrabajadoresImport implements ToModel, WithHeadingRow
{
    private $rows = 0;

    public function model(array $row)
    {
        \Log::info('Fila Excel:', $row);
        ++$this->rows;

        // Formatear fecha de ingreso
        $fechaIngreso = null;
        if (isset($row['fecha_ingreso'])) {
            try {
                if (is_numeric($row['fecha_ingreso'])) {
                    $fechaIngreso = Date::excelToDateTimeObject($row['fecha_ingreso']);
                } else {
                    $fechaIngreso = Carbon::createFromFormat('d/m/Y', $row['fecha_ingreso']);
                }
            } catch (\Exception $e) {
                // Si falla el formato, intentar Y-m-d o dejar null (será atrapado por validación si es requerido)
            }
        }

        // Formatear fecha de nacimiento si existe
        $fechaNacimiento = null;
        if (isset($row['fecha_nacimiento'])) {
            try {
                if (is_numeric($row['fecha_nacimiento'])) {
                    $fechaNacimiento = Date::excelToDateTimeObject($row['fecha_nacimiento']);
                } else {
                    $fechaNacimiento = Carbon::createFromFormat('d/m/Y', $row['fecha_nacimiento']);
                }
            } catch (\Exception $e) {
            }
        }

        try {
            $trabajador = Trabajador::updateOrCreate(
                ['dni' => (string) $row['dni']], // Buscar por DNI (forzar string)
                [
                    'nombre_completo' => strtoupper($row['nombres']),
                    'cargo' => strtoupper($row['cargo']),
                    'unidad' => $row['unidad'] ?? 'Otra',
                    'area_departamento' => isset($row['area']) ? strtoupper($row['area']) : null,
                    'fecha_ingreso' => $fechaIngreso ?? now(),
                    'fecha_nacimiento' => $fechaNacimiento,
                    'nacionalidad' => $row['nacionalidad'] ?? 'Peruana',
                    'telefono' => $row['telefono'] ?? null,
                    'email' => $row['email'] ?? null,
                    'direccion_actual' => $row['direccion'] ?? null,
                    'estado' => $row['estado'] ?? 'Activo',
                ]
            );
            return $trabajador;
        } catch (\Exception $e) {
            \Log::error('Error importando fila DNI ' . $row['dni'] . ': ' . $e->getMessage());
            return null;
        }
    }



    public function getRowCount(): int
    {
        return $this->rows;
    }
}
