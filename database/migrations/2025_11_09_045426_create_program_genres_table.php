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
        Schema::create('program_genres', function (Blueprint $table) {
            $table->id('program_genre_id');
            $table->foreignId('program_id')->constrained('programs', 'program_id')->cascadeOnDelete();
            $table->foreignId('genre_id')->constrained('genres', 'genre_id')->cascadeOnDelete();
            // $table->id('program_genre_id');
            // $table->string('name');
            // $table->string('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('program_genres');
    }
};
