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
        Schema::create('cumpleaños', function (Blueprint $table) {
            $table->id();
            
            // Relación: FK a trabajadores (DNI)
            $table->string('dni', 8);
            $table->foreign('dni')->references('dni')->on('trabajadores')->onDelete('cascade');
            
            // Información de Cumpleaños
            $table->date('fecha_cumpleaños');
            
            // Giftcard
            $table->boolean('giftcard_entregada')->default(false);
            $table->date('fecha_entrega_giftcard')->nullable();
            $table->decimal('monto_giftcard', 10, 2)->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('entregado_por')->nullable();
            $table->foreign('entregado_por')->references('id')->on('users')->onDelete('set null');
            
            // Timestamps
            $table->timestamps();
            
            // Índices
            $table->index('dni');
            $table->index('fecha_cumpleaños');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cumpleaños');
    }
};