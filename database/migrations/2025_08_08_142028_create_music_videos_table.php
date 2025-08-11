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
        Schema::create('music_videos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('singer')->nullable();
            $table->string('cloudinary_public_id')->unique();
            $table->string('video_url', 500);// URL to the video file
            $table->string('thumbnail_url', 500)->nullable();//thumbnail image of the video
            $table->integer('duration')->nullable()->comment('Duration in seconds');
            $table->bigInteger('file_size')->nullable()->comment('File size in bytes');
            $table->enum('status', ['active', 'inactive', 'deleted'])->default('active');
            $table->unsignedBigInteger('views')->default(0);
            $table->timestamp('uploaded_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('music_videos');
    }
};
