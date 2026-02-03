<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('plantillas', function (Blueprint $table) {
            $table->string('codigo_prefijo')->unique()->nullable()->after('nombre');
            $table->enum('patron_tipo', ['A', 'B', 'C'])->default('A')->after('tipo_contrato');
            $table->enum('unidad', ['Central', 'Chungar', 'Alpamarca', 'Huarón', 'Romina', 'Baños', 'Pucará', 'Otro'])->nullable()->after('patron_tipo');
            $table->string('empresa_principal')->nullable()->after('unidad');
            $table->text('ubicacion')->nullable()->after('empresa_principal');
            $table->string('blade_template')->default('contratos.templates.patron-a')->after('contenido_html');
            $table->integer('orden')->default(0)->after('blade_template');
        });
    }

    public function down(): void
    {
        Schema::table('plantillas', function (Blueprint $table) {
            $table->dropColumn(['codigo_prefijo', 'patron_tipo', 'unidad', 'empresa_principal', 'ubicacion', 'blade_template', 'orden']);
        });
    }
};