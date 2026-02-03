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
        Schema::create('configuracion_empresa', function (Blueprint $table) {
            $table->id();
            
            // Datos de la Empresa
            $table->string('razon_social', 255)->default('EMICONSATH S.A.');
            $table->string('ruc', 11)->default('20489418691');
            $table->text('direccion')->default('Mz. F Lote 22 A.V. Señor de Huayllay Ate - Lima – Lima');
            
            // Datos del Gerente General
            $table->string('gerente_nombre', 255)->default('CRUZ CARHUAZ NELSON JOVINO');
            $table->string('gerente_titulo', 50)->default('Ing.')->nullable();
            $table->string('gerente_dni', 8)->default('10158128');
            
            // Configuraciones adicionales
            $table->string('logo_path', 500)->nullable();
            $table->string('firma_digital_path', 500)->nullable();
            
            // Auditoría
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
            
            // Foreign key
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracion_empresa');
    }
};
