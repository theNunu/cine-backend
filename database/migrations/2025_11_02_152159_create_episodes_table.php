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
        Schema::create('episodes', function (Blueprint $table) {
            $table->id('episode_id');
            $table->foreignId('season_id')->constrained('seasons', 'season_id')->onDelete('cascade');
            $table->integer('episode_number');
            $table->string('title');
            $table->integer('duration_minutes')->nullable();
            $table->text('synopsis')->nullable();
            $table->string('video_url'); // aquí irá tu URL de YouTube
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
        Schema::dropIfExists('episodes');
    }
};
