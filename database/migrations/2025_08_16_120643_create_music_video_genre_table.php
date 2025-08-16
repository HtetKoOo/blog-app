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
        Schema::create('music_video_genre', function (Blueprint $table) {
            $table->id();
            $table->foreignId('music_video_id')->constrained()->onDelete('cascade');
            $table->foreignId('music_genre_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['music_video_id', 'music_genre_id']); // prevent duplicates
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_video_genre');
    }
};
