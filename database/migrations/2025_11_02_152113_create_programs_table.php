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
        Schema::create('programs', function (Blueprint $table) {
            $table->id('program_id');
            $table->string('title');
            $table->text('description')->nullable();
            // $table->enum('type', ['movie', 'series']);
            // Guardamos como string para evitar dependencias de motor de BD
            $table->string('type')->index();
            /*
            👉 Laravel le dice al motor de base de datos:
            “Crea un índice sobre la columna type”.
            Un índice es una estructura adicional (como un pequeño diccionario o tabla auxiliar) 
            que acelera las búsquedas y filtros en esa columna.
             */
            $table->date('release_date')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
            // $table->id();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('programs');
    }
};
