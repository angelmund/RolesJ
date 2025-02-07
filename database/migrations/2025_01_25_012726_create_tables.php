<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Tabla de modalidades
        Schema::create('modalidades', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->timestamps();
        });

        //Categorias  preguntar con el profesor
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50)->unique();
            $table->timestamps();
        });

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

        // Tabla de equipos
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->text('nombre');
            $table->text('escudo')->nullable();
            $table->timestamps();
        });

        // Tabla de jugadores
        Schema::create('jugadores', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->integer('edad')->nullable();
            $table->integer('numero_camiseta')->nullable();
            $table->string('foto',100)->nullable();
            $table->timestamps();
        });

        // Tabla pivote jugador - equipo - torneo
        Schema::create('jugador_equipo_torneo', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jugador_id')->constrained('jugadores')->onDelete('cascade');
            $table->foreignId('equipo_id')->constrained('equipos')->onDelete('cascade');
            $table->foreignId('torneo_id')->constrained('torneos')->onDelete('cascade');
            $table->timestamps();
            $table->unique(['jugador_id', 'equipo_id', 'torneo_id'], 'jugador_equipo_torneo_unq');
        });


        // Tabla de jornadas
        Schema::create('jornadas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('torneo_id')->constrained('torneos')->onDelete('cascade');
            $table->integer('numero_jornada');
            $table->date('fecha');
            $table->timestamps();
        });

        // Tabla de estados de partidos
        Schema::create('estados_partido', function (Blueprint $table) {
            $table->id();
            $table->string('estado', 50)->unique();
            $table->timestamps();
        });

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

    public function down()
    {
        Schema::dropIfExists('posiciones');
        Schema::dropIfExists('partidos');
        Schema::dropIfExists('estados_partido');
        Schema::dropIfExists('jornadas');
        Schema::dropIfExists('jugador_equipo_modalidad');
        Schema::dropIfExists('jugadores');
        Schema::dropIfExists('equipos');
        Schema::dropIfExists('torneos');
        Schema::dropIfExists('modalidades');
    }
};
