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
            // Cross-DB friendly: BIGINT, nullable
            $table->bigInteger('file_size')->nullable()->comment('bytes')->change();
        });
    }

    public function down(): void
    {
        Schema::table('music_videos', function (Blueprint $table) {
            // Roll back to INT if you had that before
            $table->decimal('file_size', 20, 6)->change();
        });
    }
};
