<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->unsignedBigInteger('codigo_base_id')
                ->nullable()
                ->after('plantilla_id')
                ->comment('Relación con tabla codigo_contratos para generar código automático');
            
            $table->date('fecha_firma_manual')
                ->nullable()
                ->after('fecha_firma')
                ->comment('Fecha de firma manual (por defecto un día antes de fecha_inicio)');
            
            $table->foreign('codigo_base_id')
                ->references('id')
                ->on('codigo_contratos')
                ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('contratos', function (Blueprint $table) {
            $table->dropForeign(['codigo_base_id']);
            $table->dropColumn(['codigo_base_id', 'fecha_firma_manual']);
        });
    }
};