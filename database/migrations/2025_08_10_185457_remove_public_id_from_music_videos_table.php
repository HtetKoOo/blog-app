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
            $table->dropColumn('cloudinary_public_id'); // remove column
        });
    }

    public function down(): void
    {
        Schema::table('music_videos', function (Blueprint $table) {
            $table->string('cloudinary_public_id')->nullable(); // restore column if rollback
        });
    }
};
