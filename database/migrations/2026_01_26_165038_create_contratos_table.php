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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            
            // Relación: FK a trabajadores (DNI)
            $table->string('dni', 8);
            $table->foreign('dni')->references('dni')->on('trabajadores')->onDelete('cascade');
            
            // Tipo de Contrato
            $table->enum('tipo_contrato', ['Temporal', 'Por incremento de actividad', 'Indefinido', 'Practicante']);
            
            // Fechas
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            
            // Remuneración
            $table->enum('tipo_salario', ['Mensual', 'Jornal', 'Ambos'])->default('Mensual');
            $table->decimal('salario_mensual', 10, 2)->nullable();
            $table->decimal('salario_jornal', 10, 2)->nullable();
            
            // Horarios
            $table->enum('horario', ['8 horas', '15x7', '5x2'])->default('8 horas');
            
            // Beneficios
            $table->boolean('beneficios_ley_728')->default(true);
            $table->text('beneficios_descripcion')->nullable();
            
            // Plantilla
            // Plantilla (se añadirá después)
$table->unsignedBigInteger('plantilla_id')->nullable();

            // Documentación
            $table->string('numero_contrato', 50)->unique();
            $table->string('url_documento_escaneado', 255)->nullable();
            
            // Estado
            $table->enum('estado', ['Borrador', 'Enviado a firmar', 'Firmado', 'Activo', 'Vencido', 'Cancelado'])->default('Borrador');
            
            // Control de Estabilidad (CRÍTICO)
            $table->integer('tiempo_acumulado_meses')->default(0);
            $table->boolean('alerta_estabilidad_enviada')->default(false);
            $table->date('fecha_alerta_estabilidad')->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('dni');
            $table->index('estado');
            $table->index('fecha_fin');
            $table->index('numero_contrato');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};