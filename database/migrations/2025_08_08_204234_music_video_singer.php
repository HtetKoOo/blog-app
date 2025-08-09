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
        Schema::create('music_video_singer', function (Blueprint $table) {
            $table->unsignedBigInteger('music_video_id');
            $table->unsignedBigInteger('singer_id');

            $table->foreign('music_video_id')
                ->references('id')->on('music_videos')
                ->onDelete('cascade');

            $table->foreign('singer_id')
                ->references('id')->on('singers')
                ->onDelete('cascade');

            $table->primary(['music_video_id', 'singer_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_video_singer');
    }
};
