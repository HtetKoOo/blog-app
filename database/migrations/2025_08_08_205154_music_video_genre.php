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
            $table->unsignedBigInteger('music_video_id');
            $table->unsignedBigInteger('genre_id');

            $table->foreign('music_video_id')
                ->references('id')->on('music_videos')
                ->onDelete('cascade');

            $table->foreign('genre_id')
                ->references('id')->on('music_genres')
                ->onDelete('cascade');

            $table->primary(['music_video_id', 'genre_id']);
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
