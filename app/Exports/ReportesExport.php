<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class ReportesExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths, ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = collect($data);
    }

    /**
     * Retorna la colección de datos
     */
    public function collection()
    {
        return $this->data;
    }

    /**
     * Define los encabezados dinámicamente según las claves del primer elemento
     */
    public function headings(): array
    {
        if ($this->data->isEmpty()) {
            return [];
        }

        // Obtener las claves del primer elemento y formatearlas
        return array_map(function($key) {
            return strtoupper(str_replace('_', ' ', $key));
        }, array_keys($this->data->first()));
    }

    /**
     * Aplicar estilos a la hoja
     */
    public function styles(Worksheet $sheet)
    {
        // Estilo para los encabezados (fila 1)
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 12,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4472C4'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
        ]);

        // Estilo para el contenido (desde fila 2 en adelante)
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();

        $sheet->getStyle('A2:' . $lastColumn . $lastRow)->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Alternar colores de filas
        for ($i = 2; $i <= $lastRow; $i++) {
            if ($i % 2 == 0) {
                $sheet->getStyle('A' . $i . ':' . $lastColumn . $i)->applyFromArray([
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'F2F2F2'],
                    ],
                ]);
            }
        }

        return $sheet;
    }

    /**
     * Definir anchos de columnas
     */
    public function columnWidths(): array
    {
        if ($this->data->isEmpty()) {
            return [];
        }

        $widths = [];
        $columns = array_keys($this->data->first());
        $columnLetters = range('A', 'Z');

        foreach ($columns as $index => $column) {
            // Ajustar ancho según el tipo de columna
            switch ($column) {
                case 'dni':
                    $widths[$columnLetters[$index]] = 12;
                    break;
                case 'nombre_completo':
                    $widths[$columnLetters[$index]] = 35;
                    break;
                case 'cargo':
                case 'departamento':
                case 'unidad':
                    $widths[$columnLetters[$index]] = 20;
                    break;
                case 'fecha_inicio':
                case 'fecha_fin':
                    $widths[$columnLetters[$index]] = 15;
                    break;
                default:
                    $widths[$columnLetters[$index]] = 18;
                    break;
            }
        }

        return $widths;
    }
}