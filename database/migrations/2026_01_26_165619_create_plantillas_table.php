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
        Schema::create('plantillas', function (Blueprint $table) {
            $table->id();
            
            // Información
            $table->string('nombre', 150);
            $table->text('descripcion')->nullable();
            $table->enum('tipo_contrato', ['Temporal', 'Por incremento de actividad', 'Indefinido', 'Practicante']);
            
            // Contenido
            $table->longText('contenido_html');
            $table->json('clausulas_aplicables')->nullable();
            
            // Control
            $table->boolean('es_predeterminada')->default(false);
            $table->boolean('activa')->default(true);
            
            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('tipo_contrato');
            $table->index('activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plantillas');
    }
};