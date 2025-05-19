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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // id
            $table->string('email', 100)->unique(); // email del usuario
            $table->string('password'); // contraseña hasheada
            $table->enum('rol', ['entrenador', 'líder', 'alto_mando', 'campeón', 'admin']); // rol del usuario
            $table->integer('victories')->default(0); // combates ganados
            $table->integer('defeats')->default(0); // combates perdidos
            $table->integer('streak')->default(0); // racha máxima
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
