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
        Schema::create('adendas', function (Blueprint $table) {
            $table->id();
            
            // Relaciones
            $table->unsignedBigInteger('contrato_id');
            $table->string('dni', 8);
            $table->unsignedBigInteger('adenda_anterior_id')->nullable();
            
            $table->foreign('contrato_id')->references('id')->on('contratos')->onDelete('cascade');
            $table->foreign('dni')->references('dni')->on('trabajadores')->onDelete('cascade');
            $table->foreign('adenda_anterior_id')->references('id')->on('adendas')->onDelete('set null');
            
            // Fechas de la Adenda
            $table->date('fecha_inicio');
            $table->date('fecha_fin');
            $table->integer('numero_adenda');
            
            // Datos Laborales (copiados del contrato)
            $table->enum('tipo_salario', ['Mensual', 'Jornal', 'Ambos'])->default('Mensual');
            $table->decimal('salario_mensual', 10, 2)->nullable();
            $table->decimal('salario_jornal', 10, 2)->nullable();
            $table->enum('horario', ['8 horas', '15x7', '5x2'])->default('8 horas');
            
            // Control de Tiempo Acumulado
            $table->integer('tiempo_acumulado_total_meses');
            
            // Documentación
            $table->string('numero_adenda_contrato', 50)->unique();
            $table->string('url_documento_escaneado', 255)->nullable();
            
            // Estado
            $table->enum('estado', ['Borrador', 'Enviado a firmar', 'Firmado', 'Activo', 'Vencida', 'Cancelada'])->default('Borrador');
            
            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('dni');
            $table->index('contrato_id');
            $table->index('estado');
            $table->index('fecha_fin');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('adendas');
    }
};