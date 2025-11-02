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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id('season_id');
            $table->foreignId('program_id')->constrained('programs', 'program_id')->onDelete('cascade');
            $table->integer('season_number');
            $table->year('release_year')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('seasons');
    }
};
