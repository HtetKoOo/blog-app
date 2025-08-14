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
        Schema::table('music_video_genre', function (Blueprint $table) {
            $table->renameColumn('genre_id', 'music_genre_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('music_video_genre', function (Blueprint $table) {
            $table->renameColumn('music_genre_id', 'genre_id');
        });
    }
};
