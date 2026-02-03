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
        Schema::create('clausulas', function (Blueprint $table) {
            $table->id();
            
            // Información
            $table->string('nombre', 150);
            $table->text('contenido');
            $table->enum('tipo_aplicable', ['Temporal', 'Por incremento de actividad', 'Indefinido', 'Practicante', 'Todas'])->default('Todas');
            
            // Control
            $table->boolean('activa')->default(true);
            $table->integer('orden')->nullable();
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('tipo_aplicable');
            $table->index('activa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clausulas');
    }
};