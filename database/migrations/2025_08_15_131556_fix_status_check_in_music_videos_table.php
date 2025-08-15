<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the old check constraint
        DB::statement("ALTER TABLE music_videos DROP CONSTRAINT IF EXISTS music_videos_status_check");

        // Add the new check constraint
        DB::statement("ALTER TABLE music_videos ADD CONSTRAINT music_videos_status_check CHECK (status IN (0, 1))");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE music_videos DROP CONSTRAINT IF EXISTS music_videos_status_check");
    }
};
