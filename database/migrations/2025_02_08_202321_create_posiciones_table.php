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
        // Tabla de posiciones
        Schema::create('posiciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torneo_id')->constrained('torneos')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->integer('puntos')->default(0);
            $table->integer('partidos_jugados')->default(0);
            $table->integer('partidos_ganados')->default(0);
            $table->integer('partidos_empatados')->default(0);
            $table->integer('partidos_perdidos')->default(0);
            $table->integer('goles_a_favor')->default(0);
            $table->integer('goles_en_contra')->default(0);
            $table->integer('diferencia_goles')->default(0);
            $table->timestamps();
            $table->unique(['torneo_id', 'equipo_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posiciones');
    }
};
