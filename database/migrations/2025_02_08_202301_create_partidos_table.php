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
         // Tabla de partidos
         Schema::create('partidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jornada_id')->constrained('jornadas')->onDelete('cascade');
            $table->foreignId('equipo_local_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('equipo_visitante_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('estado_id')->constrained('estados_partido')->onDelete('cascade');
            $table->integer('goles_local')->default(0);
            $table->integer('goles_visitante')->default(0);
            $table->timestamps();
            $table->unique(['equipo_local_id', 'equipo_visitante_id', 'jornada_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('partidos');
    }
};
