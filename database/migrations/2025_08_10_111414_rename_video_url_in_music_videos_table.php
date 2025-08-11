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
        Schema::table('music_videos', function (Blueprint $table) {
            // Remove the old column
            $table->dropColumn('video_url');

            // Add the new columns
            $table->string('music_url')->nullable();
            $table->string('video_link')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('music_videos', function (Blueprint $table) {
            // Revert changes
            $table->dropColumn(['music_url', 'video_link']);
            $table->string('video_url')->nullable();
        });
    }
};
