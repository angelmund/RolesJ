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
        // Tabla de torneos
        Schema::create('torneos', function (Blueprint $table) {
            $table->id();
            $table->text('nombre', 100)->unique();
            $table->unsignedBigInteger('modalidad_id');
            $table->unsignedBigInteger('categoria_id');
            $table->date('fecha_inicio')->nullable();
            $table->date('fecha_fin')->nullable();
            $table->timestamps();

            // Llave foránea a la tabla modalidades
            $table->foreign('modalidad_id')->references('id')->on('modalidades')->onDelete('cascade');

            // Llave foránea a la tabla categorias
            $table->foreign('categoria_id')->references('id')->on('categorias')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('torneos');
    }
};
