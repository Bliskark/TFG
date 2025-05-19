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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id(); // id del equipo
            $table->unsignedBigInteger('usuario_id'); // FK al usuario dueño del equipo

            // Pokémon 1
            $table->integer('pokemon1_id')->nullable();
            $table->integer('level1')->nullable();
            $table->integer('hp1')->nullable();

            // Pokémon 2
            $table->integer('pokemon2_id')->nullable();
            $table->integer('level2')->nullable();
            $table->integer('hp2')->nullable();

            // Pokémon 3
            $table->integer('pokemon3_id')->nullable();
            $table->integer('level3')->nullable();
            $table->integer('hp3')->nullable();

            // Pokémon 4
            $table->integer('pokemon4_id')->nullable();
            $table->integer('level4')->nullable();
            $table->integer('hp4')->nullable();

            // Pokémon 5
            $table->integer('pokemon5_id')->nullable();
            $table->integer('level5')->nullable();
            $table->integer('hp5')->nullable();

            // Pokémon 6
            $table->integer('pokemon6_id')->nullable();
            $table->integer('level6')->nullable();
            $table->integer('hp6')->nullable();

            $table->timestamps();

            // Clave foránea
            $table->foreign('usuario_id')->references('id')->on('usuarios')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
