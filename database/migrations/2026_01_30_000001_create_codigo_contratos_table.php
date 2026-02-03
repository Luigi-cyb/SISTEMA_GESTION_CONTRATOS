<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('codigo_contratos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_base', 50)->unique()->index();
            $table->integer('correlativo')->default(0);
            $table->timestamps();
        });

        DB::table('codigo_contratos')->insert([
            ['codigo_base' => 'EMI-ALP-PROY-CM', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CEN-ADM', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CEN-CANCHA-PB', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-AA-MTP', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-AA-RR', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-ADM', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-CM', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-DC', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-LA', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-PF', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-PROY', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-CHUN-TRNS', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-HUA-HH-ORDEN', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
            ['codigo_base' => 'EMI-ROM-PROY', 'correlativo' => 0, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('codigo_contratos');
    }
};  