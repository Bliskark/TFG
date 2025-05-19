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
        Schema::create('eventos', function (Blueprint $table) {
            $table->id(); // Auto-incremental, PRIMARY KEY
            $table->string('name', 100); // VARCHAR(100) NOT NULL
            $table->text('description'); // TEXT NOT NULL
            $table->string('efecto', 255); // VARCHAR(255) NOT NULL
            $table->enum('tipo', ['curar', 'captura', 'misterioso']); // ENUM con los tres valores posibles
            $table->timestamps(); // created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
