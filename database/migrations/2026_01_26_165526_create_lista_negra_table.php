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
        Schema::create('lista_negra', function (Blueprint $table) {
            $table->id();
            
            // Relación: FK a trabajadores (DNI)
            $table->string('dni', 8)->unique();
            $table->foreign('dni')->references('dni')->on('trabajadores')->onDelete('cascade');
            
            // Motivo
            $table->enum('motivo', ['Leve', 'Grave']);
            $table->text('descripcion_motivo');
            $table->string('url_informe_escaneado', 255)->nullable();
            
            // Resolución (si es leve)
            $table->boolean('puede_desbloquear')->default(false);
            $table->string('url_carta_compromiso', 255)->nullable();
            $table->string('url_autorizacion', 255)->nullable();
            
            // Estado
            $table->enum('estado', ['Bloqueado', 'Desbloqueado', 'Resuelto'])->default('Bloqueado');
            
            // CORRECCIÓN: Cambiar de date() a dateTime() para guardar hora exacta
            $table->dateTime('fecha_bloqueo');
            $table->dateTime('fecha_desbloqueo')->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('bloqueado_por')->nullable();
            $table->unsignedBigInteger('desbloqueado_por')->nullable();
            $table->foreign('bloqueado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('desbloqueado_por')->references('id')->on('users')->onDelete('set null');
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('dni');
            $table->index('estado');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_negra');
    }
};