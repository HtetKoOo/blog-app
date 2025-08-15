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
        // Step 0: convert status to string to handle old values
        DB::statement("ALTER TABLE music_videos MODIFY COLUMN status VARCHAR(10)");

        // Step 1: convert old string values to numeric
        DB::statement("UPDATE music_videos SET status = '1' WHERE status = 'active'");
        DB::statement("UPDATE music_videos SET status = '0' WHERE status = 'inactive'");

        // Step 2: modify column to TINYINT(1)
        DB::statement("ALTER TABLE music_videos MODIFY COLUMN status TINYINT(1) NOT NULL");

    }

    public function down(): void
    {
        // Optionally convert back to original state
        DB::statement("ALTER TABLE music_videos MODIFY COLUMN status VARCHAR(10)");
    }
};
