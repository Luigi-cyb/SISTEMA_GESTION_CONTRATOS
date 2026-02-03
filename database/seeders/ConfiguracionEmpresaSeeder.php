<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ConfiguracionEmpresa;

class ConfiguracionEmpresaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ConfiguracionEmpresa::create([
            'razon_social' => 'EMICONSATH S.A.',
            'ruc' => '20489418691',
            'direccion' => 'Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima',
            'gerente_nombre' => 'CRUZ CARHUAZ NELSON JOVINO',
            'gerente_titulo' => 'Ing.',
            'gerente_dni' => '10158128',
            'updated_by' => 1, // Usuario Admin
        ]);
    }
}