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
        Schema::create('alertas', function (Blueprint $table) {
            $table->id();
            
            // Relación: FK a trabajadores (DNI)
            $table->string('dni', 8);
            $table->unsignedBigInteger('contrato_id')->nullable();
            
            $table->foreign('dni')->references('dni')->on('trabajadores')->onDelete('cascade');
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('set null');
            
            // Tipo de Alerta
            $table->enum('tipo', [
                'Vencimiento de contrato',
                'Cumpleaños',
                'Estabilidad laboral (5 años)',
                'Otra'
            ]);
            
            // Destinatarios
            $table->enum('destinatario', ['RRHH', 'Bienestar', 'Gerencia', 'Multiple'])->default('RRHH');
            
            // Descripción
            $table->string('titulo', 200);
            $table->text('descripcion')->nullable();
            
            // Fechas
            $table->date('fecha_alerta');
            $table->date('fecha_vencimiento_evento')->nullable();
            
            // Prioridad
            $table->enum('prioridad', ['Baja', 'Media', 'Alta', 'Crítica'])->default('Media');
            $table->enum('color_indicador', ['Verde', 'Amarillo', 'Rojo'])->default('Verde');
            
            // Estado
            $table->enum('estado', ['Pendiente', 'Enviada', 'Leída', 'Resuelta'])->default('Pendiente');
            $table->string('medio_notificacion')->default('Email,Sistema');
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('dni');
            $table->index('prioridad');
            $table->index('estado');
            $table->index('fecha_alerta');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alertas');
    }
};