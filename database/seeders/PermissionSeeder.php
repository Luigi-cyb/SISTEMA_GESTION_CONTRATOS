<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Trabajadores
        Permission::create(['name' => 'view.trabajadores', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.trabajadores', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.trabajadores', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.trabajadores', 'guard_name' => 'web']);

        // Contratos
        Permission::create(['name' => 'view.contratos', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.contratos', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.contratos', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.contratos', 'guard_name' => 'web']);
        Permission::create(['name' => 'view.salarios.contratos', 'guard_name' => 'web']);

        // Adendas
        Permission::create(['name' => 'view.adendas', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.adendas', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.adendas', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.adendas', 'guard_name' => 'web']);

        // Alertas
        Permission::create(['name' => 'view.alertas', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.alertas', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.alertas', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.alertas', 'guard_name' => 'web']);

        // Lista Negra
        Permission::create(['name' => 'view.lista_negra', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.lista_negra', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.lista_negra', 'guard_name' => 'web']);
        Permission::create(['name' => 'desbloquear.lista_negra', 'guard_name' => 'web']);

        // Plantillas
        Permission::create(['name' => 'view.plantillas', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.plantillas', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.plantillas', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.plantillas', 'guard_name' => 'web']);

        // Cláusulas
        Permission::create(['name' => 'view.clausulas', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.clausulas', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.clausulas', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.clausulas', 'guard_name' => 'web']);

        // Cumpleaños
        Permission::create(['name' => 'view.cumpleaños', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.cumpleaños', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.cumpleaños', 'guard_name' => 'web']);
        Permission::create(['name' => 'registrar.giftcard', 'guard_name' => 'web']);

        // Reportes
        Permission::create(['name' => 'view.reportes', 'guard_name' => 'web']);
        Permission::create(['name' => 'export.reportes.excel', 'guard_name' => 'web']);
        Permission::create(['name' => 'export.reportes.pdf', 'guard_name' => 'web']);

        // Dashboard
        Permission::create(['name' => 'view.dashboard', 'guard_name' => 'web']);

        // Usuario
        Permission::create(['name' => 'view.usuarios', 'guard_name' => 'web']);
        Permission::create(['name' => 'create.usuarios', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.usuarios', 'guard_name' => 'web']);
        Permission::create(['name' => 'delete.usuarios', 'guard_name' => 'web']);

        // Auditoría
        Permission::create(['name' => 'view.auditoria', 'guard_name' => 'web']);

        // Configuración Empresa
        Permission::create(['name' => 'view.configuracion', 'guard_name' => 'web']);
        Permission::create(['name' => 'edit.configuracion', 'guard_name' => 'web']);

        // Reportes críticos
        Permission::create(['name' => 'view.reporte_critico_estables', 'guard_name' => 'web']);
    }


}