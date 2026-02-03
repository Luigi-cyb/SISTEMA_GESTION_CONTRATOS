<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trabajadores', function (Blueprint $table) {
            // PRIMARY KEY: DNI (8 dígitos)
            $table->string('dni', 8)->primary();
            
            // Datos Básicos
            $table->string('nombre_completo', 150);
            $table->date('fecha_nacimiento')->nullable();
            $table->string('nacionalidad', 50)->default('Peruana');
            
            // Datos Laborales
            $table->string('cargo', 100);
            $table->string('area_departamento', 100)->nullable();
            $table->enum('unidad', ['Chungar', 'Huarón', 'Romina', 'Baños', 'Alpamarca', 'Otra'])->default('Otra');
            
            // Datos de Contacto
            $table->string('telefono', 15)->nullable();
            $table->string('email', 100)->nullable();
            $table->text('direccion_actual')->nullable();
            $table->string('contacto_emergencia', 150)->nullable();
            $table->string('telefono_emergencia', 15)->nullable();
            
            // Datos Bancarios
            $table->string('cuenta_bancaria', 20)->nullable();
            $table->string('cci', 20)->nullable();
            
            // Control
            $table->enum('estado', ['Activo', 'Inactivo', 'Suspendido'])->default('Activo');
            $table->date('fecha_ingreso')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('nombre_completo');
            $table->index('email');
            $table->index('unidad');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trabajadores');
    }
};