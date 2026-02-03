<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ROL: ADMIN - Todos los permisos
        
        $adminRole = Role::findByName('Admin');
        $adminRole->givePermissionTo([
            // Trabajadores
            'view.trabajadores',
            'create.trabajadores',
            'edit.trabajadores',
            'delete.trabajadores',
            
            // Contratos
            'view.contratos',
            'create.contratos',
            'edit.contratos',
            'delete.contratos',
            'view.salarios.contratos',
            
            // Adendas
            'view.adendas',
            'create.adendas',
            'edit.adendas',
            'delete.adendas',
            
            // Alertas
            'view.alertas',
            'create.alertas',
            'edit.alertas',
            'delete.alertas',
            
            // Lista Negra
            'view.lista_negra',
            'create.lista_negra',
            'edit.lista_negra',
            'desbloquear.lista_negra',
            
            // Plantillas
            'view.plantillas',
            'create.plantillas',
            'edit.plantillas',
            'delete.plantillas',
            
            // Cláusulas
            'view.clausulas',
            'create.clausulas',
            'edit.clausulas',
            'delete.clausulas',
            
            // Cumpleaños
            'view.cumpleaños',
            'create.cumpleaños',
            'edit.cumpleaños',
            'registrar.giftcard',
            
            // Reportes
            'view.reportes',
            'export.reportes.excel',
            'export.reportes.pdf',
            'view.reporte_critico_estables',
            
            // Dashboard
            'view.dashboard',
            
            // Usuarios
            'view.usuarios',
            'create.usuarios',
            'edit.usuarios',
            'delete.usuarios',
            
            
            // Auditoría
            'view.auditoria',
            
            // Configuración Empresa
            'view.configuracion',
            'edit.configuracion',
        ]);

        // ROL: RRHH - Permisos limitados
        $rrhhRole = Role::findByName('RRHH');
        $rrhhRole->givePermissionTo([
            // Trabajadores
            'view.trabajadores',
            'create.trabajadores',
            'edit.trabajadores',
            // NO: delete.trabajadores
            
            // Contratos (sin salarios detallados)
            'view.contratos',
            'create.contratos',
            'edit.contratos',
            // NO: delete.contratos
            // NO: view.salarios.contratos
            
            // Adendas
            'view.adendas',
            'create.adendas',
            'edit.adendas',
            // NO: delete.adendas
            
            // Alertas (solo editar)
            'view.alertas',
            'edit.alertas',
            // NO: create.alertas, delete.alertas
            
            // Lista Negra
            'view.lista_negra',
            'create.lista_negra',
            'desbloquear.lista_negra',
            // NO: delete.lista_negra
            
            // Plantillas (solo ver y editar)
            'view.plantillas',
            'edit.plantillas',
            // NO: create.plantillas, delete.plantillas
            
            // Cumpleaños (solo ver)
            'view.cumpleaños',
            
            // Reportes
            'view.reportes',
            'export.reportes.excel',
            'view.reporte_critico_estables',
            
            // Dashboard
            'view.dashboard',
        ]);

        // ROL: BIENESTAR - Acceso muy limitado
        // ROL: BIENESTAR - Solo Dashboard y Cumpleaños
$bienestarRole = Role::findByName('Bienestar');
$bienestarRole->givePermissionTo([
    // Cumpleaños (ver y registrar giftcard)
    'view.cumpleaños',
    'registrar.giftcard',
    'edit.cumpleaños',
    
    // Dashboard (cumpleaños)
    'view.dashboard',
]);

        // ROL: GERENCIA - Solo lectura de reportes
        $gerenciaRole = Role::findByName('Gerencia');
        $gerenciaRole->givePermissionTo([
            // Reportes
            'view.reportes',
            'export.reportes.excel',
            'view.reporte_critico_estables',
            
            // Dashboard (solo lectura)
            'view.dashboard',
            
            // Alertas (solo críticas - se filtrarán en la vista)
            'view.alertas',
        ]);
    }
}