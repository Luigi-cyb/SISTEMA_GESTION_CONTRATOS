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
        Schema::create('auditoria', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id')->nullable();
    $table->string('accion')->index();
    $table->string('modelo')->nullable();
    $table->unsignedBigInteger('modelo_id')->nullable();
    $table->text('detalles')->nullable();
    $table->string('ip_address')->nullable();
    $table->timestamp('fecha')->useCurrent();
    $table->timestamps();
    
    $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auditoria');
    }
};
