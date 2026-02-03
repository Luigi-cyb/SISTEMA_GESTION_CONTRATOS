<?php

namespace Database\Seeders;

use App\Models\Plantilla;
use Illuminate\Database\Seeder;

class PlantillasSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Contrato Alpamarca - Proyecto Cierre Relavera
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-ALP-PROY-CM'],
            [
                'nombre' => 'Contrato Alpamarca - Proyecto Cierre Relavera',
                'descripcion' => 'Contrato para servicio específico en Alpamarca',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Alpamarca',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'Alpamarca',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 1,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 2. Oficina Central - Administración 8h
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CEN-ADM'],
            [
                'nombre' => 'Oficina Central - Administración 8h',
                'descripcion' => 'Contrato para administración - 8 horas',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'B',
                'unidad' => 'Central',
                'empresa_principal' => 'EMICONSATH S.A.',
                'ubicacion' => 'Oficina Central - Ate',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-b',
                'orden' => 2,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 3. Oficina Central - Administración 14x7
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CEN-ADM-14x7'],
            [
                'nombre' => 'Oficina Central - Administración 14x7',
                'descripcion' => 'Contrato para administración - Sistema 14x7',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'B',
                'unidad' => 'Central',
                'empresa_principal' => 'EMICONSATH S.A.',
                'ubicacion' => 'Oficina Central - Ate',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-b',
                'orden' => 3,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 4. Cancha - Planta Bloquetera
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CANCHA-PB'],
            [
                'nombre' => 'Cancha - Planta Bloquetera',
                'descripcion' => 'Contrato por incremento de actividad',
                'tipo_contrato' => 'Por incremento de actividad',
                'patron_tipo' => 'C',
                'unidad' => 'Central',
                'empresa_principal' => 'EMICONSATH S.A.',
                'ubicacion' => 'Canchacucho - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-c',
                'orden' => 4,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 5. Chungar - Asuntos Ambientales
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-AA-MTP'],
            [
                'nombre' => 'Chungar - Asuntos Ambientales',
                'descripcion' => 'Contrato para servicios ambientales en Chungar',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 5,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 6. Chungar - Residuos Sólidos
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-AA-RR'],
            [
                'nombre' => 'Chungar - Residuos Sólidos',
                'descripcion' => 'Contrato para manejo de residuos sólidos',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 6,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 7. Chungar - Administración
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-ADM'],
            [
                'nombre' => 'Chungar - Administración',
                'descripcion' => 'Contrato para funciones administrativas en Chungar',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 7,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 8. Chungar - Movimiento de Tierras
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-CM'],
            [
                'nombre' => 'Chungar - Movimiento de Tierras',
                'descripcion' => 'Contrato para operadores de movimiento de tierras',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 8,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 9. Chungar - Despacho
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-DC'],
            [
                'nombre' => 'Chungar - Despacho',
                'descripcion' => 'Contrato para auxiliares de despacho en Chungar',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 9,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 10. Chungar - Equipo Línea Amarilla
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-LA'],
            [
                'nombre' => 'Chungar - Equipo Línea Amarilla',
                'descripcion' => 'Contrato para operadores de equipo de línea amarilla',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 10,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 11. Chungar - Limpieza Filtrado
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-PF'],
            [
                'nombre' => 'Chungar - Limpieza Filtrado',
                'descripcion' => 'Contrato para limpieza industrial en planta de filtrado',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 11,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 12. Chungar - Proyectos
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-PROY'],
            [
                'nombre' => 'Chungar - Proyectos',
                'descripcion' => 'Contrato para ayudantes en proyectos de obras civiles',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 12,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 13. Chungar - Transporte
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-CHUN-TRNS'],
            [
                'nombre' => 'Chungar - Transporte',
                'descripcion' => 'Contrato para conductores de transporte',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Chungar',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Chungar - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 13,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 14. Huarón - Orden de Trabajo
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-HUA-HH'],
            [
                'nombre' => 'Huarón - Orden de Trabajo',
                'descripcion' => 'Contrato para servicios en Huarón',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Huarón',
                'empresa_principal' => 'PAN AMERICAN SILVER HUARON S.A.',
                'ubicacion' => 'UEA Huarón - Huayllay - Pasco',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 14,
                'activa' => true,
                'created_by' => 1,
            ]
        );

        // 15. Romina - Proyectos
        Plantilla::updateOrCreate(
            ['codigo_prefijo' => 'EMI-ROM-PROY'],
            [
                'nombre' => 'Romina - Proyectos',
                'descripcion' => 'Contrato para proyectos en unidad Romina',
                'tipo_contrato' => 'Temporal',
                'patron_tipo' => 'A',
                'unidad' => 'Romina',
                'empresa_principal' => 'COMPAÑÍA MINERA CHUNGAR SAC',
                'ubicacion' => 'UEA Alpamarca - Yauli - Junín',
                'contenido_html' => '<p>Contenido será actualizado por RRHH</p>',
                'blade_template' => 'contratos.templates.patron-a',
                'orden' => 15,
                'activa' => true,
                'created_by' => 1,
            ]
        );
    }
}